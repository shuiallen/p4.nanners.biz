<p> Edit an existing task </p>
<form id='edit-task-form'>
	<label for='task_id'>Task Id</label><br>
	<input type="text" name='task_id' id='task_id'>
    <input type='Submit' id='find-task' value='Find'>
</form>
<div class='edittask' id='edit-div'>

</div>
<hr>
<p> Create a time entry</p>
<form id='new-time-entry'>
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
<hr>
<div class='applet'>
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
</div>

<hr>
<p> Create a new task</p>
<form id='new-task-form'>
    <input type='Submit' id='get-new-form' value='New task'>
</form>
<div class="newtask" id='new-div'>

</div>