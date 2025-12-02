<?php

namespace App\Filament\Resources\Service\Citizens\Pages;

use App\Filament\Resources\Service\Citizens\CitizenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCitizen extends EditRecord
{
    protected static string $resource = CitizenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
