@extends('layouts.layout')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            <h1 class="ui huge blue header">Employee listing: </h1>
            <div class="ui form">
                <div class="ui container vertical aligned masthead segment">
                    @if (session()->has('addsuccess'))
                        <div class="ui green visible message">
                            {{ session('addsuccess') }}
                        </div>
                    @endif
                    <div class="ui divided items">
                        <div class="ui middle aligned divided list">
                            <table style="width: 100%;">
                                <tr>
                                    <td>
                                        <div class="item">
                                            <div class="extra">
                                                <a href="/employees/">
                                                    <div class="ui left floated blue button">
                                                        <i class="left chevron icon"></i> My employees
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
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
                                </tr>
                            </table>
                            <table class="ui striped table">
                                <thead>
                                    <tr>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th class="right aligned">Add</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td data-label="email">{{ $employee->email }}</td>
                                            <td data-label="Name">{{ $employee->name }}</td>
                                            <td data-label="Phone">{{ $employee->phone }}</td>
                                            <td class="right aligned">
                                                @if (Auth::user()->Added($employee->id))
                                                    <button type="submit" class="ui button" disabled>Added</button>
                                                @else
                                                    <form action="/employees/add/{{ $employee->id }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="ui green button">Add</button>
                                                    </form>
                                                @endif
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
