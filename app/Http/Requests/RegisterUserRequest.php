<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name'     => 'required|min:3',
            'email'    => 'required|unique:users,email,' . $this->id,
            'phone'    => 'required|min:10|max:11|regex:/^[0-9]+$/',
            'password' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.unique'      => 'Email đã tồn tại',
            'email.required'    => 'Email không được để trống',
            'name.required'     => 'Tên không được để trống',
            'name.min'     => 'Tên không được ít hơn 3 kí tự',
            'phone.min'    => 'Phone không được ít hơn :min kí tự',
            'phone.max'    => 'Phone không được nhiều hơn :max kí tự',
            'phone.required'    => 'Phone không được để trống',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password không được ít hơn 6 kí tự',
        ];
    }
}
