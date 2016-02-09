@extends('app')

@section('page-header')
    <div class="page-header">
        <h2>Courses</h2>
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
    <h1>Course Index</h1>
    <div class="ui grid">
        @foreach( $courses as $course )
            @if($course->active)
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
            @endif
        @endforeach
    </div>

@endsection