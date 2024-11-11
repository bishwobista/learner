<?php

namespace App\Filament\Resources\DeckResource\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Widgets\Widget;
use App\Models\Deck;
use Filament\Widgets\WidgetConfiguration;
use Ramsey\Uuid\Type\Integer;

class DeckCardReviewsChart extends ChartWidget
{
    protected static ?string $heading = 'Deck Review Quality Distribution';

    public int $deckId;

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        $deck = Deck::find($this->deckId);  // Use the passed deckId to fetch the deck instance

        // Retrieve all cards in the deck and get the latest review for each card
        $latestReviews = $deck->cards()
            ->with(['reviews' => function ($query) {
                $query->latest()->take(1); // Only fetch the latest review for each card
            }])
            ->get()
            ->pluck('reviews')
            ->flatten();

        // Count reviews by quality
        $qualityCounts = [
            'Easy' => $latestReviews->where('quality', 5)->count(),
            'Good' => $latestReviews->where('quality', 3)->count(),
            'Again' => $latestReviews->where('quality', 1)->count(),
        ];

        return [
            'labels' => array_keys($qualityCounts),
            'datasets' => [
                [
                    'data' => array_values($qualityCounts),
                    'backgroundColor' => ['#4caf50', '#ffeb3b', '#f44336'], // Colors for Easy, Good, Again
                ],
            ],
        ];
    }
}
