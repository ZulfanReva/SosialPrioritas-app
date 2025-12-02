<?php

namespace App\Filament\Resources\Service\Distributions;

use UnitEnum;
use BackedEnum;
use App\Filament\Resources\Service\Distributions\Pages\CreateDistribution;
use App\Filament\Resources\Service\Distributions\Pages\EditDistribution;
use App\Filament\Resources\Service\Distributions\Pages\ListDistributions;
use App\Filament\Resources\Service\Distributions\Schemas\DistributionForm;
use App\Filament\Resources\Service\Distributions\Tables\DistributionsTable;
use App\Models\Distribution;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DistributionResource extends Resource
{
    protected static ?string $model = Distribution::class;

    protected static string|UnitEnum|null $navigationGroup = 'Pelayanan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;

    public static ?int $navigationSort = 13;
    protected static ?string $slug = 'distributions';
    protected static ?string $navigationLabel = 'Distribusi Bantuan';

    protected static ?string $recordTitleAttribute = 'distribution';

    public static function form(Schema $schema): Schema
    {
        return DistributionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DistributionsTable::configure($table);
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
            'index' => ListDistributions::route('/'),
            'create' => CreateDistribution::route('/create'),
            'edit' => EditDistribution::route('/{record}/edit'),
        ];
    }
}
