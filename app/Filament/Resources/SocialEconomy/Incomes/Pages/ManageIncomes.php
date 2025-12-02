<?php

namespace App\Filament\Resources\SocialEconomy\Incomes\Pages;

use App\Filament\Resources\SocialEconomy\Incomes\IncomeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageIncomes extends ManageRecords
{
    protected static string $resource = IncomeResource::class;

    public function getTitle(): string
    {
        return 'Data Pendapatan';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah Pendapatan'),
        ];
    }
}
