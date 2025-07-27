{{-- resources/views/livewire/discogs-manager.blade.php --}}
<div class="flex w-full flex-col items-center p-2">
	<h5>Discogs ID</h5>

	<div class="mb-2 border-b">
		<small class="text-xs">
			Auto ID: {{ $artist->discogs_id ?? "Not set" }} |
			Manual ID: {{ $artist->discogs_id_manual ?? "Not set" }} |
			Effective ID: {{ $artist->getEffectiveDiscogsId() ?? "Not set" }}
		</small>
	</div>

	<div class="grid grid-cols-3 text-center">
		<div class="col-span-3 flex flex-col">
			<span>Manual Discogs ID</span>
			<input type="number"
				wire:model="manualId"
				id="manualId"
				class="w-full border border-b-0 p-2"
				placeholder="Enter Discogs artist ID">
		</div>

		<button wire:click="updateManualId"
			wire:loading.attr="disabled"
			wire:target="updateManualId"
			class="w-full border p-1">
			<span>Update</span>
		</button>

		<button wire:click="resetManualId"
			wire:loading.attr="disabled"
			wire:target="resetManualId"
			wire:confirm="Are you sure you want to reset the manual ID?"
			class="w-full border p-1">
			<span>Reset</span>
		</button>

		<button wire:click="refreshData"
			wire:loading.attr="disabled"
			wire:target="refreshData"
			class="w-full border p-1">
			<span>Refresh</span>
		</button>
	</div>

	@if ($message)
		<div class="alert alert-{{ $messageType === "success" ? "success" : "danger" }} alert-sm">
			{{ $message }}
		</div>
	@endif
</div>
