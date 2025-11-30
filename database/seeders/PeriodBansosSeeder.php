<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodBansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('period_bansos')->insert([
            ['name' => '2023'],
            ['name' => '2024'],
            ['name' => '2025'],
        ]);
    }
}
