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
                <td>
                    <div class="ui list">
                        <div class="item">
                            Start Date: {{$row->options->beginning_date}}
                        </div>
                        <div class="item">
                            End Date: {{$row->options->end_date}}
                        </div>
                        <div class="item">
                            Time: {{$row->options->start_time}} - {{$row->options->end_time}}
                        </div>
                        <div class="item">
                            Days:
                            <ul>
                                @foreach( $row->options->days as $day )
                                    <li>{{ $day }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

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
    {!! Form::submit('Checkout', ['class' => 'ui teal disabled button']) !!}
    {!! Form::close() !!}
    {!! Form::open(['method' => 'DELETE', 'route' => 'cart.destroyCart', 'style' => 'display:inline']) !!}
    {!! Form::submit('Delete Cart', ['class' => 'ui red disabled button']) !!}
    {!! Form::close() !!}
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            var size_of_content = JSON.parse("{{ json_encode(sizeof($content)) }}");
            if (size_of_content > 0) {
                $('.ui.button').removeClass('disabled');
            }
        });
    </script>
@endsection