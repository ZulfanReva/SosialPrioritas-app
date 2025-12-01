<?php

namespace App\Filament\Resources\Geography\Regencies;

use UnitEnum;
use BackedEnum;
use App\Models\Regency;
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
use App\Filament\Resources\Geography\Regencies\Pages\ManageRegencies;

class RegencyResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = Regency::class;

    protected static string|UnitEnum|null $navigationGroup = 'Geography';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    public static ?int $navigationSort = 3;
    protected static ?string $slug = 'regencies';
    protected static ?string $navigationLabel = 'Kabupaten';

    protected static ?string $recordTitleAttribute = 'Regency';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Kabupaten')
                    ->required()
                    ->maxLength(100),
                Select::make('province_id')
                    ->relationship('province', 'name')
                    ->label('Provinsi')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Regency')
            ->columns([
                TextColumn::make('index')
                    ->rowIndex() // Nomor urut otomatis per halaman
                    ->label('No.'),
                TextColumn::make('name')
                    ->label('Kabupaten')
                    ->description(fn($record) => 'Prov: ' . $record->province->name)
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
            'index' => ManageRegencies::route('/'),
        ];
    }
}
