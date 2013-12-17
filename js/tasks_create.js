$('#print-task-list').click(function() {
    // Goal: Put the task list in a new tab that can be printed
    var contents = $('#task_list').prop('outerHTML');

    // For the new tab, we need to basically construct all the pieces we need for any HTML page starting with a start <html> tag.
    var new_tab_contents  = '<html>';
    
    // (Note the += symbol is used to add content onto an existing variable, so basically we're just adding onto our new_tab_contents variable one line at a time)
    new_tab_contents += '<head>';
    // TODO : figure out what the CSS should be for this output
    new_tab_contents += '<link rel="stylesheet" href="css/main.css" type="text/css">'; // Don't forget your CSS so the card looks good in the new tab!
    new_tab_contents += '<link rel="stylesheet" href="css/features.css" type="text/css">';
    new_tab_contents += '</head>';
    new_tab_contents += '<body>'; 
    new_tab_contents += contents; 
    new_tab_contents += '</body></html>';
    
    // Ok, our list is ready to go, we just need to work on opening the tab
    
    // Here's how we tell JavaScript to create a new tab (tabs are controlled by the "window" object).
    var new_tab =  window.open();

    // Now within that tab, we want to open access to the document so we can make changes
    new_tab.document.open();
    
    // Here's the change we'll make: we'll write our card (i.e., new_tab_contents) to the document of the tab
    new_tab.document.write(new_tab_contents);
    
    // Then close the tab. This isn't actually closing the tab, it's just closing JS's ability to talk to it.
    // It's kind of like when you're talking to a walkie-talkie and you say "over and out" to communicate you're done talking
    new_tab.document.close();
            
});


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


