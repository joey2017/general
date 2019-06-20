<?php /*a:2:{s:70:"D:\phpStudy\WWW\general\application\admin\view\advertisement\form.html";i:1554711066;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
        <label class="col-sm-2 control-label">广告位标题</label>
        <div class='col-sm-8'>
            <input autofocus name="title" value='<?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:"")); ?>' required="required" title="请输入广告位标题" placeholder="请输入广告位标题" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">文件名称</label>
        <div class='col-sm-8'>
            <input autofocus name="name" value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:"")); ?>' required="required" title="请输入文件名称" placeholder="请输入文件名称" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">广告位描述</label>
        <div class='col-sm-8'>
            <textarea placeholder="请输入广告位描述" title="请输入广告位描述" class="layui-textarea" name="desc"><?php echo htmlentities((isset($vo['desc']) && ($vo['desc'] !== '')?$vo['desc']:"")); ?></textarea>
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

    <script>
        /*! 实例富文本编辑器  */
        require(['ckeditor'], function () {
            window.createEditor('[name="detail"]', {height: 500});
        });
    </script>
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