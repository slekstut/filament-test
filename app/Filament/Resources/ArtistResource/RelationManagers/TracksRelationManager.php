<?php

namespace App\Filament\Resources\ArtistResource\RelationManagers;

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
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('album.title')->label('Album'),
                Tables\Columns\TextColumn::make('genre.name')->label('Genre'),
                Tables\Columns\TextColumn::make('duration')->label('Duration (s)'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'active' => 'success',
                        'archived' => 'danger',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('album_id')
                    ->relationship('album', 'title')
                    ->label('Filter by Album'),
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
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('album_id')
                    ->relationship('album', 'title'),
                Forms\Components\Select::make('genre_id')
                    ->relationship('genre', 'name'),
                Forms\Components\TextInput::make('duration')
                    ->numeric()
                    ->required()
                    ->suffix('seconds'),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'archived' => 'Archived',
                    ])
                    ->default('active'),
            ]);
    }
}
