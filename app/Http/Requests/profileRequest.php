<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profileRequest extends FormRequest
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
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'profile_image' => 'image|nullable|max:1999',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Gaboleh Kosong loh',
            'password.required' => 'Passwordnya masih kosong',
            'email.required' => 'Ini tidak boleh kosong',
            'email.exist' => 'Email telah terdaftar',
            'profile_image.image' => 'file yang dikirim bukan gambar',
            'profile_image.max' => 'Gambar tidak boleh lebih dari 2MB',

        ];
    }
}
