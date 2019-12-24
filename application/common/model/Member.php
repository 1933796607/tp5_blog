<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Member extends Model
{
    //软删除
    use SoftDelete;

    //只读字段
    protected $readonly = ['username', 'email'];

    //会员添加
    public function add($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '添加失败';
        }
    }
    //关联评论
    public function comments()
    {
        return $this->hasMany('Comment', 'memberid', 'id');
    }
    //会员修改
    public function edit($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $memberInfo = $this->find($data['id']);
        if ($data['oldpass'] != $memberInfo['password']) {
            return '原密码不正确！';
        }
        $memberInfo->password = $data['newpass'];
        $memberInfo->nickname = $data['nickname'];
        $result = $memberInfo->save();
        if ($result) {
            return 1;
        } else {
            return '会员修改失败';
        }
    }
    //会员注册
    public function register($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('register')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '注册失败';
        }
    }
    //会员登录
    public function login($data)
    {
        $validate = new \app\common\validate\Member();
        if (!$validate->scene('login')->check($data)) {
            return $validate->getError();
        }
        unset($data['verify']);
        $result = $this->where($data)->find();
        if ($result) {
            if ($result['status'] != 1) {
                return '账户被禁用,无法登录!';
            } else {
                $sessionData = [
                    'id' => $result['id'],
                    'nickname' => $result['nickname']
                ];
                session('index', $sessionData);
            }
            return 1;
        } else {
            return '用户名或者密码错误！';
        }
    }
}
