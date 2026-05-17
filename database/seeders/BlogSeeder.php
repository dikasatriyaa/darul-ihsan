<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        for ($i = 1; $i <= 5; $i++) {

            $title = "Kegiatan Ekstrakurikuler Pesantren " . $i;

            Blog::create([
                'image' => 'image/1.jpeg',
                'slug' => Str::slug($title),
                'user_id' => $user->id,
                'title' => $title,
                'tag' => 'Ekstrakurikuler, Pesantren',
                'body' => <<<HTML

<p class="text-base text-black leading-relaxed">
Tailwind CSS v4 membawa perubahan besar dalam cara kita mengkonfigurasi dan menggunakan
framework ini. Tidak ada lagi <code class="px-1.5 py-0.5 bg-muted rounded-md text-sm font-mono text-black">tailwind.config.js</code>
— semuanya pindah ke dalam file CSS menggunakan direktif
<code class="px-1.5 py-0.5 bg-muted rounded-md text-sm font-mono text-black">@theme</code>.
Lesson ini membahas semua perubahan yang perlu kamu ketahui.
</p>

<h2 class="text-xl font-bold text-fore mt-8 mb-3">Apa yang Berubah di v4?</h2>

<p class="text-base text-black leading-relaxed">
Perubahan paling signifikan adalah penghapusan file konfigurasi JavaScript.
Di versi sebelumnya, semua kustomisasi dilakukan di
<code class="px-1.5 py-0.5 bg-muted rounded-md text-sm font-mono text-black">tailwind.config.js</code>.
Di v4, kamu mendefinisikan design tokens langsung di CSS menggunakan blok
<code class="px-1.5 py-0.5 bg-muted rounded-md text-sm font-mono text-black">@theme</code>.
</p>

<div class="bg-fore rounded-2xl p-5 overflow-x-auto">
<p class="text-xs text-black mb-3 font-mono uppercase tracking-widest">CSS</p>
<pre class="text-sm text-green-400 font-mono leading-relaxed"><code>@theme {
  --color-primary: #165DFF;
  --font-sans: 'Lexend Deca', sans-serif;
  --radius-card: 24px;
}</code></pre>
</div>

<h2 class="text-xl font-bold text-fore mt-8 mb-3">Cara Pakai via CDN</h2>

<p class="text-base text-black leading-relaxed">
Untuk keperluan belajar dan prototyping, Tailwind v4 menyediakan CDN browser
yang bisa langsung dipakai tanpa proses build apapun.
</p>

<div class="bg-fore rounded-2xl p-5 overflow-x-auto">
<p class="text-xs text-black mb-3 font-mono uppercase tracking-widest">HTML</p>
<pre class="text-sm text-blue-300 font-mono leading-relaxed"><code>&lt;script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"&gt;&lt;/script&gt;</code></pre>
</div>

<p class="text-base text-black leading-relaxed">
CDN ini memproses class Tailwind langsung di browser — cocok untuk development
dan pembelajaran, tapi tidak direkomendasikan untuk production.
</p>

<div class="bg-primary/5 border border-primary/20 rounded-2xl p-5">
<p class="font-semibold text-sm mb-1">Catatan Penting</p>
<p class="text-sm leading-relaxed">
Untuk project production, gunakan Tailwind CLI atau Vite plugin
agar CSS yang dihasilkan hanya berisi class yang benar-benar dipakai.
</p>
</div>

<h2 class="text-xl font-bold text-fore mt-8 mb-3">Custom Token di v4</h2>

<p class="text-base text-black leading-relaxed">
Design tokens seperti warna, font, radius, dan spacing sekarang
didefinisikan sebagai CSS custom properties dalam blok
<code class="px-1.5 py-0.5 bg-muted rounded-md text-sm font-mono text-black">@theme</code>.
</p>

HTML
            ]);
        }
    }
}
