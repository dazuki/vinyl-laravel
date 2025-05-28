@section("page-title")
	{{ $artist["name"] }}
@endsection
<div class="max-w-screen-xl pb-2 mx-auto mt-4 text-left">
	<div
		class="rounded-xl custom-shadow px-4 pt-4 bg-white border-t-4 border-b-4 border-l-4 border-r-4 border-slate-300 max-xl:border-l-0 max-xl:border-r-0">
		<div x-data="{ show: false }">
			<h1 class="text-2xl font-bold text-center text-gray-700 sm:text-4xl rock-font">
				{{ $artist["name"] }}
				@auth
					<p>
						<button x-on:click="show = ! show" id="btnEdit"
							class="px-2 py-1 border-2 rounded-lg border-slate-300 bg-slate-100 hover:bg-slate-300">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
								<path
									d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
							</svg>
						</button>
						<button id="btnDel"
							onclick="confirm('Vill du ta bort artist {{ $artist["name"] }} och ALLA Vinyler till denna artist? (ALLA Vinyler kommer också försvinna från databasen)') || event.stopImmediatePropagation()"
							wire:click="delete({{ $artist["id"] }})"
							class="px-2 py-1 bg-red-100 border-2 border-red-300 rounded-lg hover:bg-red-300">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
								<path fill-rule="evenodd"
									d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
									clip-rule="evenodd" />
							</svg>
						</button>
					</p>
				@endauth
			</h1>
			{{-- <h2 class="text-lg font-semibold text-center">{{ $artist["records"]->count() }}
                Vinyl{{ $artist["records"]->count() == 1 ? '' : 'er' }}</h2> --}}
			@auth
				<p class="w-full mx-auto mt-4 mb-2 text-center">
					<a class="w-full p-2 text-gray-900 border-2 border-green-600 rounded-lg shadow-md bg-slate-100 hover:bg-green-100"
						href="/create/vinyl?artist_id={{ $artist["id"] }}" wire:navigate><svg xmlns="http://www.w3.org/2000/svg"
							fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
							class="inline-block w-6 h-6 mr-1 -mt-1 text-green-700">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
						</svg>Ny Vinyl</a>
				</p>
			@endauth
			<p class="flex items-center justify-center">
				<a href="https://www.discogs.com/search/?q={{ urlencode($artist["name"]) }}&type=artist"
					class="mr-4 opacity-70 hover:opacity-100" target="_BLANK">
					<img src="{{ asset("static/images/Discogs-01.svg") }}" class="h-16 sm:h-20" alt="DG">
				</a>
				<a href="spotify:search:{{ urlencode($artist["name"]) }}" class="opacity-70 hover:opacity-100" target="_BLANK">
					<img src="{{ asset("static/images/spotify_logo.svg") }}" class="h-8 sm:h-10" alt="SF">
				</a>
			</p>
			@if (session("status"))
				<p class="px-2 pt-1 mb-4 text-lg font-semibold text-center">{{ session("status") }}</p>
			@endif
			@error("name")
				<p class="px-2 pt-1 mb-4 text-lg font-semibold text-center text-red-500">Namn kan inte vara tomt...</p>
			@enderror
			@auth
				<div x-cloak x-show="show" x-transition>
					<form wire:submit="save" id="edit_form">
						<p class="text-center">
							<input wire:model="name" type="text" id="artist_edit"
								class="w-full p-2 mt-2 border-2 outline-none sm:w-2/6 border-slate-300" placeholder="Skriv nytt namn här..."
								autocomplete="off" wire:dirty.class="border-orange-300">
						</p>
						<p class="text-center">
							<button type="submit" id="subBtn"
								class="w-full p-4 mt-2 mb-2 font-semibold border-2 rounded-lg shadow-md outline-none bg-slate-100 sm:w-2/6 border-slate-300 hover:bg-slate-300">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="inline-block w-6 h-6 mr-2">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
								</svg>Uppdatera Namn
							</button>
						</p>
					</form>
				</div>
			@endauth
		</div>
		@php
			$count = 1;
		@endphp
		@foreach ($artist["records"] as $record)
			<p wire:key="{{ $record["id"] }}"
				class="flex items-center px-2 py-2 text-left font-medium uppercase {{ $loop->last ? "" : "border-b " }}hover:bg-slate-50">
				<span class="w-6 mr-2 font-bold text-slate-500 lg:text-2xl sm:w-8">{{ $count }}.</span>
				@auth
					<button
						onclick="confirm('Vill du ta bort vinylen {{ $record["record_name"] }}?') || event.stopImmediatePropagation()"
						wire:click="recordDelete({{ $record["id"] }})"
						class="inline-block px-2 mr-2 text-xl text-red-500 lg:text-2xl hover:bg-red-300">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
							class="w-8 h-8">
							<path stroke-linecap="round" stroke-linejoin="round"
								d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
						</svg>
					</button>
				@endauth
				<span class="text-gray-700 lg:text-2xl rock-font">
					<a
						href="https://www.discogs.com/search/?q={{ urlencode($artist["name"] . " " . $record["record_name"]) }}&type=release&format_exact=Vinyl"
						target="_BLANK" class="hover:text-green-700">{{ $record["record_name"] }}</a>
				</span>
			</p>
			@php
				$count++;
			@endphp
		@endforeach
		<p class="mt-6 mb-6 text-center">
			<a href="/" class="px-2 py-2 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:bg-slate-300"
				wire:navigate>
				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
					class="inline-block w-5 h-5 mr-1 -mt-2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
				</svg>Startsidan
			</a>
		</p>
	</div>
	@livewireScripts
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<x-livewire-alert::scripts />
</div>
