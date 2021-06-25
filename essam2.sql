-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for essam2
CREATE DATABASE IF NOT EXISTS `essam2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `essam2`;

-- Dumping structure for table essam2.cources_events
CREATE TABLE IF NOT EXISTS `cources_events` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table essam2.cources_types
CREATE TABLE IF NOT EXISTS `cources_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT '',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table essam2.cources_users
CREATE TABLE IF NOT EXISTS `cources_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `state_date` datetime DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1-userid` (`user_id`),
  KEY `FK2-courseid` (`course_id`),
  CONSTRAINT `FK1-userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2-courseid` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table essam2.coursemaster_departments
CREATE TABLE IF NOT EXISTS `coursemaster_departments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `department_id` bigint(20) NOT NULL,
  `coursemaster_id` bigint(20) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `state_date` datetime DEFAULT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK1-departmentid` (`department_id`),
  KEY `FK2-coursemasterid` (`coursemaster_id`),
  CONSTRAINT `FK1-departmentid` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2-coursemasterid` FOREIGN KEY (`coursemaster_id`) REFERENCES `course_masters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table essam2.courses
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `masterid` bigint(20) NOT NULL,
  `name` varchar(250) DEFAULT '',
  `datefrom` datetime DEFAULT NULL,
  `dateto` datetime DEFAULT NULL,
  `type` bigint(20) DEFAULT NULL,
  `notes` varchar(200) DEFAULT '',
  `stutes` bigint(20) DEFAULT NULL COMMENT 'exit or no',
  `countemp` bigint(20) DEFAULT NULL,
  `countdays` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name_datefrom_type` (`name`,`datefrom`,`type`),
  KEY `FK1-coursmaster` (`masterid`),
  CONSTRAINT `FK1-coursmaster` FOREIGN KEY (`masterid`) REFERENCES `course_masters` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table essam2.course_masters
CREATE TABLE IF NOT EXISTS `course_masters` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '',
  `place` varchar(50) DEFAULT NULL,
  `notes` varchar(200) DEFAULT '',
  `status` varchar(50) DEFAULT NULL,
  `importid` varchar(100) DEFAULT '',
  `type` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table essam2.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table essam2.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT '',
  `jobmaster` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `job_nameuk` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

-- Dumping structure for table essam2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cevile_id` bigint(12) NOT NULL,
  `department_id` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `shit` varchar(5) DEFAULT '',
  `hiredate` date DEFAULT NULL,
  `joindate` date DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `sex` varchar(8) DEFAULT NULL,
  `ordering` bigint(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `CIVILID` (`cevile_id`) USING BTREE,
  KEY `FK1_department` (`department_id`) USING BTREE,
  CONSTRAINT `FK_users_departmentes` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
