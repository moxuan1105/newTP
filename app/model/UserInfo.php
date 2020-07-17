<?php


namespace app\model;

use app\model\User;
use think\Model;

class UserInfo extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}