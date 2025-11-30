<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubDistrict; // Asumsi model Anda bernama SubDistrict

class SubDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PENTING: ID Distrik (1-5) HARUS sesuai dengan data yang sudah tersimpan
        // dari DistrictSeeder Anda:
        // 1: Banjarmasin Utara
        // 2: Banjarmasin Selatan
        // 3: Banjarmasin Timur
        // 4: Banjarmasin Barat
        // 5: Banjarmasin Tengah

        $subDistricts = [
            // 1. Banjarmasin Utara (10 Kelurahan) - district_id: 1
            ['name' => 'Alalak Utara', 'district_id' => 1],
            ['name' => 'Alalak Tengah', 'district_id' => 1],
            ['name' => 'Alalak Selatan', 'district_id' => 1],
            ['name' => 'Pangeran', 'district_id' => 1],
            ['name' => 'Kuin Utara', 'district_id' => 1],
            ['name' => 'Antasan Kecil Timur', 'district_id' => 1],
            ['name' => 'Sungai Jingah', 'district_id' => 1],
            ['name' => 'Sungai Miai', 'district_id' => 1],
            ['name' => 'Sungai Andai', 'district_id' => 1],
            ['name' => 'Jelai', 'district_id' => 1],

            // 2. Banjarmasin Selatan (12 Kelurahan) - district_id: 2
            ['name' => 'Kelayan Luar', 'district_id' => 2], // Ada di Selatan, bukan Tengah
            ['name' => 'Kelayan Dalam', 'district_id' => 2],
            ['name' => 'Kelayan Tengah', 'district_id' => 2],
            ['name' => 'Kelayan Selatan', 'district_id' => 2],
            ['name' => 'Kelayan Timur', 'district_id' => 2],
            ['name' => 'Pekapuran Raya', 'district_id' => 2], // HANYA di Selatan
            ['name' => 'Pemurus Dalam', 'district_id' => 2],
            ['name' => 'Pemurus Baru', 'district_id' => 2],
            ['name' => 'Basirih Selatan', 'district_id' => 2],
            ['name' => 'Murung Raya', 'district_id' => 2],
            ['name' => 'Tanjung Pagar', 'district_id' => 2],
            ['name' => 'Mantuil', 'district_id' => 2],

            // 3. Banjarmasin Timur (9 Kelurahan) - district_id: 3
            ['name' => 'Kebun Bunga', 'district_id' => 3],
            ['name' => 'Kuripan', 'district_id' => 3],
            ['name' => 'Pekapuran B', 'district_id' => 3],
            ['name' => 'Pengambangan', 'district_id' => 3],
            ['name' => 'Benua Anyar', 'district_id' => 3],
            ['name' => 'Sungai Bilu', 'district_id' => 3],
            ['name' => 'Karang Mekar', 'district_id' => 3],
            ['name' => 'Melayu', 'district_id' => 3],
            ['name' => 'Sungai Lulut', 'district_id' => 3], // Bukan Jelai/Pekapuran Raya

            // 4. Banjarmasin Barat (10 Kelurahan) - district_id: 4
            ['name' => 'Kuin Cerucuk', 'district_id' => 4],
            ['name' => 'Kuin Selatan', 'district_id' => 4],
            ['name' => 'Pelambuan', 'district_id' => 4],
            ['name' => 'Belitung Utara', 'district_id' => 4],
            ['name' => 'Belitung Selatan', 'district_id' => 4],
            ['name' => 'Teluk Tiram', 'district_id' => 4],
            ['name' => 'Telaga Biru', 'district_id' => 4],
            ['name' => 'Telawang', 'district_id' => 4],
            ['name' => 'Basirih', 'district_id' => 4],
            ['name' => 'Marga Raya', 'district_id' => 4], // Menggantikan Anjir Pasar

            // 5. Banjarmasin Tengah (12 Kelurahan) - district_id: 5
            ['name' => 'Kertak Baru Ulu', 'district_id' => 5],
            ['name' => 'Kertak Baru Ilir', 'district_id' => 5],
            ['name' => 'Pasar Lama', 'district_id' => 5],
            ['name' => 'Teluk Dalam', 'district_id' => 5],
            ['name' => 'Antasan Besar', 'district_id' => 5],
            ['name' => 'Mekar Sari', 'district_id' => 5],
            ['name' => 'Seberang Mesjid', 'district_id' => 5],
            ['name' => 'Gadang', 'district_id' => 5],
            ['name' => 'Sungai Baru', 'district_id' => 5], // Perbaikan ejaan dari Sungei Baru
            ['name' => 'Pekapuran Laut', 'district_id' => 5],
            ['name' => 'Malaka', 'district_id' => 5],
            ['name' => 'Kelayan Luar Biasa', 'district_id' => 5], // Menggantikan Kelayan Luar

        ];

        foreach ($subDistricts as $subDistrict) {
            SubDistrict::firstOrCreate($subDistrict);
        }
    }
}
