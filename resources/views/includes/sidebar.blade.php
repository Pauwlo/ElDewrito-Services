<aside class="sidebar">
    <div class="scrollbar">
        <div class="user">
            @guest
                <div class="user__info">
                    <p class="text-center mb-0" style="width:100%;font-size:1.2em">
                        {{ __('Welcome, guest.') }}<br>
                        {!! __('misc.login_or_register') !!}
                    </p>
                </div>
            @else
                <div class="user__info user__info--hover" data-toggle="dropdown">
                    <img class="user__img" src="{{ asset('img/avatars/default.png') }}" alt="{{ __('Avatar') }}">
                    <div>
                        <div class="user__name">{{ Auth::user()->name }}</div>
                        <div class="user__email">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="dropdown-menu">
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </div>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">
                    @csrf
                </form>
            @endguest
        </div>

        <ul class="navigation">
            <li{!! (Route::currentRouteName() == 'home') ? ' class="navigation__active"' : '' !!}><a href="{{ route('home') }}"><i class="zwicon-home"></i> {{ __('Home') }}</a></li>
        </ul>
    </div>
</aside>
