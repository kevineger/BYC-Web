@extends('app')

@section('content')
    <h1>Cart Index</h1>
    <table class="ui celled table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Time</th>
            <th>Qty</th>
            <th>Item Price</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ( $content as $row )
            <tr>
                <td>{{ $row->name }}</td>
                <td>{{ $row->options->time_of_day }}
                    <ul>
                        @foreach( $row->options->days as $day )
                            <li>{{ $day }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $row->qty }}</td>
                <td>{{ $row->price * $row->qty }}</td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['cart.destroy', $row->rowid]]) !!}
                    {!! Form::submit('Remove', ['class' => 'ui red button']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! Form::open(['method' => 'POST', 'route' => ['payment', $content], 'style' => 'display:inline']) !!}
    {!! Form::submit('Checkout', ['class' => 'ui teal button']) !!}
    {!! Form::close() !!}
    {!! Form::open(['method' => 'DELETE', 'route' => 'cart.destroyCart', 'style' => 'display:inline']) !!}
    {!! Form::submit('Delete Cart', ['class' => 'ui red button']) !!}
    {!! Form::close() !!}
@endsection