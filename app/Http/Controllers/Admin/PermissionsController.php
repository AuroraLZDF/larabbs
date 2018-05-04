<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class PermissionsController extends Controller
{
    public function index(Request $request, Permission $permission)
    {
        $permissions = $permission->paginate(10);

        return view('admin.home.permissions.index', compact('permissions'));
    }

    public function create(Permission $permission)
    {
        return view('admin.home.permissions.create_and_edit', compact('permission'));
    }

    public function store(Request $request, Permission $permission)
    {
        $permission->fill($request->all());
        $permission->save();

        return $this->returnJson(1, route('admin.permissions.index'), '成功添加权限！');
    }

    public function edit(Permission $permission)
    {
        if (empty($permission)) {
            return $this->show_message(500, '权限 ID 不存在！');
        }

        return view('admin.home.permissions.create_and_edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name')
        ];

        $result = Permission::where('id', $id)->update($data);
        if (!$result) {
            return $this->returnJson(2, '', '修改权限信息失败！');
        }

        return $this->returnJson(1, route('admin.permissions.index'), '权限更新成功！');
    }
}
