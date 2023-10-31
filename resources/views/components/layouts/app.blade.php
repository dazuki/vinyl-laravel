<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Vinyler' }}</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-slate-200">
        <x-header />
        <div class="flex justify-center mx-auto w-full bg-white lg:mt-4 mb-4 lg:ml-4 lg:mr-4 lg:border-t-2 border-b-2 lg:border-r-2 lg:border-l-2 border-slate-300">
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
