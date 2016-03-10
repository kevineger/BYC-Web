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
        <li>Course: {{$purchase->course->name}}</li>
        <li>Start Date: {{$purchase->time->beginning_date}}</li>
        <li>End Date: {{$purchase->time->end_date}}</li>
        <li>Time: {{$purchase->time->start_time}} - {{$purchase->time->end_time}}</li>
        <li>Days:
            <ul>
                @foreach( $purchase->time->days() as $key => $day )
                    <li>{{ $day }}</li>
                @endforeach
            </ul>
        </li>
        <li>Quantity Bought: {{$purchase->quantity}}</li>
        <li>Total Price: {{$purchase->subtotal}}</li>
    @endforeach

</ul>

</body>
</html>