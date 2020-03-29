<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="referrer" content="no-referrer">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ __('Error') }} @yield('code') – {{ config('app.name', 'ElDewrito Services') }}</title>

    <link rel="stylesheet" href="{{ asset('vendors/zwicon/zwicon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://www.googletagmanager.com/gtag/js?id=UA-65644846-4" async></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-65644846-4');
    </script>
</head>
<body data-theme="{{ $theme }}">

    <div id="app">

        @include('includes.ie-warning')

        <section class="error">
            <div class="error__inner">
                <h1>@yield('code')</h1>
                <h2>@yield('name')</h2>
                <p>
                    @yield('message')<br>
                    If you believe this is a bug, don't hesitate to report it.
                </p>
                <p class="mb-0">
                    <a href="javascript:window.history.back()" class="btn btn-theme-dark btn--icon" title="{{ __('Go back') }}"><i class="zwicon-arrow-left"></i></a>
                    <a href="{{ route('home') }}" class="btn btn-theme-dark btn--icon" title="{{ __('Go home') }}"><i class="zwicon-home"></i></a>
                </p>
            </div>
        </section>

    </div>
</body>
</html>
