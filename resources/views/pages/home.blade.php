@extends('app')

@section('page-header')
    <div class="home-header">
        <h2>Book Your Class</h2>
    </div>
@endsection

@section('content')
    <div class="ui vertical stripe segment">
        <div class="ui text container">
            <h2 class="ui header">Featured Schools</h2>
            @if($featuredSchools->count()>0)
                <div class="ui divided items segment">
                    @foreach($featuredSchools as $school)
                        <div class="item">
                            <a class="ui tiny image" href="{{ action('SchoolsController@show', [$school]) }}">
                                @if(!$school->photos->isEmpty())
                                    <img src="/{{ $school->photos[0]->thumbnail_path }}" alt="photo">
                                @else
                                    <img src="{{ asset('photos/tn-school.jpg') }}"
                                         alt="photo">
                                @endif
                            </a>

                            <div class="content">
                                <a class="header"
                                   href="{{ action('SchoolsController@show', [$school]) }}">{{$school->name}}</a>

                                <div class="meta">
                                    {{$school->address}}
                                </div>
                                <div class="description">
                                    This school is really awesome. It has a brief tagline descrition.
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="ui segment">
                    <div class="ui disabled center aligned header">
                        No schools featured at the moment.
                    </div>
                </div>
            @endif


            <div class="ui section divider"></div>

            <h2 class="ui header">Featured Courses</h2>

            <div class="ui raised segments">
                @if($featuredCourses->count()>0)
                    <div class="ui divided items segment">
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
                @else
                    <div class="ui segment">
                        <div class="ui disabled center aligned header">
                            No courses featured at the moment.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection