@extends('app')

@section('content')

    <h1 class="ui block header">
        <div class="content">
            {{ $course->name }}
        </div>
    </h1>

    @if($course->times->count()>0)
        <div class="ui grid">
            @foreach($course->times as $time)
                <div class="center aligned four wide column">
                    <div class="ui segment">
                        <div class="ui vertical segment">
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
                                    <p>
                                        @foreach( $time->days() as $day )
                                            {{ $day }}
                                        @endforeach
                                    </p>
                                </div>
                                {{$time->repeats()}}
                            </h4>
                            <p>Total Seats: {{$time->pivot->num_seats}}</p>

                            <p>Number of people registered: {{$time->pivot->num_reg}}</p>

                            <p>Seats Remaining: {{$time->pivot->num_seats - $time->pivot->num_reg}}</p>
                        </div>
                        <div class="ui vertical segment">
                            <h4 class="ui header">Increase/Decrease Available Seats</h4>

                            @if($time->pivot->num_reg<$time->pivot->num_seats)
                                <a href="{{ action('CoursesController@decreaseSeats', [$course, $time])}}"
                                   class="ui basic red button"><i class="minus icon"></i></a>
                            @else
                                <div class="ui basic red button" id="message"
                                     data-content="Cannot decrease anymore seats.">
                                    <i class="minus icon"></i>
                                </div>
                            @endif

                            <a href="{{ action('CoursesController@increaseSeats', [$course, $time])}}"
                               class="ui basic green button"><i class="plus icon"></i></a>
                        </div>
                        <div class="ui vertical segment">
                            <h4 class="ui header">Increase Students Registered</h4>
                            @if($time->pivot->num_reg<$time->pivot->num_seats)
                                <a href="{{ action('CoursesController@increaseRegistered', [$course, $time])}}"
                                   class="ui basic green button"><i class="plus icon"></i></a>
                            @else
                                <div class="ui basic green button" id="message2"
                                     data-content="Cannot add anymore students, class is full"><i class="plus icon"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="ui disabled center aligned header">
            No course times available
        </div>
    @endif

@endsection

@section('footer')
    <script>
        $('#message').popup();
        $('#message2').popup();
    </script>
@endsection