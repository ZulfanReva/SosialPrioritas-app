<?php

namespace App\Filament\Resources\Geography\SubDistricts;

use UnitEnum;
use BackedEnum;
use App\Models\District;
use Filament\Tables\Table;
use App\Models\SubDistrict;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\Geography\SubDistricts\Pages\ManageSubDistricts;

class SubDistrictResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = SubDistrict::class;

    protected static string|UnitEnum|null $navigationGroup = 'Geography';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    public static ?int $navigationSort = 5;
    protected static ?string $slug = 'sub-districts';
    protected static ?string $navigationLabel = 'Kelurahan/Desa';

    protected static ?string $recordTitleAttribute = 'SubDistrict';
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Kelurahan/Desa')
                    ->required()
                    ->maxLength(255),
                Select::make('district_id')
                    ->relationship('district', 'name')
                    ->label('Kecamatan')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('SubDistrict')
            ->columns([
                TextColumn::make('index')
                    ->rowIndex() // Nomor urut otomatis per halaman
                    ->label('No.'),
                TextColumn::make('name')
                    ->label('Kelurahan/Desa')
                    ->description(fn($record) => 'Kec: ' . $record->district->name)
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('district_id')
                    ->label('Kecamatan')
                    ->placeholder('Semua Kecamatan')
                    ->options(District::pluck('name', 'id')),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSubDistricts::route('/'),
        ];
    }
}
