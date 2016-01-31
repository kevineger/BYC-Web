@extends('app')

@section('content')
    <div class="page-header">
        <h1>Vendor Dashboard</h1>
    </div>
        <h3>Manage School</h3>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{$school->name}}</h3>
            </div>
            <div class="panel-body">
                <a class="btn btn-default" href="{{ action('SchoolsController@edit', $school) }}" role="button">Edit School</a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $school]]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    <br>
    <h3>Manage Courses</h3>
    @foreach($courses as $course)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{$course->name}}
                    @if($course->active)
                        <span class="label label-success">Active</span>
                    @else
                        <span class="label label-warning">Inactive</span>
                    @endif
                </h3>
            </div>
            <div class="panel-body">

                <a class="btn btn-default" href="{{ action('CoursesController@edit', $course) }}" role="button">Edit Course</a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course]]) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
@endsection