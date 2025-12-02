<?php

namespace App\Filament\Resources\SocialEconomy\Incomes;

use UnitEnum;
use BackedEnum;
use App\Models\Income;
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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\SocialEconomy\Incomes\Pages\ManageIncomes;

class IncomeResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = Income::class;

    protected static string|UnitEnum|null $navigationGroup = 'Sosial Ekonomi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    public static ?int $navigationSort = 10;
    protected static ?string $slug = 'incomes';
    protected static ?string $navigationLabel = 'Pendapatan';

    protected static ?string $recordTitleAttribute = 'income';
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Pendapatan')
                    ->placeholder('Contoh: <1 juta, 1-3 juta, >3 juta')
                    ->required()
                    ->maxLength(255),
                TextInput::make('score_income')
                    ->label('Skor Pendapatan')
                    ->required()
                    ->numeric()
                    ->minValue(0)                    // opsional, biar tidak minus
                    ->maxValue(40)                   // BATAS MAKSIMAL NILAI = 40
                    ->rules(['lte:40'])              // tambahan validasi Laravel (biar error message bagus)
                    ->placeholder('Skor pendapatan maksimal 40')
                    ->validationMessages([
                        'max_value' => 'Skor pendapatan maksimal 40.',
                        'lte'       => 'Skor pendapatan tidak boleh lebih dari 40.',
                    ]),
                Select::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Income')
            ->columns([
                TextColumn::make('name')
                    ->label('Pendapatan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('score_income')
                    ->label('Skor Pendapatan')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
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
            'index' => ManageIncomes::route('/'),
        ];
    }
}
