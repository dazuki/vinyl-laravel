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
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-200">
    <x-header />
    <div class="flex justify-center mx-auto w-full lg:mt-4 pb-2">
        <main class="w-full">
            {{ $slot }}
        </main>
    </div>
    <div id="copyright" class="my-2 text-xs" align="center">&copy; 2023 - 2023 bokbindaregatan.se</div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let burgerMenu = document.getElementById('burgerMenu');

            @auth
            burgerMenu.innerHTML +=
                '<li><a class=\"lg:hidden text-center block text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg font-semibold shadow-md bg-slate-100\" href=\"/create/vinyl\">Ny Vinyl</a></li>';
            burgerMenu.innerHTML +=
                '<li><a class=\"lg:hidden text-center block mt-2 text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg font-semibold shadow-md bg-slate-100\" href=\"/create/artist\">Ny Artist</a></li>';
            burgerMenu.innerHTML +=
                '<li><a class=\"lg:hidden text-center block mt-2 text-gray-900 hover:text-red-700 bg-red-100 shadow-md rounded-lg border-2 border-red-300 p-2 text-lg\" href=\"/logout\">Logga Ut</a></li>';
        @else
            burgerMenu.innerHTML +=
                '<li><a class=\"lg:hidden text-center block font-semibold text-gray-900 hover:text-green-700 rounded-lg border-2 border-slate-300 p-2 text-lg shadow-md bg-slate-100\" href=\"/login\">Logga In</a></li>'
        @endauth
        });
        (function() {
            let cpr = document.getElementById("copyright");
            cpr.innerHTML = "&copy; 2023 - " + new Date().getFullYear() +
                " <a href=\"https://bokbindaregatan.se\" class=\"underline\">bokbindaregatan.se</a> - All Rights Reserved.";
        })();
    </script>
</body>

</html>
