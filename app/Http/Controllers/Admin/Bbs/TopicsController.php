<?php

namespace App\Http\Controllers\Admin\Bbs;

use App\Http\Middleware\TrustProxies;
use App\Models\Bbs\Category;
use App\Models\Bbs\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class TopicsController extends Controller
{
    /**
     * @param Request $request
     * @param Topic $topic
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, Topic $topic)
    {
        $params = $request->all();
        $topics = $topic->getLists($topic, $params);
        $categories = Category::all();

        return view('admin.bbs.topics.index', compact('topics', 'categories', 'params'));
    }

    public function edit(Topic $topic)
    {
        if (empty($topic)) {
            return $this->show_message(500, '话题不存在！');
        }
        $categories = Category::all();

        return view('admin.bbs.topics.edit', compact('topic', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!$request->has('status')) {
            return $this->show_message(500, '数据丢失！');
        }
        $status = $request->input('status');

        if (Topic::where('id', $id)->update(['status' => $status])) {
            return $this->returnJson(1, '', '审核成功！');
        }

        return $this->returnJson(2, '', '审核失败！');
    }

    public function destroy(Topic $topic)
    {
        if ($topic->delete()) {
            return $this->returnJson(1, route('admin.bbs.topics.index'), '删除用户成功！');
        }

        return $this->returnJson(2, '', '删除用户失败！');
    }
}
