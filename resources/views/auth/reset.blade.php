@extends('app')

@section('content')
<div class="centered ui grid">
    <div class="ten wide column">
        <form method="POST" action="/password/reset">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="ui stacked segment form">
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

                    <button class="ui teal button" type="submit">
                        Reset Password
                    </button>
            </div>
        </form>

        @if ($errors->any())
            <ul class="ui error message">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection