<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProvinceSeeder::class,
            RegencySeeder::class,
            DistrictSeeder::class,
            SubDistrictSeeder::class,
            IncomeSeeder::class,
            WorkSeeder::class,
            RelationshipSeeder::class,
            PriorityBansosSeeder::class,
            PeriodBansosSeeder::class,
            ProgramBansosSeeder::class,
            CitizenSeeder::class,
            UserSeeder::class,
        ]);
    }
}
