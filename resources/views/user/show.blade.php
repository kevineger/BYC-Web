@extends('app')

@section('content')
    <h1>{{$user->name}}</h1>

    <div class="panel panel-default">
        <div class="panel-body">
           Email: {{$user->email}}
        </div>
    </div>
    <h1>{{$user->id}}</h1>

    @can('updateUser', $user)
        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user]]) !!}
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}

        <a class="btn btn-primary" href="{{ action('UsersController@edit', [$user]) }}" role="button">Edit Profile</a>
    @endcan

@endsection