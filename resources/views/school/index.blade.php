@extends('app')

@section('page-header')
    <div class="page-header">
        <h2>Schools</h2>
    </div>
@endsection

@section('content')

    {!! Form::open(['method' => 'GET', 'action' => 'SearchController@index']) !!}
    <div class="ui search">
        <div class="ui icon input">
            <input name="q" class="prompt" type="search" placeholder="Search">
            <i class="search icon"></i>
        </div>
    </div>
    {!! Form::close() !!}

    <br>
    <h1>School Index</h1>
    <div class="ui grid">
        @foreach( $schools as $school )
            <div class="four wide column">
                <div class="ui segment">
                    <a href="{{ action('SchoolsController@show', [$school]) }}">
                        <h2>{{$school->name}}</h2>
                        @if(!$school->photos)
                            <img src="{{ $school->photos[0]->path }}" style="width:100%" alt="photo">
                        @endif
                        <p>Vendor: {{$school->user->name}}</p>
                        <p>Address: {{$school->address}}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

@endsection