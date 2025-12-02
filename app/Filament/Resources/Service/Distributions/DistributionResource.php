<?php

namespace App\Filament\Resources\Service\Distributions;

use App\Filament\Resources\Service\Distributions\Pages\CreateDistribution;
use App\Filament\Resources\Service\Distributions\Pages\EditDistribution;
use App\Filament\Resources\Service\Distributions\Pages\ListDistributions;
use App\Filament\Resources\Service\Distributions\Schemas\DistributionForm;
use App\Filament\Resources\Service\Distributions\Tables\DistributionsTable;
use App\Models\Service\Distribution;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DistributionResource extends Resource
{
    protected static ?string $model = Distribution::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Distribution';

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
