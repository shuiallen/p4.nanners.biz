<?php
class tasks_controller extends base_controller {
    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        # Setup view
        $this->template->content = View::instance('v_tasks_index');
        $this->template->title   = "Tasks";

        # JS for sortable 
        $client_files_body = Array(
                        '/js/jquery.form.js',
                        '/js/tasks_index.js',
                        '/js/tasks_create.js'
                        );
        $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Query for my tasks that are not done
        $q = "SELECT tasks.task_description, tasks.task_id
            FROM tasks
            INNER JOIN users
              ON tasks.user_id = users.user_id
            WHERE tasks.user_id = ".$this->user->user_id."
            AND tasks.status = 0
              ORDER BY tasks.created DESC";

        # Store the result array in the variable $tasks
        $tasks = DB::instance(DB_NAME)->select_rows($q);

        foreach($tasks as $key => $task) {
            // XSS prevention on output
            $task['task_description'] = ProjectUtils::clean($task['task_description']);
            $tasks[$key]['view'] = View::instance('v_tasks_row');
            $tasks[$key]['view']->data = $task;
        }

        # Pass tasks back to the view
        $this->template->content->tasks = $tasks;

        # Generate a new CSRF session token, and pass it to the View
        $this->template->content->token = NoCSRF::generate('token');

        # Render template
        echo $this->template;
    }

    public function p_newform() {
        ProjectUtils::check_token($_POST, "update profile");
        # If it doesn't fail, we can remove the token
        unset($_POST['token']);

        $view = View::instance('v_tasks_form');
 
        $data = Array();
        # There is no task_id for a new task yet
        $data['task_id'] = 0;
        $data['task_description'] = "";
        $view->data = $data;

        echo $view;
    }

    public function p_create() {
        # should check for CSRF token here, but having issues, see note in js/tasks_create.js

        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Associate this task with this user
        $_POST['user_id']  = $this->user->user_id;

        # More data we want stored with the user
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();
        $_POST['status'] = false;  // New task is not done
                
        # Insert this task into the tasks table
        $task_id = DB::instance(DB_NAME)->insert('tasks', $_POST);
 
        $data = Array();
        $data['task_id'] = $task_id;
        // XSS prevention on output
        $data['task_description'] = ProjectUtils::clean($_POST['task_description']);

        $view = View::instance('v_tasks_row');
        $view->data = $data;

        echo $view;
    }

    # This is the page that allows you to edit individual tasks
    # I was trying to edit tasks from the Task List page but that wasn't working
    # I think the way I am inserting the rows and declaring the event handlers is not correct
    # So for now, you have to get one task at a time in order to change it after creating it
    public function edit() {
        # Setup view
        $this->template->content = View::instance('v_tasks_edit');
        $this->template->title   = "Modify Tasks";

        # JS for sortable 
        $client_files_body = Array(
                        '/js/jquery.form.js',
                        '/js/tasks_edit.js',
                        '/js/tasks_create.js',
                        '/js/time_entry.js'
                        );
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Generate a new CSRF session token, and pass it to the View
        $this->template->content->token = NoCSRF::generate('token');

        # Render template
        echo $this->template;
    }

    public function p_findById() {
        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Get the task description of this task by task id
        $q = "SELECT tasks.task_description, tasks.task_id
                FROM `tasks`
               WHERE `task_id` = ".$_POST['task_id'];
 
        $task_data = DB::instance(DB_NAME)->select_row($q);
        if ($task_data == null) {
            echo 'Unknown task id - try again';
        } else {
            # Return the editing form with the existing task description
            $view = View::instance('v_tasks_form');
            $view->data = $task_data;
            echo $view;
        }
    }

    public function p_update() {
        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST); 

        if ($_POST['status'] == 'open')
            $_POST['status'] = 0;
        else
            $_POST['status'] = 1;

        # Update the user's data
         $count = DB::instance(DB_NAME)->update(
             'tasks', $_POST, "WHERE task_id = ".$_POST['task_id']);
        $data = Array();
        $data['task_id'] = $_POST['task_id'];
        $data['count'] = $count;
        echo json_encode($data);
    }
}