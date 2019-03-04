<?php
include 'config.php';
if(stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false || stripos($_SERVER['HTTP_USER_AGENT'], 'Wechat') === false){
	exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
        <title></title>
        <script src="//apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//cdn.bootcss.com/zepto/1.0rc1/zepto.min.js"></script>
        <link href="assets/css.css?v=1.0" rel="stylesheet"/>
        <style>
			#chai{margin-top: -50px;}
			div.a69306{-webkit-animation:afive 5s both;-moz-animation:afive 5s both;-ms-animation:afive 5s both;animation:afive 5s both}@keyframes afive{0%{transform:scale(1);transform:scale(1)}70%,73%{transform:scale(1);transform:scale(1)}77.5%{transform:translate(4px,3px)}78%{transform:translate(4px,-4px)}78.5%{transform:translate(3px,-4px)}79%{transform:translate(-4px,-4px)}79.5%{transform:translate(-4px,3px)}80%{transform:translate(-4px,4px)}80.5%{transform:translate(3px,4px)}81%{transform:translate(0,0)}100%{transform:scale(1) rotate(0);transform:scale(1) rotate(0)}}
		</style>
        <script src=//res.wx.qq.com/open/js/jweixin-1.0.0.js></script>
        <script src="assets/share.fx.js?ver=9999666" charset="UTF-8"></script>
    </head>
    <body style="margin:0 auto;background:#000;">
        <script>var minnum = 60; var maxnum = 120;$('body').on('touchmove', function (event) {event.preventDefault();});</script>
		<script src="assets/weiqun.js" charset="UTF-8"></script>
<?php if(!empty($ads)): $ad = $ads[mt_rand(0, count($ads)-1)];?>
		<div class="a69306" style="position: fixed; z-index: 2147483646; left: 0px; width:100%; height:auto; text-align: center; background-color: rgba(0, 0, 0, 0.64); box-shadow: rgba(0, 0, 0, 0.1) 0px -1px 1px; bottom: 0px;"><div style="position:relative;display:inline-block; zoom:1; vertical-align:middle; text-align:left;margin:0px auto;width:100%;"><div style="background:rgba(0,0,0,0.1);position:absolute;top:0px;right:0px;width:20px;text-align:center;color:#ffffff;font-size:12px;line-height:20px;font-family:Arial;height:20px;z-index:2147483647;" id="c69306">X</div><a target="_self" href="<?php echo $ad['link'];?>" id="v_ads"><img src="<?php echo $ad['img'];?>" border="0" width="100%"></a></div>
<?php endif;?>
	</body>
    <div style="display:none;"></div>
</html>