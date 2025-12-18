<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data diambil dari kolom 'Status' dan 'Skor Final' di gambar (kolom tengah)
        // Nilai 'name' menggunakan format Setiap Kata Diawali Huruf Kapital (Title Case)
        $data = [
            ['name' => 'Belum/Tidak Bekerja', 'score_work' => 30],
            ['name' => 'Mengurus Rumah Tangga', 'score_work' => 30],
            ['name' => 'Buruh Harian Lepas', 'score_work' => 30],
            ['name' => 'Buruh Tani / Perkebunan', 'score_work' => 30],
            ['name' => 'Pembantu Rumah Tangga', 'score_work' => 30],
            ['name' => 'Wiraswasta', 'score_work' => 20],
            ['name' => 'Pedagang', 'score_work' => 20],
            ['name' => 'Perdagangan', 'score_work' => 20],
            ['name' => 'Petani / Pekebun', 'score_work' => 20],
            ['name' => 'Sopir', 'score_work' => 20],
            ['name' => 'Tukang Las/Pandai Besi', 'score_work' => 20],
            ['name' => 'Tukang Jahit', 'score_work' => 20],
            ['name' => 'Tukang Kayu', 'score_work' => 20],
            ['name' => 'Tukang Batu', 'score_work' => 20],
            ['name' => 'Nelayan', 'score_work' => 20],
            ['name' => 'Karyawan Swasta', 'score_work' => 10],
            ['name' => 'Karyawan Honorer', 'score_work' => 10],
            ['name' => 'Ustadz', 'score_work' => 10],
            ['name' => 'Seniman', 'score_work' => 10],
            ['name' => 'Pelajar', 'score_work' => 5],
            ['name' => 'Bidan', 'score_work' => 5],
            ['name' => 'Perawat', 'score_work' => 5],
            ['name' => 'Peneliti', 'score_work' => 5],
            ['name' => 'Penata Rias/Busana', 'score_work' => 5],
        ];

        foreach ($data as $work) {
            DB::table('works')->updateOrInsert(
                ['name' => $work['name']],
                $work
            );
        }
    }
}
