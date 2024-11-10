<?php

namespace App\Http\Controllers;
use App\Models\Deck;
use Illuminate\Http\Request;

class DeckController extends Controller
{
    public function index(){
        $decks = auth()->user()->decks;
        return view('decks.index', compact('decks'));
    }

    public function create(Request $request){
        $deckName = $request->input('deck_name');
        $userId = auth()->user()->id;

        Deck::updateOrCreate(
            ['name' => $deckName, 'user_id' => $userId],
            ['name' => $deckName, 'user_id' => $userId]
        );

        return redirect()->route('decks.index')->with('success', 'Deck created successfully!');
    }

    public function edit(Request $request, $id){
        
        $deckName = $request->input('deck_name');

        Deck::where('id', $id)->update(['name' => $deckName]);

        return redirect()->route('decks.index')->with('success', 'Deck renamed successfully!');
    }

    public function delete(Request $request, $id){

        Deck::where('id', $id)->delete();

        return redirect()->route('decks.index')->with('success', 'Deck deleted successfully!');
    }

    public function study($deckId)
    {
        return view('decks.study', ['deckId' => $deckId]);
    }
    
    public function report(Request $request)
    {
        $deck = Deck::find($request->deck_id);
        $reviews = $deck->reviews;

        $qualityCounts = $reviews->groupBy('quality')->map->count();

        $qualityDescriptions = [
            1 => 'Hard',
            3 => 'Good',
            5 => 'Easy'
        ];

        $labels = $qualityCounts->keys()->map(function ($quality) use ($qualityDescriptions) {
            return $qualityDescriptions[$quality] ?? $quality;
        });
        $data = $qualityCounts->values();
        $deckName = $deck->name;

        return view('report', compact('labels', 'data', 'deckName'));
    }
}