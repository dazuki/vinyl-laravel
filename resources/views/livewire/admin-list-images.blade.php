<div class="rounded-t-lg bg-gray-200 shadow-inner">
	<div class="flex flex-col items-center p-4">
		<input wire:model.live.debounce.500ms="search"
			name="search"
			type="text"
			placeholder="Sök Artist..."
			class="w-full border-2 border-white p-2 text-center text-lg shadow-md"
			autocomplete="off"
			required="">
	</div>
	<div class="grid grid-cols-5 max-lg:grid-cols-4 max-md:grid-cols-3 max-sm:grid-cols-2">
		@foreach ($artists as $artist)
			<div wire:key="{{ $artist["id"] }}" class="mb-4 flex flex-col items-center">
				<a href="/artist/{{ $artist["id"] }}" target="_BLANK">
					<img src="{{ $artist["discogs_image_url"] }}"
						class="lazy-image mb-2 h-48 border-2 border-white shadow-md"
						loading="lazy" />
				</a>
				<span class="w-full text-center text-xl">{{ $artist["name"] }}</span>
			</div>
		@endforeach
	</div>
</div>

@script
	<script>
		(function() {
			function initLazyImages() {
				const images = document.querySelectorAll('img.lazy-image');

				images.forEach(img => {
					img.addEventListener('load', function() {
						this.classList.add('loaded');
					});

					// Check if already loaded (for cached images)
					if (img.complete && img.naturalHeight !== 0) {
						img.classList.add('loaded');
					}
				});
			}

			document.addEventListener('DOMContentLoaded', initLazyImages);
			document.addEventListener('livewire:navigated', initLazyImages);
			setTimeout(initLazyImages, 100);
		})();
	</script>
@endscript
