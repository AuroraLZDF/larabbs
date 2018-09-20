<?php

if (!function_exists('log_message')) {
    /**
     * 记录日志到执行文件中
     * @param $type
     * @param $content
     * @param string $fileName
     */
    function log_message($type, $content, $fileName = '')
    {
        $dir = storage_path() . '/logs/';
        $file = empty($fileName)
            ? $dir . date('Ymd') . '.log'
            : $dir . $fileName . '.log';

        if (is_array($content) || is_object($content)) {
            $content = json_encode($content);
        }

        $content = "[$type] " . date('Y-m-d H:i:s') . ' :\r\n' . $content . '\r\n';
        file_put_contents($file, $content, FILE_APPEND);
    }
}

if (!function_exists('sql')) {
    /**
     * 打印执行 SQL 到文件
     */
    function sql()
    {
        $start = '============ URL: ' . request()->fullUrl() . ' ===============';
        log_message('MYSQL', $start, 'laravel-sql');

        DB::listen(function (\Illuminate\Database\Events\QueryExecuted $query) {
            $sqlWithPlaceholders = str_replace(['%', '?'], ['%%', '%s'], $query->sql);
            $bindings = $query->connection->prepareBindings($query->bindings);
            $pdo = $query->connection->getPdo();
            $data = vsprintf($sqlWithPlaceholders, array_map([$pdo, 'quote'], $bindings));

            log_message('MYSQL', $data, 'laravel-sql');
        });
    }
}

if (!function_exists('route_class')) {
    /**
     * 返回当前路由名称
     * @return mixed
     */
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }
}

if (!function_exists('domain')) {
    /**
     * 返回 URL 域名
     * @param string $url
     * @return mixed
     */
    function domain($url = '')
    {
        if ($url) {
            return parse_url($url, PHP_URL_HOST);
        }
        return $_SERVER['HTTP_HOST'];
    }
}

if (!function_exists('microtime_float')) {
    /**
     * 返回微妙数
     * @return float
     */
    function microtime_float()
    {
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }
}

if (!function_exists('web_header')) {
    function web_header($url)
    {
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $url");
        exit();
    }
}

if (!function_exists('make_excerpt')) {
    function make_excerpt($value, $length = 200)
    {
        $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
        return str_limit($excerpt, $length);
    }
}

function model_admin_link($title, $model)
{
    return model_link($title, $model, 'admin');
}

function model_link($title, $model, $prefix = '')
{
    // 获取数据模型的复数蛇形命名
    $model_name = model_plural_name($model);

    // 初始化前缀
    $prefix = $prefix ? "/$prefix/" : '/';

    // 使用站点 URL 拼接全量 URL
    $url = config('app.bbs_url') . $prefix . $model_name . '/' . $model->id;

    // 拼接 HTML A 标签，并返回
    return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
}

function model_plural_name($model)
{
    // 从实体中获取完整类名，例如：App\Models\User
    $full_class_name = get_class($model);

    // 获取基础类名，例如：传参 `App\Models\User` 会得到 `User`
    $class_name = class_basename($full_class_name);

    // 蛇形命名，例如：传参 `User`  会得到 `user`, `FooBar` 会得到 `foo_bar`
    $snake_case_name = snake_case($class_name);

    // 获取子串的复数形式，例如：传参 `user` 会得到 `users`
    return str_plural($snake_case_name);
}

if (!function_exists('setting')) {
    function setting($key, $default = '', $setting_name = 'site')
    {
        if (!config()->get($setting_name)) {
            // Decode the settings to an associative array.
            $site_settings = json_decode(file_get_contents(storage_path("/administrator_settings/$setting_name.json")), true);
            // Add the site settings to the application configuration
            config()->set($setting_name, $site_settings);
        }

        // Access a setting, supplying a default value
        return config()->get($setting_name . '.' . $key, $default);
    }
}

if (!function_exists('currentUri')) {
    /**
     * 获取当前路由 uri
     * @return string
     */
    function currentUri()
    {
        return Route::current()->uri();
    }
}

if (!function_exists('currentPrefix')) {
    /**
     * 获取当前路由 prefix
     * @return mixed
     */
    function currentPrefix()
    {
        return Route::current()->action['prefix'];
    }
}

if (!function_exists('permissions')) {
    /**
     * 管理员权限判断
     * @param \App\Models\Admin\User $user
     * @param string $power
     * @return bool
     */
    function permissions(App\Models\Admin\User $user, string $power)
    {
        return App\Http\Controllers\Admin\BaseController::permissions($user, $power);
    }
}

if (!function_exists('pass_days')) {
    /**
     * 获取几天前的时间
     * @param $pass_day
     * @return false|string
     */
    function pass_days($pass_day)
    {
        $time = time();
        if ($pass_day && is_int($pass_day)) {
            $time = strtotime("-$pass_day day");
        }

        return date('Y-m-d H:i:s', $time);
    }
}

if (!function_exists('dda')) {
    /**
     * dd() -> dda()
     * @param $model
     */
    function dda($model)
    {
        if (method_exists($model, 'toArray')) {
            dd($model->toArray());
        } else {
            dd($model);
        }
    }
}