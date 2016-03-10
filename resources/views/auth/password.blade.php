@extends('app')

@section('content')
    <div class="centered ui grid">
        <div class="ten wide column">
            <form method="POST" action="/password/email">
                {!! csrf_field() !!}

                <div class="ui stacked segment form">
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}">
                    </div>

                    <button class="ui teal button" type="submit">
                        Send Password Reset Link
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