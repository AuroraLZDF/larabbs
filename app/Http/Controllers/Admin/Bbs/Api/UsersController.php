<?php

namespace App\Http\Controllers\Admin\Bbs\Api;

use App\Models\Bbs\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class UsersController extends Controller
{
    public function getUserLists(Request $request, User $user)
    {
        $params = $request->all();
        $data = $user->getLists($user, $params);

        return view('admin.bbs.dialog.user_list',  compact('data', 'params'));
        /*if (!empty($data)) {
            return $this->returnJson(1, '', '', $data);
        }
        $data->render();
        return $this->returnJson(2, '', '获取会员列表失败！');*/
    }
}
