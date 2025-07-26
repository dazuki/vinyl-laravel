{{-- resources/views/livewire/discogs-manager.blade.php --}}
<div class="mt-4 p-2">
	<h5>Discogs ID Management</h5>

	<div class="mb-2">
		<small class="text-muted">
			Auto ID: {{ $artist->discogs_id ?? "Not set" }} |
			Manual ID: {{ $artist->discogs_id_manual ?? "Not set" }} |
			Effective ID: {{ $artist->getEffectiveDiscogsId() ?? "Not set" }}
		</small>
	</div>

	<div class="mb-2 gap-2">
		<div class="mb-2 flex flex-col">
			<span>Manual Discogs ID</span>
			<input type="number"
				wire:model="manualId"
				id="manualId"
				class="border px-2"
				placeholder="Enter Discogs artist ID">
		</div>

		<button wire:click="updateManualId"
			wire:loading.attr="disabled"
			wire:target="updateManualId"
			class="border px-2">
			<span>Update</span>
		</button>

		<button wire:click="resetManualId"
			wire:loading.attr="disabled"
			wire:target="resetManualId"
			wire:confirm="Are you sure you want to reset the manual ID?"
			class="border px-2">
			<span>Reset</span>
		</button>

		<button wire:click="refreshData"
			wire:loading.attr="disabled"
			wire:target="refreshData"
			class="border px-2">
			<span>Refresh</span>
		</button>
	</div>

	@if ($message)
		<div class="alert alert-{{ $messageType === "success" ? "success" : "danger" }} alert-sm">
			{{ $message }}
		</div>
	@endif
</div>
