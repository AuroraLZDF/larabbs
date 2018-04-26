<?php

namespace App\Models\Bbs;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    /**
     * 数据库链接
     * @var string
     */
    protected $connection = 'bbs';


    public function scopeRecent($query)
    {
        return $query->orderBy('id', 'desc');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'desc');
    }

}
