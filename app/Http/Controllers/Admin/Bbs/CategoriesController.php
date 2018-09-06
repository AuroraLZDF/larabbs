<?php

namespace App\Http\Controllers\Admin\Bbs;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Models\Bbs\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request, Category $category)
    {
        $params = $request->all();
        $categories = $category->getLists($category, $params);

        return view('admin.bbs.categories.index', compact('categories', 'params'));
    }

    public function create()
    {
        return view('admin.bbs.categories.create_and_edit');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (!$data['name'] || !$data['description']) {
            return $this->returnJson(2, '', '缺少参数！');
        }

        $result = Category::create([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        if (!$result) {
            return $this->returnJson(2, '', '添加分类失败！');
        }

        return $this->returnJson(1, route('admin.bbs.categories.index'), '添加分类成功！');
    }

    public function edit(Category $category)
    {
        return view('admin.bbs.categories.create_and_edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        if (!$data['name'] || !$data['description']) {
            return $this->returnJson(2, '', '缺少参数！');
        }

        $result = Category::where('id', $id)->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);
        if (!$result) {
            return $this->returnJson(2, '', '修改分类信息失败！');
        }

        return $this->returnJson(1, route('admin.bbs.categories.index'), '分类更新成功！');
    }

    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return $this->returnJson(1, route('admin.bbs.categories.index'), '删除分类成功！');
        }

        return $this->returnJson(2, '', '删除分类失败！');
    }
}
