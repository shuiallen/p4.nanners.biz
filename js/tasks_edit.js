$('#find-task').click(function() {
    // Call the server to get the view fragment that will display the task editor form
    var options = {
        type: 'POST',
        url: '/tasks/p_findById',
        success: function(response) {
            $('#edit-div').html(response);
            // display it now
            $( "#edit-div" ).show();
            $('#status_task_id').hide();
        },
        resetForm: true  
    }
    $('#edit-task-form').ajaxForm(options);

});

$('#edit-div').on("click", '#cancel-update', function() {
    // Clear the form
    $('.edittask').html("");
	// Hide the element containing the form
    $('.edittask').hide();
});

$('#edit-div').on("click", '#update-task', function() {
	var options = {
        type: 'POST',
        url: '/tasks/p_update',
        success: function(response) { 
            console.log('in update success!');
            console.log(response);
            var data = $.parseJSON(response);
            var status = data['task_id'];
            if (data['count']==1)
                status += ' succeeded';
            else
                status += ' failed';
            console.log(status);
            $('#status_task_id').html(status);
            $('#status_task_id').show();
            $('#edittask-status').show();

	        // Clear the form
		    $('.edittask').html("");
			// Hide the element containing the form
		    $('.edittask').hide();
        },
        error: function() {
            console.log('failed message');
        }
	}
	$('form').ajaxForm(options);
});

