@extends('app')

@section('content')
    <div class="ui grid">
        <div class="eight wide column">
            <h1>{{ $course->name }}</h1>
            <h3>{{ $course->school->name }}</h3>
            <h3>Categories</h3>
            <ul>
                @foreach( $course->categories as $category)
                    <li>{{$category->text}}</li>
                @endforeach
            </ul>
            <ul>
                <li>Description: {{ $course->description }}</li>
                @if( $course->min_age == 0 && $course->max_age == 0)
                    <li>All Ages</li>
                @else
                    <li>Ages: {{ $course->min_age }} - {{ $course->max_age }}</li>
                @endif
                <li>Price: {{ $course->price }}</li>
                <div class="ui accordion">
                    <div class="title">
                        <i class="dropdown icon"></i>
                        Times
                    </div>
                    <div class="content">
                        @foreach( $course->times as $time)
                            <li>{{ $time->time_of_day }}
                                <ul>
                                    @if( $time->mon )
                                        <li>Monday</li>@endif
                                    @if( $time->tues )
                                        <li>Tuesday</li>@endif
                                    @if( $time->wed )
                                        <li>Wednesday</li>@endif
                                    @if( $time->thurs )
                                        <li>Thursday</li>@endif
                                    @if( $time->fri )
                                        <li>Friday</li>@endif
                                    @if( $time->sat )
                                        <li>Saturday</li>@endif
                                    @if( $time->sun )
                                        <li>Sunday</li>@endif
                                </ul>
                            </li>
                        @endforeach
                    </div>
                </div>
            </ul>
        </div>
        <div class="eight wide column">
            @foreach ($course->photos->chunk(4) as $set)
                <div class="ui grid">
                    @foreach($set as $photo)
                        <div class="eight wide column">
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
    {!! Form::submit("Add to Cart", ['class' => 'ui green button']) !!}
    {!! Form::close() !!}

    <br>

    @can('updateCourse', $course)
    {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course], 'style' => 'display:inline;']) !!}
    {!! Form::submit('Delete', ['class' => 'ui red button']) !!}
    {!! Form::close() !!}

    <a class="ui blue button" href="{{ action('CoursesController@edit', [$course]) }}" role="button">Edit Course</a>
    @endcan
@endsection

@section('footer')
    <script>
        $('.ui.accordion')
                .accordion()
        ;
    </script>
@endsection