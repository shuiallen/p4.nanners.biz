<?php
class tasks_controller extends base_controller {
    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        Router::redirect('/tasks/add');
    }

    public function add($error = NULL) {

        # Setup view
        $this->template->content = View::instance('v_tasks_add');
        $this->template->title   = "Add a Task";

        # Pass data to the view
        $this->template->content->error = $error;

        # Not sure we need this yet
        $client_files_head = [''];
        $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Add JS to page
        $client_files_body = ['/js/lists.js'];
        $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Render template
        echo $this->template;

    }
}