<?php

namespace App\Filament\Resources\Bansos\Periods;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use App\Models\PeriodBansos;
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
use App\Filament\Resources\Bansos\Periods\Pages\ManagePeriods;

class PeriodResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = PeriodBansos::class;

    protected static string|UnitEnum|null $navigationGroup = 'Bantuan Sosial';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    public static ?int $navigationSort = 6;
    protected static ?string $slug = 'periods';
    protected static ?string $navigationLabel = 'Periode';

    protected static ?string $recordTitleAttribute = 'PeriodBansos';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Periode')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('PeriodBansos')
            ->columns([
                TextColumn::make('name')
                    ->label('Periode')
                    ->searchable(),
            ])
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
            'index' => ManagePeriods::route('/'),
        ];
    }
}
