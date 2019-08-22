<?php

set_time_limit(0);
$lock = __DIR__ . '/tmp.lock';

if (file_exists($lock)) {
    //exit();
}
//touch($lock);

$apiToken = '86939d2367e7813816ff16a17a1caf1f';
//$apiToken = 'b32876758a1c19084e8d34f47db6a13c';

require_once __DIR__ . '/Mysql.class.php';

//数据库信息
$database = [
    'dsn'      => "mysql:host=127.0.0.1;dbname=wx;charset=utf8",
    'username' => "wx",
    'password' => "6Xwt3TyKbWP5f5Gr"
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
    usleep(2000000);// 等待2s
    $item['name'] = trim($item['name']);
    $check        = domainCheck($apiToken,$item['name']);
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

    } elseif ($check === '9999') {
        $db->insert('system_domain_api_log', ['name' => $item['name'], 'descr' => 'api error', 'add_time' => date('Y-m-d H:i:s')]);
    } else {
        //正常的
        //$db->insert('system_domain_api_log', ['name' => $item['name'], 'status' => 1, 'descr' => 'pandanote检测域名正常', 'add_time' => date('Y-m-d H:i:s')]);
    }
}

//echo date('Y-m-d H:i:s')."    successful"."\r\n";
//unlink($lock);


/** 微信域名接口检测
 * @param $apiToken  您的 API Token，在用户中心可查询到
 * @param $reqUrl    需要检测的地址或域名
 * @return code    返回码
 *
10001	接口调用频率过快
10003	参数有误
20001	API Token 无效
20002	未购买服务或服务已过期
 */
function domainCheck($apiToken,$reqUrl)
{
    $url = sprintf("http://www.pandanote.cn/select.php?type=wx&key=%s&domain=http://%s", $apiToken, $reqUrl);
    $ch  = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    $responseBody = curl_exec($ch);
    file_put_contents(__DIR__ . '/log.log', $reqUrl . '   ' . $responseBody . '   ' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);

    $responseArr = json_decode($responseBody, true);
    if (json_last_error() != JSON_ERROR_NONE) {
        return '100';
    }
    if (isset($responseArr['error_code'])) {
        // 接口正确返回
        if ($responseArr['error_code'] == '0') {
            return true;
        } else if ($responseArr['error_code'] == '-2') {
            return false;
        } else if ($responseArr['error_code'] == '-5') {
                return '-5';
            } else if ($responseArr['error_code'] == '-3') {
                return '-3';
            }
    } else {
        return '9999';
    }
}
