<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentsdRequest extends FormRequest
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
            'comment'     => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'comment.required'     => 'Nội dung không được để trống',
            'comment.min'     => 'Nội dung không được ít hơn 3 kí tự',
        ];
    }
}
