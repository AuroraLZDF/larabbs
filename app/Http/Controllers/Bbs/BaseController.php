<?php

namespace App\Http\Controllers\Bbs;

use App\Models\Bbs\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        //parent::__construct();
    }

    /**
     * 返回指定 guard 的 auth
     * @return \Illuminate\Contracts\Auth\Factory|\Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
     */
    public static function auth()
    {
        return auth('bbs');
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
            $this->show_message();
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

    public function show_message()
    {
        abort('404', '无权访问！');
        //TODO...跳转
    }

    /**
     * 获取当前访问方法名称
     * @return string
     */
    public function action()
    {
        return request()->route()->getActionMethod();
    }

}
