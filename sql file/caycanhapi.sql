-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.15 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table caycanhapi.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` varchar(50) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_to_chat_with_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.chat: ~7 rows (approximately)
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` (`id`, `chat_id`, `user_id`, `user_to_chat_with_id`) VALUES
	(4, '1-2', 4, 1),
	(5, '1-2', 1, 4),
	(8, '1-7', 1, 7),
	(9, '1-7', 7, 1),
	(10, '1-1', 1, 1),
	(11, '1-4', 1, 4),
	(12, '1-4', 4, 1);
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `post_id` int(11) NOT NULL DEFAULT '0',
  `content` varchar(225) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.comment: ~0 rows (approximately)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.comment_for_user_plant
CREATE TABLE IF NOT EXISTS `comment_for_user_plant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_plant_id` int(11) NOT NULL DEFAULT '0',
  `content` varchar(225) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL DEFAULT '0',
  `image_url` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.comment_for_user_plant: ~0 rows (approximately)
/*!40000 ALTER TABLE `comment_for_user_plant` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment_for_user_plant` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.email_activate
CREATE TABLE IF NOT EXISTS `email_activate` (
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `password` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL,
  `activation_token` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.email_activate: ~2 rows (approximately)
/*!40000 ALTER TABLE `email_activate` DISABLE KEYS */;
INSERT INTO `email_activate` (`email`, `username`, `password`, `name`, `activation_token`) VALUES
	('cnviety2@gmail.com', 'asd', '$2y$10$xl1PPBFtHupqhSHsD5n2z.3fC8yYO7ObSMbloMDJtknsa/tmugWkC', 'dfft', 9343),
	('a@gmail.com', 'a', '$2y$10$sZWgUJP9N/nZ18w2tMl08uvDDTv1IikWb2rig8Qml8VsXDpXmF90K', 'a', 1944);
/*!40000 ALTER TABLE `email_activate` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caycanhapi.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.image
CREATE TABLE IF NOT EXISTS `image` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caycanhapi.image: ~0 rows (approximately)
/*!40000 ALTER TABLE `image` DISABLE KEYS */;
/*!40000 ALTER TABLE `image` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.image_for_pending_expert
CREATE TABLE IF NOT EXISTS `image_for_pending_expert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pending_expert_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `created_date` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.image_for_pending_expert: ~0 rows (approximately)
/*!40000 ALTER TABLE `image_for_pending_expert` DISABLE KEYS */;
/*!40000 ALTER TABLE `image_for_pending_expert` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.image_for_plant
CREATE TABLE IF NOT EXISTS `image_for_plant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plant_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `created_date` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.image_for_plant: ~0 rows (approximately)
/*!40000 ALTER TABLE `image_for_plant` DISABLE KEYS */;
/*!40000 ALTER TABLE `image_for_plant` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.image_for_post
CREATE TABLE IF NOT EXISTS `image_for_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(225) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.image_for_post: ~6 rows (approximately)
/*!40000 ALTER TABLE `image_for_post` DISABLE KEYS */;
INSERT INTO `image_for_post` (`id`, `post_id`, `url`, `created_date`, `is_deleted`) VALUES
	(72, 51, '/storage/image_for_post/613e64f4-1637-436b-b235-743f1d7ae5e5images (2) (1).jpeg', '0000-00-00', 0),
	(73, 51, '/storage/image_for_post/77fea405-a412-434b-a8b6-271ad23f831fcay-truong-sinh-thumb.jpg', '0000-00-00', 0),
	(74, 53, '/storage/image_for_post/3864ee67-d65f-4df8-9846-ad4a65d51334images (2) (1).jpeg', '0000-00-00', 0),
	(75, 53, '/storage/image_for_post/a8b11202-3332-4cd4-9c6f-a239b7e42930cay-truong-sinh-thumb.jpg', '0000-00-00', 0),
	(76, 53, '/storage/image_for_post/f99745e7-aaa2-4467-86fe-2bc1d61e91ee20-CÂY-XANH.jpg', '0000-00-00', 0),
	(77, 54, '/storage/image_for_post/6e0e9678-5859-404d-9aa8-513f30199d75avatarfb-161341-2.jpg', '0000-00-00', 0),
	(78, 55, '/storage/image_for_post/4964df73-41c3-4372-a4a4-b4fac2f2da3820-CÂY-XANH.jpg', '0000-00-00', 0),
	(79, 57, '/storage/image_for_post/707e706d-f2f9-4ec0-99fa-7c9029b4c4a6avatarfb-161341-2.jpg', '0000-00-00', 0);
/*!40000 ALTER TABLE `image_for_post` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.image_for_user
CREATE TABLE IF NOT EXISTS `image_for_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.image_for_user: ~2 rows (approximately)
/*!40000 ALTER TABLE `image_for_user` DISABLE KEYS */;
INSERT INTO `image_for_user` (`id`, `user_id`, `url`, `created_at`, `is_deleted`) VALUES
	(15, 4, '/storage/image_for_user/1440c998-4809-4843-8cd3-82960716c3a2171227599_219177479848755_9089002422357136983_n.jpg', '0000-00-00 00:00:00', 0),
	(27, 1, '/storage/image_for_user/e9e8daaa-62ba-4fd3-8d32-95f3d1d07896images (1).jpeg', '0000-00-00 00:00:00', 0);
/*!40000 ALTER TABLE `image_for_user` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.image_for_user_plant
CREATE TABLE IF NOT EXISTS `image_for_user_plant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_plant_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `created_date` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.image_for_user_plant: ~9 rows (approximately)
/*!40000 ALTER TABLE `image_for_user_plant` DISABLE KEYS */;
INSERT INTO `image_for_user_plant` (`id`, `user_plant_id`, `url`, `created_date`, `is_deleted`) VALUES
	(1, 3, '/storage/image_for_user_plant/51e255d9-eb50-4112-9a58-4a8b4821f242188465091_492964015189389_6273254574965887753_n.jpg', '0000-00-00', 0),
	(4, 6, '/storage/image_for_user_plant/d390b63c-47f3-4db7-8971-aef3287695e141iagp14xtt61.jpg', '0000-00-00', 0),
	(5, 7, '/storage/image_for_user_plant/e96753a1-cd2d-4478-beda-b63ea766add4p02zn2md.jpg', '0000-00-00', 0),
	(6, 8, '/storage/image_for_user_plant/f34639a4-0376-46ba-ad95-53167e8fd1c5zamioculcas-zamiifolia-zz-plant-pistils-nursery-733x949.jpg', '0000-00-00', 0),
	(7, 9, '/storage/image_for_user_plant/36442c15-3e87-481d-b244-4f9f1e1a57abimages (1).jpg', '0000-00-00', 0),
	(8, 11, '/storage/image_for_user_plant/3b0b633d-0cf3-46bc-bf88-5d8bd2728974a76LKn0E_700w_0.jpg', '0000-00-00', 0),
	(9, 12, '/storage/image_for_user_plant/98a3a374-4340-4ebb-91d0-7d93078064eda76LKn0E_700w_0.jpg', '0000-00-00', 0),
	(10, 13, '/storage/image_for_user_plant/3200ee16-b9e9-44d8-b142-9287538d95e8145310139_435083847726250_6323447123393892101_n.jpg', '0000-00-00', 0),
	(11, 14, '/storage/image_for_user_plant/b4a1ee13-33b8-4ec9-a19a-4bb03e0305f3150534618_421495215625812_4778847134011146192_n.jpg', '0000-00-00', 0),
	(12, 15, '/storage/image_for_user_plant/441f26a7-ba9c-498e-b15a-b4431713da13The-Mommy-is-sad-because-all-her-kids-turned-out-to-be-criminals.jpg', '0000-00-00', 0),
	(13, 16, '/storage/image_for_user_plant/97782a5a-815c-473e-a61f-4334d95738b4RDT_20210523_2227534405498798666487069.jpg', '0000-00-00', 0),
	(14, 17, '/storage/image_for_user_plant/c248bc50-fbf1-4af9-b15b-7f825c7bec51young-coffee-tree.jpg', '0000-00-00', 0);
/*!40000 ALTER TABLE `image_for_user_plant` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.liked_comment
CREATE TABLE IF NOT EXISTS `liked_comment` (
  `comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.liked_comment: ~11 rows (approximately)
/*!40000 ALTER TABLE `liked_comment` DISABLE KEYS */;
INSERT INTO `liked_comment` (`comment_id`, `user_id`) VALUES
	(1, 2),
	(62, 1),
	(53, 1),
	(52, 1),
	(51, 1),
	(64, 1),
	(37, 1),
	(67, 1),
	(63, 1),
	(60, 1),
	(59, 1),
	(68, 1);
/*!40000 ALTER TABLE `liked_comment` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.liked_post
CREATE TABLE IF NOT EXISTS `liked_post` (
  `post_id` int(4) DEFAULT NULL,
  `user_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.liked_post: ~1 rows (approximately)
/*!40000 ALTER TABLE `liked_post` DISABLE KEYS */;
INSERT INTO `liked_post` (`post_id`, `user_id`) VALUES
	(56, 1);
/*!40000 ALTER TABLE `liked_post` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caycanhapi.migrations: ~9 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(9, '2014_10_12_000000_create_users_table', 1),
	(10, '2014_10_12_100000_create_password_resets_table', 1),
	(11, '2019_08_19_000000_create_failed_jobs_table', 1),
	(12, '2021_03_14_014525_create_images_table', 1),
	(13, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
	(14, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
	(15, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
	(16, '2016_06_01_000004_create_oauth_clients_table', 2),
	(17, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.oauth_access_tokens
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caycanhapi.oauth_access_tokens: ~9 rows (approximately)
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('107b1ff4d987eb48c989b77cbc9329a08d4639954a899d318c96fc267994f211fe5a1e0609915798', 1, 3, 'appToken', '[]', 1, '2021-06-05 15:54:08', '2021-06-05 15:54:08', '2022-06-05 15:54:08'),
	('2652ac437aedb6d83702276032858c645a900644940403c5a56b13e03d8876907876790569573445', 4, 3, 'appToken', '[]', 1, '2021-06-13 10:22:49', '2021-06-13 10:22:49', '2022-06-13 10:22:49'),
	('2f94ca8afeff5b93cd49496c0f5619905c7835419523a5b2a69262a8e02259c9a38b20ca1c305907', 1, 3, 'appToken', '[]', 1, '2021-06-13 10:22:21', '2021-06-13 10:22:21', '2022-06-13 10:22:21'),
	('50ba31abb9c219d1c0a22e3e81d80323ccade474c0b91cadff64afe718e24cd58365bb29c57ad13c', 4, 3, 'appToken', '[]', 1, '2021-06-13 10:33:09', '2021-06-13 10:33:09', '2022-06-13 10:33:09'),
	('56c8a9913b3eaca1685d4674b340c6a96cf2b9e7ad060ef7f603199a427d0c3a54e134c62fc42419', 1, 3, 'appToken', '[]', 0, '2021-06-13 10:35:06', '2021-06-13 10:35:06', '2022-06-13 10:35:06'),
	('66d8f61656f614e8da85d03151aecd2589fb7bfa67634d59be1b9c4d7b569d6a331d8619154d64c5', 1, 3, 'appToken', '[]', 1, '2021-06-13 10:25:17', '2021-06-13 10:25:17', '2022-06-13 10:25:17'),
	('6a513ed36f1aa8b4bcd57e76c958a57ca596648ffd5bedf3bed9b329925f2f9e0c5644e9f1b5733e', 1, 3, 'appToken', '[]', 1, '2021-06-13 10:23:20', '2021-06-13 10:23:20', '2022-06-13 10:23:20'),
	('86c87677491deb9c5b6f480047035f93f7ad1a57a9f0b5c86e4ad303904267902bbd558e4112d5ca', 4, 3, 'appToken', '[]', 1, '2021-06-13 10:24:13', '2021-06-13 10:24:13', '2022-06-13 10:24:13'),
	('966125638381f1a331504d14219cc9ba4570449658797697b279109f7f33fa6816914c175e419ee7', 1, 3, 'appToken', '[]', 0, '2021-06-13 12:37:24', '2021-06-13 12:37:24', '2022-06-13 12:37:24'),
	('b3a2b8123eb70f6f4b8221fbdbf7f051a5616e24f16a28c6959f411c74b171d7366a21daa3310227', 4, 3, 'appToken', '[]', 1, '2021-06-13 09:59:25', '2021-06-13 09:59:25', '2022-06-13 09:59:25');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.oauth_auth_codes
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `scopes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caycanhapi.oauth_auth_codes: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.oauth_clients
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caycanhapi.oauth_clients: ~4 rows (approximately)
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'HJiIqTxzyIFnX04rUJ2dQ5mlEtMxlb3ZgjsXd4Rc', 'http://localhost', 1, 0, 0, '2021-03-22 12:34:41', '2021-03-22 12:34:41'),
	(2, NULL, 'Laravel Password Grant Client', 'UO09uvCNRC9UT0jxgSkyyE2lSU4uWX8GPUnP5QL6', 'http://localhost', 0, 1, 0, '2021-03-22 12:34:41', '2021-03-22 12:34:41'),
	(3, NULL, 'Laravel Personal Access Client', 'daIn4SzUx1f1NgMFJVaEP4OtMzQNdyyAVb3nfSIQ', 'http://localhost', 1, 0, 0, '2021-04-03 13:31:08', '2021-04-03 13:31:08'),
	(4, NULL, 'Laravel Password Grant Client', 'MpDtuwQBjn5aBKHjBx3KXlWJtYKMEeuP33ih7tX9', 'http://localhost', 0, 1, 0, '2021-04-03 13:31:08', '2021-04-03 13:31:08');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.oauth_personal_access_clients
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caycanhapi.oauth_personal_access_clients: ~2 rows (approximately)
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2021-03-22 12:34:41', '2021-03-22 12:34:41'),
	(2, 3, '2021-04-03 13:31:08', '2021-04-03 13:31:08');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.oauth_refresh_tokens
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caycanhapi.oauth_refresh_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table caycanhapi.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.pending_expert
CREATE TABLE IF NOT EXISTS `pending_expert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `bio` varchar(3000) DEFAULT NULL,
  `experience_in` varchar(3000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.pending_expert: ~1 rows (approximately)
/*!40000 ALTER TABLE `pending_expert` DISABLE KEYS */;
/*!40000 ALTER TABLE `pending_expert` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.plant_pending_exchange
CREATE TABLE IF NOT EXISTS `plant_pending_exchange` (
  `post_id` int(11) DEFAULT NULL,
  `user_plant_pending_id` int(11) DEFAULT NULL,
  `accepted` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.plant_pending_exchange: ~3 rows (approximately)
/*!40000 ALTER TABLE `plant_pending_exchange` DISABLE KEYS */;
INSERT INTO `plant_pending_exchange` (`post_id`, `user_plant_pending_id`, `accepted`) VALUES
	(56, 8, 1),
	(55, 8, NULL),
	(56, 17, NULL);
/*!40000 ALTER TABLE `plant_pending_exchange` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `content` varchar(2250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `like` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `audience` int(11) NOT NULL DEFAULT '1',
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.post: ~8 rows (approximately)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id`, `title`, `content`, `created_at`, `like`, `user_id`, `audience`, `deleted_at`, `updated_at`) VALUES
	(49, 'dc', NULL, '2021-06-05 15:51:32', 0, 1, 1, NULL, '2021-06-05'),
	(50, 'd', NULL, '2021-06-05 16:09:41', 0, 1, 1, NULL, '2021-06-05'),
	(51, 'bài viết', 'aaa', '2021-06-05 16:10:14', 0, 1, 1, NULL, '2021-06-05'),
	(52, 'v', NULL, '2021-06-05 16:18:57', 0, 1, 1, NULL, '2021-06-05'),
	(53, 'xc', NULL, '2021-06-05 16:20:05', 0, 1, 1, NULL, '2021-06-05'),
	(54, 'cây cảnh', 'xương rồng trao đổi', '2021-06-05 16:22:42', 0, 1, -1, NULL, '2021-06-05'),
	(55, 'ccc', 'cv b', '2021-06-05 16:24:14', 0, 1, 1, NULL, '2021-06-05'),
	(56, 'ffc', NULL, '2021-06-05 16:38:29', 1, 1, 1, NULL, '2021-06-13'),
	(57, 'cây cảnh', 'xương rồng trao đổi', '2021-06-11 09:57:03', 0, 1, -1, NULL, '2021-06-11');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.post_tag
CREATE TABLE IF NOT EXISTS `post_tag` (
  `post_id` int(4) DEFAULT NULL,
  `tag_id` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.post_tag: ~17 rows (approximately)
/*!40000 ALTER TABLE `post_tag` DISABLE KEYS */;
INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
	(49, -1),
	(49, 8),
	(50, -1),
	(51, -1),
	(51, 2),
	(51, 7),
	(51, 12),
	(52, -1),
	(53, -1),
	(53, 12),
	(54, -1),
	(55, -1),
	(55, 12),
	(56, -1),
	(56, 9),
	(56, 10),
	(57, -1),
	(56, 12);
/*!40000 ALTER TABLE `post_tag` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.role: ~2 rows (approximately)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `created_date`, `is_deleted`) VALUES
	(1, 'user', '0000-00-00', 0),
	(2, 'expert', '0000-00-00', 0),
	(3, 'admin', '0000-00-00', 0);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.saved_post
CREATE TABLE IF NOT EXISTS `saved_post` (
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.saved_post: ~0 rows (approximately)
/*!40000 ALTER TABLE `saved_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `saved_post` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.server_plant
CREATE TABLE IF NOT EXISTS `server_plant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accepted` tinyint(4) DEFAULT '0',
  `common_name` varchar(50) NOT NULL DEFAULT '',
  `scientific_name` varchar(50) DEFAULT NULL,
  `image_url` varchar(800) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pet_friendly` tinyint(4) DEFAULT '0',
  `difficulty` int(11) DEFAULT '1',
  `water_level` int(11) DEFAULT '1',
  `information` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sunlight` int(11) DEFAULT NULL,
  `feed_information` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `common_issue` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `min_temperature` double(22,0) DEFAULT '1',
  `max_temperature` double(22,0) DEFAULT '1',
  `min_ph` double DEFAULT NULL,
  `max_ph` double DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.server_plant: ~19 rows (approximately)
/*!40000 ALTER TABLE `server_plant` DISABLE KEYS */;
INSERT INTO `server_plant` (`id`, `accepted`, `common_name`, `scientific_name`, `image_url`, `pet_friendly`, `difficulty`, `water_level`, `information`, `sunlight`, `feed_information`, `common_issue`, `min_temperature`, `max_temperature`, `min_ph`, `max_ph`, `deleted_at`, `updated_at`, `created_at`) VALUES
	(44, 1, 'cây xương rồng', 'various Cactaceae', '/storage/image_for_server_plant/1.png', 1, 2, 4, 'Họ Xương rồng (danh pháp khoa học: Cactaceae) thường là các loài cây mọng nước hai lá mầm và có hoa. Họ Cactaceae có từ 25 đến 220 chi, tùy theo nguồn (90 chi phổ biến nhất), trong đó có từ 1.500 đến 1.800 loài. Những cây xương rồng được biết đến như là có nguồn gốc từ châu Mỹ, nhất là ở những vùng sa mạc. Cũng có một số loại biểu sinh trong rừng nhiệt đới, những loại đó mọc trên những cành cây, vì ở đó mưa rơi xuống đất nhanh, cho nên ở đó thường xuyên bị khô. Cây xương rồng có gai và thân để chứa nước dự trữ.', 1, 'lil3CblFDW26pVTU7MakVddxcE2RbDWIscaBwzywvHNeTgKrv8OAn748QoDDsPE73bN1frelMtdHmOZNOZtDALnGctRlDYT7d4DN', '2yeAfelsiNe83GBOfEijj4SCBts23AaJ0c4SXBMj9a0UuflS4cWSXzWnxIPAWiJEZMQ6qqUOh4liMUN0IfDeqBVxp4NwyhDdjzCX', 22, 31, 5.3, 6.5, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(45, 1, 'cây nha đam', 'aloe barbadensis miller', '/storage/image_for_server_plant/2.png', 0, 1, 1, 'Có nguồn gốc từ Bắc Phi. Theo truyền thuyết Ai Cập thì nữ hoàng Cléopâtre đã sử dụng nha đam để tạo ra một làn da mịn màng, tươi tắn. Còn đại đế Hy Lạp Alexandros đã dùng nha đam để chữa vết thương cho binh lính của mình trong những cuộc viễn chinh. Những dòng chữ tượng hình và những hình vẽ còn lưu lại trên những bức tường ở những đền đài Ai Cập cho thấy cây nha đam đã được biết đến và sử dụng cách đây hơn 3000 năm. Cho đến tận ngày hôm nay con người đã chứng minh và khẳng định được vai trò của cây nha đam trong cuộc sống con người. Cụ thể hơn là trong lĩnh vực dược phẩm, thực phẩm và mỹ phẩm.', 2, 'rP1GoMmPBLSzj0d32YUFqXKFhnE8WT6U6e5VJnXu8ijBAJMpVo7uyH1ok5EzKyMZRQg5jSWOfg67CRMnQQ1n7iGj2TLPIlFn6OrU', 'RbrAR7hboe5iFpFgXrT8outmUxE39nEYc6CS3TAytsJNPtwxclUQaOw4LuAQ5HtJyl8P5nGEOo9HxRbGdEVH9RJ2t99AnaLcHMyG', 21, 33, 5.1, 6.8, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(46, 1, 'HupVYkPcSc', 'ybSdXlYr3b', '/storage/image_for_server_plant/3.png', 1, 2, 4, '2Osd3mSN8Tbvz1dAasCDEAQCvOkNiFwNkRnsmDITKOcCfcuhbHI8DrD4vtVba9E9geqdkEaGtLnHrssGbqvp1vtBqqftzLQkrCoy', 2, 'OMJXT50HMTbxuiBweYeXAJUpnykDD6aWPvdI499vstA5VjqvpE0p3TQm60DTUtUIqJkVVUQ3nQhYOHsHoeVhAQFRU5ACiKxTri0Q', 'NSzCJ7y9hnsSg7mWTSvtPyxpzIJ2BLipntCcI4HwLXiXBpZTTihEYVLLInQAIzYAbQnRuMbMOVsl4f4ZO4i8OYhR2i0RWi2O4bRq', 20, 33, 5.7, 6.3, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(47, 1, 'MYl9m44ciP', '6sLy2fKidM', '/storage/image_for_server_plant/4.png', 0, 2, 3, 'STuAiZxJ4KUVNhqJVBAU9s1q6PlfuPUYCCH1oaM1NQeE8zPHa9d0TBjjX9cOLqGO20KnSzYlJsFpRIgVlIcjIYjOtzhoO21Ejyid', 3, 'AWEOOmox9ISb3dzgMo7L1Xd2RyiqnmtGh2DIwe8wlmEoqPOq01t4rxZzHSCHXulwLxrY2lqCEMPz8QvkB9vUbPbRbzdi1qI4vsXN', 'KNeGNmKvVWX6VdIz4MRGJyI7ThZfhcxB90KQE2Op9k2xb9OPFaOlA1CLM06oZo5l9yGS8AesjLdL0jOnQHgQXZ8bJf9Rv3ffdeQt', 21, 30, 5.2, 6.1, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(48, 1, 'cây đa búp đỏ', 'ficus elastica', '/storage/image_for_server_plant/5.png', 1, 5, 3, 'Đa búp đỏ hay còn gọi là đa cao su, đa dai (danh pháp hai phần: Ficus elastica) là một loài thực vật có hoa trong chi Đa đề (Ficus), có nguồn gốc ở vùng đông bắc Ấn Độ (Assam), kéo dài về phía nam tới Indonesia (Sumatra và Java).\r\n\r\nNó là loài cây thân gỗ lớn trong nhóm đa đề, có thể cao tới 30–40 m (ít khi thấy cao tới 60 m), với đường kính thân cây tới 2 m, với thân cây phát triển ra từ các rễ khí và rễ trụ để giữ chặt nó vào trong đất và giữ các cành to và nặng. Các lá của nó hình ôvan, bóng mặt, dài khoảng 10–35 cm và rộng 5–15 cm; kích thước lá lớn nhất có ở các cây non (đôi khi dài tới 45 cm), nhưng nhỏ hơn nhiều ở các cây già (thông thường khoảng 10 cm dài). Các lá phát triển ở bên trong một vỏ bọc tại mô phân sinh ở ngọn, gọi là búp đa, và nó sẽ phát triển lớn hơn khi lá mới được phát triển. Khi lá phát triển, nó mở ra và vỏ bọc rụng xuống. Bên trong của lá mới thì một lá non khác đang chờ để được phát triển.\r\n\r\nGiống như các thành viên khác của chi Ficus, hoa của đa búp đỏ cần phải có các loài ong đa đề (họ Agaonidae) chuyên biệt để thụ phấn trong quan hệ đồng tiến hóa. Do mối quan hệ này, đa búp đỏ không sản sinh ra các hoa nhiều màu sắc hay có hương thơm để dẫn dụ các loài côn trùng thụ phấn cho nó. Quả hình ôvan, nhỏ, màu lục-vàng, dài khoảng 1 cm, ăn được nhưng ít khi ăn; nó chứa các hạt và trong đó thì các ấu trùng của loài ong bắp cày thụ phấn cho đa đề có mặt.', 4, 'NratyOGBBIIykYHubvtwdE0WAGHRewy19IWfZZcW7SQMH6dvI85eVCEgRqAnRfNHKxQ61q3HRleM4A0Uemo3giboSei1CPPSQUqk', 'S77pQj40nioDt0Hl1425zCmZJNOk4IPwxBjRW2NUrZcDfuYLtuOVSSWUScrpMHmnAPEzPdHsgVRfC1mNSxO4dc8yUKvLFEAUtRrJ', 22, 30, 5.5, 6.9, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(49, 1, 'CGoV382UK3', 'VILSriNCnN', '/storage/image_for_server_plant/6.png', 1, 3, 4, 'R2DkXxzs32tPYuFIrrVmsYPStrM7xxyhzJ1OgpqD0EAq3dR9tfC50xWwNFpmmjMiSMzy0LZSvT5goWiBZdiIVkMWO1WX7QKq0ET0', 5, 'wVALETb1W7Ry6ahZnatYY0UXlOfyBNM64CdaF9XaJw8zxlb2fpZJSLcYF8Mp1k3juycAFgxZga2onY1PyTFG30EpbqIhOT53AJ2K', 'cU4psIRoBCvWXxC15zdDpRBYq5r1MuwZVTDIN1m5TLT8RXQ1d0XQ16nvH14v1UMzanIJPin2OJG9OW6OG86gWX8mpVDNvHPWNwyn', 21, 32, 5.5, 7, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(50, 1, 'pJYeiOeEaW', 'Dsj7JF8HEp', '/storage/image_for_server_plant/7.png', 1, 1, 1, 'JCCIO71TtvYW1reOylWEKcHhwh5I1EUBVjGRP23Rw4n2Iu5uymbKlF7I8YbGOHqSCkBejI0wAiqVFIlGbJnR28R21130KwR55dI2', 3, 'grfgRmzNAoCoJVw11iNAWgL0J50h2PDG4odm5Npm6xFJOZN7tkugDicXe7Is2U9RbeQ82v8kIMk7S2i1vhKUBFvBJxlkr4bLAL1V', 'JPJyzIjoTZJ5SeC1bHHtyq29gbBVJpuAfEnHpOJFa7wsyqsEBkqTfGpx0dbpI9OZoCBz04TJkdeL5iJm4NKRwhuR0EQ5RnhtdKwa', 21, 30, 5.4, 6.1, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(51, 1, 'cây chuỗi ngọc trai', 'curio rowleyanus', '/storage/image_for_server_plant/8.png', 0, 0, 2, 'Chuỗi ngọc hay được biết đến là cây thanh quan, cây rìa xanh, cây chuỗi vàng, có tên khoa học là Duranta repens thuộc họ cỏ roi ngựa (Verbenaceae). Chuỗi ngọc là cây có khả năng sinh trưởng và phát triển nhanh (có thể cao từ 0.2 – 3m) thường được sử dụng trồng làm cây công trình như: ở công viên, vỉa hè, khu đô thị,…\r\nChuỗi ngọc là loài cây cảnh thường sống theo bụi, có nguồn gốc từ Tây Ấn và Nam Mỹ. Cây có kích thước nhỏ, lá hình bầu dục dài từ 2 – 5cm, lá mọc đối xứng nhau hoặc vòng 3 lá, lá cây thường có màu vàng óng khi non và xanh nhẵn khi về già. Vì là cây phát triển nhanh nên để kìm hãm cây mọc thì người ta có thể cắt tỉa bớt cành lá của cây hoặc tạo hòn non bộ với dáng khác nhau.', 4, '5zk5zHIyorOlbZv8lZyL1ZagBZblbt3EwbifJdD2Qxe2kqyPLQeLrD3tsXEyNNS3R6gf5wyejZcPiA2NAkDbRMLxPYN5fESaMBg8', 'DJFHQw8xQT46HYKj99LiWAwVpmAPH6JadCEo1JeNCv1WJujyDAMgSYKi8gnuRCaRarG9QhMPjLpI8CilPTjrgFvqsLeScsGQruah', 21, 31, 5.1, 6.9, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(52, 1, 'QAKGDuMN7y', 'HXH8H5zU6S', '/storage/image_for_server_plant/9.png', 0, 5, 2, 'R9iykHyS5H52fmPD7hlofPxYHJr2BiWd52uu2i14K4UYJD8jRwnFvDqdDf8pPGHXJ23h6LaMslf1eQbxejeixtFWk5efv3M8MTwK', 1, 'g8yOPYGZ0bfu7RK07wOhCjueHLHlFIMgz0ceIHDVQR6MxKfGSNWJQUFOVECIytC4IECZC7Uhx9PQVXVH23x8uXJFjJWahFgN31NB', 'Vu0lO6Th3UQiJGaYYLWzzpTmC2tjTyvKd20k0Ufh5Z5ZIFdKJDCwEoQiypERCOOmSrjgPldkYd3E1O7xIlOIR5v39Nubv4y7n5Rg', 20, 33, 5.4, 6, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(53, 1, 'trầu bà Nam Mỹ', 'monstera', '/storage/image_for_server_plant/10.png', 0, 5, 2, 'TtTMuwwCzLeW34GDjmCGnwfONAUAsI3vhas52vREJ2KJZJpF5juLh1a9hlxW6F8mD1MlDQUuoZ7fMQOk8eUywnOgagPcR8tcnwed', 4, 'gVpzTAf4XNMJE3HUuQ2R3NmUfuJ07PiLWd49xBnBEkpUOR4Y9LrENm5M1RY84Hfrir6BSijgjvGsQtNZEUMGfBJs0uPCjCcPdeiM', '9Qzvb7kbN3n0nW5uYiJN6jS8UvNRGRwEARghCwoC5fEUcxET7hJVYLV9H7LFfgmYoXuN90Zngr0FxTQWfChiGzhlnK9kG9rqs1Fw', 20, 32, 5.5, 6.5, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(54, 1, 'MfER8R350F', 'IVGjM98dOh', '/storage/image_for_server_plant/11.png', 0, 5, 1, 'my3Tc28Ckk6xgBcQeJVDDCFhFq4xbXcTXLkbBHomqoiqmHaSTBqRpSrxLNtvd6289VWreWuVirIdt7EzJfaBrNLKaxVH6Lyk3tcR', 3, 'wc4aqlUxjo2FXJOeVZmNQZpw7y3VlMT8NE5w6C03L5haokoc95RF57DGXeYstF8KGdCDYMcPNfBrJyhQICwzAty0HYlIkJ7cB8if', '0LcSBltfhq3OGHm0Zgerfk4gJuH7GzxYf8W3tOroTnvABRBQVQrosN9xCJDJMvvqpuNuPPlDrGfpiiA1omBYuUNB1NS4anRPjBo5', 22, 32, 5.4, 6.3, NULL, '2021-04-27 09:55:28', '2021-04-27 09:55:28'),
	(55, 0, 'y1y2IQqeBy', 'zWRkMDW6nh', '/storage/image_for_server_plant/12.png', 0, 5, 5, 'j5AV01Ag3EClKy0pTwFmhlHzYhe5YI8IlCM3d9MGXSNO3SROKmxNujbYWJTWzTD5B4DtsvDa3sNVJM5WNsQ8NJQrib0z8Gpdubl6', 2, 'LoUBQcGIAzfruZ1kXcXuGK2bLhFXoLNCt0da3GDtBROA29RGllmBugNISHHkQqWNhGSPBRnNyZJUNN4GRkNo6cW1JgNx8xSHmm6s', 'gOqMPmAPepyze00Zse0fxJvOoi9UCpQ12cm8MWUgjVYy2xNJJ1YSyV3MTYPFNI2yckt8ySjlGEVJfkVGpRjJDsu3XGreFkGYSd5G', 21, 29, 5.2, 7, NULL, '2021-06-02 22:12:21', '2021-04-27 09:55:28'),
	(68, 0, 's', 'a', '/storage/image_for_server_plant/c66bb1ff-43e6-4217-a27f-854890fb323bimages (2) (1).jpeg', 0, 1, 1, 's', 1, NULL, NULL, 30, 20, NULL, NULL, NULL, '2021-06-05 15:57:48', '2021-06-05 15:57:48'),
	(69, 0, 'ffc', 'dd', '/storage/image_for_server_plant/7a33c32d-fcac-4c70-944a-f455bb0c767720-CÂY-XANH.jpg', 0, 1, 1, 'fbjj', 1, NULL, NULL, 30, 20, NULL, NULL, NULL, '2021-06-05 15:58:37', '2021-06-05 15:58:37'),
	(70, 0, '3', '3', '/storage/image_for_server_plant/bc9225a9-008d-4145-a401-72dffe8c0ef7images (2) (1).jpeg', 0, 1, 1, '3', 1, NULL, NULL, 30, 20, NULL, NULL, NULL, '2021-06-05 15:59:56', '2021-06-05 15:59:56'),
	(72, 1, 'sdf', 'wsef', '/storage/image_for_server_plant/cffb672f-41bc-4996-8600-cf74528b09aecactus_noun_002_05162.jpg', 0, 1, 1, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2021-06-12 09:08:59', '2021-06-12 09:08:59'),
	(73, 1, 'werwetwe', 'sdfsdf', '/storage/image_for_server_plant/ea0942e3-a67a-4f0d-9e91-f1a54bbc23feunnamed (1).png', 0, 1, 1, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2021-06-12 09:10:47', '2021-06-12 09:10:47'),
	(74, 0, 'sdfsdf', 'sdf', '/storage/image_for_server_plant/92eda9b2-dd7b-4d1c-94cc-7ae82be32756mother-in-laws-tongue.jpg', 0, 1, 1, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2021-06-12 09:24:11', '2021-06-12 09:24:11'),
	(75, 0, 'sdfsdf', 'sdfdf', '/storage/image_for_server_plant/bc505f41-e71a-4cea-b5c6-b383b676a2fadownload (1).jfif', 0, 1, 1, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, '2021-06-12 11:26:11', '2021-06-12 11:26:11');
/*!40000 ALTER TABLE `server_plant` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.server_plant_user_edit
CREATE TABLE IF NOT EXISTS `server_plant_user_edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `has_viewed` tinyint(4) DEFAULT '0',
  `server_plant_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(225) DEFAULT NULL,
  `common_name` varchar(50) NOT NULL DEFAULT '',
  `scientific_name` varchar(50) DEFAULT NULL,
  `pet_friendly` tinyint(4) DEFAULT '0',
  `difficulty` int(11) DEFAULT '1',
  `water_level` int(11) DEFAULT '1',
  `information` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sunlight` int(11) DEFAULT NULL,
  `feed_information` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `common_issue` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `min_temperature` double(22,0) DEFAULT '1',
  `max_temperature` double(22,0) DEFAULT '1',
  `min_ph` double DEFAULT NULL,
  `max_ph` double DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.server_plant_user_edit: ~1 rows (approximately)
/*!40000 ALTER TABLE `server_plant_user_edit` DISABLE KEYS */;
INSERT INTO `server_plant_user_edit` (`id`, `has_viewed`, `server_plant_id`, `user_id`, `user_name`, `common_name`, `scientific_name`, `pet_friendly`, `difficulty`, `water_level`, `information`, `sunlight`, `feed_information`, `common_issue`, `min_temperature`, `max_temperature`, `min_ph`, `max_ph`, `deleted_at`, `updated_at`, `created_at`) VALUES
	(76, 0, 51, 1, NULL, 'abc', 'curio rowleyanus', 0, 1, 2, 'Chuỗi ngọc hay được biết đến là cây thanh quan, cây rìa xanh, cây chuỗi vàng, có tên khoa học là Duranta repens thuộc họ cỏ roi ngựa (Verbenaceae). Chuỗi ngọc là cây có khả năng sinh trưởng và phát triển nhanh (có thể cao từ 0.2 – 3m) thường được sử dụng trồng làm cây công trình như: ở công viên, vỉa hè, khu đô thị,…\r\nChuỗi ngọc là loài cây cảnh thường sống theo bụi, có nguồn gốc từ Tây Ấn và Nam Mỹ. Cây có kích thước nhỏ, lá hình bầu dục dài từ 2 – 5cm, lá mọc đối xứng nhau hoặc vòng 3 lá, lá cây thường có màu vàng óng khi non và xanh nhẵn khi về già. Vì là cây phát triển nhanh nên để kìm hãm cây mọc thì người ta có thể cắt tỉa bớt cành lá của cây hoặc tạo hòn non bộ với dáng khác nhau.', 4, '5zk5zHIyorOlbZv8lZyL1ZagBZblbt3EwbifJdD2Qxe2kqyPLQeLrD3tsXEyNNS3R6gf5wyejZcPiA2NAkDbRMLxPYN5fESaMBg8', 'DJFHQw8xQT46HYKj99LiWAwVpmAPH6JadCEo1JeNCv1WJujyDAMgSYKi8gnuRCaRarG9QhMPjLpI8CilPTjrgFvqsLeScsGQruah', 21, 31, NULL, NULL, NULL, '2021-06-13 15:36:32', '2021-06-13 12:49:17'),
	(77, 0, 48, 1, NULL, 'cây đa búp abc', 'ficus elastica', 1, 1, 3, 'Đa búp đỏ hay còn gọi là đa cao su, đa dai (danh pháp hai phần: Ficus elastica) là một loài thực vật có hoa trong chi Đa đề (Ficus), có nguồn gốc ở vùng đông bắc Ấn Độ (Assam), kéo dài về phía nam tới Indonesia (Sumatra và Java).\r\n\r\nNó là loài cây thân gỗ lớn trong nhóm đa đề, có thể cao tới 30–40 m (ít khi thấy cao tới 60 m), với đường kính thân cây tới 2 m, với thân cây phát triển ra từ các rễ khí và rễ trụ để giữ chặt nó vào trong đất và giữ các cành to và nặng. Các lá của nó hình ôvan, bóng mặt, dài khoảng 10–35 cm và rộng 5–15 cm; kích thước lá lớn nhất có ở các cây non (đôi khi dài tới 45 cm), nhưng nhỏ hơn nhiều ở các cây già (thông thường khoảng 10 cm dài). Các lá phát triển ở bên trong một vỏ bọc tại mô phân sinh ở ngọn, gọi là búp đa, và nó sẽ phát triển lớn hơn khi lá mới được phát triển. Khi lá phát triển, nó mở ra và vỏ bọc rụng xuống. Bên trong của lá mới thì một lá non khác đang chờ để được phát triển.\r\n\r\nGiống như các thành viên khác của chi Ficus, hoa của đa búp đỏ cần phải có các loài ong đa đề (họ Agaonidae) chuyên biệt để thụ phấn trong quan hệ đồng tiến hóa. Do mối quan hệ này, đa búp đỏ không sản sinh ra các hoa nhiều màu sắc hay có hương thơm để dẫn dụ các loài côn trùng thụ phấn cho nó. Quả hình ôvan, nhỏ, màu lục-vàng, dài khoảng 1 cm, ăn được nhưng ít khi ăn; nó chứa các hạt và trong đó thì các ấu trùng của loài ong bắp cày thụ phấn cho đa đề có mặt.', 4, 'NratyOGBBIIykYHubvtwdE0WAGHRewy19IWfZZcW7SQMH6dvI85eVCEgRqAnRfNHKxQ61q3HRleM4A0Uemo3giboSei1CPPSQUqk', 'S77pQj40nioDt0Hl1425zCmZJNOk4IPwxBjRW2NUrZcDfuYLtuOVSSWUScrpMHmnAPEzPdHsgVRfC1mNSxO4dc8yUKvLFEAUtRrJ', 22, 30, NULL, NULL, NULL, '2021-06-13 12:54:58', '2021-06-13 12:50:03');
/*!40000 ALTER TABLE `server_plant_user_edit` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.tag
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_type_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(225) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.tag: ~11 rows (approximately)
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` (`id`, `tag_type_id`, `name`, `created_date`, `deleted_at`) VALUES
	(-1, 3, 'default', '2021-05-16', NULL),
	(1, 1, 'cây Lan', '2021-03-26', NULL),
	(2, 1, 'cây văn phòng', '2021-03-26', NULL),
	(3, 1, 'trầu bà', '2021-03-26', NULL),
	(4, 1, 'xương rồng', '2021-03-26', NULL),
	(5, 1, 'sen đá', '2021-03-26', NULL),
	(6, 1, 'dây leo', '2021-03-26', NULL),
	(7, 2, 'mẹo vặt', '2021-03-26', NULL),
	(8, 2, 'tâm sự', '2021-03-26', NULL),
	(9, 2, 'nâng cao', '2021-03-26', NULL),
	(10, 2, 'kiến thức', '2021-03-26', NULL),
	(11, 2, 'cơ bản', '2021-03-26', NULL),
	(12, 4, 'trao đổi', '2021-05-20', NULL);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.tag_type
CREATE TABLE IF NOT EXISTS `tag_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL DEFAULT '0',
  `created_date` date NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.tag_type: ~4 rows (approximately)
/*!40000 ALTER TABLE `tag_type` DISABLE KEYS */;
INSERT INTO `tag_type` (`id`, `name`, `created_date`, `is_deleted`) VALUES
	(1, 'Loại Cây', '2021-03-26', 0),
	(2, 'Nội dung', '2021-03-26', 0),
	(3, 'Default', '2021-05-17', 0),
	(4, 'Trao đổi', '2021-05-20', 0);
/*!40000 ALTER TABLE `tag_type` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.task
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plant_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `description` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `from_date` date NOT NULL DEFAULT '0000-00-00',
  `to_date` date NOT NULL DEFAULT '0000-00-00',
  `created_date` date NOT NULL DEFAULT '0000-00-00',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.task: ~0 rows (approximately)
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
/*!40000 ALTER TABLE `task` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `bio` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `role_id` int(11) NOT NULL DEFAULT '1',
  `is_deleted` tinyint(4) DEFAULT '0',
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_vi_0900_ai_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.user: ~5 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `email`, `password`, `bio`, `role_id`, `is_deleted`, `name`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'chronicle', 'chronicle1951@gmail.com', '$2y$10$hbysJrQYpZhOTzNT6JffcuAoyZDnzz2NdnDpYvwq7AePlY8U.BtCu', 'Welcome to my feed, where people come for enjoyment.', 2, 0, 'Mai Đăng Khoa', NULL, NULL, '2021-03-31 14:55:40', '2021-06-10 15:27:33', NULL),
	(4, 'lampart', 'dangkhoa.lampart@gmail.com', '$2y$10$fYzWwFpa8Uqlrqk4G5cDiecxpwyfAwn7zVwwhvJnUkTebkxHa9gK2', 'I am a rare species, not a stereotype.', 1, 0, 'Nguyễn Văn A', NULL, NULL, '2021-04-08 08:28:07', '2021-05-10 11:27:19', NULL),
	(5, 'z', 'dangkhoa@gmail.com', '$2y$10$1vyNg.NWLf0AP3S8LtcyVOZ8eDs3MCiKHUUjY4G/ww0e2RvQHdqEK', ' I’m not ashamed to be me. What’s wrong with being amazingly unique?', 1, 0, 'Mai Đăng Khoa', NULL, NULL, '2021-04-11 16:46:45', '2021-04-11 16:46:46', NULL),
	(6, 'plantcare', 'plantcare@gmail.com', '$2y$10$1vyNg.NWLf0AP3S8LtcyVOZ8eDs3MCiKHUUjY4G/ww0e2RvQHdqEK', 'I’m writing my autobiography on my Facebook account.', 2, 0, 'Plant Care', NULL, NULL, '2021-04-11 16:47:30', '2021-05-10 15:46:18', NULL),
	(7, 'khoa', 'khoa@gmail.com', '$2y$10$apLDytxUt8rOU/jxWRsSHOBm.f2EyQ5KKOUETXD6Rd6tYGUkKS9dC', '', 1, 0, 'khoa', NULL, NULL, '2021-04-12 17:03:22', '2021-04-12 17:03:22', NULL),
	(8, 'admin', 'admin@gmail.com', '$2y$10$LsLLHLjQwhV.lWNyo7YmXOz7rJY/qKKdYWrz6lyNf.1YICRBeSWwK', '', 3, 0, 'Khoa', NULL, NULL, '2021-05-10 09:23:06', '2021-05-10 09:23:06', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.user_follow_user
CREATE TABLE IF NOT EXISTS `user_follow_user` (
  `user_id` int(11) DEFAULT NULL,
  `follower_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.user_follow_user: ~5 rows (approximately)
/*!40000 ALTER TABLE `user_follow_user` DISABLE KEYS */;
INSERT INTO `user_follow_user` (`user_id`, `follower_user_id`) VALUES
	(1, 4),
	(1, 5),
	(1, 6),
	(1, 7),
	(7, 1),
	(4, 1);
/*!40000 ALTER TABLE `user_follow_user` ENABLE KEYS */;

-- Dumping structure for table caycanhapi.user_plant
CREATE TABLE IF NOT EXISTS `user_plant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `common_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `scientific_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  `description` varchar(2000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT ' ',
  `available` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table caycanhapi.user_plant: ~10 rows (approximately)
/*!40000 ALTER TABLE `user_plant` DISABLE KEYS */;
INSERT INTO `user_plant` (`id`, `user_id`, `common_name`, `scientific_name`, `description`, `available`, `created_at`, `deleted_at`, `updated_at`) VALUES
	(3, 4, 'xương rồng', 'cactus', 'xương rồng trao đổi', 1, '2021-05-19 10:42:06', NULL, '2021-05-19 10:42:06'),
	(6, 1, 'xương rồng', ' ', 'xương rồng trao đổi', 1, '2021-05-19 16:51:07', NULL, '2021-05-19 16:51:07'),
	(7, 1, 'cây cảnh', ' ', 'xương rồng trao đổi', 1, '2021-05-19 19:27:52', NULL, '2021-05-19 19:27:52'),
	(8, 4, 'cây cảnh', ' ', 'xương rồng trao đổi', 1, '2021-05-19 19:28:03', NULL, '2021-05-19 19:28:03'),
	(9, 1, 'cây cảnh', ' ', 'xương rồng trao đổi', 1, '2021-05-19 19:28:12', NULL, '2021-05-19 19:28:12'),
	(11, 1, 'cây cảnh', '', 'xương rồng trao đổi', 1, '2021-05-19 19:30:48', NULL, '2021-05-19 19:30:48'),
	(12, 1, 'cây cảnh', '', 'xương rồng trao đổi', 1, '2021-05-19 19:35:40', NULL, '2021-05-19 19:35:40'),
	(13, 1, 'cây cảnh', '', 'xương rồng trao đổi', 1, '2021-05-19 19:35:57', NULL, '2021-05-19 19:35:57'),
	(14, 1, 'cây cảnh', '', 'xương rồng trao đổi', 1, '2021-05-19 19:37:31', NULL, '2021-05-19 19:37:31'),
	(15, 1, 'cây sen', 'vhhhhh', ' ', 1, '2021-05-20 15:19:28', NULL, '2021-05-20 15:19:28'),
	(16, 1, 'test', 'gdgdgd', ' You can use Padding, which is a very simple Widget that just takes another Widget as a child and an EdgeInsets object like the one you are already using as padding.', 1, '2021-05-30 20:43:36', NULL, '2021-05-30 20:43:36'),
	(17, 4, 'hoa', 'c', NULL, 1, '2021-06-13 10:34:21', NULL, '2021-06-13 10:34:21');
/*!40000 ALTER TABLE `user_plant` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
