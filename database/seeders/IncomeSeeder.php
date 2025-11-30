<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data diambil dari kolom 'Income Range' dan 'Skor' di gambar
        $data = [
            ['name' => 'Tidak Ada', 'score_income' => 40],
            ['name' => '< 500k', 'score_income' => 35],
            ['name' => '500k – 1jt', 'score_income' => 25],
            ['name' => '1jt – 1.5jt', 'score_income' => 15],
            ['name' => '1.5jt – 2jt', 'score_income' => 10],
            ['name' => '> 2jt', 'score_income' => 0],
        ];

        foreach ($data as $income) {
            DB::table('incomes')->updateOrInsert(
                ['name' => $income['name']],
                $income
            );
        }
    }
}
