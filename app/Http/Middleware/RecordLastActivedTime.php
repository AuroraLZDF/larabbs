<?php

namespace App\Http\Middleware;

use App\Models\Bbs\Traits\LastActivedAtHelper;
use Auth;
use Closure;

class RecordLastActivedTime
{
    use LastActivedAtHelper;

    protected $id;
    protected $guard = 'bbs';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = Auth::guard($this->guard);
        // 如果是登录用户的话
        if ($auth->check()) {
            // 记录最后登录时间
            $this->recordLastActivedAt($auth->id());
        }

        return $next($request);
    }
}
