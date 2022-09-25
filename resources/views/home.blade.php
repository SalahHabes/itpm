@extends('layouts.layout')

@section('content')
    <div class="ui two column centered grid">
        <div class="ui text container">
            <br>
            <h1 @if(Auth::user()->isAdmin())class="ui black huge header" @else class="ui blue huge header" @endif>

                IT Project Management System <br>
                the place where you organize your projects
            </h1>
            <br><br>
            <div class="center aligned">
                <p>This website was consived as an end of studies projects</p>
                <p>by student Habes Salah Eddine</p>
                <p>directed by Mr.Djaber Rouabhia</p>
                <p>at</p>
                @if(Auth::user()->isAdmin())
                    <img src="/img/univadmin.png">
                @else
                    <img src="/img/univ.png">
                @endif
                
                <p>Larbi Tebessi University – Tebessa</p>
                <p>2019 / 2020</p>
            </div>

            <h3 class="ui green small header">{{ session('message') }}</h3>
        </div>
    </div>
@endsection
