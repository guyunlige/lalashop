<?php

namespace App;

use \App\BaseModel;

class Post extends BaseModel
{
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
     return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }

    // 文章与赞需要关联,一篇文章只能有一个赞，1 对 1的关系
    public function zan($user_id){
        // 和用户进行关联
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }

    // 一篇文章可以有多个赞
    public function zans(){
        return $this->hasMany(\App\Zan::class);
    }


}
