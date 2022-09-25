@extends('layouts.layout')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            <h1 class="ui huge blue header">Edit Project Info</h1>
            <div class="ui form">
                <form action="/projects/update/{{ $project->id }}" method="POST">
                    @csrf
                    <div class="field">
                        <label for="name">Project Name: *</label>
                        <input type="text" name="name" value="{{$project->name}}" required autofocus>
                    </div>
                    <div class="field">
                        <label for="description">Description:</label>
                        <textarea name="description">{{$project->description}}</textarea>
                    </div>
                    <button class="ui right floated primary button" type="submit">
                        Confirm Edits
                        <i class="Save Project"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
