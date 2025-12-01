<?php

namespace App\Filament\Resources\Geography\Provinces;

use UnitEnum;
use BackedEnum;
use App\Models\Province;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\Geography\Provinces\Pages\ManageProvinces;

class ProvinceResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = Province::class;

    protected static string|UnitEnum|null $navigationGroup = 'Geography';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    public static ?int $navigationSort = 2;
    protected static ?string $slug = 'provinces';
    protected static ?string $navigationLabel = 'Provinsi';

    protected static ?string $recordTitleAttribute = 'Provinsi';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Provinsi')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Province')
            ->columns([
                TextColumn::make('index')
                    ->rowIndex() // Nomor urut otomatis per halaman
                    ->label('No.'),
                TextColumn::make('name')
                    ->label('Provinsi')
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
            'index' => ManageProvinces::route('/'),
        ];
    }
}
