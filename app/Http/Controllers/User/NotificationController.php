<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    public function loadNotifications()
    {
        // Lấy 12 thông báo mới nhất từ cơ sở dữ liệu
        $notifications = Notification::with('sender:id,name')
            ->where('user_id_dich', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->limit(12)
            ->get();

        // Cập nhật trạng thái của thông báo thành đã đọc (status = 1)
        Notification::where('user_id_dich', Auth::user()->id)->where('status', 0)->update(['status' => 1]);

        // Trả về thông báo dưới dạng JSON
        return response()->json($notifications);
    }

    public function loadMoreNotifications(Request $request)
    {
        // Lấy số trang cần tải từ request
        $page = $request->input('page');

        // Tính toán vị trí bắt đầu của trang cần tải
        $start = ($page - 1) * 12;

        // Lấy 12 thông báo mới nhất từ cơ sở dữ liệu bắt đầu từ vị trí $start
        $notifications = Notification::with('sender:id,name')
            ->where('user_id_dich', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->offset($start)
            ->limit(12)
            ->get();

        // Trả về thông báo dưới dạng JSON
        return response()->json($notifications);
    }
}
