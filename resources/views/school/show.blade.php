@extends('app')

@section('content')
    <h1 class="ui block header">
        {{ $school->name }}
    </h1>
    <div class="ui two column middle aligned relaxed fitted stackable grid" style="position: relative">
        <div class="column">
            <div class="ui segment">
                <p>{{ $school->description }}</p>
            </div>

            @if( $school->photos->isEmpty())
                <div class="ui disabled center aligned header">
                    No photos available
                </div>
            @endif
            @foreach ($school->photos->chunk(2) as $set)
                <div class="ui two column relaxed centered grid">
                    @foreach($set as $photo)
                        <div class="column">
                            <a href="/{{ $photo->path }}" data-lity>
                                <img style="width:100%" src="/{{ $photo->thumbnail_path }}" alt="Photo">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <div class="ui vertical divider">
            <i class="circle thin icon light grey"></i>
        </div>
        <div class="column">
            <h2 class="ui header">
                <i class="student icon"></i>
                <div class="content">
                    Courses
                </div>
            </h2>
            @if( $school->photos->isEmpty())
                <div class="ui disabled center aligned header">
                    No courses available
                </div>
            @endif
            <div class="ui relaxed grid">
                @foreach( $school->courses->chunk(3) as $course_chunk )
                    <div class="three column row">
                        @foreach($course_chunk as $course)
                            <div class="column">
                                <div class="ui fluid image">
                                    <div class="ui teal ribbon label">
                                        {{ $course->name }}
                                    </div>
                                    <a href="{{ action('CoursesController@show', [$course]) }}">
                                        @if( !$course->photos->isEmpty() )
                                            <img src="/{{ $course->photos[0]->thumbnail_path }}">
                                        @else
                                            <img src="{{ asset('photos/tn-course.jpg') }}">
                                        @endif
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @can('update', $school)
    <div class="ui horizontal divider">
        <i class="circle thin icon light grey"></i>
    </div>
    <div class="ui centered grid">
        <div class="one column centered row">
            <div class="column">
                @if(Auth::user()->admin)
                    <a class="ui button" href="{{ action('UsersController@admin', [$course]) }}" role="button">To Admin Dashboard</a>
                @endif
                {!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $school], 'style' => 'display:inline;']) !!}
                <div class="ui buttons">
                    {!! Form::submit('Delete', ['class' => 'ui red button']) !!}
                    {!! Form::close() !!}
                    <div class="or"></div>
                    <a class="ui blue button" href="{{ action('SchoolsController@edit', [$school]) }}" role="button">Edit
                        School</a>
                </div>
            </div>
        </div>
    </div>
    <br>
    @endcan
    <h3 class="ui dividing header">
        Comments
    </h3>

    {!! Form::open([ 'action' => ['SchoolsController@addComment', $school], 'class'=>'ui reply form']) !!}
    <div class="field">
        {!! Form::textarea('text', null, ['class'=>'form-control', 'rows' => 3]) !!}
    </div>
    {!! Form::submit('Comment', ['class' => 'ui blue submit icon button']) !!}
    {!! Form::close() !!}

    @if($school->comments->isEmpty())
        <div class="ui disabled center aligned header">
            No comments available
        </div>
        <br>
    @else
        <div class="ui comments">
            @foreach($school->comments->sortByDesc('created_at') as $comment)
                @include('partials.comment')
            @endforeach
        </div>
    @endif

@endsection