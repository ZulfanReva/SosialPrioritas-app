<?php

namespace App\Filament\Resources\SocialEconomy\Relationships\Pages;

use App\Filament\Resources\SocialEconomy\Relationships\RelationshipResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRelationships extends ManageRecords
{
    protected static string $resource = RelationshipResource::class;

    public function getTitle(): string
    {
        return 'Data Status Hubungan';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah Status Hubungan'),
        ];
    }
}
