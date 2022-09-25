@extends('layouts.outsidelayout')

@section('content')
    <div class="ui three column centered grid">
        <div class="column">
            <h2 class="ui blue image header">
                <i class="cubes icon app-icon"></i>
                <div class="content">
                    <span class="ui uc">IT Project Management System</span>
                </div>
            </h2>
            <form class="ui large form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="ui stacked segment">
                    <div class="field">
                        <div class="ui left icon input">
                            <i class="user icon"></i>
                            <input placeholder="E-mail address" id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                    </div>

                    <div class="field">
                        <div class="ui left icon input">
                            <i class="lock icon"></i>
                            <input placeholder="Password" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="ui checkbox" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">{{ __('Remember Me') }}</label>
                    </div>
                    <br>

                    <div>
                        <button type="submit" class="ui fluid large blue submit button">{{ __('Login') }}</button>
                    </div>
                </div>
            </form>

            @error('email')
            <span style="color:red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            @error('password')
            <span style="color:red" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
