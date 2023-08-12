<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckEmailRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UpdateNewPassword;
use App\Http\Requests\ForgotPasswordRequest;
use App\Mail\SendEmailResetPassword;
use App\Models\User;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailRegisterUser;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.auth.login');
    }

    public function postLogin(LoginUserRequest $request)
    {
        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];
        $credentials['status'] = 2; // Chỉ cho phép đăng nhập người dùng đã xác thực

        if (Auth::attempt($credentials)) {
            return redirect()->route('get.home');
        }
        toastr()->error('Tài khoản của bạn chưa được xác thực, vui lòng kiểm tra email và làm theo hướng dẫn để xác thực tài khoản.', 'Thông báo');
        return redirect()->route('get.login');
        // ->with('error', 'Tài khoản của bạn chưa được xác thực, vui lòng kiểm tra email và làm theo hướng dẫn để xác thực tài khoản.')
    }

    public function register()
    {
        return view('frontend.auth.register');
    }

    public function postRegister(RegisterUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $data               = $request->except('_token', 'avatar', 'user_type');
            $data['created_at'] = Carbon::now();
            $data['password']   = bcrypt($request->password);
            $data['status']     = $request->status ?? 1;
            $data['verification_token'] = Str::random(60); // Generate a random verification token

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            $userType = UserType::where('name', User::ROLE_USER)->first();
            $user     = User::create($data);

            if ($user) {
                DB::table('users_has_types')->insert([
                    'user_type_id' => $userType->id,
                    'created_at'   => Carbon::now(),
                    'user_id'      => $user->id
                ]);
            }
            DB::commit();

            // Send verification email
            Mail::to($user->email)->send(new SendEmailRegisterUser($user));

            // return redirect()->route('get.login');
            toastr()->success('Email xác thực đã được gửi thành công. Vui lòng kiểm tra hòm thư để kích hoạt tài khoản.', 'Thông báo');
            return view('frontend.auth.register_success')->with('message', 'Email xác thực đã được gửi thành công. Vui lòng kiểm tra hòm thư để kích hoạt tài khoản.');
            // ->with('message', 'Email xác thực đã được gửi thành công. Vui lòng kiểm tra hòm thư để kích hoạt tài khoản.')

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("ERROR => UserController@store => " . $exception->getMessage());
            return redirect()->back();
        }
        return redirect()->route('get.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('get.login');
    }
    public function restartPassword()
    {
        return view('frontend.auth.restart_password');
    }

    public function checkRestartPassword(CheckEmailRequest $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if (!$user) {
            toastr()->error('Không tồn tại tài khoản tương ứng!', 'Thông báo');
            return redirect()->back();
        }

        // $token = bcrypt($email) . bcrypt($user->id);
        // $passwordResets = DB::table('password_resets')
        //     ->insert([
        //         'email' => $email,
        //         'token' => $token,
        //         'created_at' => Carbon::now()
        //     ]);

        // if (!$passwordResets) {
        //     toastr()->error('Xử lý dữ liệu thất bại, xin vui lòng kiểm tra lại!', 'Thông báo');
        //     return redirect()->back();
        // }

        // $link = route('get.new_password',['token' => $token]);

        // Mail::to($user->email)
        //     ->cc('codethue94@gmail.com')
        //     ->queue(new SendEmailResetPassword($user, $link));

        

        return  redirect()->route('get.nhapMK');
    }

    // đổi mật khẩu
    public function nhapMk() {
        return view('frontend.auth.nhapMkMoi');
    }

    public function postNhapMk(ForgotPasswordRequest $request) {
        // dd($request);
        // $user = User::find($request->email());
        $user = User::where('email', $request->email)->first();
        $user->update([
            'password' => bcrypt($request->password)
        ]);
        toastr()->success("Cập nhật thành công!");

        return redirect()->route('get.login');
    }

    public function alertNewPassword()
    {
        return view('frontend.auth.alert_re_new_password');
    }

    public function newPassword(Request $request)
    {
        $token = $request->token;

        $passwordResets = DB::table('password_resets')
            ->where('token', $token)->first();

        if (!$passwordResets) {
            toastr()->error('Thông tin không hợp lệ, xin vui lòng kiểm tra lại!', 'Thông báo');
            return redirect()->route('get.restart_password');
        }

        // check token hết hạn chưa
        return view('frontend.auth.new_password');
    }

    public function processNewPassword(UpdateNewPassword $request)
    {
        $token = $request->token;

        $passwordResets = DB::table('password_resets')
            ->where('token', $token)->first();

        if (!$passwordResets) {
            toastr()->error('Thông tin không hợp lệ, xin vui lòng kiểm tra lại!', 'Thông báo');
            return redirect()->route('get.restart_password');
        }

        User::where('email', $passwordResets->email)
            ->update([
                'password' => bcrypt($request->password),
                'updated_at' => Carbon::now()
            ]);

        DB::table('password_resets')
            ->where('token', $token)->delete();

        toastr()->success('Đổi mật khẩu thành công, xin vui lòng đăng nhập lại!', 'Thông báo');
        return  redirect()->route('get.login');
    }

    public function verify($token)
        {
            $user = User::where('verification_token', $token)->first();

            if (!$user) {
                // Xử lý trường hợp mã xác thực không hợp lệ
                toastr()->error('Mã thông báo xác minh không hợp lệ. Có thể bạn đã xác minh tài khoản này trước đây, vui lòng trở lại trang đăng nhập và thử lại.', 'Thông báo');
                return redirect()->route('get.login');
                // ->with('error', 'Invalid verification token.')
            }

            // Đánh dấu người dùng đã xác thực
            $user->status = 2;
            $user->verification_token = null;
            $user->save();

            // Chuyển hướng người dùng đến trang xác thực thành công hoặc trang đăng nhập
            toastr()->success('Xác minh email thành công! Bây giờ bạn có thể đăng nhập.', 'Thông báo');
            return redirect()->route('get.login')->with('success', 'Email verification successful! You can now log in.');
        }
}

