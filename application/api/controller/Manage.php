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

    /**分享数据
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
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

    /**二维码数据
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
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

    /**广告位置数据
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
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

    /**视频数据
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function video()
    {
        $this->_header;
        if ($this->request->isPost()) {
            return json_encode(Db::name('SystemVideo')
                ->field('title,vid,pause,read_min,read_max,image,stars')
                ->where(['is_deleted' => '0', 'status' => '1'])
                ->order('sort asc,id desc')
                ->find()
            );
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }

    /**其他数据
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function args()
    {
        $this->_header;
        if ($this->request->isPost()) {
            return json_encode(Db::name('SystemConfig')
                ->field('name,value')
                ->where(['name' => 'fanhui'])->whereOr(['name' => 'gg_img'])->whereOr(['name' => 'gg_item'])
                ->select()
            );
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }

    // 省份
    public function getprovinces(){
        $this->_header;
        if ($this->request->isPost()) {
            return json_encode(Db::name('SystemArea')
                ->field('id,area_name')
                ->where(['area_parent_id' => '0'])
                ->select()
            );
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }

    // 城市
    public function getcitys(){
        $this->_header;
        if ($this->request->isPost()) {
            $post =  $this->request->post();
            $province_id =  $post['id'];
            return json_encode(Db::name('SystemArea')
                ->field('id,area_name')
                ->where(['area_parent_id' => $province_id])
                ->select()
            );
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }

    // 区县
    public function getdis(){
        $this->_header;
        if ($this->request->isPost()) {
            $post =  $this->request->post();
            $city_id =  $post['id'];
            return json_encode(Db::name('SystemArea')
                ->field('id,area_name')
                ->where(['area_parent_id' => $city_id])
                ->select()
            );
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }

    public function formdata(){
        $this->_header;
        if ($this->request->isPost()) {
            $post =  $this->request->post();
            $post['add_time'] = date('Y-m-d H:i:s');
            $post['ip']       = $this->getIP();
            if (Db::name('SystemInformation')->strict(false)->insert($post)) {
                return json_encode(['status' => true]);
            };
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }

    /**
     * 获取用户真实 IP
     */
    private function getIP()
    {
        static $realip;
        if (isset($_SERVER)){
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR_POUND"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR_POUND"];
            } else if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            } else {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            } else {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }

    public function addcom(){
        $this->_header;
        if ($this->request->isPost()) {
            $post['add_time'] = date('Y-m-d H:i:s');
            $post['ip']       = $this->getIP();
            if (Db::name('SystemComplaint')->strict(false)->insert($post)) {
                return json_encode(['status' => true]);
            };
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }

    public function getwxqcode(){
        $this->_header;
        if ($this->request->isPost()) {
            $post =  $this->request->post();
            $id =  $post['id'];
            return json_encode(Db::name('SystemWximg')
                ->field('id,title,pic')
                ->where(['id' => $id])
                ->find()
            );
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }
  
  	public function sharelog(){
    	if ($this->request->isPost()) {
            $post =  $this->request->post();
          	$post['create_time'] = date('Y-m-d H:i:s');
          	$post['ip']       = $this->getIP();
          	if (Db::name('SystemShareLog')->strict(false)->insert($post)) {
            	return json_encode(['status' => true]);
            }
        } else {
            return json_encode(['code' => '100','msg' => '无访问权限']);
        }
    }
}
