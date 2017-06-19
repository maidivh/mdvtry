<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class SessionsController extends Controller
{
    // 登录验证
    public function store(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email|max:50',
            'password'=>'required'
        ]);

        $credentials = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        // 数据库查询数据存不存在,存在则创建 Auth::user 实例

        if (Auth::attempt($credentials,$request->has('remember'))){
            
            session('success','欢迎回来！～～～～');
            return redirect()->route('users.show',[Auth::user()]);
        }else{

            session()->flash('danger','抱歉您的邮箱和密码不匹配');
            return redirect()->back();
        }

    }

    // 退出登录
    public function destroy()
    {
        Auth::logout();

        session()->flash('success','您已成功退出！');
        return redirect('login');
    }
}
