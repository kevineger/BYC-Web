<div class="ui container secondary pointing menu">
    <a href="{{ url('/') }}" class="{{ Request::is( '/') ? 'active' : '' }} item">Home</a>
    <a href="{{ url('/schools') }}" class="{{ Request::is( 'schools') ? 'active' : '' }} item">Schools</a>
    <a href="{{ url('/courses') }}" class="{{ Request::is( 'courses') ? 'active' : '' }} item">Courses</a>

    <div class="right menu">
        <a href="{{ action('CartController@index') }}"
           class="{{ Request::is( 'cart') ? 'active' : '' }} item">Cart</a>
        @if (Auth::guest())
            <a href="{{ url('/auth/login') }}"
               class="{{ Request::is( 'auth/login') ? 'active' : '' }} item">Login</a>
            <a href="{{ url('/auth/register') }}" class="{{ Request::is( 'auth/register') ? 'active' : '' }} item">Register</a>
        @else
            <div class="ui simple dropdown item">
                {{ Auth::user()->name }} <i class="dropdown icon"></i>

                <div class="menu">
                    <a href="{{ action('UsersController@show', [Auth::user()]) }}" class="item">Profile</a>
                    <a href="{{ url('/auth/logout') }}" class="item">Logout</a>
                </div>
            </div>
        @endif
    </div>
</div>

@yield('page-header')
