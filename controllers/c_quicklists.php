<?php
class quicklists_controller extends base_controller {

    public function index() {
        # Setup view
        $this->template->content = View::instance('v_quicklists_index');
        $this->template->title   = "QuickLists";

        # Add JS to page
        $client_files_body = Array(
                        '/js/jquery.form.js',
                        '/js/quicklists.js'
                        );
        $this->template->client_files_body = Utils::load_client_files($client_files_body);   

        # Render template
        echo $this->template;

    }

    public function p_create() {
        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Associate this quicklist with this user
        $_POST['user_id']  = $this->user->user_id;

        # More data we want stored with the user
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();
                
        # Insert the quicklist
        $quicklist_id = DB::instance(DB_NAME)->insert('quicklists', $_POST);
 
        $data = Array();
        $data['quicklist_id'] = $quicklist_id;
        echo json_encode($data);
    }

        public function p_update() {
        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        $_POST['modified'] = Time::now(); 

        # Update the user's data
         $count = DB::instance(DB_NAME)->update(
             'quicklists', $_POST, "WHERE quicklist_id = ".$_POST['quicklist_id']);
        unset($_POST['content']);
        echo json_encode($_POST);
 
    }


    public function p_searchform() {
        $view = View::instance('v_quicklists_search_form');

        echo $view;
    }

}