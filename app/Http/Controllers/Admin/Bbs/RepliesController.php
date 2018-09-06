<?php

namespace App\Http\Controllers\Admin\Bbs;

use App\Models\Bbs\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class RepliesController extends Controller
{
    public function index(Request $request, Reply $reply)
    {
        $params = $request->all();

        $replies = $reply->getLists($reply, $params);

        return view('admin.bbs.replies.index', compact('replies', 'params'));
    }

    public function create()
    {
        return view('admin.bbs.replies.create_and_edit');
    }

    public function store(Request $request, Reply $reply)
    {
        $data = $request->all();
        $result = $reply::create([
            'user_id' => $data['user_id'],
            'topic_id' => $data['topic_id'],
            'content' => $data['content']
        ]);
        if (!$result) {
            return $this->returnJson(2, '', '添加评论失败！');
        }
        return $this->returnJson(1, route('admin.bbs.replies.index'), '添加评论成功！');
    }

    public function edit(Reply $reply)
    {
        return view('admin.bbs.replies.create_and_edit', compact('reply'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        if (Reply::where('id', $id)->update([
            'user_id' => $data['user_id'],
            'topic_id' => $data['topic_id'],
            'content' => $data['content']
        ])) {
            return $this->returnJson(1, route('admin.bbs.replies.index'), '修改评论成功！');
        }

        return $this->returnJson(2, '', '修改评论失败！');
    }

    public function destroy($id)
    {
        if (Reply::where('id', $id)->delete()) {
            return $this->returnJson(1, route('admin.bbs.replies.index'), '删除评论成功！');
        }

        return $this->returnJson(2, '', '删除评论失败！');
    }
}
