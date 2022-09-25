@extends('layouts.layout')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            @if (session()->has('done'))
                <div class="ui green visible message">
                    {{ session('done') }}
                </div>
            @endif

            @if (session()->has('teditsuccess'))
                <div class="ui green visible message">
                    {{ session('teditsuccess') }}
                </div>
            @endif

            <div>
                <a @if (Auth::user()->isManager()) href="/projects/{{ $project['id'] }}"
                    @endif>
                    <h1>{{ $project['name'] }}</h1>
                </a>
                <table>
                    <tr>
                        <td>
                            <h2>> {{ $task->name }}</h2>
                        </td>
                        @if (Auth::user()->isManager())
                            <td>
                                <h3> <a href="/projects/tasks/edit/{{ $task->id }}"><i class="ui blue cog icon"></i></a>
                                </h3>
                            </td>
                        @endif
                    </tr>
                </table>
                <br>
                <table style="width: 100%">
                    <tr>
                        <td>
                            <b>Begin Date: </b>{{ $task->bdate }}
                        </td>
                        <td>
                            <b>End Date: </b>{{ $task->edate }}
                        </td>
                    </tr>
                </table>
                <br>
                <b>Description: </b>{{ $task->description }}<br><br>
                <br>
                <b>Assigned Employee(s): </b>
                @foreach ($assigned_emp as $emp)
                    <p style="text-indent:20px;">{{ $emp['name'] }} , <a href=#>{{ $emp['email'] }}</a></p>
                @endforeach
                <br>
                <b>Attatched resources: </b>
                <a href="{{ $task->filelink }}">{{ $task->filelink }}</a>
                <br>
                <br>
                <table style="width: 100%">
                    <tr>
                        <th>to do first: </th>
                        <th>to unlock next: </th>
                    </tr>
                    <tr>
                        <td>
                            @foreach ($held_back_by as $ptask)
                                <a href="/projects/tasks/{{ $ptask['id'] }}">
                                    <p style="text-indent:20px;">{{ $ptask['name'] }}</p>
                                </a>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($holding_back as $dtask)
                                <a href="/projects/tasks/{{ $dtask['id'] }}">
                                    <p>{{ $dtask['name'] }}</p>
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </table>
                <br>
                <br>
                <table class="border:inset 5px red">
                    <tr>
                        @if (Auth::user()->isManager())
                            <button id="delett" class="ui red button">Delete Task</button>

                            <div id="ctdiv" class="ui modal" style="margin:auto; height:15%; width: 20%;">
                                <i class="close icon"></i>
                                <div class="header">
                                    Delete Task ?
                                </div>
                                <form action="/projects/{{ $project['id'] }}/{{ $task->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="actions">
                                        <div class="ui black deny button">
                                            Cancel
                                        </div>
                                        <button id="delett" class="ui red button">Delete Task</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                        @if ($task->fdate == null)

                            <button id="finished" class="ui green right blue labeled icon button">Mark as done &nbsp; <i
                                    class="checkmark icon"></i></button>
                            <div id="mfdiv" class="ui modal" style="margin:auto; height:30%; width: 50%;">
                                <i class="close icon"></i>
                                <div class="header">
                                    Mark as done ?
                                </div>
                                <form action="/projects/tasks/{{ $task->id }}/mark" method="POST">
                                    @csrf
                                    <div class="ui form">

                                        <div class="twelve field">
                                            <label for="filelink">&nbsp; Change attatched file link (optional)</label>
                                            <input name="filelink" type="text" placeholder="URL">
                                        </div>

                                    </div>

                                    <div class="actions">
                                        <div class="ui black deny button">
                                            Cancel
                                        </div>
                                        <button type="submit" id="finished"
                                            class="ui green right blue labeled icon button">Mark as done
                                            &nbsp; <i class="checkmark icon"></i></button>
                                    </div>
                                </form>
                            </div>
                        @else
                            <form action="/projects/tasks/{{ $task->id }}/unmark" method="POST">
                                @csrf
                                <button class="ui blue right blue labeled icon button">Not yet done &nbsp; <i
                                        class="cog icon"></i></button>
                            </form>
                        @endif
                    </tr>
                </table>
            </div>
            <!--<a href="projects/">Back to project view</a>-->
        </div>
    </div>
@endsection
