<?php

namespace App\Http\Controllers\Bbs;

use App\Handlers\ImageUploadHandler;
use App\Models\Bbs\Category;
use App\Models\Bbs\Link;
use App\Models\Bbs\Topic;
use App\Models\Bbs\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Bbs\BaseController as Controller;
use App\Http\Requests\TopicRequest;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.bbs', ['except' => ['index', 'show']]);
    }

    public function index(Request $request, Topic $topic, User $user, Link $link)
    {
        $topics = $topic->withOrder($request->order)->where('status', Topic::STATUS_ON)->paginate(20);
        $active_users = $user->getActiveUsers();
        $links = $link->getAllCached();

        return view('bbs.topics.index', compact('topics', 'category', 'active_users', 'links'));
    }

    public function show(Request $request, Topic $topic)
    {
        // URL 矫正
        if (!empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        return view('bbs.topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        $categories = Category::all();
        return view('bbs.topics.create_and_edit', compact('topic', 'categories'));
    }

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = $this->auth()->id();
        $topic->save();

        return redirect()->to($topic->link())->with('message', '成功创建话题！');
    }

    public function edit(Topic $topic)
    {
        $this->authRedirect($topic->user);
        $categories = Category::all();
        return view('bbs.topics.create_and_edit', compact('topic', 'categories'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authRedirect($topic->user);
        $topic->update($request->all());

        return redirect()->to($topic->link())->with('message', '成功更新话题！');
    }

    public function destroy(Topic $topic)
    {
        $this->authRedirect($topic->user);
        $topic->delete();

        return redirect()->route('bbs.topics.index')->with('message', '成功删除话题！');
    }

    /**
     * 上传图片
     * @param Request $request
     * @param ImageUploadHandler $uploader
     * @return array
     */
    public function uploadImage(Request $request, ImageUploadHandler $uploader)
    {
        // 初始化返回数据，默认是失败的
        $data = [
            'success' => false,
            'msg' => '上传失败!',
            'file_path' => ''
        ];
        // 判断是否有上传文件，并赋值给 $file
        if ($file = $request->upload_file) {
            // 保存图片到本地
            $result = $uploader->save($request->upload_file, 'topics', $this->auth()->id(), 1024, config('app.bbs_url'));
            // 图片保存成功的话
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg'] = "上传成功!";
                $data['success'] = true;
            }
        }
        return $data;
    }
}