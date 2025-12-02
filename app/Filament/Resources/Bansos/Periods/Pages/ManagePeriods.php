<?php

namespace App\Filament\Resources\Bansos\Periods\Pages;

use App\Filament\Resources\Bansos\Periods\PeriodResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use PhpParser\Node\Stmt\Label;

class ManagePeriods extends ManageRecords
{
    protected static string $resource = PeriodResource::class;

    public function getTitle(): string
    {
        return 'Data Periode Bantuan Sosial';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah Periode'),
        ];
    }
}
