<?php
class reports_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        # Setup view
        $this->template->content = View::instance('v_reports');
        $this->template->title   = "Reports";

			$client_files_head = Array("js/DataTables/media/css/demo_table.css");
	    	$this->template->client_files_head = Utils::load_client_files($client_files_head);
        // this needs to be included but i don't know where/how yet
	// <style type="text/css" title="currentStyle">
	//   @import "js/DataTables/media/css/demo_table.css";
	// </style>
        # JS for sortable 
        $client_files_body = Array(
        				'js/DataTables/media/js/jquery.dataTables.js',
                        '/js/jquery.form.js',
                        '/js/reports.js'
                        );
        $this->template->client_files_body = Utils::load_client_files($client_files_body);

        # Generate a new CSRF session token, and pass it to the View
        $this->template->content->token = NoCSRF::generate('token');

        # Render template
        echo $this->template;
    }


	public function p_time_entries_by_id() {
		ProjectUtils::check_token($_POST, "find time entries by task id");
	    # If it doesn't fail, we can remove the token
	    unset($_POST['token']);

	    # Prevent SQL injection attacks by sanitizing the data the user entered in the form
	    $_POST = DB::instance(DB_NAME)->sanitize($_POST);

		// # See if this task exists
	    $q = "SELECT tasks.task_id
	            FROM `tasks`
	           WHERE `task_id` = ".$_POST['task_id'];

	    $task_data = DB::instance(DB_NAME)->select_row($q);
	    if ($task_data == null) {
			$data['time_entry_id'] = -1;
	        $data['task_id']  = $_POST['task_id'];
			echo json_encode($data);
			return;
		}

		// Find time entries for this task id and the user who recorded the entry
		$q = 'SELECT 
	            time_entry.date_of_work,
	            time_entry.time_spent,
	            time_entry.task_id,
	            tasks.task_description,
				users.first_name,
				users.last_name
	        FROM time_entry
            INNER JOIN users
				ON time_entry.user_id = users.user_id
	        INNER JOIN tasks 
	            ON time_entry.task_id = tasks.task_id
	        WHERE time_entry.task_id ='.$_POST['task_id'];

	    $entries = DB::instance(DB_NAME)->select_rows($q);

        foreach($entries as $key => $entry) {
            // XSS prevention on output
            $entry['task_description'] = ProjectUtils::clean($entry['task_description']);
            // Get nice date format
			$entry['date_of_work'] = Time::display($entry['date_of_work'], "M d Y");
			// Get nice user name
			$entry['user'] = $entry['first_name']." ".$entry['last_name'];
			$total_mins = $entry['time_spent'];
			$mins = $total_mins % 60;
			$hrs = ($total_mins - $mins) / 60;

			$entry['time_spent'] = $hrs.":".$mins;
			unset($entry['first_name']);
			unset($entry['last_name']);
			// Convert time spent to hours:minutes

			$entries[$key] = $entry;
        }
		echo json_encode($entries);
	}

}  # eoc