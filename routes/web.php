<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\DeckController;
use App\Livewire\Search;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    return redirect()->route('decks.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('decks', [DeckController::class, 'index'])->name('decks.index');
    Route::post('decks/create', [DeckController::class, 'create'])->name('decks.create');
    Route::post('/decks/{id}/edit', [DeckController::class, 'edit'])->name('decks.edit');    
    Route::post('decks/{id}/delete', [DeckController::class, 'delete'])->name('decks.delete');

    Route::get('/decks/{id}/study', [DeckController::class, 'study'])->name('decks.study');

    Route::get('/cards/add', [CardController::class, 'add'])->name('cards.add');
    Route::post('/cards/store', [CardController::class, 'store'])->name('cards.store');
    Route::post('/cards/import', [CardController::class, 'import'])->name('cards.import');

    Route::get('/search', [CardController::class, 'search'])->name('search');

    Route::get('/sample-download', function () {
        $filePath = public_path('sample.csv');

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    })->name('sample.download');;

});




Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
