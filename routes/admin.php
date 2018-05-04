<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * 后台
 */

// 登录、登出
Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

/*// 注册
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
Route::post('register', 'Auth\RegisterController@register');

// 重置密码
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');*/


Route::group(['middleware' => ['auth.admin']], function () {
    // Admin
    Route::get('/', 'HomeController@index')->name('admin.root');

    Route::resource('users', 'UsersController', ['only' => ['index', 'update', 'edit', 'destroy', 'create', 'store']])
        ->names([
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy'
        ]);

    Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'update', 'edit', 'create', 'store'/*, 'destroy'*/]])
    ->names([
        'index' => 'admin.permissions.index',
        'create' => 'admin.permissions.create',
        'store' => 'admin.permissions.store',
        'edit' => 'admin.permissions.edit',
        'update' => 'admin.permissions.update',
        //'destroy' => 'admin.permissions.destroy'
    ]);

    Route::resource('roles', 'RolesController', ['only' => ['index', 'update', 'edit', 'create', 'store'/*, 'destroy'*/]])
        ->names([
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'edit' => 'admin.roles.edit',
            'update' => 'admin.roles.update',
            //'destroy' => 'admin.roles.destroy'
        ]);


    // BBS
    Route::group(['prefix' => 'bbs', 'namespace' => 'Bbs'], function () {
        // 会员管理
        Route::resource('users', 'UsersController', ['only' => ['index', 'update', 'edit', 'destroy']])
            ->names([
                'index' => 'admin.bbs.users.index',
                'edit' => 'admin.bbs.users.edit',
                'update' => 'admin.bbs.users.update',
                'destroy' => 'admin.bbs.users.destroy'
            ]);
        Route::post('upload_avatar', 'UsersController@uploadImage')->name('admin.upload_avatar');
        // 话题管理
        Route::resource('topics', 'TopicsController', ['only' => ['index', 'update', 'edit', 'destroy']])
            ->names([
                'index' => 'admin.bbs.topics.index',
                'edit' => 'admin.bbs.topics.edit',
                'update' => 'admin.bbs.topics.update',
                'destroy' => 'admin.bbs.topics.destroy'
            ]);
        // 分类管理
        Route::resource('categories', 'CategoriesController', ['except' => ['show']])
            ->names([
                'index' => 'admin.bbs.categories.index',
                'create' => 'admin.bbs.categories.create',
                'store' => 'admin.bbs.categories.store',
                'edit' => 'admin.bbs.categories.edit',
                'update' => 'admin.bbs.categories.update',
                'destroy' => 'admin.bbs.categories.destroy'
            ]);
        // 分类管理
        Route::resource('replies', 'RepliesController', ['except' => ['show']])
            ->names([
                'index' => 'admin.bbs.replies.index',
                'create' => 'admin.bbs.replies.create',
                'store' => 'admin.bbs.replies.store',
                'edit' => 'admin.bbs.replies.edit',
                'update' => 'admin.bbs.replies.update',
                'destroy' => 'admin.bbs.replies.destroy'
            ]);
        // 站点设置
        Route::match(['get', 'post'], 'site', 'SiteSettingController@index')->name('admin.bbs.site');
        // 外链管理
        Route::resource('links', 'LinksController', ['except' => ['show']])
            ->names([
                'index' => 'admin.bbs.links.index',
                'create' => 'admin.bbs.links.create',
                'store' => 'admin.bbs.links.store',
                'edit' => 'admin.bbs.links.edit',
                'update' => 'admin.bbs.links.update',
                'destroy' => 'admin.bbs.links.destroy'
            ]);
    });

    // API
    Route::group(['prefix' => 'api'], function () {
        Route::group(['namespace' => 'Bbs\Api'], function () {
            Route::match(['get', 'post'], '/bbs/user_lists', 'UsersController@getUserLists')->name('admin.api_bbs_user_lists');
            Route::match(['get', 'post'], '/bbs/topic_lists', 'TopicsController@getTopicLists')->name('admin.api_bbs_topic_lists');
        });
    });
});
