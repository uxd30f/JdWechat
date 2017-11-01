/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : wechat

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-11-01 08:41:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_admin
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `md5` varchar(50) DEFAULT NULL,
  `juri` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', null, '0');
INSERT INTO `t_admin` VALUES ('5', '324', null, null, '1');
INSERT INTO `t_admin` VALUES ('6', '23', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', null, '1');
INSERT INTO `t_admin` VALUES ('7', '1', 'c4ca4238a0b923820dcc509a6f75849b', null, '1');
INSERT INTO `t_admin` VALUES ('8', '12323', 'c4ca4238a0b923820dcc509a6f75849b', null, '1');
INSERT INTO `t_admin` VALUES ('9', '123', '202cb962ac59075b964b07152d234b70', null, '1');

-- ----------------------------
-- Table structure for t_notes
-- ----------------------------
DROP TABLE IF EXISTS `t_notes`;
CREATE TABLE `t_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_notes
-- ----------------------------

-- ----------------------------
-- Table structure for t_student
-- ----------------------------
DROP TABLE IF EXISTS `t_student`;
CREATE TABLE `t_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `openid` varchar(30) NOT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `sex` varchar(11) DEFAULT NULL,
  `headimgurl` varchar(255) DEFAULT NULL,
  `work_hour` float DEFAULT '0',
  `phone` varchar(255) DEFAULT NULL,
  `height` varchar(255) DEFAULT NULL,
  `special` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_student
-- ----------------------------
INSERT INTO `t_student` VALUES ('11', '16648464', '施国鹏', 'oz0EmwKB2qdsUVB6-cNn7_JZ5Yvg', '等月人', '男', 'http://wx.qlogo.cn/mmhead/a18XcQ1EBBiaiawPVDz2Ikxtb7EZjINyncOXuicUsXuu3fQDISUb8G3HA/0', '0', '1567846644', '168', '无特长');

-- ----------------------------
-- Table structure for t_task
-- ----------------------------
DROP TABLE IF EXISTS `t_task`;
CREATE TABLE `t_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `work_hours` int(11) DEFAULT NULL,
  `need_num` int(11) DEFAULT NULL,
  `ticket` varchar(255) DEFAULT NULL,
  `brief` text,
  `Publisher` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_task
-- ----------------------------
INSERT INTO `t_task` VALUES ('61', '234', '2017-10-29 01:43:00', '2', '234', 'gQEn8TwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyS3pzS3NNZjFjQzAxV09HWTFwMVkAAgSywfRZAwQA6QcA', '234', null);
INSERT INTO `t_task` VALUES ('62', '234', '2017-10-20 01:48:00', '3', '2', 'gQG-8DwAAAAAAAAAAS5odHRwOi8vd2VpeGluLnFxLmNvbS9xLzAyV3c2dXMzZjFjQzAxWHVIWXhwMUkAAgTewvRZAwQA6QcA', '234', 'admin');
