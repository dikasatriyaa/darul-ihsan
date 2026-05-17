<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\SantriController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

Route::get('/jalankan-migrasi-db', function () {
    // Memastikan hanya bisa dieksekusi jika benar-benar dibutuhkan
    try {
        $output = Artisan::call('migrate', ['--force' => true]);
        return "Database Clever Cloud Berhasil Dimigrasi! Output: " . Artisan::output();
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return "Gagal melakukan migrasi: " . $e->getMessage();
    }
});

Route::get('/', [HomeController::class, 'index'])
    ->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/santri', [SantriController::class, 'index'])->name('santri.index');
    Route::post('/santri/import', [SantriController::class, 'import'])->name('santri.import');
    Route::get('/santri/create', [SantriController::class, 'create'])->name('santri.create');
    Route::post('/santri', [SantriController::class, 'store'])->name('santri.store');
    Route::get('/santri/kelulusan', [SantriController::class, 'kelulusanHalaman'])->name('kelulusan');
    Route::post('/santri/kelulusan/proses', [SantriController::class, 'prosesKelulusan'])->name('kelulusan.proses');
    Route::get('/santri/{id}/edit', [SantriController::class, 'edit'])->name('santri.edit');
    Route::put('/santri/{id}', [SantriController::class, 'update'])->name('santri.update');
    Route::delete('/santri/{id}', [SantriController::class, 'destroy'])->name('santri.destroy');


    // 3. Modul Akademik - Manajemen Kelas (Menggunakan Resource agar lebih ringkas)
    Route::resource('kelas', KelasController::class);

    // 4. Pengaturan Sistem - Tahun Ajaran
    Route::prefix('tahun-ajaran')->name('tahun-ajaran.')->group(function () {
        Route::get('/', [TahunAjaranController::class, 'index'])->name('index');
        Route::post('/', [TahunAjaranController::class, 'store'])->name('store');
        Route::post('/{id}/aktifkan', [TahunAjaranController::class, 'aktifkan'])->name('aktifkan');
    });
});
Route::get('/Kelulusan', [SantriController::class, 'kelulusan'])->name('kelulusan');
Route::post('/Kelulusan/Periksa', [SantriController::class, 'periksa'])->name('periksa');

Route::get('/publikasi/{slug}', [BlogController::class, 'show'])
    ->name('publikasi.show');
Route::get('/publikasi', [BlogController::class, 'index'])
    ->name('publikasi.index');

Route::get('/test', function () {
    return view('test');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
