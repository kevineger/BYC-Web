{!! Form::open(['method' => 'GET', 'action' => 'SchoolsController@index']) !!}
<div class="ui vertical menu">
    <div class="item">
        <div class="ui icon input">
            <input name="query_string" type="text" placeholder="Search">
            <i class="search icon"></i>
        </div>
    </div>
    <div class="item">
        Categories
        @include('partials.filter.categories')
    </div>
    {{--<a class="item">--}}
        {{--View Style <i class="list layout icon" href="#"></i> <i class="active grid layout icon"--}}
                                                                {{--href="#"></i>--}}
    {{--</a>--}}
    <div class="ui item">
        <div class="ui large buttons">
            <button type="submit" class="ui button teal">Filter</button>
            <div class="or"></div>
            <button onclick="" class="ui button">Clear</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>