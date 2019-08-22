<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/11
 * Time: 10:26
 */
set_time_limit(0);
require_once __DIR__ . '/Mysql.class.php';

//数据库信息
$database = [
    'dsn'      => "mysql:host=127.0.0.1;dbname=wx;charset=utf8",
    'username' => "wx",
    'password' => "JKzfSHsZw2DYD5Jk"
];

//开始连接数据库
$db = Mysql::newClass();
$db->pdoConnect([$database['dsn'], $database['username'], $database['password']]);

$db->select('system_domain', 'id,name', ['status' => 1, 'is_deleted' => 0], 'sort asc,id desc');
$data = $db->selectAll(); //获取数据

if (empty($data)) {
    exit();
}

//循环检测
foreach ($data as $item) {
    usleep(1000000);// 等待1s
    $item['name'] = trim($item['name']);
    $check        = domainCheck($item['name']);
    if ($check === false) {
        $result = $db->update('system_domain', ['status' => 0, 'edit_time' => date('Y-m-d H:i:s')], 'id=' . $item['id']);
        try {
            if ($result > 0) {
                $db->insert('system_domain_update_log', ['name' => $item['name'], 'status' => 0, 'descr' => '更新成功(tool)', 'add_time' => date('Y-m-d H:i:s')]);
                $db->insert('system_domain_api_log', ['name' => $item['name'], 'status' => 0, 'descr' => '域名被封了(tool)', 'add_time' => date('Y-m-d H:i:s')]);

            } else {
                $db->insert('system_domain_update_log', ['name' => $item['name'], 'status' => 0, 'descr' => '更新失败(tool)', 'add_time' => date('Y-m-d H:i:s')]);
            }
        } catch (\Exception $e) {
            $msg = ['msg' => $e->getMessage()];
            $db->insert('system_domain_update_log', ['name' => $item['name'], 'descr' => json_encode($msg).'(tool)', 'add_time' => date('Y-m-d H:i:s')]);
        }

        $insert = $db->insert('system_disabled_domain', ['domain' => $item['name'], 'create_at' => date('Y-m-d H:i:s')]);

    } elseif ($check === '422') {
        $db->insert('system_domain_api_log', ['name' => $item['name'], 'descr' => '域名格式不合法(tool)', 'add_time' => date('Y-m-d H:i:s')]);
    } elseif ($check === '9999') {
        $db->insert('system_domain_api_log', ['name' => $item['name'], 'descr' => '暂时无法检测(tool)', 'add_time' => date('Y-m-d H:i:s')]);
    } else {
        //正常的
        //$db->insert('system_domain_api_log', ['name' => $item['name'], 'status' => 1, 'descr' => '域名正常(tool)', 'add_time' => date('Y-m-d H:i:s')]);
    }
}

echo date('Y-m-d H:i:s')."    successful"."\r\n";

/** 微信域名接口检测
 * @param $domain    需要检测的地址或域名
 * @return code    返回码    1:正常 | 2:被封 | 422:域名格式不合法 | 9999:暂时无法检测  msg    错误消息    返回的错误消息
 */
function domainCheck($domain)
{
    $key = 'token_key';
  	$url = 'http://z6seq.cn/api/tools/wechat';
  	$timestamp = time();
  	$token = sha1(md5($key . $timestamp));
  	$requestData = array('domain' => $domain, 'timestamp' => $timestamp, 'token' => $token);
  	
  	$curl = curl_init();
  	curl_setopt($curl, CURLOPT_URL, $url);
  	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

  	//普通数据
  	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($requestData));
  	$res = curl_exec($curl);
  	curl_close($curl);
  	$responseArr  = json_decode($res, true);
  	//file_put_contents(__DIR__.'/tool_log.log',$domain.'   '.$res.'   '.date('Y-m-d H:i:s').PHP_EOL,FILE_APPEND);
  	if (isset($responseArr['data'])) {
        // 接口正确返回
        if ($responseArr['data']['intercept'] == '0') {
            return '9999';
        } else if ($responseArr['data']['intercept'] == '1') {
            return true;
        } else if ($responseArr['data']['intercept'] == '2') {
            return false;
        }
    } elseif(isset($responseArr['status_code']) && $responseArr['status_code'] == 422) {
        return '422';
    }

}
