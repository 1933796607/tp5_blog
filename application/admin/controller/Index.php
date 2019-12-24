<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{

    //重复登录过滤
    public function initialize()
    {

        if (session('?admin.id')) {
            $result = model('Admin')->where('id', session('admin.id'))->find();
            if ($result) {
                $this->redirect('admin/home/index');
            }
        }
    }
    //后台登录
    public function login()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password')
            ];
            $result = model('Admin')->login($data);
            if ($result == 1) {
                $this->success('登录成功！', 'admin/home/index');
            } else {
                $this->error($result);
            }
        }
        return view();
    }
    //注册
    public function register()
    {
        if (request()->isAjax()) {
            $data = [
                'username' => input('post.username'),
                'password' => input('post.password'),
                'conpass' => input('post.conpass'),
                'nickname' => input('post.nickname'),
                'email' => input('post.email')
            ];
            $result = model('Admin')->register($data);
            if ($result == 1) {
                $this->success('注册成功！', 'admin/index/login');
            } else {
                $this->error($result);
            }
        }
        return view();
    }
    //忘记密码,发送验证码
    public function forget()
    {
        if (request()->isAjax()) {
            $code = mt_rand(1000, 9999);
            session('code', $code);
            $data = [
                'email' => input('post.email')
            ];
            $result = model('Admin')->forget($data);
            if ($result == 1) {
                $this->success('验证码发送成功！');
            } else {
                $this->error($result);
            }
        }
        return view();
    }


    //重置密码
    public function forgetRe()
    {
        $data = [
            'email' => input('post.email'),
            'code' => input('post.code')
        ];
        if (session('code') != $data['code']) {
            $this->error('验证码不正确！');
        } else {
            $newpass = mt_rand(10000, 99999);
            $adminInfo = model('Admin')->where('email', $data['email'])->find();
            $adminInfo->password = $newpass;
            $result = $adminInfo->save();
            $content = '您好，' . $adminInfo['nickname'] . '！<br>' . '您的密码已重置成功。<br>' .
                '用户名：' . $adminInfo['username'] . '<br>' . '新密码：' . $newpass;
            if ($result && email($adminInfo['email'], '密码重置成功', $content)) {
                $this->success('新密码已发往邮箱！', 'admin/index/login');
            } else {
                $this->error('密码重置失败！');
            }
        }
    }
}
