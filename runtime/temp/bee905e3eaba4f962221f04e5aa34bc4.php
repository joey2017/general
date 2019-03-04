<?php /*a:2:{s:63:"D:\phpStudy\WWW\general\application\admin\view\video\index.html";i:1551240133;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
            VideoLink<br><span class="nowrap color-desc">视频VID</span>
        </label>
        <div class='col-sm-8'>
            <input name="video_link" required="required" title="请输入视频VID" placeholder="请输入视频VID" value="<?php echo sysconf('video_link'); ?>" class="layui-input">
            <p class="help-block">当前视频VID，用于观看及分享</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            Title<br><span class="nowrap color-desc">视频标题</span>
        </label>
        <div class='col-sm-8'>
            <input name="video_title" required="required" title="请输入视频标题" placeholder="请输入视频标题" value="<?php echo sysconf('video_title'); ?>" class="layui-input">
            <p class="help-block">当前视频标题，用于自定义分享</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            PopUp<br><span class="nowrap color-desc">播放几秒后弹出</span>
        </label>
        <div class='col-sm-8'>
            <input name="video_play_seconds" required="required" title="请输入播放秒数" placeholder="请输入播放秒数" value="<?php echo sysconf('video_play_seconds'); ?>" class="layui-input">
            <p class="help-block">当前播放秒数，用于播放几秒后弹出</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            ReadMin<br><span class="nowrap color-desc">视频最小阅读量</span>
        </label>
        <div class='col-sm-8'>
            <input name="read_min" required="required" title="请输入最小阅读量" placeholder="请输入最小阅读量" value="<?php echo sysconf('read_min'); ?>" class="layui-input">
            <p class="help-block">当前最小阅读量，用于视频阅读量设置</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            ReadMax<br><span class="nowrap color-desc">视频最大阅读量</span>
        </label>
        <div class='col-sm-8'>
            <input name="read_max" required="required" title="请输入最大阅读量" placeholder="请输入最大阅读量" value="<?php echo sysconf('read_max'); ?>" class="layui-input">
            <p class="help-block">当前最大阅读量，用于视频阅读量设置</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            ReadMax<br><span class="nowrap color-desc">视频点赞数</span>
        </label>
        <div class='col-sm-8'>
            <input name="stars" required="required" title="请输入点赞数" placeholder="请输入点赞数" value="<?php echo sysconf('stars'); ?>" class="layui-input">
            <p class="help-block">当前视频点赞数，用于视频点赞数设置</p>
        </div>
    </div>

    <div class="col-sm-4 col-sm-offset-2">
        <div class="layui-form-item text-center">
            <button class="layui-btn" type="submit">保存配置</button>
        </div>
    </div>

</form>

</div>
</div>

<!-- 右则内容区域 结束 -->