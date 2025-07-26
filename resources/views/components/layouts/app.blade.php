<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

<head>
	<x-seo-head />

	<link rel="apple-touch-icon"
		sizes="180x180"
		href="{{ asset("static/images/apple-touch-icon.png") }}">
	<link rel="icon"
		type="image/png"
		sizes="32x32"
		href="{{ asset("static/images/favicon-32x32.png") }}">
	<link rel="icon"
		type="image/png"
		sizes="16x16"
		href="{{ asset("static/images/favicon-16x16.png") }}">
	<link rel="manifest" href="{{ asset("static/images/site.webmanifest") }}">
	<link rel="preconnect"
		href="https://fonts.gstatic.com/"
		crossorigin>

	<title>@yield("page-title") - Vinyl Förteckning</title>
	@vite(["resources/css/app.css", "resources/js/app.js"])
</head>

<body class="bg-slate-200">
	<livewire:header />
	<div class="mx-auto flex w-full justify-center pb-2">
		<main class="w-full">
			{{ $slot }}
		</main>
	</div>
	<div id="copyright"
		class="my-2 text-xs"
		align="center">&copy; 2023-2025 Bokbindaregatan.se</div>
	@auth
		<div class="my-2" align="center"><span class="font-semibold">Admin:</span> <a href="/data">Discogs</a></div>
	@endauth
</body>

</html>
