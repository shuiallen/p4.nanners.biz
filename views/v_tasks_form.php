

<?php if ($data['task_id'] != 0): ?>
    <div class="id"><?=$data['task_id']?></div>
<?php endif; ?>

    <form>
        <textarea name='task_description' id='task_description' rows="2" cols="80" wrap=hard autofocus required>
            <?=$data['task_description']?>
        </textarea>
<?php if ($data['task_id'] != 0): ?>
        <input type='Submit' id='update-task' value='Update'>
<?php else: ?>
        <input type='Submit' id='create-task' value='Save'> 
<?php endif; ?>
        <input type='Submit' id='cancel-edit' value='Cancel'> 
    </form>
