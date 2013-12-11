<?php
class lists_controller extends base_controller {
    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        Router::redirect('/lists/mylists');
    }

    public function mylists($error = NULL) {

        # Setup view
        $this->template->content = View::instance('v_lists_mylists');
        $this->template->title   = "My To Do Lists";

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

    public function quicklists() {
        # Setup view
        $this->template->content = View::instance('v_lists_quicklists');
        $this->template->title   = "Create a quick list";

        # Add JS to page
        $client_files_body = ['/js/jquery.form.js','/js/quicklists.js'];
        $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Render template
        echo $this->template;

    }
}