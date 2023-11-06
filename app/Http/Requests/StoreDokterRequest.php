<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDokterRequest extends FormRequest
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
            'nama' => ['required'],
            'email' => [
                'required',
                'email',
                Rule::unique('dokters', 'email')->ignore($this->dokter),
            ],
            'password' => ['required', 'min:8'],
            'alamat' => ['required'],
            'poliklinik_id' => ['required'],
        ];
    }
}
