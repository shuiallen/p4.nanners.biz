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
<form>
	<label for='time_task_id'>Task Id</label><br>
	<input type="text" name='task_id' id='time_task_id'><br>
	<label for='work_date'>Date worked</label>
	<input type="datetime" name="work_date"><br>
	<label for='hours_worked'>Hours</label>
	<input type="number" name="hours" min="0" value=0><br>
	<label for='hours_worked'>Minutes</label>
	<input type="number" name="hours" value=0 min="0" max="50" step=10>
</form>
<div class="newtask" id='new-div'>

</div>

<hr>
<p> Create a new task</p>
<form>
    <input type='Submit' id='get-new-form' value='New task'>
</form>
<div class="newtask" id='new-div'>

</div>