$(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
});

$('#find-qlist-form').click(function() {
    $('.search').show();
});

$('#find-qlist').click(function() {
    var options = {
	    type: 'POST',
	    url: '/quicklists/p_search',
	    success: function(response) { 
	        console.log("got quicklist search results");
	        var data = $.parseJSON(response);
			console.log(response);
			for (i = 0; i < data.length; i++) {
				console.log(data[i]['quicklist_id']);
				console.log(data[i]['title']);
		    	var content = data[i]['content'];
		    	if (content.length != 0) {
		    		content_arr = eval ("(" + content + ")");
	 		    	for (j = 0; j < content.length; j++) 
			    		console.log(content[j]);
		    	}

		    };
		}
   }
    $('.find-qlist-form').ajaxForm(options);
});

$('#insert-item').click(function() {
    var str = '<li class="ui-state-default">'+$('#list_item').val()+'</li>';
    $('#sortable').append(str);
    // An alternative is to insert the new item at the beginning of the list
    // But depends on the user, so this could be a configurable setting?
    // $('#sortable').prepend(str);
    $('#add-item').resetForm();
    // todo: how do I get the cursor back into this form? this line doesn't have any affect
    $('#list-item').focus();
});

$('#reset-list').click(function() {
    $('#sortable').html("");
    $('#view-quicklist').resetForm();
	$('#save-status').html("");
});


$('#print-list').click(function() {
	alert("Sorry, this is not implemented yet");
});

$('#save-list').click(function() {
	console.log("in save quick list");
	if ($('#quicklist-title').val().length == 0) {
		$('#save-status').html("Missing Title");
		return;
	};

	var this_list_id = $('#quicklist-header').html();
	console.log(this_list_id);
	if (this_list_id == "") {
		// This is a new list
	    $.ajax({
	        type: 'POST',
	        url: '/quicklists/p_create',
	        success: function(response) { 
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
	            var data = $.parseJSON(response);
				$('#save-status').html("updated " + data['modified']);
	        },
	        data: {
	            content        : $('#sortable').html(),
	            title          : $('#quicklist-title').val(),
	            quicklist_id   : this_list_id
	        }     
	    });
	}



});
