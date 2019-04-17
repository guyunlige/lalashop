<?php

namespace App;

use App\BaseModel;
use Laravel\Scout\Searchable;

class Post extends BaseModel
{
    use Searchable;
//    protected $table = 'posts';
//    protected $fileable = ['title', 'content'];

    //protected $guarded=[]; //不可以注入的字段

    //定义索引里面的type
    public function searchableAs()
    {
        return 'post'; // 索引，可以随便改，尤其是手动修改数据库后
    }

    //定义有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    // 关联用户
    public function user()
    {
        //模型关联，反向关联
//        return $this->belongsTo('App\User','user_id','id');
        return $this->belongsTo('App\User');
    }

    // 评论模型
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    // 文章与赞需要关联,一篇文章只能有一个赞，1 对 1的关系
    public function zan($user_id)
    {
        // 和用户进行关联
        return $this->hasOne(\App\Zan::class)->where('user_id', $user_id);
    }

    // 一篇文章可以有多个赞
    public function zans()
    {
        return $this->hasMany(\App\Zan::class);
    }


}
