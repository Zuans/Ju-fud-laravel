<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class sendRequest extends FormRequest
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
            'name' => ['required', 'max:10'],
            'email' => ['required'],
            'password' => ['required', 'min:4'],
            'password2' => ['required', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama nya lupa di masukkin kak',
            'name.max' => 'Nama tidak boleh lebih dari 10 karakter',
            'email.required' => 'Email Nya Masukin Woy',
            'password.min' => 'Password Nya Minamal 6 Karaketer yaaa',
            'password2.same' => 'Beda Nih password nya coba ketik lagi',
            'password.required' => 'Password nya masukkin ya kak',
            'password2.required' => 'Jangan lupa Ketik ulang password nya',
        ];
    }
}
