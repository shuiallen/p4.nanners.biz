<form id='new-task-form'>
<?php if ($data['task_id'] != 0): ?>
	<label for='task<?=$data['task_id']?>'>Task Id</label><br>
    <input type='text' name='task_id' id='task<?=$data['task_id']?>' value=<?=$data['task_id']?> readonly>
    <br>
<?php endif; ?>

<?php if ($data['task_id'] != 0): ?>
    <textarea name='task_description' id='edit_task_description' rows="2" cols="80" wrap=hard autofocus required><?=$data['task_description']?></textarea>
<?php else: ?>
    <textarea name='task_description' id='new_task_description' rows="2" cols="80" wrap=hard autofocus required><?=$data['task_description']?></textarea>
<?php endif; ?>


<?php if ($data['task_id'] != 0): ?>
	<br>
	<select name="status">
		<option value="open" <?php if ($data['status'] == '0'): ?>selected<?php endif; ?>>Open</option>
		<option value="close" <?php if ($data['status'] == '1'): ?>selected<?php endif; ?>>Closed</option>
	</select>
	<br>
    <input type='Submit' id='update-task' value='Update'>
	<input type='Submit' id='cancel-update' value='Cancel'> 
<?php else: ?>
    <input type='Submit' id='create-task' value='Save'> 
	<input type='Submit' id='cancel-create' value='Cancel'> 
<?php endif; ?>

</form>
