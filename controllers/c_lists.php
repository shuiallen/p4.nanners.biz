<?php
class lists_controller extends base_controller {
    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        Router::redirect('/lists/mylists');
    }

    public function mylists() {

        # Setup view
        $this->template->content = View::instance('v_lists_mylists');
        $this->template->title   = "My To Do Lists";

        # Add JS to page
        $client_files_body = ['/js/lists.js'];
        $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Render template
        echo $this->template;

    }

}