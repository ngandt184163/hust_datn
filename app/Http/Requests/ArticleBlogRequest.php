<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleBlogRequest extends FormRequest
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
            'content' => 'required',
            'menu_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Tên không được để trống',
            'name.min'     => 'Tên không được ít hơn 3 kí tự',
            'content.required' => 'Nội dung không được trống',
            'menu_id.required' => 'Danh mục chưa được chọn.'
        ];
    }


    // protected function failedValidation(Validator $validator)
    // {
    //     // Tạo response JSON với thông báo lỗi và mã lỗi 422
    //     $errors = $validator->errors();
    //     throw new HttpResponseException(response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    // }
}
