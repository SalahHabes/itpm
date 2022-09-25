@extends('layouts.layout')

@section('content')
    <div class="ui two column centered grid">
        <div class="column">
            @if (session()->has('SignedUpSuccess'))
                <div class="ui success message">
                    <div class="header">Form Completed</div>
                    <p>{{ session('SignedUpSuccess') }}</p>
                </div>
            @endif

            @if (session()->has('BdFail'))
                <div class="ui warning message">
                    <div class="header">Birthday cannot be in the future</div>
                    <p>{{ session('BdFail') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.register') }}">
                @csrf

                <div class="ui error form segment">
                    @if (session()->has('SignedUpFail'))
                        <div class="ui error message">
                            <div class="header">Action Forbidden</div>
                            <p>{{ session('SignedUpFail') }}</p>
                        </div>
                    @endif

                    <div class="field">
                        <label>Name *</label>
                        <input placeholder="name" type="text" name="name" required autofocus>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Email *</label>
                            <input placeholder="Email" type="email" name="email" required>
                        </div>
                        <div class="field">
                            <label>Phone</label>
                            <input placeholder="Phone-Number" type="text" name="phone">
                        </div>
                    </div>
                    <div class="two fields">
                        <div class="field">
                            <label>Gender</label>
                            <div class="ui selection dropdown">
                                <div class="default text">Select Gender</div>
                                <i class="dropdown icon"></i>
                                <input type="hidden" name="gender" required>
                                <div class="menu">
                                    <div class="item" data-value="other">Other</div>
                                    <div class="item" data-value="male">Male</div>
                                    <div class="item" data-value="female">Female</div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <label>birth *</label>
                            <input type="date" class="ui" name="birth" required>
                        </div>
                    </div>
                    <div class="field">
                        <label>Password *</label>
                        <input type="password" name="password" required>
                    </div>
                    <div>

                        <div class="inline fields">
                            <label for="role">Choose Role for the user</label>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="role" tabindex="0" class="ui" value="1" checked>
                                    <label>Employee</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="role" tabindex="0" class="ui" value="2">
                                    <label>Manager</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="role" tabindex="0" class="ui" value="3">
                                    <label>Admin</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="ui submit button" type="submit">Submit</button>
                </div>


            </form>
        </div>
    </div>
@endsection
