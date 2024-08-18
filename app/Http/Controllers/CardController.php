<?php

namespace App\Http\Controllers;

use App\CardType;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Deck;
use App\Models\User;
use App\Models\Review;

class CardController extends Controller
{
    public function add(){
        $decks = auth()->user()->decks;

        return view('cards.add', compact('decks'));
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'question' => 'required',
            'answer' => 'required',
            'deckId' => 'required',
            'type' => 'required'
        ]);

        $deck = Deck::find($validatedData['deckId']);

        Card::create([
            'question' => $validatedData['question'],
            'answer' => $validatedData['answer'],
            'deck_id' => $validatedData['deckId'],
        ]);

        return redirect()->route('decks.index')->with('success', 'Card added successfully');
    }

    public function search(){
        return view('search');
    }
}
