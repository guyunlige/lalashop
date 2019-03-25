<?php

namespace App\Http\Controllers;

use \App\Post;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    //列表页
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(3);
        return view('post/index', compact('posts'));
    }

    //详情页
    public function show(Post $post)
    {
        return view('post/show', compact('post'));
    }

    // 创建文章--页面
    public function create()
    {
        return view('post/create');
    }

    // 创建文章--逻辑
    public function store()
    {
        // 验证  E:\wamp64\www\myframework\lalashop\resources\lang\ch\validation.php
        $this->validate(
            request(),
            [
                'title' => 'required|string|max:100|min:5',
                'content' => 'required|string|min:10',
            ]
        );

        // 逻辑
        $user_id = \Auth::id();
        $params = array_merge(request(['title', 'content']),compact('user_id'));
        Post::create($params);

        // 渲染
        return redirect('/posts');
    }

    //编辑--页面
    public function edit(Post $post)
    {
        return view('post/edit', compact('post'));
    }

    //编辑--逻辑
    public function update(Post $post)
    {
        $this->validate(
            request(),
            [
                'title' => 'required|string|max:100|min:5',
                'content' => 'required|string|min:10',
            ]
        );

        // TODO 3，策略判断
        $this->authorize('update',$post);

        // 逻辑
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        // 渲染
        return redirect("/posts/{$post->id}");
    }

    //删除
    public function delete(Post $post)
    {
        // 3，策略判断
        $this->authorize('delete',$post);

        $post->delete();
        return redirect('/posts');
    }

    //上传图片
    public function imageUpload()
    {
        header("Content-Type: text/html; charset=utf-8");
        //  dd(request()->all());
        $request = request();
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/' . $path);
    }
}
