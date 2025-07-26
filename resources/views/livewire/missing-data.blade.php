<div class="mx-auto mt-4 max-w-screen-xl text-left">
	<div
		class="custom-shadow border-b-4 border-l-4 border-r-4 border-t-4 border-slate-300 bg-white px-4 pt-4 max-xl:border-l-0 max-xl:border-r-0 xl:rounded-xl">
		<table class="w-full border">
			<tr class="border">
				<th>name</th>
				<th>discogs_id</th>
				<th>discogs_image_url</th>
				<th>discogs_manual_id</th>
			</tr>
			@foreach ($noids as $noid)
				<tr class="border">
					<td class="border">{{ $noid["name"] }}</td>
					<td class="border">{{ $noid["discogs_id"] }}</td>
					<td class="border">{{ $noid["discogs_image_url"] }}</td>
					<td class="border">{{ $noid["discogs_manual_id"] }}</td>
				</tr>
			@endforeach
		</table>
		<table class="w-full border">
			<tr class="border">
				<th>name</th>
				<th>discogs_id</th>
				<th>discogs_image_url</th>
				<th>discogs_manual_id</th>
			</tr>
			@foreach ($noimages as $noimage)
				<tr class="border">
					<td class="border">{{ $noimage["name"] }}</td>
					<td class="border">{{ $noimage["discogs_id"] }}</td>
					<td class="border">{{ $noimage["discogs_image_url"] }}</td>
					<td class="border">{{ $noimage["discogs_manual_id"] }}</td>
				</tr>
			@endforeach
		</table>
	</div>
</div>
