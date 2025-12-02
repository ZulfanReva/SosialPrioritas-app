<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan seeder lain sudah dijalankan terlebih dahulu:
        // - UserSeeder (untuk users_id)
        // - CitizenSeeder (untuk citizen_id)
        // - ProgramBansosSeeder (untuk program_bansos_id)
        // - PeriodBansosSeeder (untuk period_bansos_id)

        $distributions = [
            [
                'users_id' => 2, // Officer Banjarmasin Utara (district 1)
                'citizen_id' => 1, // district 1
                'program_bansos_id' => 1, // BPNT
                'period_bansos_id' => 3, // 2025
                'status' => 'Selesai',
                'evidence' => 'dummybansos.jpg',
                'note' => 'Distribusi BPNT untuk keluarga Budi Santoso telah selesai.',
            ],
            [
                'users_id' => 6, // Officer Banjarmasin Tengah (district 5)
                'citizen_id' => 2, // district 5
                'program_bansos_id' => 2, // PKH
                'period_bansos_id' => 3, // 2025
                'status' => 'Proses',
                'evidence' => null,
                'note' => 'Sedang dalam proses verifikasi untuk PKH.',
            ],
            [
                'users_id' => 3, // Officer Banjarmasin Selatan (district 2)
                'citizen_id' => 3, // district 2
                'program_bansos_id' => 3, // PBI
                'period_bansos_id' => 2, // 2024
                'status' => 'Tertunda',
                'evidence' => null,
                'note' => 'Menunggu konfirmasi dari BPJS untuk PBI.',
            ],
            [
                'users_id' => 4, // Officer Banjarmasin Timur (district 3)
                'citizen_id' => 4, // district 3
                'program_bansos_id' => 4, // Jamkesmas PBI
                'period_bansos_id' => 3, // 2025
                'status' => 'Persiapan',
                'evidence' => null,
                'note' => 'Persiapan dokumen untuk Jamkesmas PBI.',
            ],
            [
                'users_id' => 5, // Officer Banjarmasin Barat (district 4)
                'citizen_id' => 5, // district 4
                'program_bansos_id' => 5, // KIS
                'period_bansos_id' => 1, // 2023
                'status' => 'Dibatalkan',
                'evidence' => null,
                'note' => 'Dibatalkan karena perubahan kriteria.',
            ],
            [
                'users_id' => 2, // Officer Banjarmasin Utara (district 1)
                'citizen_id' => 1, // district 1
                'program_bansos_id' => 6, // KKS
                'period_bansos_id' => 3, // 2025
                'status' => 'Selesai',
                'evidence' => 'dummybansos.jpg',
                'note' => 'Kartu KKS telah diterima oleh Budi Santoso.',
            ],
        ];

        DB::table('distributions')->insert($distributions);
    }
}
