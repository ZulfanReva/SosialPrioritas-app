<?php

namespace App\Filament\Resources\Service\Distributions\Pages;

use App\Filament\Resources\Service\Distributions\DistributionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDistribution extends CreateRecord
{
    protected static string $resource = DistributionResource::class;

    public function getTitle(): string
    {
        return 'Tambah Data Distribusi Bantuan';
    }
}
