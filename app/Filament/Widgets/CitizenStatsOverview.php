<?php

namespace App\Filament\Widgets;

use App\Models\Citizen;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CitizenStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Count citizens by priority_bansos_id
        // 1 = Tinggi (High), 2 = Sedang (Medium), 3 = Rendah (Low)
        $highPriority = Citizen::where('priority_bansos_id', 1)->count();
        $mediumPriority = Citizen::where('priority_bansos_id', 2)->count();
        $lowPriority = Citizen::where('priority_bansos_id', 3)->count();

        return [
            Stat::make('Prioritas Tinggi', $highPriority)
                ->description('Jumlah penduduk dengan prioritas tinggi')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('danger')
                ->chart([7, 5, 10, 5, 12, 4, $highPriority]),

            Stat::make('Prioritas Sedang', $mediumPriority)
                ->description('Jumlah penduduk dengan prioritas sedang')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning')
                ->chart([3, 7, 5, 8, 6, 9, $mediumPriority]),

            Stat::make('Prioritas Rendah', $lowPriority)
                ->description('Jumlah penduduk dengan prioritas rendah')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('success')
                ->chart([10, 8, 6, 5, 4, 3, $lowPriority]),
        ];
    }
}
