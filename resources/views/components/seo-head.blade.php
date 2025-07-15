<meta name="description"
	content="{{ $description }}">
<meta name="viewport"
	content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">

<meta property="og:title"
	content="@yield("page-title") - Vinyl Förteckning">
<meta property="og:description"
	content="{{ $description }}">
<meta property="og:type"
	content="website">
<meta property="og:url"
	content="{{ request()->url() }}">

<meta property="og:image"
	content="{{ asset("static/images/android-chrome-512x512.png") }}">
<meta property="og:image:type"
	content="image/png">
<meta property="og:image:width"
	content="512">
<meta property="og:image:height"
	content="512">
<meta name="csrf-token"
	content="{{ csrf_token() }}">
