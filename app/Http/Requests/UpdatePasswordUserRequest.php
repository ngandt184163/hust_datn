<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UpdatePasswordUserRequest extends FormRequest
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
            // 'password_old'          => 'required|min:6',
            // 'password'              => 'required|confirmed|min:6',
            // 'password_confirmation' => 'required',

            'password_old' => [
                'required',
                'min:6',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Mật khẩu cũ không đúng');
                    }
                },
            ],
            'password'      => 'required|min:6',
            'password_confirmation'  => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password_old.required'     => 'Mật khẩu cũ không được để trống',
            'password_old.min'          => 'Mật khẩu cũ phải có ít nhất 6 kí tự',
            'password_old.password_check' => 'Mật khẩu cũ không đúng',
            'password.required'     => 'Mật khẩu mới không được để trống',
            'password.min'          => 'Mật khẩu mới phải có ít nhất 6 kí tự',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
            'password_confirmation.same'     => 'Xác nhận mật khẩu không khớp với mật khẩu mới',
        ];
    }
}
