@extends('app')

@section('content')
    <h1>Course Index</h1>
    {!! Form::open(['method' => 'GET', 'action' => 'SearchController@index']) !!}
    <div class="form-group">
        {!! Form::label('search', 'Search') !!}
        {!! Form::input('search', 'q', null, ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
    </div>
    {!! Form::close() !!}
    <div class="row">
    @foreach( $courses as $course )
        @if($course->active)
            <div class="col-sm-6 col-md-4">
                <a href="{{ action('CoursesController@show', [$course]) }}" class="thumbnail-link">
                    <div class="thumbnail">
                        <img src="/photos/courses/1453338241-2013-12-19 15.59.28.png">
                        <div class="caption">
                            <h3>{{$course->name}}</h3>
                            <p>School: {{$course->school->name}}<span class="label label-primary pull-right">${{$course->price}}</span></p>

                        </div>
                    </div>
                </a>
            </div>
        @endif
    @endforeach
    </div>

@endsection