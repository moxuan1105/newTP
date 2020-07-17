<?php


namespace app\validate;


use think\Validate;

class Staffs extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'work_no' => 'require|max:25', //工号
        'name' => 'require|max:25', //姓名
        'indirect_type' => 'require',
        'position' => 'require',
        'm_position' => 'require',
        'staff_type' => 'require',
        'sex' => 'require',
        'business_division' => 'require',
        'factory_division' => 'require',
        'department' => 'require',
        'class' => 'require'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
    protected $message = [
        'work_no.require' => '工号必须存在',
        'work_no.max' => '工号长度不能超过25个字符',
        'name.require' => '姓名必须存在',
        'name.max' => '名字长度不能超过25个字符',
        'indirect_type.require' => '间直接类型',
        'position.require' => '资位必须存在',
        'm_position.require' => '管理职必须存在',
        'staff_type.require' => '用工类型必须存在',
        'sex.require' => '性别必须存在',
        'business_division.require' => '事业处必须存在',
        'factory_division.require' => '厂处必须存在',
        'department.require' => '部门必须存在',
        'class.require' => '课必须存在'
    ];
}