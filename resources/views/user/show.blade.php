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
    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user], 'style'=>'display:inline-block;']) !!}
    {!! Form::submit('Delete Profile', ['class' => 'ui red button' ]) !!}
    {!! Form::close() !!}

    <a href="{{ action('UsersController@edit', [$user]) }}" role="button" class="ui blue button">Edit Profile</a>

    <h2>Manage School</h2>
    <div class="ui segment">
        <h3>{{$user->school->name}}</h3>

        {!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $user->school], 'style'=>'display:inline-block;']) !!}
        {!! Form::submit('Delete', ['class' => 'ui red button']) !!}
        {!! Form::close() !!}
        <a class="ui blue button" href="{{ action('SchoolsController@edit', $user->school) }}" role="button">Edit School</a>
    </div>
    <br>
    <h2>Manage Courses</h2>
    <div class="ui grid">
        @foreach($user->school->courses as $course)
            <div class="four wide column">
                <div class="ui segment">

                    <h3>{{$course->name}}
                        @if($course->active)
                            <span class="floating ui green label">Active</span>
                        @else
                            <span class="floating ui yellow label">Inactive</span>
                        @endif
                    </h3>

                    <div class="panel-body">
                        {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course], 'style'=>'display:inline-block;']) !!}
                        {!! Form::submit('Delete', ['class' => 'ui red button']) !!}
                        {!! Form::close() !!}
                        <a class="ui blue button" href="{{ action('CoursesController@edit', $course) }}" role="button">Edit
                            Course</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endcan


@endsection