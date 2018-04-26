<?php

namespace App\Http\Controllers\Bbs;

use Illuminate\Http\Request;
use App\Http\Controllers\Bbs\BaseController as Controller;

class PagesController extends Controller
{
    public function root()
    {
        return view('bbs.pages.root');
    }

    public function permissionDenied()
    {
        // 如果当前用户有权限访问后台，直接跳转访问
        if (config('administrator.permission')()) {
            return redirect(url(config('administrator.uri')), 302);
        }
        // 否则使用视图
        return view('bbs.pages.permission_denied');
    }
}
