@extends('layouts.layout')

@section('content')
    <div class="ui container vertical aligned masthead segment">
        <div class="column">

            @if (session()->has('createproject'))
                <div class="ui green visible message">
                    {{ session('createproject') }}
                </div>
            @endif
            
            @if (session()->has('editsuccess'))
                <div class="ui green visible message">
                    {{ session('editsuccess') }}
                </div>
            @endif
            
            <div>
                <table>
                    <tr>
                        <td>
                            <h1>{{$data['project']->name}}</h1>  
                        </td>
                        <td>
                            <h3> <a href="/projects/edit/{{$data['project']->id}}"><i class="ui blue cog icon" ></i></a></h3>
                        </td>
                    </tr>
                </table>
                <br>
                <div>
                <p style="color: grey">Created at: {{$data['project']->created_at}} <br> Last updated at: {{$data['project']->updated_at}}</p>       
                <p><b>Description:</b> {{$data['project']->description}}</p>
                <p><b>manager:</b> {{{ Auth::user()->name }}}</p>  
                </div>

                <section>
                    @yield('tasks_index')
                </section>

                <section>
                    @yield('charts')
                </section>
                
                <button id="terminate" class="ui red button">Terminate Project</button>
                
                <div id="cpdiv" class="ui modal" style ="margin:auto; height:15%; width: 20%;">
                    <i class="close icon"></i>
                    <div class="header">
                      Terminate Project ?
                    </div>
                    <form action="/projects/{{$data['project']->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                    <div class="actions">
                      <div class="ui black deny button">
                        Cancel
                      </div>
                      <button id="terminate" class="ui red button">Terminate Project</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <p><center><a href="/projects">Back to projects list</a></center></p></p>
@endsection