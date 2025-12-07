<?php

namespace App\Filament\Widgets;

use App\Models\Citizen;
use App\Models\District;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\ChartWidget;

class CitizenPerDistrictChart extends ChartWidget
{
    protected ?string $heading = 'Jumlah Penduduk Per Kecamatan';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'half';

    public static function canView(): bool
    {
        // Hanya admin yang bisa melihat widget ini
        return Auth::user()?->role === 'admin';
    }

    protected function getData(): array
    {
        // Get all districts with their citizen counts
        $districts = District::withCount('citizens')
            ->orderBy('citizens_count', 'desc')
            // ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penduduk',
                    'data' => $districts->pluck('citizens_count')->toArray(),
                    'backgroundColor' => [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(199, 199, 199, 0.2)',
                        'rgba(83, 102, 255, 0.2)',
                        'rgba(255, 99, 255, 0.2)',
                        'rgba(99, 255, 132, 0.2)',
                    ],
                    'borderColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)',
                        'rgb(199, 199, 199)',
                        'rgb(83, 102, 255)',
                        'rgb(255, 99, 255)',
                        'rgb(99, 255, 132)',
                    ],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => $districts->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
