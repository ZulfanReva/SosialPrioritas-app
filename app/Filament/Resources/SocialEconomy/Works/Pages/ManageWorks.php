<?php

namespace App\Filament\Resources\SocialEconomy\Works\Pages;

use App\Filament\Resources\SocialEconomy\Works\WorkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageWorks extends ManageRecords
{
    protected static string $resource = WorkResource::class;

    public function getTitle(): string
    {
        return 'Data Pekerjaan';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah Pekerjaan'),
        ];
    }
}
