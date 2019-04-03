<?php

// +----------------------------------------------------------------------
// | ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/ThinkAdmin
// +----------------------------------------------------------------------

namespace app\index\controller;

use think\Controller;
use think\Db;

/**
 * 应用入口控制器
 * @author Anyon <zoujingli@qq.com>
 */
class Index extends Controller
{

    public function index()
    {
        $this->redirect('@admin/login');
    }

    public function getsharedata()
    {
        header("Access-Control-Allow-Origin: *");
        if ($this->request->isPost()) {
            $post  = $this->request->post();
            return json_encode(Db::name('SystemShare')
                ->where(['is_deleted' => '0', 'status' => '1', 'type' => $post['type']])
                ->order('sort asc,id desc')
                ->select());
        } else {
           $this->error('页面不存在');
        }
    }

    public function apicode()
    {
        header("Access-Control-Allow-Origin: *");
        if ($this->request->isPost()) {
            return json_encode(Db::name('SystemQrcode')
                ->where(['is_deleted' => '0', 'status' => '1'])
                ->order('sort asc,id desc')
                ->select());
        } else {
            $this->error('页面不存在');
        }
    }
}
