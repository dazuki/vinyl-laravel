<div class="mx-auto max-w-screen-xl text-left pb-2">
    <h1 class="text-2xl mb-4 mt-2 text-center font-bold text-gray-900 sm:text-3xl">
        {{ $artist->name }}      
    </h1>
    @foreach ($artist->records as $record)
        <p class="text-center font-medium">
            {{ $record->record_name }}
        </p>
    @endforeach
</div>
