@extends('app')

@section('head')
    <meta name="publishable-key" content="{{ config('services.stripe.key') }}">

@section('content')
    <h1>Buy for $10</h1>
    {!! Form::open(['id' => 'billing-form']) !!}
    <div class="form-group">
        {!! Form::label('Card Number') !!}
        {!! Form::text(null, null, ['class' => 'form-control', 'data-stripe' => 'number']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('CVC') !!}
        {!! Form::text(null, null, ['class' => 'form-control', 'data-stripe' => 'cvc']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Expiration Date') !!}
        {!! Form::selectMonth(null, null, ['class' => 'form-control', 'data-stripe' => 'exp-month']) !!}
        {!! Form::selectRange(null, date('Y'),  date('Y') + 10, null, ['class' => 'form-control', 'data-stripe' => 'exp-year']) !!}
    </div>
    {!! Form::submit('Buy Now', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection

@section('footer')
    <script src = "{{ asset('js/billing.js') }}"></script>
@endsection