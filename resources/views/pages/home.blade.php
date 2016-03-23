@extends('app')

@section('page-header')
    <div class="banner">
        <div class="div">
            <div class="frosted-container">
                <h2>Book Your Class</h2>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="ui centered grid">
        <div class="twelve wide column">
            @include('partials.home.globalSearch')
        </div>
    </div>

    <br>
    <br>

    <div class="ui two column grid">
        <div class="column">
            <div class="ui equal width center aligned padded grid">
                <div class="row">
                    <div class="column">
                        <h2 class="ui icon header">
                            <i class="student icon"></i>
                            <div class="content">
                                @if($is_search)
                                    Schools
                                @else
                                    Featured Schools
                                @endif
                            </div>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        @include('partials.schools.featured')
                    </div>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="ui equal width center aligned padded grid">
                <div class="row">
                    <div class="column">
                        <h2 class="ui icon header">
                            <i class="table icon"></i>
                            <div class="content">
                                @if($is_search)
                                    Courses
                                @else
                                    Featured Courses
                                @endif
                            </div>
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        @include('partials.courses.featured')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('.special.cards .image').dimmer({
            on: 'hover'
        });
    </script>
@endsection