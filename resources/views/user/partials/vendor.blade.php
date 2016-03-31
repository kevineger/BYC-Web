<div class="ui horizontal divider">
    Your School
</div>
<br>
@if($user->school!=null)
    <div class="ui segment">
        <h3><a href="{{ action('SchoolsController@show', $user->school) }}">{{$user->school->name}}</h3>
        {!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $user->school], 'style'=>'display:inline-block;']) !!}
        {!! Form::submit('Delete', ['class' => 'ui basic red button']) !!}
        {!! Form::close() !!}
        <a class="ui basic blue button" href="{{ action('SchoolsController@edit', $user->school) }}"
           role="button">Edit
            School</a>
    </div>
@else
    <a href="{{ action('SchoolsController@create') }}">
        <div class="ui vertical animated positive button" tabindex="0">
            <div class="hidden content">
                <i class="add icon"></i>
            </div>
            <div class="visible content">Add School</div>
        </div>
    </a>
@endif
<div class="ui horizontal divider">
    Your Courses
</div>
<br>
@if($user->school!=null)
    <div class="row">
        <a href="{{ action('CoursesController@create') }}">
            <div class="ui vertical animated positive button" tabindex="0">
                <div class="hidden content">
                    <i class="add icon"></i>
                </div>
                <div class="visible content">Add Course</div>
            </div>
        </a>
    </div>

    @foreach($user->school->courses as $course)
        <div class="center aligned four wide column">
            <div class="ui segment">
                <div class="ui vertical segment">
                    <h3><a href="{{ action('CoursesController@show', $course) }}">{{$course->name}}</a></h3>
                    @if($course->active)
                        <span class="floating ui green label">Active</span>
                    @else
                        <span class="floating ui yellow label">Inactive</span>
                    @endif
                    <p><a href="{{ action('CoursesController@details', $course) }}">Registered Users/Payment
                            Details</a></p>
                    <p><a href="{{ action('CoursesController@seats', $course) }}">Edit Seats Available</a></p>
                </div>
                <div class="ui vertical segment">
                    {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course], 'style'=>'display:inline-block;']) !!}
                    {!! Form::submit('Delete', ['class' => 'ui basic red small button']) !!}
                    {!! Form::close() !!}
                    <a class="ui basic blue small button"
                       href="{{ action('CoursesController@edit', $course) }}"
                       role="button">Edit Course</a>
                </div>
            </div>
        </div>
    @endforeach

@else
    <div class="ui button" id="message" data-content="Add your school before you can create a course">
        Add Courses
    </div>
@endif