<div class="mx-auto mt-4 max-w-screen-xl pb-2 text-center">
	@section("page-title", "Ny Vinyl")
	<div
		class="custom-shadow border-b-4 border-l-4 border-r-4 border-t-4 border-slate-300 bg-white px-4 pt-4 max-xl:border-l-0 max-xl:border-r-0 xl:rounded-xl">
		<h1 class="mb-4 mt-2 text-center text-2xl font-bold text-gray-900 sm:text-3xl">
			Ny Vinyl
		</h1>
		<form wire:submit="save">
			<p>
				<select wire:model="artist_id"
					name="artist_id"
					id="artist_id"
					class="mb-4 mt-2 w-full border-2 border-slate-300 p-2 outline-none sm:w-2/6 sm:rounded-lg">
					<option value="0" selected> -- Välj en Artist -- </option>
					@foreach ($artists as $artist)
						<option wire:key="{{ $artist->id }}" value="{{ $artist->id }}">
							{{ $artist->name }}
						</option>
					@endforeach
				</select>
				@error("artist_id")
				<p class="px-2 pb-1 pt-1 text-red-500">Välj en Artist...</p>
			@enderror
			</p>
			<p>
				<label for="record_name" class="px-2">Skriv namn på Vinyl:</label>
			</p>
			<input wire:model="record_name"
				type="text"
				name="record_name"
				id="record_name"
				class="mt-2 w-full border-2 border-slate-300 p-2 outline-none sm:w-2/6 sm:rounded-lg"
				placeholder="Namn på vinyl här..."
				autocomplete="off">
			@error("record_name")
				<p class="px-2 pt-1 text-red-500">Tomt namn...</p>
			@enderror
			<p>
				<button type="submit"
					id="subBtn"
					class="mt-2 w-full whitespace-nowrap rounded-lg border-2 border-slate-300 bg-slate-100 p-4 font-semibold shadow-md outline-none hover:bg-slate-300 sm:w-2/6"><svg
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 24 24"
						stroke-width="1.5"
						stroke="currentColor"
						class="-mt-1 mr-2 inline-block h-7 w-7 text-green-700">
						<path stroke-linecap="round"
							stroke-linejoin="round"
							d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
					</svg>Lägg till Vinyl
				</button>
			</p>
			<x-button-group />
		</form>
	</div>
</div>
