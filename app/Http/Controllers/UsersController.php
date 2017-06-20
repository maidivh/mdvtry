<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['edit', 'update','destroy']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(30);

        return view('users.index', compact('users'));
    }

    // 用户注册页面
    public function create()
    {
        return view('users.create');
    }

    // 显示用户信息页面
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    // 注册会员
    public function store(Request $request)
    {
        // 数据验证 validate() 由 App\http\Controller\Controller 类中的 ValidatesRequest 进行定义的
        $this->validate($request, [
            'name' => 'required|max:10|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'password' => $request->password, // 统一在 mode 中加密
            'email' => $request->email
        ]);

        Auth::login($user); // 注册成功后自动登录
        session()->flash('success', '欢迎来的Mdvtrw，您将在这里开启一段新的旅程～');
        // 注册成功称定向到个人页面,加载用户数据
        return redirect()->route('users.show', [$user]);
    }

    // 用户编辑页面
    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('update',$user);
        return view('users.edit', compact('user'));
    }

    // 接受用户编辑数据，修改
    public function update($id, Request $request)
    {
        /**
         * confirmed 验证字段值必须和 foo_confirmation 的字段值一致。
         * 例如，如果要验证的字段是 password，就必须和输入数据里的 password_confirmation 的值保持一致。
         */
        $this->validate($request, [
            'name' => 'required|max:10',
            'password' => 'confirmed|min:6'
        ]);

        $user = User::findOrFail($id);
        $this->authorize('update',$user);

        $data = [];
        $data['name'] = $request->name;

        if ($request->password) {
            $data['password'] = $request->password;
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('users.show', $id);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('destroy',$user);

        $user->delete();

        session()->flash('success','删除成功！');

        return back();
    }
}
