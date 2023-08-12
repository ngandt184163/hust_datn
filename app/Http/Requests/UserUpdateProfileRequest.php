<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfileRequest extends FormRequest
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
            'email'    => 'required|email',
            'phone'    => 'required|min:10|max:11|regex:/^[0-9]+$/',
        ];
    }

    public function messages()
    {
        return [
            'email.required'    => 'Email không được để trống',
            'name.required'     => 'Tên không được để trống',
            'name.min'     => 'Tên không được ít hơn 3 kí tự',
            'phone.min'    => 'Phone không được ít hơn :min kí tự',
            'phone.max'    => 'Phone không được nhiều hơn :max kí tự',
            'phone.required'    => 'Phone không được để trống',
        ];
    }
}
