@extends('app')

@section('content')
    <h1 class="ui block header">
        <div class="content">
            {{ $course->name }}
            <div class="sub header"><a
                        href="{{ action('SchoolsController@show', [$course->school]) }}">{{$course->school->name}}</a>
            </div>
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

            <div class="ui relaxed list">
                @foreach( $course->times as $time)
                    <div class="item">
                        <div class="ui middle aligned image">
                            {!! Form::open(['route' => ['cart.add', $course, $time], 'style' => 'display: inline']) !!}
                            <button type="submit" class="ui icon button teal">
                                <i class="large add to cart icon"></i>
                            </button>
                            {!! Form::close() !!}
                        </div>
                        <div class="middle aligned content">
                            <b>Seats Remaining: {{$time->pivot->num_seats - $time->pivot->num_reg}}</b>
                            <h4 class="ui header">
                                {{ $time->start_time->hour }}
                                :{{ $time->start_time->minute == 0 ?  "00" : $time->start_time->minute}}
                                -
                                {{ $time->end_time->hour }}
                                :{{ $time->start_time->minute == 0 ?  "00" : $time->start_time->minute}}
                                <div class="sub header">
                                    {{ $time->beginning_date->toFormattedDateString() }}
                                    to
                                    {{ $time->end_date->toFormattedDateString() }}
                                </div>
                            </h4>
                                {{$time->repeats()}}
                            <p>
                                @foreach( $time->days() as $key => $day )
                                    {{ $day }}
                                @endforeach
                            </p>
                        </div>
                    </div>
                @endforeach
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

    <br>

    @can('updateCourse', $course)
    @if(Auth::user()->admin)
        <a class="ui button" href="{{ action('UsersController@admin', [$course]) }}" role="button">To Admin Dashboard</a>
    @endif
    {!! Form::open(['method' => 'DELETE', 'route' => ['courses.destroy', $course], 'style' => 'display:inline;']) !!}
    {!! Form::submit('Delete', ['class' => 'ui red button']) !!}
    {!! Form::close() !!}

    <a class="ui blue button" href="{{ action('CoursesController@edit', [$course]) }}" role="button">Edit Course</a>

    <br>

    @endcan
    <h3 class="ui dividing header">
        Comments
    </h3>

    {!! Form::open([ 'action' => ['CoursesController@addComment', $course], 'class'=>'ui reply form']) !!}
    <div class="field">
        {!! Form::textarea('text', null, ['class'=>'form-control', 'rows' => 3]) !!}
    </div>
    {!! Form::submit('Comment', ['class' => 'ui blue submit icon button']) !!}
    {!! Form::close() !!}

    @if($course->comments->isEmpty())
        <div class="ui disabled center aligned header">
            No comments available
        </div>
        <br>
    @else
        <div class="ui comments">
            @foreach($course->comments->sortByDesc('created_at') as $comment)
                @include('partials.comment')
            @endforeach
        </div>
    @endif
@endsection