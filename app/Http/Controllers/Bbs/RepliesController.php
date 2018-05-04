<?php

namespace App\Http\Controllers\Bbs;

use App\Models\Bbs\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Bbs\BaseController as Controller;
use App\Http\Requests\ReplyRequest;

class RepliesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.bbs');
    }

	public function store(ReplyRequest $request, Reply $reply)
	{
        $reply->content = $request->body;
        $reply->user_id = self::auth()->id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

        return redirect()->to($reply->topic->link())->with('success', '创建成功！');
	}

	public function destroy(Reply $reply)
	{
        //                                  回复的作者                                   回复话题的作者
        if (false === $this->authCheck($reply->user) && false === $this->authCheck($reply->topic->user)) {
            $this->show_message();
        }

        $reply->delete();

        return redirect()->to($reply->topic->link())->with('success', '成功删除回复！');
	}
}