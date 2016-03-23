<div class="ui raised segments">
    @if($featuredCourses->count()>0)
        <div class="ui left aligned divided items segment">
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
                No courses to display at the moment
            </div>
        </div>
    @endif
</div>
