<?php /*a:2:{s:62:"D:\phpStudy\WWW\general\application\admin\view\video\form.html";i:1551865641;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
        <label class="col-sm-2 control-label">视频标题</label>
        <div class='col-sm-8'>
            <input autofocus name="title" value='<?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:"")); ?>' required="required" title="请输入视频标题" placeholder="请输入视频标题" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">视频vid</label>
        <div class='col-sm-8'>
            <input autofocus name="vid" value='<?php echo htmlentities((isset($vo['vid']) && ($vo['vid'] !== '')?$vo['vid']:"")); ?>' required="required" title="请输入视频vid" placeholder="请输入视频vid" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">视频播放暂停秒数</label>
        <div class='col-sm-8'>
            <input autofocus name="pause" value='<?php echo htmlentities((isset($vo['pause']) && ($vo['pause'] !== '')?$vo['pause']:"")); ?>' required="required" title="请输入播放暂停秒数" placeholder="请输入播放暂停秒数" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">视频播放最小阅读量</label>
        <div class='col-sm-8'>
            <input autofocus name="read_min" value='<?php echo htmlentities((isset($vo['read_min']) && ($vo['read_min'] !== '')?$vo['read_min']:"")); ?>' required="required" title="请输入最小阅读量" placeholder="请输入最小阅读量" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">视频播放最大阅读量</label>
        <div class='col-sm-8'>
            <input autofocus name="read_max" value='<?php echo htmlentities((isset($vo['read_max']) && ($vo['read_max'] !== '')?$vo['read_max']:"")); ?>' required="required" title="请输入最大阅读量" placeholder="请输入最大阅读量" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">视频封面图片链接</label>
        <div class='col-sm-8'>
            <input autofocus name="image" value='<?php echo htmlentities((isset($vo['image']) && ($vo['image'] !== '')?$vo['image']:"")); ?>' required="required" title="请输入视频封面图片链接" placeholder="请输入视频封面图片链接" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">视频点赞数</label>
        <div class='col-sm-8'>
            <input autofocus name="stars" value='<?php echo htmlentities((isset($vo['stars']) && ($vo['stars'] !== '')?$vo['stars']:"")); ?>' required="required" title="请输入点赞数" placeholder="请输入点赞数" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">排序</label>
        <div class='col-sm-8'>
            <input autofocus name="sort" value='<?php echo htmlentities((isset($vo['sort']) && ($vo['sort'] !== '')?$vo['sort']:"")); ?>' required="required" title="请输入排序" placeholder="请输入排序" class="layui-input">
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="col-sm-7 col-sm-offset-2">
        <div class="layui-form-item text-center">
            <?php if(!empty($vo['id'])): ?><input type="hidden" name="id" value="<?php echo htmlentities($vo['id']); ?>"><?php endif; ?>
            <button class="layui-btn" type="submit">保存配置</button>
            <button class="layui-btn layui-btn-danger" type='button' onclick="window.history.back()">取消编辑</button>
        </div>
    </div>

    <script>window.form.render();</script>

    <style>
        .background-item {
            padding: 15px;
            background: #efefef;
        }

        .background-item thead tr {
            background: #e0e0e0
        }
    </style>
</form>
</div>
</div>

<!-- 右则内容区域 结束 -->