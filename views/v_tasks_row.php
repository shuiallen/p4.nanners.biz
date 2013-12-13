<li class="ui-state-default">
    <div class="id" id='task<?=$data['task_id']?>'><?=$data['task_id']?></div>
    <div class="description" id='taskdesc<?=$data['task_id']?>'>
        <?=$data['task_description']?>
    </div>
    <form>
		<select name="status">
			<option value="open">Open</option>
			<option value="close">Close</option>
		</select>
	</form>
</li>