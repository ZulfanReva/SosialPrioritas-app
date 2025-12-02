<?php

namespace App\Filament\Resources\Service\Distributions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class DistributionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('users_id')
                    ->label('Petugas')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('citizen_id')
                    ->label('Warga')
                    ->relationship('citizen', 'name', modifyQueryUsing: fn ($query) => $query->when(
                        Auth::user()?->role === 'officer',
                        fn ($q) => $q->where('district_id', Auth::user()->district_id)
                    ))
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('program_bansos_id')
                    ->label('Program Bansos')
                    ->relationship('programBansos', 'name')
                    ->required(),
                Select::make('period_bansos_id')
                    ->label('Periode')
                    ->relationship('periodBansos', 'name')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Persiapan' => 'Persiapan',
                        'Proses' => 'Proses',
                        'Tertunda' => 'Tertunda',
                        'Selesai' => 'Selesai',
                        'Dibatalkan' => 'Dibatalkan',
                    ])
                    ->required(),
                FileUpload::make('evidence')
                    ->label('Bukti')
                    ->disk('public')
                    ->image()
                    ->nullable(),
                Textarea::make('note')
                    ->label('Catatan')
                    ->nullable(),
            ]);
    }
}
