<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //个人设置页面
    public function setting()
    {
        $user = Auth::user();
        return view('user.setting',compact('user'));
    }

    // 个人设置行为
    public function settingStore(Request $request)
    {
        $this->validate(request(),[
            'name' => 'min:3',
        ]);

        $name = request('name');
        $user = Auth::user();
        if ($name != $user->name) {
            if(User::where('name', $name)->count() > 0) {
                return back()->withErrors(array('message' => '用户名称已经被注册'));
            }
            $user->name = request('name');
        }
        if ($request->file('avatar')) {
            $path = $request->file('avatar')->storePublicly(md5(Auth::id() . time()));
            $user->avatar = "/storage/". $path;
        }

        $user->save();
        return back();

    }

    // 个人中心页面
    public function show()
    {
        return view('user.show');
    }

    public function fan()
    {
        return ;
    }
    public function unfan()
    {
        return ;
    }


}
