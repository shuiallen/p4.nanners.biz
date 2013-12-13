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
            $tasks[$key]['view'] = View::instance('v_tasks_row');
            $tasks[$key]['view']->data = $task;
        }

        # Pass tasks back to the view
        $this->template->content->tasks = $tasks;

        # Render template
        echo $this->template;
    }

    public function p_newform() {
        $view = View::instance('v_tasks_form');
 
        $data = Array();
        # There is no task_id for a new task yet
        $data['task_id'] = 0;
        $data['task_description'] = "";
        $view->data = $data;
        echo $view;
    }

    public function p_create() {
        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Associate this task with this user
        $_POST['user_id']  = $this->user->user_id;

        # More data we want stored with the user
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();
        $_POST['done'] = false;  // New task is not done
                
        # Insert this task into the tasks table
        $task_id = DB::instance(DB_NAME)->insert('tasks', $_POST);
 
        $data = Array();
        $data['task_id'] = $task_id;
        $data['task_description'] = $_POST['task_description'];

        $view = View::instance('v_tasks_row');
        $view->data = $data;

        echo $view;

        # Do we need to retrieve the data we just stored?
        #$task_details = DB::instance(DB_NAME)->select_row('SELECT * FROM tasks WHERE task_id = '.$task_id);
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
                        '/js/tasks_create.js'
                        );
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

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

        # Return the editing form with the existing task description
        $view = View::instance('v_tasks_form');
        $view->data = $task_data;
        echo $view;

        // try sending back with json
        // $data = Array();
        // $data['task_id'] = $_POST['task_id'];
        // $data['task_description'] = $task_description;

        // echo json_encode($data);

    }

    public function p_update() {
        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST); 
        $data = Array();
        $data['task_description'] = $_POST['task_description'];
        $data['task_id'] = $_POST['task_id'];

        if ($_POST['status'] == 'open')
            $_POST['status'] = 0;
        else
            $_POST['status'] = 1;

        # Update the user's data
         $count = DB::instance(DB_NAME)->update(
             'tasks', $_POST, "WHERE task_id = ".$_POST['task_id']);

        if ($count == 1)
            echo $_POST['task_description'];
        else
            echo 'failed '.$count;

    }
}