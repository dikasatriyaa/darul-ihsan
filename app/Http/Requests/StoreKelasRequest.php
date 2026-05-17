<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKelasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kelas'         => 'required|string|max:255',
            'wali_kelas_id' => 'required|exists:users,id',
            'santri_ids'    => 'nullable|array',
            'santri_ids.*'  => 'exists:santris,id'
        ];
    }
}
