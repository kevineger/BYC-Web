@extends('app')

@section('content')
    <h1>Course Index</h1>
    <div class="ui grid">
        <div class="four wide column">
            {!! Form::open(['method' => 'GET', 'action' => 'SearchController@index']) !!}
            <div class="ui vertical menu">
                <div class="item">
                    <div class="ui icon input">
                        <input name="q" type="text" placeholder="Search">
                        <i class="search icon"></i>
                    </div>
                </div>
                <div class="item">
                    Categories
                    <div class="menu">
                        <a class="active item">All</a>
                        <a class="item">Education</a>
                        <a class="item">Athletics</a>
                        <a class="item">Support Groups</a>
                        <a class="item">Languages</a>
                    </div>
                </div>
                <a class="item">
                    View Style <i class="list layout icon" href="#"></i> <i class="active grid layout icon"
                                                                            href="#"></i>
                </a>
                <a class="item">
                    <div class="ui slider range">
                        <label class="ui" for="min-range-selector">Min Price</label>
                        <output class="ui label" for="min-range-selector" id="min-price">50</output>
                        <input type="range" min="0" max="200" value="50" id="min-range-selector"
                               oninput="minPriceUpdate(value)">
                    </div>
                </a>
                <a class="item">
                    <div class="ui slider range">
                        <label class="ui" for="min-range-selector">Max Price</label>
                        <output class="ui label" for="max-range-selector" id="max-price">200</output>
                        <input type="range" min="50" max="300" value="200" id="max-range-selector"
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
                    {!! Form::close() !!}
                </div>
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
                                        @if( !$course->school->photos->isEmpty())
                                            <div class="ui bottom right attached label">4 Times</div>
                                        @else
                                            <div class="ui bottom right attached label">2 Times</div>
                                        @endif
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
    </script>
@endsection
