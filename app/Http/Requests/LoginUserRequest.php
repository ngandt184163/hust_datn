<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginUserRequest extends FormRequest
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
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
            'password.required' => 'Vui lòng nhập mật khẩu.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $credentials = $this->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                $validator->errors()->add('password', 'Email hoặc mật khẩu không đúng.');
            }
        });
    }
}
