@extends('app')

@section('content')
    <h1>School Index</h1>
    <ul>
        @foreach( $schools as $school )
            <li><a href="{{ action('SchoolsController@show', [$school->id]) }}">{{ $school->name }}</a></li>
        @endforeach
    </ul>
@endsection