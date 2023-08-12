<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'video' => 'required_without_all:avatar',
            'avatar' => 'required_without_all:video',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'Tên không được để trống',
            'name.min'     => 'Tên không được ít hơn 3 kí tự',
            'video.required_without_all' => 'Vui lòng tải lên hình ảnh hoặc video',
            'avatar.required_without_all' => 'Vui lòng tải lên hình ảnh hoặc video',
        ];
    }
}
