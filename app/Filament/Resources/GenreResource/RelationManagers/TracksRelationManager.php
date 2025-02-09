<?php

namespace App\Filament\Resources\GenreResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class TracksRelationManager extends RelationManager
{
    protected static string $relationship = 'tracks';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('artist.name')->label('Artist'),
                Tables\Columns\TextColumn::make('album.title')->label('Album'),
                Tables\Columns\TextColumn::make('release_date')->date('Y-m-d'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'archived' => 'Archived',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Select::make('artist_id')->relationship('artist', 'name'),
                Forms\Components\Select::make('album_id')->relationship('album', 'title'),
                Forms\Components\DatePicker::make('release_date'),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'archived' => 'Archived',
                    ])
                    ->default('active'),
            ]);
    }
}
