<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 * @mixin think\Model
 */
class User extends Model
{
    //
    protected $name = 'user';
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $autoWriteTimestamp = 'datetime';


    /**
     * 验证密码
     *
     * @param $password
     * @return bool
     */
    public function passwordVerify($password){
        $passwordHash = $this->getAttr('password');
        return password_verify($password,$passwordHash);
    }
}
