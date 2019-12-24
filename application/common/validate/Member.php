<?php

namespace app\common\validate;

use think\Validate;

class Member extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'username|用户名' => 'require|unique:member',
        'password|密码' => 'require',
        'conpass|确认密码' => 'require|confirm:password',
        'nickname|昵称' => 'require',
        'email|邮箱' => 'require|email|unique:member',
        'oldpass|原密码' => 'require',
        'newpass|新密码' => 'require',
        'verify|验证码' => 'require|captcha'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */
    protected $message = [];

    //添加验证场景
    public function sceneAdd()
    {
        return $this->only(['username', 'password', 'nickname', 'email']);
    }

    //编辑验证场景
    public function sceneEdit()
    {
        return $this->only(['oldpass', 'newpass', 'nickname']);
    }
    //注册场景验证
    public function sceneRegister()
    {
        return $this->only(['username', 'password', 'conpass', 'nickname', 'email', 'verify']);
    }
    //登录场景验证
    public function sceneLogin()
    {
        return $this->only(['username', 'password', 'verify'])
            ->remove('username', 'unique');
    }
}
