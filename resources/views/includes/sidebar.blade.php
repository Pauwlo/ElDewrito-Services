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
                    <img class="user__img" src="{{ asset('img/avatars/' . (auth()->user()->avatar ?? 'default.png')) }}" alt="{{ __('Avatar') }}">
                    <div>
                        <div class="user__name">{{ auth()->user()->name }}</div>
                        <div class="user__email">{{ auth()->user()->roleToString() }}</div>
                    </div>
                </div>

                <div class="dropdown-menu">
                    <a href="{{ route('profile') }}" class="dropdown-item">{{ __('Profile') }}</a>
                    
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
            <li{!! (Route::is('home')) ? ' class="navigation__active"' : '' !!}><a href="{{ route('home') }}"><i class="zwicon-home"></i> {{ __('Home') }}</a></li>

            @can('official-playlists.access')
                <li class="navigation__sub{!! (Route::is('official-playlists.*')) ? ' navigation__sub--active' : '' !!}">
                    <a href=""><i class="zwicon-server-stack"></i> {{ __('Official Playlists') }}</a>

                    <ul>
                        <li{!! (Route::is('official-playlists.playlists.*')) ? ' class="navigation__active"' : '' !!}><a href="{{ route('official-playlists.playlists.index') }}">{{ __('Playlists') }}</a></li>
                        <li{!! (Route::is('official-playlists.maps.*')) ? ' class="navigation__active"' : '' !!}><a href="{{ route('official-playlists.maps.index') }}">{{ __('Maps') }}</a></li>
                        <li{!! (Route::is('official-playlists.variants.*')) ? ' class="navigation__active"' : '' !!}><a href="{{ route('official-playlists.variants.index') }}">{{ __('Variants') }}</a></li>
                        <li{!! (Route::is('official-playlists.commands.*')) ? ' class="navigation__active"' : '' !!}><a href="{{ route('official-playlists.commands.index') }}">{{ __('Commands') }}</a></li>
                        <li{!! (Route::is('official-playlists.options.*')) ? ' class="navigation__active"' : '' !!}><a href="{{ route('official-playlists.options.index') }}">{{ __('Options') }}</a></li>
                    </ul>
                </li>
            @endcan

            <li class="navigation__sub">
                <a href=""><i class="zwicon-web"></i> {{ __('External links') }}</a>

                <ul>
                    <li><a href="https://www.reddit.com/r/HaloOnline/" target="_blank">Halo Online Subreddit</a></li>
                    <li><a href="https://blog.eldewrito.com/" target="_blank">ElDewrito Blog</a></li>
                    <li><a href="http://halostats.click/" target="_blank">Halostats</a></li>
                    <li><a href="https://www.pauwlo.fr/" target="_blank">Pauwlo.fr</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>