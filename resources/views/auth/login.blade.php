@extends('app')

@section('content')
    <div class="ui middle aligned center aligned grid">
        <div class="row">
            <div class="login-column column">
                <h2 class="ui teal image header">
                    <img src="http://semantic-ui.com/examples/assets/images/logo.png" class="image">

                    <div class="content">
                        Log-in to your account
                    </div>
                </h2>
                <form method="POST" action="/auth/login" class="ui large form">
                    {!! csrf_field() !!}
                    <div class="ui stacked segment">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input type="email" name="email" value="{{ old('email')}}" placeholder="E-Mail Address">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input type="password" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        <button type="submit" class="ui fluid large teal submit button">Login</button>
                        <br>
                        <a href="{{ url('/password/email') }}">Forgot Your Password?</a>
                    </div>
                </form>
                <div class="ui message">
                    New to us? <a href="/auth/register">Sign Up</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="login-column column">
                @if ($errors->any())
                    <ul class="ui error message">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection