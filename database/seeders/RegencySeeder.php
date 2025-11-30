<?php

namespace Database\Seeders;

use App\Models\Regency;
use Illuminate\Database\Seeder;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Regency::firstOrCreate([
            'name' => 'Banjarmasin',
            'province_id' => 1,
        ]);
    }
}
