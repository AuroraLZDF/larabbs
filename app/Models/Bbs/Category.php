<?php

namespace App\Models\Bbs;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'description',
    ];

    public function getLists(Category $category, $params)
    {
        $page = isset($params['page']) && $params['page'] ? $params['page'] : 1;
        $model = $category;

        if (isset($params['id']) && $params['id']) {
            $model = $model->where('id', $params['id']);
        }

        if (isset($params['name']) && $params['name']) {
            $model = $model->where('name', $params['name']);
        }

        return $model->paginate(10, ['*'],'page',$page);
    }
}
