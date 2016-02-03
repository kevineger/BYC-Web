@extends('app')

@section('content')

    {!! Form::open(['method' => 'GET', 'action' => 'SearchController@index']) !!}
    <div class="ui search">
        <div class="ui icon input">
            <input name="q" class="prompt" type="search" placeholder="Search Schools">
            <i class="search icon"></i>
        </div>
    </div>
    {!! Form::close() !!}
    <br>

    @if($schools->count()||$courses->count()>0)
        @if($schools->count())
            <h1>Schools</h1>
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
        @endif
        @if($courses->count())
            <div class="row">
                <h1>Courses</h1>
            </div>
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
        @endif

    @else
        <br><h3>No results returned.</h3>
    @endif

@endsection
