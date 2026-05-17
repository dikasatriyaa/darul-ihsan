<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nisn')->unique();
            $table->string('nism')->unique();
            $table->string('no_bpjs')->nullable();
            $table->string('asal_sekolah');
            $table->string('nama_orang_tua');
            $table->string('nomor_whatsapp');
            $table->enum('status', ['Pendaftaran Diterima', 'Lulus Test', 'Tidak Lulus Test'])->default('Pendaftaran Diterima');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
