-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 19, 2023 at 02:25 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog2`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posx` int(11) NOT NULL DEFAULT 1,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typ` enum('banner','linkk') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'banner',
  `linkk` varchar(500) CHARACTER SET utf32 DEFAULT NULL,
  `des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dess` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `posx`, `img`, `typ`, `linkk`, `des`, `dess`, `created_at`, `updated_at`) VALUES
(5, 'banner1', 4, '1652359793.jpg', 'banner', 'http://www.hotmail.com', '', '', '2022-05-12 08:49:53', '2022-05-30 09:29:34'),
(6, 'Banner2', 2, '1652462320.jpg', 'banner', 'http://www.web.com', '', '', '2022-05-13 13:18:40', '2022-05-30 04:55:52'),
(7, 'Banner3', 3, '1652471335.jpg', 'banner', 'http;//www.aravot.am', '', '', '2022-05-13 15:48:55', '2022-05-13 16:11:52'),
(8, 'Banner one 2 34', 1, '1652598677.jpg', 'banner', 'http://www.tir.media', '', '', '2022-05-15 03:11:17', '2022-05-15 03:17:56'),
(9, 'banner6', 5, '1652600391.jpg', 'banner', 'http://www/yahoo.com', '', '', '2022-05-15 03:39:52', '2022-05-30 11:31:28'),
(10, 'Link1', 1, '1652985053.jpg', 'linkk', 'http;//www.link.com', 'link 111', '<p><strong>Link111111</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>link2222</strong></p>', '2022-05-19 14:30:53', '2022-05-19 14:30:53'),
(11, 'Link2222', 1, '1652985084.jpg', 'linkk', 'http://www.kk.com', '', '', '2022-05-19 14:31:24', '2022-05-19 14:31:24'),
(12, 'Link333', 1, '1652985122.jpg', 'linkk', 'http://www.hotmail.com', 'Link222\r\n\r\nderer\r\n\r\n\r\nrer', '<p><strong>rere</strong></p>\r\n\r\n<p><strong>rer</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>rerrerre</strong></p>', '2022-05-19 14:32:02', '2022-05-19 14:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

DROP TABLE IF EXISTS `cats`;
CREATE TABLE IF NOT EXISTS `cats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordx` int(11) NOT NULL,
  `des` text CHARACTER SET utf32 DEFAULT NULL,
  `img` varchar(500) CHARACTER SET utf32 COLLATE utf32_estonian_ci DEFAULT NULL,
  `homer` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `layerr` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`id`, `name`, `ordx`, `des`, `img`, `homer`, `layerr`, `created_at`, `updated_at`) VALUES
(11, 'Politics', 10, 'politics in general', '1652251845.jpg', 'yes', 1, '2022-05-11 02:50:45', '2022-05-11 02:50:56'),
(12, 'Miscellaneous', 1, '', '1652255099.jpg', 'yes', 3, '2022-05-11 03:44:59', '2022-05-12 12:57:35'),
(13, 'Socialism', 1, '', '1652255335.jpg', 'yes', 2, '2022-05-11 03:48:55', '2022-05-12 12:57:24'),
(14, 'Humor', 1, '', '1652255365.jpg', 'yes', 1, '2022-05-11 03:49:25', '2022-05-11 03:49:25'),
(15, 'Life', 1, '', '1652255401.jpg', 'yes', 1, '2022-05-11 03:50:02', '2022-05-11 03:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gals`
--

DROP TABLE IF EXISTS `gals`;
CREATE TABLE IF NOT EXISTS `gals` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `prodid` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gals_prodid_foreign` (`prodid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gals`
--

INSERT INTO `gals` (`id`, `prodid`, `name`, `img`, `created_at`, `updated_at`) VALUES
(4, 14, 'ftrte', '1652515356.jpg', '2022-05-14 04:02:36', '2022-05-14 04:02:36'),
(5, 14, 'gal222', '1652552009.jpg', '2022-05-14 14:13:31', '2022-05-14 14:13:31'),
(6, 12, 'Gal333', '1652552031.jpg', '2022-05-14 14:13:52', '2022-05-14 14:13:52'),
(7, 17, 'Image 1', '1652723372.jpg', '2022-05-16 13:49:34', '2022-05-16 13:49:34'),
(8, 17, 'Image 222', '1652723414.jpg', '2022-05-16 13:50:14', '2022-05-16 13:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_19_164544_create_cats_table', 2),
(7, '2022_04_29_125541_create_prods_table', 3),
(8, '2022_04_30_103635_create_gals_table', 3),
(9, '2022_05_03_143306_create_subcats_table', 4),
(10, '2022_05_03_152927_add_subsubid_prod', 5),
(11, '2022_05_06_164418_create_videos_table', 6),
(12, '2022_05_06_194122_create_banners_table', 7),
(13, '2022_05_14_075644_create_taggs_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prods`
--

DROP TABLE IF EXISTS `prods`;
CREATE TABLE IF NOT EXISTS `prods` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catid` int(10) UNSIGNED NOT NULL,
  `subid` bigint(20) UNSIGNED DEFAULT 0,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordx` int(11) NOT NULL,
  `des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dess` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywordd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metades` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `homer` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `homer2` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `layerr` int(11) DEFAULT 1,
  `tagg` varchar(500) CHARACTER SET utf32 DEFAULT NULL,
  `dater` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prods_catid_foreign` (`catid`),
  KEY `prods_subid_foreign` (`subid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prods`
--

INSERT INTO `prods` (`id`, `catid`, `subid`, `name`, `ordx`, `des`, `dess`, `img`, `title`, `keywordd`, `metades`, `lang`, `video`, `homer`, `homer2`, `layerr`, `tagg`, `dater`, `created_at`, `updated_at`) VALUES
(5, 13, 0, 'News1', 1, 'this is the short details\r\n\r\nthis si the short details', '<p>this si the long detailssss</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1:8000/images/proder/car-3_1652274995.jpg\" style=\"height:225px; width:225px\" /></p>', '1652275024.jpg', 'News1', '', '', 'english', NULL, 'yes', 'yes', 1, NULL, '2022-05-11', '2022-05-11 09:16:43', '2022-05-11 09:17:05'),
(6, 11, 14, 'News222', 1, 'this is short details 2\r\n\r\nthis is short details 2', '<p><strong>this is short details 2</strong></p>\r\n\r\n<p><strong>this is short details 2</strong></p>', '1652275385.png', 'News222', '', '', 'english', NULL, 'yes', 'yes', 1, NULL, '2022-05-11', '2022-05-11 09:23:07', '2022-05-11 09:23:07'),
(7, 12, 0, 'News 3', 1, 'this is description 1 \r\n\r\nthis is description 1', '<p>this is description 1&nbsp;</p>\r\n\r\n<p>this is description 1 &nbsp;</p>', '1652276460.jpg', 'News 3', '', '', 'english', NULL, 'yes', 'yes', 1, NULL, '2022-05-11', '2022-05-11 09:41:01', '2022-05-11 09:41:01'),
(8, 13, 0, 'News 4', 1, 'this is description 1 \r\n\r\nthis is description 1', '', '1652276530.jpg', 'News 4', '', '', 'english', NULL, 'yes', 'yes', 1, NULL, '2022-05-11', '2022-05-11 09:42:11', '2022-05-11 09:42:11'),
(9, 13, 0, 'News5', 1, 'this is description 1 222\r\n\r\nthis is description 1  22222', '<p>this is description 1&nbsp;</p>\r\n\r\n<p>this is description 1 &nbsp;</p>', '1652276692.jpg', 'News5', '', '', 'english', NULL, 'yes', 'yes', 1, NULL, '2022-05-11', '2022-05-11 09:44:52', '2022-05-11 09:44:52'),
(10, 14, 0, 'Newsss', 1, 'newssss', '', '1652374692.jpg', 'Newsss', '', '', 'english', NULL, 'yes', 'yes', 3, NULL, '2022-05-12', '2022-05-12 12:58:14', '2022-05-12 14:09:46'),
(11, 11, 14, 'Newss345', 11, '', '', '1652374809.jpg', 'Newss345', '', '', 'english', NULL, 'yes', 'no', 1, NULL, '2022-05-12', '2022-05-12 13:00:09', '2022-05-12 13:00:09'),
(12, 12, 0, 'Newssss', 1, 'description  1 \r\n\r\ndescription  2', '', '1652463884.jpg', 'Newssss', '', '', 'english', NULL, 'yes', 'yes', 2, NULL, '2022-05-13', '2022-05-13 13:44:45', '2022-05-13 13:44:45'),
(13, 11, 15, 'Newsccc555', 1, 'description  1 \r\n\r\ndescription  1', '', '1652463930.jpg', 'Newsccc555', '', '', 'english', NULL, 'no', 'yes', 2, NULL, '2022-05-13', '2022-05-13 13:45:30', '2022-05-13 13:45:30'),
(14, 15, 0, 'news78', 1, '', '', '1652470583.jpg', 'news78', '', '', 'english', NULL, 'no', 'no', 1, NULL, '2022-05-13', '2022-05-13 15:36:24', '2022-05-13 15:36:24'),
(15, 14, 0, 'humnor111', 1, 'trtrtt', '', '1652682463.jpg', 'humnor111', '', '', 'english', NULL, 'no', 'no', 1, 'Tag1,Tag2,Tag3,Tag4', '2022-05-16', '2022-05-16 02:27:44', '2022-05-16 02:27:44'),
(16, 11, 14, 'Armnews1', 1, 'ertrtre', '<p>treter</p>', '1652682544.jpg', 'title 1', 'keyword1,keyword2,keyword3', 'description1', 'english', NULL, 'no', 'yes', 1, 'Tag1,Tag2,Tag3,Tag4', '2022-05-16', '2022-05-16 02:29:04', '2022-05-16 02:29:04'),
(17, 11, 14, 'Full Armenia 1', 18, 'detail details detailssss \r\n\r\ndetail details detailssss', '<p>Boldeerrrr</p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1:8000/images/proder/1627209133_1652682619.jpg\" style=\"border-style:solid; border-width:3px; float:left; height:335px; margin:2px; width:224px\" /></p>', '1652682684.jpg', 'meta taitle1', 'keyowrd1,keyword2,keyword3,keyword4', 'meta description 1', 'english', NULL, 'yes', 'yes', 1, 'tag1,tagg1,tagg2,tag4,tag5,tag6', '2022-05-16', '2022-05-16 02:31:25', '2022-05-16 02:31:25'),
(18, 11, 13, 'Lebanese full news 1', 13, 'erewerw\r\n\r\nreer\r\n\r\nrere', '<p>rre</p>\r\n\r\n<p><strong>rr</strong></p>\r\n\r\n<p><strong>rereee&nbsp;</strong></p>\r\n\r\n<p>rreewr&nbsp;</p>\r\n\r\n<p><img alt=\"\" src=\"http://127.0.0.1:8000/images/proder/leb6_1652683774.jpg\" style=\"height:243px; width:324px\" /></p>', '1652683815.jpg', 'meta tilte', 'keyowrd1,keyword2,keyword3,keyword4', 'meta dsescription', 'english', NULL, 'yes', 'yes', 1, 'Tag1,Tag2,Tag3,Tag3333,armenia,armenian', '2022-05-16', '2022-05-16 02:50:16', '2022-05-16 02:50:16'),
(19, 15, 0, 'NNNWww', 14, 't656', '<p>654665</p>', 'ytytyt-292.jpg', 'ytytyt', 'ytyt', '6565656', 'english', NULL, 'yes', 'yes', 1, 'tag,tag1,tag2,tag3', '2022-05-29', '2022-05-29 13:20:06', '2022-05-29 13:20:06'),
(20, 14, 0, 'sdfds', 18, 'hfghfghf', '', 'sdfds-108.jpg', 'sdfds', '', '', 'english', NULL, 'yes', 'yes', 2, NULL, '2022-05-29', '2022-05-29 13:22:44', '2022-05-29 13:22:44'),
(21, 11, 15, 'tyt', 16, 'ggfdgd', '<p>fgfdgf</p>', 'tyt-429.jpg', 'tyt', '', '', 'english', NULL, 'yes', 'yes', 2, NULL, '2022-05-29', '2022-05-29 13:39:42', '2022-05-29 13:39:42'),
(22, 12, 0, 'ytryytr', 11, 'uiuyi', '<p>iuiui</p>', 'ytryytr-140.jpg', 'ytryytr', '', 'iuiiuyi', 'english', NULL, 'yes', 'yes', 2, NULL, '2022-05-29', '2022-05-29 13:40:26', '2022-05-29 13:40:26'),
(23, 11, 13, 'ytryty', 1, '878787yrtye', '<p>ytyty</p>', 'ytryty-146.jpg', 'ytryty', '', '', 'english', NULL, 'no', 'no', 2, NULL, '2022-05-29', '2022-05-29 13:41:03', '2022-05-29 13:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `prodsxxx`
--

DROP TABLE IF EXISTS `prodsxxx`;
CREATE TABLE IF NOT EXISTS `prodsxxx` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catid` int(10) UNSIGNED NOT NULL,
  `name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordx` int(11) DEFAULT 1,
  `des` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dess` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `img` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keywordd` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metades` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'eng',
  `video` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcats`
--

DROP TABLE IF EXISTS `subcats`;
CREATE TABLE IF NOT EXISTS `subcats` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catid` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordx` int(11) DEFAULT 1,
  `des` text CHARACTER SET utf32 DEFAULT NULL,
  `img` varchar(500) CHARACTER SET utf32 DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcats_catid_foreign` (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcats`
--

INSERT INTO `subcats` (`id`, `catid`, `name`, `ordx`, `des`, `img`, `created_at`, `updated_at`) VALUES
(13, 11, 'Lebanon', 1, 'Lebanese Politics', '', '2022-05-11 03:41:56', '2022-05-11 03:41:56'),
(14, 11, 'Armenia', 1, 'Armenia', '', '2022-05-11 03:42:20', '2022-05-11 03:42:20'),
(15, 11, 'International', 1, 'International', '', '2022-05-11 03:42:40', '2022-05-11 03:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `taggs`
--

DROP TABLE IF EXISTS `taggs`;
CREATE TABLE IF NOT EXISTS `taggs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taggs`
--

INSERT INTO `taggs` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Tag1', '2022-05-14 05:14:57', '2022-05-14 05:14:57'),
(4, 'Tag2', '2022-05-14 05:15:09', '2022-05-14 05:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$woXPS36wmW8NLjXPURYeoehWnBafF3FIVJFwr43ONb3LOkHtH3b7m', NULL, '2022-04-19 12:21:47', '2022-04-19 12:21:47');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dess` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkk` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `layerr` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `dess`, `linkk`, `layerr`, `created_at`, `updated_at`) VALUES
(1, 'video111', '<p>hhghhfghh</p>', 'https://www.youtube.com/embed/1m-C9n03Ikk', 1, '2022-05-06 15:16:08', '2022-05-13 14:21:47'),
(4, 'Video 2', '', 'https://www.youtube.com/embed/nVJZ3fLGLR0', 2, '2022-05-13 14:51:20', '2022-05-13 14:51:20'),
(5, 'Layer 3', '', 'https://www.youtube.com/embed/9JV6bmsyWBg', 3, '2022-05-15 04:09:14', '2022-05-15 04:09:14'),
(6, 'layeerer222', '', 'https://www.youtube.com/embed/9JV6bmsyWBg', 2, '2022-05-30 10:36:35', '2022-05-30 10:36:35'),
(7, 'layerer3333', '', 'https://www.youtube.com/embed/9JV6bmsyWBg', 3, '2022-05-30 10:36:49', '2022-05-30 10:36:49');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
