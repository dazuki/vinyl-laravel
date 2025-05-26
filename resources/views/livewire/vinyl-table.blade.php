<div wire:init="init" class="max-w-screen-xl mx-auto text-left">
	@section("page-title")
		Samling
	@endsection
	@php
		$char = "";
	@endphp
	<div class="relative pt-4">
		<svg class="absolute w-8 svg-icon search-icon bottom-2 left-4 max-sm:left-4 max-sm:w-6" aria-labelledby="title desc"
			role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.9 19.7">
			<g class="search-path" fill="none" stroke="#959595">
				<path stroke-linecap="square" d="M18.5 18.3l-5.4-5.4" />
				<circle cx="8" cy="8" r="7" />
			</g>
		</svg>
		<input wire:model.live.debounce.500ms="search" name="search" type="text"
			class="w-full p-2 text-2xl bg-white border-t-2 border-b-2 border-l-2 border-r-2 outline-none z-1 border-slate-300 pl-14 max-sm:pl-12 max-sm:text-base max-xl:border-l-0"
			placeholder="Sök Artister/Vinyler..." autocomplete="off" required="">
	</div>
	@if ($loadData == true)
		<div class="relative z-10">
			<table
				class="w-full text-sm text-left text-gray-500 border-t-0 border-b-2 border-l-2 border-r-2 border-slate-300 max-xl:border-l-0 max-xl:border-r-0">
				<thead class="text-xs bg-white border-t-0 border-b-0 border-l-0 border-r-0 border-slate-300 text-slate-900">
					<tr>
						<th scope="col" class="w-1/2 px-2 py-2 text-base antialiased whitespace-nowrap sm:px-6 sm:text-xl">
							@if ($loadData == true)
								Artister: <span class="text-base font-semibold text-green-800 sm:text-xl">{{ $art_count }}</span>
							@endif
						</th>
						<th scope="col" class="w-1/2 px-2 py-2 pl-0 text-base antialiased whitespace-nowrap sm:px-6 sm:text-xl">
							@if ($loadData == true)
								Vinyler: <span class="text-base font-semibold text-green-800 sm:text-xl">{{ $records }}</span>
							@endif
						</th>
					</tr>
				</thead>
				<tbody>
					<tr class="bg-white border-slate-300 hover:bg-slate-50">
						<td colspan="2" class="text-center bg-white">
							<div wire:loading class="inline-block px-2 py-4 text-base text-gray-900 align-top sm:px-6 sm:text-lg">
								<svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" opacity=".25" />
									<path
										d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z">
										<animateTransform attributeName="transform" type="rotate" dur="0.75s" values="0 12 12;360 12 12"
											repeatCount="indefinite" />
									</path>
								</svg>
								<span class="sr-only">Laddar...</span>
							</div>
						</td>
					</tr>
					@if ($loadData == true)
						@if (!empty($search) && $artists->count() >= 1)
							<tr class="border-b-2 border-dashed border-slate-300 bg-sky-50">
								<td colspan="2"
									class="px-2 py-2 text-sm text-left text-gray-900 border-t-2 border-slate-300 sm:px-6 sm:text-base">
									<p>
										Sökord -> "<span class="font-semibold text-red-600">{{ mb_strtoupper($search) }}</span>"
									</p>
									<p><span
											class="{{ $searchCountArtist > 0 ? "font-semibold text-gray-900 underline " : "" }}underline-offset-2">{{ $searchCountArtist }}</span>
										Artist{{ $searchCountArtist == 1 ? "" : "er" }} och <span
											class="{{ $searchCountRecord > 0 ? "font-semibold text-gray-900 underline " : "" }}underline-offset-2">{{ $searchCountRecord }}</span>
										Vinyl{{ $searchCountRecord == 1 ? "" : "er" }}
										({{ $searchCountArtist + $searchCountRecord }} totalt)</p>
								</td>
							</tr>
						@endif
						@if ($artists->count() >= 1)
							@foreach ($artists as $artist)
								@if (empty($char) || $char != mb_substr($artist->name, 0, 1))
									<tr wire:key="char-{{ $char }}" class="border-t-2 border-b-2 border-slate-300 bg-sky-50">
										<td colspan="2"
											class="p-2 px-6 text-lg font-bold text-center rock-font text-slate-400 sm:text-xl lg:text-left lg:text-3xl">
											{{ mb_substr($artist->name, 0, 1) }}</td>
									</tr>
								@endif
								@php
									$char = mb_substr($artist->name, 0, 1);
								@endphp
								<tr wire:key="artist-{{ $artist->id }}" class="bg-white border-b border-slate-300">
									<td class="px-2 py-2 pb-0 text-lg font-bold text-gray-700 align-top rock-font sm:px-6 sm:text-xl lg:text-3xl">
										<a href="/artist/{{ $artist->id }}" class="antialiased hover:text-blue-800" wire:navigate>
											@if (!empty($search))
												@php
													$highlightArtist = explode(" ", mb_strtoupper($search));
													$replaceArtist = [];
													foreach ($highlightArtist as $wordsArtist) {
													    $replaceArtist[] =
													        '<span class="text-red-600 underline underline-offset-4">' . $wordsArtist . "</span>";
													}

													echo str_replace($highlightArtist, $replaceArtist, $artist->name, $count);
												@endphp
											@else
												{{ $artist->name }}
											@endif
										</a>
										@php
											$vinyler = $artist->records->count();
										@endphp
										@if ($vinyler == 0)
											<p class="py-2 text-sm text-red-400 lg:text-lg">
												{{ $vinyler }}
												Vinyl{{ $vinyler == 1 ? "" : "er" }}
											</p>
										@else
											<p class="py-2 text-sm text-gray-400 lg:text-lg">
												{{ $vinyler }}
												Vinyl{{ $vinyler == 1 ? "" : "er" }}
											</p>
										@endif
									</td>
									<td class="py-2 text-xs align-top sm:px-6">
										@if ($vinyler >= 1)
											@foreach ($artist->records as $record)
												<p class="pb-1 antialiased text-gray-700 uppercase inter-font sm:text-sm">
													@if (!empty($search))
														@php
															$highlightVinyl = explode(" ", mb_strtoupper($search));
															$replaceVinyl = [];
															foreach ($highlightVinyl as $wordsVinyl) {
															    $replaceVinyl[] =
															        '<span class="font-semibold text-red-600 underline underline-offset-4">' .
															        $wordsVinyl .
															        "</span>";
															}

															echo "<a href='https://www.discogs.com/search/?q=" .
															    urlencode($artist->name . " " . $record->record_name) .
															    "&type=release&format_exact=Vinyl' class='underline-offset-4 hover:text-blue-800 hover:underline' target='_BLANK'>" .
															    str_replace($highlightVinyl, $replaceVinyl, mb_strtoupper($record->record_name), $count) .
															    "</a>";
														@endphp
													@else
														@php
															echo "<a href='https://www.discogs.com/search/?q=" .
															    urlencode($artist->name . " " . $record->record_name) .
															    "&type=release&format_exact=Vinyl' class='underline-offset-4 hover:text-blue-800 hover:underline' target='_BLANK'>" .
															    $record->record_name .
															    "</a>";
														@endphp
													@endif
												</p>
											@endforeach
										@else
											<p class="italic text-gray-600 uppercase">...</p>
										@endif
									</td>
								</tr>
							@endforeach
						@else
							@if ($artists->count() <= 0)
								<tr class="bg-white border-b-2 border-slate-300 lg:border-l-2 lg:border-r-2">
									<td colspan="2" class="px-2 py-4 text-base text-center text-gray-900 align-top sm:px-6 sm:text-lg">
										<p>Sökord gav inga träffar...</p>
										@auth
											<div class="flex items-center justify-center mt-4">
												<a
													class="p-2 font-semibold text-center text-gray-900 border-2 rounded-lg shadow-md border-slate-300 bg-slate-100 hover:text-green-700 max-sm:w-full"
													href="/create/artist?name={{ mb_strtoupper($search) }}">
													<p>
														<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
															stroke="currentColor" class="inline-block pr-1 -mt-1 h-7 w-7 text-cyan-700">
															<path stroke-linecap="round" stroke-linejoin="round"
																d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
														</svg>
														<span class="font-semibild">Ny Artist?
														</span><span class="font-normal text-green-700">{{ mb_strtoupper($search) }}</span>
													</p>
												</a>
											</div>
										@endauth
									</td>
								</tr>
							@endif
						@endif
					@endif
				</tbody>
			</table>
			@if ($loadData == true)
				<div class="py-2 sm:py-0">
					{{ $artists->onEachSide(2)->links() }}</td>
				</div>
			@endif
		</div>
	@else
		<div
			class="flex justify-center w-full min-h-screen px-2 py-4 text-base text-gray-900 align-top bg-white border-b-2 border-l-2 border-r-2 items-top border-slate-300 max-xl:border-l-0 max-xl:border-r-0">
			<svg width="36" height="36" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
				<path d="M12,1A11,11,0,1,0,23,12,11,11,0,0,0,12,1Zm0,19a8,8,0,1,1,8-8A8,8,0,0,1,12,20Z" opacity=".25" />
				<path
					d="M10.14,1.16a11,11,0,0,0-9,8.92A1.59,1.59,0,0,0,2.46,12,1.52,1.52,0,0,0,4.11,10.7a8,8,0,0,1,6.66-6.61A1.42,1.42,0,0,0,12,2.69h0A1.57,1.57,0,0,0,10.14,1.16Z">
					<animateTransform attributeName="transform" type="rotate" dur="0.75s" values="0 12 12;360 12 12"
						repeatCount="indefinite" />
				</path>
			</svg>
			<span class="sr-only">Laddar...</span>
		</div>
	@endif
</div>
