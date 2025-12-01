<?php

namespace App\Filament\Resources\Geography\Regencies\Pages;

use App\Filament\Resources\Geography\Regencies\RegencyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRegencies extends ManageRecords
{
    protected static string $resource = RegencyResource::class;

    public function getTitle(): string
    {
        return 'Data Kabupaten';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Kabupaten'),
        ];
    }
}
