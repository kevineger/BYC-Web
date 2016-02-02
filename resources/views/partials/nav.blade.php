<div class="nav-margin">
    <div class="ui large menu">
        <div class="ui container">
            <a href="{{ url('/schools') }}" class="item">Schools</a>
            <a href="{{ url('/courses') }}" class="item">Courses</a>

            <div class="right menu">
                <a href="{{ action('CartController@index') }}" class="item">Cart</a>
                @if (Auth::guest())
                    <a href="{{ url('/auth/login') }}" class="item">Login</a>
                    <a href="{{ url('/auth/register') }}" class="item">Register</a>
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
    </div>
</div>