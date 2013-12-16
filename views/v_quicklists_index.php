

<div id=task_list>
	<form id='view-quicklist'>
		<input type='button' id='print-list' value='Print list'>
		<input type='button' id='save-list' value='Save list'>
		<br/>
		<label for='list-title'>Quick List Title</label>
		<input type='text' name='title' id='quicklist-title' required>
	</form>
	<div id='quicklist-header'></div>
	<div id='save-status'></div>
	<div id='quicklist-items'>
	    <ul id="sortable">
	    </ul>

		<form id='add-item'>
			<label for='list_item'>Quick List Item</label>
			<textarea name='list_item' id='list_item'
					rows="2" cols="80" wrap=hard autofocus required>
			</textarea>
			<input type='button' id='insert-item' value='Enter'>
		</form>
	</div>
	
	<hr>

	<input type='button' id='find-list' value='Find a list'>
	<div class="search">

	</div>
	<br/>



</div>
