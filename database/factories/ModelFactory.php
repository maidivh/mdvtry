<?php


$factory->define(App\Model\User::class, function (Faker\Generator $faker) {
    $date_time = $faker->date . ' ' . $faker->time;

    /**
     * 因为在用户模型中把 Pssword 和 remember_token 字段给隐藏起来了,所以 ORM 形成的 sql 语句中是不包含 password 字段的
     * 所以 这个2个字段的值是空的
     */
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' =>'000000',
        'is_admin' =>false,
        'remember_token' => str_random(10),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});


// $faker->data; // 随机生成日期  2010-02-10
// $faker->time;  // 随机生成时间