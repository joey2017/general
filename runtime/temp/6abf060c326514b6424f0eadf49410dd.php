<?php /*a:2:{s:63:"D:\phpStudy\WWW\general\application\admin\view\wechat\form.html";i:1552271611;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
        <label class="col-sm-2 control-label">公众号名称</label>
        <div class='col-sm-8'>
            <input autofocus name="name" value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:"")); ?>' required="required" title="请输入公众号名称" placeholder="请输入公众号名称" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">公众号appid</label>
        <div class='col-sm-8'>
            <input autofocus name="appid" value='<?php echo htmlentities((isset($vo['appid']) && ($vo['appid'] !== '')?$vo['appid']:"")); ?>' required="required" title="请输入公众号appid" placeholder="请输入公众号appid" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">公众号appsecret</label>
        <div class='col-sm-8'>
            <input autofocus name="appsecret" value='<?php echo htmlentities((isset($vo['appsecret']) && ($vo['appsecret'] !== '')?$vo['appsecret']:"")); ?>' required="required" title="请输入公众号appsecret" placeholder="请输入公众号appsecret" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">群入口域名</label>
        <div class='col-sm-8'>
            <input autofocus name="bind_domain_qun" value='<?php echo htmlentities((isset($vo['bind_domain_qun']) && ($vo['bind_domain_qun'] !== '')?$vo['bind_domain_qun']:"")); ?>' required="required" title="请输入群入口域名" placeholder="请输入群入口域名" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">圈入口域名</label>
        <div class='col-sm-8'>
            <input autofocus name="bind_domain_quan" value='<?php echo htmlentities((isset($vo['bind_domain_quan']) && ($vo['bind_domain_quan'] !== '')?$vo['bind_domain_quan']:"")); ?>' required="required" title="请输入圈入口域名" placeholder="请输入圈入口域名" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">落地域名</label>
        <div class='col-sm-8'>
            <input autofocus name="bind_domain_ld" value='<?php echo htmlentities((isset($vo['bind_domain_ld']) && ($vo['bind_domain_ld'] !== '')?$vo['bind_domain_ld']:"")); ?>' required="required" title="请输入落地域名" placeholder="请输入落地域名" class="layui-input">
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