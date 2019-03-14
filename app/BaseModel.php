<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = []; // 数组，不可以注入的数据字段；为空，是白名单
    //  protected $table = ''; // 指定表
//    protected $fillable = ['title','content']; // 数组，可以注入的数据字段
}
