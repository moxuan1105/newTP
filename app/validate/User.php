<?php
declare (strict_types=1);

namespace app\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username' => 'require|max:25',
        'password' => 'require|max:32',
        'name' => 'require|max:25',
        'age' => 'number|between:1,120',
        'email' => 'email',
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [
        'username.require' => '用户名必须',
        'username.max' => '用户名最多不能超过25字符',
        'password.require' => '密码必须',
        'password.max' => '密码最多不能超过25字符',
        'name.require' => '名称必须',
        'name.max' => '名称最多不能超过25个字符',
        'age.number' => '年龄必须是数字',
        'age.between' => '年龄只能在1-120之间',
        'email' => '邮箱格式错误',
    ];

    // edit 验证场景定义
    public function sceneEdit()
    {
        return $this->only(['name', 'age'])
            ->append('name', 'min:5')
            ->remove('age', 'between')
            ->append('age', 'require|max:100');
    }

    /**
     * 用户登录时字段验证场景
     *
     * @return User
     */
    public function sceneLogin()
    {
        return $this->only(['username', 'password']);
    }

    /**
     * 注册时表单字段验证场景
     *
     * @return User
     */
    public function sceneRegister(){
        return $this->only(['username', 'password']);
    }
}
