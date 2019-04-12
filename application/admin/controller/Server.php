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
use service\LogService;
use think\Db;

/**
 * 服务器参数配置控制器
 * Class Server
 * @package app\admin\controller
 * @date 2017/02/15 18:05
 */
class Server extends BasicAdmin
{

    /**
     * 当前默认数据模型
     * @var string
     */
    public $table = 'SystemServer';

    /**
     * 当前页面标题
     * @var string
     */
    public $title = '服务器列表';

    /**
     * 服务器列表
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '服务器列表';
        $get         = $this->request->get();
        $db          = Db::name($this->table)->where(['is_deleted' => '0']);
        if (isset($get['name']) && $get['name'] !== '') {
            $db->whereLike('name', "%{$get['name']}%");
        }
        if (isset($get['type']) && $get['type'] !== '') {
            $db->where('type', "{$get['type']}");
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
     * 添加服务器
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function add()
    {
        $this->title = '添加服务器';
        return $this->_form($this->table, 'form');
    }

    /**
     * 编辑服务器
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function edit()
    {
        $this->title = '编辑服务器';
        return $this->_form($this->table, 'form');
    }

    /**
     * 添加成功回跳处理
     * @param bool $result
     */
    protected function _form_result($result)
    {
        if ($result !== false) {
            list($base, $spm, $url) = [url('@admin'), $this->request->get('spm'), url('admin/server/index')];
            $this->success('数据保存成功！', "{$base}#{$url}?spm={$spm}");
        }
    }

    /**
     * 删除服务器
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $this->success("服务器删除成功！", '');
        }
        $this->error("服务器删除失败，请稍候再试！");
    }

    /**
     * 服务器禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbid()
    {
        if (DataService::update($this->table)) {
            $this->success("服务器禁用成功！", '');
        }
        $this->error("服务器禁用失败，请稍候再试！");
    }

    /**
     * 服务器启用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume()
    {
        if (DataService::update($this->table)) {
            $this->success("服务器启用成功！", '');
        }
        $this->error("服务器启用失败，请稍候再试！");
    }

    /**
     * 广告开启或关闭
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function adver()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            //$data = ['field' => 'value','value' => 1,'id' => 104];
            $array = ['name' => 'gg_s' . $data['id'], 'value' => $data['value']];
            sysconf($array['name'], $array['value']);
            LogService::write('系统管理', '广告配置成功');
            $this->success('广告开启成功！', '');
        }
    }

    /**
     * 导量开启或关闭
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function change()
    {
        if ($this->request->isPost()) {
            $data = $this->request->post();
            //$data = ['field' => 'value','value' => 1,'id' => 104];
            $array = ['name' => 'dl_s' . $data['id'], 'value' => $data['value']];
            sysconf($array['name'], $array['value']);
            LogService::write('系统管理', '导量配置成功');
            $this->success('导量开启成功！', '');
        }
    }

}
