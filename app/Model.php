<?php
// 公共封装model
namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    // 表 ==> posts  使用：Post::create()
    protected $guarded = [];// 数组，不可以注入的数据字段
    protected $fillable = []; // 数组，可以注入的数据字段
}
