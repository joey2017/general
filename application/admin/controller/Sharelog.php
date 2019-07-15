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
 * 公众号参数配置控制器
 * Class Sharelog
 * @package app\admin\controller
 * @date 2017/02/15 18:05
 */
class Sharelog extends BasicAdmin
{

    /**
     * 当前默认数据模型
     * @var string
     */
    public $table = 'SystemDomainShareLog';

    /**
     * 当前页面标题
     * @var string
     */
    public $title = '视频分享日志';

    /**
     * 视频分享日志列表
     * @return string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function index()
    {
        // 视频key
        $keys = Db::table('system_video')->field('id')->where('is_deleted',0)->where('status',1)->order(['sort asc','id desc'])->select();
        $this->assign('keys', $keys);
        // 日志数据库对象
        list($this->title, $get) = ['视频分享日志', $this->request->get()];
        $db = Db::name($this->table)->order('id desc');
        (isset($get['name']) && $get['name'] !== '') && $db->whereLike('name', "%{$get['name']}%");
        (isset($get['key']) && $get['key'] !== '') && $db->where('key', $get['key']);
        if (isset($get['create_at']) && $get['create_at'] !== '') {
            list($start, $end) = explode(' - ', $get['create_at']);
            $db->whereBetween('create_at', ["{$start} 00:00:00", "{$end} 23:59:59"]);
        }
        return parent::_list($db);
    }

    /**
     * 日志删除操作
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function del()
    {
        if (DataService::update($this->table)) {
            $this->success("日志删除成功!", '');
        }
        $this->error("日志删除失败, 请稍候再试!");
    }
}
