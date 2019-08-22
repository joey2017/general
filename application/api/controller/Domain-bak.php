<?php

namespace app\api\controller;

use think\App;
use think\Controller;
use think\Db;

/**
 * @author Anyon <zoujingli@qq.com>
 */
class Domain extends Controller
{
  	// horocn检测
  	//private $_apiKey = '2812b670bb8c1edcdde4363b32931628';
  
  	//private $_apiUrl = 'https://wx.horocn.com/api/v1/wxUrlCheck?api_token=%s&req_url=%s';
  
  	//5la.cn检测
  	private $_apiKey = '65290a07a073d859448c960ae072fb82';
  
  	private $_apiUrl = 'https://www.5la.cn/api/wxdomain?token=%s&domain=%s';
  
  	public function check(){

       	//获取数据
      	$data = Db::name('SystemDomain')
                ->field('id,name,type')
                ->where(['is_deleted' => '0', 'status' => '1'])
                ->order('sort asc,id desc')
                ->select();

        if (empty($data)) {
            exit();
        }
		
      	sleep(2);//两秒停顿
      
        //循环检测
        foreach ($data as $item) {
            //sleep(30);// 等待30s
            $item['name'] = trim($item['name']);
            $check        = $this->getCurl($item['name']);  
          
          	/*
            *5la检测
            */
          	if ($check['code'] == '200') {
                //正常的
                //Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 1, 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif (in_array($check['code'], ['4001', '4002', '4003', '4004', '5001', '5002', '100', '9999'])) {
                Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif ($check['code'] == '-1') {
                //被屏蔽
                $result = Db::name('SystemDomain')->where(['id' => $item['id']])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                try {
                    if ($result > 0) {
                        Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => '更新成功', 'add_time' => date('Y-m-d H:i:s')]);
                        Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
                        Db::name('systemDisabledDomain')->insert(['domain' => $item['name'], 'create_at' => date('Y-m-d H:i:s')]);
                    } else {
                        Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => '更新失败', 'add_time' => date('Y-m-d H:i:s')]);
                    }
                    if ($item['type'] == 1) {
                        $bind_domains = Db::name('SystemApp')
                            ->field('id,bind_domain_ld')
                            ->where(['bind_domain_qun' => $item['name'], 'bind_domain_quan' => $item['name'], 'status' => 1, 'is_deleted' => 0])
                            ->order('sort asc,id desc')
                            ->select();
                        if (!empty($bind_domains)) {
                            foreach ($bind_domains as $bind) {
                                Db::name('SystemDomain')->where(['name' => $bind['bind_domain_ld'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                            }
                        }
                        Db::name('SystemApp')->where(['bind_domain_qun' => $item['name'], 'bind_domain_quan' => $item['name'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                    } elseif ($item['type'] == 2) {
                        Db::name('SystemApp')->where(['bind_domain_ld' => $item['name'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                    }
                } catch (\Exception $e) {
                    $msg = ['msg' => $e->getMessage()];
                    Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'descr' => json_encode($msg), 'add_time' => date('Y-m-d H:i:s')]);
                }
            }
          
          	 usleep(3000000);// 等待3s
          
          	/*
            *horocn检测
            */
          	
            /*
          	if ($check['code'] == '0' && $check['data']['status'] == 'ok') {
            	//正常的
                //Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 1, 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif (in_array($check['code'],['100','9999','10001','10003','10004','20001','20002'])) {
                Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif ($check['code'] == '0' && $check['data']['status'] == 'blocked') {
              	//被屏蔽
              	$result = Db::name('SystemDomain')->where(['id' => $item['id']])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
              	try {
                    if ($result > 0) {
                      	Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => '更新成功', 'add_time' => date('Y-m-d H:i:s')]);
                     	Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
                       	Db::name('systemDisabledDomain')->insert(['domain' => $item['name'], 'create_at' => date('Y-m-d H:i:s')]);
                    } else {
                        Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => '更新失败', 'add_time' => date('Y-m-d H:i:s')]);
                    }
                    if ($item['type'] == 1) { 
                      	$bind_domains = Db::name('SystemApp')
                          ->field('id,bind_domain_ld')
                          ->where(['bind_domain_qun' => $item['name'], 'bind_domain_quan' => $item['name'], 'status' => 1, 'is_deleted' => 0])
                          ->order('sort asc,id desc')
                          ->select();
                        if (!empty($bind_domains)) {
                            foreach ($bind_domains as $bind) {
                                Db::name('SystemDomain')->where(['name' => $bind['bind_domain_ld'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s'), 'remark' => '大站被封，落地域名临时禁用']);
                            }
                        }
                        Db::name('SystemApp')->where(['bind_domain_qun' => $item['name'], 'bind_domain_quan' => $item['name'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                    } elseif ($item['type'] == 2) {
                        Db::name('SystemApp')->where(['bind_domain_ld' => $item['name'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                    }
                } catch (\Exception $e) {
                    $msg = ['msg' => $e->getMessage()];
                    Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'descr' => json_encode($msg), 'add_time' => date('Y-m-d H:i:s')]);
                }
            }
            */
            
        }

        echo date('Y-m-d H:i:s')."  exec  successful"."\r\n";

    }
  
    /** 微信域名接口检测
     * @param $reqUrl    需要检测的地址或域名
     * @return code    返回码    msg    错误消息    返回的错误消息
     * {"msg":"\u57df\u540d\u6b63\u5e38","error_code":0,"data":[],"req":{"type":"wx","key":"86939d2367e7813816ff16a17a1caf1f","domain":"http:\/\/0050h9.cn"}}
     */
    public function getCurl($reqUrl)
    {
        $url = sprintf($this->_apiUrl, $this->_apiKey, $reqUrl);
        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        $responseBody = curl_exec($ch);
        file_put_contents(__DIR__ . '/'.date('Ymd').'_domain.log', '检测的域名是：'.$reqUrl . '，api接口返回的数据是：' . $responseBody . '，请求返回时间：' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
      
        $responseArr = json_decode($responseBody, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            return ['code' => '100','msg' => 'JSON 解析出错'];
        }
      	
      	return is_array($responseArr) && !empty($responseArr) ? $responseArr : ['code' => '9999','msg' => 'api error'];
    }
  
  	/** 蜻蜓微信域名接口检测
     * @param $reqUrl    需要检测的地址或域名
     * {
          "code": 0,
          "msg": "OK",
          "data": {
              "status": "ok"
          }
        }
        code == 0 && data['status'] == 'ok',
        code == 0&& data['status'] == 'blocked',
        10001 => 接口调用频率过快,
        10003 => 参数有误,
        10004 => 系统内部错误，请重试,
        20001 => API Token 无效,
        20002 => 未购买服务或服务已过期
     */
  	public function horocn_check(){
    	//获取数据
      	$data = Db::name('SystemDomain')
                ->field('id,name')
                ->where(['is_deleted' => '0', 'status' => '1'])
                ->order('sort asc,id desc')
                ->select();

        if (empty($data)) {
            exit();
        }

        //循环检测
        foreach ($data as $item) {
            usleep(1500000);// 等待1.5s
            $item['name'] = trim($item['name']);
            $check        = $this->getCurl($item['name']);
          
          	if ($check['code'] == '0' && $check['data']['status'] == 'ok') {
            	//正常的
                Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 1, 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif (in_array($check['code'],['10001','10003','10004','20001','20002'])) {
                Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif ($check['code'] == '0' && $check['data']['status'] == 'blocked') {
              	//被屏蔽
              	$result = Db::name('SystemDomain')->where(['id' => $item['id']])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
              	try {
                    if ($result > 0) {
                      	Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => '更新成功', 'add_time' => date('Y-m-d H:i:s')]);
                     	Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
                       	Db::name('systemDisabledDomain')->insert(['domain' => $item['name'], 'create_at' => date('Y-m-d H:i:s')]);
                    } else {
                        Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => '更新失败', 'add_time' => date('Y-m-d H:i:s')]);
                    }
                    if ($item['type'] == 1) { 
                      	$bind_domains = Db::name('SystemApp')
                          ->field('id,bind_domain_ld')
                          ->where(['bind_domain_qun' => $item['name'], 'bind_domain_quan' => $item['name'], 'status' => 1, 'is_deleted' => 0])
                          ->order('sort asc,id desc')
                          ->select();
                        if (!empty($bind_domains)) {
                            foreach ($bind_domains as $bind) {
                                Db::name('SystemDomain')->where(['name' => $bind['bind_domain_ld'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                            }
                        }
                        Db::name('SystemApp')->where(['bind_domain_qun' => $item['name'], 'bind_domain_quan' => $item['name'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                    } elseif ($item['type'] == 2) {
                        Db::name('SystemApp')->where(['bind_domain_ld' => $item['name'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                    }
                } catch (\Exception $e) {
                    $msg = ['msg' => $e->getMessage()];
                    Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'descr' => json_encode($msg), 'add_time' => date('Y-m-d H:i:s')]);
                }
            }
        }

        echo date('Y-m-d H:i:s')."  exec  successful"."\r\n";
    }
  
  	/*
    * {"4001", "token不能为空"}
      {"4002", "域名不能为空"}
      {"4003", "token已过期"}
      {"4004", "token不正确或无权限"}
      {"5001", "请求时间间隔太短，请稍后再试"}
      {"5002", "已超当天请求数，请明日再试"}
    */
  	public function la_check(){
    	//获取数据
        $data = Db::name('SystemDomain')
            ->field('id,name')
            ->where(['is_deleted' => '0', 'status' => '1'])
            ->order('sort asc,id desc')
            ->select();

        if (empty($data)) {
            exit();
        }

        //循环检测
        foreach ($data as $item) {
            sleep(30);// 等待30s
            $item['name'] = trim($item['name']);
            $check        = $this->getCurl($item['name']);

            if ($check['code'] == '200') {
                //正常的
                Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 1, 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif (in_array($check['code'], ['4001', '4002', '4003', '4004', '5001', '5002', '100', '9999'])) {
                Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif ($check['code'] == '-1') {
                //被屏蔽
                $result = Db::name('SystemDomain')->where(['id' => $item['id']])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                try {
                    if ($result > 0) {
                        Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => '更新成功', 'add_time' => date('Y-m-d H:i:s')]);
                        Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => $check['msg'], 'add_time' => date('Y-m-d H:i:s')]);
                        Db::name('systemDisabledDomain')->insert(['domain' => $item['name'], 'create_at' => date('Y-m-d H:i:s')]);
                    } else {
                        Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => '更新失败', 'add_time' => date('Y-m-d H:i:s')]);
                    }
                    if ($item['type'] == 1) {
                        $bind_domains = Db::name('SystemApp')
                            ->field('id,bind_domain_ld')
                            ->where(['bind_domain_qun' => $item['name'], 'bind_domain_quan' => $item['name'], 'status' => 1, 'is_deleted' => 0])
                            ->order('sort asc,id desc')
                            ->select();
                        if (!empty($bind_domains)) {
                            foreach ($bind_domains as $bind) {
                                Db::name('SystemDomain')->where(['name' => $bind['bind_domain_ld'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                            }
                        }
                        Db::name('SystemApp')->where(['bind_domain_qun' => $item['name'], 'bind_domain_quan' => $item['name'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                    } elseif ($item['type'] == 2) {
                        Db::name('SystemApp')->where(['bind_domain_ld' => $item['name'], 'is_deleted' => 0])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                    }
                } catch (\Exception $e) {
                    $msg = ['msg' => $e->getMessage()];
                    Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'descr' => json_encode($msg), 'add_time' => date('Y-m-d H:i:s')]);
                }
            }
        }
    }

}
