<?php

namespace App\Http\Middleware;

use Closure;

class testmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$arr,$post)
    {
        /**
         * 例如：只允许 email 为905530550 登录
         */
        if ($request->input('email') == '905530550@qq.com'){

            return redirect('/');
        }

        return $next($request);
    }
}
