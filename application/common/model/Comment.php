<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class Comment extends Model
{
    //软删除
    use SoftDelete;

    //关联文章
    public function article()
    {
        return
            $this->belongsTo('Article', 'articleid', 'id');
    }
    //关联用户
    public function member()
    {
        return $this->belongsTo('Member', 'memberid', 'id');
    }
    //添加评论
    public function add($data)
    {
        $validate = new \app\common\validate\Comment();
        if (!$validate->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if ($result) {
            return 1;
        } else {
            return '评论失败！';
        }
    }
}
