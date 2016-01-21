@extends('app')

@section('content')
    {!! Form::open(['method' => 'GET', 'action' => 'SearchController@index']) !!}
    <div class="form-group">
        {!! Form::label('search', 'Search') !!}
        {!! Form::input('search', 'q', null, ['class' => 'form-control', 'placeholder' => 'Search...']) !!}
    </div>
    @if($schools->count()||$courses->count()>0)
        @if($schools->count())
            <div class="page-header">
                <h1>Schools</h1>
            </div>
            @foreach( $schools as $school )

                    <a href="{{ action('SchoolsController@show', [$school]) }}">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{$school->name}}</h3>
                            </div>
                            <div class="panel-body">
                                <div>
                                    <h7>Vendor: {{$school->user->name}}</h7>
                                </div>
                                <div>
                                    <h9>Address: {{$school->address}}</h9>
                                </div>
                            </div>
                        </div>
                    </a>

            @endforeach
        @endif
        @if($courses->count())
            <div class="row">
            <div class="page-header">
                <h1>Courses</h1>
            </div>
                </div>
            @foreach( $courses as $course )
                @if($course->active)

                        <a href="{{ action('CoursesController@show', [$course]) }}">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{$course->name}}</h3>
                                </div>
                                <div class="panel-body">
                                    <div>
                                        <h7>{{$course->school->name}}</h7>
                                    </div>
                                    <div>
                                        <h9>Price: ${{$course->price}}</h9>
                                    </div>
                                </div>
                            </div>
                        </a>

                @endif
            @endforeach

        @endif

    @else
        <br><h3>No results returned.</h3>
    @endif

@endsection
