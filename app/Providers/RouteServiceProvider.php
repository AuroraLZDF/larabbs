<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $namespace_www = 'App\Http\Controllers\Www';
    protected $namespace_bbs = 'App\Http\Controllers\Bbs';
    protected $namespace_admin = 'App\Http\Controllers\Admin';
    protected $namespace_api = 'App\Http\Controllers\Api';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapBbsRoutes();

        $this->mapAdminRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->domain(domain(config('app.url')))
            ->namespace($this->namespace_www)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            //->namespace($this->namespace_api)
            ->group(base_path('routes/api.php'));
    }

    /**
     * 论坛
     */
    protected function mapBbsRoutes()
    {
        Route::middleware('web')
            ->domain(domain(config('app.bbs_url')))
            ->namespace($this->namespace_bbs)
            ->group(base_path('routes/bbs.php'));
    }

    /**
     * 后台
     */
    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->domain(domain(config('app.admin_url')))
            ->namespace($this->namespace_admin)
            ->group(base_path('routes/admin.php'));
    }
}
