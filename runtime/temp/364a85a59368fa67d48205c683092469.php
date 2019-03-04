<?php /*a:2:{s:63:"D:\phpStudy\WWW\general\application\admin\view\domain\form.html";i:1551666268;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
            <input autofocus name="name" value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:"")); ?>' required="required" title="请输入带http或https的域名"
                   placeholder="请输入带http或https的域名" class="layui-input">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">类型</label>
        <div class='col-sm-8'>
            <select class="form-control" required="required" name="type">
                <option>-请选择类型-</option>
                <option value="1">入口域名</option>
                <option value="2">落地域名</option>
                <!--<option value="3">跳转域名</option>-->
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">绑定公众号</label>
        <div class='col-sm-8'>
            <select class="form-control" required="required" name="app_id">
               
            </select>
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
            $.post('admin/domain/getApps', {}, function (data) {
                console.log(data);
                var html = '-请选择公众号-';
                if (data.length > 0) {
                    $.each(data, function (i, v) {
                        html += '<option value="' + v.id + '">' + v.name + '</option>';
                    });

                } else {
                    html += '<option value="">暂无可用公众号</option>';
                }
                $('select[name=app_id]').html(html);
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