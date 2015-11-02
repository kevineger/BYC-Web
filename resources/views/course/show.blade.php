@extends('app')

@section('content')
    <h1>{{ $course->name }}</h1>
    <h3>{{ $course->school->name }}</h3>
    <ul>
        <li>Description: {{ $course->description }}</li>
        @if( $course->min_age == 0 && $course->max_age == 0)
            <li>All Ages</li>
        @else
            <li>Ages: {{ $course->min_age }} - {{ $course->max_age }}</li>
        @endif
        <li>Price: {{ $course->price }}</li>
    </ul>
    {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course]]) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection
