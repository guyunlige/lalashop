<?php

namespace App;

class Comment extends BaseModel
{
    // 评论所属文章
    public function post(){
        //模型关联，反向关联
        //  return $this->belongsTo('App\User','user_id','id');
        return $this->belongsTo('App\Post');
    }

    // 评论所属用户 1 对多
    public function user(){
        return $this->belongsTo('App\User');
    }

}
