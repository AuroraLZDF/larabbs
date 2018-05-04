<?php

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedAdminUserAndPermissionData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 添加后台超级管理员

        $data = [
            [
                'name' => 'aurora',
                'email' => '18862324237@163.com',
                'password' => bcrypt('gaozhen123'),
                'remember_token' => str_random(10)
            ],
            [
                'name' => 'bbsAdmin',
                'email' => 'admin@bbs.com',
                'password' => bcrypt('gzCyj123'),
                'remember_token' => str_random(10)
            ]
        ];
        DB::connection('admin')->table('users')->insert($data);

        // aurora 赋予 OA 全局最高权限
        $user = User::where('name', 'aurora')
            ->where('email', '18862324237@163.com')->first();
        $user->assignRole('Founder');

        // bbsAdmin 赋予 BBS 模块最高权限
        $user = User::where('name', 'bbsAdmin')
            ->where('email', 'admin@bbs.com')->first();
        $user->assignRole('Maintainer');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Model::unguard();
        DB::connection('admin')->table('users')->delete();
        DB::connection('www')->table('model_has_roles')->delete();
        Model::reguard();
    }
}
