<?php /*a:2:{s:66:"D:\phpStudy\WWW\general\application\admin\view\wechat\applist.html";i:1552445898;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
<!-- 右则内容区域 开始 -->

<div class="layui-card">
    <!--<?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?>-->
    <div class="layui-header notselect">
        <div class="pull-left"><span><?php echo htmlentities($title); ?></span></div>
        <div class="pull-right margin-right-15 nowrap">

<!--<?php if(auth("$classuri/fresh")): ?>-->
<button data-open='<?php echo url("$classuri/fresh"); ?>' data-title="刷新token" class='layui-btn layui-btn-sm layui-btn-info'>刷新token</button>
<!--<?php endif; ?>-->

<!--<?php if(auth("$classuri/add")): ?>-->
<button data-open='<?php echo url("$classuri/add"); ?>' data-title="添加公众号" class='layui-btn layui-btn-sm layui-btn-primary'>添加公众号</button>
<!--<?php endif; ?>-->

<!--<?php if(auth("$classuri/del")): ?>-->
<button data-update="" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>' class='layui-btn layui-btn-sm layui-btn-primary'>删除公众号</button>
<!--<?php endif; ?>-->

</div>
    </div>
    <!--<?php endif; ?>-->
    <div class="layui-card-body">

<!-- 表单搜索 开始 -->
<form autocomplete="off" class="layui-form layui-form-pane form-search" action="<?php echo request()->url(); ?>" onsubmit="return false" method="get">

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">公众号名称</label>
        <div class="layui-input-inline">
            <input name="name" value="<?php echo htmlentities(app('request')->get('name')); ?>" placeholder="请输入公众号名称" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">添加时间</label>
        <div class="layui-input-inline">
            <input name="create_at" id="create_at" value="<?php echo htmlentities(app('request')->get('create_at')); ?>" placeholder="请选择添加时间" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button>
    </div>

</form>

<script>
    window.laydate.render({range: true, elem: '#create_at'});
    window.form.render();
</script>
<!-- 表单搜索 结束 -->

<form onsubmit="return false;" data-auto="true" method="post">
    <?php if(empty($list)): ?>
    <p class="help-block text-center well">没 有 记 录 哦！</p>
    <?php else: ?>
    <input type="hidden" value="resort" name="action"/>
    <table class="layui-table" lay-skin="line">
        <thead>
        <tr>
            <th class='list-table-check-td think-checkbox'>
                <input data-auto-none="none" data-check-target='.list-check-box' type='checkbox'/>
            </th>
            <th class='list-table-sort-td'>
                <button type="submit" class="layui-btn layui-btn-normal layui-btn-xs">排 序</button>
            </th>
            <th class='text-left nowrap'>公众号名称</th>
            <th class='text-left nowrap'>公众号appid</th>
            <th class='text-left nowrap'>公众号appsecret</th>
            <!-- <th class='text-left nowrap'>公众号access_token</th> -->
            <th class='text-left nowrap'>公众号access_token到期时间</th>
            <!-- <th class='text-left nowrap'>公众号jsapi_ticket</th> -->
            <th class='text-left nowrap'>公众号jsapi_ticket到期时间</th>
            <th class='text-left nowrap'>群入口域名</th>
            <th class='text-left nowrap'>圈入口域名</th>
            <th class='text-left nowrap'>落地域名</th>
            <th class='text-left nowrap'>添加时间</th>
            <th class='text-left nowrap'>公众号状态</th>
            <th class='text-left'>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($list as $key=>$vo): ?>
        <tr>
            <td class='list-table-check-td think-checkbox'>
                <input class="list-check-box" value='<?php echo htmlentities($vo['id']); ?>' type='checkbox'/>
            </td>
            <td class='list-table-sort-td'>
                <input name="_<?php echo htmlentities($vo['id']); ?>" value="<?php echo htmlentities($vo['sort']); ?>" class="list-sort-input"/>
            </td>
            <td class='text-left nowrap'><?php echo htmlentities($vo['name']); ?></td>
            <td class='text-left nowrap'><?php echo htmlentities($vo['appid']); ?></td>
            <td class='text-left nowrap'><?php echo htmlentities($vo['appsecret']); ?></td>
            <!-- <td class='text-left nowrap'><?php echo htmlentities($vo['access_token']); ?></td> -->
            <td class='text-left nowrap'><?php echo htmlentities($vo['access_token_expire_time']); ?></td>
            <!-- <td class='text-left nowrap'><?php echo htmlentities($vo['jsapi_ticket']); ?></td> -->
            <td class='text-left nowrap'><?php echo htmlentities($vo['jsapi_ticket_expire_time']); ?></td>
            <td class='text-left nowrap'><?php echo htmlentities($vo['bind_domain_qun']); ?></td>
            <td class='text-left nowrap'><?php echo htmlentities($vo['bind_domain_quan']); ?></td>
            <td class='text-left nowrap'><?php echo htmlentities($vo['bind_domain_ld']); ?></td>
            <td class='text-left nowrap'><?php echo htmlentities(format_datetime($vo['create_at'])); ?></td>
            <td class='text-left nowrap'>
                <?php if($vo['status'] == 0): ?><span class="color-red">已禁用</span><?php elseif($vo['status'] == 1): ?><span class="color-green">使用中</span><?php endif; ?>
            </td>
            <td class='text-left nowrap'>

                <?php if(auth("$classuri/edit")): ?>
                <span class="text-explode">|</span>
                <a data-title="编辑公众号" data-open='<?php echo url("$classuri/edit"); ?>?id=<?php echo htmlentities($vo['id']); ?>'>编辑</a>
                <?php endif; if($vo['status'] == 1 and auth("$classuri/forbid")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo htmlentities($vo['id']); ?>" data-field='status' data-value='0' data-action='<?php echo url("$classuri/forbid"); ?>'>禁用</a>
                <?php elseif(auth("$classuri/resume")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo htmlentities($vo['id']); ?>" data-field='status' data-value='1' data-action='<?php echo url("$classuri/resume"); ?>'>启用</a>
                <?php endif; if(auth("$classuri/del")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo htmlentities($vo['id']); ?>" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'>删除</a>
                <?php endif; ?>

            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php if(isset($page)): ?><p><?php echo $page; ?></p><?php endif; ?>
    <?php endif; ?>
</form>
</div>
</div>

<!-- 右则内容区域 结束 -->