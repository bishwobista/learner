<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    // protected $fillable = ['card_id', 'user_id', 'grade', 'reviewed_at'];

        protected $fillable = ['card_id', 'quality'];


    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function updateReview($difficulty)
    {
        // Calculate the next interval based on user input (difficulty)
        if ($difficulty == 'again') {
            $this->interval = 1;
            $this->ease_factor = max(1.3, $this->ease_factor - 0.2);
        } elseif ($difficulty == 'easy') {
            $this->interval *= $this->ease_factor;
            $this->ease_factor += 0.1;
        }
        $this->repetitions += 1;
        $this->next_review_at = now()->addDays($this->interval);
        $this->save();
    }
}
