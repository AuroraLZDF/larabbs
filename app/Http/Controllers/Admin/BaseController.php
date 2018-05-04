<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    /**
     * 返回指定 guard 的 auth
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public static function auth()
    {
        return auth('admin');
    }

    /**
     * 判断当前登录用户与比较用户身份是否一致
     * @param User $user
     * @return bool
     */
    public static function authCheck(User $user)
    {
        return self::auth()->id() === $user->id ? true : false;
    }

    /**
     * 判断当前登录用户与比较用户身份是否一致，
     * 不一致返回提示信息
     * @param User $user
     * @return bool
     */
    public function authRedirect(User $user)
    {
        // 无权访问，暂时跳转首页
        if (false === self::authCheck($user)) {
            $this->show_message(500, '对不起，您没有访问权限！');
        }

        return true;
    }

    /**
     * 多用户登录，默认 策略模式 失效，
     * 判断用户是否有某类身份权限
     * @param User $user
     * @param $power
     * @return bool
     */
    public static function permissions(User $user, $power)
    {
        if ($user->can($power)) {
            return true;
        }
        return false;
    }

    /**
     * 404、500页面
     * @param $code
     * @param $message
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_message($code = 404, $message = '')
    {
        return view('admin.common.error_' . $code, compact('message'));
    }

    /**
     * 返回 json 信息
     * @param $code
     * @param string $url
     * @param string $message
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function returnJson($code = 2, $url = '', $message = '', $data = [])
    {
        return response()->json([
            'code' => $code,
            'url' => $url,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
