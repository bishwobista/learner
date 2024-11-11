<?php

namespace App\Filament\Resources\DeckResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

class CardsRelationManager extends RelationManager
{
    protected static string $relationship = 'cards';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('question')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('answer')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question')
            ->columns([
               TextColumn::make('question')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->width('20%'),
                TextColumn::make('answer')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->width('20%'),
                TextColumn::make('interval')
                    ->sortable()
                    ->width('10%'),
                TextColumn::make('repetitions')
                    ->sortable()
                    ->width('10%'),
                TextColumn::make('next_review_date')
                    ->searchable()
                    ->sortable()
                    ->width('20%'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
