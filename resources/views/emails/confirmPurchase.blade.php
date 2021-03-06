<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Purchase Confirmed</title>
</head>
<body>
<h1>Thank you for your purchase!</h1>

<h3>You bought</h3>
<ul>
    @foreach($purchases as $purchase)
        <p>Course: {{$purchase->course->name}}</p>
        <p>Start Date: {{$purchase->time->beginning_date->toFormattedDateString() }}</p>
        <p>End Date: {{$purchase->time->end_date->toFormattedDateString() }}</p>
        <p>Time: {{ $purchase->time->start_time->hour }}
            :{{ $purchase->time->start_time->minute == 0 ?  "00" : $purchase->time->start_time->minute}}
            -
            {{ $purchase->time->end_time->hour }}
            :{{ $purchase->time->start_time->minute == 0 ?  "00" : $purchase->time->start_time->minute}}</p>
        <p>Repeats: {{$purchase->time->repeats()}}</p>
        <p>Days:</p>
        <ul>
            @foreach( $purchase->time->days() as $day )
                <li>{{ $day }}</li>
            @endforeach
        </ul>
        <p>Quantity Bought: {{$purchase->quantity}}</p>
        <p>Total Price: {{$purchase->subtotal}}</p>
        <hr>
    @endforeach

</ul>

</body>
</html>
