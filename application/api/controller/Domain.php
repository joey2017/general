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
  
  	//太阳湾检测
  	private $_apiKey = 'd11d940a9d1b23ad8feee1a55406e447';
  
  	private $_apiUrl = 'http://wx.rrbay.com/pro/wxUrlCheck2.ashx?key=%s&url=%s';
  
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
            $check = $this->getCurl(trim($item['name']));

          	/*
            *太阳湾检测
            */

          	if ($check['State'] == true && $check['Code'] == 102) {
                //正常的
                //Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 1, 'descr' => $check['Msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif (in_array($check['Code'], ['103', '001', '002', '003', '100', '9999'])) {
                Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'descr' => $check['Msg'], 'add_time' => date('Y-m-d H:i:s')]);
            } elseif ($check['State'] == true && $check['Code'] == 101) {
                //被屏蔽
                $result = Db::name('SystemDomain')->where(['id' => $item['id']])->update(['status' => 0, 'edit_time' => date('Y-m-d H:i:s')]);
                try {
                    if ($result > 0) {
                        Db::name('systemDomainUpdateLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => '更新成功', 'add_time' => date('Y-m-d H:i:s')]);
                        Db::name('systemDomainApiLog')->insert(['name' => $item['name'], 'status' => 0, 'descr' => $check['Msg'], 'add_time' => date('Y-m-d H:i:s')]);
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
          
          	 usleep(2200000);// 等待2.2s
            
        }

        echo date('Y-m-d H:i:s')."  exec  successful"."\r\n";
    }
  
    /** 微信域名接口检测
     * @param $reqUrl    需要检测的地址或域名
     * @return code    返回码    msg    错误消息    返回的错误消息
     * {"State":true,"Code","101","Data":"www.rrbay.com","Msg":"屏蔽"}
     */
    public function getCurl($reqUrl)
    {
        $url = sprintf($this->_apiUrl, $this->_apiKey, $reqUrl);
        $ch  = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        $responseBody = curl_exec($ch);
        file_put_contents(__DIR__ . '/'.date('Ymd').'domain.log', '检测的域名是：'.$reqUrl . '，api接口返回的数据是：' . $responseBody . '，请求返回时间：' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);
      
        $responseArr = json_decode($responseBody, true);
        if (json_last_error() != JSON_ERROR_NONE) {
            return ['Code' => '100','Msg' => 'JSON 解析出错'];
        }
      	
      	return is_array($responseArr) && !empty($responseArr) ? $responseArr : ['Code' => '9999','Msg' => 'api error'];
    }

}
