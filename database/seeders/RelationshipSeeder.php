<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data diambil dari kolom 'Status' dan 'Skor Final' di gambar
        $data = [
            // Catatan: 'Janda/Duda' dan 'Sangat tinggi' memiliki skor 30
            ['name' => 'Janda/Duda', 'score_relationship' => 30],
            ['name' => 'Menikah', 'score_relationship' => 5],
            ['name' => 'Belum Menikah', 'score_relationship' => 10],
        ];

        foreach ($data as $relationship) {
            DB::table('relationships')->updateOrInsert(
                ['name' => $relationship['name']],
                $relationship
            );
        }
    }
}
