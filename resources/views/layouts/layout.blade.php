<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>It Project Managment</title>

    <script src="/js/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/bootstrap-select.min.js"></script>
    <script src="/js/semantic.min.js"></script>
    <script type="text/javascript" src="/charts/loader.js"></script>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-select.css" />
    <link rel="stylesheet" href="/css/semantic.min.css">

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <style type="text/css">
        .dropdown-toggle {
            height: 40px;
            width: 400px !important;
        }

    </style>
</head>

<body>
<div id="header" @if (Auth::user()->isAdmin()) class="ui inverted segment" @else
        class="ui inverted blue segment" @endif >
        <div class="ui container">
        <div @if (Auth::user()->isAdmin()) class="ui inverted secondary menu" @else
                class="ui inverted blue secondary menu" @endif>
                <div class="item">
                    <a class="ui inverted header small" href="/home">
                        <i class="cubes icon app-icon"></i>
                        IT Project Management
                    </a>
                </div>
                <div class="right dropdown menu">
                    <div class="ui dropdown item">
                        {{ Auth::user()->email }} <i class="dropdown icon"></i>
                        <div class="menu">
                            <a class="ui" href="{{ route('login') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <div class="inverted item">
                                
                                    <i @if (Auth::user()->isAdmin()) class="black sign-out icon" @else
                                        class="blue sign-out icon" @endif></i>
                                    <b @if (Auth::user()->isAdmin()) style="color: black" @else
                                        style="color: #2185d0" @endif>Logout</b>
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </a>
                        </div>
                    </div>
                    @if (Auth::user()->isManager())
                        <a href="/employees" class="item">Employee List</a>
                        <a href="/projects" class="item">My Projects</a>
                    @else
                        @if (Auth::user()->isEmployee())
                            <a href="/mytasks" class="item">My Tasks</a>
                        @else
                            <a href="/assign" class="item">Assign roles</a>
                            <a href="/signup" class="item">Register user</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <footer class="ui blue">
        IT Project Managment 2020, Habes salah eddine. All Rights Reserved
    </footer>

    <script type="text/javascript">
        window.onload = function() {
            $('.ui.dropdown').dropdown();
        };

        $(document).ready(function() {
            $('select').selectpicker();
        });

        $(document).ready(function() {
            $('#addtask').click(function() {
                $('#mdiv').modal('show');
            });
        });

        $(document).ready(function() {
            $('#terminate').click(function() {
                $('#cpdiv').modal('show');
            });
        });

        $(document).ready(function() {
            $('#delett').click(function() {
                $('#ctdiv').modal('show');
            });
        });

        $(document).ready(function() {
            $('#remove').click(function() {
                $('#cediv').modal('show');
            });
        });

        $(document).ready(function() {
            $('#finished').click(function() {
                $('#mfdiv').modal('show');
            });
        });
    </script>

</body>

</html>
