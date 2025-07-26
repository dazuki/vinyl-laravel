<div class="mx-auto mt-4 max-w-screen-xl text-left">
	@section("page-title", "Discogs ADMIN")
	<div
		class="custom-shadow border-b-4 border-l-4 border-r-4 border-t-4 border-slate-300 bg-white px-4 pt-4 max-xl:border-l-0 max-xl:border-r-0 xl:rounded-xl">

		<div class="mb-8 grid grid-cols-4">
			<div class="text-xl font-bold">Saknar ID</div>
			<div class="flex items-center justify-start font-bold">
				<span>discogs_id</span>
				<x-fas-arrow-down class="ml-2 h-6 text-red-500" />
			</div>
			<div class="font-bold">discogs_image_url</div>
			<div class="font-bold">discogs_manual_id</div>

			@foreach ($noids as $noid)
				<div><a href="/artist/{{ $noid["id"] }}" target="_BLANK">{{ $noid["name"] }}</a></div>
				<div class="flex items-center justify-start">
					@if ($noid["discogs_id"])
						<x-fas-up-right-from-square class="mr-2 h-3" />
						<a href="https://www.discogs.com/artist/{{ $noid["discogs_id"] }}" target="_BLANK">{{ $noid["discogs_id"] }}</a>
					@else
						<x-fas-xmark class="h-6 text-red-500" />
					@endif
				</div>
				<div>
					@if ($noid["discogs_image_url"])
						<x-fas-check class="h-6 text-green-500" />
					@else
						<x-fas-xmark class="h-6 text-red-500" />
					@endif
				</div>
				<div class="flex items-center justify-start">
					@if ($noid["discogs_id_manual"])
						<x-fas-up-right-from-square class="mr-2 h-3" />
						<a href="https://www.discogs.com/artist/{{ $noid["discogs_id_manual"] }}"
							target="_BLANK">{{ $noid["discogs_id_manual"] }}</a>
					@endif
				</div>
			@endforeach
		</div>

		<div class="mb-8 grid grid-cols-4">
			<div class="text-xl font-bold">Saknar Bild</div>
			<div class="font-bold">discogs_id</div>
			<div class="flex items-center justify-start font-bold">
				<span>discogs_image_url</span>
				<x-fas-arrow-down class="ml-2 h-6 text-red-500" />
			</div>
			<div class="font-bold">discogs_manual_id</div>

			@foreach ($noimages as $noimage)
				<div><a href="/artist/{{ $noimage["id"] }}" target="_BLANK">{{ $noimage["name"] }}</a></div>
				<div class="flex items-center justify-start">
					<x-fas-up-right-from-square class="mr-2 h-3" />
					@if ($noimage["discogs_id"])
						<a href="https://www.discogs.com/artist/{{ $noimage["discogs_id"] }}"
							target="_BLANK">{{ $noimage["discogs_id"] }}</a>
					@else
						<x-fas-xmark class="h-6 text-red-500" />
					@endif
				</div>
				<div>
					@if ($noimage["discogs_image_url"])
						<x-fas-check class="h-6 text-green-500" />
					@else
						<x-fas-xmark class="h-6 text-red-500" />
					@endif
				</div>
				<div class="flex items-center justify-start">
					@if ($noimage["discogs_id_manual"])
						<x-fas-up-right-from-square class="mr-2 h-3" />
						<a href="https://www.discogs.com/artist/{{ $noimage["discogs_id_manual"] }}"
							target="_BLANK">{{ $noimage["discogs_id_manual"] }}</a>
					@endif
				</div>
			@endforeach
		</div>

		<div class="mb-8 grid grid-cols-4 max-sm:text-xs">
			<div class="text-xl font-bold max-sm:text-xs">Saknar ID & BILD</div>
			<div class="flex items-center justify-start font-bold">
				<span>discogs_id</span>
				<x-fas-arrow-down class="ml-2 h-6 text-red-500" />
			</div>
			<div class="flex items-center justify-start font-bold">
				<span>discogs_image_url</span>
				<x-fas-arrow-down class="ml-2 h-6 text-red-500" />
			</div>
			<div class="font-bold">discogs_manual_id</div>

			@foreach ($hasnothing as $nothing)
				<div><a href="/artist/{{ $nothing["id"] }}" target="_BLANK">{{ $nothing["name"] }}</a></div>
				<div class="flex items-center justify-start">
					@if ($nothing["discogs_id"])
						<x-fas-up-right-from-square class="mr-2 h-3" />
						<a href="https://www.discogs.com/artist/{{ $nothing["discogs_id"] }}"
							target="_BLANK">{{ $nothing["discogs_id"] }}</a>
					@else
						<x-fas-xmark class="h-6 text-red-500" />
					@endif
				</div>
				<div>
					@if ($nothing["discogs_image_url"])
						<x-fas-check class="h-6 text-green-500" />
					@else
						<x-fas-xmark class="h-6 text-red-500" />
					@endif
				</div>
				<div class="flex items-center justify-start">
					@if ($nothing["discogs_id_manual"])
						<x-fas-up-right-from-square class="mr-2 h-3" />
						<a href="https://www.discogs.com/artist/{{ $nothing["discogs_id_manual"] }}"
							target="_BLANK">{{ $nothing["discogs_id_manual"] }}</a>
					@endif
				</div>
			@endforeach
		</div>
	</div>
</div>
