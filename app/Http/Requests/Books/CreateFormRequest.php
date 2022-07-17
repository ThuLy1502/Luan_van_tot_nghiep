<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'book_name' => 'required',
            'book_thumb' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'book_name.required' => 'Vui lòng nhập Tên Sách',
            'book_thumb.required' => 'Ảnh không được để trống'
        ];
    }
}
