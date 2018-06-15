<?php

namespace App\Http\Controllers\Bbs;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\Bbs\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Bbs\BaseController as Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.bbs', ['except' => ['show']]);

        /*$ac = $this->action();

        $ac = in_array($ac, ['show', 'edit', 'update']) ? $ac : 'error';
        call_user_func([$this, $ac], func_get_args());*/
    }

    public function show(User $user)
    {
        return view('bbs.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authRedirect($user);
        
        return view('bbs.users.edit', compact('user'));
    }

    public function update(ImageUploadHandler $uploader, UserRequest $request, User $user)
    {
        $this->authRedirect($user);

        $data = $request->all();

        $user->update($data);

        return redirect()->route('bbs.users.show', $user->id)->with('success', '个人资料更新成功！');
    }

    /**
     * 上传图片
     * @param Request $request
     * @param ImageUploadHandler $uploader
     * @return array
     */
    public function uploadAvatar(Request $request, ImageUploadHandler $uploader)
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
            $result = $uploader->save($request->file, 'avatars', $this->auth()->id(), 1024, config('app.bbs_url'));
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['message'] = "上传成功!";
                $data['code']   = 1;
            }
        }
        return response()->json($data);
    }

    public function usersJson(Request $request)
    {
        $name = $request->q;
        $users  =User::where('name','like',$name."%")->pluck('name')->toArray();
        return response()->json($users);
    }
}
