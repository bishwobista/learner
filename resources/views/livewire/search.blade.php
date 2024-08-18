
<div>
    <div class="flex items-center space-x-2">
        <input 
            type="text" 
            wire:model.lazy="searchTerm" 
            placeholder="Search questions..." 
            class="form-input w-full"
        />

        <button 
            wire:click="search" 
            class="bg-green-500 text-white px-4 py-2 rounded"
        >
            Search
        </button>

        <button 
            wire:click="clearSearch" 
            class="bg-blue-500 text-white px-4 py-2 rounded"
        >
            Clear
        </button>
    </div>

    @if ($cards)
        <ul class="mt-4">
            @forelse($cards as $card)
                <li class="p-2 border-b flex items-center justify-start">
                    <p class="pr-4">{{ $card->question }}</p>
                    <button  class="underline text-gray-800" wire:click="$dispatch('openModal', { component: 'edit-card-modal', arguments: { cardId: {{ $card->id }} }})">Edit Card</button>

                </li>
            @empty
                <li class="p-2 text-gray-500">No results found</li>
            @endforelse
        </ul>
    @endif
</div>
