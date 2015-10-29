@extends('app')

@section('content')
    <h1>{{ $school->name }}</h1>
    <h3>{{ $school->user->name }}</h3>
    <ul>
        <li>{{ $school->name }}</li>
        <li>{{ $school->description }}</li>
        <li>{{ $school->address }}</li>
    </ul>
    @can('update', $school)
    {!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $school]]) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @endcan
@endsection