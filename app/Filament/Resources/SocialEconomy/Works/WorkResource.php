<?php

namespace App\Filament\Resources\SocialEconomy\Works;

use UnitEnum;
use BackedEnum;
use App\Models\Work;
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
use App\Filament\Resources\SocialEconomy\Works\Pages\ManageWorks;

class WorkResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = Work::class;

    protected static string|UnitEnum|null $navigationGroup = 'Sosial Ekonomi';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    public static ?int $navigationSort = 9;
    protected static ?string $slug = 'works';
    protected static ?string $navigationLabel = 'Pekerjaan';

    protected static ?string $recordTitleAttribute = 'work';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Pekerjaan')
                    ->required()
                    ->maxLength(255),
                TextInput::make('score_work')
                    ->label('Skor Pekerjaan')
                    ->required()
                    ->numeric()
                    ->minValue(0)                    // opsional, biar tidak minus
                    ->maxValue(30)                   // BATAS MAKSIMAL NILAI = 30
                    ->rules(['lte:30'])              // tambahan validasi Laravel (biar error message bagus)
                    ->placeholder('Skor pekerjaan maksimal 30')
                    ->validationMessages([
                        'max_value' => 'Skor pekerjaan maksimal 30.',
                        'lte'       => 'Skor pekerjaan tidak boleh lebih dari 30.',
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
            ->recordTitleAttribute('work')
            ->columns([
                TextColumn::make('name')
                    ->label('Pekerjaan')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('score_work')
                    ->label('Skor Pekerjaan')
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
            'index' => ManageWorks::route('/'),
        ];
    }
}
