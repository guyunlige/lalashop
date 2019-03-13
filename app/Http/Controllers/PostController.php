<?php

namespace App\Http\Controllers;

use \App\Post;

class PostController extends Controller
{
    //列表页
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(1);
        return view('post/index',compact('posts'));
    }

    //详情页
    public function show(Post $post)
    {
        return view('post/show',compact('post'));
    }

    // 创建文章--页面
    public function create()
    {
        return view('post/create');
    }

    // 创建文章--逻辑
    public function store()
    {
        //验证
//        $this->validate(\request(),[
//            'title'=>'required|string|min:10',
//        ],[
//            'title.min'=>'文章标题过短'
//        ]);

        //逻辑
        $post = Post::create(request(['title','content']));

//        dd($post);
        //渲染
        return redirect('/posts');
    }

    //编辑--页面
    public function edit()
    {
        return view('post/edit');
    }

    //编辑--逻辑
    public function update()
    {

    }

    //删除
    public function delete()
    {

    }
}
