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

namespace app\admin\controller;

use controller\BasicAdmin;
use service\DataService;
use think\Db;

/**
 * 视频管理控制器
 * Class Video
 * @package app\admin\controller
 * @date 2017/02/15 18:05
 */
class Video extends BasicAdmin
{

    /**
     * 当前默认数据模型
     * @var string
     */
    public $table = 'SystemVideo';

    /**
     * 当前页面标题
     * @var string
     */
    public $title = '视频管理列表';

    /**
     * 显示视频列表
     * @return string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
//    public function index()
//    {
//        if ($this->request->isGet()) {
//            return $this->fetch('', ['title' => $this->title]);
//        }
//        if ($this->request->isPost()) {
//            foreach ($this->request->post() as $key => $vo) {
//                sysconf($key, $vo);
//            }
//            LogService::write('视频管理', '视频参数配置成功');
//            $this->success('视频参数配置成功！', '');
//        }
//    }


    /**
     * 视频列表
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '视频设置列表';
        $get         = $this->request->get('', null, 'trim');
        $db = Db::name($this->table)->where(['is_deleted' => '0']);
        if (isset($get['title']) && $get['title'] !== '') {
            $db->whereLike('title', "%{$get['title']}%");
        }
        if (isset($get['status']) && $get['status'] !== '') {
            $db->where('status', "{$get['status']}");
        }
        if (isset($get['create_at']) && $get['create_at'] !== '') {
            list($start, $end) = explode(' - ', $get['create_at']);
            $db->whereBetween('create_at', ["{$start} 00:00:00", "{$end} 23:59:59"]);
        }
        return parent::_list($db->order('sort asc,id desc'));
    }

    /**
     * 添加视频
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function add()
    {
        $this->title = '添加视频';
        return $this->_form($this->table, 'form');
    }

    /**
     * 编辑视频
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function edit()
    {
        $this->title = '编辑视频';
        return $this->_form($this->table, 'form');
    }

    /**
     * 添加成功回跳处理
     * @param bool $result
     */
    protected function _form_result($result)
    {
        if ($result !== false) {
            list($base, $spm, $url) = [url('@admin'), $this->request->get('spm'), url('admin/video/index')];
            $this->success('数据保存成功！', "{$base}#{$url}?spm={$spm}");
        }
    }

    /**
     * 删除视频
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $this->success("视频删除成功！", '');
        }
        $this->error("视频删除失败，请稍候再试！");
    }

    /**
     * 视频禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbid()
    {
        if (DataService::update($this->table)) {
            $this->success("视频禁用成功！", '');
        }
        $this->error("视频禁用失败，请稍候再试！");
    }

    /**
     * 视频启用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume()
    {
        if (DataService::update($this->table)) {
            $this->success("视频启用成功！", '');
        }
        $this->error("视频启用失败，请稍候再试！");
    }

}
