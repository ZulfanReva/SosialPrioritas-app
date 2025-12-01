<?php

namespace App\Filament\Resources\Geography\SubDistricts\Pages;

use App\Filament\Resources\Geography\SubDistricts\SubDistrictResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSubDistricts extends ManageRecords
{
    protected static string $resource = SubDistrictResource::class;

    public function getTitle(): string
    {
        return 'Data Kelurahan/Desa';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
