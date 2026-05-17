<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::create([
            'title' => 'Hubungi Kami',
            'image' => 'contact/contact.jpg',
            'body' => 'Alamat: Jambi, Indonesia. Email: info@pesantren.test. Telp: 08123456789'
        ]);
    }
}
