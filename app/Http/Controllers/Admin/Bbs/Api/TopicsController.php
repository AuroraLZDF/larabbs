<?php

namespace App\Http\Controllers\Admin\Bbs\Api;

use App\Models\Bbs\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as Controller;

class TopicsController extends Controller
{
    public function getTopicLists(Request $request, Topic $topic)
    {
        $params = $request->all();
        $data = $topic->getLists($topic, $params);

        return view('admin.bbs.dialog.topic_list',  compact('data', 'params'));
        /*if (!empty($data)) {
            return $this->returnJson(1, '', '', $data);
        }
        $data->render();
        return $this->returnJson(2, '', '获取话题列表失败！');*/
    }
}
