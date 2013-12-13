<p> Edit an existing task </p>
<form>
	<label for='task_id'>Task Id</label><br>
	<input type="text" name='task_id' id='task_id'>
    <input type='Submit' id='find-task' value='Find'>
    <br>
    <textarea name='task_description' id='task_description' rows="2" cols="80" wrap=hard autofocus required>
    </textarea>
    <input type='Submit' id='update-task' value='Update'>
    <input type='Submit' id='cancel-edit' value='Cancel'>  
</form>
<div  id='edit-div'>

</div>

<hr>
<p> Create a new task</p>
<form>
    <input type='Submit' id='get-new-form' value='New task'>
</form>
<div class="newtask" id='new-div'>

</div>