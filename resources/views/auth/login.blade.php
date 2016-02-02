@extends('app')

@section('content')
    <div class="ui center aligned grid">
        <div class="row">
            <div class="column">
                <h2 class="ui teal image header ">
                    <div class="content">
                        Log-in to your account
                    </div>
                </h2>
                <form method="POST" action="/auth/login" class="ui large form">
                    {!! csrf_field() !!}
                    <div class="ui segment">
                        <div class="field">
                            <input type="email" name="email" value="{{ old('email')}}" placeholder="E-Mail Address">
                        </div>
                        <div class="field">
                            <input type="password" name="password" id="password" placeholder="Password">
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" name="remember">
                                <label>Remember Me</label>
                            </div>
                        </div>
                        <button type="submit" class="ui fluid large teal submit button">Login</button>
                    </div>
                </form>
                <hr>
                <div class="ui message">
                    New User? <a href="/auth/register">Register Here</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="eight wide column">
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