<div id=task_list>
    <ul id="sortable">

    <?php foreach($tasks as $task): ?>

        <li class="ui-state-default"><?=$task['task_description']?></li>

    <?php endforeach; ?>

    </ul>
</div>


<div class=newtask>
    <p> Add a task </p>
    <form method='POST' action='/tasks/p_add'>
        <label for='task_description'>Task Description</label>
        <textarea name='task_description' id='task_description' rows="2" cols="80" wrap=hard
            autofocus required></textarea>
        <input type='Submit' id='create-task' value='Submit'>
    </form>
</div>
