<?php

namespace App\Filament\Resources\Bansos\Priorities\Pages;

use App\Filament\Resources\Bansos\Priorities\PriorityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePriorities extends ManageRecords
{
    protected static string $resource = PriorityResource::class;

    public function getTitle(): string
    {
        return 'Data Prioritas Bantuan Sosial';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah Prioritas'),
        ];
    }
}
