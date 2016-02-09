@extends('app')

@section('content')
    <div class="ui grid">
        <div class="centered row">
            <div class="content">
                <h2 class="ui teal image header ">
                    Create Account
                </h2>
            </div>
        </div>
        <div class="centered row">
                <div class="ui login-column column segment ">
                    <form method="POST" action="/auth/register" class="ui large form">
                        {!! csrf_field() !!}

                        <div class="field">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ old('name') }}">
                        </div>

                        <div class="field">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="field">
                            <label>Password</label>
                            <input type="password" name="password">
                        </div>

                        <div class="field">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation">
                        </div>
                        <div class="field">
                            {!! Form::label('type', 'User Type') !!}
                            {!! Form::select('type', ['1' => 'Vendor', '0' => 'Consumer']) !!}
                        </div>
                        <br>
                        <div>
                            <button type="submit" class="ui fluid large teal submit button">Register</button>
                        </div>
                    </form>

            </div>

        </div>
        @if ($errors->any())
            <ul class="ui error message">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection