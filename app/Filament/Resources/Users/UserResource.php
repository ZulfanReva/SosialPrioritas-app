<?php

namespace App\Filament\Resources\Users;

use UnitEnum;
use BackedEnum;
use App\Models\User;
use App\Models\District;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use App\Livewire\UserOverview;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use App\Filament\Widgets\UserStatsOverview;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\Users\Pages\ManageUsers;

class UserResource extends Resource
{
    public static function canAccess(): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    protected static ?string $model = User::class;

    protected static string|UnitEnum|null $navigationGroup = 'Account';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserCircle;

    public static ?int $navigationSort = 1;
    protected static ?string $slug = 'users';


    protected static ?string $recordTitleAttribute = 'User';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Fieldset::make('Informasi Pribadi')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Masukan nama lengkap')
                            ->validationMessages([
                                'required' => 'Nama lengkap wajib diisi.',
                                'max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
                            ]),

                        TextInput::make('phone')
                            ->label('Nomor Handphone')
                            ->tel()
                            ->required()
                            ->placeholder('Masukan nomor handphone')
                            ->unique(ignoreRecord: true)
                            ->minLength(8)
                            ->maxLength(12)
                            ->validationMessages([
                                'required' => 'Nomor handphone wajib diisi.',
                                'unique' => 'Nomor handphone ini sudah terdaftar.',
                                'min' => 'Nomor handphone minimal harus 10 angka.',
                                'max' => 'Nomor handphone maksimal harus 12 angka.',
                            ]),

                        Select::make('district_id')
                            ->label('Kecamatan')
                            ->options(District::all()->pluck('name', 'id'))
                            ->relationship('district', 'name')
                            ->searchable()
                            ->placeholder('Pilih Kecamatan')
                            ->required()
                            ->validationMessages([
                                'required' => 'Kecamatan wajib dipilih.',
                            ]),
                    ]),
                Fieldset::make('Informasi Akun')
                    ->columnSpanFull()
                    ->schema([

                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->unique(
                                table: User::class,
                                column: 'email',
                                modifyRuleUsing: function ($rule, $context, $record) {
                                    if ($context === 'edit' && $record) {
                                        return $rule->ignore($record->id);
                                    }
                                    return $rule;
                                }
                            )
                            ->maxLength(50)
                            ->placeholder('Masukan alamat email')
                            ->validationMessages([
                                'required' => 'Alamat email wajib diisi.',
                                'email' => 'Format alamat email tidak valid.',
                                'unique' => 'Alamat email ini sudah terdaftar.',
                            ]),

                        TextInput::make('password')
                            ->label('Kata Sandi')
                            ->password()
                            ->required(fn(string $context): bool => $context === 'create')
                            ->dehydrated(fn($state) => filled($state))
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->minLength(8)
                            ->maxLength(255)
                            ->placeholder('Masukan kata sandi minimal 8 karakter')
                            ->helperText('Kosongkan jika tidak ingin mengubah kata sandi (untuk edit)')
                            ->validationMessages([
                                'required' => 'Kata sandi wajib diisi.',
                                'min' => 'Kata sandi minimal harus 8 karakter.',
                            ]),

                        Select::make('role')
                            ->options([
                                'admin' => 'Admin',
                                'officer' => 'Officer',
                            ])
                            ->required()
                            ->default('officer'),
                        Select::make('is_active')
                            ->label('Active')
                            ->label('Status User')
                            ->options([
                                true => 'Aktif',
                                false => 'Tidak Aktif',
                            ])
                            ->default(true)
                            ->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('User')
            ->columns([
                TextColumn::make('index')
                    ->rowIndex() // Nomor urut otomatis per halaman
                    ->label('No.'),

                TextColumn::make('name')
                    ->label('User')
                    ->searchable(['name', 'email'])
                    ->description(fn($record) => $record->email),
                TextColumn::make('phone')
                    ->label('Handphone')
                    ->searchable(),
                TextColumn::make('district.name')
                    ->label('Kecamatan')
                    ->default('N/A'),
                TextColumn::make('role')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'admin' => 'Admin',
                        'officer' => 'Officer',
                        default => ucfirst($state),
                    })
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'admin' => 'success',
                        'officer' => 'primary',
                    })
                    ->icon(fn(string $state) => match ($state) {
                        'admin' => 'heroicon-m-key',
                        'officer' => 'heroicon-m-building-office',
                        default => 'heroicon-o-question-mark-circle',
                    }),
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->placeholder('All Role')
                    ->options([
                        'admin' => 'Admin',
                        'officer' => 'Officer',
                    ]),
                SelectFilter::make('district_id')
                    ->label('Kecamatan')
                    ->placeholder('All Districts')
                    ->options(District::pluck('name', 'id')),
                TernaryFilter::make('is_active')
                    ->placeholder('All Status')
                    ->label('Active'),
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
            'index' => ManageUsers::route('/'),
        ];
    }

    /**
     * Get navigation badge (count of inactive users)
     */
    public static function getNavigationBadge(): ?string
    {
        $inactiveCount = static::getModel()::where('is_active', false)->count();
        return $inactiveCount > 0 ? (string) $inactiveCount : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getNavigationBadge() ? 'primary' : null;
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        $count = static::getNavigationBadge();
        return $count ? "Ada {$count} user tidak aktif" : null;
    }

    public static function getWidgets(): array
    {
        return [
            UserOverview::class,
        ];
    }
}
