<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/11
 * Time: 10:26
 */

set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
ini_set('memory_limit', '512M'); // 设置内存限制

//请求接口token
$apiToken = 'e45c3660bf7799902225c08b5df895d6';
require_once __DIR__ . '/Mysql.class.php';

//数据库信息
$database = [
//    'dsn'      => "mysql:host=111.230.221.134;dbname=wx;charset=utf8",
//    'username' => "wx",
//    'password' => "JKzfSHsZw2DYD5Jk"
'dsn'      => "mysql:host=127.0.0.1;dbname=admin_v3;charset=utf8",
'username' => "root",
'password' => "root"
];

//开始连接数据库
$db = Mysql::newClass();
$db->pdoConnect([$database['dsn'], $database['username'], $database['password']]);

$read  = true;
$limit = 0;

//循环操作
do {
    $run = include __DIR__.'/timer.php';
    if (!$run) die('process abort');
    $db->select('system_domain', 'id,name', ['status' => 1, 'is_deleted' => 0, 'type' => 5], 'sort asc,id desc', "limit $limit,10");
    $data = $db->selectAll(); //获取数据

    if (empty($data)) {
        if ($limit == 0) {
            $read = false;
            break;//数据为空,直接停止了循环
        } else {
            $limit = 0;
            continue;
        }
    }

    //todo 你的业务逻辑
    foreach ($data as $item) {
        sleep(3);// 等待3s
        $item['name'] = trim($item['name']);
        $check = domainCheck($apiToken, $item['name']);
        if ($check === false) {
            $result = $db->update('system_domain', ['status' => 0, 'edit_time' => date('Y-m-d H:i:s')], 'id=' . $item['id']);
            try {
                if ($result > 0) {
                    $db->insert('system_domain_update_log', ['name' => $item['name'], 'status' => 0, 'descr' => '更新成功', 'add_time' => date('Y-m-d H:i:s')]);
                    $db->insert('system_domain_api_log', ['name' => $item['name'], 'status' => 0, 'descr' => '域名被封了', 'add_time' => date('Y-m-d H:i:s')]);

                } else {
                    $db->insert('system_domain_update_log', ['name' => $item['name'], 'status' => 0, 'descr' => '更新失败', 'add_time' => date('Y-m-d H:i:s')]);
                }
            } catch (\Exception $e) {
                $msg = ['msg' => $e->getMessage()];
                $db->insert('system_domain_update_log', ['name' => $item['name'], 'descr' => json_encode($msg), 'add_time' => date('Y-m-d H:i:s')]);
            }

            $insert = $db->insert('system_disabled_domain', ['domain' => $item['name'], 'create_at' => date('Y-m-d H:i:s')]);

        } elseif ($check === '139') {
            $db->insert('system_domain_api_log', ['name' => $item['name'], 'descr' => '用户没有权限', 'add_time' => date('Y-m-d H:i:s')]);
        } elseif ($check === '402') {
            $db->insert('system_domain_api_log', ['name' => $item['name'], 'descr' => '频率过快', 'add_time' => date('Y-m-d H:i:s')]);
        } elseif ($check === '9999') {
            $db->insert('system_domain_api_log', ['name' => $item['name'], 'descr' => 'api error', 'add_time' => date('Y-m-d H:i:s')]);
        } elseif ($check === '100') {
            $db->insert('system_domain_api_log', ['name' => $item['name'], 'descr' => 'JSON 解析出错', 'add_time' => date('Y-m-d H:i:s')]);
        } else {
            //正常的
        }
    }

    $limit += 10;//每次获取后面10条,直至数据查询为空.

} while ($read);


/** 微信域名接口检测
 * @param $apiToken  您的 API Token，在用户中心可查询到
 * @param $reqUrl    需要检测的地址或域名
 * @return code    返回码    9900:正常 | 9904:被封 | 9999:系统错误 | 139:token错误或无权限 | 402:超过调用频率  msg    错误消息    返回的错误消息
 */
function domainCheck($apiToken, $reqUrl)
{
    $url = sprintf("http://wz5.tkc8.com/manage/api/check?token=%s&url=%s", $apiToken, $reqUrl);
    $ch  = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    $responseBody = curl_exec($ch);
    file_put_contents(__DIR__.'/log.log',$reqUrl.'   '.$responseBody.'   '.date('Y-m-d H:i:s').PHP_EOL,FILE_APPEND);
    $responseArr  = json_decode($responseBody, true);
    if (json_last_error() != JSON_ERROR_NONE) {
        return '100';
    }
    if (isset($responseArr['code'])) {
        // 接口正确返回
        if ($responseArr['code'] == '9900') {
            return true;
        } else if ($responseArr['code'] == '9904') {
            return false;
        } else if ($responseArr['code'] == '139') {
            return '139';
        } else if ($responseArr['code'] == '402') {
            return '402';
        }
    } else {
        return '9999';
    }
}
