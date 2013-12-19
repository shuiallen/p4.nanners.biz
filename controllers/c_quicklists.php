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

        # Generate a new CSRF session token, and pass it to the View
        $this->template->content->token = NoCSRF::generate('token');

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
        $_POST['modified'] = Time::display($_POST['modified'], "M d Y");
        echo json_encode($_POST);
 
    }

    public function p_search() {
        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        $where = "WHERE ";
        // Find quicklists based on POST criteria
        // Quicklist id or title fragment
        if ($_POST['quicklist_id'] != "") {
            $where = $where.'quicklists.quicklist_id ='.$_POST['quicklist_id'];
            $and = "AND ";
        };
        if ($_POST['title'] != "") {
            if (isset($and)) 
                $Where = $where.$and;
            $where = $where.'quicklists.title LIKE "%'.$_POST['title'].'%"';           
        };
        $q = 'SELECT
                quicklists.quicklist_id,
                quicklists.title,
                quicklists.content
            FROM quicklists '.$where;

        $lists = DB::instance(DB_NAME)->select_rows($q);

        foreach($lists as $key => $list) {
            // XSS prevention on output
            $list['title'] = ProjectUtils::clean($list['title']);
            // The content is a list of <li> elements created when adding quick list items
            // Is cleaning it with the element annotations valid?
//            $list['content'] = ProjectUtils::clean($list['content']);
            $lists[$key] = $list;
        }
        echo json_encode($lists);


    }

}