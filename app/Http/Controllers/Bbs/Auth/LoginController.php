<?php

namespace App\Http\Controllers\Bbs\Auth;

use App\Fundation\AuthenticatesLogout;
use App\Http\Controllers\Bbs\BaseController as Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
        |--------------------------------------------------------------------------
        | Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles authenticating users for the application and
        | redirecting them to your home screen. The controller uses a trait
        | to conveniently provide its functionality to your applications.
        |
        */

    use AuthenticatesUsers, AuthenticatesLogout {
        AuthenticatesLogout::logout insteadof AuthenticatesUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $username;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * 重写登录视图页面
     */
    public function showLoginForm()
    {
        return view('bbs.auth.login');
    }

    /**
     * 自定义认证驱动
     */
    protected function guard()
    {
        return auth()->guard('bbs');
    }

    /**
     * 重写验证时使用的用户名字段
     */
    /*public function username()
    {
        return 'email';
    }*/
}
