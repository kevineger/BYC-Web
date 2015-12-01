@extends('app')

@section('content')
    <h1>Cart Index</h1>
    <table class="table">
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
                    {!! Form::submit('Remove', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! Form::open(['method' => 'DELETE', 'route' => 'cart.destroyCart']) !!}
    {!! Form::submit('Delete Cart', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endsection