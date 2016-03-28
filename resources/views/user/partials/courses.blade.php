<div class="title">
    <i class="dropdown icon"></i>
    Courses
</div>
<div class="content">
    <div class="ui floating positive message">
        <p>{{$courses->whereLoose('active',1)->count()}} Active Course(s)</p>
    </div>
    <table class="ui single line table">
        <thead>
        <th>Name</th>
        <th>School</th>
        <th>Update/Delete</th>
        <th>Featured</th>
        </thead>
        <tbody>
        @foreach($courses->whereLoose('active',1) as $course)
            <tr>
                <td><a href="{{ action('CoursesController@show', $course) }}">{{$course->name}}</a></td>
                <td>{{$course->school->name}}</td>
                <td>{!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course], 'style' => 'display:inline;']) !!}
                    {!! Form::submit('Delete', ['class' => 'ui basic red button']) !!}
                    {!! Form::close() !!}

                    <a class="ui basic blue button" href="{{ action('CoursesController@edit', $course) }}"
                       role="button">Edit Course</a></td>
                <td>
                    @if($course->featured)
                        <a id="{{ $course->id }}" data-featured="true" class="ui basic teal button"
                           onclick="setFeatured(event, 'course')">Set as not featured</a>
                        <a class="ui teal tag label">Featured</a>
                    @else
                        <a id="{{ $course->id }}" data-featured="false" class="ui basic orange button"
                           onclick="setFeatured(event, 'course')">Set As Featured</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <div class="ui floating negative message">
        <p>{{$courses->whereLoose('active',0)->count()}} Inactive Course(s)</p>
    </div>
    <table class="ui single line table">
        <thead>
        <th>Name</th>
        <th>School</th>
        <th>Update/Delete</th>
        <th></th>
        </thead>
        <tbody>
        @foreach($courses->whereLoose('active',0) as $course)
            <tr>
                <td><a href="{{ action('CoursesController@show', $course) }}">{{$course->name}}</a></td>
                <td>{{$course->school->name}}</td>
                <td>{!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course], 'style' => 'display:inline;']) !!}
                    {!! Form::submit('Delete', ['class' => 'ui basic red button']) !!}
                    {!! Form::close() !!}
                    <a class="ui basic blue button" href="{{ action('CoursesController@edit', $course) }}"
                       role="button">Edit Course</a></td>
                <td>
                    @if($course->featured)
                        <a id="{{ $course->id }}" data-featured="true" class="ui basic teal button"
                           onclick="setFeatured(event, 'course')">Set as not featured</a>
                        <a class="ui teal tag label">Featured</a>
                    @else
                        <a id="{{ $course->id }}" data-featured="false" class="ui basic orange button"
                           onclick="setFeatured(event, 'course')">Set As Featured</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>
