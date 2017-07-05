/*
Navicat MySQL Data Transfer

Source Server         : 测试
Source Server Version : 50173
Source Host           : bdm240661320.my3w.com:3306
Source Database       : bdm240661320_db

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-07-05 10:04:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ucenter
-- ----------------------------
DROP TABLE IF EXISTS `ucenter`;
CREATE TABLE `ucenter` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `face` varchar(255) DEFAULT NULL,
  `regtime` int(11) NOT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `sex` varchar(255) NOT NULL,
  `openid` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=gbk;
