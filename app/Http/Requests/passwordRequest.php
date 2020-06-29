<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class passwordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'passwordLama' => 'required',
            'password' => 'required|min:6',
            'password2' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'passwordLama.required' => 'Masukkan Password lamanya ya kak',
            'password.required' => 'Ini Gaboleh Kosong loh',
            'password.min' => 'Password Minimal 6 karakter',
            'password2.required' => 'Kolom ini gaboleh kosong juga',
            'password2.same' => 'Password Nya ngga sama nih coba ulang lagi',
        ];
    }
}
