@extends('layouts.layout')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            <h1 class="ui huge blue header">My Employees: </h1>
            <div class="ui form">
                <div class="ui container vertical aligned masthead segment">
                    @if (session()->has('removesuccess'))
                        <div class="ui green visible message">
                            {{ session('removesuccess') }}
                        </div>
                    @endif
                    <div class="ui divided items">

                        <div class="ui middle aligned divided list">
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <form href="employees" method="GET" role="search">
                                            <div class="ui search">
                                                <div class="ui icon input">
                                                    <input type="text" class="prompt" name="search"
                                                        placeholder="Search for employee...">
                                                    <i class="search icon"></i>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="/employees/global">
                                            <div class="ui right floated blue button">
                                                Add new &nbsp;<i class="plus circle icon"></i>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <table class="ui striped table">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th class="center aligned">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td data-label="email">{{ $employee->email }}</td>
                                            <td data-label="Name">{{ $employee->name }}</td>
                                            <td data-label="Phone">{{ $employee->phone }}</td>
                                            <td class="right aligned">
                                                <form action="/employees/remove/{{ $employee->id }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="ui red button">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                {{ $employees->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
