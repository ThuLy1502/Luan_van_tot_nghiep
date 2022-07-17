<?php

namespace App\Http\Requests\Authors;

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
            // Nếu bạn muốn dừng chạy validate trên 1 phần tử ngay khi rule đầu tiên bị fail, 
            // hãy thêm rule bail
            'author_name' => 'bail|required|unique:authors|between:3,255',
            'author_thumb' => 'bail|required|
                image|mimes:jpeg,jpg,png,svg,gif|max:2048|
                dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
            'author_description' => 'bail|required|min:20'
        ];
    }

    public function messages() : array
    {
        return [
            'author_name.required' => 'Vui lòng nhập Tên tác giả',
            'author_name.unique' => 'Tên tác giả đã tồn tại, vui lòng nhập tên khác',
            'author_name.between' => 'Tên tác giả phải từ 3 đến 255 kí tự',

            'author_thumb.required' => 'Vui lòng chọn Hình tác giả',
            'author_thumb.image' => 'Vui lòng chọn file hình ảnh',
            'author_thumb.mimes' => 'Định dạng hình ảnh không hỗ trợ',
            'author_thumb.dimensions' => 'Kích thước hình ảnh không phù hợp',

            'author_description.required' => 'Vui lòng mô tả Tác giả',
            'author_description.min' => 'Mô tả Tác giả phải ít nhất 20 kí tự'
        ];
    }
}
