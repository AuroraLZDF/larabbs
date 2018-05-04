<?php

use App\Models\Bbs\User;
use Illuminate\Database\Seeder;

class BbsUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        //$faker = app(Faker\Generator::class);
        $faker = Faker\Factory::create('zh_CN');

        // 头像假数据
        $avatars = [
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200',
            'https://fsdhubcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png?imageView2/1/w/200/h/200',
        ];

        // 生成数据集合
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        /*// 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'aurora';
        $user->email = '18862324237@163.com';
        $user->avatar = 'http://local.bbs.aurora.com/uploads/images/avatars/2018/03/27/1_1522143423_5oBjXCVE7x.png?imageView2/1/w/200/h/200';
        $user->save();

        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');


        $user = User::find(2);
        $user->name = 'gaozhen';
        $user->email = '786532832@qq.com';
        $user->avatar = 'http://local.bbs.aurora.com/uploads/images/avatars/2018/03/27/1_1522143423_5oBjXCVE7x.png?imageView2/1/w/200/h/200';
        $user->save();

        // 将 2 号用户指派为『管理员』
        $user->assignRole('Maintainer');*/
    }
}
