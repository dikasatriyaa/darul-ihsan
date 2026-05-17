<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tempat_lahir',
        'tanggal_lahir',
        'deskripsi',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'email_verified_at' => 'datetime',
    ];

    public function getInitialAttribute()
    {
        $words = explode(' ', $this->name);
        return strtoupper(
            substr($words[0], 0, 1) .
                (isset($words[1]) ? substr($words[1], 0, 1) : '')
        );
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function kelasWali()
    {
        return $this->hasMany(Kelas::class, 'wali_kelas_id');
    }
}
