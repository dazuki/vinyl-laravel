<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('static/images/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('static/images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('static/images/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('static/images/site.webmanifest') }}">

        <title>{{ $title ?? 'Vinyler' }}</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-slate-200">
        <x-header />
        <div class="flex justify-center mx-auto w-full bg-white lg:mt-4 lg:border-t-2 border-b-2 shadow-lg pb-4 border-slate-300">
            <main class="w-full">
                {{ $slot }}
            </main>
        </div>
        <div id="copyright" class="my-2 text-xs" align="center">&copy; 2023 - 2023 bokbindaregatan.se</div>
            <script>
                (function(){
	                let cpr = document.getElementById("copyright");
	                cpr.innerHTML = "&copy; 2023 - "+new Date().getFullYear()+" bokbindaregatan.se - All Rights Reserved.";
                })();
            </script>
    </body>
</html>
