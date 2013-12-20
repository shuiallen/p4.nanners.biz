<div id='search-quick-list'>
		<form id='find-qlist-button-form'>
		    <input type='hidden' name='token' value='<?=$token?>'>
			<input type='button' id='find-qlist-form' value='Find a list'>
		</form>
	<div class="search">
		<form class='find-qlist-form'>
		    <input type='hidden' name='token' value='<?=$token?>'>
			<label for='qlist_id'>Quicklist Id</label>
			<input type="text" name='quicklist_id' id='qlist_id'>
			<label for='qlist_title'>Title (contains)</label>
			<input type="text" name='title' id='qlist_title' size="50">
		    <input type='Submit' id='find-qlist' value='Find'>
		</form>
	</div>
	<div class='results'>
	    <table id="ql-results-table" class="display">
		    <thead>
				<tr>
					<th>Id</th>
					<th>Title</th>
					<th>Created</th>
				</tr>
		    </thead>
		    <tbody id='ql-results-table-body'>

		    </tbody>
	    </table>
	</div>
</div>
<hr>
<div id=task_list>
	<form id='view-quicklist'>
		<label for='list-title'>Quick List Title</label>
		<input type='text' name='title' id='quicklist-title'>
		<!-- I would like to put these buttons on the right side -->
		<input type='button' id='print-list' value='Print list'>
		<input type='button' id='save-list' value='Save list'>
		<input type='button' id='reset-list' value='Reset'>

	</form>
	<div>QuickList Id: <span id='quicklist-header'></span> 	<span id='save-status'></span>
	</div>
	</br>
	<div id='quicklist-items'>

		<form id='add-item'>
			<label for='list_item'>Quick List Item</label>
			<textarea name='list_item' id='list_item' rows="2" cols="80" wrap=hard autofocus required></textarea>
			<input type='button' id='insert-item' value='Enter'>
		</form>

	    <ul id="sortable">
	    </ul>

	</div>
	

	<br/>



</div>
