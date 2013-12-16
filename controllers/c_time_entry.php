<?php
class time_entry_controller extends base_controller {


	public function p_create() {
        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

		# See if this task exists
        $q = "SELECT tasks.task_id
                FROM `tasks`
               WHERE `task_id` = ".$_POST['task_id'];

        $task_data = DB::instance(DB_NAME)->select_row($q);
        if ($task_data == null) {
        	echo 'Bad task id';

        $data = Array();
        # Associate this task with this user
        $data['user_id']  = $this->user->user_id;
        $data['task_id']  = $_POST['task_id'];
        # Calculate time spent in minutes from hours and minutes
        $data['time_spent'] = $_POST['hours']*60 + $_POST['mins'];

        # More data we want stored with the user
        $data['created']  = Time::now();
        $data['modified'] = Time::now();
    
        $data['date_of_work'] = strtotime($_POST['date']);

        # Insert this task into the tasks table
        $time_entry_id = DB::instance(DB_NAME)->insert('time_entry', $data);
 		echo 'inserted time entry';

        $data['time_entry_id'] = $time_entry_id;
 

        // $view = View::instance('v_time_entry_row');
        // $view->data = $data;

        // echo $view;


	}
}