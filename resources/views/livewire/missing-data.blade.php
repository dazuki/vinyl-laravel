<div class="mx-auto mt-4 max-w-screen-xl text-left">
	@section("page-title", "Discogs ADMIN")
	<div
		class="custom-shadow border-b-4 border-l-4 border-r-4 border-t-4 border-slate-300 bg-white px-4 pt-4 max-xl:border-l-0 max-xl:border-r-0 xl:rounded-xl">

		<div class="mb-8 grid grid-cols-4 max-sm:text-xs">
			<div class="border-b-2 text-xl font-bold max-sm:text-xs">Saknar ID</div>
			<div class="flex items-center justify-start border-b-2 font-bold">
				<x-fas-arrow-down class="mr-2 h-6 text-red-500 max-sm:h-4" />
				<span>ID</span>
			</div>
			<div class="border-b-2 font-bold">Bild</div>
			<div class="border-b-2 font-bold">mID</div>

			@foreach ($noids as $noid)
				<div class="border-b"><a href="/artist/{{ $noid["id"] }}" target="_BLANK">{{ $noid["name"] }}</a></div>
				<div class="flex items-center justify-start border-b">
					@if ($noid["discogs_id"])
						<x-fas-up-right-from-square class="mr-2 h-3" />
						<a href="https://www.discogs.com/artist/{{ $noid["discogs_id"] }}" target="_BLANK">{{ $noid["discogs_id"] }}</a>
					@else
						<x-fas-xmark class="h-6 text-red-500 max-sm:h-4" />
					@endif
				</div>
				<div class="flex items-center justify-start border-b border-b">
					@if ($noid["discogs_image_url"])
						<x-fas-check class="h-6 text-green-500 max-sm:h-4" />
					@else
						<x-fas-xmark class="h-6 text-red-500 max-sm:h-4" />
					@endif
				</div>
				<div class="flex items-center justify-start border-b">
					@if ($noid["discogs_id_manual"])
						<x-fas-up-right-from-square class="mr-2 h-3" />
						<a href="https://www.discogs.com/artist/{{ $noid["discogs_id_manual"] }}"
							target="_BLANK">{{ $noid["discogs_id_manual"] }}</a>
					@endif
				</div>
			@endforeach
		</div>

		<div class="mb-8 grid grid-cols-4 max-sm:text-xs">
			<div class="border-b-2 text-xl font-bold max-sm:text-xs">Saknar Bild</div>
			<div class="border-b-2 font-bold">ID</div>
			<div class="flex items-center justify-start border-b-2 font-bold">
				<x-fas-arrow-down class="mr-2 h-6 text-red-500 max-sm:h-4" />
				<span>Bild</span>
			</div>
			<div class="border-b-2 font-bold">mID</div>

			@foreach ($noimages as $noimage)
				<div class="border-b"><a href="/artist/{{ $noimage["id"] }}" target="_BLANK">{{ $noimage["name"] }}</a></div>
				<div class="flex items-center justify-start border-b">
					@if ($noimage["discogs_id_manual"])
						<x-fas-up-right-from-square class="mr-2 h-3 text-neutral-300" />
					@else
						<x-fas-up-right-from-square class="mr-2 h-3" />
					@endif
					@if ($noimage["discogs_id"])
						@if ($noimage["discogs_id_manual"])
							<a href="https://www.discogs.com/artist/{{ $noimage["discogs_id"] }}"
								target="_BLANK"
								class="text-neutral-300">{{ $noimage["discogs_id"] }}</a>
						@else
							<a href="https://www.discogs.com/artist/{{ $noimage["discogs_id"] }}"
								target="_BLANK">{{ $noimage["discogs_id"] }}</a>
						@endif
					@else
						<x-fas-xmark class="h-6 text-red-500 max-sm:h-4" />
					@endif
				</div>
				<div class="border-b">
					@if ($noimage["discogs_image_url"])
						<x-fas-check class="h-6 text-green-500 max-sm:h-4" />
					@else
						<x-fas-xmark class="h-6 text-red-500 max-sm:h-4" />
					@endif
				</div>
				<div class="flex items-center justify-start border-b">
					@if ($noimage["discogs_id_manual"])
						<x-fas-up-right-from-square class="mr-2 h-3" />
						<a href="https://www.discogs.com/artist/{{ $noimage["discogs_id_manual"] }}"
							target="_BLANK">{{ $noimage["discogs_id_manual"] }}</a>
					@endif
				</div>
			@endforeach
		</div>

		<div class="mb-8 grid grid-cols-4 max-sm:text-xs">
			<div class="border-b-2 text-xl font-bold max-sm:text-xs">Saknar ID & BILD</div>
			<div class="flex items-center justify-start border-b-2 font-bold">
				<x-fas-arrow-down class="mr-2 h-6 text-red-500 max-sm:h-4" />
				<span>ID</span>
			</div>
			<div class="flex items-center justify-start border-b-2 font-bold">
				<x-fas-arrow-down class="mr-2 h-6 text-red-500 max-sm:h-4" />
				<span>Bild</span>
			</div>
			<div class="border-b-2 font-bold">mID</div>

			@foreach ($hasnothing as $nothing)
				<div class="border-b"><a href="/artist/{{ $nothing["id"] }}" target="_BLANK">{{ $nothing["name"] }}</a></div>
				<div class="flex items-center justify-start border-b">
					@if ($nothing["discogs_id"])
						<x-fas-up-right-from-square class="mr-2 h-3" />
						<a href="https://www.discogs.com/artist/{{ $nothing["discogs_id"] }}"
							target="_BLANK">{{ $nothing["discogs_id"] }}</a>
					@else
						<x-fas-xmark class="h-6 text-red-500 max-sm:h-4" />
					@endif
				</div>
				<div class="border-b">
					@if ($nothing["discogs_image_url"])
						<x-fas-check class="h-6 text-green-500 max-sm:h-4" />
					@else
						<x-fas-xmark class="h-6 text-red-500 max-sm:h-4" />
					@endif
				</div>
				<div class="flex items-center justify-start border-b">
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
