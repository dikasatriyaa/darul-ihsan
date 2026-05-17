<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Santri;

class SantriSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Santri::create([
                'nama' => 'Fulan Fulanah ' . $i,
                'nisn' => '10000' . $i,
                'nism' => '20000' . $i,
                'no_bpjs' => '30000' . $i,
                'asal_sekolah' => 'SMP Negeri ' . $i,
                'nama_orang_tua' => 'Orang Tua ' . $i,
                'nomor_whatsapp' => '0812345678' . $i,
                'status' => 'Pendaftaran Diterima'
            ]);
        }
    }
}
