@extends('app')

@section('page-header')
    <div class="page-header">
        <h2>Schools</h2>
    </div>
@endsection

@section('content')
    <div class="ui grid">
        <div class="four wide column">
            @include('partials.filter.school')
        </div>
        <div class="twelve wide column">
            <div class="ui grid">
                <div class="column">
                    @foreach( $schools->chunk(3) as $school_chunk )
                        <div class="ui three stackable link centered cards">
                            @foreach($school_chunk as $school)
                                <div class="ui card">
                                    <a class="image" href="{{ action('SchoolsController@show', [$school]) }}">
                                        @if(!$school->photos->isEmpty())
                                            <img src="/{{ $school->photos[0]->thumbnail_path }}" alt="photo">
                                        @else
                                            <img src="{{ asset('photos/tn-school.jpg') }}"
                                                 alt="photo">
                                        @endif
                                    </a>
                                    <div class="content">
                                        <a class="header"
                                           href="{{ action('SchoolsController@show', [$school]) }}">{{ $school->name }}</a>
                                        <div class="meta">
                                            <a>{{ $school->address }}</a>
                                        </div>
                                        <div class="description">
                                            This school is really awesome. It has a brief tagline descrition.
                                        </div>
                                    </div>
                                    <div class="extra content">
                                        <span class="right floated">
                                            Joined {{ $school->created_at->year }}
                                        </span>
                                        <span>
                                            <i class="bookmark icon"></i>
                                            {{ count($school->courses) }} courses
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{ asset('js/scripts.js') }}"></script>
@endsection