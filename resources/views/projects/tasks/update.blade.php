@extends('layouts.layout')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            <h1 class="ui huge blue header">Edit Task Info</h1>
            <div class="ui form">

                @if (session()->has('edittaskfail'))
                    <div class="ui red error message">
                        <div class="header">Conflicting data:</div>
                        <p>{{ session('edittaskfail') }}</p>
                    </div>
                @endif

                @if (session()->has('addtaskfailp'))
                    <div class="ui red error message">
                        <div class="header">Conflicting data:</div>
                        <p>{{ session('addtaskfailp') }}</p>
                    </div>
                @endif

                <form action="/projects/tasks/update/{{ $task->id }}" method="POST">
                    @csrf
                    <div class="field">
                        <label for="name">Task Name: *</label>
                        <input type="text" name="name" value="{{ $task->name }}" required autofocus>
                    </div>
                    <div class="field">
                        <label for="description">Description:</label>
                        <textarea name="description">{{ $task->description }}</textarea>
                    </div>
                    <div class="field">
                        <label for="filelink">File link:</label>
                        <input type="text" name="filelink" value="{{ $task->filelink }}" autocomplete="off">
                    </div>
                    <h4 class="ui dividing header">Time</h4>
                    <div class="fields">
                        <div class="five wide field">
                            <label>Begin Date *</label>
                            <input type="date" name="bdate" value="{{ $task->bdate }}" required>
                        </div>
                        <div class="five wide field">
                            <label>End Date *</label>
                            <input type="date" name="edate" value="{{ $task->edate }}" required>
                        </div>
                    </div>

                    <div class="field">
                        <label>To do first (if left empty, dependencies will not change)</label>
                        <select class="selectpicker" multiple data-live-search="true" name="ptasks[]">
                            @foreach ($tasks as $task)
                                <option value="{{ $task->id }}">due at: {{ $task->edate }} - {{ $task->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <h4 class="ui dividing header">Employees (if left empty, assigned emplyees will not change)</h4>
                    <select class="selectpicker" multiple data-live-search="true" name="emp[]" aria-placeholder="ass">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->email }}</option>
                        @endforeach
                    </select>

                    <button class="ui right floated primary button" type="submit">
                        Confirm Edits
                        <i class="Save Project"></i>
                    </button>

                </form>
            </div>
        </div>
    </div>
@endsection
