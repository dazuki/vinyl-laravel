<div>
	<div class="flex flex-col items-center p-4">
		<input wire:model.live.debounce.500ms="search"
			name="search"
			type="text"
			placeholder="Sök Artist..."
			class="w-full border-2 p-2 text-lg"
			autocomplete="off"
			required="">
	</div>
	<div class="grid grid-cols-5 max-lg:grid-cols-4 max-md:grid-cols-3 max-sm:grid-cols-2">
		@foreach ($artists as $artist)
			<div class="mb-4 flex flex-col items-center">
				<a href="/artist/{{ $artist["id"] }}" target="_BLANK">
					<img src="{{ $artist["discogs_image_url"] }}"
						class="h-48"
						loading="lazy" />
				</a>
				<span class="text-xl">{{ $artist["name"] }}</span>
			</div>
		@endforeach
	</div>
</div>
