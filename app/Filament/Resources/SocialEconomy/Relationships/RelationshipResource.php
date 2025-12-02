<?php

namespace App\Filament\Resources\SocialEconomy\Relationships;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use App\Models\Relationship;
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
use App\Filament\Resources\SocialEconomy\Relationships\Pages\ManageRelationships;

class RelationshipResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = Relationship::class;

    protected static string|UnitEnum|null $navigationGroup = 'Sosial Ekonomi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHeart;

    public static ?int $navigationSort = 11;
    protected static ?string $slug = 'relationships';
    protected static ?string $navigationLabel = 'Status Hubungan';

    protected static ?string $recordTitleAttribute = 'relationship';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Status Hubungan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('score_relationship')
                    ->label('Skor Status Hubungan')
                    ->required()
                    ->numeric()
                    ->minValue(0)                    // opsional, biar tidak minus
                    ->maxValue(30)                   // BATAS MAKSIMAL NILAI = 30
                    ->rules(['lte:30'])              // tambahan validasi Laravel (biar error message bagus)
                    ->placeholder('Skor status hubungan maksimal 30')
                    ->validationMessages([
                        'max_value' => 'Skor status hubungan maksimal 30.',
                        'lte'       => 'Skor status hubungan tidak boleh lebih dari 30.',
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
            ->recordTitleAttribute('Relationship')
            ->columns([
                TextColumn::make('name')
                    ->label('Statsus Hubungan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('score_relationship')
                    ->label('Skor Status Hubungan')
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
            'index' => ManageRelationships::route('/'),
        ];
    }
}
