<?php

namespace App\Filament\Resources\Service\Distributions\Tables;

use Carbon\Carbon;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class DistributionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->when(
                Auth::user()?->role === 'officer',
                fn($q) => $q->whereHas('citizen', fn($cq) => $cq->where('district_id', Auth::user()->district_id))
            ))
            ->columns([
                TextColumn::make('index')
                    ->rowIndex() // Nomor urut otomatis per halaman
                    ->label('No.')
                    ->sortable(),
                TextColumn::make('citizen.name')
                    ->label('Nama Warga')
                    ->description(fn($record) => 'NIK: ' . $record->citizen->NIK) // Menampilkan NIK di baris kedua
                    ->searchable(['name', 'NIK']) // Memungkinkan pencarian berdasarkan Nama DAN NIK
                    ->sortable(),
                TextColumn::make('citizen.district.name')
                    ->label('Kecamatan'),
                TextColumn::make('programBansos.name')
                    ->label('Program Bansos'),
                TextColumn::make('periodBansos.name')
                    ->sortable()
                    ->label('Periode'),
                ImageColumn::make('evidence')
                    ->label('Bukti')
                    ->disk('public')
                    ->imageHeight(40)
                    ->circular(),
                // ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->label('Status')
                    ->icon(fn(string $state): string => match ($state) {
                        'Selesai' => 'heroicon-m-check-circle',
                        'Proses' => 'heroicon-m-clock',
                        'Persiapan' => 'heroicon-m-document-text',
                        'Tertunda' => 'heroicon-m-pause-circle',
                        'Dibatalkan' => 'heroicon-m-x-circle',
                        default => 'heroicon-m-question-mark-circle',
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Selesai' => 'success',
                        'Proses' => 'info',
                        'Persiapan' => 'warning',
                        'Tertunda' => 'gray',
                        'Dibatalkan' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('note')
                    ->label('Catatan')
                    ->tooltip(fn($record) => $record->note) // hover = muncul full text
                    ->limit(30),
                TextColumn::make('user.name')
                    ->label('Petugas'),
                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Diubah')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('citizen.district_id')
                    ->label('Kecamatan')
                    ->placeholder('Semua Kecamatan')
                    ->relationship('citizen.district', 'name')
                    ->visible(fn() => Auth::user()?->role === 'admin'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->placeholder('Semua Status')
                    ->options([
                        'Persiapan' => 'Persiapan',
                        'Proses' => 'Proses',
                        'Tertunda' => 'Tertunda',
                        'Selesai' => 'Selesai',
                        'Dibatalkan' => 'Dibatalkan',
                    ]),
                SelectFilter::make('program_bansos_id')
                    ->label('Program Bansos')
                    ->placeholder('Semua Program Bansos')
                    ->relationship('programBansos', 'name'),
                SelectFilter::make('period_bansos_id')
                    ->label('Periode')
                    ->placeholder('Semua Periode')
                    ->relationship('periodBansos', 'name'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteBulkAction::make()->visible(fn() => Auth::user()?->role === 'admin'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->visible(fn() => Auth::user()?->role === 'admin'),
                    FilamentExportBulkAction::make('export')
                        ->disableAdditionalColumns(),
                ]),
            ])
            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->fileName('Data Penyaluran Bansos - Sosial Prioritas')
                    ->defaultFormat('xlsx')
                    ->disableAdditionalColumns(),
            ]);
    }
}
