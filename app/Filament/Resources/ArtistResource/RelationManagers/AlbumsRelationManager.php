<?php

namespace App\Filament\Resources\ArtistResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;

class AlbumsRelationManager extends RelationManager
{
    protected static string $relationship = 'albums';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('release_date')->date('Y-m-d'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'released' => 'success',
                        'upcoming' => 'warning',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'released' => 'Released',
                        'upcoming' => 'Upcoming',
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
                Forms\Components\TextInput::make('title')->required()->maxLength(255),
                Forms\Components\DatePicker::make('release_date'),
                Forms\Components\Select::make('status')
                    ->options([
                        'released' => 'Released',
                        'upcoming' => 'Upcoming',
                    ])
                    ->default('upcoming'),
            ]);
    }
}
