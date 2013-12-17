<p>Find time entries for a task</p>

<form id='find-te-by-task-form'>
    <input type='hidden' name='token' value='<?=$token?>'>
	<label for='te_for_task_id'>Task Id</label><br>
	<input type="text" name='task_id' id='te_for_task_id' required>
    <input type='Submit' id='find-te-for-task' value='Find'>
</form>

<div class='time-entry-section' id='te-for-task'>
    <table id="te-table" class="display" >
	    <thead>
			<tr>
				<th>Date</th>
				<th>Time Spent</th>
				<th>User</th>
			</tr>
	    </thead>
	    <tbody id='te-table-body'>

	    </tbody>
    </table>
</div>
<div class='status' id='edittask-status'>
	Update Task <span id='status_task_id'></span><br>
</div>
<hr>