<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    // 登录界面
    public function create()
    {
        return view('sessions.create');
    }

    // 登录验证
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:50',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // 数据库查询数据存不存在,存在则创建 Auth::user 实例

        if (Auth::attempt($credentials, $request->has('remember'))) {

            session()->flash('success', '欢迎回来！～～～～');

            // 友好转向,重定向之前访问的页面

            return redirect()->intended(route('users.show', [Auth::user()]));
        } else {

            session()->flash('danger', '抱歉您的邮箱和密码不匹配');
            return redirect()->back();
        }

    }

    // 退出登录
    public function destroy()
    {
        Auth::logout();

        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
