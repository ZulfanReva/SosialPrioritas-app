<?php

namespace App\Filament\Resources\Service\Citizens\Tables;

use Carbon\Carbon;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class CitizensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex() // Nomor urut otomatis per halaman
                    ->label('No.')
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama Warga')
                    ->description(fn($record) => 'NIK: ' . $record->NIK) // Menampilkan NIK di baris kedua
                    ->searchable(['name', 'NIK']) // Memungkinkan pencarian berdasarkan Nama DAN NIK
                    ->sortable(),
                TextColumn::make('place_birth')
                    ->label('TTL')
                    // Menggunakan description untuk menambahkan Tanggal Lahir di bawah Tempat Lahir
                    ->description(fn($record) => Carbon::parse($record->date_birth)->format('d-m-Y')),
                TextColumn::make('gender')
                    ->label('Jenis Kelamin'),
                TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(20),
                TextColumn::make('province.name')
                    ->label('Provinsi')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('regency.name')
                    ->label('Kabupaten/Kota')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('district.name')
                    ->label('Kecamatan'),
                TextColumn::make('subDistrict.name')
                    ->label('Kelurahan'),
                TextColumn::make('education')
                    ->label('Pendidikan'),
                TextColumn::make('work.name')
                    ->label('Pekerjaan'),
                TextColumn::make('income.name')
                    ->label('Pendapatan'),
                TextColumn::make('relationship.name')
                    ->label('Hubungan Keluarga'),
                TextColumn::make('priorityBansos.label')
                    ->label('Prioritas Bansos')
                    ->badge() // Mengaktifkan mode badge
                    ->color(fn(string $state): string => match ($state) {
                        'Tinggi' => 'success', // Hijau
                        'Sedang' => 'info', // Biru
                        'Rendah' => 'danger',  // Merah
                        default => 'secondary', // Warna default jika label tidak terdaftar
                    })
                    ->formatStateUsing(fn($state) => strtoupper($state)),
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
                SelectFilter::make('priority_bansos_id')
                    ->label('Prioritas Bansos')
                    ->placeholder('Semua Prioritas')
                    ->options([
                        1 => 'Tinggi',
                        2 => 'Sedang',
                        3 => 'Rendah',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export'),
                ]),
            ])
            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->fileName('Data Kependudukan - Sosial Prioritas') // Default file name
                    ->defaultFormat('pdf')
                    ->disableAdditionalColumns(), // Label for file name input, // xlsx, csv or pdf
            ]);
    }
}
