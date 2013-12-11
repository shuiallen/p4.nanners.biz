

<div id=task_list>
    <ul id="sortable">

    <?php foreach($tasks as $task): ?>

        <li class="ui-state-default"><?=$task['task_description']?></li>

    <?php endforeach; ?>

    </ul>
</div>
