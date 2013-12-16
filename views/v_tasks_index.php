<!-- Click this button to get the new task form -->
<form id='new-task-button-form'>
    <input type='hidden' name='token' value='<?=$token?>'>
    <input type='Submit' id='get-new-form' value='New task'>
</form>
<!-- This element will appear when adding a new task -->
<div class="newtask" id='newtask-div'>

</div>

<!-- List all tasks -->
<div id=task_list>
    <ul id="sortable">

    <?php foreach($tasks as $task): ?>

        <?=$task['view']?>

    <?php endforeach; ?>

    </ul>
</div>



