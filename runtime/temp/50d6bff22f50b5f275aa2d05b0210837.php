<?php /*a:2:{s:64:"D:\phpStudy\WWW\general\application\admin\view\wechat\index.html";i:1552975217;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1551941934;}*/ ?>
<!-- 右则内容区域 开始 -->

<div class="layui-card">
    <!--<?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?>-->
    <div class="layui-header notselect">
        <div class="pull-left"><span><?php echo htmlentities($title); ?></span></div>
        <div class="pull-right margin-right-15 nowrap"></div>
    </div>
    <!--<?php endif; ?>-->
    <div class="layui-card-body">
<form autocomplete="off" onsubmit="return false;" action="<?php echo request()->url(); ?>" data-auto="true" method="post" class='form-horizontal layui-form padding-top-20'>

    <!-- <div class="form-group">
        <label class="col-sm-2 control-label">
            AppID<br><span class="nowrap color-desc">公众号appid</span>
        </label>
        <div class='col-sm-8'>
            <input name="appid" required="required" title="请输入公众号appid" placeholder="请输入公众号appid" value="<?php echo sysconf('appid'); ?>" class="layui-input">
            <p class="help-block">当前公众号appid，用于域名绑定和自定义分享</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            AppSecret<br><span class="nowrap color-desc">公众号appsecret</span>
        </label>
        <div class='col-sm-8'>
            <input name="appsecret" required="required" title="请输入公众号secret" placeholder="请输入公众号secret" value="<?php echo sysconf('appsecret'); ?>" class="layui-input">
            <p class="help-block">当前公众号secret，用于域名绑定和自定义分享</p>
        </div>
    </div>

    <div class="hr-line-dashed"></div> -->

    <!--<div class="form-group">-->
        <!--<label class="col-sm-2 control-label">-->
            <!--SafeLink<br><span class="nowrap color-desc">落地域名</span>-->
        <!--</label>-->
        <!--<div class='col-sm-8'>-->
            <!--<input name="safe_link" required="required" title="请输入落地域名" placeholder="请输入落地域名" value="<?php echo sysconf('safe_link'); ?>" class="layui-input">-->
            <!--<p class="help-block">当前落地域名，用于视频分享后跳转</p>-->
        <!--</div>-->
    <!--</div>-->
    <!---->
    <div class="form-group">
        <label class="col-sm-2 control-label">
            SecretKey<br><span class="nowrap color-desc">数据加密secretKey</span>
        </label>
        <div class='col-sm-8'>
            <input name="secret_key" required="required" title="请输入secretKey" placeholder="请输入secretKey" value="<?php echo sysconf('secret_key'); ?>" class="layui-input">
            <p class="help-block">加密secretKey，用于url参数加密</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            UrlParam<br><span class="nowrap color-desc">入口链接URL参数</span>
        </label>
        <div class='col-sm-8'>
            <input name="url_param" required="required" title="请输入URL参数" placeholder="请输入URL参数"
                   value="<?php echo sysconf('url_param'); ?>" class="layui-input">
            <p class="help-block">当前入口链接url参数，格式：token=158616...,token值仅为数字、大小写字母</p>
        </div>
    </div>


    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            NotWXLink<br><span class="nowrap color-desc">非微信访问页</span>
        </label>
        <div class='col-sm-8'>
            <input name="not_wx_link" required="required" title="请输入非微信访问页" placeholder="请输入非微信访问页" value="<?php echo sysconf('not_wx_link'); ?>" class="layui-input">
            <p class="help-block">当前非微信访问页，用于非微信访问时跳转</p>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="col-sm-4 col-sm-offset-2">
        <div class="layui-form-item text-center">
            <button class="layui-btn" type="submit">保存配置</button>
        </div>
    </div>

</form>

</div>
</div>

<!-- 右则内容区域 结束 -->