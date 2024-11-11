<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeckResource\Pages;
use App\Filament\Resources\DeckResource\RelationManagers;
use App\Filament\Resources\DeckResource\RelationManagers\CardsRelationManager;
use App\Filament\Resources\DeckResource\Widgets\DeckCardReviewsChart;
use App\Models\Deck;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;

class DeckResource extends Resource
{
    protected static ?string $model = Deck::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->label('Created By')
                    ->options(
                        User::all()->mapWithKeys(fn($user) => [$user->id => $user->name])
                    )
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                  TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
            TextColumn::make('user_id')
                    ->label('Created By')
                    //get user name from the user id
                    ->formatStateUsing(fn( $record) => $record->user->name)
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            CardsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDecks::route('/'),
            'create' => Pages\CreateDeck::route('/create'),
            'edit' => Pages\EditDeck::route('/{record}/edit'),
        ];
    }

    // public static function getWidgets(): array
    // {
    //     return [
    //         DeckCardReviewsChart::make([
    //             'deckId' => 'active',
    //         ]),
    //     ];
    // }
}
