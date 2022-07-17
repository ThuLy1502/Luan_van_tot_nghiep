<?php

namespace App\Http\Requests\Publishers;

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
            'publisher_name' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'publisher_name.required' => 'Vui lòng nhập Tên Nhà Xuất Bản'
        ];
    }
}
