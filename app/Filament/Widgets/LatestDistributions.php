<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Service\Citizens\CitizenResource;
use App\Filament\Resources\Service\Distributions\DistributionResource;
use App\Filament\Resources\Service\Distributions\Tables\DistributionsTable;
use App\Models\Citizen;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Distribution;
use App\Models\District;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestDistributions extends BaseWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Distribusi Terbaru';

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        // Semua role bisa melihat widget ini
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->defaultSort('created_at', 'desc')
            ->query(
                Distribution::query()
                    ->with(['citizen.district', 'programBansos'])
                    ->when(
                        Auth::user()?->role === 'officer',
                        fn($q) => $q->whereHas('citizen', fn($cq) => $cq->where('district_id', Auth::user()->district_id))
                    )
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('citizen.name')
                    ->label('Nama Warga')
                    ->description(fn($record) => 'NIK: ' . $record->citizen->NIK)
                    ->searchable(['name', 'NIK'])
                    ->sortable(),

                Tables\Columns\TextColumn::make('citizen.district.name')
                    ->label('Kecamatan'),

                Tables\Columns\TextColumn::make('programBansos.name')
                    ->label('Program Bansos'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->icon(fn(string $state): string => match ($state) {
                        'Selesai' => 'heroicon-m-check-circle',
                        'Proses' => 'heroicon-m-clock',
                        'Persiapan' => 'heroicon-m-document-text',
                        'Tertunda' => 'heroicon-m-pause-circle',
                        'Dibatalkan' => 'heroicon-m-x-circle',
                        default => 'heroicon-m-question-mark-circle',
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Proses' => 'info',
                        'Persiapan' => 'warning',
                        'Tertunda' => 'gray',
                        'Dibatalkan' => 'danger',
                        default => 'secondary',
                    }),
            ])
            ->recordActions([
                Action::make('open')
                    ->url(fn(Distribution $record): string => DistributionResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
