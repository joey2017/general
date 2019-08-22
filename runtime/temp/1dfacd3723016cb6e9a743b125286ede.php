<?php /*a:2:{s:62:"D:\phpStudy\WWW\general\application\admin\view\share\form.html";i:1563264987;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
    <input type="hidden" name="type" value="<?php echo htmlentities(app('request')->get('type')); ?>">
    <div class="form-group">
        <label class="col-sm-2 control-label">提示语名称</label>
        <div class='col-sm-8'>
            <input autofocus name="name" value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:"")); ?>' required="required" title="请输入提示语名称" placeholder="请输入提示语名称" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">分享描述</label>
        <div class='col-sm-8'>
            <input autofocus name="desc" value='<?php echo htmlentities((isset($vo['desc']) && ($vo['desc'] !== '')?$vo['desc']:"")); ?>' required="required" title="请输入分享描述" placeholder="请输入分享描述" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">提示语排序</label>
        <div class='col-sm-8'>
            <input autofocus name="sort" value='<?php echo htmlentities((isset($vo['sort']) && ($vo['sort'] !== '')?$vo['sort']:"")); ?>' required="required" title="请输入提示语排序" placeholder="请输入提示语排序" class="layui-input">
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