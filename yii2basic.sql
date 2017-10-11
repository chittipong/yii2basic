-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.25 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2016-01-17 21:18:08
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table yii2basic.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.auth_assignment: ~4 rows (approximately)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('admin', 4, NULL),
	('admin', 17, NULL),
	('admin-news', 17, NULL),
	('create-product', 1, NULL);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;


-- Dumping structure for table yii2basic.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.auth_item: ~10 rows (approximately)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('admin', 1, 'admin can access all system', NULL, NULL, NULL, NULL),
	('admin-news', 1, 'user for manage news', NULL, NULL, NULL, NULL),
	('create-news', 1, 'allow user can add news', NULL, NULL, NULL, NULL),
	('create-product', 1, 'allow user can add product', NULL, NULL, NULL, NULL),
	('create-user', 1, 'allow user can add user', NULL, NULL, NULL, NULL),
	('del-news', 1, 'allow user can delete news', NULL, NULL, NULL, NULL),
	('del-product', 1, 'allow user can delete product', NULL, NULL, NULL, NULL),
	('del-user', 1, 'allow user can del user', NULL, NULL, NULL, NULL),
	('update-news', 1, 'allow user can edit news', NULL, NULL, NULL, NULL),
	('update-product', 1, 'allow user can edit product', NULL, NULL, NULL, NULL),
	('update-user', 1, 'allow user can edit user', NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;


-- Dumping structure for table yii2basic.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.auth_item_child: ~9 rows (approximately)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin-news', 'create-news'),
	('admin', 'create-product'),
	('admin', 'create-user'),
	('admin', 'del-news'),
	('admin-news', 'del-news'),
	('admin', 'del-product'),
	('admin', 'del-user'),
	('admin', 'update-news'),
	('admin-news', 'update-news'),
	('admin', 'update-product'),
	('admin', 'update-user');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;


-- Dumping structure for table yii2basic.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.auth_rule: ~0 rows (approximately)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;


-- Dumping structure for table yii2basic.city
CREATE TABLE IF NOT EXISTS `city` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) DEFAULT NULL,
  `province_id` int(10) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.city: ~6 rows (approximately)
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
INSERT INTO `city` (`id`, `country_id`, `province_id`, `city`) VALUES
	(1, 1, 1, 'Pantai Kuta'),
	(2, 1, 1, 'Beratan Bedugul'),
	(3, 1, 2, 'Kemang'),
	(4, 1, 2, 'Kebun Sirih'),
	(5, 2, 3, 'Mae Tham'),
	(6, 2, 3, 'Wiang'),
	(7, 2, 4, 'Chang Klan');
/*!40000 ALTER TABLE `city` ENABLE KEYS */;


-- Dumping structure for table yii2basic.country
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.country: ~2 rows (approximately)
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`id`, `country`) VALUES
	(1, 'Indonesia'),
	(2, 'Thailand');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;


-- Dumping structure for table yii2basic.food
CREATE TABLE IF NOT EXISTS `food` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) DEFAULT NULL,
  `province_id` int(10) DEFAULT NULL,
  `city_id` int(10) DEFAULT NULL,
  `food_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.food: ~0 rows (approximately)
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
/*!40000 ALTER TABLE `food` ENABLE KEYS */;


-- Dumping structure for table yii2basic.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.migration: ~2 rows (approximately)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1444238243),
	('m151007_172055_create_news_table', 1444239017),
	('m151010_070230_create_user_tbl', 1444460642);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;


-- Dumping structure for table yii2basic.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.news: ~4 rows (approximately)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` (`id`, `title`, `content`) VALUES
	(3, 'ทดสอบครั้งที่ 3', 'ทดสอบการเพิ่มข้อมูลครั้งที่ 3'),
	(4, 'ทดสอบการเพิ่มข้อมูลครั้งที่ 4', 'ทดสอบการเพิ่มข้อมูลครั้งที่ 4'),
	(5, 'ทดสอบ Role', 'ทดสอบ ทดสอบ ทดสอบ');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;


-- Dumping structure for table yii2basic.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า',
  `name` varchar(45) DEFAULT NULL COMMENT 'ชื่อสินค้า',
  `detail` text COMMENT 'รายละเอียด',
  `photo` varchar(50) DEFAULT NULL COMMENT 'รูปสินค้า',
  `types_id` int(11) NOT NULL COMMENT 'ประเภทสินค้า',
  PRIMARY KEY (`id`,`types_id`),
  KEY `fk_products_types_idx` (`types_id`),
  CONSTRAINT `fk_products_types` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.products: ~2 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `detail`, `photo`, `types_id`) VALUES
	(1, 'aaaa', 'aaaaa', NULL, 1),
	(2, 'aaaa', 'aaaaa', NULL, 2),
	(3, 'bbbbb', 'bbbbb', 'uploads/products/eee_6.jpg', 2);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- Dumping structure for table yii2basic.province
CREATE TABLE IF NOT EXISTS `province` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.province: ~5 rows (approximately)
/*!40000 ALTER TABLE `province` DISABLE KEYS */;
INSERT INTO `province` (`id`, `country_id`, `province`) VALUES
	(1, 1, 'Bali'),
	(2, 1, 'Jakarta'),
	(3, 1, 'Yoyyakarta'),
	(4, 2, 'Phayao'),
	(5, 2, 'Chiang Mai');
/*!40000 ALTER TABLE `province` ENABLE KEYS */;


-- Dumping structure for table yii2basic.types
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส',
  `name` varchar(45) DEFAULT NULL COMMENT 'ประเภท',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.types: ~2 rows (approximately)
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` (`id`, `name`) VALUES
	(1, 'Computer'),
	(2, 'Mobile');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;


-- Dumping structure for table yii2basic.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `roles` int(10) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table yii2basic.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `fname`, `lname`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `roles`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'chittipong', 'mongpranit', 'zaED_Yu5iXIT2EssXFDjHWytobDMBg7T', '$2y$13$6n6Oajm7pvQPX6UKFBE2KOkjSrnMqguQolbUxAnSAC88k0cewa63y', NULL, 'admin@hotmail.com', 10, 10, 1444461071, 1445670305),
	(4, 'zodiac', 'tong', 'mong', 'IGsDq5JMCsEgK8hCg-qvY1woexc-k53r', '$2y$13$JVUEkb56WNrimgohqF/e1OJF32/5VegxVccyRgjypF0oHFRnGx.3y', NULL, 'jittipong_m@hotmail.com', 10, 10, 1445669811, 1445669811),
	(17, 'aaaaa', 'aaaaaa', 'aaaaaa', '3u8UMeLg6DXbLkp8r7JKTFDIsSHEOPSA', '$2y$13$QqLRx90Y.1d3oDIxtM9jLuAflRy53Mxt9O7SbWz27z103I7FUQvJ.', NULL, 'aaaa@hotmail.com', 10, 10, 1448678172, 1448678172);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Dumping structure for table yii2basic.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `module` varchar(50) NOT NULL DEFAULT '',
  `user_id` int(10) NOT NULL,
  `view` varchar(1) DEFAULT NULL,
  `insert` varchar(1) DEFAULT NULL,
  `update` varchar(1) DEFAULT NULL,
  `delete` varchar(1) DEFAULT NULL,
  `remark` text,
  PRIMARY KEY (`module`),
  UNIQUE KEY `module` (`module`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_user_role_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table yii2basic.user_role: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
INSERT INTO `user_role` (`module`, `user_id`, `view`, `insert`, `update`, `delete`, `remark`) VALUES
	('news', 4, 'Y', 'Y', 'N', 'Y', NULL);
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
