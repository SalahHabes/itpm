@extends('layouts.layout')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            @if (session()->has('InsufficientPermissions'))
                <div class="ui error message">
                    <div class="header">Route Access Denied</div>
                    <p>{{ session('InsufficientPermissions') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
