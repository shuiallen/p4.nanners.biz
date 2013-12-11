$(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
});

$('#insert-item').click(function() {
    var str = '<li class="ui-state-default">'+$('#list_item').val()+'</li>';
    $('#sortable').prepend(str);
    $('#add-item').resetForm();
});

$('#save-list').click(function() {
    $('#list-title').html($('#list-name').val());
    $('#save-list-form').resetForm();
});
