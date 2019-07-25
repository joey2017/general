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
 * 公众号参数配置控制器
 * Class Wechat
 * @package app\admin\controller
 * @date 2017/02/15 18:05
 */
class Wechat extends BasicAdmin
{

    /**
     * 当前默认数据模型
     * @var string
     */
    public $table = 'SystemApp';

    /**
     * 当前页面标题
     * @var string
     */
    public $title = '公众号参数配置';

    /**
     * 显示公众号配置
     * @return string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function index()
    {
        if ($this->request->isGet()) {
            return $this->fetch('', ['title' => $this->title]);
        }
        if ($this->request->isPost()) {
            foreach ($this->request->post() as $key => $vo) {
                sysconf($key, $vo);
            }
            //LogService::write('参数管理', '参数配置成功');
            $this->success('参数配置成功！', '');
        }
    }


    /**
     * 公众号列表
     * @return array|string
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function applist()
    {
        $this->title = '公众号列表';
        $get = $this->request->get();
        $db = Db::name($this->table)->alias('w')->field('w.*,s.ip')->where(['w.is_deleted' => '0','d.is_deleted' => 0])->leftJoin('system_domain d','d.name=w.bind_domain_ld and d.type=2')->leftJoin('system_server s','s.id=d.server_id');
        if (isset($get['server_id']) && $get['server_id'] !== '') {
            $db->where('d.server_id', $get['server_id']);
        }
        if (isset($get['name']) && $get['name'] !== '') {
            $db->whereLike('name', "%{$get['name']}%");
        }
        if (isset($get['bind_domain_ld']) && $get['bind_domain_ld'] !== '') {
            $db->whereLike('bind_domain_ld', "%{$get['bind_domain_ld']}%");
        }
        if (isset($get['create_at']) && $get['create_at'] !== '') {
            list($start, $end) = explode(' - ', $get['create_at']);
            $db->whereBetween('create_at', ["{$start} 00:00:00", "{$end} 23:59:59"]);
        }
        return parent::_list($db->order('sort asc,id desc'));
    }

    /**
     * 添加公众号
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function add()
    {
        $this->title = '添加公众号';
        return $this->_form($this->table, 'form');
    }

    /**
     * 编辑公众号
     * @return array|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * @throws \think\Exception
     */
    public function edit()
    {
        $this->title = '编辑公众号';
        return $this->_form($this->table, 'form');
    }

    /**
     * 添加成功回跳处理
     * @param bool $result
     */
    protected function _form_result($result)
    {
        if ($result !== false) {
            list($base, $spm, $url) = [url('@admin'), $this->request->get('spm'), url('admin/wechat/applist')];
            $this->success('数据保存成功！', "{$base}#{$url}?spm={$spm}");
        }
    }

    /**
     * 删除公众号
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $this->success("公众号删除成功！", '');
        }
        $this->error("公众号删除失败，请稍候再试！");
    }

    /**
     * 公众号禁用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function forbid()
    {
        if (DataService::update($this->table)) {
            $this->success("公众号禁用成功！", '');
        }
        $this->error("公众号禁用失败，请稍候再试！");
    }

    /**
     * 公众号启用
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function resume()
    {
        if (DataService::update($this->table)) {
            $this->success("公众号启用成功！", '');
        }
        $this->error("公众号启用失败，请稍候再试！");
    }

    /**
     * 公众号jsapi_ticket,access_token刷新
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function fresh()
    {
        if (chdir(dirname(ROOT_PATH).'/default/jssdkphpversion')) {
            if (is_file('access_token.php') && is_file('jsapi_ticket.php')) {
                unlink('access_token.php');
                unlink('jsapi_ticket.php');
                $this->success("更新成功！");
            };
        } else {
            $this->error("更新失败！");
        };

    }

}
