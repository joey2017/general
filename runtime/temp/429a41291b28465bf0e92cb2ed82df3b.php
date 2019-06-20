<?php /*a:2:{s:64:"D:\phpStudy\WWW\general\application\admin\view\server\index.html";i:1555147323;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
<!-- 右则内容区域 开始 -->

<div class="layui-card">
    <!--<?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?>-->
    <div class="layui-header notselect">
        <div class="pull-left"><span><?php echo htmlentities($title); ?></span></div>
        <div class="pull-right margin-right-15 nowrap">

<!--<?php if(auth("$classuri/add")): ?>-->
<button data-open='<?php echo url("$classuri/add"); ?>' data-title="添加服务器" class='layui-btn layui-btn-sm layui-btn-info'>添加服务器
</button>
<!--<?php endif; ?>-->

<!--<?php if(auth("$classuri/del")): ?>-->
<button data-update="" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'
        class='layui-btn layui-btn-sm layui-btn-danger'>删除服务器
</button>
<!--<?php endif; ?>-->

</div>
    </div>
    <!--<?php endif; ?>-->
    <div class="layui-card-body">

<!-- 表单搜索 开始 -->
<form autocomplete="off" class="layui-form layui-form-pane form-search" action="<?php echo request()->url(); ?>"
      onsubmit="return false" method="get">

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">服务器名称</label>
        <div class="layui-input-inline">
            <input name="name" value="<?php echo htmlentities(app('request')->get('name')); ?>" placeholder="请输入服务器名称" class="layui-input">
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">服务器类型</label>
        <div class="layui-input-inline">
            <select class="form-control" name="type">
                <option value="">-请选择-</option>
                <option value="1" <?php if(app('request')->get('type') == 1): ?>selected<?php endif; ?>>阿里云</option>
                <option value="2" <?php if(app('request')->get('type') == 2): ?>selected<?php endif; ?>>腾讯云</option>
                <option value="3" <?php if(app('request')->get('type') == 3): ?>selected<?php endif; ?>>华为云</option>
                <option value="4" <?php if(app('request')->get('type') == 4): ?>selected<?php endif; ?>>百度云</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item layui-inline">
        <label class="layui-form-label">服务器状态</label>
        <div class="layui-input-inline">
            <select class="form-control" name="status">
                <option value="">-请选择-</option>
                <option value="0" <?php if(app('request')->get('status') == 0 and app('request')->get('status') != ''): ?>selected<?php endif; ?>>已禁用</option>
                <option value="1" <?php if(app('request')->get('status') == 1): ?>selected<?php endif; ?>>使用中</option>
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

<!-- 表单搜索 结束 -->

<form onsubmit="return false;" data-auto="true" method="post">
    <?php if(empty($list)): ?>
    <p class="help-block text-center well">没 有 记 录 哦！</p>
    <?php else: ?>
    <input type="hidden" value="resort" name="action"/>
    <table class="layui-table" lay-skin="line" id="container">
        <thead>
        <tr>
            <th class='list-table-check-td think-checkbox'>
                <input data-auto-none="none" data-check-target='.list-check-box' type='checkbox'/>
            </th>
            <th class='list-table-sort-td'>
                <button type="submit" class="layui-btn layui-btn-normal layui-btn-xs">排 序</button>
            </th>
            <th class='text-left nowrap'>服务器</th>
            <th class='text-left nowrap'>公网IP</th>
            <th class='text-left nowrap'>内网IP</th>
            <th class='text-left nowrap'>类型</th>
            <th class='text-left nowrap'>状态</th>
            <th class='text-left nowrap'>添加时间</th>
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
            <td class='text-left nowrap'><?php echo htmlentities($vo['inner_ip']); ?></td>
            <td class='text-left nowrap'>
                <?php if($vo['type'] == 1): ?>阿里云<?php elseif($vo['type'] == 2): ?>腾讯云<?php elseif($vo['type'] == 3): ?>华为云<?php elseif($vo['type'] == 4): ?>百度云<?php elseif($vo['type'] == 5): ?>未知<?php endif; ?>
            </td>
            <td class='text-left nowrap'>
                <?php if($vo['status'] == 0): ?><span class="color-red">已禁用</span><?php elseif($vo['status'] == 1): ?><span class="color-green">使用中</span><?php endif; ?>
            </td>
            <td class='text-left nowrap'><?php echo htmlentities(format_datetime($vo['create_at'])); ?></td>
            <td class='text-left nowrap'>

                <?php if(auth("$classuri/edit")): ?>
                <span class="text-explode">|</span>
                <a data-title="编辑服务器" data-open='<?php echo url("$classuri/edit"); ?>?id=<?php echo htmlentities($vo['id']); ?>'>编辑</a>
                <?php endif; if($vo['status'] == 1 and auth("$classuri/forbid")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo htmlentities($vo['id']); ?>" data-field='status' data-value='0' data-action='<?php echo url("$classuri/forbid"); ?>'>禁用</a>
                <?php elseif(auth("$classuri/resume")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo htmlentities($vo['id']); ?>" data-field='status' data-value='1' data-action='<?php echo url("$classuri/resume"); ?>'>启用</a>
                <?php endif; if(auth("$classuri/del")): ?>
                <span class="text-explode">|</span>
                <a data-update="<?php echo htmlentities($vo['id']); ?>" data-field='delete' data-action='<?php echo url("$classuri/del"); ?>'>删除</a>
                <?php endif; if(sysconf('gg_s'.$vo['id']) == 1 and auth("$classuri/change")): ?>
                <span class="text-explode">|</span>
                <a data-gg="<?php echo htmlentities($vo['id']); ?>" data-name="gg_s<?php echo htmlentities($vo['id']); ?>" data-field='value' data-value='0' data-action='<?php echo url("$classuri/change"); ?>'>广告关闭</a>
                <?php elseif(auth("$classuri/change")): ?>
                <span class="text-explode">|</span>
                <a data-gg="<?php echo htmlentities($vo['id']); ?>" data-name="gg_s<?php echo htmlentities($vo['id']); ?>" data-field='value' data-value='1' data-action='<?php echo url("$classuri/change"); ?>'>广告开启</a>
                <?php endif; if(sysconf('dl_s'.$vo['id']) != '' and auth("$classuri/change")): ?>
                <span class="text-explode">|</span>
                <a data-dl="<?php echo htmlentities($vo['id']); ?>" data-name="dl_s<?php echo htmlentities($vo['id']); ?>" data-field='value' data-value='0' data-action='<?php echo url("$classuri/change"); ?>'>导量关闭</a>
                <?php elseif(auth("$classuri/change")): ?>
                <span class="text-explode">|</span>
                <a data-dl="<?php echo htmlentities($vo['id']); ?>" data-name="dl_s<?php echo htmlentities($vo['id']); ?>" data-field='value' data-value='1' data-action='<?php echo url("$classuri/change"); ?>'>导量开启</a>
                <?php endif; ?>

            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <script>

        /*! 注册 data-gg 事件行为 */
        $('#container td').on('click', '[data-gg]', function () {
            var id = $(this).attr('data-gg') || (function () {
                var data = [];
                return $($(this).attr('data-list-target') || 'input.list-check-box').map(function () {
                    (this.checked) && data.push(this.value);
                }), data.join(',');
            }).call(this);
            if (id.length < 1) {
                return $.msg.tips('请选择需要操作的数据！');
            }
            var name = $(this).attr('data-name');
            var action = $(this).attr('data-action');
            var value = $(this).attr('data-value') || 0;
            var msg = '确定要' + (value == 1 ? '开启' : '关闭') + '广告吗';
            $.msg.confirm(msg, function () {
                $.form.load(action, {value: value, name: name}, 'post');
            });
        });

        /*! 注册 data-dl 事件行为 */
        $('#container').off('click').on('click', '[data-dl]', function () {
            var id = $(this).attr('data-dl') || (function () {
                var data = [];
                return $($(this).attr('data-list-target') || 'input.list-check-box').map(function () {
                    (this.checked) && data.push(this.value);
                }), data.join(',');
            }).call(this);
            if (id.length < 1) {
                return $.msg.tips('请选择需要操作的数据！');
            }
            var name = $(this).attr('data-name');
            var action = $(this).attr('data-action');
            var value = $(this).attr('data-value') || 0;
            var status = value == 1 ? '开启' : '关闭';
            var msg = '确定要' + status + '导量吗';

            $.form.load('<?php echo url("$classuri/getdomain"); ?>', {id:id}, 'POST', function (res) {
                if (typeof (res) === 'object') {
                    return $.msg.auto(res);
                }
                var args = {
                    type: 1,
                    btn: ["确定","取消"],
                    area: ["350px","200px"],
                    content: res,
                    title: '导量开关设置',
                    yes: function(){
                        var dl_domain = $('select[name=dl_domain]').find('option:selected').attr('data-domain');
                        $.msg.confirm(msg, function () {
                            $.form.load(action, {value: dl_domain, name: name}, 'post');
                        });

                    },
                    btn2: function(){
                        layer.closeAll();
                    }
                };
                var layerIndex = layer.open(args);
                $.msg.dialogIndexs.push(layerIndex);
                return (typeof callback === 'function') && callback.call(this);
            });
        });

        window.laydate.render({range: true, elem: '#create_at'});
        window.form.render();
    </script>
    <?php if(isset($page)): ?><p><?php echo $page; ?></p><?php endif; ?>
    <?php endif; ?>
</form>
</div>
</div>

<!-- 右则内容区域 结束 -->