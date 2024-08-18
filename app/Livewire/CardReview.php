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
        $newEf = $card->ef + (0.1 - (5 - $quality) * (0.08 + (5 - $quality) * 0.02));
        $newEf = max($newEf, 1.3);

        if ($quality >= 3) {
            if ($card->repetitions == 0) {
                $newInterval = 1;
            } elseif ($card->repetitions == 1) {
                $newInterval = 6;
            } else {
                $newInterval = round($card->interval * $newEf);
            }
            $card->repetitions++;
        } else {
            $newInterval = 1;
            $card->repetitions = 0;
        }

        if (is_null($card->next_review_date)) {
            $card->next_review_date = now()->addDays($newInterval);
        } else {
            $card->next_review_date = now()->addDays($newInterval);
        }

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
