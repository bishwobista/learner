<?php

namespace App\Http\Controllers;

use App\CardType;
use App\Imports\CardsImport;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Deck;
use App\Models\User;
use App\Models\Review;
use Maatwebsite\Excel\Facades\Excel;

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
            'deckId' => 'required|integer',
            'type' => 'required'
        ]);

        $deck = Deck::find($validatedData['deckId']);

        Card::create([
            'question' => $validatedData['question'],
            'answer' => $validatedData['answer'],
            'deck_id' => (int) $validatedData['deckId'],
        ]);

        return redirect()->route('decks.index')->with('success', 'Card added successfully');
    }

    public function search(){
        return view('search');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx',
            'deck_id' => 'required|integer|exists:decks,id',

        ]);

        $deckId = $request->deck_id;

        
        if ($request->hasFile('file')) {
            Excel::import(new CardsImport($deckId), $request->file('file'));
        }

        return redirect()->route('cards.add')->with('success', 'Cards imported successfully!');
    }
}
