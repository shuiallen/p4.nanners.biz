<?php
class projects_controller extends base_controller {
    public function __construct() {
        parent::__construct();
    } 

    public function index() {
    
        # Set up the View
        $this->template->content = View::instance('v_projects_index');
        $this->template->title   = "Projects";

        # Query to find projects I belong to
        $q = 'SELECT 
                projects.project_name,
                projects.created,
                users_projects.user_id AS member_id,
                users.first_name,
                users.last_name
            FROM projects
            INNER JOIN users_projects
                ON projects.project_id = users_projects.project_id
            INNER JOIN users 
                ON users.user_id = users_projects.user_id
            WHERE users_projects.user_id = '.$this->user->user_id;

        # Run the query
        $myprojects = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
        $this->template->content->myprojects = $myprojects;

        # Query to find other projects to join - or make this an option on the page with a clickable button 
        # to do the search on demand

        # Render the View
        echo $this->template;
    }

    public function add($error = NULL) {

        # Setup view
        $this->template->content = View::instance('v_projects_add');
        $this->template->title   = "Add a Project";

        # Pass data to the view
        $this->template->content->error = $error;

        # Not sure we need this yet
        // $client_files_head = ['/css/projectscss'];
        // $this->template->client_files_head = Utils::load_client_files($client_files_head);

        # Add JS to page
        // $client_files_body = ['/js/projects.js'];
        // $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Render template
        echo $this->template;
    }
}