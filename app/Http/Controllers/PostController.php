<?php

namespace App\Http\Controllers;

use \App\Post;
use \App\Zan;
use \App\Comment;
use Illuminate\Support\Facades\Request;

class PostController extends Controller
{
    //列表页
    public function index()
    {
        // withCount('Comments') 获取评论数/赞，模板渲染是 {{$post->comments_count}}
        $posts = Post::orderBy('created_at', 'desc')->withCount(['comments','zans'])->paginate(3);
        return view('post/index', compact('posts'));
    }

    //详情页
    public function show(Post $post)
    {
        $post->load('comments');// 渲染模板前加载模型，在模板中不要操作
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
        $params = array_merge(request(['title', 'content']), compact('user_id'));
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
        $this->authorize('update', $post);

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
        // TODO 3，策略判断
        $this->authorize('delete', $post);

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

    // 提交评论
    public function comment(Post $post)
    {
        $this->validate(
            request(),
            [
                'content' => 'required|string|min:3',
            ]
        );

        // 逻辑 文章的保存一个评论
        $user_id = \Auth::id();
        if (!$user_id) {
            return redirect('/posts');
        }
        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->content = \request('content');
        $post->comments()->save($comment);

        return back();
    }

    // 点赞
    public function zan(Post $post)
    {
        $user_id = \Auth::id();
        if (!$user_id) {
            return redirect('/posts');
        }
        $param = [
            'user_id' => $user_id, // 登录的当前用户，才能点赞
            'post_id' => $post->id,

        ];

        // firstOrCreate ==> 如果用的话，查找出来；没有的话，创建
        Zan::firstOrCreate($param);
        return back();// 回退上一个页面
    }

    // 取消点赞
    public function unzan(Post $post)
    {
        // 文章与赞需要关联
        $post->zan(\Auth::id())->delete();
        return back();// 回退上一个页面
    }
}
