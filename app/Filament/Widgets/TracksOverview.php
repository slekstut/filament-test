<?php

namespace App\Filament\Widgets;

use App\Models\Track;
use App\Models\Artist;
use App\Models\Album;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TracksOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Tracks', Track::count())
                ->icon('heroicon-o-musical-note')
                ->color('primary'),

            Stat::make('Active Artists', Artist::has('tracks')->count())
                ->icon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('Total Albums', Album::count())
                ->icon('heroicon-o-circle-stack')
                ->color('warning'),
        ];
    }
}
