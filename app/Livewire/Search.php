<?php

namespace App\Livewire;

use App\Models\Card;
use Livewire\Component;

class Search extends Component
{
    public $searchTerm = '';
    public $cards = [];

    public function render()
    {
        return view('livewire.search', [
            'cards' => $this->cards,
        ]);
    }

    public function search()
    {
        // Fetch cards based on the search term
        $this->cards = Card::where('question', 'like', '%' . $this->searchTerm . '%')
                           ->get();
    }

    public function clearSearch()
    {
        // Clear the search term and reset the cards
        $this->searchTerm = '';
        $this->cards = [];
    }
}
