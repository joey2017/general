<?php /*a:2:{s:63:"D:\phpStudy\WWW\general\application\admin\view\config\file.html";i:1550126539;s:66:"D:\phpStudy\WWW\general\application\admin\view\public\content.html";i:1550126539;}*/ ?>
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
        <label class="col-sm-2 control-label label-required">
            Storage<br><span class="nowrap color-desc">存储引擎</span>
        </label>
        <div class='col-sm-8'>
            <?php foreach(['local'=>'本地服务器存储','qiniu'=>'七牛云存储','oss'=>'阿里云OSS存储'] as $k=>$v): ?>
            <label class="think-radio">
                <!--<?php if(sysconf('storage_type') == $k): ?>-->
                <input checked type="radio" name="storage_type" value="<?php echo htmlentities($k); ?>" title="<?php echo htmlentities($v); ?>" lay-ignore>
                <!--<?php else: ?>-->
                <input type="radio" name="storage_type" value="<?php echo htmlentities($k); ?>" title="<?php echo htmlentities($v); ?>" lay-ignore>
                <!--<?php endif; ?>-->
                <?php echo htmlentities($v); ?>
            </label>
            <?php endforeach; ?>
            <div class="help-block" data-storage-type="local">
                文件存储在本地服务器，请确保服务器的 ./static/upload/ 目录有写入权限
            </div>
            <div class="help-block" data-storage-type="qiniu">
                若还没有七牛云帐号，可<a target="_blank" href="https://portal.qiniu.com/signup?code=3lhz6nmnwbple">免费申请10G存储</a>，申请成功后添加公开bucket。
            </div>
            <div class="help-block" data-storage-type="oss">
                若还没有OSS存储账号, 可<a target="_blank" href="https://oss.console.aliyun.com">创建阿里云OSS存储</a>，需要配置OSS公开访问及跨域策略。
            </div>
        </div>
    </div>

    <div class="hr-line-dashed"></div>

    <div class="form-group" data-storage-type="local">
        <label class="col-sm-2 control-label">
            AllowExts<br><span class="nowrap color-desc">允许类型</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_local_exts" required="required" value="<?php echo sysconf('storage_local_exts'); ?>"
                   title="请输入系统文件上传后缀" placeholder="请输入系统文件上传后缀" class="layui-input">
            <p class="help-block">设置系统允许上传文件的后缀，多个以英文逗号隔开。如：png,jpg,rar,doc</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="qiniu">
        <label class="col-sm-2 control-label label-required">
            Region<br><span class="nowrap color-desc">存储区域</span>
        </label>
        <div class='col-sm-8'>
            <?php foreach(['华东','华北','华南','北美'] as $area): ?>
            <label class="think-radio">
                <!--<?php if(sysconf('storage_qiniu_region') == $area): ?>-->
                <input checked type="radio" name="storage_qiniu_region" value="<?php echo htmlentities($area); ?>" lay-ignore>
                <!--<?php else: ?>-->
                <input type="radio" name="storage_qiniu_region" value="<?php echo htmlentities($area); ?>" lay-ignore>
                <!--<?php endif; ?>-->
                <?php echo htmlentities($area); ?>
            </label>
            <?php endforeach; ?>
            <p class="help-block">七牛云存储空间所在区域，需要严格对应储存所在区域才能上传文件。</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="qiniu">
        <label class="col-sm-2 control-label label-required">
            Protocol<br><span class="nowrap color-desc">访问协议</span>
        </label>
        <div class='col-sm-8'>
            <!--<?php foreach(['http','https','auto'] as $pro): ?>-->
            <label class="think-radio">
                <!--<?php if(sysconf('storage_qiniu_is_https') == $pro): ?>-->
                <input checked type="radio" name="storage_qiniu_is_https" value="<?php echo htmlentities($pro); ?>" lay-ignore> <?php echo htmlentities($pro); ?>
                <!--<?php else: ?>-->
                <input type="radio" name="storage_qiniu_is_https" value="<?php echo htmlentities($pro); ?>" lay-ignore> <?php echo htmlentities($pro); ?>
                <!--<?php endif; ?>-->
            </label>
            <!--<?php endforeach; ?>-->
            <p class="help-block">七牛云存储访问协议（http、https、auto），其中 https 需要配置证书才能使用，auto 为相对协议自动根据域名切换http与https。</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="qiniu">
        <label class="col-sm-2 control-label">
            Bucket<br><span class="nowrap color-desc">空间名称</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_qiniu_bucket" required="required" value="<?php echo sysconf('storage_qiniu_bucket'); ?>"
                   title="请输入七牛云存储 Bucket (空间名称)" placeholder="请输入七牛云存储 Bucket (空间名称)" class="layui-input">
            <p class="help-block">填写七牛云存储空间名称，如：static</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="qiniu">
        <label class="col-sm-2 control-label">
            Domain<br><span class="nowrap color-desc">访问域名</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_qiniu_domain" required="required" value="<?php echo sysconf('storage_qiniu_domain'); ?>"
                   title="请输入七牛云存储 Domain (访问域名)" placeholder="请输入七牛云存储 Domain (访问域名)" class="layui-input">
            <p class="help-block">填写七牛云存储访问域名，如：static.ctolog.cc</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="qiniu">
        <label class="col-sm-2 control-label">
            AccessKey<br><span class="nowrap color-desc">访问密钥</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_qiniu_access_key" required="required" value="<?php echo sysconf('storage_qiniu_access_key'); ?>"
                   title="请输入七牛云 AccessKey (访问密钥)" placeholder="请输入七牛云 AccessKey (访问密钥)" class="layui-input">
            <p class="help-block">可以在 [ 七牛云 > 个人中心 ] 设置并获取到访问密钥。</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="qiniu">
        <label class="col-sm-2 control-label">
            SecretKey<br><span class="nowrap color-desc">安全密钥</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_qiniu_secret_key" required="required" value="<?php echo sysconf('storage_qiniu_secret_key'); ?>" maxlength="43"
                   title="请输入七牛云 SecretKey (安全密钥)" placeholder="请输入七牛云 SecretKey (安全密钥)" class="layui-input">
            <p class="help-block">可以在 [ 七牛云 > 个人中心 ] 设置并获取到安全密钥。</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="oss">
        <label class="col-sm-2 control-label label-required">
            Protocol<br><span class="nowrap color-desc">访问协议</span>
        </label>
        <div class='col-sm-8'>
            <!--<?php foreach(['http','https','auto'] as $pro): ?>-->
            <label class="think-radio">
                <!--<?php if(sysconf('storage_oss_is_https') == $pro): ?>-->
                <input checked type="radio" name="storage_oss_is_https" value="<?php echo htmlentities($pro); ?>" lay-ignore> <?php echo htmlentities($pro); ?>
                <!--<?php else: ?>-->
                <input type="radio" name="storage_oss_is_https" value="<?php echo htmlentities($pro); ?>" lay-ignore> <?php echo htmlentities($pro); ?>
                <!--<?php endif; ?>-->
            </label>
            <!--<?php endforeach; ?>-->
            <p class="help-block">阿里云对象存储访问协议（http、https、auto），其中 https 需要配置证书才能使用，auto 为相对协议自动根据域名切换http与https。</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="oss">
        <label class="col-sm-2 control-label">
            Bucket<br><span class="nowrap color-desc">空间名称</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_oss_bucket" required="required" value="<?php echo sysconf('storage_oss_bucket'); ?>"
                   title="请输入OSS Bucket (空间名称)" placeholder="请输入OSS Bucket (空间名称)" class="layui-input">
            <p class="help-block">填写OSS存储空间名称，如：think-admin-oss</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="oss">
        <label class="col-sm-2 control-label">
            EndPoint<br><span class="nowrap color-desc">数据中心</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_oss_endpoint" required="required" value="<?php echo sysconf('storage_oss_endpoint'); ?>"
                   title="请输入OSS数据中心访问域名 (访问域名)" placeholder="请输入OSS数据中心访问域名 (访问域名)" class="layui-input">
            <p class="help-block">填写OSS数据中心访问域名，如：oss-cn-shenzhen.aliyuncs.com</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="oss">
        <label class="col-sm-2 control-label">
            Domain<br><span class="nowrap color-desc">访问域名</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_oss_domain" required="required" value="<?php echo sysconf('storage_oss_domain'); ?>"
                   title="请输入OSS存储 Domain (访问域名)" placeholder="请输入OSS存储 Domain (访问域名)" class="layui-input">
            <p class="help-block">填写OSS存储外部访问域名，如：think-admin-oss.oss-cn-shenzhen.aliyuncs.com</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="oss">
        <label class="col-sm-2 control-label">
            AccessKey<br><span class="nowrap color-desc">访问密钥</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_oss_keyid" required="required" value="<?php echo sysconf('storage_oss_keyid'); ?>" maxlength="16"
                   title="请输入16位OSS AccessKey (访问密钥)" placeholder="请输入OSS AccessKey (访问密钥)" class="layui-input">
            <p class="help-block">可以在 [ 阿里云 > 个人中心 ] 设置并获取到访问密钥。</p>
        </div>
    </div>

    <div class="form-group" data-storage-type="oss">
        <label class="col-sm-2 control-label">
            SecretKey<br><span class="nowrap color-desc">安全密钥</span>
        </label>
        <div class='col-sm-8'>
            <input type="text" name="storage_oss_secret" required="required" value="<?php echo sysconf('storage_oss_secret'); ?>" maxlength="30"
                   title="请输入30位OSS SecretKey (安全密钥)" placeholder="请输入OSS SecretKey (安全密钥)" class="layui-input">
            <p class="help-block">可以在 [ 阿里云 > 个人中心 ] 设置并获取到安全密钥。</p>
        </div>
    </div>


    <div class="hr-line-dashed"></div>

    <div class="col-sm-4 col-sm-offset-2">
        <div class="layui-form-item text-center">
            <button class="layui-btn" type="submit">保存配置</button>
        </div>
    </div>

</form>
</div>
</div>

<script>
    (function () {
        window.form.render();
        buildForm('<?php echo sysconf("storage_type"); ?>');
        $('[name=storage_type]').on('click', function () {
            buildForm($('[name=storage_type]:checked').val())
        });

        // 表单显示编译
        function buildForm(value) {
            var $tips = $("[data-storage-type='" + value + "']");
            $("[data-storage-type]").not($tips.show()).hide();
        }
    })();
</script>

<!-- 右则内容区域 结束 -->