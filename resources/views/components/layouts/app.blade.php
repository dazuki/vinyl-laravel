<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('static/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('static/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('static/images/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('static/images/site.webmanifest') }}">

    <title>@yield('page-title') - Vinylskivor Förteckning</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-200">
    <x-header />
    <div class="flex justify-center mx-auto w-full lg:mt-4 pb-2">
        <main class="w-full">
            {{ $slot }}
        </main>
    </div>
    <div id="copyright" class="my-2 text-xs" align="center">&copy; 2023 - 2023 bokbindaregatan.se</div>
</body>

</html>
