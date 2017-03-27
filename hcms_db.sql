/*
Navicat MySQL Data Transfer

Source Server         : 本地3308
Source Server Version : 50617
Source Host           : localhost:3308
Source Database       : hcms_db

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-03-27 17:54:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `act_member`
-- ----------------------------
DROP TABLE IF EXISTS `act_member`;
CREATE TABLE `act_member` (
  `id` varchar(18) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `cardno` varchar(18) DEFAULT NULL,
  `pmd5` varchar(32) DEFAULT NULL,
  `idtype` smallint(6) DEFAULT NULL,
  `nick` varchar(20) DEFAULT NULL,
  `face` tinyint(4) DEFAULT NULL,
  `truename` varchar(10) DEFAULT NULL,
  `ename` varchar(50) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `lgnums` int(11) DEFAULT NULL,
  `lasttime` int(11) DEFAULT NULL,
  `lastip` varchar(15) DEFAULT NULL,
  `tmp` varchar(32) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `subject` smallint(6) DEFAULT NULL,
  `addr` int(11) DEFAULT NULL,
  `grade` smallint(6) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `pre` varchar(150) DEFAULT NULL,
  `lvl` int(11) unsigned DEFAULT NULL,
  `credit` smallint(6) DEFAULT NULL,
  `integral` int(11) DEFAULT NULL,
  `gold` int(11) DEFAULT NULL,
  `cash` decimal(11,2) DEFAULT NULL,
  `period` tinyint(4) DEFAULT NULL,
  `school` int(11) DEFAULT NULL,
  `intoyear` smallint(6) DEFAULT NULL,
  `msg` smallint(6) DEFAULT NULL,
  `notice` smallint(6) DEFAULT NULL,
  `heart` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `hobbies` varchar(500) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `cli_token` varchar(32) DEFAULT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `recommend` int(11) DEFAULT '0',
  `user_group` int(11) DEFAULT '2',
  `template` varchar(32) DEFAULT 'default' COMMENT '主题模板',
  `shortcuts` text COMMENT '快捷菜单',
  `bid` int(11) DEFAULT NULL COMMENT '统一登录',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of act_member
-- ----------------------------
INSERT INTO `act_member` VALUES ('a1401330136', 'lren', 'cplus@lren.org', '1234', '12', '37f0ba275f1b80fe10498031008ff7cf', '2', '良苏', '1', '张良人', null, '0', null, '33', '1468396611', '192.168.10.205', '4aadb6d30f39dc4cba566f902242615a', null, '101', '108', '11', null, null, null, '6', '1', null, null, '2', '70', null, '0', '0', '1468396646', '1482926007', null, '2', 'a1401330136', '2', '0', '1', 'default', null, null);
INSERT INTO `act_member` VALUES ('a1401955133', 'test', '6532890@qq.com', 'test1', '1', '098f6bcd4621d373cade4e832627b4f6', '1', '飞翔的企鹅', '1', '张一凡', 'liang ren', '1', '2014-12-11', '768', '1489020154', '::1', '52bf8b50c6b26f378e79de1c546ea4e5', null, '101', '9', '11', null, '我心安处是故乡。', null, '57', '209', null, null, '2', '2', null, '0', '0', '1469969183', '1481849472', null, '18', 'a08594ed7470dfb8e4d62b7cfd731dc5', '2', '0', '2', 'default', null, null);
INSERT INTO `act_member` VALUES ('a1411090712', 'tech', 'tech@123.com', '130651', '11', 'd9f9133fb120cd6096870bc2b496805b', '3', '向日葵', '1', '张三丰', 'techer sa', '1', '2014-10-08', '1291', '1490606618', '::1', 'd6176db8920e095f874e9797b1c213d4', null, '100', '9', '11', null, '孩子是明天的未来', null, '35', '37', null, null, '2', '70', '2015', '0', '0', '1474327715', '1482892374', '游戏，唱歌, 玩游戏，看书，上网，交友，游泳，潜水', '12', '6ad243d5b4774e35e47f131463158f87', '2', '0', '1', 'default', null, '4216');
INSERT INTO `act_member` VALUES ('a1489020206', 'ceshi', null, null, null, 'e10adc3949ba59abbe56e057f20f883e', null, 'ceshi', null, 'ceshi', null, '1', null, '4', '1490606158', '::1', '93b6045f93caeef758b74919d63cb53b', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '1489020206', null, null, null, '2', '0', '2', 'default', null, null);

-- ----------------------------
-- Table structure for `consult_art`
-- ----------------------------
DROP TABLE IF EXISTS `consult_art`;
CREATE TABLE `consult_art` (
  `id` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `uid` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `sex` int(2) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL COMMENT '联系地址',
  `unit` varchar(100) DEFAULT NULL COMMENT '单位',
  `ip` varchar(50) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text,
  `see` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `endtime` int(11) DEFAULT NULL,
  `show` int(5) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of consult_art
-- ----------------------------
INSERT INTO `consult_art` VALUES ('1481680316', '1477512752', null, '你好', '0', '13555234565', '12312312', '312312312', '::1', '12312', '3123123', '0', '1481680316', '1481683841', '2');

-- ----------------------------
-- Table structure for `consult_art_category`
-- ----------------------------
DROP TABLE IF EXISTS `consult_art_category`;
CREATE TABLE `consult_art_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `pid` int(11) DEFAULT '0' COMMENT '父id',
  `visible` tinyint(4) DEFAULT NULL,
  `odx` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `childnums` int(11) DEFAULT NULL,
  `nums` int(11) DEFAULT NULL,
  `lastid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of consult_art_category
-- ----------------------------
INSERT INTO `consult_art_category` VALUES ('1477502573', '资格认证', '0', null, '0', '1477502573', null, null, null);
INSERT INTO `consult_art_category` VALUES ('1477512752', '校长信箱', '0', null, '1', '1481858897', null, null, null);

-- ----------------------------
-- Table structure for `consult_art_comment`
-- ----------------------------
DROP TABLE IF EXISTS `consult_art_comment`;
CREATE TABLE `consult_art_comment` (
  `id` int(11) NOT NULL DEFAULT '0',
  `aid` int(11) DEFAULT NULL,
  `des` text,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of consult_art_comment
-- ----------------------------
INSERT INTO `consult_art_comment` VALUES ('1477499772', '1477498333', '啊实打实的', '1477499772');
INSERT INTO `consult_art_comment` VALUES ('1477499930', '1477498333', '按时打算', '1477499930');
INSERT INTO `consult_art_comment` VALUES ('1477499955', '1477498333', '撒大声地', '1477499955');
INSERT INTO `consult_art_comment` VALUES ('1477499962', '1477498333', '反反复复', '1477499962');
INSERT INTO `consult_art_comment` VALUES ('1477500122', '1477492777', '手上的当然', '1477500122');
INSERT INTO `consult_art_comment` VALUES ('1477500148', '1477498333', '按时打算', '1477500148');
INSERT INTO `consult_art_comment` VALUES ('1477500325', '1477498333', '按时打算', '1477500325');
INSERT INTO `consult_art_comment` VALUES ('1477500418', '1477492777', '啊啊啊', '1477500418');
INSERT INTO `consult_art_comment` VALUES ('1477500824', '1477498333', '阿萨德', '1477500824');
INSERT INTO `consult_art_comment` VALUES ('1477500981', '1477484988', '啊实打实的', '1477500981');
INSERT INTO `consult_art_comment` VALUES ('1477502972', '1477502916', '您好，请电话咨询85822152.', '1477502972');
INSERT INTO `consult_art_comment` VALUES ('1477505174', '1477505165', '实打实大师', '1477505174');
INSERT INTO `consult_art_comment` VALUES ('1477505178', '1477505151', '啊实打实大', '1477505178');
INSERT INTO `consult_art_comment` VALUES ('1477505182', '1477505140', '公司的广东省分公司', '1477505182');
INSERT INTO `consult_art_comment` VALUES ('1477509616', '1477509603', '啊实打实的\n发发发\n刚刚', '1477509616');
INSERT INTO `consult_art_comment` VALUES ('1477512782', '1477512773', 'asdasd ', '1477512782');
INSERT INTO `consult_art_comment` VALUES ('1479046439', '1479046342', '什么跟什么啊', '1479046439');
INSERT INTO `consult_art_comment` VALUES ('1481682642', '1481680362', 'ds', '1481682642');
INSERT INTO `consult_art_comment` VALUES ('1481683841', '1481680316', 'aaaaaaaaa', '1481683841');

-- ----------------------------
-- Table structure for `links`
-- ----------------------------
DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `odx` smallint(6) DEFAULT '0',
  `timestamp` int(11) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL COMMENT '友情链接logo',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of links
-- ----------------------------
INSERT INTO `links` VALUES ('1', '百度', 'https://www.baidu.com/', '1', '1484137115', '1484137112.png');
INSERT INTO `links` VALUES ('2', '中国教育信息网', 'http://www.chinaedu.edu.cn/', '0', '1482896751', null);

-- ----------------------------
-- Table structure for `main_article`
-- ----------------------------
DROP TABLE IF EXISTS `main_article`;
CREATE TABLE `main_article` (
  `id` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `uid` varchar(20) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `pre` varchar(250) DEFAULT NULL,
  `des` text,
  `thumb` varchar(250) NOT NULL,
  `see` int(11) DEFAULT NULL,
  `up` int(11) DEFAULT NULL,
  `report` int(11) DEFAULT NULL,
  `share` int(11) DEFAULT NULL,
  `comments` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `froms` varchar(100) DEFAULT NULL,
  `fromid` int(11) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `CreateTime` int(11) DEFAULT NULL,
  `isTop` tinyint(4) DEFAULT '0',
  `push_cate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_article
-- ----------------------------
INSERT INTO `main_article` VALUES ('217', '69', 'a1411090712', '幻灯片1', ' 幻灯片1', '<p>&nbsp;幻灯片1</p>', '1484153091.jpg', '0', '0', '0', '0', '0', '1484153140', '本地原创', null, '2', '1484153101', '0', null);
INSERT INTO `main_article` VALUES ('218', '69', 'a1411090712', '幻灯片2', ' 幻灯片2', '<p>幻灯片2</p>', '1484155759.jpg', '0', '0', '0', '0', '0', '1484155770', '本地原创', null, '2', '1484155770', '0', null);
INSERT INTO `main_article` VALUES ('219', '32', 'a1411090712', '产品1', ' 产品1', '<p>产品1</p>', '1484227567.jpg', '0', '0', '0', '0', '0', '1484227837', '本地原创', null, '2', '1484227575', '0', null);
INSERT INTO `main_article` VALUES ('220', '32', 'a1411090712', '产品2', ' 产品2', '<p>产品2</p>', '1484227595.jpg', '0', '0', '0', '0', '0', '1484227824', '本地原创', null, '2', '1484227597', '0', null);
INSERT INTO `main_article` VALUES ('221', '32', 'a1411090712', '产品3', ' 产品3', '<p>产品3</p>', '1484227621.jpg', '0', '0', '0', '0', '0', '1484227813', '本地原创', null, '2', '1484227623', '0', null);
INSERT INTO `main_article` VALUES ('222', '32', 'a1411090712', '产品4', ' 产品4', '<p>产品4</p>', '1484227645.jpg', '0', '0', '0', '0', '0', '1484227805', '本地原创', null, '2', '1484227647', '0', null);
INSERT INTO `main_article` VALUES ('223', '32', 'a1411090712', '产品5', ' 产品5', '<p>产品5</p>', '1484227669.jpg', '0', '0', '0', '0', '0', '1484227792', '本地原创', null, '2', '1484227675', '0', null);
INSERT INTO `main_article` VALUES ('224', '32', 'a1411090712', '产品6', ' 产品6', '<p>产品6</p>', '1484227867.jpg', '0', '0', '0', '0', '0', '1484227945', '本地原创', null, '2', '1484227870', '0', null);
INSERT INTO `main_article` VALUES ('225', '32', 'a1411090712', '产品7', ' 产品7', '<p>产品7</p>', '1484227896.jpg', '0', '0', '0', '0', '0', '1484227913', '本地原创', null, '2', '1484227901', '0', null);
INSERT INTO `main_article` VALUES ('226', '39', 'a1411090712', '荣誉1', ' 荣誉1', '<p>荣誉1</p>', '1484228000.jpg', '0', '0', '0', '0', '0', '1484228016', '本地原创', null, '2', '1484228004', '0', null);
INSERT INTO `main_article` VALUES ('227', '39', 'a1411090712', '荣誉2', ' 荣誉2', '<p>荣誉2</p>', '1484228060.jpg', '0', '0', '0', '0', '0', '1484228077', '本地原创', null, '2', '1484228063', '0', null);
INSERT INTO `main_article` VALUES ('228', '39', 'a1411090712', '荣誉3', ' 荣誉3', '<p>荣誉3</p>', '1484228098.jpg', '0', '0', '0', '0', '0', '1484228153', '本地原创', null, '2', '1484228105', '0', null);
INSERT INTO `main_article` VALUES ('229', '39', 'a1411090712', '荣誉4', ' 荣誉4', '<p>荣誉4</p>', '1484228141.jpg', '0', '0', '0', '0', '0', '1484228143', '本地原创', null, '2', '1484228143', '0', null);
INSERT INTO `main_article` VALUES ('230', '39', 'a1411090712', '荣誉5', ' 荣誉5', '<p>荣誉5</p>', '1484228184.jpg', '0', '0', '0', '0', '0', '1484228189', '本地原创', null, '2', '1484228189', '0', null);
INSERT INTO `main_article` VALUES ('231', '39', 'a1411090712', '荣誉6', ' 荣誉6', '<p>荣誉6</p>', '1484228219.jpg', '0', '0', '0', '0', '0', '1484228220', '本地原创', null, '2', '1484228220', '0', null);
INSERT INTO `main_article` VALUES ('232', '44', 'a1411090712', '新闻置顶1', ' 【行业新闻】：今日要闻，今日要闻，今日要闻，今日要闻，今日要闻，今日要闻', '<p>今日要闻，今日要闻，今日要闻，今日要闻，今日要闻，今日要闻今日要闻，今日要闻，今日要闻，今日要闻，今日要闻，今日要闻今日要闻，今日要闻，今日要闻，今日要闻，今日要闻，今日要闻今日要闻，今日要闻，今日要闻，今日要闻，今日要闻，今日要闻今日要闻，今日要闻，今日要闻，今日要闻，今日要闻，今日要闻今日要闻，今日要闻，今日要闻，今日要闻，今日要闻，今日要闻</p>', '1484244164.jpg', '0', '0', '0', '0', '0', '1484244171', '本地原创', null, '2', '1484244171', '1', null);
INSERT INTO `main_article` VALUES ('233', '43', 'a1411090712', '新闻置顶2', ' 【公司新闻】：新闻置顶2，新闻置顶2', '<p>新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2新闻置顶2</p>', '1484244480.jpg', '0', '0', '0', '0', '0', '1484244483', '本地原创', null, '2', '1484244483', '1', null);
INSERT INTO `main_article` VALUES ('234', '44', 'a1411090712', '普通新闻普通新闻', ' 普通新闻普通新闻', '<p>普通新闻普通新闻</p>', '', '0', '0', '0', '0', '0', '1484244562', '', null, '2', '1484244525', '0', null);
INSERT INTO `main_article` VALUES ('235', '43', 'a1411090712', '普通新闻普通新闻2', ' 普通新闻普通新闻2', '<p>普通新闻普通新闻2</p>', '', '0', '0', '0', '0', '0', '1484244554', null, null, '2', '1484244554', '0', null);
INSERT INTO `main_article` VALUES ('236', '44', 'a1411090712', '新闻置顶3新闻置顶3', ' 新闻置顶3新闻置顶3', '<p>新闻置顶3新闻置顶3</p>', '', '0', '0', '0', '0', '0', '1484244590', null, null, '2', '1484244590', '1', null);
INSERT INTO `main_article` VALUES ('237', '40', 'a1411090712', '苦荞知识苦荞知识1', ' 苦荞知识1', '<p>苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1</p>', '', '0', '0', '0', '0', '0', '1484310821', '本地原创', null, '2', '1484310821', '0', null);
INSERT INTO `main_article` VALUES ('238', '40', 'a1411090712', '苦荞知识苦荞知识2', ' 苦荞知识2', '<p>苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1苦荞知识1</p>', '', '0', '0', '0', '0', '0', '1484310907', '本地原创', null, '2', '1484310860', '0', null);
INSERT INTO `main_article` VALUES ('240', '41', 'a1411090712', '养生保健1', ' 养生保健1', '<p>养生保健1养生保健1养生保健1养生保健1养生保健1养生保健1养生保健1</p>', '', '0', '0', '0', '0', '0', '1484310974', '本地原创', null, '2', '1484310974', '0', null);
INSERT INTO `main_article` VALUES ('241', '41', 'a1411090712', '养生保健养生保健2', ' 养生保健2', '<p>养生保健养生保健2养生保健2养生保健2养生保健2养生保健2养生保健2养生保健2养生保健2</p>', '', '0', '0', '0', '0', '0', '1484311081', '本地原创', null, '2', '1484311000', '1', null);
INSERT INTO `main_article` VALUES ('242', '29', 'a1411090712', '公司简介', '公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介', '<p>公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介</p>', '', '0', '0', '0', '0', '0', '1489144621', '本地原创', null, '2', '1484327663', '0', '40,41');
INSERT INTO `main_article` VALUES ('258', '45', 'a1411090712', 'www', ' ww', '<p>wwwwww</p>', '', '0', '0', '0', '0', '0', '1489142972', 'ww', null, '2', '1488939687', '0', '');
INSERT INTO `main_article` VALUES ('259', '46', 'a1411090712', 'www', ' ww', '<p>wwwwww</p>', '', '0', '0', '0', '0', '0', '1489142793', 'ww', null, '2', '1488939687', '0', null);
INSERT INTO `main_article` VALUES ('260', '43', 'a1411090712', '111', '111', '<p>1111111qqqqwww<br/></p>', '', '0', '0', '0', '0', '0', '1490344445', '', null, '2', '1489144504', '0', '44');
INSERT INTO `main_article` VALUES ('261', '44', 'a1489020206', '111', '111', '<p>1111111<br/></p>', '', '0', '0', '0', '0', '0', '1489144665', '', null, '0', '1489144504', '0', '43');
INSERT INTO `main_article` VALUES ('262', '40', 'a1411090712', '公司简介', '公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介', '<p>公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介</p>', '', '0', '0', '0', '0', '0', '1489144621', '本地原创', null, '2', '1484327663', '0', null);
INSERT INTO `main_article` VALUES ('263', '41', 'a1411090712', '公司简介', '公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介', '<p>公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介公司简介</p>', '', '0', '0', '0', '0', '0', '1489144621', '本地原创', null, '2', '1484327663', '0', null);
INSERT INTO `main_article` VALUES ('264', '43', 'a1489020206', '111', '111', '<p>1111111<br/></p>', '', '0', '0', '0', '0', '0', '1489144665', null, null, '0', '1489144504', '0', null);

-- ----------------------------
-- Table structure for `main_art_category`
-- ----------------------------
DROP TABLE IF EXISTS `main_art_category`;
CREATE TABLE `main_art_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `pid` int(11) DEFAULT '0' COMMENT '父id',
  `visible` tinyint(4) DEFAULT NULL,
  `odx` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `childnums` int(11) DEFAULT NULL,
  `nums` int(11) DEFAULT NULL,
  `lastid` int(11) DEFAULT NULL,
  `odb` varchar(32) DEFAULT 'CreateTime',
  `scend` varchar(32) DEFAULT 'desc',
  `isatc` tinyint(4) DEFAULT '1' COMMENT '排序是否应用到子栏目',
  `type` varchar(20) DEFAULT 'arts' COMMENT '栏目类型',
  `iscst` tinyint(4) DEFAULT '1' COMMENT '栏目模板是否应用到子栏目',
  `cstyle` varchar(100) DEFAULT NULL COMMENT '栏目页模板',
  `isast` tinyint(4) DEFAULT '1' COMMENT '内容模板是否应用到子栏目',
  `astyle` varchar(100) DEFAULT NULL COMMENT '内容页模板',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of main_art_category
-- ----------------------------
INSERT INTO `main_art_category` VALUES ('28', '首页', '0', '0', '0', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('29', '走进航飞', '0', '1', '1', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'sht_pam1', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('30', '新闻中心', '0', '1', '2', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'sht_pam2', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('31', '健康顾问', '0', '1', '3', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'sht_pam3', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('32', '产品展示', '0', '1', '4', '1484146240', '0', '0', '0', 'timestamp', 'desc', '1', 'sht_product', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('33', '人才加盟', '0', '1', '5', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('34', '招商加盟', '0', '1', '6', '1484146240', '0', '0', '0', 'CreateTime', 'asc', '1', 'arts', '1', '', '1', '');
INSERT INTO `main_art_category` VALUES ('35', '营销网络', '0', '1', '7', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('36', '下载中心', '0', '1', '8', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('37', '在线留言', '0', '1', '9', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('38', '联系我们', '0', '1', '10', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('39', '荣誉资质', '0', '0', '11', '1484146240', '0', '0', '0', 'CreateTime', 'desc', '1', 'sht_honor', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('40', '苦荞知识', '31', '1', '0', '1484146654', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('41', '养生保健', '31', '1', '1', '1484146654', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('42', '首页其他自定义模块', '0', '0', '12', '1484146654', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('43', '公司新闻', '30', '1', '0', '1484147274', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('44', '行业新闻', '30', '1', '1', '1484147274', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('45', '航飞系列', '32', '1', '0', '1484147274', '0', '0', '0', 'timestamp', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('46', '德仁堂', '32', '1', '1', '1484147274', '0', '0', '0', 'timestamp', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('47', '八方品系列', '32', '1', '2', '1484147274', '0', '0', '0', 'timestamp', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('48', '人才招聘', '33', '1', '0', '1484147274', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('49', '加盟优势', '34', '1', '0', '1484147274', '0', '0', '0', 'CreateTime', 'asc', '1', 'arts', '1', '', '1', '');
INSERT INTO `main_art_category` VALUES ('50', '加盟支持', '34', '1', '1', '1484147274', '0', '0', '0', 'CreateTime', 'asc', '1', 'arts', '1', '', '1', '');
INSERT INTO `main_art_category` VALUES ('51', '朋友介绍', '34', '1', '2', '1484147274', '0', '0', '0', 'CreateTime', 'asc', '1', 'arts', '1', '', '1', '');
INSERT INTO `main_art_category` VALUES ('52', '我要加盟', '34', '1', '3', '1484147274', '0', '0', '0', 'CreateTime', 'asc', '1', 'arts', '1', '', '1', '');
INSERT INTO `main_art_category` VALUES ('53', '加盟条件', '34', '1', '4', '1484147274', '3', '0', '0', 'CreateTime', 'asc', '1', 'arts', '1', '', '1', '');
INSERT INTO `main_art_category` VALUES ('57', '营销网络', '35', '1', '0', '1484147274', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('58', '专卖店', '35', '1', '1', '1484147274', '3', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('62', '航飞简介', '36', '1', '0', '1484147535', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('63', '产品介绍', '36', '1', '1', '1484147535', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('64', '合作方案', '36', '1', '2', '1484147535', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('65', '在线留言', '37', '1', '0', '1484151442', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('66', '留言列表', '37', '1', '1', '1484151442', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('67', '联系我们', '38', '1', '0', '1484151442', '0', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);
INSERT INTO `main_art_category` VALUES ('68', '网站logo图片/动画', '70', '1', '0', '1484152416', '0', '0', '0', 'CreateTime', 'desc', '1', 'sht_logo', '1', '', '1', '');
INSERT INTO `main_art_category` VALUES ('69', '网站banner处幻灯片', '70', '1', '1', '1484152416', '0', '0', '0', 'CreateTime', 'desc', '1', 'sht_banner', '1', '', '1', 'a1');
INSERT INTO `main_art_category` VALUES ('70', '自定义内容循环区', '0', '0', '15', '1484152416', '2', '0', '0', 'CreateTime', 'desc', '1', 'arts', '1', null, '1', null);

-- ----------------------------
-- Table structure for `osa_menu_url`
-- ----------------------------
DROP TABLE IF EXISTS `osa_menu_url`;
CREATE TABLE `osa_menu_url` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) DEFAULT NULL,
  `menu_url` varchar(255) DEFAULT NULL,
  `is_show` tinyint(4) DEFAULT NULL COMMENT '是否在sidebar里出现',
  `online` int(11) DEFAULT '1' COMMENT '在线状态，还是下线状态，即可用，不可用。',
  `shortcut_allowed` int(10) unsigned DEFAULT '0' COMMENT '是否允许快捷访问',
  `menu_desc` varchar(255) DEFAULT NULL,
  `odx` int(11) DEFAULT '0',
  `father_menu` int(11) DEFAULT '0' COMMENT '上一级菜单',
  `menu_icon` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COMMENT='功能链接（菜单链接）';

-- ----------------------------
-- Records of osa_menu_url
-- ----------------------------
INSERT INTO `osa_menu_url` VALUES ('1', '后台主界面', '/man/?t=index', '0', '1', '0', '后台主界面', '0', '0', 'fa fa-sun-o');
INSERT INTO `osa_menu_url` VALUES ('2', '主页', '', '1', '1', '0', '主页', '0', '0', 'fa fa-home');
INSERT INTO `osa_menu_url` VALUES ('3', '个人面板', '/man/?t=main', '1', '1', '0', '个人面板', '0', '2', 'fa fa-map-pin');
INSERT INTO `osa_menu_url` VALUES ('4', '首页', '/man/?t=main', '0', '1', '0', '首页', '0', '1', null);
INSERT INTO `osa_menu_url` VALUES ('5', '文章管理', '', '1', '1', '0', '文章管理', '1', '0', 'fa fa-book');
INSERT INTO `osa_menu_url` VALUES ('6', '发文管理', '/man/?t=arts', '1', '1', '0', '发文管理', '0', '5', 'fa fa-book');
INSERT INTO `osa_menu_url` VALUES ('7', '发表/修改文章', '/man/?t=art_am', '0', '1', '0', '发表/修改文章', '0', '5', null);
INSERT INTO `osa_menu_url` VALUES ('8', '文章类型', '/man/?t=art_cate', '0', '1', '0', '文章类型', '0', '5', null);
INSERT INTO `osa_menu_url` VALUES ('9', '在线咨询', '', '1', '1', '0', '在线咨询', '4', '0', 'fa fa-commenting');
INSERT INTO `osa_menu_url` VALUES ('10', '资讯管理', '/man/?t=consult', '1', '1', '0', '资讯管理', '0', '9', null);
INSERT INTO `osa_menu_url` VALUES ('11', '咨询栏目管理', '/man/?t=consult_cate', '0', '1', '0', '咨询栏目管理', '0', '9', null);
INSERT INTO `osa_menu_url` VALUES ('12', '咨询办理', '/man/?t=consult_am', '0', '1', '0', '咨询办理', '0', '9', null);
INSERT INTO `osa_menu_url` VALUES ('22', '用户列表', '/man/?t=user_list', '1', '1', '0', '用户列表', '0', '49', 'fa fa-user');
INSERT INTO `osa_menu_url` VALUES ('23', '添加/修改用户', '/man/?t=user_am', '0', '1', '0', '添加/修改用户', '0', '49', '');
INSERT INTO `osa_menu_url` VALUES ('27', '用户组', '/man/?t=user_group', '1', '1', '0', '用户组管理', '0', '49', 'fa fa-users');
INSERT INTO `osa_menu_url` VALUES ('30', '权限管理', '', '1', '1', '0', '用户权限依赖于账号组的权限', '4', '0', 'fa fa-key');
INSERT INTO `osa_menu_url` VALUES ('34', '功能列表', '/man/?t=menu_list', '1', '1', '0', '菜单功能及可访问的链接', '0', '50', null);
INSERT INTO `osa_menu_url` VALUES ('35', '增加/修改功能', '/man/?t=menu_am', '0', '1', '0', '增加/修改功能', '0', '50', null);
INSERT INTO `osa_menu_url` VALUES ('47', '文章栏目权限', '/man/?t=art_auth', '1', '1', '0', '文章栏目权限管理（增删改查）', '0', '30', null);
INSERT INTO `osa_menu_url` VALUES ('48', '后台功能权限', '/man/?t=menu_auth', '1', '1', '0', '后台功能权限管理', '0', '30', null);
INSERT INTO `osa_menu_url` VALUES ('49', '用户管理', '', '1', '1', '0', '用户管理', '2', '0', 'fa fa-user');
INSERT INTO `osa_menu_url` VALUES ('50', '后台设置', '', '1', '1', '0', '后台设置', '5', '0', 'fa fa-server');
INSERT INTO `osa_menu_url` VALUES ('51', '添加/修改用户组', '/man/?t=group_am', '0', '1', '0', '添加/修改用户组', '0', '49', null);
INSERT INTO `osa_menu_url` VALUES ('52', '栏目管理', '/man/?t=art_cate', '1', '1', '0', '文章栏目管理', '0', '5', 'fa fa-bars');
INSERT INTO `osa_menu_url` VALUES ('53', '字体图标', '/man/?t=fontawesome', '0', '1', '0', '水水水水', '0', '50', 'fa fa-ban');
INSERT INTO `osa_menu_url` VALUES ('54', '咨询栏目添加修改', '/man/?t=consult_cate_am', '0', '1', '0', '', '0', '9', '');
INSERT INTO `osa_menu_url` VALUES ('55', '个人操作', '', '1', '1', '0', '', '1', '0', 'fa fa-certificate');
INSERT INTO `osa_menu_url` VALUES ('56', '我的发文', '/man/?t=myarts', '1', '1', '1', '', '0', '55', '');
INSERT INTO `osa_menu_url` VALUES ('57', '系统功能设置', '', '1', '1', '0', '', '7', '0', 'fa fa-gears');
INSERT INTO `osa_menu_url` VALUES ('58', '核心全局参数设置', '/man/?t=sys_config', '1', '1', '0', null, '0', '57', null);
INSERT INTO `osa_menu_url` VALUES ('59', '友情链接管理', '/man/?t=links', '1', '1', '0', null, '0', '57', null);
INSERT INTO `osa_menu_url` VALUES ('60', '友情链接添加/修改', '/man/?t=links_am', '0', '1', '0', null, '0', '57', null);
INSERT INTO `osa_menu_url` VALUES ('61', '我的发文添加/修改', '/man/?t=art_myam', '0', '1', '0', null, '0', '55', null);
INSERT INTO `osa_menu_url` VALUES ('62', '个人资料', '/man/?t=profile', '1', '1', '1', '', '0', '55', '');
INSERT INTO `osa_menu_url` VALUES ('63', '修改资料', '/man/?t=profile_am', '0', '1', '0', null, '0', '55', null);
INSERT INTO `osa_menu_url` VALUES ('64', '数据库工具', '/man/?t=database_tool', '1', '1', '0', '数据库备份、还原、优化', '0', '57', '');

-- ----------------------------
-- Table structure for `osa_user_group`
-- ----------------------------
DROP TABLE IF EXISTS `osa_user_group`;
CREATE TABLE `osa_user_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(32) DEFAULT NULL,
  `group_role` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `owner_id` int(11) DEFAULT NULL COMMENT '创建人ID',
  `group_desc` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `art_publish_auth` text,
  `art_audit_auth` tinyint(4) DEFAULT '1' COMMENT '默认需要审核',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='账号组';

-- ----------------------------
-- Records of osa_user_group
-- ----------------------------
INSERT INTO `osa_user_group` VALUES ('1', '超级管理员组', '1,4,2,3,5,6,7,8,52,55,56,61,62,63,49,22,23,27,51,9,10,11,12,54,30,47,48,50,34,35,53,57,58,59,60,64', '1', '超级管理员组', '0,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,57,58,62,63,64,65,66,67,68,69,70,71', '0');
INSERT INTO `osa_user_group` VALUES ('2', '默认账号组', '1,4,2,3,15,55,56,61,62,63', '1', '默认账号组', '0,30,43,44', '1');

-- ----------------------------
-- Table structure for `ppf_manager`
-- ----------------------------
DROP TABLE IF EXISTS `ppf_manager`;
CREATE TABLE `ppf_manager` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `pmd5` varchar(32) DEFAULT NULL,
  `lgnums` int(11) DEFAULT NULL,
  `lastip` varchar(15) DEFAULT NULL,
  `lasttime` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of ppf_manager
-- ----------------------------
INSERT INTO `ppf_manager` VALUES ('1', 'lren', '管理员', '8049c97086380932e96179fda9f7a7d8', '129', '::1', '1482974171', '1410234918');
INSERT INTO `ppf_manager` VALUES ('2', 'super', '总管理员1', '8049c97086380932e96179fda9f7a7d8', '1', '10.0.0.8', '1397610618', '1397293550');

-- ----------------------------
-- Table structure for `ppf_module`
-- ----------------------------
DROP TABLE IF EXISTS `ppf_module`;
CREATE TABLE `ppf_module` (
  `id` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `pidlist` varchar(100) DEFAULT NULL,
  `lvl` int(11) DEFAULT NULL,
  `childnums` int(11) DEFAULT NULL,
  `odx` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `hints` varchar(100) DEFAULT NULL,
  `tpl` varchar(60) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ppf_module
-- ----------------------------
INSERT INTO `ppf_module` VALUES ('1', '0', '0,1,', '1', '2', '0', '档案管理', '档案管理（审阅，评分）', 'dossier', '1397294218');
INSERT INTO `ppf_module` VALUES ('2', '1', '0,1,2,', '2', '0', '0', '审阅', null, 'state', '1397294285');
INSERT INTO `ppf_module` VALUES ('3', '1', '0,1,3,', '2', '0', '0', '评分', null, 'score', '1397294297');
INSERT INTO `ppf_module` VALUES ('4', '0', '0,4,', '1', '2', '0', '教师成长考核', null, 'assessment', '1397364129');
INSERT INTO `ppf_module` VALUES ('5', '4', '0,4,5,', '2', '0', null, '教师成长校（园）级考核', null, 'assessment_sch', '1397364158');
INSERT INTO `ppf_module` VALUES ('6', '4', '0,4,6,', '2', '0', null, '教师成长区级考核', null, 'assessment_reg', '1397364193');

-- ----------------------------
-- Table structure for `ppf_tpl`
-- ----------------------------
DROP TABLE IF EXISTS `ppf_tpl`;
CREATE TABLE `ppf_tpl` (
  `id` int(11) NOT NULL,
  `php` varchar(60) DEFAULT NULL,
  `tpl` varchar(100) DEFAULT NULL,
  `ico` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `tips` varchar(150) DEFAULT NULL,
  `ishtm` tinyint(4) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `pidlist` varchar(100) DEFAULT NULL,
  `lvl` tinyint(4) DEFAULT NULL,
  `childnums` smallint(6) DEFAULT NULL,
  `odx` int(11) DEFAULT NULL,
  `hidden` tinyint(4) DEFAULT NULL,
  `tblname` varchar(100) DEFAULT NULL,
  `tblkey` varchar(50) DEFAULT NULL,
  `ctrlpass` varchar(60) DEFAULT NULL,
  `tblsha1` varchar(60) DEFAULT NULL,
  `tblmd5` varchar(60) DEFAULT NULL,
  `tblunique` int(11) DEFAULT NULL,
  `tbldefault` int(11) DEFAULT NULL,
  `tblseed` varchar(5) DEFAULT NULL,
  `tblorder` varchar(50) DEFAULT NULL,
  `tblorderby` varchar(50) DEFAULT NULL,
  `treeis` tinyint(4) DEFAULT NULL,
  `treepid` varchar(60) DEFAULT NULL,
  `treepidlist` varchar(60) DEFAULT NULL,
  `formatdates` varchar(100) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  `usepre` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ppf_tpl
-- ----------------------------
INSERT INTO `ppf_tpl` VALUES ('1', null, 'no', '0.gif', 'GII-System', '系统管理', '0', '0', '0,1,', '1', '3', '0', '0', null, 'id', null, null, null, '0', '0', null, null, null, '0', null, null, null, '1397210235', null);
INSERT INTO `ppf_tpl` VALUES ('2', null, '111', ' ', '后台管理中心', null, '0', '0', '0,2,', '1', '6', '2', '0', null, null, null, null, null, '0', '0', null, null, null, '0', null, null, null, '1397634729', null);
INSERT INTO `ppf_tpl` VALUES ('3', null, null, '3.gif', '主站管理中心【顶级】', null, '0', '0', '0,3,', '1', '8', '8', '0', null, null, null, null, null, '0', '0', null, null, null, '0', null, null, null, '1397210041', null);
INSERT INTO `ppf_tpl` VALUES ('4', null, null, '4.gif', '前端页面处理操作', null, '0', '0', '0,4,', '1', '12', '5', '0', null, null, null, null, null, '0', '0', null, null, null, '0', null, null, null, '1397268185', null);
INSERT INTO `ppf_tpl` VALUES ('11', null, 'ppf_tpl', null, '模板管理', '模板管理', '1', '1', '0,1,11,', '2', '0', '0', '0', 'ppf_tpl', 'id', null, null, null, '2', '7', '1', 'odx', 'desc', '1', 'pid', 'pidlist', null, '1410396311', '0');
INSERT INTO `ppf_tpl` VALUES ('111', null, null, null, '三级模板', null, null, '11', null, '2', '0', '111', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('112', null, '1', null, '隐藏的模板操作', null, '0', '1', '0,1,112,', '1', '5', '0', '1', '1', 'id', null, null, null, '0', '0', 'time', 'id', 'desc', '0', 'pid', null, null, '1448607867', '0');
INSERT INTO `ppf_tpl` VALUES ('113', null, 'ppf_tpl_unique', null, '模板唯一字段', '唯一字段', '0', '112', '0,1,112,113,', '2', '0', '0', '1', 'ppf_tpl_unique', 'id', null, null, null, '0', '0', '1', 'id', 'desc', '0', 'pid', null, null, '1446102649', null);
INSERT INTO `ppf_tpl` VALUES ('114', null, 'ppf_tpl_default', null, '模板字段默认值', '模板字段默认值', '0', '112', '0,1,112,114,', '2', '0', '114', '1', 'ppf_tpl_default', 'id', null, null, null, '0', '0', '1', 'id', 'desc', '0', 'pid', null, null, '1397210272', null);
INSERT INTO `ppf_tpl` VALUES ('115', null, 'ppf_tpl_query', null, '模板查询字段', null, '0', '112', '0,1,112,115,', '2', '0', '115', '1', 'ppf_tpl_query', 'id', null, null, null, '0', '0', '1', 'id', 'desc', '0', null, null, null, '1397210274', null);
INSERT INTO `ppf_tpl` VALUES ('116', null, 'ppf_tpl_display', null, '模板显示字段', null, '0', '112', '0,1,112,116,', '2', '0', '116', '1', 'ppf_tpl_display', 'id', null, null, null, '0', '0', '1', 'id', 'desc', '0', null, null, null, '1397210276', null);
INSERT INTO `ppf_tpl` VALUES ('117', null, 'ppf_tpl_edit', null, '模板增删改字段', null, '0', '112', '0,1,112,117,', '2', '0', '117', '1', 'ppf_tpl_edit', 'id', null, null, null, '0', '1', '1', 'id', 'desc', '0', null, null, null, '1397210278', null);
INSERT INTO `ppf_tpl` VALUES ('118', null, 'ppf_manager', null, '系统帐号管理', null, '0', '1', '0,1,118,', '2', '0', '2', '0', 'ppf_manager', 'id', 'password', null, 'pmd5', '1', '3', 'time', 'id', 'desc', '0', 'pid', null, ',lasttime,', '1397210191', null);
INSERT INTO `ppf_tpl` VALUES ('168', 't.php', null, '0.gif', '用户中心', null, '0', '4', '0,4,168,', '2', '4', '168', '0', null, 'id', null, null, null, null, null, 'time', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1397268464', null);
INSERT INTO `ppf_tpl` VALUES ('169', 't.php', null, '1.gif', '个人空间', null, '0', '4', '0,4,169,', '2', '19', '169', '0', null, 'id', null, null, null, null, null, 'time', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1397268482', null);
INSERT INTO `ppf_tpl` VALUES ('170', 't.php', null, '2.gif', '教师空间', null, '0', '4', '0,4,170,', '2', '16', '170', '0', null, 'id', null, null, null, '0', '0', 'time', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1411872195', '0');
INSERT INTO `ppf_tpl` VALUES ('171', 't.php', 'tech', null, '教师空间信息', null, '1', '170', '0,4,170,171,', '3', '0', '172', '0', 'tech', 'id', null, null, null, '0', '0', '1', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1411872225', '1');
INSERT INTO `ppf_tpl` VALUES ('172', ' ', 'user_reg', null, '注册', null, '0', '168', '0,4,168,172,', '3', '0', '179', '0', 'act_member', 'id', 'pwd', null, 'pmd5', '3', '5', 'time', 'id', 'desc', '0', ' ', ' ', ',', '1401954383', '1');
INSERT INTO `ppf_tpl` VALUES ('174', 't.php', 'comm_subject', null, '公共学科管理', null, '1', '169', '0,4,169,174,', '3', '0', '176', '0', 'subject', 'id', null, null, null, '0', '0', '1', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1398742902', null);
INSERT INTO `ppf_tpl` VALUES ('175', 't.php', 'blog', null, '博客', null, '1', '169', '0,4,169,175,', '3', '0', '174', '0', 'blog_list', 'id', null, null, null, '0', '1', 'time', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1404207215', '0');
INSERT INTO `ppf_tpl` VALUES ('176', 't.php', 'comm_grade', null, '学段年级管理', null, '1', '169', '0,4,169,176,', '3', '0', '177', '0', 'grade', 'id', null, null, null, '0', '0', '1', 'odx', 'desc', '1', 'pid', 'pidlist', ',', '1399536859', null);
INSERT INTO `ppf_tpl` VALUES ('177', 't.php', 'comm_addr', null, '地址库管理', null, '1', '169', '0,4,169,177,', '3', '0', '196', '0', 'address', 'id', null, null, null, '0', '0', '1', 'odx', 'desc', '1', 'pid', 'pidlist', ',', '1399536913', null);
INSERT INTO `ppf_tpl` VALUES ('180', 't.php', 'faq_add', null, 'FAQ添加', null, '1', '170', '0,4,170,180,', '3', '0', '181', '0', 'tech_faq', 'id', null, null, null, '0', '0', 'time', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1412931223', '0');
INSERT INTO `ppf_tpl` VALUES ('181', 't.php', 'sys_info', null, '系统信息管理', null, '1', '200', '0,2,200,181,', '3', '0', '0', '0', 'sys_info', 'id', null, null, null, '0', '0', '1', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1401089580', null);
INSERT INTO `ppf_tpl` VALUES ('182', 't.php', null, '5.gif', '学生空间', null, '0', '4', '0,4,182,', '2', '5', '182', '0', null, 'id', null, null, null, '0', '0', 'time', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1414736470', '0');
INSERT INTO `ppf_tpl` VALUES ('186', 't.php', 'student', null, '学生空间表', null, '1', '182', '0,4,182,186,', '3', '0', '186', '0', 'student', 'id', null, null, null, '0', '0', 'time', 'id', 'desc', '0', 'pid', 'pidlist', ',', '1414736505', '0');
INSERT INTO `ppf_tpl` VALUES ('189', 't.php', 'ppf_module', null, '页面上权限模块', null, '1', '1', '0,1,189,', '2', '0', '5', '0', 'ppf_module', 'id', null, null, null, '1', '0', '1', 'odx', 'desc', '1', 'pid', 'pidlist', ',', '1397294233', null);
INSERT INTO `ppf_tpl` VALUES ('196', 't.php', 'zone', null, '空间设置', null, '1', '169', '0,4,169,196,', '3', '0', '175', '0', 'zone', 'id', null, null, null, '0', '0', '1', 'odx', 'desc', '0', 'pid', 'pidlist', ',', '1404983549', '0');
INSERT INTO `ppf_tpl` VALUES ('199', null, null, '1.gif', '业务管理', null, '0', '2', '0,2,199,', '2', '7', '2', '0', null, null, null, null, null, '0', '0', null, null, null, '0', null, null, null, '1400745403', null);
INSERT INTO `ppf_tpl` VALUES ('200', null, null, '2.gif', '系统管理', null, '0', '2', '0,2,200,', '2', '4', '0', '0', null, null, null, null, null, '0', '0', null, null, null, '0', null, null, null, '1400745409', null);
INSERT INTO `ppf_tpl` VALUES ('203', 't.php', 'sys_org_type', null, '学校类型', null, '0', '1363', '0,2,1363,203,', '3', '0', '0', '0', 'sys_org_type', 'id', null, null, null, '0', '0', '1', 'odx', 'desc', '0', 'pid', 'pidlist', null, '1448610665', '0');
INSERT INTO `ppf_tpl` VALUES ('207', 't.php', 'manager', null, '系统管理员', null, '0', '200', '0,2,200,207,', '3', '0', '1', '0', 'manager', 'id', 'pass', null, 'pmd5', '0', '0', '1', 'id', 'asc', '0', null, null, ',lasttime,', '1401089847', null);
INSERT INTO `ppf_tpl` VALUES ('210', 't.php', 'sys_server', null, '服务器管理', null, '0', '200', '0,2,200,210,', '3', '0', '4', '0', 'sys_server', 'id', null, null, null, '1', '1', '1', 'id', 'asc', '0', null, null, null, '1401178009', null);
INSERT INTO `ppf_tpl` VALUES ('212', null, null, '2.gif', '基础数据管理', null, '0', '2', '0,2,212,', '2', '4', '3', '0', null, null, null, null, null, '0', '0', null, null, null, '0', null, null, null, '1401850071', '0');
INSERT INTO `ppf_tpl` VALUES ('213', 't.php', 'sys_addr', null, '地址库管理', null, '1', '1363', '0,2,1363,213,', '3', '0', '9', '0', 'sys_addr', 'id', null, null, null, '0', '0', '1', 'odx', 'asc', '1', 'pid', 'pidlist', null, '1448609174', '0');
INSERT INTO `ppf_tpl` VALUES ('214', 't.php', 'sys_period', null, '学段', null, '1', '1363', '0,2,1363,214,', '3', '0', '3', '0', 'sys_period', 'id', null, null, null, '0', '0', '1', 'odx', 'asc', '0', 'pid', 'pidlist', null, '1448609196', '0');
INSERT INTO `ppf_tpl` VALUES ('215', 't.php', 'sys_subject', null, '学科', null, '1', '1363', '0,2,1363,215,', '3', '0', '8', '0', 'sys_subject', 'id', null, null, null, '0', '0', '100', 'odx', 'desc', '0', null, null, ' ', '1448609210', '0');
INSERT INTO `ppf_tpl` VALUES ('217', 't.php', 'class', null, '班级管理', null, '1', '199', '0,2,199,217,', '3', '0', '4', '0', 'class', 'id', null, null, null, '0', '0', 'time', 'id', 'desc', '0', null, null, ',timestamp,', '1419306018', '0');
INSERT INTO `ppf_tpl` VALUES ('218', 't.php', 'group', null, '群组管理', null, '1', '199', '0,2,199,218,', '3', '0', '6', '0', 'group', 'id', null, null, null, '0', '0', 'time', 'id', 'desc', '0', null, null, ',timestamp,', '1419313687', '0');
INSERT INTO `ppf_tpl` VALUES ('219', null, 'home', null, '个人信息修改', null, '0', '168', '0,4,168,219,', '3', '0', '219', '0', 'act_member', 'id', null, null, null, '0', '0', 'time', 'odx', 'desc', '0', null, null, null, '1418958760', '1');
INSERT INTO `ppf_tpl` VALUES ('224', null, 'contact', null, '联系方式', null, '0', '168', '0,4,168,224,', '3', '0', '224', '0', 'act_contacts', 'id', null, null, null, '0', '0', '1', 'id', 'asc', '0', null, null, 'timestamp', '1407314303', '0');
INSERT INTO `ppf_tpl` VALUES ('226', 't.php', 'sys_app', null, '接入网站管理', null, '0', '200', '0,2,200,226,', '3', '0', '4', '0', 'sys_app', 'id', null, null, null, '0', '1', '1', 'id', 'asc', '0', null, null, null, '1410505584', '0');
INSERT INTO `ppf_tpl` VALUES ('227', null, 'sys_grade', null, '年级', null, '1', '1363', '0,2,1363,227,', '3', '0', '5', '0', 'sys_grade', 'id', null, null, null, '0', '0', '1', 'id', 'asc', '0', null, null, null, '1448609215', '0');
INSERT INTO `ppf_tpl` VALUES ('228', null, 'school', null, '学校管理新', null, '1', '199', '0,2,199,228,', '3', '0', '1', '0', 'school', 'id', null, null, null, '4', '0', '1', null, null, '0', null, null, null, '1412735613', '0');
INSERT INTO `ppf_tpl` VALUES ('230', null, 'faq_info', null, 'FAQ_回复', null, '1', '170', '0,4,170,230,', '3', '0', '230', '0', 'tech_faq_question', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1412931268', '0');
INSERT INTO `ppf_tpl` VALUES ('231', null, 'tech_schedule', null, '日程', null, '0', '170', '0,4,170,231,', '3', '0', '0', '0', 'tech_schedule', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1420784129', '0');
INSERT INTO `ppf_tpl` VALUES ('233', null, 'sys_textbook_volume', null, '上下册', null, '1', '212', '0,2,212,233,', '3', '0', '233', '0', 'sys_textbook_volume', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1413270167', '0');
INSERT INTO `ppf_tpl` VALUES ('234', null, 'sys_textbook_chapter', null, '单元/章/节', null, '1', '212', '0,2,212,234,', '3', '0', '234', '0', 'sys_textbook_chapter', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1413268628', '0');
INSERT INTO `ppf_tpl` VALUES ('235', null, 'sys_textbook', null, '课文库', null, '1', '199', '0,2,199,235,', '3', '0', '8', '0', 'sys_textbook', 'id', null, null, null, '0', '0', '1', 'id', 'asc', '0', null, null, null, '1413268717', '0');
INSERT INTO `ppf_tpl` VALUES ('236', null, null, null, '隐藏数据处理', null, '0', '2', '0,2,236,', '2', '1', '20', '1', null, null, null, null, null, '0', '0', null, null, null, '0', null, null, null, '1413271683', '0');
INSERT INTO `ppf_tpl` VALUES ('237', null, 'act_member', null, '用户处理', null, '0', '199', '0,2,199,237,', '3', '0', '0', '0', 'act_member', 'id', 'pass', null, 'pmd5', '0', '0', 'time', 'id', 'desc', '0', null, null, ',timestamp,', '1446102766', '1');
INSERT INTO `ppf_tpl` VALUES ('239', null, 'tech_homework', null, '家庭作业', null, '1', '170', '0,4,170,239,', '3', '0', '239', '0', 'tech_homework', 'id', null, null, null, '0', '0', '1', 'id', 'desc', '0', null, null, null, '1413341888', '0');
INSERT INTO `ppf_tpl` VALUES ('240', null, 'res_courseware', null, '课件管理', null, '0', '170', '0,4,170,240,', '3', '0', '240', '0', 'res_courseware', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1413526226', '0');
INSERT INTO `ppf_tpl` VALUES ('241', null, 'res_type', null, '资源类型', null, '1', '212', '0,2,212,241,', '3', '0', '241', '0', 'res_type', 'id', null, null, null, '0', '0', '1', 'id', 'asc', '0', null, null, null, '1413527676', '0');
INSERT INTO `ppf_tpl` VALUES ('243', null, 'beike', null, '备课', null, '0', '170', '0,4,170,243,', '3', '0', '243', '0', 'beike', 'id', null, null, null, '0', '2', 'time', null, null, '0', null, null, null, '1414397782', '0');
INSERT INTO `ppf_tpl` VALUES ('245', null, 'beike_list', null, '备课列表页', null, '0', '170', '0,4,170,245,', '3', '0', '245', '0', 'beike_list', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1414463429', '0');
INSERT INTO `ppf_tpl` VALUES ('246', null, 'itembank', null, '题库', null, '0', '170', '0,4,170,246,', '3', '0', '246', '0', 'itembank', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1414561012', '0');
INSERT INTO `ppf_tpl` VALUES ('247', null, 'stu_note', null, '笔记', null, '0', '182', '0,4,182,247,', '3', '0', '247', '0', 'stu_note', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1415156655', '0');
INSERT INTO `ppf_tpl` VALUES ('248', null, null, null, '独立模块', null, null, '4', '0,4,248,', '2', '2', '248', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('249', null, 'faq', null, 'FAQ', null, '0', '248', '0,4,248,249,', '3', '0', '249', '0', 'faq', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1415092615', '0');
INSERT INTO `ppf_tpl` VALUES ('250', null, 'faq_answer', null, 'FAQ_回复', null, '0', '248', '0,4,248,250,', '3', '0', '250', '0', 'faq_answer', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1415151407', '0');
INSERT INTO `ppf_tpl` VALUES ('251', null, 'stu_datum', null, '学习资料', null, '0', '182', '0,4,182,251,', '3', '0', '251', '0', 'stu_datum', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1415239133', '0');
INSERT INTO `ppf_tpl` VALUES ('252', null, 'tech_class_subject', null, '班级任课', null, '0', '170', '0,4,170,252,', '3', '0', '252', '0', 'tech_class_subject', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1415265453', '0');
INSERT INTO `ppf_tpl` VALUES ('253', null, 'stu_homework', null, '家庭作业[学生]', null, '0', '182', '0,4,182,253,', '3', '0', '253', '0', 'stu_homework', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1415604229', '0');
INSERT INTO `ppf_tpl` VALUES ('254', null, 'stu_schedule', null, '学生计划', null, '0', '182', '0,4,182,254,', '3', '0', '254', '0', 'stu_schedule', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1415847842', '0');
INSERT INTO `ppf_tpl` VALUES ('255', null, null, null, '家长空间', null, null, '4', '0,4,255,', '2', '1', '255', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('256', null, 'guardian', null, '家长空间表', null, '0', '255', '0,4,255,256,', '3', '0', '256', '0', 'guardian', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1415848595', '0');
INSERT INTO `ppf_tpl` VALUES ('261', null, null, null, '班级空间', null, null, '4', '0,4,261,', '2', '15', '261', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('262', null, 'cls_notice', null, '班级通知', null, '0', '261', '0,4,261,262,', '3', '0', '262', '0', 'cls_notice', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1416988045', '0');
INSERT INTO `ppf_tpl` VALUES ('263', null, 'cls_activity', null, '班级活动', null, '0', '261', '0,4,261,263,', '3', '0', '263', '0', 'cls_activity', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1416992425', '0');
INSERT INTO `ppf_tpl` VALUES ('264', null, 'cls_diary', null, '班级日记', null, '0', '261', '0,4,261,264,', '3', '0', '264', '0', 'cls_diary', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1416993278', '0');
INSERT INTO `ppf_tpl` VALUES ('265', null, 'cls_honor', null, '班级荣誉', null, '0', '261', '0,4,261,265,', '3', '0', '265', '0', 'cls_honor', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1417664813', '0');
INSERT INTO `ppf_tpl` VALUES ('271', null, 'cls_mien', null, '班级风采', null, '0', '261', '0,4,261,271,', '3', '0', '271', '0', 'cls_mien', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1418713639', '0');
INSERT INTO `ppf_tpl` VALUES ('273', null, null, null, '名师工作室', null, null, '4', '0,4,273,', '2', '9', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('274', null, 'famous', null, '名师工作室', null, '0', '199', '0,2,199,274,', '3', '0', '3', '0', 'famous', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1439369786', '0');
INSERT INTO `ppf_tpl` VALUES ('275', null, 'blog_cate', null, '博客类别', null, '0', '169', '0,4,169,275,', '3', '0', '0', '0', 'blog_cate', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1420429735', '0');
INSERT INTO `ppf_tpl` VALUES ('278', null, 'blog_comments', null, '博客回复', null, '0', '169', '0,4,169,278,', '3', '0', '0', '0', 'blog_comments', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1420442361', '0');
INSERT INTO `ppf_tpl` VALUES ('279', null, 'weibo', null, '微博', null, '0', '169', '0,4,169,279,', '3', '0', '0', '0', 'weibo', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1420445496', '0');
INSERT INTO `ppf_tpl` VALUES ('280', null, 'friend_group', null, '好友分组', null, '0', '169', '0,4,169,280,', '3', '0', '0', '0', 'act_friend_group', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1420535004', '0');
INSERT INTO `ppf_tpl` VALUES ('281', null, 'zone_fav_type', null, '收藏类别', null, '0', '169', '0,4,169,281,', '3', '0', '0', '0', 'zone_fav_type', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1443348784', '0');
INSERT INTO `ppf_tpl` VALUES ('282', null, 'zone_album', null, '相册', null, '0', '169', '0,4,169,282,', '3', '0', '0', '0', 'zone_album', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1420614394', '0');
INSERT INTO `ppf_tpl` VALUES ('283', null, 'tech_def_property', null, '默认的属性', null, '0', '170', '0,4,170,283,', '3', '0', '0', '0', 'tech_def_property', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1420774895', '0');
INSERT INTO `ppf_tpl` VALUES ('284', null, null, null, '学校空间', null, null, '4', '0,4,284,', '2', '7', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('285', null, 'sch_art', null, '校园文章', null, '0', '284', '0,4,284,285,', '3', '0', '0', '0', 'sch_art', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1421225349', '0');
INSERT INTO `ppf_tpl` VALUES ('286', null, 'sch_art_cate', null, '校园文章类别', null, '0', '284', '0,4,284,286,', '3', '0', '0', '0', 'sch_art_cate', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1421225913', '0');
INSERT INTO `ppf_tpl` VALUES ('1280', null, 'famous_member', null, '空间成员', null, '0', '273', '0,4,273,1280,', '3', '0', '0', '0', 'famous_member', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1420612391', '0');
INSERT INTO `ppf_tpl` VALUES ('1281', null, 'famous_news', null, '新闻动态', null, '0', '273', '0,4,273,1281,', '3', '0', '0', '0', 'famous_news', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1420684484', '0');
INSERT INTO `ppf_tpl` VALUES ('1282', null, 'famous_plan', null, '工作室计划', null, '0', '273', '0,4,273,1282,', '3', '0', '0', '0', 'famous_plan', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1421134911', '0');
INSERT INTO `ppf_tpl` VALUES ('1283', null, 'famous_course', null, '教学课程', null, '0', '273', '0,4,273,1283,', '3', '0', '0', '0', 'famous_course', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1421203354', '0');
INSERT INTO `ppf_tpl` VALUES ('1284', null, 'famous_rearch', null, '课题研究', null, '0', '273', '0,4,273,1284,', '3', '0', '0', '0', 'famous_rearch', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1421204593', '0');
INSERT INTO `ppf_tpl` VALUES ('1285', null, 'famous_article', null, '论文', null, '0', '273', '0,4,273,1285,', '3', '0', '0', '0', 'famous_article', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1421206343', '0');
INSERT INTO `ppf_tpl` VALUES ('1286', null, 'famous_pic', null, '名师图片', null, '0', '273', '0,4,273,1286,', '3', '0', '0', '0', 'famous_pic', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1421823022', '0');
INSERT INTO `ppf_tpl` VALUES ('1287', null, 'sch_topic', null, '学校专题', null, '0', '284', '0,4,284,1287,', '3', '0', '0', '0', 'sch_topic', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1422338283', '0');
INSERT INTO `ppf_tpl` VALUES ('1288', null, 'famous_cate', null, '文章类别', null, '0', '273', '0,4,273,1288,', '3', '0', '0', '0', 'famous_cate', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1445571412', '0');
INSERT INTO `ppf_tpl` VALUES ('1290', null, 'sch_depart', null, '学校部门', null, '0', '284', '0,4,284,1290,', '3', '0', '0', '0', 'sch_department', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1438591131', '0');
INSERT INTO `ppf_tpl` VALUES ('1291', null, 'grp_member', null, '群组成员', null, '0', '236', '0,2,236,1291,', '3', '0', '0', '0', 'grp_member', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1438670657', '0');
INSERT INTO `ppf_tpl` VALUES ('1293', null, 'weibo_comments', null, '微博回复', null, '0', '169', '0,4,169,1293,', '3', '0', '0', '0', 'weibo_comments', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439198313', '0');
INSERT INTO `ppf_tpl` VALUES ('1297', null, 'main_member', null, '管理员', null, '0', '3', '0,3,1297,', '2', '0', '0', '0', 'main_member', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439430623', '0');
INSERT INTO `ppf_tpl` VALUES ('1298', null, '', null, '学科空间', null, null, '4', '0,4,1298,', '2', '15', '0', null, '', '', null, null, null, null, null, '', null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('1299', null, 'sub_resources', null, '资源发布', null, '0', '1298', '0,4,1298,1299,', '3', '0', '0', '0', 'sub_resources', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1440040886', '0');
INSERT INTO `ppf_tpl` VALUES ('1300', null, 'sub_news', null, '学科新闻', null, '0', '1298', '0,4,1298,1300,', '3', '0', '0', '0', 'sub_news', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1439514431', '0');
INSERT INTO `ppf_tpl` VALUES ('1301', null, 'sub_articles', null, '文章发布', null, '0', '1298', '0,4,1298,1301,', '3', '0', '0', '0', 'sub_articles', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439883282', '0');
INSERT INTO `ppf_tpl` VALUES ('1302', null, 'sub_slides', null, '首页幻灯片', null, '0', '1298', '0,4,1298,1302,', '3', '0', '0', '0', 'sub_slides', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1441182872', '0');
INSERT INTO `ppf_tpl` VALUES ('1303', null, 'subject', null, '学科空间', null, '0', '1298', '0,4,1298,1303,', '3', '0', '0', '0', 'subject', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439431261', '0');
INSERT INTO `ppf_tpl` VALUES ('1304', null, 'main_art_cate', null, '文章类别', null, '0', '3', '0,3,1304,', '2', '0', '0', '0', 'main_art_category', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439458127', '0');
INSERT INTO `ppf_tpl` VALUES ('1305', null, 'famous_slide', null, '幻灯片', null, '0', '273', '0,4,273,1305,', '3', '0', '0', '0', 'famous_slide', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439458563', '0');
INSERT INTO `ppf_tpl` VALUES ('1306', null, 'main_article', null, '文章列表管理', null, '0', '3', '0,3,1306,', '2', '0', '0', '0', 'main_article', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439519249', '0');
INSERT INTO `ppf_tpl` VALUES ('1307', null, 'sub_def_labels', null, '资源默认标签组', null, '0', '1298', '0,4,1298,1307,', '3', '0', '0', '0', 'sub_def_labels', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1440043132', '0');
INSERT INTO `ppf_tpl` VALUES ('1308', null, 'main_topic', null, '专题管理', null, '0', '3', '0,3,1308,', '2', '0', '0', '0', 'main_topic', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439523012', '0');
INSERT INTO `ppf_tpl` VALUES ('1309', null, 'sub_comments', null, '文章评论', null, '0', '1298', '0,4,1298,1309,', '3', '0', '0', '0', 'sub_comments', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1440489360', '0');
INSERT INTO `ppf_tpl` VALUES ('1310', null, 'main_problem', null, '课题管理', null, '0', '3', '0,3,1310,', '2', '0', '0', '0', 'main_problem', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439540268', '0');
INSERT INTO `ppf_tpl` VALUES ('1311', null, 'sub_article_type', null, '文章分类', null, '0', '1298', '0,4,1298,1311,', '3', '0', '0', '0', 'sub_article_type', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1439878709', '0');
INSERT INTO `ppf_tpl` VALUES ('1312', null, 'act_friend', null, '好友', null, '0', '169', '0,4,169,1312,', '3', '0', '0', '0', 'act_friend', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1440053628', '0');
INSERT INTO `ppf_tpl` VALUES ('1313', null, 'act_friend_apply', null, '好友申请', null, '0', '168', '0,4,168,1313,', '3', '0', '0', '0', 'act_friend_apply', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1440058088', '0');
INSERT INTO `ppf_tpl` VALUES ('1314', null, 'cls_cate', null, '类别管理', null, '0', '261', '0,4,261,1314,', '3', '0', '0', '0', 'class_category', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1440493812', '0');
INSERT INTO `ppf_tpl` VALUES ('1315', null, 'cls_art', null, '文章管理', null, '0', '261', '0,4,261,1315,', '3', '0', '0', '0', 'class_article', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1440495631', '0');
INSERT INTO `ppf_tpl` VALUES ('1316', null, 'cls_slide', null, '幻灯片管理', null, '0', '261', '0,4,261,1316,', '3', '0', '0', '0', 'cls_slide', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1440571667', '0');
INSERT INTO `ppf_tpl` VALUES ('1317', null, null, null, '活动', null, null, '4', '0,4,1317,', '2', '8', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('1318', null, 'activity', null, '活动列表', null, '0', '1317', '0,4,1317,1318,', '3', '0', '0', '0', 'activity', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1440984749', '0');
INSERT INTO `ppf_tpl` VALUES ('1319', null, 'active_lvl', null, '活动级别', null, '0', '1317', '0,4,1317,1319,', '3', '0', '0', '0', 'active_level', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1441078753', '0');
INSERT INTO `ppf_tpl` VALUES ('1320', null, 'active_cate', null, '活动类别', null, '0', '1317', '0,4,1317,1320,', '3', '0', '0', '0', 'active_category', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1441078828', '0');
INSERT INTO `ppf_tpl` VALUES ('1323', null, 'active_thing', null, '活动心得', null, '0', '1317', '0,4,1317,1323,', '3', '0', '0', '0', 'active_thing', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1441765996', '0');
INSERT INTO `ppf_tpl` VALUES ('1324', null, 'active_summary', null, '活动总结', null, '0', '1317', '0,4,1317,1324,', '3', '0', '0', '0', 'active_summary', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1441766010', '0');
INSERT INTO `ppf_tpl` VALUES ('1327', null, 'subjecter', null, '主学科空间', null, '0', '1298', '0,4,1298,1327,', '3', '0', '0', '0', 'subjecter', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1441768856', '0');
INSERT INTO `ppf_tpl` VALUES ('1328', null, 'subjecter_article_type', null, '主学科文章分类', null, '0', '1298', '0,4,1298,1328,', '3', '0', '0', '0', 'subjecter_article_type', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1441788782', '0');
INSERT INTO `ppf_tpl` VALUES ('1329', null, 'subjecter_articles', null, '主学科文章', null, '0', '1298', '0,4,1298,1329,', '3', '0', '0', '0', 'subjecter_articles', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1441789064', '0');
INSERT INTO `ppf_tpl` VALUES ('1331', null, 'subjecter_comments', null, '主学科文章评论', null, '0', '1298', '0,4,1298,1331,', '3', '0', '0', '0', 'subjecter_comments', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1441964085', '0');
INSERT INTO `ppf_tpl` VALUES ('1332', null, 'sch_admin', null, '管理员', null, '0', '284', '0,4,284,1332,', '3', '0', '0', '0', 'sch_admin', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1443173040', '0');
INSERT INTO `ppf_tpl` VALUES ('1333', null, 'photo', null, '照片', null, '0', '169', '0,4,169,1333,', '3', '0', '0', '0', 'zone_album_pic', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1443258411', '0');
INSERT INTO `ppf_tpl` VALUES ('1334', null, 'blog_comment_comments', null, '博客回复的回复', null, '0', '169', '0,4,169,1334,', '3', '0', '0', '0', 'blog_comment_comments', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1443322661', '0');
INSERT INTO `ppf_tpl` VALUES ('1335', null, 'zone_leave', null, '留言板', null, '0', '169', '0,4,169,1335,', '3', '0', '0', '0', 'zone_leave', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1443342089', '0');
INSERT INTO `ppf_tpl` VALUES ('1336', null, 'zone_leave_comments', null, '留言板回复', null, '0', '169', '0,4,169,1336,', '3', '0', '0', '0', 'zone_leave_comments', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1443347163', '0');
INSERT INTO `ppf_tpl` VALUES ('1337', null, 'teacher_news_type', null, '教师空间文章类别', null, '0', '170', '0,4,170,1337,', '3', '0', '0', '0', 'teacher_news_type', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1444704675', '0');
INSERT INTO `ppf_tpl` VALUES ('1338', null, 'zone_fav', null, '收藏夹', null, '0', '169', '0,4,169,1338,', '3', '0', '0', '0', 'zone_fav', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1443349275', '0');
INSERT INTO `ppf_tpl` VALUES ('1339', null, 'teacher_news', null, '教师空间文章', null, '0', '170', '0,4,170,1339,', '3', '0', '0', '0', 'teacher_news', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1444704670', '0');
INSERT INTO `ppf_tpl` VALUES ('1340', null, 'sys_zone_template', null, 'ZONE模板', null, '0', '1364', '0,2,1364,1340,', '3', '0', '0', '0', 'sys_zone_template', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1448609130', '0');
INSERT INTO `ppf_tpl` VALUES ('1341', null, 'subjecter_books', null, '课本管理', null, '0', '1298', '0,4,1298,1341,', '3', '0', '0', '0', 'subjecter_books', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1444376789', '0');
INSERT INTO `ppf_tpl` VALUES ('1342', null, 'cls_member', null, '班级成员管理', null, '0', '261', '0,4,261,1342,', '3', '0', '0', '0', 'cls_member', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1444456312', '0');
INSERT INTO `ppf_tpl` VALUES ('1343', null, 'cls_saying', null, '教师语录', null, '0', '261', '0,4,261,1343,', '3', '0', '0', '0', 'cls_saying', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1444616130', '0');
INSERT INTO `ppf_tpl` VALUES ('1344', null, 'cls_album', null, '班级相册', null, '0', '261', '0,4,261,1344,', '3', '0', '0', '0', 'cls_album', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1444618878', '0');
INSERT INTO `ppf_tpl` VALUES ('1345', null, 'cls_photo', null, '相册照片', null, '0', '261', '0,4,261,1345,', '3', '0', '0', '0', 'cls_photo', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1444619909', '0');
INSERT INTO `ppf_tpl` VALUES ('1346', null, 'sys_books_chapters', null, '章管理', null, '0', '1298', '0,4,1298,1346,', '3', '0', '0', '0', 'sys_books_chapters', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1444699715', '0');
INSERT INTO `ppf_tpl` VALUES ('1347', null, 'tech_grow', null, '教师空间成长规划文章', null, '0', '170', '0,4,170,1347,', '3', '0', '0', '0', 'tech_grow', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1445582012', '0');
INSERT INTO `ppf_tpl` VALUES ('1348', null, 'tech_grow_type', null, '教师空间成长规划文章类别', null, '0', '170', '0,4,170,1348,', '3', '0', '0', '0', 'tech_grow_type', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1445582036', '0');
INSERT INTO `ppf_tpl` VALUES ('1349', null, 'tech_grow_myinfo', null, '教师空间成长规划基本情况', null, '0', '170', '0,4,170,1349,', '3', '0', '0', '0', 'tech_grow_myinfo', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1445582041', '0');
INSERT INTO `ppf_tpl` VALUES ('1350', null, 'sys_textbook_edition', null, '教材版本', null, '0', '212', '0,2,212,1350,', '3', '0', '0', '0', 'sys_textbook_edition', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1444889503', '0');
INSERT INTO `ppf_tpl` VALUES ('1351', null, 'act_school', null, '学校用户—关连表', null, '0', '284', '0,4,284,1351,', '3', '0', '0', '0', 'act_school', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1444959461', '0');
INSERT INTO `ppf_tpl` VALUES ('1354', null, 'sch_slide', null, '幻灯片', null, '0', '284', '0,4,284,1354,', '3', '0', '0', '0', 'sch_slide', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1445590135', '0');
INSERT INTO `ppf_tpl` VALUES ('1355', null, 'sys_tpl_class', null, 'Class空间模板', null, '0', '1364', '0,2,1364,1355,', '3', '0', '0', '0', 'sys_tpl_class', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1448611959', '0');
INSERT INTO `ppf_tpl` VALUES ('1356', null, 'cls_comments', null, '班级评论', null, '0', '261', '0,4,261,1356,', '3', '0', '0', '0', 'cls_comments', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1445910553', '0');
INSERT INTO `ppf_tpl` VALUES ('1357', null, 'subjecter_resources', null, '资源管理', null, '0', '1298', '0,4,1298,1357,', '3', '0', '0', '0', 'subjecter_resources', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1446099208', '0');
INSERT INTO `ppf_tpl` VALUES ('1358', null, 'cls_art_cate', null, '新文章分类', null, '0', '261', '0,4,261,1358,', '3', '0', '0', '0', 'cls_art_cate', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1446110392', '0');
INSERT INTO `ppf_tpl` VALUES ('1359', null, 'cls_art_new', null, '新文章管理 ', null, '0', '261', '0,4,261,1359,', '3', '0', '0', '0', 'cls_art', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1446189189', '0');
INSERT INTO `ppf_tpl` VALUES ('1360', null, 'active_status', null, '活动状态', null, '0', '1317', '0,4,1317,1360,', '3', '0', '0', '0', 'active_status', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1446453653', '0');
INSERT INTO `ppf_tpl` VALUES ('1361', null, 'active_member', null, '活动成员', null, '0', '1317', '0,4,1317,1361,', '3', '0', '0', '0', 'active_member', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1446689786', '0');
INSERT INTO `ppf_tpl` VALUES ('1362', null, 'sys_tpl_index', null, 'Index模板管理', null, '0', '1364', '0,2,1364,1362,', '3', '0', '0', '0', 'sys_tpl_index', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1448609136', '0');
INSERT INTO `ppf_tpl` VALUES ('1363', null, '12', null, '数据字典', null, '0', '2', '0,2,1363,', '2', '5', '5', '0', null, null, null, null, null, null, null, null, null, null, '0', null, null, null, '1448609738', '0');
INSERT INTO `ppf_tpl` VALUES ('1364', null, '123', null, '模板管理', null, '0', '2', '0,2,1364,', '2', '6', '6', '0', null, null, null, null, null, null, null, null, null, null, '0', null, null, null, '1448609725', '0');
INSERT INTO `ppf_tpl` VALUES ('1365', null, 'sys_tpl_group', null, 'Group模板', null, '0', '1364', '0,2,1364,1365,', '3', '0', '0', '0', 'sys_tpl_group', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1455762077', '0');
INSERT INTO `ppf_tpl` VALUES ('1366', null, null, null, '群组空间', null, null, '4', '0,4,1366,', '2', '3', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('1367', null, 'grp_weibo', null, '群组微博', null, '0', '1366', '0,4,1366,1367,', '3', '0', '0', '0', 'grp_weibo', 'id', null, null, null, null, null, 'time', null, null, null, null, null, null, '1455862634', '0');
INSERT INTO `ppf_tpl` VALUES ('1368', null, 'grp_weibo_comment', null, '群组微博回复', null, '0', '1366', '0,4,1366,1368,', '3', '0', '0', '0', 'grp_weibo_comment', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1455862774', '0');
INSERT INTO `ppf_tpl` VALUES ('1369', null, 'grp_forum', null, '群组贴子', null, '0', '1366', '0,4,1366,1369,', '3', '0', '0', '0', 'grp_forum', 'id', null, null, null, null, null, 'time', null, null, null, null, null, null, '1456131036', '0');
INSERT INTO `ppf_tpl` VALUES ('1370', null, 'main_video_cate', null, '视频类别', null, '0', '3', '0,3,1370,', '2', '0', '0', '0', 'main_video_category', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1456557178', '0');
INSERT INTO `ppf_tpl` VALUES ('1371', null, 'main_video', null, '视频列表管理', null, '0', '3', '0,3,1371,', '2', '0', '0', '0', 'main_video', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1456557249', '0');
INSERT INTO `ppf_tpl` VALUES ('1372', null, null, null, '移动端', null, null, '0', '0,1372,', '1', '1', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('1373', null, '', null, '首页新闻管理', null, '0', '1372', '0,1372,1373,', '2', '3', '0', '0', '', '', null, null, null, null, null, '1', null, null, null, null, null, null, '1463122718', '0');
INSERT INTO `ppf_tpl` VALUES ('1374', null, 'mo_category', null, '移动新闻类别', null, '0', '1373', '0,1372,1373,1374,', '3', '0', '0', '0', 'mo_category', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1463121781', '0');
INSERT INTO `ppf_tpl` VALUES ('1375', null, 'mo_articles', null, '移动新闻管理', null, '0', '1373', '0,1372,1373,1375,', '3', '0', '0', '0', 'mo_articles', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1463122893', '0');
INSERT INTO `ppf_tpl` VALUES ('1376', null, 'mo_advers', null, '移动首页广告', null, '0', '1373', '0,1372,1373,1376,', '3', '0', '0', '0', 'mo_advers', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1463123330', '0');
INSERT INTO `ppf_tpl` VALUES ('1377', null, 'push', null, '博客推送', null, '0', '169', '0,4,169,1377,', '3', '0', '5', '0', 'push_list', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1463642035', '0');
INSERT INTO `ppf_tpl` VALUES ('1378', null, 'push_cate', null, '推送类别', null, '0', '1317', '0,4,1317,1378,', '3', '0', '5', '0', 'push_category', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1463726300', '0');
INSERT INTO `ppf_tpl` VALUES ('1379', null, 'sys_tpl_school', null, 'School模板', null, '0', '1364', '0,2,1364,1379,', '3', '0', '0', '0', 'sys_tpl_school', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1466761962', '0');
INSERT INTO `ppf_tpl` VALUES ('1380', null, 'sys_tpl_famous', null, 'Famous模板', null, '0', '1364', '0,2,1364,1380,', '3', '0', '0', '0', 'sys_tpl_famous', 'id', null, null, null, null, null, '1', null, null, null, null, null, null, '1466761969', '0');
INSERT INTO `ppf_tpl` VALUES ('1381', null, 'recommend_reply', null, '图书推荐点评', null, '0', '3', '0,3,1381,', '2', '0', '0', '0', 'recommend_reply', 'id', null, null, null, null, null, 'time', null, null, null, null, null, null, '1467258591', '0');
INSERT INTO `ppf_tpl` VALUES ('1382', null, 'art_cate_role', null, '文章权限管理', null, '0', '199', '0,2,199,1382,', '3', '0', '0', '0', 'main_art_category', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1472464548', '0');
INSERT INTO `ppf_tpl` VALUES ('1383', null, null, null, '连云教育', null, null, '0', '0,1383,', '1', '1', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('1384', null, null, null, '在线咨询', null, null, '1383', '0,1383,1384,', '2', '2', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('1385', null, 'consult_art_category', null, '咨询栏目', null, '0', '1384', '0,1383,1384,1385,', '3', '0', '0', '0', 'consult_art_category', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1477422451', '0');
INSERT INTO `ppf_tpl` VALUES ('1386', null, 'consult_art', null, '咨询页面', null, '0', '1384', '0,1383,1384,1386,', '3', '0', '0', '0', 'consult_art', 'id', null, null, null, '0', '0', 'time', null, null, '0', null, null, null, '1477422462', '0');
INSERT INTO `ppf_tpl` VALUES ('1387', null, 'osa_menu_url', null, 'man功能菜单', null, '0', '1389', '0,1389,1387,', null, null, null, null, 'osa_menu_url', 'menu_id', null, null, null, null, null, '1', null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('1388', null, 'osa_user_group', null, '用户组', null, '0', '1389', '0,1389,1388,', null, '0', '0', '0', 'osa_user_group', 'group_id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1482932253', '1');
INSERT INTO `ppf_tpl` VALUES ('1389', null, null, null, '管理员后台', null, null, '0', '0,1389,', '1', '4', '0', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `ppf_tpl` VALUES ('1390', null, 'sys_config', null, '系统配置', null, '0', '1389', '0,1389,1390,', '2', '0', '0', '0', 'sys_config', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1482458518', '0');
INSERT INTO `ppf_tpl` VALUES ('1391', null, 'links', null, '友情链接', null, '0', '1389', '0,1389,1391,', '2', '0', '0', '0', 'links', 'id', null, null, null, '0', '0', '1', null, null, '0', null, null, null, '1482604935', '0');

-- ----------------------------
-- Table structure for `ppf_tpl_default`
-- ----------------------------
DROP TABLE IF EXISTS `ppf_tpl_default`;
CREATE TABLE `ppf_tpl_default` (
  `id` int(11) NOT NULL,
  `ptid` int(11) DEFAULT NULL,
  `col` varchar(50) DEFAULT NULL,
  `val` varchar(60) DEFAULT NULL,
  `odx` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ppf_tpl_default
-- ----------------------------
INSERT INTO `ppf_tpl_default` VALUES ('1', '11', 'tbldefault', '0', null, '1397095319');
INSERT INTO `ppf_tpl_default` VALUES ('2', '11', 'tblunique', '0', null, null);
INSERT INTO `ppf_tpl_default` VALUES ('3', '11', 'ishtm', '0', null, null);
INSERT INTO `ppf_tpl_default` VALUES ('4', '118', 'lgnums', '0', null, '1397098037');
INSERT INTO `ppf_tpl_default` VALUES ('5', '117', 'hidden', '0', null, '1397106530');
INSERT INTO `ppf_tpl_default` VALUES ('6', '118', 'timestamp', '0', null, '1397106577');
INSERT INTO `ppf_tpl_default` VALUES ('8', '11', 'treeis', '0', null, '1397107979');
INSERT INTO `ppf_tpl_default` VALUES ('9', '11', 'hidden', '0', null, '1397119352');
INSERT INTO `ppf_tpl_default` VALUES ('10', '11', 'childnums', '0', null, '1397119357');
INSERT INTO `ppf_tpl_default` VALUES ('11', '11', 'odx', '0', null, '1397119361');
INSERT INTO `ppf_tpl_default` VALUES ('12', '142', 'state', '2', null, '1397199374');
INSERT INTO `ppf_tpl_default` VALUES ('13', '210', 'skey', 'md5(UNIX_TIMESTAMP())', null, '1401265787');
INSERT INTO `ppf_tpl_default` VALUES ('14', '209', 'unit', '0', null, '1401852771');
INSERT INTO `ppf_tpl_default` VALUES ('15', '209', 'ispublic', '0', null, '1401852713');
INSERT INTO `ppf_tpl_default` VALUES ('16', '209', 'isdefault', '0', null, '1401852722');
INSERT INTO `ppf_tpl_default` VALUES ('17', '172', 'face', '0', null, '1407319386');
INSERT INTO `ppf_tpl_default` VALUES ('18', '172', 'gold', '0', null, '1402994827');
INSERT INTO `ppf_tpl_default` VALUES ('19', '172', 'credit', '0', null, '1402994832');
INSERT INTO `ppf_tpl_default` VALUES ('20', '172', 'integral', '0', null, '1402994838');
INSERT INTO `ppf_tpl_default` VALUES ('21', '175', 'tid', '1', null, '1404207233');
INSERT INTO `ppf_tpl_default` VALUES ('22', '172', 'nick', 'UNIX_TIMESTAMP()', null, '1407319592');
INSERT INTO `ppf_tpl_default` VALUES ('23', '226', 'key', 'md5(now())', null, '1410505998');
INSERT INTO `ppf_tpl_default` VALUES ('24', '173', 'state', '0', null, '1412824337');
INSERT INTO `ppf_tpl_default` VALUES ('25', '173', 'default', '0', null, '1412844642');
INSERT INTO `ppf_tpl_default` VALUES ('26', '243', 'state', '0', null, '1414115060');
INSERT INTO `ppf_tpl_default` VALUES ('27', '243', 'del', '0', null, '1414115079');

-- ----------------------------
-- Table structure for `ppf_tpl_display`
-- ----------------------------
DROP TABLE IF EXISTS `ppf_tpl_display`;
CREATE TABLE `ppf_tpl_display` (
  `id` int(11) NOT NULL,
  `ptid` int(11) DEFAULT NULL,
  `col` varchar(50) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `odx` int(11) DEFAULT NULL,
  `hidden` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ppf_tpl_display
-- ----------------------------
INSERT INTO `ppf_tpl_display` VALUES ('1', '118', 'id', '编号', null, null);
INSERT INTO `ppf_tpl_display` VALUES ('2', '118', 'username', '用户名', null, null);
INSERT INTO `ppf_tpl_display` VALUES ('3', '118', 'name', '名称', null, null);
INSERT INTO `ppf_tpl_display` VALUES ('4', '118', 'lasttime', '最后登录', null, null);
INSERT INTO `ppf_tpl_display` VALUES ('5', '118', 'lastip', '最后ip', '3', '0');
INSERT INTO `ppf_tpl_display` VALUES ('6', '119', 'id', 'id', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('7', '119', 'name', 'name', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('8', '119', 'timestamp', 'timestamp', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('9', '129', 'name', '荣誉称号或奖励名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('10', '129', 'sdate', '获奖时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('11', '129', 'sdepart', '授奖部门', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('12', '129', 'pic', '证书', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('13', '130', 'name', '处分', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('14', '130', 'des', '原因', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('15', '130', 'sdate', '时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('16', '130', 'sdepart', '单位或部门', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('17', '130', 'pic', '证书', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('18', '131', 'name', '姓名', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('19', '131', 'y', '年度', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('20', '131', 'subject', '任教学科', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('21', '131', 'class', '任教班级', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('22', '131', 'sign', '签名', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('23', '132', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('24', '132', 'atime', '时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('25', '133', 'name', '课题名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('26', '133', 'subject', '学科', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('27', '133', 'class', '班级', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('28', '133', 'teach', '授课人', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('29', '133', 'sdate', '时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('30', '133', 'signheadman', '教研组长签字', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('31', '133', 'signpresident', '分管校长签字', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('32', '134', 'name', '课题名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('33', '134', 'lvl', '课题级别', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('34', '134', 'sdate', '日期', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('35', '134', 'des', '承担的研究内容', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('36', '135', 'name', '成果名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('37', '135', 'sdate', '时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('38', '135', 'des', '相关情况', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('39', '136', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('40', '136', 'atime', '时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('41', '137', 'name', '课题', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('42', '137', 'lessontype', '课型', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('43', '138', 'name', '课题', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('44', '138', 'lvl', '活动层次', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('45', '138', 'lessontype', '课型', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('46', '138', 'atime', '时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('47', '139', 'name', '主题', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('48', '139', 'compere', '主持人', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('49', '139', 'speaker', '主讲人', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('50', '139', 'addr', '地点', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('51', '139', 'atime', '时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('52', '143', 'name', '学校', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('53', '143', 'major', '专业', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('54', '143', 'systme', '学制', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('55', '143', 'education', '学历', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('56', '143', 'sdate', '时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('57', '144', 'corp', '单位', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('58', '144', 'position', '职位', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('59', '144', 'job', '从事工作', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('60', '144', 'sdate', '开始时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('61', '144', 'edate', '结束时间', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('62', '150', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('63', '150', 'odx', '排序', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('64', '150', 'mininame', '短名', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('65', '155', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('66', '155', 'odx', '排序', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('67', '156', 'id', '编号', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('68', '156', 'username', '用户名', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('69', '156', 'name', '姓名', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('70', '156', 'units', '单位', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('71', '156', 'departs', '部门', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('72', '156', 'roles', '角色', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('73', '203', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('74', '203', 'odx', '排序', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('81', '207', 'uname', '用户名', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('82', '207', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('83', '207', 'lgnums', '登录次数', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('84', '207', 'lasttime', '最后登录', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('85', '207', 'lastip', '最后ip', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('86', '208', 'id', '编号', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('87', '208', 'username', '用户名', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('88', '208', 'nick', '昵称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('89', '208', 'lgnums', '登录次数', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('90', '208', 'lasttime', '最后登录', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('92', '210', 'sid', '标识编号', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('93', '210', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('94', '210', 'url', '网址', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('95', '210', 'ip', 'ip', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('96', '211', 'id', 'id', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('97', '211', 'scode', '组织编号', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('98', '211', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('99', '211', 'mininame', '短名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('100', '211', 'odx', '排序', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('101', '210', 'skey', '通信key', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('102', '210', 'pre', '数据前缀', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('103', '208', 'units', '单位', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('104', '203', 'id', '编号', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('105', '215', 'id', '编号', '1', '0');
INSERT INTO `ppf_tpl_display` VALUES ('106', '215', 'name', '名称', '1', '0');
INSERT INTO `ppf_tpl_display` VALUES ('107', '215', 'odx', '排序', '1', '0');
INSERT INTO `ppf_tpl_display` VALUES ('108', '216', 'id', '编号', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('109', '216', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('110', '216', 'odx', '排序', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('111', '220', 'id', 'id', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('112', '220', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('113', '220', 'odx', '排序', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('114', '221', 'id', '编号', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('115', '221', 'idx', '索引', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('116', '221', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('117', '221', 'mdl', '模块', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('118', '226', 'id', '编号', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('119', '226', 'name', '名称', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('120', '226', 'key', '同步key', null, '0');
INSERT INTO `ppf_tpl_display` VALUES ('121', '226', 'unums', '使用次数', null, '0');

-- ----------------------------
-- Table structure for `ppf_tpl_unique`
-- ----------------------------
DROP TABLE IF EXISTS `ppf_tpl_unique`;
CREATE TABLE `ppf_tpl_unique` (
  `id` int(11) NOT NULL,
  `ptid` int(11) DEFAULT NULL,
  `col` varchar(60) DEFAULT NULL,
  `note` varchar(60) DEFAULT NULL,
  `odx` int(11) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ppf_tpl_unique
-- ----------------------------
INSERT INTO `ppf_tpl_unique` VALUES ('1', '11', 'tpl', '模板名不能重复', null, '1397095314');
INSERT INTO `ppf_tpl_unique` VALUES ('2', '11', 'id', '编号不能重复', null, '1397094203');
INSERT INTO `ppf_tpl_unique` VALUES ('3', '118', 'username', '用户名存在重复', '1', '1397098003');
INSERT INTO `ppf_tpl_unique` VALUES ('4', '141', 'username', '用户名已存在', null, '1397197412');
INSERT INTO `ppf_tpl_unique` VALUES ('5', '141', 'mobile', '手机号已存在', null, '1397197343');
INSERT INTO `ppf_tpl_unique` VALUES ('6', '141', 'email', '邮箱已存在', null, '1397197355');
INSERT INTO `ppf_tpl_unique` VALUES ('7', '141', 'cardno', '身份证已存在', null, '1397197368');
INSERT INTO `ppf_tpl_unique` VALUES ('8', '189', 'tpl', '模块名存在相同', null, '1397294320');
INSERT INTO `ppf_tpl_unique` VALUES ('9', '210', 'sid', '标识必须唯一', null, '1401178310');
INSERT INTO `ppf_tpl_unique` VALUES ('10', '172', 'username', '用户名已存在', null, '1401935661');
INSERT INTO `ppf_tpl_unique` VALUES ('11', '172', 'mobile', '手机号已存在', null, '1401935687');
INSERT INTO `ppf_tpl_unique` VALUES ('12', '172', 'email', '邮箱已存在', null, '1401935695');
INSERT INTO `ppf_tpl_unique` VALUES ('13', '119', 'id', '编号必须唯一2', null, '1410231970');
INSERT INTO `ppf_tpl_unique` VALUES ('14', '119', 'name', '你好', null, '1410232233');
INSERT INTO `ppf_tpl_unique` VALUES ('15', '237', 'username', '用户名存在', null, '1413271925');
INSERT INTO `ppf_tpl_unique` VALUES ('16', '237', 'mobile', '手机号存在', null, '1413271937');
INSERT INTO `ppf_tpl_unique` VALUES ('17', '237', 'email', '邮箱存在', null, '1413271952');
INSERT INTO `ppf_tpl_unique` VALUES ('18', '228', 'dns', '域名存在重复', null, '1441679080');
INSERT INTO `ppf_tpl_unique` VALUES ('19', '228', 'name', '学校名称已存在', null, '1443163154');
INSERT INTO `ppf_tpl_unique` VALUES ('20', '228', 'scode', '组织机构代码已存在', null, '1443163170');
INSERT INTO `ppf_tpl_unique` VALUES ('21', '228', 'mininame', '简称已存在', null, '1443163193');

-- ----------------------------
-- Table structure for `sys_config`
-- ----------------------------
DROP TABLE IF EXISTS `sys_config`;
CREATE TABLE `sys_config` (
  `id` int(11) NOT NULL DEFAULT '1',
  `web_name` varchar(255) DEFAULT NULL,
  `web_url` varchar(255) DEFAULT NULL,
  `web_keyword` varchar(255) DEFAULT NULL,
  `web_des` varchar(255) DEFAULT NULL,
  `web_email` varchar(32) DEFAULT NULL,
  `web_state` tinyint(4) DEFAULT '1',
  `web_close_reason` text,
  `db_database` varchar(32) DEFAULT 'mysql',
  `db_host` varchar(32) DEFAULT 'localhost',
  `db_port` int(11) DEFAULT '3306',
  `db_user` varchar(32) DEFAULT 'root',
  `db_pwd` varchar(32) DEFAULT NULL,
  `db_name` varchar(32) DEFAULT NULL,
  `db_charset` varchar(32) DEFAULT 'utf8',
  `app_state` tinyint(4) DEFAULT '0' COMMENT '是否开启统一登录',
  `app_login` varchar(255) DEFAULT NULL,
  `app_url` varchar(255) DEFAULT NULL,
  `app_id` int(11) DEFAULT NULL,
  `app_key` int(11) DEFAULT NULL,
  `app_orgid` int(11) DEFAULT NULL,
  `app_opta` tinyint(4) DEFAULT '0' COMMENT '统一登录是否对其他机构开放',
  `app_opta_oid` text COMMENT '对指定机构开放的机构id字符串',
  `s_state` tinyint(4) DEFAULT '0',
  `s_root_path` varchar(255) DEFAULT './shtm',
  `s_expir` int(11) DEFAULT '7',
  `s_auto_clean` tinyint(4) DEFAULT '1',
  `s_auto_clean_expir` int(11) DEFAULT '15',
  `timer` int(11) DEFAULT '1490067073',
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_config
-- ----------------------------
INSERT INTO `sys_config` VALUES ('1', 'demo1', '', 'demo1', 'demo1', '', '1', '', 'mysql', 'localhost', '3308', 'root', '', 'hcms_db', 'utf8', '0', 'http://uc.jssns.cn/', 'http://uc.jssns.cn/api/jsonp/', '0', '0', '0', '1', '', '1', './shtm', '7', '1', '15', '1490252441', '1490336607');
