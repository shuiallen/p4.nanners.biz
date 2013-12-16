<!-- Click this button to get the new task form -->
<form id='new-task-button-form'>
    <input type='hidden' name='token' value='<?=$token?>'>
    <input type='Submit' id='get-new-form' value='New task'>
</form>
<!-- This element will appear when adding a new task -->
<div class="newtask" id='newtask-div'>

</div>
<hr>

<div>
	<h1> All tasks view </h1>
	<p> Rearrange the task list by dragging the entries</p>
	<form id='print-task-list-form'>
		<!-- This form is not going to the server so not including hidden token here -->
		<input type='Submit' id='print-task-list' value='Print Task list'>
	</form>
</div>

<!-- List all tasks -->
<div id='task_list'>
	<h1>Open tasks</h1>
    <ul id="sortable">

    <?php foreach($tasks as $task): ?>

        <?=$task['view']?>

    <?php endforeach; ?>

    </ul>
</div>



