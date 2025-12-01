<?php

namespace App\Filament\Resources\Geography\Districts\Pages;

use App\Filament\Resources\Geography\Districts\DistrictResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageDistricts extends ManageRecords
{
    protected static string $resource = DistrictResource::class;

    public function getTitle(): string
    {
        return 'Data Kecamatan';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Kecamatan'),
        ];
    }
}
