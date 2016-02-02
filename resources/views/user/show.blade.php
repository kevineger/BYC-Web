@extends('app')

@section('content')

    <h2 class="ui center aligned icon header">
        <i class="circular user icon"></i>
        {{$user->name}}
    </h2>
    <div class="ui stacked segment">
        <p> Email: {{$user->email}}</p>
    </div>
    @can('updateUser', $user)
    <div class="ui basic buttons">
        <a href="{{ action('UsersController@edit', [$user]) }}" role="button" class="ui button">Edit Profile</a>

        @if(Auth::user()->vendor)
            <a href="{{ action('DashboardController@show') }}" role="button" class="ui button"> Manage
                Schools/Courses</a>
        @endif
    </div>

    <div class="ui grid">
        @foreach ($user->photos->chunk(4) as $set)
            <div class="row">
                @foreach($set as $photo)
                    <div class="four wide column">
                        <a href="/{{ $photo->path }}" data-lity>
                            <img style="width:100%" src="/{{ $photo->thumbnail_path }}" alt="Photo">
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <br>
    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user]]) !!}
    {!! Form::submit('Delete Profile', ['class' => 'ui red button']) !!}
    {!! Form::close() !!}
    @endcan


@endsection