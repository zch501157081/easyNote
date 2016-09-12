/*
Navicat MySQL Data Transfer

Source Server         : tt
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : easynote

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-09-12 13:18:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for en_admin
-- ----------------------------
DROP TABLE IF EXISTS `en_admin`;
CREATE TABLE `en_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_number` varchar(20) NOT NULL COMMENT '用户账号',
  `admin_password` varchar(33) NOT NULL COMMENT '密码',
  `admin_name` varchar(32) NOT NULL COMMENT '用户昵称',
  `admin_age` int(11) NOT NULL DEFAULT '18',
  `admin_sex` enum('0','1') NOT NULL DEFAULT '1',
  `admin_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_number` (`admin_number`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for en_group
-- ----------------------------
DROP TABLE IF EXISTS `en_group`;
CREATE TABLE `en_group` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL COMMENT '用户',
  `group_name` varchar(20) NOT NULL COMMENT '分组',
  PRIMARY KEY (`group_id`),
  UNIQUE KEY `group_name` (`group_name`),
  KEY `FK_group_admin_id` (`admin_id`),
  CONSTRAINT `FK_group_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `en_admin` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for en_note
-- ----------------------------
DROP TABLE IF EXISTS `en_note`;
CREATE TABLE `en_note` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL COMMENT '用户',
  `note_title` varchar(30) NOT NULL,
  `note_content` varchar(1000) DEFAULT '',
  `note_group` varchar(15) DEFAULT '生活杂记',
  `note_status` tinyint(4) NOT NULL DEFAULT '0',
  `note_style` varchar(200) DEFAULT '' COMMENT '文章样式',
  `note_picture` varchar(50) DEFAULT '' COMMENT '图片',
  `note_file` varchar(50) DEFAULT '' COMMENT '额外文件',
  `note_createtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `note_modifytime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `note_password` varchar(33) DEFAULT '',
  PRIMARY KEY (`note_id`),
  KEY `FK_admin_note_id` (`admin_id`),
  CONSTRAINT `FK_admin_note_id` FOREIGN KEY (`admin_id`) REFERENCES `en_admin` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
