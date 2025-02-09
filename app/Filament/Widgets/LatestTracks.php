<?php

namespace App\Filament\Widgets;

use App\Models\Track;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class LatestTracks extends BaseWidget
{
    protected int $recordsPerPage = 5;

    protected function getTableQuery(): Builder
    {
        return Track::query()->latest()->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')->label('Track')->sortable(),
            Tables\Columns\TextColumn::make('artist.name')->label('Artist')->sortable(),
            Tables\Columns\TextColumn::make('album.title')->label('Album')->sortable(),
            Tables\Columns\TextColumn::make('created_at')->date('Y-m-d')->label('Added On')->sortable(),
        ];
    }
}
