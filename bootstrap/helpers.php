<?php

/**
 * 数据库切换,根据环境不同,使用不同的数据库
 *
 * 首先在设置里面设置一下 heroku config:set IS_IN_HEROKU=true 这个是heroku环境
 *
 * 新增 helpers.php 文件之后，还需要在应用中对该文件进行配置,自动加载该文件 在bootrstrap/autoload.php中加载
 *
 * 在config/database.php 中对数据库进行配置
 */

function get_db_config()
{   // getenv 获取系统环境变量的值和$_SERVER基本一样
    if (getenv('IS_IN_HEROKU')) {
        // parse_url 解析url
        // DATABASE_URL 这个是 heroku 上面PostgreSQL数据库的地址;可以输入 heroku config命令查看 里面所有定义的配置文件
        $url = parse_url(getenv("DATABASE_URL"));

        return $db_config = [
            'connetion' => 'pgsql',
            'host' => $url['host'],
            'database' => substr($url['path'], 1),
            'username' => $url['user'],
            'password' => $url['pass']
        ];
    } else {
        // mysql 数据库
        return $db_config = [
            'connetion' => env('DB_CONNETION', 'mysql'),
            'host' => env('DB_HOST', 'localhost'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
        ];
    }
}