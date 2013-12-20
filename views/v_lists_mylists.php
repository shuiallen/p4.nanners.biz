<h1>Build a List</h1>
<p>This feature is not implemented</p>
<p>The intent of this page is to find tasks in the Search Tab and move them to the Today tab. </p>
<p>The today tab might be seeded with a quick list, and individual tasks can be added to the Today tab, the list in the Today can be reordered, defining an order of things to do today. </p>
<!-- <div>
    <form>
        <label for='projectName'>Open  tab for project</label><br>
        <input type='text' name='projectName' required>
        <input type='Submit' value='Submit'>
    </form>
</div> -->

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Search tasks</a></li>
        <li><a href="#tabs-2">Today</li>
    </ul>
    <div id="tabs-1">
        <ul id="sortable1" class="listItems connectedSortable ui-helper-reset">
        </ul>

    </div> 
    <div id="tabs-2">
        <ul id="sortable2" class="listItems connectedSortable ui-helper-reset">
            <li class="ui-state-highlight">Item 1</li>
            <li class="ui-state-highlight">Item 2</li>
            <li class="ui-state-highlight">Item 3</li>
            <li class="ui-state-highlight">Item 4</li>
            <li class="ui-state-highlight">Item 5</li>
        </ul>
    </div>
</div>