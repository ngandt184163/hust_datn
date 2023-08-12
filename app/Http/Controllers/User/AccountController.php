<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordUserRequest;
use App\Models\User;
use App\Models\UserFollow;
use App\Models\Notification;
use App\Http\Requests\UserUpdateProfileRequest;
use App\Events\UserHasNotificationEvent;
use App\Events\UserUnNotificationEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function account(Request $request)
    {
        $user = Auth::user();
        return view('frontend.account.index', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();
        return view('frontend.account.update_password', compact('user'));
    }

    public function processUpdatePassword(UpdatePasswordUserRequest $request)
    {
        if(Hash::check($request->password_old , auth()->user()->password)) {
            $user = User::find(auth()->id());
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            toastr()->success("Cập nhật thành công!");
            return redirect()->back();
        }

        toastr()->error("Mật khẩu cũ không khớp");
        return redirect()->route('get.profile.detail', ['id' => Auth::user()->id]);
    }


    public function updateProfile(UserUpdateProfileRequest $request)
    {
        try {
            // Kiểm tra dữ liệu từ request bằng UserUpdateProfileRequest
            $validatedData = $request->validated();

            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->updated_at = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $user->avatar = $file['name'];
            }

            // if(isset($request->avatar)){
            //     $file = upload_image('avatar');
            //     if (isset($file['code']) && $file['code'] == 1) $user->avatar = $file['name'];
            // }


            $user->save();
            // toastr()->success('Cập nhật thành công!', 'Thông báo');
        } catch ( \Exception $exception ) {
            // toastr()->error('Cập nhật thất bại!', 'Thông báo');
            Log::error("ERROR => ProfileController@updateProfile => " . $exception->getMessage());
        }
        // return redirect()->route('get.profile.detail', ['id' => Auth::user()->id]);
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to('/');
    }

    public function followUser(Request $request, $id)
    {
        $check_noti =0;
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');

        $check = UserFollow::where([
            'user_id'        => $userId,
            'user_follow_id' => $id
        ])->first();

        if (!$check) {
            $check = UserFollow::create([
                'user_id'        => $userId,
                'user_follow_id' => $id,
                'created_at'     => Carbon::now()
            ]);

            // lưu thông báo khi có follow
            Notification::create([
                'user_id_nguon'    => $userId,
                'user_id_dich'    => $id,
                'type' => 3,
                'status' => 0,
                'created_at' => Carbon::now()
            ]);
            DB::table('users')->where('id', $id)->increment('total_follow', 1);

            event(new UserHasNotificationEvent($id));
        }

        return redirect()->back();
    }

    public function unFollowUser(Request $request, $id)
    {
        $userId = Auth::user()->id ?? 0;
        if (!$userId) return redirect()->route('get.login');

        $check = UserFollow::where([
            'user_id'        => $userId,
            'user_follow_id' => $id
        ])->first();

        if ($check) {
            $check->delete();
            DB::table('users')->where('id', $id)->decrement('total_follow', 1);

            //xóa khỏi bảng thông báo
            $notification = Notification::where('user_id_nguon', $userId)
                ->where('user_id_dich', $id)
                ->first();
            if($notification){
                if($notification->status == 0){
                    event(new UserUnNotificationEvent($id));
                }
                $notification->delete();
            }

            // xóa dữ liệu khỏi bảng follow.
            UserFollow::where('user_id', $userId)
            ->where('user_follow_id', $id)
            ->delete();
        }

        return redirect()->back();
    }
}
