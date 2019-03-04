<?php
include '../config.php';
$jssdk       = new JSSDK($appid, $appsecret);
$signPackage = $jssdk->getSignPackage($_GET['url']);

echo $_GET['callback'] . '(' . json_encode(array(
        'c_url_back'           => 'window.location.href = "' . $url_back . '";',
        'c_url'                => 'window.location.href = "' . $url . '";',
        'config'               => array(
            'debug'     => false,
            'appId'     => $signPackage['appId'],
            'timestamp' => $signPackage['timestamp'],
            'nonceStr'  => $signPackage['nonceStr'],
            'signature' => $signPackage['signature'],
            'jsApiList' => array(
                'checkJsApi',
                'onMenuShareTimeline',
                'hideOptionMenu',
                'onMenuShareAppMessage',
                'hideMenuItems',
                'showMenuItems'
            )
        ),
        'share_app_info'       => array(
            'desc'    => $app_desc,
            'img_url' => $app_img,
            'title'   => $app_title,
            'link'    => $app_link,
        ),
        'share_app_info1'      => array(
            'desc'    => $app_desc2,
            'img_url' => $app_img2,
            'title'   => $app_title2,
            'link'    => $app_link2,
        ),
        'share_timeline_info'  => array(
            'title'   => $timeline_title,
            'img_url' => $timeline_img,
            'link'    => $timeline_link,
        ),
        'share_timeline_info2' => array(
            'title'   => $timeline_title2,
            'img_url' => $timeline_img2,
            'link'    => $timeline_link2,
        )
    )) . ')';

class JSSDK
{
    private $appId;
    private $appSecret;

    public function __construct($appId, $appSecret)
    {
        $this->appId     = $appId;
        $this->appSecret = $appSecret;
    }

    public function getSignPackage($url)
    {
        $jsapiTicket = $this->getJsApiTicket();
        $timestamp   = time();
        $nonceStr    = $this->createNonceStr();
        $string      = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str   = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket()
    {
        $file = 'jsapi_ticket.json';
        if (!file_exists($file)) {
            file_put_contents($file, '');
        }
        $data = json_decode(file_get_contents($file));
        if (empty($data) || $data->expire_time < time()) {
            $accessToken = $this->getAccessToken();
            $url         = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res         = json_decode($this->httpGet($url));
            $ticket      = $res->ticket;
            if ($ticket) {
                $data               = new stdClass();
                $data->expire_time  = time() + 4000;
                $data->jsapi_ticket = $ticket;
                file_put_contents($file, json_encode($data));
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }

        return $ticket;
    }

    private function getAccessToken()
    {
        $file = 'access_token.json';
        if (!file_exists($file)) {
            file_put_contents($file, '');
        }
        $data = json_decode(file_get_contents($file));
        if (empty($data) || $data->expire_time < time()) {
            $url          = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
            $res          = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data               = new stdClass();
                $data->expire_time  = time() + 4000;
                $data->access_token = $access_token;
                file_put_contents($file, json_encode($data));
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    private function httpGet($url)
    {
        return file_get_contents($url);
    }
}

?>