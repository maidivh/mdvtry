<?php

namespace App\Http\Controllers;

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

}
