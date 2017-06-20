<?php

use Illuminate\Database\Seeder;
use App\Model\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * times() 生成假数据的模型数量,
         * make()  将为模型创建一个几集合；
         */
        $users = factory(User::class)->times(100)->make();

        User::insert($users->toArray());

        $user = User::find(1);
        $user->name = 'Aufree';
        $user->email = '905530550@qq.com';
        $user->password = '000000';
        $user->is_admin = true;
        $user->save();

    }
}
