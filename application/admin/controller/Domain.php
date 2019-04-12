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
use service\LogService;
use service\DataService;
use think\Db;

/**
 * 域名参数配置控制器
 * Class Domain
 * @package app\admin\controller
 * @date 2017/02/15 18:05
 */
class Domain extends BasicAdmin
{

    /**
     * 当前默认数据模型
     * @var string
     */
    public $table = 'SystemDomain';

    /**
     * 当前页面标题
     * @var string
     */
    public $title = '域名列表';

    /**
     * 域名列表
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function index()
    {
        $this->title = '域名列表';
        $get         = $this->request->get();
        $db          = Db::name($this->table)->alias('d')->where(['d.is_deleted' => '0']);
        if (isset($get['name']) && $get['name'] !== '') {
            $db->whereLike('d.name', "%{$get['name']}%");
        }
        if (isset($get['type']) && $get['type'] !== '') {
            $db->where('d.type', "{$get['type']}");
        }
        if (isset($get['status']) && $get['status'] !== '') {
            $db->where('d.status', "{$get['status']}");
        }
        if (isset($get['server_id']) && $get['server_id'] !== '') {
            $db->where('d.server_id', "{$get['server_id']}");
        }
        if (isset($get['create_at']) && $get['create_at'] !== '') {
            list($start, $end) = explode(' - ', $get['create_at']);
            $db->whereBetween('d.create_at', ["{$start} 00:00:00", "{$end} 23:59:59"]);
        }
        $db->join('system_server s','s.id=d.server_id','LEFT')->field('s.ip,d.*');
        return parent::_list($db->order('d.sort asc,d.id desc'));
    }

    /**
     * 添加域名
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function add()
    {
        $this->title = '添加域名';
        return $this->_form($this->table, 'form');
    }

    /**
     * 编辑域名
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function edit()
    {
        $this->title = '编辑域名';
        return $this->_form($this->table, 'form');
    }

    /**
     * 添加成功回跳处理
     * @param bool $result
     */
    protected function _form_result($result)
    {
        if ($result !== false) {
            list($base, $spm, $url) = [url('@admin'), $this->request->get('spm'), url('admin/domain/index')];
            $this->success('数据保存成功！', "{$base}#{$url}?spm={$spm}");
        }
    }

    /**
     * 删除域名
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $this->success("域名删除成功！", '');
        }
        $this->error("域名删除失败，请稍候再试！");
    }

    /**
     * 域名禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbid()
    {
        if (DataService::update($this->table)) {
            $this->success("域名禁用成功！", '');
        }
        $this->error("域名禁用失败，请稍候再试！");
    }

    /**
     * 域名启用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume()
    {
        if (DataService::update($this->table)) {
            $this->success("域名启用成功！", '');
        }
        $this->error("域名启用失败，请稍候再试！");
    }

    /**
     * 公众号
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function getApps()
    {
        $list   = Db::name('SystemApp')->where(['is_deleted' => '0', 'status' => 1, 'is_bind_domain' => 0])->order('sort asc,id desc')->select();
        return $list;
    }

    /**
     * ip
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function getIps()
    {
        $list   = Db::name('SystemServer')->field('id,ip,name')->where(['is_deleted' => '0', 'status' => 1])->order('sort asc,id desc')->select();
        return $list;
    }

    /**
     * 禁用域名
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function getnotice()
    {
        $list   = Db::name('SystemDisabledDomain')->select();
        if (empty($list)) {
            return ['status' => false];
        }
        $msg = '注意，域名';
        $ids = [];
        foreach ($list as $item) {
            $msg .= $item['domain'].',';
            $ids[] = $item['id'];
        }
        $msg = substr($msg,0,strlen($msg)-1);
        $msg .= '被禁用了';

        //Db::name('SystemDisabledDomain')->where('id','in', $ids)->delete();
        return ['status' => true,'msg' => $msg, 'data' => $ids];
    }

    /**
     * 删除禁用域名
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function noticedel()
    {
        $post = $this->request->post();
        Db::name('SystemDisabledDomain')->where('id','in', $post['id'])->delete();
        return ['status' => true,'msg' => '删除成功'];
    }

}
