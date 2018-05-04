<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class RolesController extends Controller
{
    public function index(Request $request, Role $role)
    {
        $roles = $role->paginate(10);

        return view('admin.home.roles.index', compact('roles'));
    }

    public function create(Role $role)
    {
        return view('admin.home.roles.create_and_edit', compact('role'));
    }

    public function store(Request $request, Role $role)
    {
        $role->fill($request->all());
        $role->save();

        return $this->returnJson(1, route('admin.roles.index'), '成功角色权限！');
    }

    public function edit(Role $role)
    {
        if (empty($role)) {
            return $this->show_message(500, '角色 ID 不存在！');
        }

        return view('admin.home.roles.create_and_edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->input('name'),
            'guard_name' => $request->input('guard_name')
        ];

        $result = Role::where('id', $id)->update($data);
        if (!$result) {
            return $this->returnJson(2, '', '修改角色信息失败！');
        }

        return $this->returnJson(1, route('admin.roles.index'), '角色更新成功！');
    }
}
