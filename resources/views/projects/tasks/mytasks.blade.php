@extends('layouts.layout')

@section('content')
    <div class="ui container vertical aligned masthead segment">

        <div class="ui divided items">
            <form href="mytasks" method="GET" role="search">
                <div class="ui search">
                    <div class="ui icon input">
                        <input type="text" class="prompt" name="search"
                            placeholder="Search for project...">
                        <i class="search icon"></i>
                    </div>
                </div>
            </form>
            <table class="ui striped table">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th class="center aligned">Begin Date</th>
                        <th class="center aligned">End Date</th>
                        <th class="center aligned">Finish Date</th>
                        <th class="right aligned">Info</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task['name'] }}</td>
                            <td class="center aligned">{{ $task['bdate'] }}</td>
                            <td class="center aligned">{{ $task['edate'] }}</td>
                            <td class="center aligned" style="background-color: rgb(209, 238, 250)">{{ $task['fdate'] }}</td>
                            <td class="right aligned">
                                <a href="/projects/tasks/{{ $task['id'] }}" style="color:green">
                                    <i class="green chevron circle right icon"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-12 text-center">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
