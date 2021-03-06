<?php /*a:2:{s:63:"D:\phpStudy\WWW\general\application\admin\view\domain\form.html";i:1554875827;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
        <label class="col-sm-2 control-label">域名</label>
        <div class='col-sm-8'>
            <input autofocus name="name" value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:"")); ?>' required="required" title="请输入域名" placeholder="请输入域名" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">类型</label>
        <div class='col-sm-8'>
            <select class="form-control" required="required" name="type">
                <option value="">-请选择类型-</option>
                <option value="1" <?php if(app('request')->get('id')): if($vo['type'] == 1): ?>selected<?php endif; ?><?php endif; ?>>入口域名</option>
                <option value="2" <?php if(app('request')->get('id')): if($vo['type'] == 2): ?>selected<?php endif; ?><?php endif; ?>>落地域名</option>
                <option value="3" <?php if(app('request')->get('id')): if($vo['type'] == 3): ?>selected<?php endif; ?><?php endif; ?>>跳转域名</option>
                <option value="4" <?php if(app('request')->get('id')): if($vo['type'] == 4): ?>selected<?php endif; ?><?php endif; ?>>播放域名</option>
                <option value="5" <?php if(app('request')->get('id')): if($vo['type'] == 5): ?>selected<?php endif; ?><?php endif; ?>>广告域名</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">绑定ip</label>
        <div class='col-sm-8'>
            <select class="form-control" required="required" name="server_id">
            </select>
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
        $(function(){
            $.post('admin/domain/getIps', {}, function (data) {
                var html = '<option value="">-请选择ip-</option>';
                if (data.length > 0) {
                    $.each(data, function (i, v) {
                        html += '<option value="' + v.id + '">' + v.ip + '('+ v.name +')' + '</option>';
                    });

                } else {
                    html += '<option value="0">暂无可用ip</option>';
                }
                $('select[name=server_id]').html(html);
                window.form.render();
            }, 'json');
        })
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