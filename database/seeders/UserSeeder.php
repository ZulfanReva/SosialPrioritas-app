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
            'name' => 'Officer Sosial Prioritas',
            'email' => 'officer@sosialprioritas.com',
            'phone' => '081234567891',
            'district_id' => 1, // Ganti dengan ID district yang valid jika berbeda
            'role' => 'officer',
            'is_active' => true,
            'password' => Hash::make('123'),
        ]);

        // You can add more users as needed
    }
}
