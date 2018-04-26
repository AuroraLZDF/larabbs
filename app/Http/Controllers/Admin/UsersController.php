<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class UsersController extends Controller
{
    public function index(Request $request, User $user)
    {
        $users = $user->paginate(10);

        return view('admin.home.users.index', compact('users', 'params'));
    }

    public function create(User $user)
    {
        return view('admin.home.users.create_and_edit', compact('user'));
    }

    public function store(Request $request, User $user)
    {
        $user->fill($request->all());
        $user->save();

        return $this->returnJson(1, route('admin.users.index'), '成功添加管理员！');
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @internal param $id
     */
    public function edit(User $user)
    {
        if (empty($user)) {
            return $this->show_message(500, '会员 ID 不存在！');
        }

        return view('admin.home.users.create_and_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        $result = User::where('id', $id)->update([
            'name' => $name,
            'password' => bcrypt($password),
            'email' => $request->input('email'),
        ]);
        if (!$result) {
            return $this->returnJson(2, '', '修改用户信息失败！');
        }

        return $this->returnJson(1, route('admin.users.index'), '资料更新成功！');
    }

    public function destroy($id)
    {
        if (User::where('id', $id)->delete()) {
            return $this->returnJson(1, route('admin.users.index'), '删除用户成功！');
        }

        return $this->returnJson(2, '', '删除用户失败！');
    }
}
