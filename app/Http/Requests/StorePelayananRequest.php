<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePelayananRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'penjamin' => 'required',
            'nama' => [
                'required',
                Rule::unique('pelayanans', 'nama')->ignore($this->pelayanan),
            ],
            'jk' => 'required',
            'tanggal' => 'required',
            'nik' => [
                'required',
                Rule::unique('pelayanans', 'nik')->ignore($this->pelayanan)
            ],
            'poliklinik_id' => 'required',
            'dokter_id' => 'required',
        ];
    }
}
