{!! Form::open(['method' => 'GET', 'action' => 'CoursesController@index']) !!}
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
    <a class="item">
        View Style <i class="list layout icon" href="#"></i> <i class="active grid layout icon"
                                                                href="#"></i>
    </a>
    <a class="item">
        <div class="ui slider range">
            <label class="ui" for="min-range-selector">Min Price</label>
            <output class="ui label" for="min-range-selector"
                    id="min-price">{{ $cheapest }}</output>
            <input name="min_price" type="range" min="0" max="{{ $most_expensive }}"
                   value="{{ $cheapest }}" id="min-range-selector"
                   oninput="minPriceUpdate(value)">
        </div>
    </a>
    <div class="four wide column">
        {!! Form::open(['method' => 'GET', 'action' => 'CoursesController@index']) !!}

        <a class="item">
            <div class="ui slider range">
                <label class="ui" for="min-range-selector">Max Price</label>
                <output class="ui label" for="max-range-selector"
                        id="max-price">{{ $most_expensive }}</output>
                <input name="max_price" type="range" min="{{ $cheapest }}" max="100"
                       value="{{ $most_expensive }}" id="max-range-selector"
                       oninput="maxPriceUpdate(value)">
            </div>
        </a>
        <div class="ui item">
            <div class="ui large buttons">
                <button type="submit" class="ui button teal">Filter</button>
                <div class="or"></div>
                <button onclick="" class="ui button">Clear</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>