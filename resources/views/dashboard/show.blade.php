@extends('app')

@section('content')


    <h1 class="ui dividing header">Vendor Dashboard</h1>

    <h2>Manage School</h2>
    <div class="ui segment">
        <h3>{{$school->name}}</h3>

        {!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $school], ]) !!}
        {!! Form::submit('Delete', ['class' => 'ui red button']) !!}
        {!! Form::close() !!}
        <a class="ui blue button" href="{{ action('SchoolsController@edit', $school) }}" role="button">Edit School</a>
    </div>
    <br>
    <h2>Manage Courses</h2>
    <div class="ui grid">
        @foreach($courses as $course)
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
@endsection