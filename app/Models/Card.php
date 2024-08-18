<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'deck_id'];

    public function deck()
    {
        return $this->belongsTo(Deck::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
