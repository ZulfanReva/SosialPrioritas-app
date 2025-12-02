<?php

namespace App\Filament\Resources\Service\Citizens\Schemas;

use App\Models\Work;
use App\Models\Income;
use App\Models\Regency;
use App\Models\District;
use App\Models\Province;
use App\Models\SubDistrict;
use App\Models\Relationship;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Fieldset;

class CitizenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // === DATA PRIBADI ===
                Fieldset::make('Data Pribadi')
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('NIK')
                            ->label('NIK (Nomor Induk Kependudukan)')
                            ->placeholder('Masukkan NIK sesuai KTP')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(16)
                            ->numeric()
                            ->validationMessages([
                                'required' => 'NIK wajib diisi.',
                                'unique' => 'NIK sudah didaftarkan.',
                                'maxLength' => 'NIK maksimal 16 karakter.',
                                'numeric' => 'NIK harus berupa angka.',
                            ]),

                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->placeholder('Masukkan nama lengkap sesuai KTP')
                            ->required()
                            ->maxLength(255),

                        Grid::make(3)
                            ->columnSpanFull()
                            ->schema([
                                TextInput::make('place_birth')
                                    ->label('Tempat Lahir')
                                    ->placeholder('Masukkan tempat lahir sesuai KTP')
                                    ->required(),

                                DatePicker::make('date_birth')
                                    ->label('Tanggal Lahir')
                                    ->required()
                                    ->maxDate(now()),

                                Select::make('gender')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'Laki-laki' => 'Laki-laki',
                                        'Perempuan'  => 'Perempuan',
                                    ])
                                    ->required(),
                            ]),
                    ]),

                // === ALAMAT LENGKAP ===
                Fieldset::make('Alamat Lengkap')
                    ->schema([

                        Grid::make(2)
                            ->schema([
                                Select::make('province_id')
                                    ->label('Provinsi')
                                    ->options(Province::pluck('name', 'id'))
                                    ->searchable()
                                    ->live()
                                    ->afterStateUpdated(fn($set) => $set('regency_id', null))
                                    ->required(),

                                Select::make('regency_id')
                                    ->label('Kabupaten/Kota')
                                    ->options(
                                        fn($get) =>
                                        Regency::where('province_id', $get('province_id'))->pluck('name', 'id')
                                    )
                                    ->searchable()
                                    ->live()
                                    ->afterStateUpdated(fn($set) => $set('district_id', null))
                                    ->required(),
                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('district_id')
                                    ->label('Kecamatan')
                                    ->options(
                                        fn($get) =>
                                        District::where('regency_id', $get('regency_id'))->pluck('name', 'id')
                                    )
                                    ->searchable()
                                    ->live()
                                    ->afterStateUpdated(fn($set) => $set('sub_district_id', null))
                                    ->required(),

                                Select::make('sub_district_id')
                                    ->label('Kelurahan/Desa')
                                    ->options(
                                        fn($get) =>
                                        SubDistrict::where('district_id', $get('district_id'))->pluck('name', 'id')
                                    )
                                    ->searchable()
                                    ->required(),
                            ]),
                        Textarea::make('address')
                            ->label('Alamat Tinggal/Domisili Sekarang (Detail)')
                            ->placeholder('Masukkan alamat lengkap sesuai KTP')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),   // alamat lebih enak pakai 1 kolom supaya tidak terlalu sempit

                // === DATA SOSIAL EKONOMI ===
                Fieldset::make('Data Sosial & Ekonomi')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('education')
                                    ->label('Pendidikan Terakhir')
                                    ->options([
                                        'Tidak Tamat SD' => 'Tidak Tamat SD',
                                        'SD'             => 'SD',
                                        'SMP'            => 'SMP',
                                        'SMA'            => 'SMA',
                                        'Diploma'        => 'Diploma',
                                        'Sarjana'        => 'Sarjana',
                                        'Lainnya'        => 'Lainnya',
                                    ])
                                    ->required(),

                                Select::make('relationship_id')
                                    ->label('Hubungan dalam Keluarga')
                                    ->options(Relationship::pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),

                            ]),

                        Grid::make(2)
                            ->schema([
                                Select::make('work_id')
                                    ->label('Pekerjaan')
                                    ->options(Work::pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),

                                Select::make('income_id')
                                    ->label('Pendapatan')
                                    ->options(Income::pluck('name', 'id'))
                                    ->searchable()
                                    ->required(),
                            ]),
                    ])
                    ->columns(1),
            ]);
    }
}
