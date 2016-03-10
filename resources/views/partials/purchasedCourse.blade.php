<div class="column">
    <div class="ui segment">
        <p>
            <a href="{{ action('CoursesController@show', $purchase->course) }}"><b>Course: {{$purchase->course->name}}</b></a>
        </p>
        <p>Start Date: {{$purchase->time->beginning_date}}</p>
        <p>End Date: {{$purchase->time->end_date}}</p>
        <p>Time: {{$purchase->time->start_time}} - {{$purchase->time->end_time}}</p>
        <p>Days:</p>
        <ul>
            @foreach( $purchase->time->days() as $key => $day )
                <li>{{ $day }}</li>
            @endforeach
        </ul>
        <p>Quantity Bought: {{$purchase->quantity}}</p>
        <p>Total Price: {{$purchase->subtotal}}</p>
    </div>
</div>