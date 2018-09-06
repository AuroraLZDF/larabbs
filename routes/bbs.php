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
 * 论坛
 */

// 登录、登出
Route::get('login', 'Auth\LoginController@showLoginForm')->name('bbs.login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('bbs.logout');

// 注册
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('bbs.register');
Route::post('register', 'Auth\RegisterController@register');

// 重置密码
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('bbs.password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('bbs.password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('bbs.password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


// 首页
Route::get('/', 'TopicsController@index')->name('bbs.root');

// 用户中心
//Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
Route::get('/users/{user}', 'UsersController@show')->name('bbs.users.show');
Route::get('/users/{user}/edit', 'UsersController@edit')->name('bbs.users.edit');
Route::post('/users/{user}', 'UsersController@update')->name('bbs.users.update');
Route::post('/upload_avatar', 'UsersController@uploadAvatar')->name('bbs.users.upload_avatar');

// 文章
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']])
    ->names([
    'index' => 'bbs.topics.index',
    'create' => 'bbs.topics.create',
    'store' => 'bbs.topics.store',
    'edit' => 'bbs.topics.edit',
    'update' => 'bbs.topics.update',
    'destroy' => 'bbs.topics.destroy'
]);
Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('bbs.topics.show');

// 分类
Route::resource('categories', 'CategoriesController', ['only' => ['show']])
    ->names([
    'show' => 'bbs.categories.show'
]);

// 上传图片
Route::post('upload_image', 'TopicsController@uploadImage')->name('bbs.topics.upload_image');

// 回复
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']])
    ->names([
        'store' => 'bbs.replies.store',
        'destroy' => 'bbs.replies.destroy'
    ]);

// 通知
Route::resource('notifications', 'NotificationsController', ['only' => ['index']])
    ->names([
        'index' => 'bbs.notifications.index'
    ]);

// 后台禁止访问权限控制
Route::get('permission-denied', 'PagesController@permissionDenied')->name('bbs.permission-denied');

//
Route::get('usersJson','UsersController@usersJson')->name('bbs.users_json');

// common error
Route::get('/error', 'PagesController@error')->name('bbs.error');
