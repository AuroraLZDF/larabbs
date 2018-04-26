<?php

namespace App\Http\Controllers\Bbs;

use Illuminate\Http\Request;
use App\Http\Controllers\Bbs\BaseController as Controller;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.bbs');
    }

    public function index()
    {
        // 获取登录用户的所有通知
        $notifications = self::auth()->user()->notifications()->paginate(20);
        // 标记为已读，未读数量清零
        self::auth()->user()->markAsRead();
        return view('bbs.notifications.index', compact('notifications'));
    }
}
