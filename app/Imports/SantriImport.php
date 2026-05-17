<?php

namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SantriImport implements ToModel, WithHeadingRow
{
    /**
     * Pemetaan kolom Excel ke Kolom Database.
     * Pastikan baris pertama Excel Anda (Header) bernama: nama, nisn, nism, asal_sekolah, nama_orang_tua, nomor_whatsapp, status
     */
    public function model(array $row)
    {
        // Menyesuaikan value status dari Excel ke Enum database Anda
        // Di Excel tertulis "Pendaftaran Diterima", sedangkan di database Anda adalah "diterima"
        if (empty($row['nama'])) {
            return null;
        }
        return new Santri([
            'nama'           => $row['nama'],
            'nisn'           => $row['nisn'],
            'nism'           => $row['nism'],
            'no_bpjs'        => $row['no_bpjs'] ?? null,
            'asal_sekolah'   => $row['asal_sekolah'],
            'nama_orang_tua' => $row['nama_orang_tua'],
            'nomor_whatsapp' => $row['nomor_whatsapp'] ?? '-',
            'status'         => $row['status'],
        ]);
    }

    // Aturan validasi untuk menyaring baris kosong
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'nisn' => 'required|unique:santris,nisn',
            'nism' => 'required|unique:santris,nism',
            // tambahkan validasi kolom lain jika diperlukan
        ];
    }
}
