<?php

namespace App\Filament\Resources\Service\Citizens;

use UnitEnum;
use BackedEnum;
use App\Filament\Resources\Service\Citizens\Pages\CreateCitizen;
use App\Filament\Resources\Service\Citizens\Pages\EditCitizen;
use App\Filament\Resources\Service\Citizens\Pages\ListCitizens;
use App\Filament\Resources\Service\Citizens\Schemas\CitizenForm;
use App\Filament\Resources\Service\Citizens\Tables\CitizensTable;
use App\Models\Citizen;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CitizenResource extends Resource
{
    protected static ?string $model = Citizen::class;

    protected static string|UnitEnum|null $navigationGroup = 'Pelayanan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    public static ?int $navigationSort = 12;
    protected static ?string $slug = 'citizens';
    protected static ?string $navigationLabel = 'Kependudukan';

    protected static ?string $recordTitleAttribute = 'relationship';

    public static function form(Schema $schema): Schema
    {
        return CitizenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CitizensTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCitizens::route('/'),
            'create' => CreateCitizen::route('/create'),
            'edit' => EditCitizen::route('/{record}/edit'),
        ];
    }
}
