@extends('app')

@section('content')
    <h1>Course Index</h1>
    <ul>
        @foreach( $courses as $course )
            <div class="col-md-4 col-sm-4">
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
            </div>
        @endforeach
    </ul>
@endsection