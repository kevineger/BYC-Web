@extends('app')

@section('page-header')
    <div class="page-header">
        <h2>Courses</h2>
    </div>
@endsection

@section('content')
    <div class="ui grid">
        <div class="four wide column">
            @include('partials.filter.course')
        </div>
        <div class="twelve wide column">
            <div class="ui grid">
                @foreach( $courses->chunk(3) as $course_chunk )
                    <div class="three column row">
                        @foreach( $course_chunk as $course )
                            <div class="column">

                                <a class="ui card" href="{{ action('CoursesController@show', [$course]) }}">
                                    <div class="content">
                                        <div class="ui bottom right attached label">{{ sizeof($course->times) }} times
                                        </div>
                                        <div class="header">{{$course->name}}</div>
                                        <div class="meta">
                                            <span class="category">{{$course->school->name}}</span>
                                        </div>
                                        <div class="description">
                                            <p>{{ $course->description }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
