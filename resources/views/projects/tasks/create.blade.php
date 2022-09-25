@extends('tasks.index')

@section('task_create')
<div id="mdiv" class="ui modal">
    <h1 style="text-indent:20px;">Add New Task</h1>
    <form class="ui form" action="{{ action($project->id, 'TasksController@store') }}" method="POST">
        @csrf
        <div></div>
        <h4 class="ui dividing header" style="text-indent:20px;">Info</h4>
        <div class="fields">
            <div class="field"></div>
            <div class="field">
                <label>Name</label>
                <input type="text" name="name" placeholder="Task Name" required>
            </div>
        </div>
        <div class="fields">
            <div class="field"></div>
            <div class="twelve wide field">
                <label>Description</label>
                <input type="text" name="description" placeholder="Task Description">
            </div>
        </div>
        <div class="fields">
            <div class="field"></div>
            <div class="seven wide field">
                <label>Attatched link: </label>
                <input type="text" name="flink" placeholder="URL">
            </div>
        </div>
        <h4 class="ui dividing header" style="text-indent:20px;">Time</h4>
        <div class="fields">
            <div class="field"></div>
            <div class="four wide field">
                <label>Begin Date</label>
                <input type="date" name="bdate">
            </div>
            <div class="four wide field">
                <label>End Date</label>
                <input type="date" name="edate">
            </div>
            <div class="field"></div>
            <div class="five wide field">
                <label>To do first</label>
                <select class="ui fluid search dropdown" name="tasks">
                    <option value="1">task1</option>
                    <option value="2">task2</option>
                </select>
            </div>
        </div>

        <h4 class="ui dividing header" style="text-indent:20px;">Employee select</h4>
        <div class="fields">
            <div class="field"></div>
            <div class="eight wide field">
                <div class="field">
                    <select class="ui fluid search dropdown" name="employees">
                        <option value="1">e1</option>
                        <option value="2">e2</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui black deny button">
                Cancel
            </div>
            <button type="submit" class="ui blue labeled icon button">
                Add Task
                <i class="checkmark icon"></i>
            </button>
        </div>
        <br>
    </form>
</div>
@endsection