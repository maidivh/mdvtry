<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    // 家在注册页面
    public function create()
    {
        return view('users.create');
    }

    // 显示用户信息页面
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show',compact('user'));
    }

    // 注册会员
    public function store(Request $request)
    {
        // 数据验证 validate() 由 App\http\Controller\Controller 类中的 ValidatesRequest 进行定义的
        $this->validate($request,[
            'name'=>'required|max:10|min:3',
            'email'=>'required|email|unique:users',
            'password'=>'required'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'password'=>$request->password, // 统一在 mode 中加密
            'email' =>$request->email
        ]);

        Auth::login($user); // 注册成功后自动登录
        session()->flash('success','欢迎来的Mdvtrw，您将在这里开启一段新的旅程～');
        // 注册成功称定向到个人页面,加载用户数据
        return redirect()->route('users.show',[$user]);
    }

    //
}
