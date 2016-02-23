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

            {{--<div class="ui relaxed divided list">
                <div class="item">
                    <i class="large github middle aligned icon"></i>
                    <div class="content">
                        <a class="header">Semantic-Org/Semantic-UI</a>
                        <div class="description">Updated 10 mins ago</div>
                    </div>
                </div>
            </div>--}}

            <div class="ui relaxed list">
                @foreach( $course->times as $time)

                    <div class="item">
                        <div class="image">
                            {!! Form::open(['route' => ['cart.add', $course, $time], 'style' => 'display: inline']) !!}
                            <button type="submit" class="ui icon button teal">
                                <i class="large add to cart icon"></i>
                            </button>
                            {!! Form::close() !!}
                        </div>
                        <div class="middle aligned content">
                            <div class="header">{{ $time->time_of_day }}</div>
                            <p>
                                @foreach( $time->days() as $key => $day )
                                    {{ $day }}
                                @endforeach
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            {{--<div class="ui accordion">
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
                                @foreach( $time->days() as $day )
                                    <li>{{ $day }}</li>
                                @endforeach
                            </ul>
                            {!! Form::open(['route' => ['cart.add', $course, $time]]) !!}
                            {!! Form::submit("Add to Cart", ['class' => 'ui green button']) !!}
                            {!! Form::close() !!}
                        </li>
                    @endforeach
                </div>
            </div>--}}
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
        <br>
    @else
        <div class="ui comments">
            @foreach($course->comments as $comment)
                <div class="comment">
                    <a class="avatar">
                        <img src="http://semantic-ui.com/images/avatar2/small/molly.png">
                    </a>
                    <div class="content">
                        <a class="author">{{$comment->user->name}}</a>
                        <div class="metadata">
                            <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text">
                            {{$comment->text}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('footer')
    <script>
        $('.ui.accordion').accordion();
    </script>
@endsection