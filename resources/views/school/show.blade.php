@extends('app')

@section('content')
    <h1>{{ $school->name }}</h1>
    <h3>{{ $school->user->name }}</h3>
    <ul>
        <li>{{ $school->name }}</li>
        <li>{{ $school->description }}</li>
        <li>{{ $school->address }}</li>
    </ul>
    {!! Form::open(['method' => 'DELETE', 'route' => ['school.destroy', $school]]) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection