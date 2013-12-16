$('#find-task').click(function() {
    // Call the server to get the view fragment that will display the task editor form
    var options = {
        type: 'POST',
        url: '/tasks/p_findById',
        success: function(response) {
        	console.log('response from find task should be a view fragment') ;
            console.log('+');
            console.log(response);
            console.log('+');
           $('#edit-div').html(response);
           // display it now
           $( "#edit-div" ).show();
        },  
    }
    $('#edit-task-form').ajaxForm(options);


});

$('#edit-div').on("click", '#cancel-update', function() {
	console.log('clicked cancel on edit');
    // Clear the form
    $('.edittask').html("");
	// Hide the element containing the form
    $('.edittask').hide();
});

$('#edit-div').on("click", '#update-task', function() {
    console.log('clicked update button');

	var options = {
        type: 'POST',
        url: '/tasks/p_update',
        success: function(response) { 
            console.log('in update success!');
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



// Code from here down doesn't work yet
// The #update-task element is created on demand
// So we have to use a delegated event to attach the event handler to its parent div element which has class .newtask
// $('.edittask').on("click", '#update-task', function() {
//     console.log('clicked update button');
//     console.log($(this));
//     console.log('desc');
//     console.log($('#task_description').val());
//     console.log('id ?');
//     console.log($('#edit-div').first());
//     console.log("calling");
//     // Get the task id and the task description
//     // Call the server to 
//     $.ajax({
//         type: 'POST',
//         url: '/tasks/p_newupdate',
//         success: function(response) { 
//             console.log('in update success!');
//             console.log(response);
//             // var data = $.parseJSON(response);
//             // console.log(data);
//             // find the 
//             var div_desc = $('#task_description');
//             // modify the html of this div with the new task description
//             div_desc.html(response);
//             // Clear the form
// 		    //$('.edittask').html("");
// 		    // Hide the element containing the form
// 		    //$('.edittask').hide();
//         },
//         error: function() {
//             console.log('failed message');
//         },
//         data: {
//             task_description : $('#task_description').val(),
//             task_id : $('.edittask').first().html()
//         }      
//    });

// });




$('#sortable').on("click", '#save-task', function() {
    console.log('in save-task');
    var li = $(this).closest('li');
    var tid = $li.first().html();
    console.log($tid);

    $.ajax({
        type: 'POST',
        url: '/tasks/p_edit',
        success: function(response) { 
            console.log('edit success!');
            console.log(response);
            var data = $.parseJSON(response);
            console.log(data);
            // find the 
            var div_desc = $li.first().next();
            console.log(div_desc.html(data["task_description"]));
            // modify the html of this div with the new task description
            div_desc.html(data["task_description"]);
            div_desc.show();
            div_desc.next().hide();
        },
        error: function() {
            console.log('failed');
        },
        data: {
            task_description : $('#task_description').val(),
            task_id : $(this).closest('li').first().html()
        }      
   });
    $('form').ajaxForm(options);  
});
