<?php /*a:2:{s:63:"D:\phpStudy\WWW\general\application\admin\view\server\form.html";i:1554882593;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
<!-- 右则内容区域 开始 -->

<div class="layui-card">
    <!--<?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?>-->
    <div class="layui-header notselect">
        <div class="pull-left"><span><?php echo htmlentities($title); ?></span></div>
        <div class="pull-right margin-right-15 nowrap"></div>
    </div>
    <!--<?php endif; ?>-->
    <div class="layui-card-body">
<form autocomplete="off" onsubmit="return false;" action="<?php echo request()->url(); ?>" data-auto="true" method="post"
      class='form-horizontal layui-form padding-top-20'>

    <div class="form-group">
        <label class="col-sm-2 control-label">服务器名称</label>
        <div class='col-sm-8'>
            <input autofocus name="name" value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:"")); ?>' required="required" title="请输入服务器" placeholder="请输入服务器" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">服务器类型</label>
        <div class='col-sm-8'>
            <select class="form-control" required="required" name="type">
                <option value="">-请选择类型-</option>
                <option value="1" <?php if(app('request')->get('id')): if($vo['type'] == 1): ?>selected<?php endif; ?><?php endif; ?>>阿里云</option>
                <option value="2" <?php if(app('request')->get('id')): if($vo['type'] == 2): ?>selected<?php endif; ?><?php endif; ?>>腾讯云</option>
                <option value="3" <?php if(app('request')->get('id')): if($vo['type'] == 3): ?>selected<?php endif; ?><?php endif; ?>>华为云</option>
                <option value="4" <?php if(app('request')->get('id')): if($vo['type'] == 4): ?>selected<?php endif; ?><?php endif; ?>>百度云</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">公网IP</label>
        <div class='col-sm-8'>
            <input autofocus name="ip" value='<?php echo htmlentities((isset($vo['ip']) && ($vo['ip'] !== '')?$vo['ip']:"")); ?>' required="required" title="请输入公网ip" placeholder="请输入公网ip" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">内网IP</label>
        <div class='col-sm-8'>
            <input autofocus name="inner_ip" value='<?php echo htmlentities((isset($vo['inner_ip']) && ($vo['inner_ip'] !== '')?$vo['inner_ip']:"")); ?>' required="required" title="请输入内网ip" placeholder="请输入内网ip" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">排序</label>
        <div class='col-sm-8'>
            <input autofocus name="sort" value='<?php echo htmlentities((isset($vo['sort']) && ($vo['sort'] !== '')?$vo['sort']:"")); ?>' title="请输入排序" placeholder="请输入排序" class="layui-input">
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

    <script>
        window.form.render();
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