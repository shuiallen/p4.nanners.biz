$(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
});

$('#insert-item').click(function() {
    var str = '<li class="ui-state-default">'+$('#list_item').val()+'</li>';
    $('#sortable').prepend(str);
    $('#add-item').resetForm();
    // todo: how do I get the cursor back into this form?
    $('#add-item').focus();
});

$('#save-list').click(function() {
	console.log ('got here');
	// take the contents of the ul
	// and the quicklist title
	var this_list_id = $('#quicklist-header').html();
	console.log(this_list_id);
	if (this_list_id == "") {
		console.log("id is null");
	    $.ajax({
	        type: 'POST',
	        url: '/quicklists/p_create',
	        success: function(response) { 
	            console.log("quicklist create success");
	            var data = $.parseJSON(response);
				$('#quicklist-header').html(data['quicklist_id']);
				$('#save-status').html("saved");
	        },
	        data: {
	            content : $('#sortable').html(),
	            title   : $('#quicklist-title').val()
	        }     
	    });
	} else {

		// todo handle updating the title
		// title should be required, need to validate that it was supplied
		//
	    $.ajax({
	        type: 'POST',
	        url: '/quicklists/p_update',
	        success: function(response) { 
	            console.log("quicklist update success");
	            var data = $.parseJSON(response);
				$('#save-status').html("updated " + data['modified']);
	        },
	        data: {
	            content        : $('#sortable').html(),
	            quicklist_id   : this_list_id
	        }     
	    });
	}



});
