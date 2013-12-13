$('#get-new-form').click(function() {
    // Call the server to get the view fragment'
    var options = {
        type: 'POST',
        url: '/tasks/p_newform',
        success: function(response) { 
            console.log(response);
           $('.newtask').html(response);
        },  
    }
    $('form').ajaxForm(options);
    // display it now
    $( ".newtask" ).show();
});

// The #create-task element is created on demand
// So we have to use a delegated event to attach the event handler to its parent div element which has class .newtask
$('.newtask').on("click", '#create-task', function() {
    console.log('in create-task');
    console.log($('#task_description').val());
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
            task_description : $('#new_task_description').val()
        }     
    });

    console.log('return from server create-task');
    // Clear the contents of the new task element
    $('.newtask').html("");
});

$('.newtask').on("click", '#cancel-create', function() {
    $('.newtask').html("");
    $( ".newtask" ).hide();
});


