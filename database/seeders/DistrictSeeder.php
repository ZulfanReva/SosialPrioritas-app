<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $districts = [
            ['name' => 'Banjarmasin Utara', 'regency_id' => 1],
            ['name' => 'Banjarmasin Selatan', 'regency_id' => 1],
            ['name' => 'Banjarmasin Timur', 'regency_id' => 1],
            ['name' => 'Banjarmasin Barat', 'regency_id' => 1],
            ['name' => 'Banjarmasin Tengah', 'regency_id' => 1],
        ];

        foreach ($districts as $district) {
            District::firstOrCreate($district);
        }
    }
}
