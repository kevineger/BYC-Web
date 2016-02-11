@extends('app')

@section('page-header')
    <div class="page-header">
        <h2>Schools</h2>
    </div>
@endsection

@section('content')
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
                @foreach( $schools->chunk(3) as $school_chunk )
                    <div class="three column row">
                        @foreach($school_chunk as $school)
                            <div class="column">
                                <div class="ui link cards">
                                    <div class="card">
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
                                               href="{{ action('SchoolsController@show', [$school]) }}">{{$school->name}}</a>
                                            <div class="meta">
                                                <a>{{$school->address}}</a>
                                            </div>
                                            <div class="description">
                                                This school is really awesome. It has a brief tagline descrition.
                                            </div>
                                        </div>
                                        <div class="extra content">
                                    <span class="right floated">
                                        Joined in 2013
                                    </span>
                                    <span>
                                        <i class="bookmark icon"></i>
                                        13 courses
                                    </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection