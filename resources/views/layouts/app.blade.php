<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="referrer" content="no-referrer">
    <meta name="msapplication-TileColor" content="#2b5797">
    <meta name="theme-color" content="#ffffff">
    @if ($__env->yieldContent('description'))<meta name="description" content="@yield('description')">@endif
    @if ($__env->yieldContent('robots'))<meta name="robots" content="@yield('robots')">@endif

    @if ($__env->yieldContent('title'))
        <title>@yield('title') – {{ config('app.name', 'ElDewrito Services') }}</title>
    @else
        <title>{{ config('app.name', 'ElDewrito Services') }}</title>
    @endif

    <link rel="stylesheet" href="{{ asset('vendors/zwicon/zwicon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/animate.css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/overlay-scrollbars/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-65644846-4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-65644846-4');
    </script>
</head>

<body data-theme="1">

    @include('includes.ie-warning')

    <main class="main">
        @include('includes.page-loader')

        @include('includes.header')

        @include('includes.sidebar')
        @include('includes.theme-switch')

        <section class="content">

            @yield('content')

        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <script src="{{ asset('vendors/overlay-scrollbars/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    @yield('scripts')
</body>
</html>
