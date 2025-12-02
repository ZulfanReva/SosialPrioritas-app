<?php

namespace App\Filament\Resources\Service\Citizens\Pages;

use App\Filament\Resources\Service\Citizens\CitizenResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCitizen extends CreateRecord
{
    protected static string $resource = CitizenResource::class;

    public function getTitle(): string
    {
        return 'Tambah Data Kependudukan';
    }
}
