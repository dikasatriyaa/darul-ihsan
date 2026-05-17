<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    // Jika nama tabel Anda murni 'kelas'
    protected $table = 'kelas';

    protected $fillable = [
        'kelas',
        'santri_id',
        'tahun_ajaran_id',
        'wali_kelas_id',
        'status',
        'is_active'
    ];

    // Relasi ke Santri (Bukan hasMany, tapi belongsTo karena kolom santri_id ada di tabel ini)
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    public function waliKelas()
    {
        return $this->belongsTo(User::class, 'wali_kelas_id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class, 'tahun_ajaran_id');
    }
}
