@extends('app')

@section('page-header')
    <div class="page-header">
        <h2>Courses</h2>
    </div>
@endsection

@section('content')
    <div class="ui grid">
        <div class="four wide column">
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
                    <div class="menu">
                        <div class="ui form">
                            <div class="grouped fields">
                                <a class="item">
                                    <div class="ui checkbox">
                                        {{--If no categories were specified, check All--}}
                                        @if(!Input::old('categories'))
                                            <input name="all_cat" onclick="allCategories()" type="checkbox" id="all_cat"
                                                   checked="checked">
                                        @else
                                            <input onclick="allCategories()" type="checkbox" id="all_cat">
                                        @endif
                                        <label>All</label>
                                    </div>
                                </a>
                                @foreach($categories as $category)
                                    <a class="item">
                                        <div class="ui checkbox">
                                            @if(in_array($category->text, Input::old('categories', [])))
                                                {{--TODO: Figure out non-disgusting way to do this--}}
                                                <input onclick="specificCategories()" type="checkbox"
                                                       name="categories[]"
                                                       value="{{ $category->text }}" class="category" checked>
                                            @else
                                                <input onclick="specificCategories()" type="checkbox"
                                                       name="categories[]"
                                                       value="{{ $category->text }}" class="category">
                                            @endif
                                            <label>{{ $category->text }}</label>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
                <div class="ui dropdown item">
                    More
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item"><i class="edit icon"></i> Edit Profile</a>
                        <a class="item"><i class="globe icon"></i> Choose Language</a>
                        <a class="item"><i class="settings icon"></i> Account Settings</a>
                    </div>
                </div>
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
        <div class="twelve wide column">
            <div class="ui grid">
                @foreach( $courses->chunk(3) as $course_chunk )
                    <div class="three column row">
                        @foreach( $course_chunk as $course )
                            <div class="column">

                                <a class="ui card" href="{{ action('CoursesController@show', [$course]) }}">
                                    <div class="content">
                                        <div class="ui bottom right attached label">{{ sizeof($course->times) }} times
                                        </div>
                                        <div class="header">{{$course->name}}</div>
                                        <div class="meta">
                                            <span class="category">{{$course->school->name}}</span>
                                        </div>
                                        <div class="description">
                                            <p>{{ $course->description }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        function minPriceUpdate(vol) {
            $('#max-range-selector').attr('min', vol);
            document.querySelector('#min-price').value = vol;
        }
        function maxPriceUpdate(vol) {
            $('#min-range-selector').attr('max', vol);
            document.querySelector('#max-price').value = vol;
        }
        // Uncheck all specific categories
        function allCategories() {
            $('#all_cat').change(function () {
                if (this.checked) {
                    $('input:checkbox.category').prop('checked', false);
                }
            });
        }
        // Untoggle the "All" category
        function specificCategories() {
            $('#all_cat').prop('checked', false);
        }

    </script>
@endsection
