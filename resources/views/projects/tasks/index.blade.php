@extends('projects.charts')

@section('tasks_index')
    <div class="ui container vertical aligned masthead segment">

        <div class="ui divided items">
            <div class="item">
                <div class="extra">
                    @if (session()->has('addtaskfail'))
                        <div class="ui red error message">
                            <div class="header">Conflicting data:</div>
                            <p>{{ session('addtaskfail') }}</p>
                        </div>
                    @endif

                    @if (session()->has('addtaskfailp'))
                        <div class="ui red error message">
                            <div class="header">Conflicting data:</div>
                            <p>{{ session('addtaskfailp') }}</p>
                        </div>
                    @endif

                    @if (session()->has('addtasksuccess'))
                        <div class="ui green visible message">
                            {{ session('addtasksuccess') }}
                        </div>
                    @endif

                    @if (session()->has('deletetasksuccess'))
                        <div class="ui blue visible message">
                            {{ session('deletetasksuccess') }}
                        </div>
                    @endif
                    <table style="width: 100%;">
                        <tr>
                            <td>
                                <form href="/projects/tasks/{{ $data['project']->id }}" method="GET" role="search">
                                    <div class="ui search">
                                        <div class="ui icon input">
                                            <input type="text" class="prompt" name="search"
                                                placeholder="Search for project...">
                                            <i class="search icon"></i>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <button id="addtask" class="ui right floated green button">
                                    New Task &nbsp;<i class="plus circle icon"></i>
                                </button>
                            </td>
                        </tr>
                    </table>

                    <!--------------------------------------------------create new task---------------------------------------------------------------->
                    <div id="mdiv" class="ui modal">
                        <br>
                        <h1 style="text-indent:20px;">Add New Task</h1>
                        <form class="ui form" method="POST"
                            action="{{ action('TasksController@store', $data['project']->id) }}">
                            @csrf
                            <div></div>
                            <h4 class="ui dividing header" style="text-indent:20px;">Info</h4>
                            <div class="fields">
                                <div class="field"></div>
                                <div class="field">
                                    <label>Name *</label>
                                    <input type="text" name="name" placeholder="Task Name" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field"></div>
                                <div class="twelve wide field">
                                    <label>Description</label>
                                    <input type="text" name="description" placeholder="Task Description" autocomplete="off">
                                </div>
                            </div>
                            <div class="fields">
                                <div class="field"></div>
                                <div class="seven wide field">
                                    <label>Attatched link: </label>
                                    <input type="text" name="filelink" placeholder="URL" autocomplete="off">
                                </div>
                            </div>
                            <h4 class="ui dividing header" style="text-indent:20px;">Employee select *</h4>
                            <div class="fields">
                                <div class="field"></div>
                                <div class="twelve wide field">
                                    <div class="field">
                                        <select class="selectpicker" multiple data-live-search="true" name="emp[]" required>
                                            @foreach ($data['employees'] as $employee)
                                                <option value="{{ $employee->id }}">{{ $employee->email }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <h4 class="ui dividing header" style="text-indent:20px;">Time</h4>
                            <div class="fields">
                                <div class="field"></div>
                                <div class="four wide field">
                                    <label>Begin Date *</label>
                                    <input type="date" name="bdate" required>
                                </div>
                                <div class="four wide field">
                                    <label>End Date *</label>
                                    <input type="date" name="edate" required>
                                </div>
                                <div class="field"></div>
                                <div class="five wide field">
                                    <label>To do first</label>
                                    <select class="selectpicker" multiple data-live-search="true" name="ptasks[]">
                                        @foreach ($data['tasks'] as $task)
                                            <option value="{{ $task->id }}">due at: {{ $task->edate }} - {{ $task->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="actions">
                                <div class="ui black deny button">
                                    Cancel
                                </div>
                                <button type="submit" class="ui green labeled icon button">
                                    Add Task
                                    <i class="checkmark icon"></i>
                                </button>
                            </div>
                            <br><br>
                        </form>
                    </div>
                    <!------------------------------------------------------------------------------------------------------------------------------------>
                </div>
            </div>

            <table class="ui striped table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Task Name</th>
                        <th>To do first</th>
                        <th class="center aligned">Begin Date</th>
                        <th class="center aligned">End Date</th>
                        <th class="center aligned">Finish Date</th>
                        <th class="right aligned">Info</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data['tasks'] as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->name }}</td>
                            <td>
                                @foreach ($task->todofirst($task->id) as $idtp)
                                    {{ $idtp->id_priority }},
                                @endforeach
                            </td>
                            <td class="center aligned">{{ $task->bdate }}</td>
                            <td class="center aligned">{{ $task->edate }}</td>
                            <td class="center aligned" style="background-color: rgb(209, 238, 250)">{{ $task->fdate }}
                            </td>
                            <td class="right aligned">
                                <a href="/projects/tasks/{{ $task->id }}" style="color:green">
                                    <i class="green chevron circle right icon"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-12 text-center">
                    {{ $data['tasks']->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
