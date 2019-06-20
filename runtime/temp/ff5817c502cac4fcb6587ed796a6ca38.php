<?php /*a:2:{s:71:"D:\phpStudy\WWW\general\application\admin\view\advertisement\index.html";i:1555401733;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
            FanHui<br><span class="nowrap color-desc">返回开关</span>
        </label>
        <div class='col-sm-8'>
            <input name="fanhui" required="required" title="请输入fanhui参数" placeholder="请输入fanhui参数" value="<?php echo sysconf('fanhui'); ?>" class="layui-input">
            <p class="help-block">值为0表示关，值为1表示开</p>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            Gg_item<br><span class="nowrap color-desc">底部广告下标</span>
        </label>
        <div class='col-sm-8'>
            <input name="gg_item" required="required" title="请输入底部广告下标" placeholder="请输入广告链接1" value="<?php echo sysconf('gg_item'); ?>" class="layui-input">
            <p class="help-block">当前底部广告下标，用于底部广告链接跳转</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            Gg_img<br><span class="nowrap color-desc">广告图片</span>
        </label>
        <div class='col-sm-8'>
            <input name="gg_img" required="required" title="请输入gg_img参数" placeholder="请输入gg_img参数" value="<?php echo sysconf('gg_img'); ?>" class="layui-input">
            <p class="help-block">多个值以英文逗号,隔开</p>
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