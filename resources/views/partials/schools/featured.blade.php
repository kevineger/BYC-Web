<div class="ui two stackable centered special cards">
    @foreach($featuredSchools as $school)
        <a class="card" href="{{ action('SchoolsController@show', [$school]) }}">
            <div class="blurring dimmable image">
                <div class="ui dimmer">
                    <div class="content">
                        <div class="center">
                            <h4 class="header">Courses</h4>
                            <div class="ui list">
                                @foreach($school->courses as $course)
                                    <div class="item">{{ $course->name }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @if(!$school->photos->isEmpty())
                    <img src="/{{ $school->photos[0]->thumbnail_path }}" alt="photo">
                @else
                    <img src="{{ asset('photos/tn-school.jpg') }}"
                         alt="photo">
                @endif
            </div>
            <div class="content">
                <h2 class="header">{{ $school->name }}</h2>
            </div>
        </a>
    @endforeach
</div>