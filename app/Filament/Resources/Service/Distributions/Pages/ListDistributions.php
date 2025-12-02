<?php

namespace App\Filament\Resources\Service\Distributions\Pages;

use App\Filament\Resources\Service\Distributions\DistributionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDistributions extends ListRecords
{
    protected static string $resource = DistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
