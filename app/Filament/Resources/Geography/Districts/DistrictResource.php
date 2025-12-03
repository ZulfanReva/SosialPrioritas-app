<?php

namespace App\Filament\Resources\Geography\Districts;

use UnitEnum;
use BackedEnum;
use App\Models\District;
use Filament\Tables\Table;
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
use App\Filament\Resources\Geography\Districts\Pages\ManageDistricts;

class DistrictResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = District::class;

    protected static string|UnitEnum|null $navigationGroup = 'Geography';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    public static ?int $navigationSort = 4;
    protected static ?string $slug = 'districts';
    protected static ?string $navigationLabel = 'Kecamatan';

    protected static ?string $recordTitleAttribute = 'District';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('province_id')
                    ->label('Provinsi')
                    ->relationship('regency.province', 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(fn (callable $set) => $set('regency_id', null))
                    ->required(),
                Select::make('regency_id')
                    ->label('Kabupaten')
                    ->options(function (callable $get) {
                        $provinceId = $get('province_id');
                        if (!$provinceId) {
                            return [];
                        }
                        return \App\Models\Regency::query()
                            ->where('province_id', $provinceId)
                            ->pluck('name', 'id');
                    })
                    ->searchable()
                    ->preload()
                    ->required()
                    ->disabled(fn (callable $get) => !$get('province_id')),
                TextInput::make('name')
                    ->label('Kecamatan')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('District')
            ->columns([
                TextColumn::make('index')
                    ->rowIndex() // Nomor urut otomatis per halaman
                    ->label('No.'),
                TextColumn::make('name')
                    ->label('Kecamatan')
                    ->description(fn($record) => 'Kab: ' . $record->regency->name)
                    ->searchable(),
            ])
            ->defaultSort('name', 'asc')
            ->filters([
                //
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
            'index' => ManageDistricts::route('/'),
        ];
    }
}
