<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title',config('app.name'))</title>
    <meta name="description"
          content="{{config('settings.site_description')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name=“keywords”
          content="{{config('settings.seo_meta_keywords')}}">
    <meta name=“author” content="Algeorithme">
    <meta name="og:image" content="{{asset('assets/site/images/logos/logo.webp')}}">
    <meta name=“og:description”
          content="{{config('settings.site_description')}}">
    <meta name=“og:url” content="https://www.algeorithme.com">
    <meta name=“og:title” content="@yield('title',config('app.name'))">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/site/images/logos/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('assets/site/images/logos/favicon.ico')}}">

    {{-- CSS Imports --}}
    <!-- font -->
    <link rel="stylesheet" href="{{asset('assets/front/fonts/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/fonts/font-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/front/css/styles.css')}}"/>
    {{-- CSS Imports --}}

    @stack('css')
</head>

<body>

<div>
    {{-- Preloader --}}
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    {{-- Preloader --}}
    <div id="wrapper">
        @include('components.top-bar')

        @include('components.header')

        @yield('content')

        @include('components.footer')
    </div>
</div>

{{-- Javascript Imports --}}
<script type="text/javascript" src="{{asset('assets/front/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/swiper-bundle.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/lazysize.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/count-down.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/multiple-modal.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/front/js/main.js')}}"></script>
{{-- Javascript Imports --}}

@stack('js')
</body>
</html>
