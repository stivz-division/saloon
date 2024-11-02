<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'MyGrooming')</title>

    @vite(['resources/css/app.scss', 'resources/js/app.js'])

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TYX3NF6NC3"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'G-TYX3NF6NC3');
</script>
<body>
@auth
    <x-header.auth-navbar/>
@else
    <x-header.navbar/>
@endauth
<div class="container mt-3">
    {{ $slot }}
</div>

@stack('scripts')

</body>
</html>
