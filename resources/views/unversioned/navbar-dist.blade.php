<!-- Right Side Of Navbar -->

<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    @if (Auth::guest())
        @if(Route::has('socialAuth.redirect'))
            <li><a href="{{ route('socialAuth.redirect', 'facebook') }}">Facebook</a></li>
        @endif

        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
    @else
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </li>
    @endif
</ul>

{{--<ul class="nav navbar-nav navbar-right">--}}
    {{--<!-- Authentication Links -->--}}
    {{--@if (Auth::guest())--}}
        {{--<li><a href="{{ url('/login') }}"><i class="fa fa-btn fa-sign-in"></i>Login</a></li>--}}
        {{--<li><a href="{{ url('/register') }}"><i class="fa fa-btn fa-user"></i>Register</a></li>--}}
    {{--@else--}}
        {{--@if(isset(Auth::user()->avatar))--}}
            {{--<li>--}}
                {{--<img style="max-height: 50px;" class="img-circle img-thumbnail" src="{{ Auth::user()->avatar }}">--}}
            {{--</li>--}}
        {{--@endif--}}

        {{--<li class="dropdown">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
            {{--</a>--}}

            {{--<ul class="dropdown-menu" role="menu">--}}
                {{--@can('index', \App\Mandante::class)--}}
                {{--<li>--}}
                    {{--<a href="{{ route('mandante.index') }}">--}}
                        {{--<i class="fa fa-btn fa-cogs"></i>Configurações--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--@endcan--}}
                {{--<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>--}}
            {{--</ul>--}}
        {{--</li>--}}
    {{--@endif--}}
{{--</ul>--}}