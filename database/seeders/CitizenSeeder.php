<?php

namespace Database\Seeders;

use App\Models\Citizen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitizenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan tabel-tabel foreign key sudah diisi terlebih dahulu
        // (province_id, regency_id, district_id, sub_district_id, work_id, income_id, relationship_id, priority_bansos_id)

        // Fungsi untuk menghitung skor total dan menentukan priority_bansos_id
        $calculatePriority = function($work_id, $income_id, $relationship_id) {
            // Ambil skor dari database
            $workScore = DB::table('works')->where('id', $work_id)->value('score_work');
            $incomeScore = DB::table('incomes')->where('id', $income_id)->value('score_income');
            $relationshipScore = DB::table('relationships')->where('id', $relationship_id)->value('score_relationship');

            $totalScore = $workScore + $incomeScore + $relationshipScore;

            // Tentukan priority berdasarkan skor
            if ($totalScore >= 80) {
                return 1; // Tinggi
            } elseif ($totalScore >= 60) {
                return 2; // Sedang
            } else {
                return 3; // Rendah
            }
        };

        // Data citizens
        $citizens = [
            [
                'NIK' => '3273010101900001',
                'name' => 'Budi Santoso',
                'place_birth' => 'Bandung',
                'date_birth' => '1990-01-01',
                'gender' => 'Laki-laki',
                'address' => 'Jl. Merdeka No. 10, RT 01 RW 02',
                'province_id' => 1,
                'regency_id' => 1,
                'district_id' => 1,
                'sub_district_id' => 1,
                'education' => 'Sarjana',
                'work_id' => 1, // Belum/Tidak Bekerja: 30
                'income_id' => 3, // 500k – 1jt: 25
                'relationship_id' => 1, // Janda/Duda: 30
                'priority_bansos_id' => $calculatePriority(1, 3, 1), // Total: 85 -> Tinggi
            ],
            [
                'NIK' => '3273020202950002',
                'name' => 'Dewi Lestari',
                'place_birth' => 'Jakarta',
                'date_birth' => '1995-02-02',
                'gender' => 'Perempuan',
                'address' => 'Perumahan Indah Blok B No. 5, RT 03 RW 05',
                'province_id' => 1,
                'regency_id' => 1,
                'district_id' => 5,
                'sub_district_id' => 7,
                'education' => 'SMA',
                'work_id' => 5, // Wiraswasta: 20
                'income_id' => 1, // Tidak Ada: 40
                'relationship_id' => 2, // Menikah: 5
                'priority_bansos_id' => $calculatePriority(5, 1, 2), // Total: 65 -> Sedang
            ],
            [
                'NIK' => '3273030303800003',
                'name' => 'Ahmad Rahman',
                'place_birth' => 'Surabaya',
                'date_birth' => '1980-03-03',
                'gender' => 'Laki-laki',
                'address' => 'Jl. Sudirman No. 15, RT 02 RW 04',
                'province_id' => 1,
                'regency_id' => 1,
                'district_id' => 2,
                'sub_district_id' => 10,
                'education' => 'SD',
                'work_id' => 14, // Karyawan Swasta: 10
                'income_id' => 6, // > 2jt: 0
                'relationship_id' => 2, // Menikah: 5
                'priority_bansos_id' => $calculatePriority(14, 6, 2), // Total: 15 -> Rendah
            ],
            [
                'NIK' => '3273040404850004',
                'name' => 'Siti Aminah',
                'place_birth' => 'Yogyakarta',
                'date_birth' => '1985-04-04',
                'gender' => 'Perempuan',
                'address' => 'Jl. Malioboro No. 20, RT 01 RW 03',
                'province_id' => 1,
                'regency_id' => 1,
                'district_id' => 3,
                'sub_district_id' => 15,
                'education' => 'Diploma',
                'work_id' => 18, // Pelajar: 5
                'income_id' => 2, // < 500k: 35
                'relationship_id' => 3, // Belum Menikah: 10
                'priority_bansos_id' => $calculatePriority(18, 2, 3), // Total: 50 -> Rendah
            ],
            [
                'NIK' => '3273050505900005',
                'name' => 'Joko Widodo',
                'place_birth' => 'Solo',
                'date_birth' => '1990-05-05',
                'gender' => 'Laki-laki',
                'address' => 'Jl. Slamet Riyadi No. 25, RT 03 RW 06',
                'province_id' => 1,
                'regency_id' => 1,
                'district_id' => 4,
                'sub_district_id' => 20,
                'education' => 'SMP',
                'work_id' => 2, // Mengurus Rumah Tangga: 30
                'income_id' => 1, // Tidak Ada: 40
                'relationship_id' => 1, // Janda/Duda: 30
                'priority_bansos_id' => $calculatePriority(2, 1, 1), // Total: 100 -> Tinggi
            ],
        ];

        foreach ($citizens as $citizen) {
            DB::table('citizens')->updateOrInsert(
                ['NIK' => $citizen['NIK']],
                array_merge($citizen, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }
}
