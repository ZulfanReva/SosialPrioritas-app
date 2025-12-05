<?php

namespace App\Filament\Widgets;

use App\Models\Distribution;
use Filament\Widgets\ChartWidget;

class DistributionByStatusChart extends ChartWidget
{
    protected ?string $heading = 'Distribusi Berdasarkan Status';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'half';

    protected function getData(): array
    {
        // Count distributions by status
        $statuses = Distribution::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Define status labels and colors (matching CitizenPerDistrictChart colors)
        $statusConfig = [
            'Persiapan' => ['color' => 'rgb(255, 206, 86)', 'bg' => 'rgba(255, 206, 86, 0.2)'],
            'Proses' => ['color' => 'rgb(54, 162, 235)', 'bg' => 'rgba(54, 162, 235, 0.2)'],
            'Tertunda' => ['color' => 'rgb(199, 199, 199)', 'bg' => 'rgba(199, 199, 199, 0.2)'],
            'Selesai' => ['color' => 'rgb(75, 192, 192)', 'bg' => 'rgba(75, 192, 192, 0.2)'],
            'Dibatalkan' => ['color' => 'rgb(255, 99, 132)', 'bg' => 'rgba(255, 99, 132, 0.2)'],
        ];

        $labels = [];
        $data = [];
        $backgroundColors = [];
        $borderColors = [];

        foreach ($statusConfig as $status => $colors) {
            if (isset($statuses[$status]) && $statuses[$status] > 0) {
                $labels[] = $status;
                $data[] = $statuses[$status];
                $backgroundColors[] = $colors['bg'];
                $borderColors[] = $colors['color'];
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Distribusi',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}
