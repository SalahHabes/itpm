@extends('layouts.layout')

@section('content')
    <div class="ui container vertical aligned masthead segment">
        <div class="column">
            @if (session()->has('assignedSuccessfully'))
                <div class="ui green visible message">
                    {{ session('assignedSuccessfully') }}
                </div>
            @endif
            
            <form href="/assign" method="GET" role="search">
                <div class="ui search">
                    <div class="ui icon input">
                        <input type="text" class="prompt" name="search" placeholder="Search by email...">
                        <i class="search icon"></i>
                    </div>
                </div>
            </form>

            <table class="ui striped table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th class="center aligned">Employee</th>
                        <th class="center aligned">Manager</th>
                        <th class="center aligned">Admin</th>
                        <th class="center aligned">confirm</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <form action="{{ route('changeAssign') }}" method="post">

                                <td data-label="Id">{{ $user->id }}</td>
                                <td data-label="email">{{ $user->email }}<input type="hidden" name="email"
                                        value="{{ $user->email }}"></td>
                                <td data-label="Name">{{ $user->name }}</td>
                                <td data-label="Phone">{{ $user->phone }}</td>
                                <td data-label="Employee" class="center aligned"><input type="radio"
                                        {{ $user->hasRole('Employee') ? 'checked' : '' }} name="role"
                                        class="ui radio checkbox" value="1"></td>
                                <td data-label="Manager" class="center aligned"><input type="radio"
                                        {{ $user->hasRole('Manager') ? 'checked' : '' }} name="role"
                                        class="ui radio checkbox" value="2"></td>
                                <td data-label="Admin" class="center aligned"><input type="radio"
                                        {{ $user->hasRole('Admin') ? 'checked' : '' }} name="role" class="ui radio checkbox"
                                        value="3"></td>
                                {{ csrf_field() }}
                                <td class="center aligned"><button type="submit" class="ui fluid secondary button">Assign
                                        role</button></td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-12 text-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
