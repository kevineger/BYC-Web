@extends('app')

@section('content')
    <h1>School Index</h1>
    <ul>
        @foreach( $schools as $school )
            <div class="col-md-4 col-sm-4">
            <a href="{{ action('SchoolsController@show', [$school]) }}">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$school->name}}</h3>
                    </div>
                    <div class="panel-body">
                        <div>
                            <h7>Vendor: {{$school->user->name}}</h7>
                        </div>
                        <div>
                            <h9>Address: {{$school->address}}</h9>
                        </div>
                    </div>
                </div>
            </a>
            </div>
            {{--<li><a href="{{ action('SchoolsController@show', [$school]) }}">{{ $school->name }}</a></li>--}}
        @endforeach
    </ul>
@endsection