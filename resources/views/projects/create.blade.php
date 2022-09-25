@extends('layouts.layout')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            <h1 class="ui huge blue header">Create a New Project</h1>
            <div class="ui form">
                <form action="/projects" method="POST">
                    @csrf
                    <div class="field">
                        <label for="name">Project Name: *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="field">
                        <label for="description">Description:</label>
                        <textarea id="description" name="description"></textarea>
                    </div>
                    <button class="ui right floated primary button" type="submit">
                        Add
                        <i class="Save Project"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
