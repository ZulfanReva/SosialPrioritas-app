<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan district dengan ID 1 sudah ada (misalnya dari DistrictSeeder)
        // Jika belum, jalankan DistrictSeeder terlebih dahulu atau sesuaikan ID

        // Create an admin user
        User::create([
            'name' => 'Admin Sosial Prioritas',
            'email' => 'admin@sosialprioritas.com',
            'phone' => '081234567890',
            'district_id' => null, // Ganti dengan ID district yang valid jika berbeda
            'role' => 'admin',
            'is_active' => true,
            'password' => Hash::make('123'),
        ]);

        // Create a regular officer user
        User::create([
            'name' => 'Officer Banjarmasin Utara',
            'email' => 'officer.utara@sosialprioritas.com',
            'phone' => '081234567891',
            'district_id' => 1,
            'role' => 'officer',
            'is_active' => true,
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Officer Banjarmasin Selatan',
            'email' => 'officer.selatan@sosialprioritas.com',
            'phone' => '081234567892',
            'district_id' => 2,
            'role' => 'officer',
            'is_active' => true,
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Officer Banjarmasin Timur',
            'email' => 'officer.timur@sosialprioritas.com',
            'phone' => '081234567893',
            'district_id' => 3,
            'role' => 'officer',
            'is_active' => true,
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Officer Banjarmasin Barat',
            'email' => 'officer.barat@sosialprioritas.com',
            'phone' => '081234567894',
            'district_id' => 4,
            'role' => 'officer',
            'is_active' => true,
            'password' => Hash::make('123'),
        ]);

        User::create([
            'name' => 'Officer Banjarmasin Tengah',
            'email' => 'officer.tengah@sosialprioritas.com',
            'phone' => '081234567895',
            'district_id' => 5,
            'role' => 'officer',
            'is_active' => true,
            'password' => Hash::make('123'),
        ]);

        // You can add more users as needed
    }
}
