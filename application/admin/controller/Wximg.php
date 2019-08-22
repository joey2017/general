<?php

// +----------------------------------------------------------------------
// | Think.Admin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/Think.Admin
// +----------------------------------------------------------------------

namespace app\admin\controller;

use controller\BasicAdmin;
use service\DataService;
use think\Db;

/**
 * 小说二维码设置
 * Class Wximg
 * @package app\admin\controller
 * @date 2017/03/27 14:43
 */
class Wximg extends BasicAdmin
{

    /**
     * 定义当前操作表名
     * @var string
     */
    public $table = 'SystemWximg';

    /**
     * 小说二维码列表
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '小说二维码设置';
        $get = $this->request->get('',null,'trim');
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
     * 添加小说二维码
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function add()
    {
        $this->title = '添加小说二维码';
        return $this->_form($this->table, 'form');
    }

    /**
     * 编辑小说二维码
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function edit()
    {
        $this->title = '编辑小说二维码';
        return $this->_form($this->table, 'form');
    }

    /**
     * 表单提交数据处理
     * @param array $data
     */
    protected function _form_filter($data)
    {
        if ($this->request->isPost()) {
            empty($data['pic']) && $this->error('请上传小说二维码图片');
        }
    }

    /**
     * 添加成功回跳处理
     * @param bool $result
     */
    protected function _form_result($result)
    {
        if ($result !== false) {
            list($base, $spm, $url) = [url('@admin'), $this->request->get('spm'), url('admin/wximg/index')];
            $this->success('数据保存成功！', "{$base}#{$url}?spm={$spm}");
        }
    }

    /**
     * 删除小说二维码
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $this->success("小说二维码删除成功！", '');
        }
        $this->error("小说二维码删除失败，请稍候再试！");
    }

    /**
     * 小说二维码禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbid()
    {
        if (DataService::update($this->table)) {
            $this->success("小说二维码禁用成功！", '');
        }
        $this->error("小说二维码禁用失败，请稍候再试！");
    }

    /**
     * 小说二维码启用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume()
    {
        if (DataService::update($this->table)) {
            $this->success("小说二维码启用成功！", '');
        }
        $this->error("小说二维码启用失败，请稍候再试！");
    }

}
