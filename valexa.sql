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

-- Dumping structure for table valexa.affiliate_earnings
CREATE TABLE IF NOT EXISTS `affiliate_earnings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `referrer_id` bigint(20) NOT NULL,
  `referee_id` bigint(20) NOT NULL,
  `transaction_id` bigint(20) NOT NULL,
  `commission_percent` bigint(20) NOT NULL,
  `commission_value` bigint(20) NOT NULL DEFAULT '0',
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `referrer_id` (`referrer_id`),
  KEY `referee_id` (`referee_id`),
  KEY `transaction_id` (`transaction_id`),
  KEY `paid` (`paid`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.affiliate_earnings: ~0 rows (approximately)
/*!40000 ALTER TABLE `affiliate_earnings` DISABLE KEYS */;
/*!40000 ALTER TABLE `affiliate_earnings` ENABLE KEYS */;

-- Dumping structure for table valexa.cashouts
CREATE TABLE IF NOT EXISTS `cashouts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `earning_ids` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payout_batch_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.cashouts: ~0 rows (approximately)
/*!40000 ALTER TABLE `cashouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `cashouts` ENABLE KEYS */;

-- Dumping structure for table valexa.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `parent` int(11) DEFAULT NULL,
  `range` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `for` tinyint(1) DEFAULT '1' COMMENT '0 for posts / 1 for products',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`parent`,`slug`,`for`),
  KEY `range` (`range`),
  KEY `for` (`for`),
  KEY `parent` (`parent`),
  KEY `slug` (`slug`),
  FULLTEXT KEY `description` (`description`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table valexa.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `read_by_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `updated_at` (`updated_at`),
  KEY `product_id` (`product_id`),
  KEY `approved` (`approved`),
  KEY `parent` (`parent`),
  KEY `read_by_admin` (`read_by_admin`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.comments: ~0 rows (approximately)
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;

-- Dumping structure for table valexa.coupons
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` float NOT NULL,
  `is_percentage` tinyint(1) DEFAULT '0',
  `users_ids` text COLLATE utf8_unicode_ci,
  `starts_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expires_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `used_by` text COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `products_ids` text COLLATE utf8_unicode_ci,
  `subscriptions_ids` mediumtext COLLATE utf8_unicode_ci,
  `once` tinyint(1) DEFAULT '0',
  `for` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'products',
  `regular_license_only` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `value` (`value`),
  KEY `starts_at` (`starts_at`),
  KEY `expires_at` (`expires_at`),
  KEY `updated_at` (`updated_at`),
  KEY `deleted_at` (`deleted_at`),
  KEY `once` (`once`) USING BTREE,
  KEY `for` (`for`) USING BTREE,
  KEY `regular_license_only` (`regular_license_only`) USING BTREE,
  FULLTEXT KEY `users_ids` (`users_ids`),
  FULLTEXT KEY `used_by` (`used_by`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.coupons: ~0 rows (approximately)
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;

-- Dumping structure for table valexa.faqs
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `answer` longtext COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `updated_at` (`updated_at`),
  KEY `active` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.faqs: ~0 rows (approximately)
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;

-- Dumping structure for table valexa.key_s
CREATE TABLE IF NOT EXISTS `key_s` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` mediumtext COLLATE utf8_unicode_ci,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `purchased_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `created_at` (`created_at`) USING BTREE,
  KEY `updated_at` (`updated_at`) USING BTREE,
  KEY `purchased_at` (`purchased_at`) USING BTREE,
  KEY `product_id` (`product_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.key_s: ~0 rows (approximately)
/*!40000 ALTER TABLE `key_s` DISABLE KEYS */;
/*!40000 ALTER TABLE `key_s` ENABLE KEYS */;

-- Dumping structure for table valexa.licenses
CREATE TABLE IF NOT EXISTS `licenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regular` int(11) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name_item_type` (`name`,`item_type`) USING BTREE,
  KEY `created_at` (`created_at`) USING BTREE,
  KEY `updated_at` (`updated_at`) USING BTREE,
  KEY `deleted_at` (`deleted_at`) USING BTREE,
  KEY `regular` (`regular`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.licenses: ~0 rows (approximately)
/*!40000 ALTER TABLE `licenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `licenses` ENABLE KEYS */;

-- Dumping structure for table valexa.newsletter_subscribers
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deletet_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.newsletter_subscribers: ~0 rows (approximately)
/*!40000 ALTER TABLE `newsletter_subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter_subscribers` ENABLE KEYS */;

-- Dumping structure for table valexa.notifications
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `users_ids` longtext COLLATE utf8_unicode_ci NOT NULL,
  `for` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `deleted_at` (`deleted_at`),
  KEY `product_id` (`product_id`),
  KEY `for` (`for`),
  FULLTEXT KEY `users_ids` (`users_ids`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.notifications: ~0 rows (approximately)
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;

-- Dumping structure for table valexa.pages
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `views` int(11) DEFAULT '0',
  `deletable` tinyint(1) DEFAULT '1',
  `active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`),
  KEY `updated_at` (`updated_at`),
  KEY `active` (`active`),
  KEY `views` (`views`),
  KEY `deletable` (`deletable`),
  FULLTEXT KEY `description` (`name`,`slug`,`short_description`,`content`,`tags`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.pages: ~0 rows (approximately)
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;

-- Dumping structure for table valexa.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table valexa.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table valexa.payment_links
CREATE TABLE IF NOT EXISTS `payment_links` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `processor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `token` text COLLATE utf8_unicode_ci NOT NULL,
  `short_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `amount` float DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `short_link` (`short_link`) USING BTREE,
  KEY `name` (`name`) USING BTREE,
  KEY `created_at` (`created_at`) USING BTREE,
  KEY `updated_at` (`updated_at`) USING BTREE,
  KEY `deleted_at` (`deleted_at`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `processor` (`processor`) USING BTREE,
  KEY `reference` (`reference`) USING BTREE,
  KEY `amount` (`amount`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.payment_links: ~0 rows (approximately)
/*!40000 ALTER TABLE `payment_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_links` ENABLE KEYS */;

-- Dumping structure for table valexa.posts
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) DEFAULT '1',
  `views` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`id`,`name`,`slug`),
  KEY `updated_at` (`updated_at`),
  KEY `active` (`active`),
  KEY `views` (`views`),
  KEY `slug` (`slug`),
  KEY `category` (`category`),
  FULLTEXT KEY `search` (`name`,`short_description`,`content`,`tags`),
  FULLTEXT KEY `tags` (`tags`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.posts: ~0 rows (approximately)
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;

-- Dumping structure for table valexa.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8_unicode_ci,
  `overview` longtext COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `active` tinyint(1) DEFAULT '1',
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subcategories` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `screenshots` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `last_update` date DEFAULT NULL,
  `included_files` text COLLATE utf8_unicode_ci,
  `tags` text COLLATE utf8_unicode_ci,
  `preview` text COLLATE utf8_unicode_ci,
  `software` text COLLATE utf8_unicode_ci,
  `db` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compatible_browsers` text COLLATE utf8_unicode_ci,
  `compatible_os` text COLLATE utf8_unicode_ci,
  `high_resolution` tinyint(1) DEFAULT '0',
  `documentation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_host` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'local',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `free` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured` tinyint(1) DEFAULT '0',
  `trending` tinyint(1) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `faq` text COLLATE utf8_unicode_ci,
  `is_dir` tinyint(1) DEFAULT '0',
  `promotional_price_time` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `hidden_content` longtext COLLATE utf8_unicode_ci,
  `enable_license` tinyint(4) DEFAULT NULL,
  `preview_url` text COLLATE utf8_unicode_ci,
  `direct_download_link` text COLLATE utf8_unicode_ci,
  `newest` tinyint(1) DEFAULT '0',
  `for_subscriptions` tinyint(1) DEFAULT '0',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bpm` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bit_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_of_contents` longtext COLLATE utf8_unicode_ci,
  `pages` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `words` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `formats` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authors` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `additional_fields` longtext COLLATE utf8_unicode_ci,
  `country_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preview_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `minimum_price` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `name` (`name`),
  KEY `category` (`category`),
  KEY `subcategories` (`subcategories`),
  KEY `documentation` (`documentation`),
  KEY `release_date` (`release_date`),
  KEY `created_at` (`created_at`),
  KEY `deleted_at` (`deleted_at`),
  KEY `updated_at` (`updated_at`),
  KEY `active` (`active`),
  KEY `file_name` (`file_name`),
  KEY `file_host` (`file_host`),
  KEY `featured` (`featured`),
  KEY `trending` (`trending`),
  KEY `free` (`free`),
  KEY `is_dir` (`is_dir`),
  KEY `promotional_price_time` (`promotional_price_time`) USING BTREE,
  KEY `stock` (`stock`) USING BTREE,
  KEY `enable_license` (`enable_license`) USING BTREE,
  KEY `views` (`views`) USING BTREE,
  KEY `for_subscriptions` (`for_subscriptions`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `pages` (`pages`) USING BTREE,
  KEY `words` (`words`) USING BTREE,
  KEY `language` (`language`) USING BTREE,
  KEY `formats` (`formats`) USING BTREE,
  KEY `authors` (`authors`) USING BTREE,
  KEY `bpm` (`bpm`) USING BTREE,
  KEY `bit_rate` (`bit_rate`) USING BTREE,
  KEY `country_city` (`country_city`) USING BTREE,
  KEY `newest` (`newest`) USING BTREE,
  KEY `minimum_price` (`minimum_price`) USING BTREE,
  FULLTEXT KEY `description` (`overview`,`tags`,`short_description`,`name`,`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.products: ~0 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table valexa.product_price
CREATE TABLE IF NOT EXISTS `product_price` (
  `product_id` int(11) NOT NULL,
  `license_id` int(11) NOT NULL,
  `price` float DEFAULT '0',
  `promo_price` float DEFAULT '0',
  UNIQUE KEY `product_id_license_id` (`product_id`,`license_id`) USING BTREE,
  KEY `price` (`price`) USING BTREE,
  KEY `promo_price` (`promo_price`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.product_price: ~0 rows (approximately)
/*!40000 ALTER TABLE `product_price` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_price` ENABLE KEYS */;

-- Dumping structure for table valexa.reactions
CREATE TABLE IF NOT EXISTS `reactions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `item_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'comment',
  `item_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `item_type_item_id_user_id` (`item_type`,`item_id`,`user_id`) USING BTREE,
  KEY `type` (`item_type`) USING BTREE,
  KEY `created_at` (`created_at`) USING BTREE,
  KEY `deleted_at` (`deleted_at`) USING BTREE,
  KEY `updated_at` (`updated_at`) USING BTREE,
  KEY `product_id` (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.reactions: ~0 rows (approximately)
/*!40000 ALTER TABLE `reactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `reactions` ENABLE KEYS */;

-- Dumping structure for table valexa.reviews
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` float DEFAULT '0',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `approved` tinyint(1) DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `read_by_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_product` (`user_id`,`product_id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `deleted_at` (`deleted_at`),
  KEY `product_id` (`product_id`),
  KEY `approved` (`approved`),
  KEY `read_by_admin` (`read_by_admin`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.reviews: ~0 rows (approximately)
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;

-- Dumping structure for table valexa.searches
CREATE TABLE IF NOT EXISTS `searches` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `created_at` (`created_at`) USING BTREE,
  KEY `updated_at` (`updated_at`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `keywords` (`keywords`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=430 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.searches: ~0 rows (approximately)
/*!40000 ALTER TABLE `searches` DISABLE KEYS */;
/*!40000 ALTER TABLE `searches` ENABLE KEYS */;

-- Dumping structure for table valexa.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `general` longtext COLLATE utf8_unicode_ci,
  `mailer` longtext COLLATE utf8_unicode_ci,
  `payments` longtext COLLATE utf8_unicode_ci,
  `search_engines` longtext COLLATE utf8_unicode_ci,
  `adverts` longtext COLLATE utf8_unicode_ci,
  `files_host` longtext COLLATE utf8_unicode_ci,
  `social_login` longtext COLLATE utf8_unicode_ci,
  `chat` longtext COLLATE utf8_unicode_ci,
  `captcha` longtext COLLATE utf8_unicode_ci,
  `database` text COLLATE utf8_unicode_ci,
  `affiliate` mediumtext COLLATE utf8_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `general`, `mailer`, `payments`, `search_engines`, `adverts`, `files_host`, `social_login`, `chat`, `captcha`, `database`, `affiliate`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, '{"name":"Arabcode","title":"buy codes & plugins","description":"Thousands of code, scripts & plugins for every website build\\r\\nChoose from ecommerce plugins, mobile app templates, PHP, Bootstrap & more for any budget, built by the world\\u2019s best developers.","email":"arab6ode@gmail.com","keywords":"digital downloads php script, shopping cart php script, ecommerce php script, paypal php script, stripe php script, digital store php script, gpl store php script, gpl licence php script, paypal digital download","items_per_page":"10","favicon":"favicon.png","logo":"tendra_logo.png","search_cover":"search_cover.png","env":"production","debug":"1","timezone":"Asia\\/Riyadh","facebook":"#","twitter":"#","pinterest":"#","youtube":"#","tumblr":"#","search_header":"Templates, PHP Scripts, Graphics and Codes starting from $2","search_subheader":null,"cover":"cover.png","blog":{"enabled":"1","title":"ArabCode - PHP Script For Selling Digital Products","description":"Choose from ecommerce plugins, mobile app templates, PHP, Bootstrap & more for any budget, built by the world\\u2019s best developers."},"blog_cover":"blog_cover.png","fb_app_id":null,"langs":"en","template":"tendra","fonts":{"ltr":"@font-face {\\r\\n  font-family: \'Spartan\';\\r\\n  src: url(\'\\/assets\\/fonts\\/Spartan\\/Spartan-Regular.ttf\');\\r\\n  font-weight: 400;\\r\\n  font-style: normal;\\r\\n}\\r\\n\\r\\n@font-face {\\r\\n  font-family: \'Spartan\';\\r\\n  src: url(\'\\/assets\\/fonts\\/Spartan\\/Spartan-Medium.ttf\');\\r\\n  font-weight: 500;\\r\\n  font-style: normal;\\r\\n}\\r\\n\\r\\n@font-face {\\r\\n  font-family: \'Spartan\';\\r\\n  src: url(\'\\/assets\\/fonts\\/Spartan\\/Spartan-SemiBold.ttf\');\\r\\n  font-weight: 600;\\r\\n  font-style: normal;\\r\\n}\\r\\n\\r\\n@font-face {\\r\\n  font-family: \'Spartan\';\\r\\n  src: url(\'\\/assets\\/fonts\\/Spartan\\/Spartan-Bold.ttf\');\\r\\n  font-weight: 700;\\r\\n  font-style: normal;\\r\\n}\\r\\n\\r\\n@font-face {\\r\\n  font-family: \'Spartan\';\\r\\n  src: url(\'\\/assets\\/fonts\\/Spartan\\/Spartan-ExtraBold.ttf\');\\r\\n  font-weight: 800;\\r\\n  font-style: normal;\\r\\n}\\r\\n\\r\\n@font-face {\\r\\n  font-family: \'Spartan\';\\r\\n  src: url(\'\\/assets\\/fonts\\/Spartan\\/Spartan-Black.ttf\');\\r\\n  font-weight: 900;\\r\\n  font-style: normal;\\r\\n}","rtl":"https:\\/\\/fonts.googleapis.com\\/css2?family=Almarai:wght@400;700&display=swap"},"subscriptions":"{\\"enabled\\":\\"1\\",\\"accumulative\\":\\"1\\"}","watermark":"watermark.png","users_notif":"New notification.","valexa_top_cover":null,"tendra_top_cover":null,"purchase_code":"66788777777777","tendra_top_cover_mask":null,"maintenance_mode":"1","maintenance_time":"2021-01-20 12:00:00","maintenance":"{\\"enabled\\":\\"0\\",\\"expires_at\\":\\"2021-03-25 15:30:00\\",\\"auto_disable\\":\\"1\\",\\"title\\":\\"Under maintenance\\",\\"header\\":\\"Our website is under maintenance\\",\\"subheader\\":\\"We are adding more features, stay tuned\\",\\"text\\":\\"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\\",\\"bg_color\\":\\"#042f86\\"}","email_verification":"1","auto_approve":"{\\"support\\":\\"1\\",\\"reviews\\":\\"1\\"}","admin_notifications":"{\\"comments\\":\\"1\\",\\"reviews\\":\\"1\\",\\"sales\\":\\"1\\"}","default_product_type":"external_membership","default_top_cover":"default_top_cover.svg","homepage_items":"{\\"default\\":{\\"featured\\":{\\"limit\\":\\"8\\",\\"items_per_line\\":\\"4\\"},\\"trending\\":{\\"limit\\":\\"4\\",\\"items_per_line\\":\\"4\\"},\\"newest\\":{\\"limit\\":\\"8\\",\\"items_per_line\\":\\"4\\"},\\"free\\":{\\"limit\\":\\"4\\",\\"items_per_line\\":\\"4\\"},\\"posts\\":{\\"limit\\":\\"4\\",\\"items_per_line\\":\\"5\\"}},\\"valexa\\":{\\"featured\\":{\\"limit\\":\\"8\\",\\"items_per_line\\":\\"4\\"},\\"trending\\":{\\"limit\\":\\"4\\",\\"items_per_line\\":\\"4\\"},\\"newest\\":{\\"limit\\":\\"20\\",\\"items_per_line\\":\\"10\\"},\\"free\\":{\\"limit\\":\\"4\\",\\"items_per_line\\":\\"4\\"},\\"posts\\":{\\"limit\\":\\"4\\",\\"items_per_line\\":\\"4\\"}},\\"tendra\\":{\\"featured\\":{\\"limit\\":\\"6\\",\\"items_per_line\\":\\"3\\"},\\"newest\\":{\\"limit\\":\\"10\\",\\"items_per_line\\":\\"6\\"},\\"free\\":{\\"limit\\":\\"10\\",\\"items_per_line\\":\\"6\\"},\\"posts\\":{\\"limit\\":\\"3\\",\\"items_per_line\\":\\"3\\"},\\"pricing_plans\\":{\\"limit\\":\\"5\\",\\"items_per_line\\":\\"3\\"}}}","products_by_country_city":"0","recently_viewed_items":"1","cookie_text":"<p>We use cookies to understand how you use our website and to improve your experience. This includes personalizing content and advertising. To learn more, please click <a href=\\"https:\\/\\/tendra.codemayer.tech\\/page\\/privacy-policy\\" target=\\"_blank\\"><b style=\\"color: rgb(49, 24, 115);\\">Here<\\/b><\\/a>. By continuing to use our website, you accept our use of cookies, Privacy policy and terms &amp; conditions.<br><\\/p>","cookie":"{\\"text\\":\\"<p>We use cookies to understand how you use our website and to improve your experience. This includes personalizing content and advertising. To learn more, please click Here. By continuing to use our website, you accept our use of cookies, Privacy policy and terms &amp; conditions.<br><\\\\\\/p>\\",\\"background\\":\\"linear-gradient(45deg, #ce2929, #ce2929, #ffc65d)\\",\\"color\\":\\"#fff\\",\\"button_bg\\":\\"#e97f46\\"}","masonry_layout":"1","randomize_homepage_items":"0","direct_download_links":{"enabled":"0","by_ip":"0","authenticated":"1","expire_in":"12"},"affiliate":"null"}', '{"mail":{"username":"test@gmail.net","password":"123456789","host":"test.com","port":"26","encryption":"tls","reply_to":null,"forward_to":"","use_queue":"0","from":{"name":"Valexa","address":"test@gmail.net"}}}', '{"paypal":{"name":"paypal","enabled":"on","mode":"sandbox","client_id":"AcNJxK8uTNW0LydCVAQ1iex_pffZSWQiv1z2skmP9Bv5p_xSd2LK1wr7hSCQ_HjreReDvjvOOD8_-CmJ","secret_id":"EM7Alo8vtWMTGajDLgAMwBzzkRFCGcUUHVHkDUtCUDDz90wtKibKyNso5YX1P-AwTWapCsIuSHhFf1z7","fee":"2.5","minimum":null,"auto_exchange_to":"USD"},"stripe":{"name":"stripe","mode":"sandbox","client_id":"pk_test_AXJnsLZeYQLe5L2qzA8FI94o00HCMh14t5","secret_id":"sk_test_WlDtXCea4H8cKRFk7bgzW3xq00hcfmF73r","fee":"1.5","method_types":"ideal,card","minimum":null,"auto_exchange_to":null},"skrill":{"name":"skrill","merchant_account":"demoqco@sun-fish.com","mqiapi_secret_word":"skrill","mqiapi_password":"skrill123","methods":"WLT,NTL,PSC,PCH,VSE,MAE,MSC","fee":"1.5","minimum":"3","auto_exchange_to":null},"razorpay":{"name":"razorpay","client_id":"rzp_test_DUPTzXW3UC4iBC","secret_id":"EUbzW2yEuosyZEivq9koTKnr","webhook_secret":"test_webhook_secret","fee":"1.8","minimum":null,"auto_exchange_to":null},"iyzico":{"name":"iyzico","mode":"sandbox","client_id":"sandbox-qsBMvOz8ZsOo9uQ9hRG69CBr0AlzgWk0","secret_id":"sandbox-waidUfSino5HsMHHWlWB13pMjR9foMFc","fee":"2","minimum":null,"auto_exchange_to":null},"coingate":{"name":"coingate","mode":"sandbox","auth_token":"299kVnCm91kxQ2AJw377FxLG2LpRR_qmszQvLFhC","receive_currency":"USD","fee":"2","minimum":null,"auto_exchange_to":null},"midtrans":{"name":"midtrans","mode":"sandbox","client_key":"SB-Mid-client-4K9js0-HxqpTkTwV","server_key":"SB-Mid-server-yU5tGqHCO-5MnICkueT5jUr4","merchant_id":"G444766542","fee":"1.5","methods":"credit_card,danamon_online,cimb_clicks,bca_klikbca,echannel,bri_epay,mandiri_ecash,mandiri_clickpay,other_va,indomaret,bni_va,alfamart,bca_va,akulaku,permata_va,bca_klikpay","minimum":null,"auto_exchange_to":null},"paystack":{"name":"paystack","public_key":"pk_test_762f08f728fbd0191221a7b1a06ac10b6017be24","secret_key":"sk_test_f525daf950659e2c2cac6dfec9b3bf1fdc4b76b9","fee":"2.5","channels":"bank,ussd,card,qr,mobile_money,bank_transfer","minimum":"10","auto_exchange_to":null},"adyen":{"name":"adyen","mode":"sandbox","api_key":"AQEkhmfuXNWTK0Qc+iSTnWA9quWCTZmTqRsPhOnbmZQuCODAeEcZEMFdWw2+5HzctViMSCJMYAc=-nwWICtS3xogSvY7E4NSGv\\/dRcXCcdcIxPb9xSQEiDxo=-.a~#6nYJY*kjQR@8","client_key":"test_WKEK5UUKF5DQVP5WCKTBOBZSCAPKZEFZ","merchant_account":"CodemayerECOM","hmac_key":"B6F776AEC9B11A2B0FD0CCD5FA74D32F7418101C4F06857BA0D09EE84FF929B0","fee":"1.5","minimum":"5","auto_exchange_to":"EUR"},"instamojo":{"name":"instamojo","mode":"sandbox","private_api_key":"test_7b1fe0042114fc5c5bf2853a41d","private_auth_token":"test_ea154b5381c63d13473dc6dc5a9","private_salt":"193f1541346e4221ac9c0e997f41e78b","fee":"1.3","minimum":null,"auto_exchange_to":null},"offline":{"name":"offline","instructions":"<p><span style=\\"font-size: 1em;\\">Bank code: 654987<\\/span><br><\\/p><p>Account Number: 7654852321<\\/p><p>IBAN: 97752784819916461767I4<\\/p><p><br><\\/p><p>Please add your order number to your payment description.<\\/p>","fee":null,"minimum":null},"payhere":{"name":"payhere","mode":"sandbox","merchant_secret":"4PbGDIJhC1S8hdoYb2TUq94UtjpU5RFOi4JAgPiEKrpp","merchant_id":"1216755","fee":"5","minimum":"5","auto_exchange_to":null},"coinpayments":null,"spankpay":{"name":"spankpay","public_key":"test_pk_deep_back_NJuaXwSL3UXeIjwM65GhXdkXCxNk6U9XPrQsqFoQ8U","secret_key":"test_sk_deep_back_dVxv0wFhzPrK2SjWToYDHenfukZcecJLBC6x7Fe5bZ","fee":"5","minimum":"10","auto_exchange_to":null},"omise":{"name":"omise","public_key":"pkey_test_5n6fd57pzmgsd1v5u9u","secret_key":"skey_test_5n6fd57q9gigfqru6l6","fee":"5","minimum":"5","auto_exchange_to":null},"paymentwall":{"name":"paymentwall","mode":"sandbox","project_key":"a520d362315eb9e3bd7c4644e7c82378","secret_key":"ec416fb93e36c071017f89e6316730cc","fee":"3","minimum":"5","auto_exchange_to":null},"authorize_net":{"name":"authorize_net","mode":"sandbox","api_login_id":"5q3U7e7vUyt","client_key":"28YLHrjBw4g3A4eWtdnh8a5Uq7gnKZVbfzNm3e3tUTpZ7858762BayAb5Jagv46P","transaction_key":"4ad3Tu5JQZ4G536g","signature_key":"7FB3256E565E21ECC31138FFF71BDCA21859C457F4B75A0E79BBDBD08950394EAF885532EF2055BF278B7EA4512268C95EAC9D3040FFA9FBE26CC7A0FBF74343","fee":"5","minimum":"10"},"sslcommerz":{"name":"sslcommerz","mode":"sandbox","store_id":"codem613bb607ea725","store_passwd":"codem613bb607ea725@ssl","use_ipn":"0","fee":null,"methods":"brac_visa,dbbl_visa,city_visa,ebl_visa,sbl_visa,ebl_master,sbl_master,city_amex,qcash,city_master,dbbl_nexus,dbbl_master,brac_master,bankasia,abbank,bkash,dbblmobilebanking,mtbl,tapnpay,upay,city,ibbl","minimum":"424.70","auto_exchange_to":"BDT"},"flutterwave":{"name":"flutterwave","mode":"sandbox","public_key":"FLWPUBK_TEST-14823d361577953a0623e9a9087cf11f-X","secret_key":"FLWSECK_TEST-fc0da3b6f557ccbcc5c6b7aa9aa5f893-X","methods":"account,card,banktransfer,qr,mobilemoneyuganda,mobilemoneyzambia,mobilemoneyrwanda,mpesa,ussd,credit,mobilemoneyfranco,paga,payattitude,1voucher,mobilemoneytanzania,barter,mobilemoneyghana","verif_hash":"6$DL-X2]yB;GQ23Us~W,[Mhd]Qt+Cf$z","fee":null,"minimum":null,"auto_exchange_to":null},"vat":"20","currency_code":"USD","currency_symbol":"$","currency_position":"left","exchange_rate":1,"currencies":"eur,usd,inr,idr,gbp,btc,ltc,USD","allow_foreign_currencies":"1","currency_exchange_api":"api.coingate.com","currencyscoop_api_key":null,"exchangeratesapi_io_key":null,"guest_checkout":"1","pay_what_you_want":"{\\"enabled\\":\\"1\\",\\"for\\":\\"products\\"}","currency_by_country":"0"}', '{"google":null,"bing":null,"yandex":null,"google_analytics":null,"robots":"follow, index","main_locale":"en"}', '{"responsive_ad":"","auto_ad":"","ad_728x90":"","ad_468x60":"","ad_300x250":"","ad_320x100":"","popup_ad":""}', '{"google_drive":{"folder_id":null,"api_key":null,"client_id":null,"secret_id":null,"chunk_size":"1","refresh_token":null,"connected_email":null,"id_token":null},"dropbox":{"folder_path":null,"app_key":null,"app_secret":null,"access_token":null,"current_account":null},"yandex":{"folder_path":null,"client_id":null,"secret_id":null,"refresh_token":null},"amazon_s3":{"access_key_id":null,"secret_key":null,"bucket":null,"region":"us-west-2","version":"latest"},"wasabi":{"access_key":null,"secret_key":null,"bucket":"codemayer","region":"us-west-1","version":"latest"},"working_with":"files"}', '{"google":{"client_id":null,"secret_id":null,"redirect":"https:\\/\\/valexa.codemayer.net\\/login\\/google\\/callback"},"github":{"client_id":null,"secret_id":null,"redirect":"https:\\/\\/valexa.codemayer.net\\/login\\/github\\/callback"},"linkedin":{"client_id":null,"secret_id":null,"redirect":"https:\\/\\/valexa.codemayer.net\\/login\\/linkedin\\/callback"},"facebook":{"client_id":null,"secret_id":null,"redirect":"https:\\/\\/valexa.codemayer.net\\/login\\/facebook\\/callback"},"vkontakte":{"client_id":null,"secret_id":null,"redirect":"https:\\/\\/valexa.codemayer.net\\/login\\/vkontakte\\/callback"},"twitter":{"client_id":null,"secret_id":null,"redirect":"https:\\/\\/valexa.codemayer.net\\/login\\/twitter\\/callback"}}', '{"twak":{"name":"twak","property_id":null},"gist":{"name":"gist","workspace_id":null},"other":{"name":"other","code":null}}', '{"enable_on":"register,contact,login","google":{"secret":null,"sitekey":null,"attributes":{"data-theme":"light","data-size":"normal"},"options":{"timeout":"30"}},"mewebstudio":{"length":"4","math":false,"width":"150","height":"40","quality":"90"}}', '{"host":"127.0.0.1","database":"","username":"","password":"","charset":"utf8","collation":"utf8_unicode_ci","port":"3306","sort_buffer_size":"2","sql_mode":"STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION","timezone":"+00:00"}', '{"enabled":"1","commission":"10","expire":"30","cashout_methods":"paypal_account","minimum_cashout":{"paypal":"5","bank_transfer":null},"cashout_description":"<p>All earnings will be transferred to your account based on the selected method, whether via PayPal or Bank transfer.<\\/p><ul><li>The minimum amount to&nbsp;<span style=\\"font-size: 1.14286rem;\\">cash out via<\\/span><span style=\\"font-size: 1.14286rem;\\">&nbsp;PayPal&nbsp; : USD 50.00<\\/span><\\/li><li>The minimum amount to&nbsp;<span style=\\"font-size: 1.14286rem;\\">cash out via<\\/span><span style=\\"font-size: 1.14286rem;\\">&nbsp;bank transfer : USD 240.00<\\/span><\\/li><\\/ul><p><span style=\\"font-size: 1.14286rem;\\">Earnings are paid automatically be the end of each month, as long as, your balance has the minimum amount.<\\/span><\\/p><p><span style=\\"font-size: 1.14286rem;\\">Your earnings, in case of an&nbsp;<\\/span><span style=\\"font-size: 16px;\\">insufficiency, will be reported to the next month.<\\/span><\\/p>"}', '2020-01-17 16:06:00', '2022-03-27 22:32:36', NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

-- Dumping structure for table valexa.subscriptions
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `days` int(11) DEFAULT '0',
  `limit_downloads` int(11) DEFAULT '0',
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `limit_downloads_per_day` int(11) DEFAULT '0',
  `products` longtext COLLATE utf8_unicode_ci,
  `position` int(11) DEFAULT '0',
  `limit_downloads_same_item` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `slug` (`slug`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `limit_downloads_per_day` (`limit_downloads_per_day`) USING BTREE,
  KEY `limit_downloads` (`limit_downloads`) USING BTREE,
  KEY `price` (`price`) USING BTREE,
  KEY `days` (`days`) USING BTREE,
  KEY `position` (`position`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.subscriptions: ~0 rows (approximately)
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;

-- Dumping structure for table valexa.subscription_same_item_downloads
CREATE TABLE IF NOT EXISTS `subscription_same_item_downloads` (
  `subscription_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  UNIQUE KEY `sub_unique` (`subscription_id`,`product_id`) USING BTREE,
  KEY `subscription_id` (`subscription_id`) USING BTREE,
  KEY `product_id` (`product_id`) USING BTREE,
  KEY `downloads` (`downloads`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=FIXED;

-- Dumping data for table valexa.subscription_same_item_downloads: 0 rows
/*!40000 ALTER TABLE `subscription_same_item_downloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscription_same_item_downloads` ENABLE KEYS */;

-- Dumping structure for table valexa.support
CREATE TABLE IF NOT EXISTS `support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` int(11) NOT NULL,
  `subject` text COLLATE utf8_unicode_ci,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `read` tinyint(1) DEFAULT '0',
  `parent` tinyint(4) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `read_by_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `email_id` (`email_id`),
  KEY `updated_at` (`updated_at`),
  KEY `read` (`read`),
  KEY `parent` (`parent`),
  KEY `read_by_admin` (`read_by_admin`) USING BTREE,
  FULLTEXT KEY `search` (`subject`,`message`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.support: ~0 rows (approximately)
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
/*!40000 ALTER TABLE `support` ENABLE KEYS */;

-- Dumping structure for table valexa.support_email
CREATE TABLE IF NOT EXISTS `support_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.support_email: ~0 rows (approximately)
/*!40000 ALTER TABLE `support_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_email` ENABLE KEYS */;

-- Dumping structure for table valexa.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `processor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `products_ids` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `reference_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cs_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` float NOT NULL,
  `discount` float DEFAULT NULL,
  `refunded` tinyint(1) DEFAULT '0',
  `refund` float DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `items_count` int(11) NOT NULL,
  `is_subscription` tinyint(1) DEFAULT '0',
  `guest_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'paid',
  `confirmed` tinyint(1) DEFAULT '1',
  `exchange_rate` float DEFAULT NULL,
  `details` longtext COLLATE utf8_unicode_ci,
  `licenses` longtext COLLATE utf8_unicode_ci,
  `licenses_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custom_amount` float DEFAULT NULL,
  `payment_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `read_by_admin` tinyint(1) DEFAULT '0',
  `referrer_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `processor_transaction_id` (`processor`,`transaction_id`) USING BTREE,
  KEY `products_ids` (`products_ids`),
  KEY `coupon_id` (`coupon_id`),
  KEY `refunded` (`refunded`),
  KEY `refund` (`refund`),
  KEY `processor` (`processor`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `deleted_at` (`deleted_at`),
  KEY `amount` (`amount`),
  KEY `user_id` (`user_id`),
  KEY `search` (`processor`,`order_id`,`transaction_id`,`amount`,`reference_id`),
  KEY `items_count` (`items_count`),
  KEY `is_subscription` (`is_subscription`),
  KEY `guest_token` (`guest_token`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `exchange_rate` (`exchange_rate`) USING BTREE,
  KEY `confirmed` (`confirmed`) USING BTREE,
  KEY `reference_id` (`reference_id`) USING BTREE,
  KEY `licenses_ids` (`licenses_ids`) USING BTREE,
  KEY `payment_url` (`payment_url`) USING BTREE,
  KEY `custom_amount` (`custom_amount`) USING BTREE,
  KEY `read_by_admin` (`read_by_admin`) USING BTREE,
  KEY `referrer_id` (`referrer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1591 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.transactions: ~0 rows (approximately)
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Dumping structure for table valexa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `affiliate_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` date DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked` tinyint(1) DEFAULT '0',
  `receive_notifs` tinyint(1) DEFAULT '1',
  `cashout_method` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_account` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user` (`name`,`email`),
  KEY `name` (`name`),
  KEY `updated_at` (`updated_at`),
  KEY `verified` (`email_verified_at`),
  KEY `role` (`role`),
  KEY `created_at` (`created_at`),
  KEY `blocked` (`blocked`) USING BTREE,
  KEY `receive_notifs` (`receive_notifs`) USING BTREE,
  KEY `affiliate_name` (`affiliate_name`),
  KEY `cashout_method` (`cashout_method`),
  KEY `paypal_account` (`paypal_account`)
) ENGINE=InnoDB AUTO_INCREMENT=930 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `affiliate_name`, `email`, `email_verified_at`, `firstname`, `lastname`, `password`, `avatar`, `role`, `remember_token`, `provider_id`, `provider`, `created_at`, `updated_at`, `deleted_at`, `country`, `city`, `address`, `phone`, `state`, `id_number`, `zip_code`, `blocked`, `receive_notifs`, `cashout_method`, `paypal_account`, `bank_account`) VALUES
	(929, 'arabcode', NULL, 'arab6ode@gmail.com', '2022-03-27', NULL, NULL, '$2y$10$BYvVz1uTL4e.BEYKQ1Y/a.tXTr.7IWu7Va9j3/AGEhwH.gCYBXq/2', 'default.jpg', 'admin', 'wFkXBBCpL0b4tl3w38Oe6TaMZDvDks0ALbGj21HLIBSXmriMHuQZMS1KchXy', NULL, NULL, '2022-03-27 22:24:17', '2022-03-27 22:24:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table valexa.user_subscription
CREATE TABLE IF NOT EXISTS `user_subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `starts_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `ends_at` datetime DEFAULT NULL,
  `downloads` int(11) DEFAULT '0',
  `transaction_id` bigint(20) DEFAULT '0',
  `daily_downloads` int(11) DEFAULT '0',
  `daily_downloads_date` date DEFAULT NULL,
  `same_items_downloads` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `subscription_id` (`subscription_id`),
  KEY `user_id` (`user_id`),
  KEY `starts_at` (`starts_at`),
  KEY `downloads` (`downloads`),
  KEY `transaction_id` (`transaction_id`) USING BTREE,
  KEY `daily_downloads` (`daily_downloads`) USING BTREE,
  KEY `daily_downloads_date` (`daily_downloads_date`) USING BTREE,
  KEY `ends_at` (`ends_at`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table valexa.user_subscription: ~0 rows (approximately)
/*!40000 ALTER TABLE `user_subscription` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_subscription` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
