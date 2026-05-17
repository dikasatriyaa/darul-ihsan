<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Santri;
use App\Models\User;
use App\Models\TahunAjaran;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $tahun = TahunAjaran::where('is_active', true)->first();
        $wali = User::where('role', 'guru')->first();

        foreach (Santri::all() as $santri) {
            Kelas::create([
                'santri_id' => $santri->id,
                'wali_kelas_id' => $wali->id,
                'tahun_ajaran_id' => $tahun->id,
                'kelas' => 'VIII A',
                'status' => 'aktif',
                'is_active' => true
            ]);
        }
    }
}
