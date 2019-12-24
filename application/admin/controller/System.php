<?php

namespace app\admin\controller;

class System extends Base
{
    //系统设置
    public function set()
    {
        if (request()->isAjax()) {
            $data = [
                'id' => input('post.id'),
                'webname' => input('post.webname'),
                'shortname' => input('post.shortname'),
                'copyright' => input('post.copyright')

            ];
            $result = model('System')->edit($data);
            if ($result == 1) {
                $this->success('设置成功', 'admin/home/index');
            } else {
                $this->error($result);
            }
        }
        $webInfo = model('System')->find();
        $viewData = [
            'webInfo' => $webInfo
        ];
        $this->assign($viewData);
        return view();
    }
}
