<?php

namespace app\common\validate;

use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename|栏目名称' => 'require|unique:cate',
        'sort|排序数字' => 'require|number'
    ];

    //栏目添加场景
    public function sceneAdd()
    {
        return $this->only(['catename', 'sort']);
    }
    //排序场景
    public function sceneSort()
    {
        return $this->only(['sort']);
    }

    //编辑场景
    public function sceneEdit()
    {
        return $this->only(['catename']);
    }
}
