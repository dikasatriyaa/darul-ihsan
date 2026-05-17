<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Santri extends Model
{
    use HasFactory;

    protected $table = 'santris';

    protected $fillable = [
        'nama',
        'nisn',
        'nism',
        'no_bpjs',
        'asal_sekolah',
        'nama_orang_tua',
        'nomor_whatsapp',
        'status'
    ];

    /**
     * Hubungan Many-to-Many: Santri bisa berpindah kelas setiap tahun ajaran
     * Menggunakan kebalikan 4 argumen dari model Kelas
     */
    // Di dalam app/Models/Santri.php
    public function kelas(): HasMany
    {
        return $this->hasMany(Kelas::class, 'santri_id', 'id');
    }

    /**
     * Helper untuk mengambil data kelas khusus di Tahun Ajaran yang sedang aktif saja
     */
    public function kelasAktif()
    {
        $tahunAktif = TahunAjaran::getAktif();
        if (!$tahunAktif) return null;

        return $this->kelas()
            ->where('kelas.tahun_ajaran_id', $tahunAktif->id)
            ->first();
    }
}
