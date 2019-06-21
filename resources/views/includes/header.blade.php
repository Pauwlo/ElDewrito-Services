<header class="header">
    <div class="navigation-trigger d-xl-none" data-action="aside-open" data-target=".sidebar">
        <i class="zwicon-hamburger-menu"></i>
    </div>

    <div class="logo d-none d-sm-inline-flex">
        <a href="{{ route('home') }}">{{ config('app.name', 'ElDewrito Services') }}</a>
    </div>

    <ul class="top-nav">
        <li id="fullscreen-container" style="display:none">
            <a href="#" data-action="fullscreen" title="{{ __('Toggle fullscreen') }}"><i class="zwicon-expand"></i></a>
        </li>

        <li>
            <a href="" class="top-nav__themes" data-action="aside-open" data-target=".themes"><i class="zwicon-palette"></i></a>
        </li>
    </ul>

    <div class="clock d-none d-md-inline-block">
        <div class="time">
            <span class="time__hours"></span>
            <span class="time__min"></span>
            <span class="time__sec"></span>
        </div>
    </div>
</header>
