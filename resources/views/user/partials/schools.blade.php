<h3 class="ui dividing header">
    Schools
</h3>
<div class="ui floating info message">
    <p>{{$schools->count()}} School(s)</p>
</div>
<table class="ui single line table">
    <thead>
    <th>Name</th>
    <th>Vendor</th>
    <th># Courses</th>
    <th>Update/Delete</th>
    <th>Featured</th>
    </thead>
    <tbody>
    @foreach($schools as $school)
        <tr>
            <td><a href="{{ action('SchoolsController@show', $school) }}">{{$school->name}}</a></td>
            <td>{{$school->user->name}}</td>
            <td>{{$school->courses->count()}}</td>
            <td>{!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $school], 'style'=>'display:inline-block;']) !!}
                {!! Form::submit('Delete', ['class' => 'ui basic red button']) !!}
                {!! Form::close() !!}
                <a class="ui basic blue button" href="{{ action('SchoolsController@edit', $school) }}"
                   role="button">Edit
                    School</a>
            </td>
            <td>
                @if($school->featured)
                    <a id="{{ $school->id }}" data-featured="true" class="ui basic teal button" onclick="setFeatured(event, 'school')">Set as not featured</a>
                    <a class="ui teal tag label">Featured</a>
                @else
                    <a id="{{ $school->id }}" data-featured="false" class="ui basic orange button" onclick="setFeatured(event, 'school')">Set As Featured</a>
                @endif
            </td>

        </tr>
    @endforeach
</table>