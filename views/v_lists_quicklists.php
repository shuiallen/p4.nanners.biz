

<div id=task_list>
	<label for='list-title'>Quick List Title</label>
	<input type='text' name='list_name' id='list-title' required>

    <ul id="sortable">
    </ul>

	<form id='add-item'>
		<label for='list_item'>Quick List Item</label>
		<textarea name='list_item' id='list_item'
				rows="2" cols="80" wrap=hard autofocus required>
		</textarea>
		<input type='button' id='insert-item' value='Enter'>
	</form>

	<input type='button' id='create-tasks' value='Create tasks from list items'>
	<input type='button' id='print-list' value='Print list'>
	<input type='button' id='save-list' value='Save list'>

</div>
