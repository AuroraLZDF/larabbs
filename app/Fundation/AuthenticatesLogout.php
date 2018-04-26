<?php

namespace App\Fundation;

use Illuminate\Http\Request;

/**
 * 只是删除掉当前 guard 所创建的 session
 *
 * Trait AuthenticatesLogout
 * @package App\Fundation
 */
trait AuthenticatesLogout
{
    public function logout(Request $request)
    {
        $this->guard()->logout();

        // $request->session()->flush();
        $request->session()->forget($this->guard()->getName());

        $request->session()->regenerate();

        return redirect('/');
    }
}