@extends('app')

@section('content')
    <h1 class="ui block header">
        <div class="content">
            {{ $course->name }}
            <div class="sub header">{{ $course->school->name }}</div>
            <div class="ui tag labels">
                @foreach( $course->categories as $category)
                    <a class="ui label">{{ $category->text }}</a>
                @endforeach
            </div>
        </div>
    </h1>
    <div class="ui two column middle aligned relaxed fitted stackable grid" style="position: relative">
        <div class="column">
            <div class="ui segment">
                <p>{{ $course->description }}</p>
            </div>
            @if( $course->min_age == 0 && $course->max_age == 0)
                <div class="ui green label">
                    All Ages
                </div>
            @else
                <div class="ui yellow label">
                    Min Age
                    <div class="detail">{{ $course->min_age }}</div>
                </div>
                <div class="ui orange label">
                    Max Age
                    <div class="detail">{{ $course->max_age }}</div>
                </div>
            @endif

            <h2 class="ui sub header">
                Price
            </h2>
            <span>${{ $course->price }}</span>

            <div class="ui accordion">
                <div class="title active">
                    <h2 class="ui sub header">
                        Times
                        <i class="dropdown icon"></i>
                    </h2>
                </div>
                <div class="content active">
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
        </div>
        <div class="ui vertical divider">
            <i class="circle thin icon light grey"></i>
        </div>
        <div class="column">
            @if( $course->photos->isEmpty())
                <div class="ui disabled center aligned header">
                    No photos available
                </div>
            @endif
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
    <h3 class="ui dividing header">
        Comments
    </h3>
    @if($course->comments->isEmpty())
        <div class="ui disabled center aligned header">
            No comments available
        </div>
        @else
            @foreach($course->comments as $comment)
                <div class="ui segment">
                    <img class="ui avatar image" src="http://semantic-ui.com/images/avatar2/small/molly.png">
                    <span>{{$comment->user->name}}</span>
                    <p>{{$comment->text}}</p>
                </div>
            @endforeach
        @endif
@endsection

@section('footer')
    <script>
        $('.ui.accordion').accordion();
    </script>
@endsection