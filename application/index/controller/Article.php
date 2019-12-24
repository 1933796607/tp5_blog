<?php

namespace app\index\controller;

use think\db\Where;

class Article extends Base
{
    //文章详情页
    public function info()
    {
        $articleInfo = model('Article')->find(input('id'));
        $articleInfo->setInc('click');
        $where = ['articleid' => input('id')];
        $commentInfo = model('Comment')->where($where)->order('create_time', 'desc')->paginate(2, false, ['query' => $where]);
        $viewData = [
            'articleInfo' => $articleInfo,
            'commentInfo' => $commentInfo
        ];
        $this->assign($viewData);
        return view();
    }
    //文章评论
    public function comm()
    {
        $data = [
            'content' => input('post.content'),
            'articleid' => input('post.articleid'),
            'memberid' => session('index.id')
        ];
        $result = model('Comment')->add($data);
        if ($result == 1) {
            $commentInfo = model('Article')->where('id', $data['articleid'])->find();
            $result1 = $commentInfo->setInc('comment');
            if ($result1) {
                $this->success('评论成功！');
            } else {
                $this->error($result1);
            }
        } else {
            $this->error($result);
        }
    }
}
