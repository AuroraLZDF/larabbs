<?php

namespace App\Models\Bbs;

class Reply extends Model
{
    protected $fillable = ['user_id', 'topic_id', 'content'];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getLists(Reply $reply, $params)
    {
        $page = isset($params['page']) && $params['page'] ? $params['page'] : 1;

        $model = $reply;

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

        if (isset($params['title']) && $params['title']) {
            $topic = Topic::where('title', $params['title'])->first();
            if ($topic) {
                $topic_id = $topic->id;
                $model = $model->where('topic_id', $topic_id);
            }
        }

        return $model->paginate(10, ['*'], 'page', $page);
    }
}
