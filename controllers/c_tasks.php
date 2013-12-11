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
                        '/js/tasks_index.js'
                        );
        $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Query for my tasks that are not done
        $q = "SELECT tasks.task_description, tasks.created
            FROM tasks
            INNER JOIN users
              ON tasks.user_id = users.user_id
            WHERE tasks.user_id = ".$this->user->user_id."
            AND tasks.done = false
              ORDER BY tasks.created DESC";

        # Store the result array in the variable $tasks
        $tasks = DB::instance(DB_NAME)->select_rows($q);

        # Pass tasks back to the view
        $this->template->content->tasks = $tasks;

        # Render template
        echo $this->template;
    }

    public function add() {
        # Setup view
        $this->template->content = View::instance('v_tasks_add');
        $this->template->title   = "Tasks";

        # JS for sortable 
        $client_files_body = Array(
                        '/js/jquery.form.js',
                        '/js/tasks_index.js'
                        );
        $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Query for my tasks that are not done
        $q = "SELECT tasks.task_description, tasks.task_id
            FROM tasks
            INNER JOIN users
              ON tasks.user_id = users.user_id
            WHERE tasks.user_id = ".$this->user->user_id."
            AND tasks.done = false
              ORDER BY tasks.created DESC";

        # Store the result array in the variable $tasks
        $tasks = DB::instance(DB_NAME)->select_rows($q);

        # Pass tasks back to the view
        $this->template->content->tasks = $tasks;

        # Render template
        echo $this->template;
    }

    public function p_add() {
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

        # Send back json results to the JS, formatted in json
        echo json_encode($data);

        # Do we need to retrieve the data we just stored?
        #$task_details = DB::instance(DB_NAME)->select_row('SELECT * FROM tasks WHERE task_id = '.$task_id);

        // # Set up the view
        // $view = View::instance('v_tasks_p_add');

        // # Pass data to the view
        // $view->task_description     = $_POST['task_description'];
        // $view->task_id = $task_id;

        // # Render the view
        // echo $view;     
    }
}