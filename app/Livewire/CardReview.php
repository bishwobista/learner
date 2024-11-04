<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Review;
use App\Models\Card;

class CardReview extends Component
{
    public $deckId;
    public $card;
    public $quality;
    public $showAnswer = false;

    public function mount()
    {
        $this->loadNextCard();
    }

    public function loadNextCard()
    {
        $this->card = Card::where('deck_id', $this->deckId)
                      ->where(function($query) {
                          $query->where('next_review_date', '<=', now())
                                ->orWhereNull('next_review_date');
                      })
                      ->orderBy('next_review_date', 'asc')
                      ->first();

        // Reset answer visibility and quality
        $this->showAnswer = false;
        $this->quality = null;
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
        // Calculate new EF based on quality response
        $newEf = $card->ef + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));
        $newEf = max($newEf, 1.3); // Ensure EF doesn't drop below 1.3

        // Initialize new interval
        $newInterval = 1; // Default to 1 day if no specific quality matched

        // Determine new interval and next review date based on quality
        if ($quality == 5) {
            if ($card->repetitions == 0) {
                $newInterval = 1; // 1 day for the first review
            } elseif ($card->repetitions == 1) {
                $newInterval = 3; // 3 days for the second review
            } else {
                $newInterval = round($card->interval * $newEf * 1.5); // Increase interval more for easy
            }
            $card->next_review_date = now()->addDays($newInterval);
            $card->repetitions++;

        } elseif ($quality == 3) {
            if ($card->repetitions == 0) {
                $newInterval = 5; // 5 minutes for the first review
            } elseif ($card->repetitions == 1) {
                $newInterval = 30; // 30 minutes for the second review
            } else {
                $newInterval = round($card->interval * $newEf); // Increase interval using EF
            }
            $card->next_review_date = now()->addMinutes($newInterval);
            $card->repetitions++;

        } elseif ($quality == 1) {
            if ($card->repetitions == 0) {
                $newInterval = 10; // 10 minutes for the first review
            } else {
                $newInterval = 7; // 7 minutes for subsequent reviews
            }
            $card->next_review_date = now()->addMinutes($newInterval);
            $card->repetitions = max(1, $card->repetitions - 1); // Reduce repetitions slightly

        } else { // Forgot or no quality
            $newInterval = 1; // Reset interval to 1 day
            $card->next_review_date = now()->addDay();
            $card->repetitions = 0; // Reset repetitions
        }

        // Save updated card properties
        $card->ef = $newEf;
        $card->interval = $newInterval;
        $card->save();
    }



    public function toggleAnswer()
    {
        $this->showAnswer = !$this->showAnswer;
    }

    public function render()
    {
        return view('livewire.card-review', [
            'card' => $this->card,
        ]);
    }
}
