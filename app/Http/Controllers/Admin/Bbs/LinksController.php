<?php

namespace App\Http\Controllers\Admin\Bbs;

use App\Models\Bbs\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class LinksController extends Controller
{
    public function index(Link $link)
    {
        $data = $link->getAllCached();

        //\Cache::delete($key);
        return view('admin.bbs.setting.links.index', compact('data'));
    }

    public function create()
    {
        return view('admin.bbs.setting.links.create_and_edit');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data = [
            'title' => $data['title'],
            'link' => $data['link'],
        ];

        if (Link::create($data)) {
            return $this->returnJson(1, route('admin.bbs.links.index'), '添加外链成功！');
        }

        return $this->returnJson(2, '', '添加外链失败！');
    }

    public function edit(Link $link)
    {
        return view('admin.bbs.setting.links.create_and_edit', compact('link'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $data = [
            'title' => $data['title'],
            'link' => $data['link'],
        ];

        if (Link::where('id', $id)->update($data)) {
            return $this->returnJson(1, route('admin.bbs.links.index'), '修改外链成功！');
        }

        return $this->returnJson(2, '', '修改外链失败！');
    }

    public function destroy($id)
    {
        if (Link::where('id', $id)->delete()) {
            return $this->returnJson(1, route('admin.bbs.links.index'), '删除外链成功！');
        }

        return $this->returnJson(1, route('admin.bbs.links.index'), '删除外链失败！');
    }
}
