<?php

namespace App\Models\Bbs;

use DB;

class Topic extends Model
{
    const STATUS_ON = 1;
    const STATUS_OFF = 2;

    public static $status = [
        self::STATUS_ON => '开启',
        self::STATUS_OFF => '关闭',
    ];

    protected $table = 'topics';

    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query = $this->recent();
                break;

            default:
                $query = $this->recentReplied();
                break;
        }
        // 预加载防止 N+1 问题
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function link($params = [])
    {
        return route('bbs.topics.show', array_merge([$this->id, $this->slug], $params));
    }

    public function getLists(Topic $topic, $params)
    {
        $page = isset($params['page']) && $params['page'] ? $params['page'] : 1;
        $limit = isset($params['limit']) && $params['limit'] ? $params['limit'] : 10;

        $model = $topic;

        if (isset($params['id']) && $params['id']) {
            $model = $model->where('id', $params['id']);
        }

        if (isset($params['name']) && $params['name']) {
            $user = User::where('name', $params['name'])->first();
            if ($user) {
                $user_id = $user->id;
                $model = $model->where('user_id', $user_id);
            }
        }

        if (isset($params['category']) && $params['category']) {
            $model = $model->where('category_id', $params['category']);
        }

        return $model->paginate($limit, ['*'], 'page', $page);
    }
}
