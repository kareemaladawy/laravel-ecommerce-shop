<!doctype html>
<html lang="{{ app()->getLocale() ?? 'en' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">
    <meta title="{{ config('settings.seo_meta_title.value') }}" content="{{ config('settings.seo_meta_content.value') }}">
    <title>{{ config('settings.site_title.value') ?? 'No title set' }} - @yield('title')</title>

    @livewireStyles()
    @yield('styles')
    @include('site.partials.styles')
</head>

<body>
    @include('site.partials.header')
    @yield('content')
    @include('site.partials.subscribe')
    @include('site.partials.footer')

    @livewireScripts()
    @stack('scripts')
</body>

</html>
