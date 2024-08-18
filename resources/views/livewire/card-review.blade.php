<div class="flex flex-col items-center mt-5">
    @if($card)
        <div class="border border-gray-300 p-5 rounded-lg w-80 text-center">
            <p class="text-lg font-bold">{{ $card->question }}</p>
            <p class="text-base text-gray-600">{{ $card->answer }}</p>

            <div class="mt-5">
                <button class="bg-green-500 text-white py-2 px-4 m-1 rounded cursor-pointer" wire:click="processReview(5)">Easy</button>
                <button class="bg-yellow-500 text-white py-2 px-4 m-1 rounded cursor-pointer" wire:click="processReview(3)">Good</button>
                <button class="bg-red-500 text-white py-2 px-4 m-1 rounded cursor-pointer" wire:click="processReview(1)">Again</button>
            </div>
        </div>
    @else
        <p class="text-lg text-gray-500">No cards to review.</p>
    @endif
</div>