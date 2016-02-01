@extends('app')

@section('content')
    <div class="row">
        <h1>{{ $course->name }}</h1>
        <h3>{{ $course->school->name }}</h3>
        <ul>
            <li>Description: {{ $course->description }}</li>
            @if( $course->min_age == 0 && $course->max_age == 0)
                <li>All Ages</li>
            @else
                <li>Ages: {{ $course->min_age }} - {{ $course->max_age }}</li>
            @endif
            <li>Price: {{ $course->price }}</li>
            @foreach( $course->times as $time)
                <li>{{ $time->time_of_day }}
                    <ul>
                        @if( $time->mon )<li>Monday</li>@endif
                        @if( $time->tues )<li>Tuesday</li>@endif
                        @if( $time->wed )<li>Wednesday</li>@endif
                        @if( $time->thurs )<li>Thursday</li>@endif
                        @if( $time->fri )<li>Friday</li>@endif
                        @if( $time->sat )<li>Saturday</li>@endif
                        @if( $time->sun )<li>Sunday</li>@endif
                    </ul>
                </li>
            @endforeach
        </ul>
        <div class="col-lg-8">
            @foreach ($course->photos->chunk(4) as $set)
                <div class="row">
                    @foreach($set as $photo)
                        <div class="col-md-3">
                            <a href="/{{ $photo->path }}" data-lity>
                                <img style="width:100%" src="/{{ $photo->thumbnail_path }}" alt="Photo">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    {!! Form::open(['route' => ['cart.add', $course]]) !!}
    {!! Form::submit("Add to Cart", ['class' => 'btn btn-info']) !!}
    {!! Form::close() !!}

    @can('updateCourse', $course)
    {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course]]) !!}
    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

    <a class="btn btn-primary" href="{{ action('CoursesController@edit', [$course]) }}" role="button">Edit Course</a>
    @endcan



@endsection
