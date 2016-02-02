@extends('app')

@section('content')
    <h1>Course Index</h1>
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
        @foreach( $courses as $course )
            <div class="four wide column">
                <div class="ui segment">
                    <a href="{{ action('CoursesController@show', [$course]) }}" class="thumbnail-link">
                        <h2>{{$course->name}}</h2>
                        @if(!$course->photos)
                            <img src="{{ $course->photos[0]->path }}" style="width:100%" alt="photo">
                        @endif
                        <p>School: {{$course->school->name}}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

@endsection