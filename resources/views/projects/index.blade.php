@extends('layouts.layout')

@section('content')
<div class="ui two column centered grid">
    <div class="column">
        <center><h1 class="ui huge blue header">My Projects:</h1></center>
            <div class="ui divided items">
                <div class="item">
                    <div class="extra">
                        <table style="width: 100%;">
                            <tr>
                                <td>
                                    {!! Form::open(['method' => 'GET', 'url' => 'projects', 'class' => 'navbar-form navbar-left', 'role' => 'search']) !!}
                                    <div class="ui search">
                                        <div class="ui icon input">
                                            <input type="text" class="prompt" name="search" placeholder="Search for project...">
                                            <i class="search icon"></i>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="/projects/create">
                                        <div class="ui right floated green button">
                                            New Project  <i class="plus circle icon"></i>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @foreach($projects as $project)            
                    <div class="item">
                        <div class="content">
                            <a class="header">{{$project->name}} </a>
                            <div class="meta">
                                <span class="cinema">Started at : {{{ $project->created_at }}}</span>
                            </div>

                            <div class="extra">
                                <a href="/projects/{{$project->id}}">
                                    <div class="ui right floated primary button">
                                        View
                                        <i class="right chevron icon"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
