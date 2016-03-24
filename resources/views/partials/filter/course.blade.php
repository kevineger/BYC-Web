{!! Form::open(['method' => 'GET', 'action' => 'CoursesController@index']) !!}
<div class="ui vertical menu">
    <div class="item">
        <div class="ui icon input">
            <input name="query_string" type="text" placeholder="Search" value="{{ Input::old('query_string') }}">
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
    <a class="item">
        <div class="ui slider range">
            <label class="ui" for="min-range-selector">Min Price</label>
            <div class="ui middle aligned centered grid">
                <div class="centered row">
                    <div class="twelve wide column" style="padding-right:3px;">
                        <input name="min_price" type="range" min="0"
                               max="{{ Input::old('max_price', $most_expensive) }}"
                               value="{{ Input::old('min_price', $cheapest) }}" id="min-range-selector"
                               oninput="minPriceUpdate(value)" class="ui fluid input" style="width:100%">
                    </div>
                    <div class="four wide column" style="padding-left:3px;">
                        <output class="ui label" for="min-range-selector"
                                id="min-price">{{ Input::old('min_price', $cheapest) }}</output>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui slider range">
            <label class="ui" for="min-range-selector">Max Price</label>
            <div class="ui middle aligned centered grid">
                <div class="centered row">
                    <div class="twelve wide column" style="padding-right:3px;">
                        <input name="max_price" type="range" min="{{ Input::old('min_price', $cheapest) }}" max="100"
                               value="{{ Input::old('max_price', $most_expensive) }}" id="max-range-selector"
                               oninput="maxPriceUpdate(value)" class="ui fluid input" style="width:100%">
                    </div>
                    <div class="four wide column" style="padding-left:3px;">
                        <output class="ui label" for="max-range-selector"
                                id="max-price">{{ Input::old('max_price', $most_expensive) }}</output>
                    </div>
                </div>
            </div>
        </div>
    </a>
    <div class="ui item">
        <p>Start/End Time</p>
        <div class="ui two column grid">
            <div style="padding-right:3px;" class="column">
                <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
                    <div class="ui fluid icon input">
                        <input class="time-input" name="start_time" type="text" value="{{ Input::old('start_time') }}">
                        <i class="wait icon"></i>
                    </div>
                </div>
            </div>
            <div style="padding-left:3px;" class="column">
                <div class="input-group clockpicker" data-placement="top" data-align="top" data-autoclose="true">
                    <div class="ui fluid icon input">
                        <input class="time-input" name="end_time" type="text" value="{{ Input::old('end_time') }}">
                        <i class="wait icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui item">
        <p>Start/End Date</p>
        <div class="ui two column grid">
            <div style="padding-right:3px;" class="column">
                <div class="ui fluid icon input">
                    <input name="start_date" type="text" class="datepicker time-input"
                           value="{{ Input::old('start_date') }}"/>
                    <i class="calendar icon"></i>
                </div>
            </div>
            <div style="padding-left:3px;" class="column">
                <div class="ui fluid icon input">
                    <input name="end_date" type="text" class="datepicker time-input"
                           value="{{ Input::old('end_date') }}"/>
                    <i class="calendar icon"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="ui item">
        <p>Restrict Days</p>
        <div class="ui circular labels days">
            <a id="sun" class="ui grey circular label day">S</a>
            <a id="mon" class="ui grey circular label day">M</a>
            <a id="tue" class="ui grey circular label day">T</a>
            <a id="wed" class="ui grey circular label day">W</a>
            <a id="thu" class="ui grey circular label day">T</a>
            <a id="fri" class="ui grey circular label day">F</a>
            <a id="sat" class="ui grey circular label day">S</a>
        </div>
    </div>
    <div class="ui item">
        <div class="ui large buttons">
            <button type="submit" class="ui button teal">Filter</button>
            <div class="or"></div>
            <button onclick="clearFilter(event)" class="ui button">Clear</button>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@section('footer')
    @parent
    <script>
        {{--Load the active days--}}
        $(document).ready(function () {
            var days = {!! json_encode(Request::old('days')) !!};
            if (days) {
                days.forEach(function (day) {
                    $('#' + day).trigger('click');
                });
            }
            {{--Date Picker--}}
            $(".datepicker").datepicker();
        });
        {{--ClockPicker--}}
        $('.clockpicker').clockpicker();
        $('.day').click(function (e) {
            var dayOfWeek = $(e.target);
            // If adding day of week
            if (dayOfWeek.hasClass('grey')) {
                dayOfWeek.removeClass('grey').addClass('teal');
                dayOfWeek.parent().append('<input class=' + dayOfWeek.attr('id') + ' type="hidden" name="days[]" value=' + dayOfWeek.attr('id') + '>');
            } else {
                // Removing day of week
                dayOfWeek.removeClass('teal').addClass('grey');
                console.log(dayOfWeek.parent());
                dayOfWeek.parent().find("." + dayOfWeek.attr('id')).remove();
            }
        });

        function clearFilter(e) {
            // Too lazy to do this properly, just reload the /courses url.
            e.preventDefault();
            window.location.replace("/courses");
        }
    </script>
@endsection