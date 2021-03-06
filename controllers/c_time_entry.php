<?php
class time_entry_controller extends base_controller {


	public function p_create() {
        ProjectUtils::check_token($_POST, "create time entry");
        # If it doesn't fail, we can remove the token
        unset($_POST['token']);

        # Prevent SQL injection attacks by sanitizing the data the user entered in the form
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);


		if (empty($_POST['task_id'])) {
			$data['time_entry_id'] = 0;
	        $data['task_id']  = 0;
			echo json_encode($data);
			return;
		}
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

        $data = Array();
        # Associate this task with this user
        $data['user_id']  = $this->user->user_id;
        $data['task_id']  = $_POST['task_id'];
        # Calculate time spent in minutes from hours and minutes
        $data['time_spent'] = $_POST['hours']*60 + $_POST['mins'];

        # More data we want stored with the user
        $data['created']  = Time::now();
        $data['modified'] = Time::now();
    
        if (isset($_POST['date']))
            $data['date_of_work'] = strtotime($_POST['date']);
        else
            $data['date_of_work'] = Time::now();

        # Insert this task into the tasks table
        $time_entry_id = DB::instance(DB_NAME)->insert('time_entry', $data);

        $data['time_entry_id'] = $time_entry_id;
        echo json_encode($data);


	}
}