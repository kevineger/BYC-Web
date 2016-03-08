@extends('app')
@section('page-header')
    <div class="account-header">
        <h2>Your Account</h2>
    </div>
@endsection
@section('content')

    <div class="ui centered grid">

        <h2 class="ui center aligned icon header">
            <i class="circular user icon"></i>

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
            <div class="ui horizontal divider">
                Your School
            </div>
            <br>
            @if($user->school!=null)
                <div class="ui segment">
                    <h3>{{$user->school->name}}</h3>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $user->school], 'style'=>'display:inline-block;']) !!}
                    {!! Form::submit('Delete', ['class' => 'ui basic red button']) !!}
                    {!! Form::close() !!}
                    <a class="ui basic blue button" href="{{ action('SchoolsController@edit', $user->school) }}"
                       role="button">Edit
                        School</a>
                </div>
            @else

                <a href="{{ action('SchoolsController@create') }}">
                    <div class="ui vertical animated positive button" tabindex="0">
                        <div class="hidden content">
                            <i class="add icon"></i>
                        </div>
                        <div class="visible content">Add School</div>
                    </div>
                </a>
            @endif
            <div class="ui horizontal divider">
                Your Courses
            </div>
            <br>
            @if($user->school!=null)
            <div class="row">
                <a href="{{ action('CoursesController@create') }}">
                    <div class="ui vertical animated positive button" tabindex="0">
                        <div class="hidden content">
                            <i class="add icon"></i>
                        </div>
                        <div class="visible content">Add Course</div>
                    </div>
                </a>
            </div>

                @foreach($user->school->courses as $course)
                    <div class="center aligned four wide column">
                        <div class="ui segment">
                            <div class="ui vertical segment">
                                <h3>{{$course->name}}</h3>
                                @if($course->active)
                                    <span class="floating ui green label">Active</span>
                                @else
                                    <span class="floating ui yellow label">Inactive</span>
                                @endif
                                <div class="ui mini statistic">
                                    <div class="value">
                                        0
                                    </div>
                                    <div class="label">
                                        Registered
                                    </div>
                                </div>
                            </div>
                            <div class="ui vertical segment">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course], 'style'=>'display:inline-block;']) !!}
                                {!! Form::submit('Delete', ['class' => 'ui basic red small button']) !!}
                                {!! Form::close() !!}
                                <a class="ui basic blue small button"
                                   href="{{ action('CoursesController@edit', $course) }}"
                                   role="button">Edit Course</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            @else
                <div class="ui button" id="message" data-content="Add your school before you can create a course">
                    Add Courses
                </div>
            @endif
        @else
            <div class="row">
                <div class="ten wide column">
                    <div class="ui stacked segment">
                        <h3 class="ui dividing header">Course History</h3>

                        <p>No Courses Taken Yet</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ten wide column">
                    <div class="ui stacked segment">
                        <h3 class="ui dividing header">Upcoming Courses</h3>

                        <p>No Upcoming Courses</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="ui horizontal divider">
            Photos
        </div>
            @foreach ($user->photos->chunk(4) as $set)
                <div class="row">
                    @foreach($set as $photo)
                        <div class="four wide column">
                            <a href="/{{ $photo->path }}" data-lity>
                                <div class="ui card">
                                    <div class="image">
                                        <img style="width:100%" src="/{{ $photo->thumbnail_path }}" alt="Photo">
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach
                </div>
            @endforeach
        <br>

        <div class="ui horizontal divider">
            Manage Account
        </div>
        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user], 'style'=>'display:inline-block;']) !!}
        {!! Form::submit('Delete Account', ['class' => 'ui red button' ]) !!}
        {!! Form::close() !!}
        <a href="{{ action('UsersController@edit', [$user]) }}" role="button" class="ui blue button">Edit
            Account</a>

        @endcan
    </div>


@endsection

@section('footer')
    <script>
        $('#message').popup();
    </script>
@endsection