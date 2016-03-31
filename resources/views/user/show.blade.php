@extends('app')

@section('page-header')
    <div class="banner">
        <div class="div">
            <div class="frosted-container">
                <h2>Your Account</h2>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="ui centered grid">
        <h2 class="ui center aligned icon header">
            @if( $user->photos()->count() > 0)
                <img class="ui small circular image" src="/{{ $user->photos()->first()->thumbnail_path }}" alt="Photo">
            @else
                <i class="circular user icon"></i>
            @endif
            <br>

            <div class="content"> {{$user->name}}</div>
            <div class="sub header">Joined {{$user->created_at->toFormattedDateString()}}</div>
        </h2>

        <div class="row">
            <div class="ten wide column">
                <div class="ui stacked segment">
                    <h3 class="ui dividing header">Contact Information</h3>

                    <p> Email: {{$user->email}}</p>
                </div>
            </div>
        </div>

        @can('updateUser', $user)
            @if($user->vendor)
                @include('user.partials.vendor')
            @else
                @include('user.partials.consumer')
            @endif
            <br>
        @endcan
        <div class="ui horizontal divider">
            Manage Account
        </div>
        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user], 'style'=>'display:inline-block;']) !!}
        {!! Form::submit('Delete Account', ['class' => 'ui red button' ]) !!}
        {!! Form::close() !!}
        <a href="{{ action('UsersController@edit', [$user]) }}" role="button" class="ui blue button">Edit
            Account</a>
    </div>
@endsection

@section('footer')
    <script>
        $('#message').popup();
    </script>
@endsection