<h1>My Lists </h1>
<div>
    <form>
        <label for='projectName'>Open  tab for project</label><br>
        <input type='text' name='projectName' required>
        <input type='Submit' value='Submit'>
    </form>
</div>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Today's list</a></li>
        <li><a href="#tabs-2">Painting 3rd floor bathroom</li>
    </ul>
    <div id="tabs-1">
        <ul id="sortable1" class="listItems connectedSortable ui-helper-reset">
            <li class="ui-state-default">Item 1</li>
            <li class="ui-state-default">Item 2</li>
            <li class="ui-state-default">Item 3</li>
            <li class="ui-state-default">Item 4</li>
            <li class="ui-state-default">Item 5</li>
        </ul>

        <div class=newtask>
            <p> Add a task </p>
            <form>
                <label for='Project'>Project</label>
                <input type='text' name='Project'>
                <label for='datepicker'>Date</label>
                <p>todo: set date to today by default</p>
                <input type='date' id='datepicker'"/><br>
                <label for='taskDesc'>Task Description</label>
                <textarea name='taskDesc' id='taskDesc' rows="2" cols="80" wrap=hard
                    autofocus required></textarea>
                <input type='Submit' value='Submit'>
            </form>
        </div>
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