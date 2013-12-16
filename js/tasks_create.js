$('#get-new-form').click(function() {
    console.log("in get-new-form");
    // Call the server to get the view fragment'
    var options = {
        type: 'POST',
        url: '/tasks/p_newform',
        success: function(response) { 
            console.log(response);
           $('.newtask').html(response);
        },  
    }
    $('#new-task-button-form').ajaxForm(options);
    // display it now
    $( ".newtask" ).show();
});

// The #create-task element is created on demand
// So we have to use a delegated event to attach the event handler to its parent div element which has class .newtask
// In this version, I use $.ajax to call p_create
// This requires passing the data - #new_task_description
// Problem: 
// If I want to pass the CSRF token, I am not able to reference it, I get an error
//     Uncaught InvalidStateError: An attempt was made to use an object that is not, or is no longer, usable. 
// I am able to output #new-task-form-token to console
// but the error occurs passing the token in the ajax call
// See below for the alternative form using ajaxForm - in this case, the call does not work at all
 $('.newtask').on("click", '#create-task', function() {
    console.log('in create-task');
    console.log($('#new_task_description').val());
    //     console.log($('#new-task-form-token'));
    // Hide this now
    $( ".newtask" ).hide();

    // Create the task and add it to the list
    $.ajax({
        type: 'POST',
        url: '/tasks/p_create',
        success: function(response) { 
            console.log("create-task success");
           $('#sortable').prepend(response);
        },
        data: {
            task_description : $('#new_task_description').val(),
//            token           : $('#new-task-form-token')
        }     
    });

    console.log('return from server create-task');
    // Clear the contents of the new task element
    $('.newtask').html("");
});

// Attempt to use the .ajaxForm to call the server, does not work
// I want to use this way so I don't have to explicitly pass the CSRF token
// But this doesn't work, I haven't figured out why

//  $('.newtask').on("click", '#create-task', function() {
//     console.log('in create-task');
//     console.log($('#new_task_description').val());
//     console.log($('#new-task-form-token'));
//     // Hide this now
//     $( ".newtask" ).hide();

//     // Create the task and add it to the list
//     var options = {
//         type: 'POST',
//         url: '/tasks/p_create',
//         success: function(response) { 
//             console.log("create-task success");
//            $('#sortable').prepend(response);
//         }
//     }
//     $('#new-task-form').ajaxForm(options);
//     console.log('return from server create-task');
//     // Clear the contents of the new task element
//     $('.newtask').html("");
// });




$('.newtask').on("click", '#cancel-create', function() {
    $('.newtask').html("");
    $( ".newtask" ).hide();
});


