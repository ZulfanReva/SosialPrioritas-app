<?php

namespace App\Filament\Resources\Bansos\Priorities;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\PriorityBansos;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\Bansos\Priorities\Pages\ManagePriorities;

class PriorityResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = PriorityBansos::class;

    protected static string|UnitEnum|null $navigationGroup = 'Bantuan Sosial';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    public static ?int $navigationSort = 8;
    protected static ?string $slug = 'priorities';
    protected static ?string $navigationLabel = 'Prioritas';

    protected static ?string $recordTitleAttribute = 'PriorityBansos';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('PriorityBansos')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('PriorityBansos')
            ->columns([
                TextColumn::make('PriorityBansos')
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
            'index' => ManagePriorities::route('/'),
        ];
    }
}
