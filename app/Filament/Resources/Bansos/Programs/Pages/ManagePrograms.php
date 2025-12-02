<?php

namespace App\Filament\Resources\Bansos\Programs\Pages;

use App\Filament\Resources\Bansos\Programs\ProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePrograms extends ManageRecords
{
    protected static string $resource = ProgramResource::class;

    public function getTitle(): string
    {
        return 'Data Program Bantuan Sosial';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
