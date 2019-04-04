<?php

namespace app\api\controller;

use think\App;
use think\Controller;
use think\Db;

/**
 * 应用入口控制器
 * @author Anyon <zoujingli@qq.com>
 */
class Manage extends Controller
{
    private $_header;

    public function __construct(App $app = null)
    {
        parent::__construct($app);
        $this->_header = header("Access-Control-Allow-Origin: *");
    }

    public function getsharedata()
    {
        $this->_header;
        if ($this->request->isPost()) {
            $post  = $this->request->post();
            return json_encode(Db::name('SystemShare')
                ->field('name,content,title,desc,img_url,link')
                ->where(['is_deleted' => '0', 'status' => '1', 'type' => $post['type']])
                ->order('sort asc,id desc')
                ->select());
        } else {
           return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }

    public function apicode()
    {
        $this->_header;
        if ($this->request->isPost()) {
            return json_encode(Db::name('SystemQrcode')
                ->field('title,pic')
                ->where(['is_deleted' => '0', 'status' => '1'])
                ->order('sort asc,id desc')
                ->select());
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }

    public function pages()
    {
        $this->_header;
        if ($this->request->isPost()) {
            return json_encode(Db::name('SystemAdPosition')
                ->field('name,desc')
                ->where(['is_deleted' => '0', 'status' => '1'])
                ->order('sort asc,id desc')
                ->select());
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }
}
