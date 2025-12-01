<?php

namespace App\Filament\Resources\Geography\Provinces\Pages;

use App\Filament\Resources\Geography\Provinces\ProvinceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageProvinces extends ManageRecords
{
    protected static string $resource = ProvinceResource::class;

    public function getTitle(): string
    {
        return 'Data Provinsi';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Provinsi'),
        ];
    }
}
