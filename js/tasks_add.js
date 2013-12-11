$(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

    // loadTasks($tasks);
});

$('#create-task').click(function() {
    var options = {
        type: 'POST',
        url: '/tasks/p_add',
        success: function(response) { 
            alert ('got here');
            var data = $.parseJSON(response);
            var str = '<li class="ui-state-default">'.$data["task_description"].'</li>';
            $('#sortable').prepend(str);            // prepend the new <li> in the <ul>
        },
        resetForm: true        
    }
    $('form').ajaxForm(options);  
});
