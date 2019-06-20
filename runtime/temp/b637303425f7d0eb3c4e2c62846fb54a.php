<?php /*a:2:{s:64:"D:\phpStudy\WWW\general\application\admin\view\domain\index.html";i:1556003709;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
<!-- 右则内容区域 开始 -->

<div class="layui-card">
    <!--<?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?>-->
    <div class="layui-header notselect">
        <div class="pull-left"><span><?php echo htmlentities($title); ?></span></div>
        <div class="pull-right margin-right-15 nowrap">

<!--<?php if(auth("$classuri/add")): ?>-->
<button data-open='<?php echo url("$classuri/add"); ?>' data-title="添加域名" class='layui-btn layui-btn-sm layui-btn-info'>添加域名</button>
<!--<?php endif; ?>-->

<!--<?php if(auth("$classuri/del")): ?>-->
<button data-update="" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>' class='layui-btn layui-btn-sm layui-btn-danger'>删除域名</button>
<!--<?php endif; ?>-->

</div>
    </div>
    <!--<?php endif; ?>-->
    <div class="layui-card-body">

<!-- 表单搜索 开始 -->
<form autocomplete="off" class="layui-form layui-form-pane form-search" action="<?php echo request()->url(); ?>" onsubmit="return false" method="get">

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">域名名称</label>
        <div class="layui-input-inline">
            <input name="name" value="<?php echo htmlentities(app('request')->get('name')); ?>" placeholder="请输入域名名称" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">域名类型</label>
        <div class="layui-input-inline">
            <select class="form-control" name="type">
                <option value="">-请选择-</option>
                <option value="1" <?php if(app('request')->get('type') == 1): ?>selected<?php endif; ?>>入口域名</option>
                <option value="2" <?php if(app('request')->get('type') == 2): ?>selected<?php endif; ?>>落地域名</option>
                <option value="3" <?php if(app('request')->get('type') == 3): ?>selected<?php endif; ?>>跳转域名</option>
                <option value="4" <?php if(app('request')->get('type') == 4): ?>selected<?php endif; ?>>播放域名</option>
                <option value="5" <?php if(app('request')->get('type') == 5): ?>selected<?php endif; ?>>广告域名</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">域名状态</label>
        <div class="layui-input-inline">
            <select class="form-control" name="status">
                <option value="">-请选择-</option>
                <option value="0" <?php if(app('request')->get('status') == 0 and app('request')->get('status') != ''): ?>selected<?php endif; ?>>已禁用</option>
                <option value="1" <?php if(app('request')->get('status') == 1): ?>selected<?php endif; ?>>使用中</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">绑定ip</label>
        <div class="layui-input-inline">
            <select class="form-control" name="server_id">
                <option value="">-请选择-</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">添加时间</label>
        <div class="layui-input-inline">
            <input name="create_at" id="create_at" value="<?php echo htmlentities(app('request')->get('create_at')); ?>" placeholder="请选择添加时间" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <button class="layui-btn layui-btn-normal"><i class="layui-icon">&#xe615;</i> 搜 索</button>
    </div>

</form>

<script>
    window.laydate.render({range: true, elem: '#create_at'});
    window.form.render();
    $(function(){
        var server_id = '<?php echo htmlentities(app('request')->get('server_id')); ?>';
        $.post('admin/domain/getIps', {}, function (data) {
            var html = '<option value="">-请选择-</option>';
            if (data.length > 0) {
                $.each(data, function (i, v) {
                    html += '<option value="' + v.id + '" '+ (server_id == v.id ? 'selected' : '') +'>' + v.ip + '('+ v.name +')' + '</option>';
                });

            } else {
                html += '<option value="0">暂无可用ip</option>';
            }
            $('select[name=server_id]').html(html);
            window.form.render();
        }, 'json');
    });
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
            <th class='text-left nowrap'>域名</th>
            <th class='text-left nowrap'>绑定ip</th>
            <th class='text-left nowrap'>类型</th>
            <th class='text-left nowrap'>状态</th>
            <th class='text-left nowrap'>备注</th>
            <th class='text-left nowrap'>添加时间</th>
            <th class='text-left nowrap'>被封时间</th>
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
            <td class='text-left nowrap'><?php echo htmlentities($vo['ip']); ?></td>
            <td class='text-left nowrap'>
            <?php if($vo['type'] == 1): ?>入口域名<?php elseif($vo['type'] == 2): ?>落地域名<?php elseif($vo['type'] == 3): ?>跳转域名<?php elseif($vo['type'] == 4): ?>播放域名<?php elseif($vo['type'] == 5): ?>广告域名<?php endif; ?>
            </td>
            <td class='text-left nowrap'>
                <?php if($vo['status'] == 0): ?><span class="color-red">已禁用</span><?php elseif($vo['status'] == 1): ?><span class="color-green">使用中</span><?php endif; ?>
            </td>
            <td class='text-left nowrap'><?php echo htmlentities($vo['remark']); ?></td>
            <td class='text-left nowrap'><?php echo htmlentities(format_datetime($vo['create_at'])); ?></td>
            <td class='text-left nowrap'><?php echo htmlentities($vo['edit_time']); ?></td>
            <td class='text-left nowrap'>

                <?php if(auth("$classuri/edit")): ?>
                <span class="text-explode">|</span>
                <a data-title="编辑域名" data-open='<?php echo url("$classuri/edit"); ?>?id=<?php echo htmlentities($vo['id']); ?>'>编辑</a>
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