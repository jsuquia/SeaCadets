/*
 Navicat Premium Data Transfer

 Source Server         : LocalHost
 Source Server Type    : MySQL
 Source Server Version : 50719
 Source Host           : localhost:3306
 Source Schema         : mydb

 Target Server Type    : MySQL
 Target Server Version : 50719
 File Encoding         : 65001

 Date: 12/03/2018 11:04:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for session
-- ----------------------------
DROP TABLE IF EXISTS `session`;
CREATE TABLE `session`  (
  `ID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE,
  INDEX `fk_user_ID_idx`(`user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of session
-- ----------------------------
INSERT INTO `session` VALUES ('3YdaCz1yN0ZCnsKwtRFV7M7e9Z2vHuHX3nRITiexWkJm4S1oVkpKoEruTcjiqmcbhqABGL5PPDY40BAr8hNOb2pvXOJWDxfwggQUzyfMUI9jdEt8Qa6lGFL5', '1');
INSERT INTO `session` VALUES ('Cm1GPRcgk8sNK27wRvJ9U7gf36vlzZT06xerKna0tNpDCD5M184ijZbVXd3duF2cqPoHnu5JBfeplVbMYokWhjtS4irsGLqmyySIOHUEWATAhQY9LBXIEFxa', '1');
INSERT INTO `session` VALUES ('DIE3ykSGciG7kCMlOfvVJPx5WLHXZmnEgTRw68OKxpuH1ale398sj0uAZ46K5ioCB7qtvaorpFsN2qcjYQN4zBPDMUgyhAnm9XdhVJwret0Tzfb1IQFLSdYb', '1');
INSERT INTO `session` VALUES ('EgPfaqjFF2KbCnAilHpdNjO67fZyWoDDPGsqYQis97xJb6XZIWUdYKScze8kLr4aOh1UAyvMgwLQpJRhN5ncuMz93wR0o2GXVBBtulrtI8m01H3xTSm5kTev', '1');
INSERT INTO `session` VALUES ('erqtRkDO6ATvQx3Kp1VwrcmWPkzG8xunXCWR4JmftIH9oLfsVIHjFaUiCX2LPEQ9hqzuSgZnYK3B254EMl1Zbg6jbAJUMivFcyoaleSN7BYOTshdpd7NDy50', '1');
INSERT INTO `session` VALUES ('JJAGF1uNpe2cWALqBV6HD3r00lDlSIxdfw6gPuLEG3bnzmd4ot78EgCQSRhYv1H7paetUmMYkxPzO58K94NajhBZqibMXroy5sOQTWiUTjkvCXw2csRIV9nZ', '1');
INSERT INTO `session` VALUES ('jXZLOr20vpefQBUWqWxxDcEE5eDZkSFScTuhYXNKRviPo7COjdnFA49IUPspzg81Y8olT7G5BJNwwAg1MhI06mr3bnlqHasCyk2Ri63zQuMJmf9dayVHttKV', '1');
INSERT INTO `session` VALUES ('pAvKhPR0bF32Q0kB4v3mDQmGac9dVSOoBOYjnnxs6lyIMUEMqZt8ihCXIJfL4euTpoqEiw18gkwCjtTlGXrf5Ad5urYKy2NPLsz6Rb1N7zHWWJFex9ScaZUH', '1');

-- ----------------------------
-- Table structure for usergroups
-- ----------------------------
DROP TABLE IF EXISTS `usergroups`;
CREATE TABLE `usergroups`  (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `usergroup` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `usergroupID` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 100 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usergroups
-- ----------------------------
INSERT INTO `usergroups` VALUES (1, 'btd5builds', 'S6H031N7L');
INSERT INTO `usergroups` VALUES (2, 'battlesbuilds', 'S6GUTTZCK');
INSERT INTO `usergroups` VALUES (3, 'bsm2builds', 'S6H1JTZ42');
INSERT INTO `usergroups` VALUES (4, 'bmcbuilds', 'S6H5FS4SZ');
INSERT INTO `usergroups` VALUES (5, 'sas4builds', 'S6H3B7EG4');
INSERT INTO `usergroups` VALUES (6, 'tkbuilds', 'S6HTS9WRL');
INSERT INTO `usergroups` VALUES (99, 'here', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `ID` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '$2y$11$lS5vi0pTppp2xmRj9bISd.0qumbMlQ2GNpi2vMwTjT62d88p0d/ci');

SET FOREIGN_KEY_CHECKS = 1;
