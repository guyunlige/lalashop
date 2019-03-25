<?php

namespace App;

use \App\BaseModel;

class Post extends BaseModel
{
    // 关联用户
    public function user(){
        //模型关联，反向关联
//        return $this->belongsTo('App\User','user_id','id');
        return $this->belongsTo('App\User');
    }
}
