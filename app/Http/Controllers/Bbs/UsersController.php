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

        if ($request->file('avatar')) {
            $result = $uploader->save($request->file('avatar'), 'avatars', $user->id, 362, config('app.bbs_url'));
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);

        return redirect()->route('bbs.users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
