<div class="title">
    <i class="dropdown icon"></i>
    Payment
</div>
<div class="content">
    <div class="ui floating info message">
        <p>{{$purchases->count()}} Purchase(s)</p>
    </div>
    <table class="ui single line table">
        <thead>
        <th>Course</th>
        <th>Consumer</th>
        <th>Vendor</th>
        <th>Quantity</th>
        <th>Payment Amount</th>
        <th>Paypal Id</th>
        <th>Date of Purchase</th>
        </thead>
        <tbody>
        @foreach($purchases as $purchase)
            <tr>
                <td>{{$purchase->course->name}}</td>
                <td>{{$purchase->payment->user->name}}</td>
                <td>{{$purchase->course->school->user->name}}</td>
                <td>{{$purchase->quantity}}</td>
                <td>{{$purchase->subtotal}}</td>
                <td>{{$purchase->payment->paypal_id}}</td>
                <td>{{$purchase->created_at}}</td>
            </tr>
        @endforeach
    </table>
</div>