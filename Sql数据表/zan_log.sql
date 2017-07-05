/*
Navicat MySQL Data Transfer

Source Server         : 测试
Source Server Version : 50173
Source Host           : bdm240661320.my3w.com:3306
Source Database       : bdm240661320_db

Target Server Type    : MYSQL
Target Server Version : 50173
File Encoding         : 65001

Date: 2017-07-05 10:04:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for zan_log
-- ----------------------------
DROP TABLE IF EXISTS `zan_log`;
CREATE TABLE `zan_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `infoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=265 DEFAULT CHARSET=gbk;
