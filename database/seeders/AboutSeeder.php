<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    public function run(): void
    {
        About::create([
            'title' => 'Tentang Pesantren',
            'image' => 'about/about.jpg',
            'body' => 'Pesantren modern yang mengintegrasikan pendidikan diniyah dan akademik untuk membentuk generasi berakhlak dan berprestasi.'
        ]);
    }
}
