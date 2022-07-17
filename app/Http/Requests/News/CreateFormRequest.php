<?php

namespace App\Http\Requests\News;

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
            'new_title' => 'required',
            'new_thumb' => 'required',
            'new_description' => 'required',
            'new_content' => 'required'
        ];
    }

    public function messages() : array
    {
        return [
            'new_title.required' => 'Vui lòng nhập Tiêu đề Tin tức',
            'new_thumb.required' => 'Vui lòng chọn Hình ảnh',
            'new_description.required' => 'Vui lòng nhập Mô tả Tin tức',
            'new_content.required' => 'Vui lòng nhập Nội dung Tin tức'
        ];
    }
}
