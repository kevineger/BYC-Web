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
        @if($featuredCourses->count()>0)
            <div class="ui olive message">
                <div class="header">
                    Featured Courses
                </div>
                <div class="ui divided items">
                    @foreach($featuredCourses as $course)
                        <div class="item">
                            <a class="ui tiny image" href="{{ action('CoursesController@show', [$course]) }}">
                                @if(!$course->photos->isEmpty())
                                    <img src="/{{ $course->photos[0]->thumbnail_path }}" alt="photo">
                                @else
                                    <img src="{{ asset('photos/tn-course.jpg') }}"
                                         alt="photo">
                                @endif
                            </a>

                            <div class="content">
                                <a class="header"
                                   href="{{ action('CoursesController@show', [$course]) }}">{{$course->name}}</a>

                                <div class="meta">
                                    {{$course->school->name}}
                                </div>
                                <div class="description">
                                    This course is really awesome. It has a brief tagline descrition.
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

            <div class="ui grid">
                <div class="column">
                    @foreach( $courses->chunk(3) as $course_chunk )
                        <div class="ui three stackable centered cards">
                            @foreach( $course_chunk as $course )
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
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection
