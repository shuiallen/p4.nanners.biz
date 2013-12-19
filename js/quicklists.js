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
    $('#sortable').prepend(str);
    $('#add-item').resetForm();
    // todo: how do I get the cursor back into this form?
    $('#add-item').focus();
});

$('#reset-list').click(function() {
    $('#sortable').html("");
    $('#view-quicklist').resetForm();
	$('#save-status').html("");
});

$('#save-list').click(function() {
	console.log ('got here');
	// take the contents of the ul
	var items = new Array();
	var i = 0;
	$('#sortable').children('li').each(function () {
		console.log($(this).html());
		items[i++] = $(this).html();
	});
	console.log(items);
	console.log(JSON.stringify(items));
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
