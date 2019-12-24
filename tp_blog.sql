/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : tp_blog

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2019-12-24 10:27:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dp_admin
-- ----------------------------
DROP TABLE IF EXISTS `dp_admin`;
CREATE TABLE `dp_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nickname` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0是禁用，1是可用',
  `super` int(11) NOT NULL DEFAULT '0' COMMENT '0是普通管理员，1是超级管理员',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_admin
-- ----------------------------
INSERT INTO `dp_admin` VALUES ('1', 'ruisi', '585858', '睿思', '1933796607@qq.com', '1', '1', '1522935251', '1575428278', null);
INSERT INTO `dp_admin` VALUES ('47', 'admin', '58585858', '睿思', 'ruisi0115@qq.com', '1', '0', '1575423661', '1576210768', null);
INSERT INTO `dp_admin` VALUES ('49', 'admin01', '585858', '管理员01', '6468978@qq.com', '1', '0', '1576205567', '1576210842', '1576210842');

-- ----------------------------
-- Table structure for dp_article
-- ----------------------------
DROP TABLE IF EXISTS `dp_article`;
CREATE TABLE `dp_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) NOT NULL,
  `atop` enum('1','0') NOT NULL DEFAULT '0' COMMENT '0是不推荐，1是推荐',
  `cateid` int(11) NOT NULL,
  `author` varchar(10) NOT NULL,
  `click` int(11) NOT NULL DEFAULT '0',
  `comment` int(11) NOT NULL DEFAULT '0',
  `tags` varchar(100) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_article
-- ----------------------------
INSERT INTO `dp_article` VALUES ('13', 'php', '1', '8', '睿思', '6', '1', '睿思test', 'test文章', '<p><span style=\"color: rgb(31, 73, 125);\"><strong>test文章<span style=\"color: rgb(255, 0, 0); background-color: rgb(255, 0, 0);\"></span></strong></span></p>', '1575611852', '1576382688', null);
INSERT INTO `dp_article` VALUES ('14', 'PHP02', '1', '8', '睿思', '2', '0', 'PHP|睿思', 'PHP概要', '<p>PHP内容</p>', '1575858864', '1576394614', null);
INSERT INTO `dp_article` VALUES ('15', 'MySQL', '1', '9', '睿思', '0', '0', 'MySQL', 'SQL概要', '<p>SQL内容</p>', '1575858909', '1575868774', null);
INSERT INTO `dp_article` VALUES ('16', 'MySQL02', '1', '9', '睿思', '0', '0', 'MySQL', 'SQL概要', '<p>MySQL内容</p>', '1575859014', '1576394607', null);
INSERT INTO `dp_article` VALUES ('17', 'Laravel', '1', '11', '睿思', '53', '4', 'Laravel|睿思', 'Laravel概要', '<p>laravel内容</p>', '1575859105', '1576394599', null);

-- ----------------------------
-- Table structure for dp_cate
-- ----------------------------
DROP TABLE IF EXISTS `dp_cate`;
CREATE TABLE `dp_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catename` varchar(10) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_cate
-- ----------------------------
INSERT INTO `dp_cate` VALUES ('8', 'PHP', '1', '1575519762', '1576382688', null);
INSERT INTO `dp_cate` VALUES ('9', 'MySql', '2', '1575519818', '1575604089', null);
INSERT INTO `dp_cate` VALUES ('10', 'thinkPHP', '3', '1575519925', '1575519925', null);
INSERT INTO `dp_cate` VALUES ('11', 'Laravel', '4', '1575519941', '1575524149', null);
INSERT INTO `dp_cate` VALUES ('12', '技术', '5', '1575598342', '1576209454', null);

-- ----------------------------
-- Table structure for dp_comment
-- ----------------------------
DROP TABLE IF EXISTS `dp_comment`;
CREATE TABLE `dp_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `articleid` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_comment
-- ----------------------------
INSERT INTO `dp_comment` VALUES ('3', '不错', '13', '3', '1576382688', '1576382688', null);
INSERT INTO `dp_comment` VALUES ('4', 'laravel框架是PHP最好框架-', '17', '2', '1576556327', '1576556327', null);
INSERT INTO `dp_comment` VALUES ('5', '真不错\r\n', '17', '2', '1576558531', '1576558531', null);
INSERT INTO `dp_comment` VALUES ('6', '真好', '17', '2', '1576558546', '1576558546', null);
INSERT INTO `dp_comment` VALUES ('7', '真心强\r\n', '17', '2', '1576558556', '1576558556', null);

-- ----------------------------
-- Table structure for dp_member
-- ----------------------------
DROP TABLE IF EXISTS `dp_member`;
CREATE TABLE `dp_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '0是禁用，1是可用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_member
-- ----------------------------
INSERT INTO `dp_member` VALUES ('2', 'member01', '585858', '睿思', 'ruisi0115@qq.com', '1', '1575947116', '1575947116', null);
INSERT INTO `dp_member` VALUES ('3', 'member02', '585858', '睿思3', '54689785@qq.com', '1', '1575947170', '1576381942', null);
INSERT INTO `dp_member` VALUES ('4', 'member03', '123456', '睿思', '546545689785@qq.com', '1', '1575947185', '1575951006', null);
INSERT INTO `dp_member` VALUES ('5', 'member04', '585858', '睿思', '5689785@qq.com', '1', '1575947203', '1576126289', null);
INSERT INTO `dp_member` VALUES ('6', 'member05', '585858', '睿思', '5689125@qq.com', '1', '1575947218', '1575951980', null);

-- ----------------------------
-- Table structure for dp_system
-- ----------------------------
DROP TABLE IF EXISTS `dp_system`;
CREATE TABLE `dp_system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webname` varchar(30) NOT NULL,
  `shortname` varchar(10) NOT NULL,
  `copyright` varchar(50) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dp_system
-- ----------------------------
INSERT INTO `dp_system` VALUES ('1', '睿思个人博客', '睿思blog', 'www.ruisiblog.com.cn', '1522936637', '1576384790', null);
SET FOREIGN_KEY_CHECKS=1;
