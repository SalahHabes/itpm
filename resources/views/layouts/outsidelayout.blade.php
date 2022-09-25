<!DOCTYPE html>
<html>

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
</head>

<body>
<div id="header" class="ui inverted blue segment">
    <div class="ui container">
        <div class="ui inverted blue secondary menu">
            <div class="item">
                <a class="ui inverted header small" href="/home">
                    <i class="cubes icon app-icon"></i>
                    IT Project Management
                </a>
            </div>
        </div>
    </div>
</div>

@yield('content')

<footer class="ui blue">
    IT Project Managment 2020, Habes salah eddine. All Rights Reserved
</footer>

</body>

</html>