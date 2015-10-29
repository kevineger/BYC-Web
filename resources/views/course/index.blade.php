@extends('app')

@section('content')
    <h1>Course Index</h1>
    <ul>
        @foreach( $courses as $course )
            <li><a href="{{ action('CourseController@show', [$course->id]) }}">{{ $course->name }}</a></li>
        @endforeach
    </ul>
@endsection