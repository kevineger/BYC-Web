@extends('app')

@section('content')
    <h1>Cart Index</h1>
    <table class="ui celled table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Item Price</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ( $content as $row )
            <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->qty }}</td>
                <td>{{ $row->price }}</td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['cart.destroy', $row->rowid]]) !!}
                    {!! Form::submit('Remove', ['class' => 'ui red button']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! Form::open(['method' => 'POST', 'route' => 'cart.buy', 'style' => 'display:inline']) !!}
    {!! Form::submit('Checkout', ['class' => 'ui teal button']) !!}
    {!! Form::close() !!}
    {!! Form::open(['method' => 'DELETE', 'route' => 'cart.destroyCart', 'style' => 'display:inline']) !!}
    {!! Form::submit('Delete Cart', ['class' => 'ui red button']) !!}
    {!! Form::close() !!}
@endsection