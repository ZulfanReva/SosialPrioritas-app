<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramBansosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data Program Bansos dengan kepanjangan dan deskripsi
        $data = [
            [
                'name' => 'BPNT',
                'description' => 'Bantuan Pangan Non Tunai. Bantuan sosial pangan dalam bentuk non tunai dari pemerintah yang diberikan setiap bulan kepada KPM (Keluarga Penerima Manfaat) melalui mekanisme Kartu Keluarga Sejahtera (KKS) untuk membeli bahan pangan di e-warong.',
            ],
            [
                'name' => 'PKH',
                'description' => 'Program Keluarga Harapan. Program pemberian bantuan sosial bersyarat kepada KPM yang ditetapkan sebagai penerima manfaat untuk mengurangi beban pengeluaran dan meningkatkan akses pendidikan, kesehatan, dan kesejahteraan sosial.',
            ],
            [
                'name' => 'PBI',
                'description' => 'Penerima Bantuan Iuran. Sebutan umum untuk peserta Jaminan Kesehatan Nasional (JKN) yang iuran bulanannya dibayarkan oleh pemerintah (APBN/APBD) karena kondisi ekonomi mereka.',
            ],
            [
                'name' => 'Jamkesmas PBI',
                'description' => 'Jaminan Kesehatan Masyarakat Penerima Bantuan Iuran. Program jaminan kesehatan bagi masyarakat miskin dan tidak mampu yang iurannya dibayarkan oleh Pemerintah Pusat, yang kini diintegrasikan ke dalam program JKN-KIS.',
            ],
            [
                'name' => 'KIS',
                'description' => 'Kartu Indonesia Sehat. Kartu identitas kepesertaan Jaminan Kesehatan Nasional (JKN) yang diberikan oleh BPJS Kesehatan, termasuk bagi peserta PBI.',
            ],
            [
                'name' => 'KKS',
                'description' => 'Kartu Keluarga Sejahtera. Kartu multifungsi yang diterbitkan oleh pemerintah untuk penyaluran berbagai bantuan sosial non tunai, termasuk BPNT dan PKH.',
            ],
        ];

        DB::table('program_bansos')->insert($data);
    }
}
