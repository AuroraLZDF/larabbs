<?php

namespace App\Http\Controllers\Admin\Bbs;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\Bbs\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class UsersController extends Controller
{
    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, User $user)
    {
        $params = $request->all();
        $users = $user->getLists($user, $params);

        return view('admin.bbs.users.index', compact('users', 'params'));
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

        return view('admin.bbs.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        $result = User::where('id', $id)->update([
            'name' => $name,
            'password' => bcrypt($password),
            'avatar' => $request->input('avatar'),
            'email' => $request->input('email'),
            'introduction' => $request->input('introduction')
        ]);
        if (!$result) {
            return $this->returnJson(2, '', '修改用户信息失败！');
        }

        return $this->returnJson(1, route('admin.bbs.users.index'), '资料更新成功！');
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            return $this->returnJson(1, route('admin.bbs.users.index'), '删除用户成功！');
        }

        return $this->returnJson(2, '', '删除用户失败！');
    }

    /**
     * 上传图片
     * @param Request $request
     * @param ImageUploadHandler $uploader
     * @return array
     */
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'code'   => 2,
            'msg'       => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->file) {
            // 保存图片到本地
            $result = $uploader->save($request->file, 'avatars', $this->auth()->id(), 1024, config('app.admin_url'));
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['message']       = "上传成功!";
                $data['code']   = 1;
            }
        }
        return response()->json($data);
    }
}
