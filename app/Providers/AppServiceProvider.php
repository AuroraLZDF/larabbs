<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
	{
		\App\Models\Bbs\User::observe(\App\Observers\UserObserver::class);
		\App\Models\Bbs\Topic::observe(\App\Observers\TopicObserver::class);
		\App\Models\Bbs\Reply::observe(\App\Observers\ReplyObserver::class);
        \App\Models\Bbs\Link::observe(\App\Observers\LinkObserver::class);

        // Carbon 中文化配置
        \Carbon\Carbon::setLocale('zh');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Laravel-ide-helper
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\VIACreative\SudoSu\ServiceProvider::class);
        }
    }
}
