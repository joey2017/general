/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : 127.0.0.1:3306
Source Database       : admin_v3

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-02-28 11:23:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for system_app
-- ----------------------------
DROP TABLE IF EXISTS `system_app`;
CREATE TABLE `system_app` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT '' COMMENT '二维码图片',
  `appid` varchar(64) DEFAULT '' COMMENT '二维码名称',
  `appsecret` varchar(64) DEFAULT NULL COMMENT '二维码描述',
  `access_token` varchar(255) DEFAULT NULL COMMENT '二维码图文信息',
  `jsapi_ticket` varchar(255) DEFAULT NULL,
  `sort` int(11) unsigned DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '二维码状态(1有效,0无效)',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT '删除状态(1删除,0未删除)',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='广告页二维码';

-- ----------------------------
-- Records of system_app
-- ----------------------------
INSERT INTO `system_app` VALUES ('3', 'momo', 'wxf4e5f61fb077f79a', 'fd5fa724ea5489a1805f9ac50de8bc9c', null, null, '0', '1', '0', '2019-02-27 11:16:17');
INSERT INTO `system_app` VALUES ('4', '', 'wxf4e5f61fb077f79a', 'fd5fa724ea5489a1805f9ac50de8bc9c', null, null, '0', '1', '1', '2019-02-27 17:10:32');

-- ----------------------------
-- Table structure for system_auth
-- ----------------------------
DROP TABLE IF EXISTS `system_auth`;
CREATE TABLE `system_auth` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL COMMENT '权限名称',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '状态(1:禁用,2:启用)',
  `sort` smallint(6) unsigned DEFAULT '0' COMMENT '排序权重',
  `desc` varchar(255) DEFAULT NULL COMMENT '备注说明',
  `create_by` bigint(11) unsigned DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_auth_title` (`title`) USING BTREE,
  KEY `index_system_auth_status` (`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统权限表';

-- ----------------------------
-- Records of system_auth
-- ----------------------------

-- ----------------------------
-- Table structure for system_auth_node
-- ----------------------------
DROP TABLE IF EXISTS `system_auth_node`;
CREATE TABLE `system_auth_node` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `auth` bigint(20) unsigned DEFAULT NULL COMMENT '角色ID',
  `node` varchar(200) DEFAULT NULL COMMENT '节点路径',
  PRIMARY KEY (`id`),
  KEY `index_system_auth_auth` (`auth`) USING BTREE,
  KEY `index_system_auth_node` (`node`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统角色与节点绑定';

-- ----------------------------
-- Records of system_auth_node
-- ----------------------------

-- ----------------------------
-- Table structure for system_config
-- ----------------------------
DROP TABLE IF EXISTS `system_config`;
CREATE TABLE `system_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT '配置编码',
  `value` varchar(500) DEFAULT NULL COMMENT '配置值',
  PRIMARY KEY (`id`),
  KEY `index_system_config_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COMMENT='系统参数配置';

-- ----------------------------
-- Records of system_config
-- ----------------------------
INSERT INTO `system_config` VALUES ('1', 'app_name', '视频裂变强制分享');
INSERT INTO `system_config` VALUES ('2', 'site_name', '微信视频裂变强制分享');
INSERT INTO `system_config` VALUES ('3', 'app_version', '1.0');
INSERT INTO `system_config` VALUES ('4', 'site_copy', '©版权所有 2010-2019 讯丰科技');
INSERT INTO `system_config` VALUES ('5', 'browser_icon', 'http://dev.admin.com/static/upload/65a31898610590ae/8ff69effd33d76b9.png');
INSERT INTO `system_config` VALUES ('7', 'miitbeian', '桂ICP备16006642号-2');
INSERT INTO `system_config` VALUES ('9', 'storage_local_exts', 'png,jpg,rar,doc,icon,mp4');
INSERT INTO `system_config` VALUES ('34', 'appid', 'wxf4e5f61fb077f79a');
INSERT INTO `system_config` VALUES ('39', 'appsecret', 'fd5fa724ea5489a1805f9ac50de8bc9c');
INSERT INTO `system_config` VALUES ('43', 'safe_link', 'http://www.baidu.com');
INSERT INTO `system_config` VALUES ('44', 'share_link', 'http://www.github.com');
INSERT INTO `system_config` VALUES ('45', 'not_wx_link', 'https://www.jianshu.com');
INSERT INTO `system_config` VALUES ('46', 'back_link_1', 'https://www.jianshu.com/p/08eaf8f6046f');
INSERT INTO `system_config` VALUES ('47', 'back_link_2', 'https://www.jianshu.com/p/abe7be8df931');
INSERT INTO `system_config` VALUES ('48', 'back_link_3', 'https://www.jianshu.com/p/0736eaeb7bd8');
INSERT INTO `system_config` VALUES ('49', 'ad_link_1', 'https://www.jianshu.com/p/3997043640be');
INSERT INTO `system_config` VALUES ('50', 'ad_link_2', 'https://www.jianshu.com/p/e3f8f5e62d3b');
INSERT INTO `system_config` VALUES ('51', 'ad_link_3', 'https://www.jianshu.com/p/f0ded9c74a7e');
INSERT INTO `system_config` VALUES ('52', 'video_link', 'b0553wfuebh');
INSERT INTO `system_config` VALUES ('53', 'friend_title', '都来看看瞧瞧，不要钱，通通不要钱');
INSERT INTO `system_config` VALUES ('54', 'friend_desc', '58115');
INSERT INTO `system_config` VALUES ('55', 'friend_image', 'https://upload-images.jianshu.io/upload_images/15750393-2ce4bfb476232ec7.png');
INSERT INTO `system_config` VALUES ('56', 'circles_title', '151523daf');
INSERT INTO `system_config` VALUES ('57', 'circles_desc', 'hello');
INSERT INTO `system_config` VALUES ('58', 'circles_image', 'https://upload-images.jianshu.io/upload_images/15657969-714f794f531cc0d4.png');
INSERT INTO `system_config` VALUES ('59', 'storage_type', 'local');
INSERT INTO `system_config` VALUES ('60', 'storage_qiniu_bucket', '');
INSERT INTO `system_config` VALUES ('61', 'storage_qiniu_domain', '');
INSERT INTO `system_config` VALUES ('62', 'storage_qiniu_access_key', '');
INSERT INTO `system_config` VALUES ('63', 'storage_qiniu_secret_key', '');
INSERT INTO `system_config` VALUES ('64', 'storage_oss_bucket', '');
INSERT INTO `system_config` VALUES ('65', 'storage_oss_endpoint', '');
INSERT INTO `system_config` VALUES ('66', 'storage_oss_domain', '');
INSERT INTO `system_config` VALUES ('67', 'storage_oss_keyid', '');
INSERT INTO `system_config` VALUES ('68', 'storage_oss_secret', '');
INSERT INTO `system_config` VALUES ('69', 'video_title', '农民工被开路虎的土豪羞辱');
INSERT INTO `system_config` VALUES ('70', 'video_play_seconds', '30');
INSERT INTO `system_config` VALUES ('71', 'read_min', '1500');
INSERT INTO `system_config` VALUES ('72', 'read_max', '2000');
INSERT INTO `system_config` VALUES ('73', 'stars', '558');
INSERT INTO `system_config` VALUES ('74', 'ad_link_img_1', 'http://dev.admin.com/static/upload/f826436ad21c0c93/aeab6487da5b154e.jpg');
INSERT INTO `system_config` VALUES ('75', 'ad_link_img_2', 'http://dev.admin.com/static/upload/8357effce58a6989/5be99708dc81e095.jpg');
INSERT INTO `system_config` VALUES ('76', 'ad_link_img_3', 'http://dev.admin.com/static/upload/150ee8fdfa1be378/50782c0761362294.png');

-- ----------------------------
-- Table structure for system_log
-- ----------------------------
DROP TABLE IF EXISTS `system_log`;
CREATE TABLE `system_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip` char(15) NOT NULL DEFAULT '' COMMENT '操作者IP地址',
  `node` char(200) NOT NULL DEFAULT '' COMMENT '当前操作节点',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人用户名',
  `action` varchar(200) NOT NULL DEFAULT '' COMMENT '操作行为',
  `content` text NOT NULL COMMENT '操作内容描述',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='系统操作日志表';

-- ----------------------------
-- Records of system_log
-- ----------------------------
INSERT INTO `system_log` VALUES ('1', '127.0.0.1', 'admin/login/out', 'admin', '系统管理', '用户退出系统成功', '2019-02-26 16:38:33');
INSERT INTO `system_log` VALUES ('2', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-26 16:38:38');
INSERT INTO `system_log` VALUES ('3', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-26 16:43:13');
INSERT INTO `system_log` VALUES ('4', '127.0.0.1', 'admin/login/out', 'admin', '系统管理', '用户退出系统成功', '2019-02-26 17:09:19');
INSERT INTO `system_log` VALUES ('5', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-26 17:09:36');
INSERT INTO `system_log` VALUES ('12', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-26 18:18:10');
INSERT INTO `system_log` VALUES ('13', '127.0.0.1', 'admin/login/out', 'admin', '系统管理', '用户退出系统成功', '2019-02-26 18:37:47');
INSERT INTO `system_log` VALUES ('14', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-26 18:37:52');
INSERT INTO `system_log` VALUES ('15', '127.0.0.1', 'admin/share/friend', 'admin', '分享管理', '分享参数配置成功', '2019-02-26 18:58:30');
INSERT INTO `system_log` VALUES ('16', '127.0.0.1', 'admin/share/circles', 'admin', '分享管理', '分享参数配置成功', '2019-02-26 18:59:07');
INSERT INTO `system_log` VALUES ('17', '127.0.0.1', 'admin/login/out', 'admin', '系统管理', '用户退出系统成功', '2019-02-26 19:40:19');
INSERT INTO `system_log` VALUES ('18', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-27 08:52:42');
INSERT INTO `system_log` VALUES ('19', '127.0.0.1', 'admin/config/file', 'admin', '系统管理', '系统参数配置成功', '2019-02-27 09:25:13');
INSERT INTO `system_log` VALUES ('20', '127.0.0.1', 'admin/video/index', 'admin', '视频管理', '视频参数配置成功', '2019-02-27 10:27:51');
INSERT INTO `system_log` VALUES ('21', '127.0.0.1', 'admin/login/out', 'admin', '系统管理', '用户退出系统成功', '2019-02-27 10:58:36');
INSERT INTO `system_log` VALUES ('22', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-27 10:58:41');
INSERT INTO `system_log` VALUES ('23', '127.0.0.1', 'admin/video/index', 'admin', '视频管理', '视频参数配置成功', '2019-02-27 11:57:23');
INSERT INTO `system_log` VALUES ('24', '127.0.0.1', 'admin/video/index', 'admin', '视频管理', '视频参数配置成功', '2019-02-27 12:02:33');
INSERT INTO `system_log` VALUES ('25', '127.0.0.1', 'admin/wechat/index', 'admin', '公众号管理', '公众号参数配置成功', '2019-02-27 15:16:03');
INSERT INTO `system_log` VALUES ('26', '127.0.0.1', 'admin/wechat/index', 'admin', '公众号管理', '公众号参数配置成功', '2019-02-27 15:17:07');
INSERT INTO `system_log` VALUES ('27', '127.0.0.1', 'admin/advertisement/index', 'admin', '广告管理', '广告参数配置成功', '2019-02-27 17:46:05');
INSERT INTO `system_log` VALUES ('28', '127.0.0.1', 'admin/login/out', 'admin', '系统管理', '用户退出系统成功', '2019-02-28 08:41:20');
INSERT INTO `system_log` VALUES ('29', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-28 08:42:42');
INSERT INTO `system_log` VALUES ('30', '127.0.0.1', 'admin/login/out', 'admin', '系统管理', '用户退出系统成功', '2019-02-28 08:57:48');
INSERT INTO `system_log` VALUES ('31', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-28 08:57:55');
INSERT INTO `system_log` VALUES ('32', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-28 09:01:24');
INSERT INTO `system_log` VALUES ('33', '127.0.0.1', 'admin/config/index', 'admin', '系统管理', '系统参数配置成功', '2019-02-28 09:03:31');
INSERT INTO `system_log` VALUES ('34', '127.0.0.1', 'admin/config/index', 'admin', '系统管理', '系统参数配置成功', '2019-02-28 09:04:21');
INSERT INTO `system_log` VALUES ('35', '127.0.0.1', 'admin/login/out', 'admin', '系统管理', '用户退出系统成功', '2019-02-28 09:07:35');
INSERT INTO `system_log` VALUES ('36', '127.0.0.1', 'admin/login/index', 'admin', '系统管理', '用户登录系统成功', '2019-02-28 09:08:28');
INSERT INTO `system_log` VALUES ('37', '127.0.0.1', 'admin/login/out', 'admin', '系统管理', '用户退出系统成功', '2019-02-28 09:19:20');

-- ----------------------------
-- Table structure for system_menu
-- ----------------------------
DROP TABLE IF EXISTS `system_menu`;
CREATE TABLE `system_menu` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '名称',
  `node` varchar(200) NOT NULL DEFAULT '' COMMENT '节点代码',
  `icon` varchar(100) NOT NULL DEFAULT '' COMMENT '菜单图标',
  `url` varchar(400) NOT NULL DEFAULT '' COMMENT '链接',
  `params` varchar(500) DEFAULT '' COMMENT '链接参数',
  `target` varchar(20) NOT NULL DEFAULT '_self' COMMENT '链接打开方式',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '菜单排序',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `create_by` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `index_system_menu_node` (`node`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COMMENT='系统菜单表';

-- ----------------------------
-- Records of system_menu
-- ----------------------------
INSERT INTO `system_menu` VALUES ('1', '0', '系统设置', '', '', '#', '', '_self', '9000', '1', '10000', '2018-01-19 15:27:00');
INSERT INTO `system_menu` VALUES ('2', '10', '后台菜单', '', 'fa fa-leaf', 'admin/menu/index', '', '_self', '10', '1', '10000', '2018-01-19 15:27:17');
INSERT INTO `system_menu` VALUES ('3', '10', '系统参数', '', 'fa fa-modx', 'admin/config/index', '', '_self', '20', '1', '10000', '2018-01-19 15:27:57');
INSERT INTO `system_menu` VALUES ('8', '16', '系统日志', '', 'fa fa-code', 'admin/log/index', '', '_self', '10', '1', '0', '2018-01-24 13:52:58');
INSERT INTO `system_menu` VALUES ('10', '1', '系统管理', '', '', '#', '', '_self', '200', '1', '0', '2018-01-25 18:14:28');
INSERT INTO `system_menu` VALUES ('16', '1', '日志管理', '', '', '#', '', '_self', '400', '1', '0', '2018-02-10 16:31:15');
INSERT INTO `system_menu` VALUES ('43', '1', '广告管理', '', '', '#', '', '_self', '0', '1', '0', '2019-02-26 16:34:09');
INSERT INTO `system_menu` VALUES ('44', '43', '广告参数', '', 'fa fa-audio-description', 'admin/advertisement/index', '', '_self', '0', '1', '0', '2019-02-26 16:38:18');
INSERT INTO `system_menu` VALUES ('45', '1', '视频管理', '', '', '#', '', '_self', '0', '1', '0', '2019-02-26 16:55:34');
INSERT INTO `system_menu` VALUES ('46', '45', '视频参数', '', 'fa fa-film', 'admin/video/index', '', '_self', '0', '1', '0', '2019-02-26 16:58:12');
INSERT INTO `system_menu` VALUES ('47', '1', '公众号管理', '', '', '#', '', '_self', '0', '1', '0', '2019-02-26 17:01:29');
INSERT INTO `system_menu` VALUES ('48', '47', '公众号列表', '', 'fa fa-weixin', 'admin/wechat/applist', '', '_self', '0', '1', '0', '2019-02-27 10:54:09');
INSERT INTO `system_menu` VALUES ('49', '1', '自定义分享管理', '', '', '#', '', '_self', '0', '1', '0', '2019-02-26 18:19:15');
INSERT INTO `system_menu` VALUES ('50', '49', '好友分享设置', '', 'layui-icon layui-icon-group', 'admin/share/friend', '', '_self', '0', '1', '0', '2019-02-26 18:20:21');
INSERT INTO `system_menu` VALUES ('51', '49', '朋友圈分享设置', '', 'fa fa-qq', 'admin/share/circles', '', '_self', '0', '1', '0', '2019-02-26 18:24:32');
INSERT INTO `system_menu` VALUES ('52', '10', '文件存储配置', '', 'fa fa-fax', 'admin/config/file', '', '_self', '0', '1', '0', '2019-02-27 09:24:33');
INSERT INTO `system_menu` VALUES ('53', '43', '二维码设置', '', 'fa fa-cloud-upload', 'admin/qrcode/index', '', '_self', '0', '1', '0', '2019-02-27 09:31:43');
INSERT INTO `system_menu` VALUES ('54', '47', '公众号参数', '', 'layui-icon layui-icon-login-wechat', 'admin/wechat/index', '', '_self', '0', '1', '0', '2019-02-26 17:02:23');

-- ----------------------------
-- Table structure for system_node
-- ----------------------------
DROP TABLE IF EXISTS `system_node`;
CREATE TABLE `system_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `node` varchar(100) DEFAULT NULL COMMENT '节点代码',
  `title` varchar(500) DEFAULT NULL COMMENT '节点标题',
  `is_menu` tinyint(1) unsigned DEFAULT '0' COMMENT '是否可设置为菜单',
  `is_auth` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动RBAC权限控制',
  `is_login` tinyint(1) unsigned DEFAULT '1' COMMENT '是否启动登录控制',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `index_system_node_node` (`node`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8 COMMENT='系统节点表';

-- ----------------------------
-- Records of system_node
-- ----------------------------
INSERT INTO `system_node` VALUES ('13', 'admin', '系统设置', '0', '1', '1', '2018-05-04 11:02:34');
INSERT INTO `system_node` VALUES ('14', 'admin/auth', '权限管理', '0', '1', '1', '2018-05-04 11:06:55');
INSERT INTO `system_node` VALUES ('15', 'admin/auth/index', '权限列表', '1', '1', '1', '2018-05-04 11:06:56');
INSERT INTO `system_node` VALUES ('16', 'admin/auth/apply', '权限配置', '1', '1', '1', '2018-05-04 11:06:56');
INSERT INTO `system_node` VALUES ('17', 'admin/auth/add', '添加权限', '1', '1', '1', '2018-05-04 11:06:56');
INSERT INTO `system_node` VALUES ('18', 'admin/auth/edit', '编辑权限', '1', '1', '1', '2018-05-04 11:06:56');
INSERT INTO `system_node` VALUES ('19', 'admin/auth/forbid', '禁用权限', '1', '1', '1', '2018-05-04 11:06:56');
INSERT INTO `system_node` VALUES ('20', 'admin/auth/resume', '启用权限', '1', '1', '1', '2018-05-04 11:06:56');
INSERT INTO `system_node` VALUES ('21', 'admin/auth/del', '删除权限', '1', '1', '1', '2018-05-04 11:06:56');
INSERT INTO `system_node` VALUES ('22', 'admin/config', '系统配置', '0', '1', '1', '2018-05-04 11:08:18');
INSERT INTO `system_node` VALUES ('23', 'admin/config/index', '系统参数', '1', '1', '1', '2018-05-04 11:08:25');
INSERT INTO `system_node` VALUES ('24', 'admin/config/file', '文件存储', '1', '1', '1', '2018-05-04 11:08:27');
INSERT INTO `system_node` VALUES ('25', 'admin/log', '日志管理', '0', '1', '1', '2018-05-04 11:08:43');
INSERT INTO `system_node` VALUES ('26', 'admin/log/index', '日志管理', '1', '1', '1', '2018-05-04 11:08:43');
INSERT INTO `system_node` VALUES ('28', 'admin/log/del', '日志删除', '1', '1', '1', '2018-05-04 11:08:43');
INSERT INTO `system_node` VALUES ('29', 'admin/menu', '系统菜单', '0', '1', '1', '2018-05-04 11:09:54');
INSERT INTO `system_node` VALUES ('30', 'admin/menu/index', '菜单列表', '1', '1', '1', '2018-05-04 11:09:54');
INSERT INTO `system_node` VALUES ('31', 'admin/menu/add', '添加菜单', '1', '1', '1', '2018-05-04 11:09:55');
INSERT INTO `system_node` VALUES ('32', 'admin/menu/edit', '编辑菜单', '1', '1', '1', '2018-05-04 11:09:55');
INSERT INTO `system_node` VALUES ('33', 'admin/menu/del', '删除菜单', '1', '1', '1', '2018-05-04 11:09:55');
INSERT INTO `system_node` VALUES ('34', 'admin/menu/forbid', '禁用菜单', '1', '1', '1', '2018-05-04 11:09:55');
INSERT INTO `system_node` VALUES ('35', 'admin/menu/resume', '启用菜单', '1', '1', '1', '2018-05-04 11:09:55');
INSERT INTO `system_node` VALUES ('36', 'admin/node', '节点管理', '0', '1', '1', '2018-05-04 11:10:20');
INSERT INTO `system_node` VALUES ('37', 'admin/node/index', '节点列表', '1', '1', '1', '2018-05-04 11:10:20');
INSERT INTO `system_node` VALUES ('38', 'admin/node/clear', '清理节点', '1', '1', '1', '2018-05-04 11:10:21');
INSERT INTO `system_node` VALUES ('39', 'admin/node/save', '更新节点', '1', '1', '1', '2018-05-04 11:10:21');
INSERT INTO `system_node` VALUES ('40', 'admin/user', '系统用户', '0', '1', '1', '2018-05-04 11:10:43');
INSERT INTO `system_node` VALUES ('41', 'admin/user/index', '用户列表', '1', '1', '1', '2018-05-04 11:10:43');
INSERT INTO `system_node` VALUES ('42', 'admin/user/auth', '用户授权', '0', '1', '1', '2018-05-04 11:10:43');
INSERT INTO `system_node` VALUES ('43', 'admin/user/add', '添加用户', '0', '1', '1', '2018-05-04 11:10:43');
INSERT INTO `system_node` VALUES ('44', 'admin/user/edit', '编辑用户', '0', '1', '1', '2018-05-04 11:10:43');
INSERT INTO `system_node` VALUES ('45', 'admin/user/pass', '修改密码', '0', '1', '1', '2018-05-04 11:10:43');
INSERT INTO `system_node` VALUES ('46', 'admin/user/del', '删除用户', '0', '1', '1', '2018-05-04 11:10:43');
INSERT INTO `system_node` VALUES ('47', 'admin/user/forbid', '禁用启用', '0', '1', '1', '2018-05-04 11:10:43');
INSERT INTO `system_node` VALUES ('48', 'admin/user/resume', '启用用户', '0', '1', '1', '2018-05-04 11:10:44');
INSERT INTO `system_node` VALUES ('49', 'store', '商城管理', '0', '1', '1', '2018-05-04 11:11:28');
INSERT INTO `system_node` VALUES ('50', 'store/express', '快递公司管理', '0', '1', '1', '2018-05-04 11:11:39');
INSERT INTO `system_node` VALUES ('51', 'store/express/index', '快递公司列表', '1', '1', '1', '2018-05-04 11:11:39');
INSERT INTO `system_node` VALUES ('52', 'store/express/add', '添加快递公司', '0', '1', '1', '2018-05-04 11:11:39');
INSERT INTO `system_node` VALUES ('53', 'store/express/edit', '编辑快递公司', '0', '1', '1', '2018-05-04 11:11:39');
INSERT INTO `system_node` VALUES ('54', 'store/express/del', '删除快递公司', '0', '1', '1', '2018-05-04 11:11:39');
INSERT INTO `system_node` VALUES ('55', 'store/express/forbid', '禁用快递公司', '0', '1', '1', '2018-05-04 11:11:39');
INSERT INTO `system_node` VALUES ('56', 'store/express/resume', '启用快递公司', '0', '1', '1', '2018-05-04 11:11:40');
INSERT INTO `system_node` VALUES ('57', 'store/order', '订单管理', '0', '1', '1', '2018-05-04 11:12:14');
INSERT INTO `system_node` VALUES ('58', 'store/order/index', '订单列表', '1', '1', '1', '2018-05-04 11:12:17');
INSERT INTO `system_node` VALUES ('59', 'store/order/address', '修改地址', '0', '1', '1', '2018-05-04 11:12:19');
INSERT INTO `system_node` VALUES ('76', 'wechat', '微信管理', '0', '1', '1', '2018-05-04 11:14:59');
INSERT INTO `system_node` VALUES ('78', 'wechat/config', '微信对接管理', '0', '1', '1', '2018-05-04 11:16:20');
INSERT INTO `system_node` VALUES ('79', 'wechat/config/index', '微信对接配置', '1', '1', '1', '2018-05-04 11:16:23');
INSERT INTO `system_node` VALUES ('80', 'wechat/fans', '微信粉丝管理', '0', '1', '1', '2018-05-04 11:16:31');
INSERT INTO `system_node` VALUES ('81', 'wechat/fans/index', '微信粉丝列表', '1', '1', '1', '2018-05-04 11:16:32');
INSERT INTO `system_node` VALUES ('82', 'wechat/fans/backadd', '微信粉丝拉黑', '0', '1', '1', '2018-05-04 11:16:32');
INSERT INTO `system_node` VALUES ('83', 'wechat/fans/tagset', '设置粉丝标签', '0', '1', '1', '2018-05-04 11:16:32');
INSERT INTO `system_node` VALUES ('84', 'wechat/fans/tagadd', '添加粉丝标签', '0', '1', '1', '2018-05-04 11:16:32');
INSERT INTO `system_node` VALUES ('85', 'wechat/fans/tagdel', '删除粉丝标签', '0', '1', '1', '2018-05-04 11:16:32');
INSERT INTO `system_node` VALUES ('86', 'wechat/fans/sync', '同步粉丝列表', '0', '1', '1', '2018-05-04 11:16:32');
INSERT INTO `system_node` VALUES ('87', 'wechat/fans_block', '粉丝黑名单管理', '0', '1', '1', '2018-05-04 11:17:25');
INSERT INTO `system_node` VALUES ('88', 'wechat/fans_block/index', '粉丝黑名单列表', '1', '1', '1', '2018-05-04 11:17:50');
INSERT INTO `system_node` VALUES ('89', 'wechat/fans_block/backdel', '移除粉丝黑名单', '0', '1', '1', '2018-05-04 11:17:51');
INSERT INTO `system_node` VALUES ('90', 'wechat/keys', '微信关键字', '0', '1', '1', '2018-05-04 11:18:09');
INSERT INTO `system_node` VALUES ('91', 'wechat/keys/index', '关键字列表', '1', '1', '1', '2018-05-04 11:18:09');
INSERT INTO `system_node` VALUES ('92', 'wechat/keys/add', '添加关键字', '0', '1', '1', '2018-05-04 11:18:09');
INSERT INTO `system_node` VALUES ('93', 'wechat/keys/edit', '编辑关键字', '0', '1', '1', '2018-05-04 11:18:09');
INSERT INTO `system_node` VALUES ('94', 'wechat/keys/del', '删除关键字', '0', '1', '1', '2018-05-04 11:18:09');
INSERT INTO `system_node` VALUES ('95', 'wechat/keys/forbid', '禁用关键字', '0', '1', '1', '2018-05-04 11:18:09');
INSERT INTO `system_node` VALUES ('96', 'wechat/keys/resume', '启用关键字', '0', '1', '1', '2018-05-04 11:18:09');
INSERT INTO `system_node` VALUES ('97', 'wechat/keys/subscribe', '关注回复', '1', '1', '1', '2018-05-04 11:18:09');
INSERT INTO `system_node` VALUES ('98', 'wechat/keys/defaults', '默认回复', '1', '1', '1', '2018-05-04 11:18:09');
INSERT INTO `system_node` VALUES ('99', 'wechat/menu', '微信菜单管理', '0', '1', '1', '2018-05-04 11:18:57');
INSERT INTO `system_node` VALUES ('100', 'wechat/menu/index', '微信菜单展示', '1', '1', '1', '2018-05-04 11:19:10');
INSERT INTO `system_node` VALUES ('101', 'wechat/menu/edit', '编辑微信菜单', '0', '1', '1', '2018-05-04 11:19:22');
INSERT INTO `system_node` VALUES ('102', 'wechat/menu/cancel', '取消微信菜单', '0', '1', '1', '2018-05-04 11:19:26');
INSERT INTO `system_node` VALUES ('103', 'wechat/news/index', '微信图文列表', '1', '1', '1', '2018-05-04 11:19:28');
INSERT INTO `system_node` VALUES ('104', 'wechat/news/select', '微信图文选择', '0', '1', '1', '2018-05-04 11:19:28');
INSERT INTO `system_node` VALUES ('105', 'wechat/news/image', '微信图片选择', '0', '1', '1', '2018-05-04 11:19:28');
INSERT INTO `system_node` VALUES ('106', 'wechat/news/add', '添加微信图文', '0', '1', '1', '2018-05-04 11:19:28');
INSERT INTO `system_node` VALUES ('107', 'wechat/news/edit', '编辑微信图文', '0', '1', '1', '2018-05-04 11:19:28');
INSERT INTO `system_node` VALUES ('108', 'wechat/news/del', '删除微信图文', '0', '1', '1', '2018-05-04 11:19:28');
INSERT INTO `system_node` VALUES ('109', 'wechat/news/push', '推送微信图文', '0', '1', '1', '2018-05-04 11:19:28');
INSERT INTO `system_node` VALUES ('110', 'wechat/news', '微信图文管理', '0', '1', '1', '2018-05-04 11:19:35');
INSERT INTO `system_node` VALUES ('111', 'wechat/tags', '微信粉丝标签管理', '0', '1', '1', '2018-05-04 11:20:28');
INSERT INTO `system_node` VALUES ('112', 'wechat/tags/index', '粉丝标签列表', '1', '1', '1', '2018-05-04 11:20:28');
INSERT INTO `system_node` VALUES ('113', 'wechat/tags/add', '添加粉丝标签', '0', '1', '1', '2018-05-04 11:20:28');
INSERT INTO `system_node` VALUES ('114', 'wechat/tags/edit', '编辑粉丝标签', '0', '1', '1', '2018-05-04 11:20:29');
INSERT INTO `system_node` VALUES ('115', 'wechat/tags/del', '删除粉丝标签', '0', '1', '1', '2018-05-04 11:20:29');
INSERT INTO `system_node` VALUES ('116', 'wechat/tags/sync', '同步粉丝标签', '0', '1', '1', '2018-05-04 11:20:29');
INSERT INTO `system_node` VALUES ('117', 'store/goods', '商品管理', '0', '1', '1', '2018-05-04 11:29:55');
INSERT INTO `system_node` VALUES ('118', 'store/goods/index', '商品列表', '1', '1', '1', '2018-05-04 11:29:56');
INSERT INTO `system_node` VALUES ('119', 'store/goods/add', '添加商品', '0', '1', '1', '2018-05-04 11:29:56');
INSERT INTO `system_node` VALUES ('120', 'store/goods/edit', '编辑商品', '0', '1', '1', '2018-05-04 11:29:56');
INSERT INTO `system_node` VALUES ('121', 'store/goods/del', '删除商品', '0', '1', '1', '2018-05-04 11:29:56');
INSERT INTO `system_node` VALUES ('122', 'store/goods/forbid', '下架商品', '0', '1', '1', '2018-05-04 11:29:56');
INSERT INTO `system_node` VALUES ('123', 'store/goods/resume', '上架商品', '0', '1', '1', '2018-05-04 11:29:57');
INSERT INTO `system_node` VALUES ('124', 'store/goods_brand', '商品品牌管理', '0', '1', '1', '2018-05-04 11:30:44');
INSERT INTO `system_node` VALUES ('125', 'store/goods_brand/index', '商品品牌列表', '1', '1', '1', '2018-05-04 11:30:52');
INSERT INTO `system_node` VALUES ('126', 'store/goods_brand/add', '添加商品品牌', '0', '1', '1', '2018-05-04 11:30:55');
INSERT INTO `system_node` VALUES ('127', 'store/goods_brand/edit', '编辑商品品牌', '0', '1', '1', '2018-05-04 11:30:56');
INSERT INTO `system_node` VALUES ('128', 'store/goods_brand/del', '删除商品品牌', '0', '1', '1', '2018-05-04 11:30:56');
INSERT INTO `system_node` VALUES ('129', 'store/goods_brand/forbid', '禁用商品品牌', '0', '1', '1', '2018-05-04 11:30:56');
INSERT INTO `system_node` VALUES ('130', 'store/goods_brand/resume', '启用商品品牌', '0', '1', '1', '2018-05-04 11:30:56');
INSERT INTO `system_node` VALUES ('131', 'store/goods_cate', '商品分类管理', '0', '1', '1', '2018-05-04 11:31:19');
INSERT INTO `system_node` VALUES ('132', 'store/goods_cate/index', '商品分类列表', '1', '1', '1', '2018-05-04 11:31:23');
INSERT INTO `system_node` VALUES ('133', 'store/goods_cate/add', '添加商品分类', '0', '1', '1', '2018-05-04 11:31:23');
INSERT INTO `system_node` VALUES ('134', 'store/goods_cate/edit', '编辑商品分类', '0', '1', '1', '2018-05-04 11:31:23');
INSERT INTO `system_node` VALUES ('135', 'store/goods_cate/del', '删除商品分类', '0', '1', '1', '2018-05-04 11:31:24');
INSERT INTO `system_node` VALUES ('136', 'store/goods_cate/forbid', '禁用商品分类', '0', '1', '1', '2018-05-04 11:31:24');
INSERT INTO `system_node` VALUES ('137', 'store/goods_cate/resume', '启用商品分类', '0', '1', '1', '2018-05-04 11:31:24');
INSERT INTO `system_node` VALUES ('138', 'store/goods_spec', '商品规格管理', '0', '1', '1', '2018-05-04 11:31:47');
INSERT INTO `system_node` VALUES ('139', 'store/goods_spec/index', '商品规格列表', '1', '1', '1', '2018-05-04 11:31:47');
INSERT INTO `system_node` VALUES ('140', 'store/goods_spec/add', '添加商品规格', '0', '1', '1', '2018-05-04 11:31:47');
INSERT INTO `system_node` VALUES ('141', 'store/goods_spec/edit', '编辑商品规格', '0', '1', '1', '2018-05-04 11:31:48');
INSERT INTO `system_node` VALUES ('142', 'store/goods_spec/del', '删除商品规格', '0', '1', '1', '2018-05-04 11:31:48');
INSERT INTO `system_node` VALUES ('143', 'store/goods_spec/forbid', '禁用商品规格', '0', '1', '1', '2018-05-04 11:31:48');
INSERT INTO `system_node` VALUES ('144', 'store/goods_spec/resume', '启用商品规格', '0', '1', '1', '2018-05-04 11:31:48');

-- ----------------------------
-- Table structure for system_qrcode
-- ----------------------------
DROP TABLE IF EXISTS `system_qrcode`;
CREATE TABLE `system_qrcode` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pic` varchar(1024) DEFAULT '' COMMENT '二维码图片',
  `title` varchar(255) DEFAULT '' COMMENT '二维码名称',
  `desc` text COMMENT '二维码描述',
  `detail` text COMMENT '二维码图文信息',
  `sort` int(11) unsigned DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '二维码状态(1有效,0无效)',
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT '删除状态(1删除,0未删除)',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='广告页二维码';

-- ----------------------------
-- Records of system_qrcode
-- ----------------------------
INSERT INTO `system_qrcode` VALUES ('1', 'http://dev.admin.com/static/upload/cb0f7854fb0c4669/6f413d9e6185e64f.png', '男科一号二维码', '南宁市西乡塘区科园东四路', '<p>1515815</p>\r\n', '0', '1', '0', '2019-02-27 10:04:32');
INSERT INTO `system_qrcode` VALUES ('2', 'http://dev.admin.com/static/upload/7197c8b6c737755b/4ae1a55db5820a48.png', '男科二号二维码', '科园东四路男科医院备用的', '<p>26959</p>\r\n', '0', '1', '0', '2019-02-27 10:06:52');

-- ----------------------------
-- Table structure for system_user
-- ----------------------------
DROP TABLE IF EXISTS `system_user`;
CREATE TABLE `system_user` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户登录名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户登录密码',
  `qq` varchar(16) DEFAULT NULL COMMENT '联系QQ',
  `mail` varchar(32) DEFAULT NULL COMMENT '联系邮箱',
  `phone` varchar(16) DEFAULT NULL COMMENT '联系手机号',
  `desc` varchar(255) DEFAULT '' COMMENT '备注说明',
  `login_num` bigint(20) unsigned DEFAULT '0' COMMENT '登录次数',
  `login_at` datetime DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态(0:禁用,1:启用)',
  `authorize` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) unsigned DEFAULT '0' COMMENT '删除状态(1:删除,0:未删)',
  `create_by` bigint(20) unsigned DEFAULT NULL COMMENT '创建人',
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index_system_user_username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=utf8 COMMENT='系统用户表';

-- ----------------------------
-- Records of system_user
-- ----------------------------
INSERT INTO `system_user` VALUES ('10000', 'admin', '21232f297a57a5a743894a0e4a801fc3', '22222222', '', '', '', '22984', '2019-02-28 09:08:28', '1', '2,4', '0', null, '2015-11-13 15:14:22');
