@extends('app')

@section('content')

    <h1 class="ui block header">
        <div class="content">
            {{ $course->name }}
        </div>
    </h1>
    <h3 class="ui dividing header">Users Registered</h3>

    @if($course->purchases->count()>0)
        <div class="ui grid">
        @foreach($course->purchases as $purchase)
            <div class="four wide column">
            <div class="ui segment">
                <p>User: <a href="{{ action('UsersController@show', $purchase->payment->user) }}">{{$purchase->payment->user->name}}</a></p>
                <p>Quantity Purchased: {{$purchase->quantity}}</p>
                <p>Payment Amount: {{$purchase->subtotal}}</p>
            </div>
            </div>
        @endforeach
        </div>

    @else
        <div class="ui disabled center aligned header">
            No users have registered yet
        </div>
    @endif

@endsection