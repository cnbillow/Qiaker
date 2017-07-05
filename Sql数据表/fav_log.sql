/*
Navicat MySQL Data Transfer

Source Server         : 测试
Source Server Version : 50173
Source Host           : bdm240661320.my3w.com:3306
Source Database       : bdm240661320_db

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-07-05 10:05:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for fav_log
-- ----------------------------
DROP TABLE IF EXISTS `fav_log`;
CREATE TABLE `fav_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `infoid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=gbk;
