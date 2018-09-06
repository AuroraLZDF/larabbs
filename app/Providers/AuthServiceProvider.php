<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Bbs\Reply::class => \App\Policies\Bbs\ReplyPolicy::class,
        \App\Models\Bbs\Topic::class => \App\Policies\Bbs\TopicPolicy::class,
        \App\Models\Bbs\User::class => \App\Policies\Bbs\UserPolicy::class,
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
