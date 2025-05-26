@section("page-title")
	Lägg till Artist
@endsection
<div class="max-w-screen-xl pb-2 mx-auto mt-4 text-center">
	<div
		class="px-4 pt-4 bg-white border-t-2 border-b-2 border-l-2 border-r-2 border-slate-300 max-xl:border-l-0 max-xl:border-r-0">
		<h1 class="mt-2 mb-4 text-2xl font-bold text-center text-gray-900 sm:text-3xl">
			Ny Artist
		</h1>
		<form wire:submit="save">
			<p>
				<label for="name" class="px-2">Skriv namn på Artist:</label>
			</p>
			<input wire:model="name" type="text" name="name" id="name"
				class="w-full p-2 mt-2 border-2 outline-none sm:w-2/6 border-slate-300 sm:rounded-lg"
				placeholder="Namn på artist här..." autocomplete="off">
			@error("name")
				<p class="px-2 pt-1 text-red-500">Tomt namn...</p>
			@enderror
			<p>
				<button type="submit" id="subBtn"
					class="w-full p-4 mt-2 font-semibold border-2 rounded-lg shadow-md outline-none whitespace-nowrap sm:w-2/6 border-slate-300 bg-slate-100 hover:bg-slate-300"><svg
						xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="inline-block mr-2 -mt-1 w-7 h-7 text-cyan-700">
						<path stroke-linecap="round" stroke-linejoin="round"
							d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
					</svg>Lägg till Artist
				</button>
			</p>
			<p class="mt-6 mb-6 text-center">
				<a href="/" class="px-2 py-2 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:bg-slate-300"
					wire:navigate>
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
						class="inline-block w-5 h-5 mr-1 -mt-2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
					</svg>Startsidan
				</a>
			</p>
		</form>
	</div>
</div>
