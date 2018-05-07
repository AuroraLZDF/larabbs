<?php

namespace App\Models\Bbs;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends  Authenticatable
{
    // 非继承自 Bbs Model
    protected $connection = 'bbs';
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'introduction', 'phone', 'weixin_openid', 'weixin_unionid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use Traits\ActiveUserHelper;
    use HasRoles;
    use Notifiable {
        notify as protected laravelNotify;
    }

    /**
     * 消息通知
     * @param $instance
     */
    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == auth('bbs')->id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * 同一性判断
     * @param $model
     * @return bool
     */
    public function isAuthorOf($model)
    {
        return $this->id === $model->user_id;
    }

    /**
     * 清除未读消息
     */
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }

    public function setPasswordAttribute($value)
    {
        // 如果值的长度等于 60，即认为是已经做过加密的情况
        if (strlen($value) != 60) {

            // 不等于 60，做密码加密处理
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    public function setAvatarAttribute($path)
    {
        // 如果不是 `http` 子串开头，那就是从后台上传的，需要补全 URL
        if ( ! starts_with($path, 'http')) {

            // 拼接完整的 URL
            $path = config('app.bbs_url') . "/uploads/images/avatars/$path";
        }

        $this->attributes['avatar'] = $path;
    }

    public function getLists(User $user, array $params)
    {
        $page = isset($params['page']) && $params['page'] ? $params['page'] : 1;
        $limit = isset($params['limit']) && $params['limit'] ? $params['limit'] : 10;

        $model = $user;

        if (isset($params['type']) && $params['type'] && isset($params['value']) && $params['value']) {
            $field = $params['type'] == 1 ? 'id' : 'name';
            $model = $model->where($field, $params['value']);
        }

        return $model->paginate($limit, ['*'], 'page', $page);
    }
}