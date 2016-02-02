@extends('app')

@section('content')
    <h1>School Index</h1>

    {!! Form::open(['method' => 'GET', 'action' => 'SearchController@index']) !!}
    <div class="ui search">
        <div class="ui icon input">
            <input name="q" class="prompt" type="search" placeholder="Search Schools">
            <i class="search icon"></i>
        </div>
    </div>
    {!! Form::close() !!}

    <br>

    <div class="ui grid">
        @foreach( $schools as $school )
            <div class="four wide column">
                <div class="ui segment">
                    <a href="{{ action('SchoolsController@show', [$school]) }}">
                        <h2>{{$school->name}}</h2>
                        <img src="{{ $school->photos[0]->path }}" style="width:100%" alt="photo">
                        <p>Vendor: {{$school->user->name}}</p>
                        <p>Address: {{$school->address}}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

@endsection