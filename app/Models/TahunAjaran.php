<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = 'tahun_ajarans';

    protected $fillable = [
        'tahun_ajaran',
        'is_active'
    ];

    // Scope untuk mempermudah pemanggilan Tahun Ajaran yang sedang aktif
    public function scopeAktif($query)
    {
        return $query->where('is_active', true);
    }
}
