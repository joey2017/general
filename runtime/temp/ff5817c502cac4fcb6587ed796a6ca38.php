<?php /*a:2:{s:71:"D:\phpStudy\WWW\general\application\admin\view\advertisement\index.html";i:1551261996;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
            BackLink1<br><span class="nowrap color-desc">后退链接1</span>
        </label>
        <div class='col-sm-8'>
            <input name="back_link_1" required="required" title="请输入后退链接1" placeholder="请输入后退链接1" value="<?php echo sysconf('back_link_1'); ?>" class="layui-input">
            <p class="help-block">当前后退链接1，用于分享后展示</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            BackLink2<br><span class="nowrap color-desc">后退链接2</span>
        </label>
        <div class='col-sm-8'>
            <input name="back_link_2" required="required" title="请输入后退链接2" placeholder="请输入后退链接2" value="<?php echo sysconf('back_link_2'); ?>" class="layui-input">
            <p class="help-block">当前后退链接2，用于分享后展示</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            BackLink3<br><span class="nowrap color-desc">后退链接3</span>
        </label>
        <div class='col-sm-8'>
            <input name="back_link_3" required="required" title="请输入后退链接3" placeholder="请输入后退链接3" value="<?php echo sysconf('back_link_3'); ?>" class="layui-input">
            <p class="help-block">当前后退链接3，用于分享后展示</p>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            BottomADLink1<br><span class="nowrap color-desc">底部广告链接1</span>
        </label>
        <div class='col-sm-8'>
            <input name="ad_link_1" required="required" title="请输入广告链接1" placeholder="请输入广告链接1" value="<?php echo sysconf('ad_link_1'); ?>" class="layui-input">
            <p class="help-block">当前广告链接1，用于底部广告展示</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            BottomADImg1<br><span class="nowrap color-desc">底部广告链接图片1</span>
        </label>
        <div class='col-sm-8'>
            <img data-tips-image style="height:auto;max-height:60px;min-width:350px" src="<?php echo sysconf('ad_link_img_1'); ?>"/>
            <input type="hidden" required="required" name="ad_link_img_1" onchange="$(this).prev('img').attr('src', this.value)" value="<?php echo sysconf('ad_link_img_1'); ?>" class="layui-input">
            <a class="btn btn-link" data-file="one" data-uptype="local" data-type="ico,jpg,png" data-field="ad_link_img_1">上传图片</a>
            <p class="help-block">当前广告链接图片1，用于底部广告图片展示，建议上传图片的尺寸为350x60px，格式为jpg，png</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            BottomADLink2<br><span class="nowrap color-desc">底部广告链接2</span>
        </label>
        <div class='col-sm-8'>
            <input name="ad_link_2" required="required" title="请输入广告链接2" placeholder="请输入广告链接2" value="<?php echo sysconf('ad_link_2'); ?>" class="layui-input">
            <p class="help-block">当前广告链接2，用于底部广告展示</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            BottomADImg2<br><span class="nowrap color-desc">底部广告链接图片2</span>
        </label>
        <div class='col-sm-8'>
            <img data-tips-image style="height:auto;max-height:60px;min-width:350px" src="<?php echo sysconf('ad_link_img_2'); ?>"/>
            <input type="hidden" required="required" name="ad_link_img_2" onchange="$(this).prev('img').attr('src', this.value)" value="<?php echo sysconf('ad_link_img_2'); ?>" class="layui-input">
            <a class="btn btn-link" data-file="one" data-uptype="local" data-type="ico,jpg,png" data-field="ad_link_img_2">上传图片</a>
            <p class="help-block">当前广告链接图片2，用于底部广告图片展示，建议上传图片的尺寸为350x60px，格式为jpg，png</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            BottomADLink3<br><span class="nowrap color-desc">底部广告链接3</span>
        </label>
        <div class='col-sm-8'>
            <input name="ad_link_3" required="required" title="请输入广告链接3" placeholder="请输入广告链接3" value="<?php echo sysconf('ad_link_3'); ?>" class="layui-input">
            <p class="help-block">当前广告链接3，用于底部广告展示</p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">
            BottomADImg3<br><span class="nowrap color-desc">底部广告链接图片3</span>
        </label>
        <div class='col-sm-8'>
            <img data-tips-image style="height:auto;max-height:60px;min-width:350px" src="<?php echo sysconf('ad_link_img_3'); ?>"/>
            <input type="hidden" required="required" name="ad_link_img_3" onchange="$(this).prev('img').attr('src', this.value)" value="<?php echo sysconf('ad_link_img_3'); ?>" class="layui-input">
            <a class="btn btn-link" data-file="one" data-uptype="local" data-type="ico,jpg,png" data-field="ad_link_img_3">上传图片</a>
            <p class="help-block">当前广告链接图片3，用于底部广告图片展示，建议上传图片的尺寸为350x60px，格式为jpg，png</p>
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