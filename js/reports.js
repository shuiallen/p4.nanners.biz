$(function() {

	$(document).ready( function () {
	});
});



$('#find-te-for-task').click(function() {
	console.log("clicked find time entries");
 // Call the server to get the view fragment that will display the task editor form
    var options = {
        type: 'POST',
        url: '/reports/p_time_entries_by_id',
        success: function(response) {
            var data = $.parseJSON(response);
            console.log(data);
            $('#te-table').dataTable().fnDestroy();
			$('#te-table').dataTable( {
					"aaSorting": [[ 1, "asc" ]],
					"aoColumns": [
				        { "mData": "date_of_work" },
				        { "mData": "time_spent" },
				        { "mData": "user" },
				        { "mData": "task_description" },
				        { "mData": "task_id" },
				    ],
					"aaData": data
				});
        	$('#te-table').show();
        },
        resetForm: true  
    }
    //$('#find-te-by-task-form').ajaxForm(options);
        $('form').ajaxForm(options);
});


