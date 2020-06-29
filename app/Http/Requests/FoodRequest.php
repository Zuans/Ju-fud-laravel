<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'title' => 'required',
            'price' => 'required|max:6',
            'category' => 'required',
            'description' => 'required',
            'image_src' => 'image|nullable|max:1999',
        ];
    }

    public function messages()
    {
        return [
            'price.max' => 'Harga Maksimal Adalah Rp.999.999',
            'price.required' => 'Harga Tidak Boleh Kosong',
            'title.required' => 'Nama Makanan Tidak Boleh Kosong',
            'description.required' => 'Deskripsi Tidak Boleh Kosong',
            'category.required' => 'Category tidak boleh kosong',
            'image_src.max' => 'Foto Tidak boleh lebih dari 2MB',
        ];
    }
}
