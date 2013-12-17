$(function() {

	$(document).ready( function () {
		$('#te-table').dataTable( {
					"aaSorting": [[ 1, "asc" ]]
				});
	});
});



$('#find-te-for-task').click(function() {
	console.log("clicked find time entries");
 // Call the server to get the view fragment that will display the task editor form
    var options = {
        type: 'POST',
        url: '/reports/p_time_entries_by_id',
        success: function(response) {
 			console.log(response);
        },
        resetForm: true  
    }
    //$('#find-te-by-task-form').ajaxForm(options);
        $('form').ajaxForm(options);

	// // Clear table previously displayed
	// $('#te-table').dataTable().fnClearTable();

	// // Iterate over the bib assignment divs to insert rows in the table body
	// $('#pairs').children('div').each(function () {
	// 	if ($(this).children().length > 0) {
	// 		var thisRacer = $(this).find(".racer").html();
	// 		var thisBib   = $(this).find(".bib").html();
	// 		$('#roster-table').dataTable().fnAddData( [
	// 			thisBib,
	// 			thisRacer]);
	// 	}
	// });

});


