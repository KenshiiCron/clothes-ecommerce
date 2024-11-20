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

    {{-- CSS Imports --}}

    {{-- CSS Imports --}}

    @stack('css')
</head>

<body>

<div>
    @include('components.header')

    @yield('content')

    @include('components.footer')
</div>

{{-- Javascript Imports --}}

{{-- Javascript Imports --}}

@stack('js')
</body>
</html>
