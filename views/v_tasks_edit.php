<p> Edit an existing task </p>
<form id='edit-task-form'>
    <input type='hidden' name='token' value='<?=$token?>'>
	<label for='task_id'>Task Id</label><br>
	<input type="text" name='task_id' id='task_id' required>
    <input type='Submit' id='find-task' value='Find'>
</form>
<div class='edittask' id='edit-div'>

</div>
<div class='status' id='edittask-status'>
	Update Task <span id='status_task_id'></span><br>
</div>
<hr>
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
<p> Create a time entry</p>
<form id='new-time-entry'>
    <input type='hidden' name='token' value='<?=$token?>'>
	<label for='time_task_id'>Task Id</label><br>
	<input type="text" name='task_id' id='time_task_id' required>
	<label for='date'>Date worked</label>
	<input type="date" name="date" required>
	<label for='hours_worked'>Hours</label>
	<input type="number" name="hours" min="0" value=0>
	<label for='hours_worked'>Minutes</label>
	<input type="number" name="mins" value=0 min="0" max="50" step=10>
    <input type='Submit' id='create-time-entry' value='Save'>
</form>
<div class='status' id='new-time-entry-status'>
	Time Entry (<span id='time_entry_id'></span>) for Task <span id='te_task_id'></span> <span id='te_status'></span><br>
</div>
<hr>
<div class='applet'>
	<form id='timer-entry'>
	    <input type='hidden' name='token' id='timer-token' value='<?=$token?>'>
	    <h1>Task Timer</h1>
	    <p>Use stopwatch to capture time worked and assign to task</p>
		<label for='timer_task_id'>Task Id</label><br>
		<input type="text" name='task_id' id='timer_task_id' required>
		<br/>
		<br/>
	    <span id="sw_h">00</span>:
	    <span id="sw_m">00</span>:
		<span id="sw_s">00</span>:
		<span id="sw_ms">00</span>
	    <br/>
	    <br/>
	    <input type="button" value="Start" id="sw_start" />
	    <input type="button" value="Pause" id="sw_pause" />
	    <input type="button" value="Stop"  id="sw_stop" />
	    <input type="button" value="Reset" id="sw_reset" />
	    <br/>
	    <br/>
	    <span id="sw_status">Idle</span>
	    <br/>
	    <br/>
	    <input type="button" value="Record Time" id="record" />
    </form>
    <div class='status' id='timer-entry-status'>
	Time Entry (<span id='tte_id'></span>) for Task <span id='tte_task_id'></span> <span id='tte_status'></span><br>
</div>
</div>

<hr>
<!-- This does repeat the view fragment from v_tasks_index and should be refactored to eliminate this -->
<p> Create a new task</p>
<form id='new-task-button-form'>
    <input type='hidden' name='token' value='<?=$token?>'>
    <input type='Submit' id='get-new-form' value='New task'>
</form>
<div class="newtask" id='newtask-div'>

</div>
<div id='newtask-status'>
</div>