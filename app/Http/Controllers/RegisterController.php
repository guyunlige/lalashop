<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    // 注册
    public function index()
    {
        return view('register.index');
    }

    // 注册逻辑
    public function register()
    {
        $this->validate(request(), [
            'name' => 'required|min:3|unique:users,name',//unique:users,name唯一性，用户名不重复
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:5|max:10|confirmed',// confirmed,重复密码验证
        ]);

        $name = request('name');
        $email = request('email');
        $password = bcrypt(request('password'));

        User::create(compact('name','email','password'));

        return redirect('login');
    }
}
