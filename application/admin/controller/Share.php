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

/**
 * 公众号参数配置控制器
 * Class Share
 * @package app\admin\controller
 * @date 2017/02/15 18:05
 */
class Share extends BasicAdmin
{

    /**
     * 当前默认数据模型
     * @var string
     */
    public $table = 'SystemConfig';

    /**
     * 当前页面标题
     * @var string
     */
    public $title = '分享参数配置';

    /**
     * 显示好友分享配置
     * @return string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function friend()
    {
        if ($this->request->isGet()) {
            return $this->fetch('', ['title' => $this->title]);
        }
        if ($this->request->isPost()) {
            foreach ($this->request->post() as $key => $vo) {
                sysconf($key, $vo);
            }
            LogService::write('分享管理', '分享参数配置成功');
            $this->success('分享参数配置成功！', '');
        }
    }

    /**
     * 显示朋友圈分享配置
     * @return string
     * @throws \think\Exception
     * @throws \think\exception\PDOException
     */
    public function circles()
    {
        if ($this->request->isGet()) {
            return $this->fetch('', ['title' => $this->title]);
        }
        if ($this->request->isPost()) {
            foreach ($this->request->post() as $key => $vo) {
                sysconf($key, $vo);
            }
            LogService::write('分享管理', '分享参数配置成功');
            $this->success('分享参数配置成功！', '');
        }
    }

}
