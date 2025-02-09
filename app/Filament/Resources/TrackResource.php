<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrackResource\Pages;
use App\Filament\Resources\TrackResource\RelationManagers;
use App\Models\Track;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;

class TrackResource extends Resource
{
    protected static ?string $model = Track::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('artist_id')
                    ->relationship('artist', 'name')
                    ->required(),
                Forms\Components\Select::make('album_id')
                    ->relationship('album', 'title'),
                Forms\Components\Select::make('genre_id')
                    ->relationship('genre', 'name'),
                Forms\Components\TextInput::make('duration')
                    ->numeric()
                    ->required()
                    ->suffix('seconds'),
                Forms\Components\DatePicker::make('release_date'),
                Forms\Components\TextInput::make('url')
                    ->url(),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'archived' => 'Archived',
                    ])
                    ->default('active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('artist.name'),
                Tables\Columns\TextColumn::make('album.title'),
                Tables\Columns\TextColumn::make('genre.name'),
                Tables\Columns\TextColumn::make('duration')
                    ->suffix(' sec'),
                Tables\Columns\TextColumn::make('release_date')
                    ->date('Y-m-d'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'active' => 'success',
                        'archived' => 'danger',
                    ]),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTracks::route('/'),
            'create' => Pages\CreateTrack::route('/create'),
            'edit' => Pages\EditTrack::route('/{record}/edit'),
        ];
    }
}
