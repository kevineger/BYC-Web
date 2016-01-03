@extends('app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <h1>{{ $school->name }}</h1>
            <h3>{{ $school->user->name }}</h3>
            <ul>
                <li>{{ $school->name }}</li>
                <li>{{ $school->description }}</li>
                <li>{{ $school->address }}</li>
            </ul>
            <hr>
            <h3>Courses</h3>
            <ul>
                @foreach( $school->courses as $course )
                    <li><a href="{{ action('CoursesController@show', [$course]) }}">{{ $course->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-4">
            @foreach( $school->photos as $photo )
                <img style="width:100%;" src="/{{ $photo->path }}" alt="Photo">
            @endforeach
        </div>
    </div>
    @can('update', $school)
    {!! Form::open(['method' => 'DELETE', 'route' => ['schools.destroy', $school]]) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <a class="btn btn-primary" href="{{ action('SchoolsController@edit', [$school]) }}" role="button">Edit School</a>
    @endcan
@endsection