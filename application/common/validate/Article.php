<?php

namespace app\common\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title|文章标题' => 'require|unique:article',
        'tags|标签' => 'require',
        'cateid|所属栏目' => 'require',
        'desc|文章概要' => 'require',
        'content|内容' => 'require',
        'atop|推荐' => 'require'
    ];

    //添加场景
    public function sceneAdd()
    {
        return $this->only(['title', 'tags', 'cateid', 'desc', 'content']);
    }

    //推荐场景
    public function sceneTop()
    {
        return $this->only(['atop']);
    }
    //编辑场景
    public function sceneEdit()
    {
        return $this->only(['title', 'tags', 'atop', 'cateid', 'desc', 'content']);
    }
}
