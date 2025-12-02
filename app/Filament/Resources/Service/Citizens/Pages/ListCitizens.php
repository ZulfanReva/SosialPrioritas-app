<?php

namespace App\Filament\Resources\Service\Citizens\Pages;

use App\Filament\Resources\Service\Citizens\CitizenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCitizens extends ListRecords
{
    protected static string $resource = CitizenResource::class;

    public function getTitle(): string
    {
        return 'Data Kependudukan';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah Data Kependudukan'),
        ];
    }
}
