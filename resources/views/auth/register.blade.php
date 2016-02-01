@extends('app')

@section('content')

    <div class="content header-margin">
        <h2 class="ui teal image header center aligned">
            Create Account
        </h2>
    </div>
    <form method="POST" action="/auth/register" class="ui large form">
        {!! csrf_field() !!}
        <div class="ui segment">
            <div>
                Name
                <input type="text" name="name" value="{{ old('name') }}">
            </div>

            <div>
                Email
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                Password
                <input type="password" name="password">
            </div>

            <div>
                Confirm Password
                <input type="password" name="password_confirmation">
            </div>

            {!! Form::label('type', 'User Type') !!}
            {!! Form::select('type', ['1' => 'Vendor', '0' => 'Consumer']) !!}
            <br>
            <div>
                <button type="submit" class="ui fluid large teal submit button">Register</button>
            </div>
        </div>
    </form>

    @if ($errors->any())
        <ul class="ui error message">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@endsection