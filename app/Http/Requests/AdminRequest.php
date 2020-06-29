<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'name' => ['required', 'max:30'],
            'email' => ['required'],
            'passwordLama' => ['required'],
            'password' => ['required', 'min:4'],
            'password2' => ['required', 'same:password'],
            'image_src' => ['img', 'max:1999'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama nya lupa di masukkin kak',
            'email.required' => 'Email Nya Masukin Woy',
            'password.min' => 'Password Nya Minamal 6 Karaketer yaaa',
            'password2.same' => 'Beda Nih password nya coba ketik lagi',
            'password.required' => 'Password nya masukkin ya kak',
            'password2.required' => 'Jangan lupa Ketik ulang password nya',
            'passwordLama.required' => 'Password lama jangan lupa dimasukkan',
            'image_src.img' => 'File yang dimasukkan harus gambar',
            'image_src.max' => 'FIle tidak boleh lebih dari 2MB',
        ];
    }
}
