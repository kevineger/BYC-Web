@extends('app')

@section('content')
    <h1 class="ui block header">
        {{ $school->name }}
    </h1>
    <div class="ui two column middle aligned relaxed fitted stackable grid" style="position: relative">
        <div class="column">
            <div class="ui horizontal list">
                <div class="item">
                    <img class="ui mini circular image" src="http://semantic-ui.com/images/avatar2/small/molly.png">
                    <div class="content">
                        <div class="ui sub header">{{ $school->user->name }}</div>
                        Vendor
                    </div>
                </div>
            </div>
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

                                {{--<ul>
                                        <li><a href="{{ action('CoursesController@show', [$course]) }}">{{ $course->name }}</a></li>
                                </ul>--}}
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
    @endcan
@endsection