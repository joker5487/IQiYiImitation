/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost:3306
 Source Schema         : video

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : 65001

 Date: 06/06/2019 01:19:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号ID',
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `truename` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '真实名称',
  `gid` int(11) NOT NULL COMMENT '角色ID',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (1, 'admin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'admin', 1, 0, 1559318400);
INSERT INTO `admin` VALUES (2, 'test', 'test', '测试', 0, 1, 1559318401);
INSERT INTO `admin` VALUES (3, 'dev1', 'f3ff6bb9b1932ba3dcd0efc934cf0f1a', '开发1', 2, 0, 1559318402);
INSERT INTO `admin` VALUES (4, 'dev2', '6fdbf90fea9a9e5b5a9a0e190c090eae', '开发2', 2, 0, 1559318403);

-- ----------------------------
-- Table structure for admin_groups
-- ----------------------------
DROP TABLE IF EXISTS `admin_groups`;
CREATE TABLE `admin_groups`  (
  `gid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色标题',
  `rights` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色权限，json格式',
  PRIMARY KEY (`gid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_groups
-- ----------------------------
INSERT INTO `admin_groups` VALUES (1, '系统管理员', '[1,4,5,6,2,7,8,10,3,11,12,13,14,15,16,17,18,19,20,21,22,23,24]');
INSERT INTO `admin_groups` VALUES (2, '开发人员', '');
INSERT INTO `admin_groups` VALUES (3, '测试角色0', '[6]');
INSERT INTO `admin_groups` VALUES (4, '测试角色1', '[1,4,6,2]');

-- ----------------------------
-- Table structure for admin_menus
-- ----------------------------
DROP TABLE IF EXISTS `admin_menus`;
CREATE TABLE `admin_menus`  (
  `mid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '上级菜单ID',
  `ord` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '菜单标题',
  `controller` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '控制器',
  `method` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '方法',
  `ishidden` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否隐藏 0:正常显示 1:隐藏',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态 0:正常 1:禁用',
  PRIMARY KEY (`mid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin_menus
-- ----------------------------
INSERT INTO `admin_menus` VALUES (1, 0, 0, '管理员管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (2, 0, 0, '权限管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (3, 0, 0, '系统设置', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (4, 1, 0, '管理员列表', 'Admin', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (5, 1, 0, '管理员添加', 'Admin', 'add', 1, 0);
INSERT INTO `admin_menus` VALUES (6, 1, 0, '管理员保存', 'Admin', 'save', 1, 0);
INSERT INTO `admin_menus` VALUES (7, 2, 0, '菜单管理', 'Menu', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (8, 2, 0, '角色管理', 'Roles', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (10, 8, 0, '文章设置', 'Article', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (11, 3, 0, '网站设置', 'Site', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (12, 3, 0, '保存设置', 'Site', 'save', 1, 0);
INSERT INTO `admin_menus` VALUES (13, 0, 0, '标签管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (14, 13, 0, '频道标签', 'Labels', 'channel', 0, 0);
INSERT INTO `admin_menus` VALUES (15, 13, 0, '资费标签', 'Labels', 'charge', 0, 0);
INSERT INTO `admin_menus` VALUES (16, 13, 0, '地区标签', 'Labels', 'area', 0, 0);
INSERT INTO `admin_menus` VALUES (17, 0, 0, '影片管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (18, 17, 0, '影片列表', 'Video', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (19, 17, 0, '添加影片', 'Video', 'add', 1, 0);
INSERT INTO `admin_menus` VALUES (20, 17, 0, '保存影片', 'Video', 'save', 1, 0);
INSERT INTO `admin_menus` VALUES (21, 17, 0, '图片上传', 'Video', 'upload_img', 1, 0);
INSERT INTO `admin_menus` VALUES (22, 0, 0, '幻灯片管理', '', '', 0, 0);
INSERT INTO `admin_menus` VALUES (23, 22, 0, '首页首屏', 'Slide', 'index', 0, 0);
INSERT INTO `admin_menus` VALUES (24, 22, 0, '幻灯片保存', 'Slide', 'save', 1, 0);

-- ----------------------------
-- Table structure for sites
-- ----------------------------
DROP TABLE IF EXISTS `sites`;
CREATE TABLE `sites`  (
  `names` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `values` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of sites
-- ----------------------------
INSERT INTO `sites` VALUES ('site', '\"PHP\\u4e2d\\u6587\\u7f51\"');

-- ----------------------------
-- Table structure for slide
-- ----------------------------
DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '幻灯片图片ID',
  `type` tinyint(2) NOT NULL DEFAULT 0 COMMENT '类型 0: 首页首屏',
  `ord` tinyint(2) NOT NULL DEFAULT 0 COMMENT '排序',
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '链接地址',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片地址',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of slide
-- ----------------------------
INSERT INTO `slide` VALUES (1, 0, 0, '大宋少年志：张新成为和平而战', 'http://www.test1', '/uploads/20190604\\4dbbf29c178d3528ef4059e100d0d0db.jpg');
INSERT INTO `slide` VALUES (2, 0, 0, '临界天下：郑元畅张铭恩守玄沧', 'http://www.test2', '/uploads/20190604\\3f5f77d7d287070457d7e8a4c45d0d93.jpg');
INSERT INTO `slide` VALUES (4, 0, 0, '破冰行动大结局：终极一战开启', 'http://www.test4', '/uploads/20190604\\3a521cd32275ed50e91a6edaaef05eae.jpg');
INSERT INTO `slide` VALUES (5, 0, 0, '我的真朋友：邓伦追爱气场全开', 'http://www.test5', '/uploads/20190604\\c74a3ddb671e07f6393b050ba42c3187.jpg');
INSERT INTO `slide` VALUES (6, 0, 0, '乐队：惊喜先生曲风惊艳吴青峰', 'http://www.test6', '/uploads/20190604\\5bf4bd0ee13c8503f7074a1e1dab76d0.jpg');
INSERT INTO `slide` VALUES (7, 0, 0, '筑梦情缘：其南函君双A对决', 'http://www.test7', '/uploads/20190604\\3f9f2a09ff9564d667f5c150ae9d52a3.jpg');
INSERT INTO `slide` VALUES (8, 0, 0, '极限挑战：黄磊张艺兴套路多', 'http://www.test8', '/uploads/20190604\\b0de2e8b66b77a0f53e319d78df4d646.jpg');
INSERT INTO `slide` VALUES (9, 0, 0, '巨兽争霸：哥斯拉大战金刚', 'http://www.test9', '/uploads/20190604\\48250a5ec273e306c4b7b771b523f96a.jpg');
INSERT INTO `slide` VALUES (10, 0, 0, '中国英雄：林永健致敬打拐英雄', 'http://www.test10', '/uploads/20190604\\347ae7cdba1fbac89331f5e17a635a74.jpg');
INSERT INTO `slide` VALUES (11, 0, 0, '爱奇艺特别策划：我们的70年', 'http://www.test11', '/uploads/20190604\\002b7f7182d8b64cac9194d914739c03.jpg');

-- ----------------------------
-- Table structure for video
-- ----------------------------
DROP TABLE IF EXISTS `video`;
CREATE TABLE `video`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `channel_id` int(11) NOT NULL COMMENT '频道ID',
  `charge_id` int(11) NOT NULL COMMENT '资费ID',
  `area_id` int(11) NOT NULL COMMENT '地区ID',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片标题',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片关键字',
  `desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片描述',
  `img` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片封面图片地址',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '影片播放地址',
  `pv` int(11) NOT NULL DEFAULT 0 COMMENT '影片点击量',
  `score` int(3) NOT NULL COMMENT '影片评分',
  `is_vip` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否是VIP片源 0：不是 1：是',
  `status` tinyint(1) NOT NULL COMMENT '影片状态 0：下线 1：正常',
  `add_time` int(10) NOT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of video
-- ----------------------------
INSERT INTO `video` VALUES (1, 2, 11, 14, '猪小屁', '测试,电影', '香港测试电影', '/uploads/20190604\\1debfec5fc11147680793f1b741e2cf1.jpg', 'http://www.video.com/static/video/zhuxiaopi.mp4', 0, 0, 0, 1, 1559584969);
INSERT INTO `video` VALUES (2, 2, 11, 13, '测试影片1', '', '', '/uploads/20190604\\660b6ba41ff37b2b0305307f3e823da0.jpg', 'http://www.testvideo1.mp4', 0, 0, 0, 1, 1559586278);
INSERT INTO `video` VALUES (3, 3, 12, 0, '测试影片2', '', '香港测试电影', '/uploads/20190604\\fef2b503da0ad56b217358e9f591f9c9.jpg', 'http://www.testvideo2.mp4', 0, 0, 0, 0, 1559586323);

-- ----------------------------
-- Table structure for video_label
-- ----------------------------
DROP TABLE IF EXISTS `video_label`;
CREATE TABLE `video_label`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '影片标签编号',
  `ord` int(3) NOT NULL DEFAULT 0 COMMENT '排序',
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标签名称',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '标签状态',
  `flag` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标签分类标识',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of video_label
-- ----------------------------
INSERT INTO `video_label` VALUES (1, 0, '电视剧', 0, 'channel');
INSERT INTO `video_label` VALUES (2, 0, '电影', 0, 'channel');
INSERT INTO `video_label` VALUES (3, 0, '综艺', 0, 'channel');
INSERT INTO `video_label` VALUES (4, 0, '动漫', 0, 'channel');
INSERT INTO `video_label` VALUES (5, 0, '纪录片', 0, 'channel');
INSERT INTO `video_label` VALUES (6, 0, '游戏', 0, 'channel');
INSERT INTO `video_label` VALUES (7, 0, '资讯', 0, 'channel');
INSERT INTO `video_label` VALUES (8, 0, '娱乐', 0, 'channel');
INSERT INTO `video_label` VALUES (9, 0, '财经', 0, 'channel');
INSERT INTO `video_label` VALUES (10, 0, '网络电影', 0, 'channel');
INSERT INTO `video_label` VALUES (11, 0, '免费', 0, 'charge');
INSERT INTO `video_label` VALUES (12, 0, '付费', 0, 'charge');
INSERT INTO `video_label` VALUES (13, 0, '华语', 0, 'area');
INSERT INTO `video_label` VALUES (14, 0, '香港', 0, 'area');
INSERT INTO `video_label` VALUES (15, 0, '美国', 0, 'area');
INSERT INTO `video_label` VALUES (16, 0, '欧洲', 0, 'area');
INSERT INTO `video_label` VALUES (17, 0, '韩国', 0, 'area');
INSERT INTO `video_label` VALUES (18, 0, '日本', 0, 'area');
INSERT INTO `video_label` VALUES (19, 0, '泰国', 0, 'area');
INSERT INTO `video_label` VALUES (20, 0, '其他', 0, 'area');

SET FOREIGN_KEY_CHECKS = 1;
