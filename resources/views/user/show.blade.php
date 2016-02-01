@extends('app')

@section('content')
    <h1>{{$user->name}}</h1>

    <div class="panel panel-default">
        <div class="panel-body">
           Email: {{$user->email}}
        </div>
    </div>

    @can('updateUser', $user)
    <div class="btn-group btn-group-justified" role="group" >
        <div class="btn-group" role="group">
            <a class="btn btn-default" href="{{ action('UsersController@edit', [$user]) }}" role="button">Edit Profile</a>
        </div>
        @if(Auth::user()->vendor)
            <div class="btn-group" role="group">
                <a class="btn btn-default" href="{{ action('DashboardController@show') }}" role="button">Manage Schools/Courses</a>
            </div>
        @endif
    </div>
    <div class="col-lg-8">
        @foreach ($user->photos->chunk(4) as $set)
            <div class="row">
                @foreach($set as $photo)
                    <div class="col-md-3">
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
        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
    @endcan

@endsection