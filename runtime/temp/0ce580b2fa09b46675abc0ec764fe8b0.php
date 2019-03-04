<?php /*a:2:{s:65:"D:\phpStudy\WWW\general\application\admin\view\share\circles.html";i:1551178616;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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

    <div class="form-group">
        <label class="col-sm-2 control-label">
            Title<br><span class="nowrap color-desc">分享标题</span>
        </label>
        <div class='col-sm-8'>
            <input name="circles_title" required="required" title="请输入分享标题" placeholder="请输入分享标题" value="<?php echo sysconf('circles_title'); ?>" class="layui-input">
            <p class="help-block">当前分享标题，用于自定义分享</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            Desc<br><span class="nowrap color-desc">分享描述</span>
        </label>
        <div class='col-sm-8'>
            <input name="circles_desc" required="required" title="请输入分享描述" placeholder="请输入分享描述" value="<?php echo sysconf('circles_desc'); ?>" class="layui-input">
            <p class="help-block">当前分享描述，用于自定义分享</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            SafeLink<br><span class="nowrap color-desc">分享缩略图片</span>
        </label>
        <div class='col-sm-8'>
            <input name="circles_image" required="required" title="请输入分享缩略图片" placeholder="请输入分享缩略图片" value="<?php echo sysconf('circles_image'); ?>" class="layui-input">
            <p class="help-block">当前分享缩略图片，用于自定义分享</p>
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