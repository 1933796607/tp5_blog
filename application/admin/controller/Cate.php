<?php

namespace app\admin\controller;


class Cate extends Base
{
    //栏目列表
    public function list()
    {
        $cates = model('Cate')->order(['sort'])->paginate(3);
        $viewData = [
            'cates' => $cates
        ];
        $page = $cates->render();
        $this->assign($viewData);
        return view();
    }

    //栏目添加
    public function add()
    {
        if (request()->isAjax()) {
            $data = [
                'catename' => input('post.catename'),
                'sort' => input('post.sort')
            ];
            $result = model('Cate')->add($data);
            if ($result == 1) {
                $this->success('栏目添加成功', 'admin/cate/list');
            } else {
                $this->error($result);
            }
        }
        return view();
    }

    //栏目排序
    public function sort()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'sort' => input('post.sort')
            ];
            $result = model('Cate')->sort($data);
            if ($result == 1) {
                $this->success('编号修改成功', 'admin/cate/list');
            } else {
                $this->error($result);
            }
        }
    }

    //栏目编辑
    public function edit()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'catename' => input('post.catename')
            ];
            $result = model('Cate')->edit($data);
            if ($result == 1) {
                $this->success('栏目修改成功！', 'admin/cate/list');
            } else {
                $this->error($result);
            }
        }
        $cateInfo = model('Cate')->find(input('id'));
        $viewData = [
            'cateInfo' => $cateInfo
        ];
        $this->assign($viewData);
        return view();
    }


    //栏目删除
    public function del()
    {
        $cateInfo = model('Cate')->with('article,article.comments')->find(input('post.id'));
        foreach ($cateInfo['article'] as $k => $v) {
            $v->together('comments')->delete();
        }
        $result = $cateInfo->together('article,article.comments')->delete();
        if ($result) {
            $this->success('栏目删除成功！', 'admin/cate/list');
        } else {
            $this->error('栏目删除失败');
        }
    }
}
