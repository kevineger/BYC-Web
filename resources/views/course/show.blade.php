@extends('app')

@section('content')
    <h1>{{ $course->name }}</h1>
    <h3>{{ $course->school->name }}</h3>
    <ul>
        <li>Description: {{ $course->description }}</li>
        <li>Ages: {{ $course->min_age }} - {{ $course->max_age }}</li>
        <li>Price: {{ $course->price }}</li>
    </ul>
    @can('updateCourse', $course)
    {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course]]) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @endcan
@endsection
