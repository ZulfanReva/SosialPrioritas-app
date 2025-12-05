<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $inactiveUsers = User::where('is_active', false)->count();

        return [
            Stat::make('Total Users', $totalUsers)
                ->description('Total of all users')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('Aktif Users', $activeUsers)
                ->description('Users yang dapat masuk ke sistem')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Nonaktif Users', $inactiveUsers)
                ->description('Users yang tidak dapat masuk ke sistem')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
