<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Review;
use App\Models\Card;
use App\Models\Deck;

class CardReview extends Component
{
    
    // public $deckId;
    // public $cards;
    // public $card;
    // public $currentCardIndex = 0;

    // public function mount($deckId)
    // {
    //     $this->deckId = $deckId;
    //     $this->cards = Deck::find($deckId)->cards;

    //     if ($this->cards->isNotEmpty()) {
    //         $this->card = $this->cards->first();
    //     } else {
    //         $this->card = null; // Handle case where no cards are available
    //     }
    // }

    // public function processReview($cardId, $reviewType)
    // {
    //     //send card with the closest next review date.
    
    //     $this->currentCardIndex++;
    

    //     if ($this->currentCardIndex < $this->cards->count()) {
    //         $this->card = $this->cards[$this->currentCardIndex];
    //     } else {
            
    //         $this->card = null;
    //     }
    // }
    // public function render()
    // {
    //     return view('livewire.card-review');
    // }

    public $deckId;
    public $card;
    public $quality;

    public function mount()
    {
        // Load the first card for review when the component mounts
        $this->loadNextCard();
    }

    public function loadNextCard()
    {
        // Get the next card due for review
        $this->card = Card::where('deck_id', $this->deckId)
                      ->where(function($query) {
                          $query->where('next_review_date', '<=', now())
                                ->orWhereNull('next_review_date');
                      })
                      ->orderBy('next_review_date', 'asc')
                      ->first();
    }

    public function processReview($quality)
    {
        $this->quality = $quality;

        // Update EF and interval based on the review quality
        $this->updateCardEfInterval($this->card, $quality);

        // Record the review
        Review::create([
            'card_id' => $this->card->id,
            'quality' => $quality,
        ]);

        // Load the next card for review
        $this->loadNextCard();
    }

    protected function updateCardEfInterval($card, $quality)
    {
        //easy = 5, good = 3, again = 1
        // Calculate the new EF
        $newEf = $card->ef + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));
        $newEf = max($newEf, 1.3); // EF should not be less than 1.3

        // Calculate the new interval
        if ($quality >= 3) { // If the review is good enough (quality 3 or higher)
            if ($card->repetitions == 0) {
                $newInterval = 1; // First review after learning
            } elseif ($card->repetitions == 1) {
                $newInterval = 6; // Second review
            } else {
                $newInterval = round($card->interval * $newEf); // Subsequent reviews
            }
            $card->repetitions++;
        } else {
            $newInterval = 1; // Reset interval if the quality is less than 3
            $card->repetitions = 0; // Reset repetitions
        }

        // If this is the card's first review, set the next_review_date
        if (is_null($card->next_review_date)) {
            $card->next_review_date = now()->addDays($newInterval);
        } else {
            $card->next_review_date = now()->addDays($newInterval);
        }

        // Update the card's EF, interval, and next review date
        $card->ef = $newEf;
        $card->interval = $newInterval;
        $card->save();
    }


    public function render()
    {
        return view('livewire.card-review', [
            'card' => $this->card,
        ]);
    }
}
