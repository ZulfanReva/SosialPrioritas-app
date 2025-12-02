<?php

namespace App\Filament\Resources\Bansos\Programs;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Models\ProgramBansos;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\Bansos\Programs\Pages\ManagePrograms;
use Filament\Forms\Components\Textarea;

class ProgramResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = ProgramBansos::class;

    protected static string|UnitEnum|null $navigationGroup = 'Bantuan Sosial';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    public static ?int $navigationSort = 7;
    protected static ?string $slug = 'programs';
    protected static ?string $navigationLabel = 'Program';

    protected static ?string $recordTitleAttribute = 'ProgramBansos';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Program')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Deskripsi Program')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ProgramBansos')
            ->columns([
                TextColumn::make('name')
                    ->label('Program')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(100)                  // tampilkan maksimal 50 karakter
                    ->tooltip(fn($record) => $record->description) // hover = muncul full text
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
            'index' => ManagePrograms::route('/'),
        ];
    }
}
