<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
            'name'     => 'required|min:3',
            'category_id' => 'required_without_all:custom_category',
            'custom_category' => 'required_without_all:category_id|unique:categories,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Tên không được để trống',
            'name.min'     => 'Tên không được ít hơn 3 kí tự',
            'category_id.required' => 'Trường này chưa được chọn.',
            'category_id.required_without_all' => 'Vui lòng chọn danh mục hoặc thêm danh mục',
            'custom_category.required_without_all' => 'Vui lòng chọn danh mục hoặc thêm danh mục',
            'custom_category.unique' => 'Danh mục này đã có trong danh sách, vui lòng chọn danh mục.'
        ];
    }
}
