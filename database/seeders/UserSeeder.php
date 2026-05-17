<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@pesantren.test',
            'password' => Hash::make('password'),
            'tempat_lahir' => 'Jambi',
            'tanggal_lahir' => '1995-05-10',
            'deskripsi' => 'Administrator sistem pesantren',
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Rodia, S.Pd',
            'email' => 'rodia@pesantren.test',
            'password' => Hash::make('password'),
            'tempat_lahir' => 'Padang',
            'tanggal_lahir' => '1990-03-12',
            'deskripsi' => 'Wali kelas dan pembimbing santri',
            'role' => 'guru'
        ]);
        User::create([
            'name' => 'Zhorip Muzani, S.Ag',
            'email' => 'zhorip@pesantren.test',
            'password' => Hash::make('password'),
            'tempat_lahir' => 'Padang',
            'tanggal_lahir' => '1990-03-12',
            'deskripsi' => 'Wali kelas dan pembimbing santri',
            'role' => 'guru'
        ]);
        User::create([
            'name' => 'Abdurrahman Wahid',
            'email' => 'wahid@pesantren.test',
            'password' => Hash::make('password'),
            'tempat_lahir' => 'Padang',
            'tanggal_lahir' => '1990-03-12',
            'deskripsi' => 'Wali kelas dan pembimbing santri',
            'role' => 'guru'
        ]);
    }
}
