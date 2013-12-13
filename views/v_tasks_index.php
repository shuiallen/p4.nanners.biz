<!-- Click this button to get the new task form -->
<form>
    <input type='Submit' id='get-new-form' value='New task'>
</form>
<!-- This element will appear when adding a new task -->
<div class="newtask">

</div>

<!-- List all tasks -->
<div id=task_list>
    <ul id="sortable">

    <?php foreach($tasks as $task): ?>

        <?=$task['view']?>

    <?php endforeach; ?>

    </ul>
</div>



