<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    // 用户的文章列表
    public function posts()
    {
        return $this->hasMany(\App\User::class, 'user_id', 'id');
    }

    // 关注我的fan模型
    public function fans()
    {
        return $this->hasMany(\App\User::class, 'star_id', 'id');
    }

    // 我关注的fan模型
    public function stars()
    {
        return $this->hasMany(\App\User::class, 'fan_id', 'id');
    }

    // 我要关注某个人
    public function doFan($uid)
    {
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->save($fan);
    }

    // 取消关注
    public function dounFan($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        return $this->stars()->delete($fan);
    }

    // 当前用户，是否有这个粉丝(被这个用户关注了)
    public function hasFan($uid){
        return $this->fans()->where('fan_id',$uid)->count();
    }

    // 当前用户，是否关注了uid
    public function hasStar($uid){
        return $this->fans()->where('star_id',$uid)->count();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
