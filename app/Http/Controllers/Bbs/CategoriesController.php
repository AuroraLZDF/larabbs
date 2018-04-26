<?php

namespace App\Http\Controllers\Bbs;

use App\Models\Bbs\Category;
use App\Models\Bbs\Link;
use App\Models\Bbs\Topic;
use App\Models\Bbs\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Bbs\BaseController as Controller;

class CategoriesController extends Controller
{
    public function show(Category $category, User $user, Link $link)
    {
        // 读取分类 ID 关联的话题，并按每 20 条分页
        $topics = Topic::with('category', 'user')->where('category_id', $category->id)->paginate(20);

        // 活跃用户列表
        $active_users = $user->getActiveUsers();

        // 资源链接
        $links = $link->getAllCached();

        return view('bbs.topics.index', compact('topics', 'category', 'active_users', 'links'));
    }
}
