-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2025 at 12:21 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_wroom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_02_20_102403_add_role_to_users_table', 2),
(6, '2024_02_21_133203_add_username_to_users_table', 3),
(7, '2024_02_27_060431_create_tbl_mentorships_table', 4),
(8, '2024_02_27_061847_create_tbl_timings_table', 5),
(9, '2024_02_27_063241_create_tbl_timings_table', 6),
(10, '2024_03_05_104709_rename_start_time_in_tbl_timings', 7),
(11, '2024_03_05_113314_add_end_time_to_tbl_timings_table', 7),
(12, '2024_03_05_143755_create_tbl_menteeregistrations_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$uxFYrH/eCUmpGujUR6iMou/E7Zs9rUcDsO1tShqCihIhBA5TI17vi', '2024-04-15 06:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('H739r38IUH3WHP6kwuBBBkvQDy0w8psT1jBj1J9C', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1JtS3lDM2RMZlZ4V24wemdmSVk3U0hxcnVhTWd1ODFHWDRteTZ3byI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90YXNrZGF5cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1743682843);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendances`
--

DROP TABLE IF EXISTS `tbl_attendances`;
CREATE TABLE IF NOT EXISTS `tbl_attendances` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login_id` int NOT NULL,
  `punchin_long` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `punchin_lat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `punch_in` varchar(255) NOT NULL,
  `punchin_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `punch_out` varchar(255) DEFAULT NULL,
  `punch_out_image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `punchout_lat` varchar(255) DEFAULT NULL,
  `punchout_long` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `added_by` int DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attendances`
--

INSERT INTO `tbl_attendances` (`id`, `login_id`, `punchin_long`, `punchin_lat`, `punch_in`, `punchin_image`, `punch_out`, `punch_out_image`, `punchout_lat`, `punchout_long`, `date`, `added_by`, `createdAt`, `updatedAt`) VALUES
(1, 1, '3.8988093', '0.38733', '16:51:00', 'qq.jpg', '12:51:00', 'qq.jpg', '3.8988093', '0.38733', '2025-02-20', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branches`
--

DROP TABLE IF EXISTS `tbl_branches`;
CREATE TABLE IF NOT EXISTS `tbl_branches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `branch` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_branches`
--

INSERT INTO `tbl_branches` (`id`, `branch`, `createdAt`, `updatedAt`) VALUES
(1, 'Kottayam', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_business_categories`
--

DROP TABLE IF EXISTS `tbl_business_categories`;
CREATE TABLE IF NOT EXISTS `tbl_business_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `business_category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_business_categories`
--

INSERT INTO `tbl_business_categories` (`id`, `business_category_name`, `created_at`, `updated_at`) VALUES
(1, 'Consultancy', '2025-01-22 09:36:26', '2025-01-22 09:36:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chapters`
--

DROP TABLE IF EXISTS `tbl_chapters`;
CREATE TABLE IF NOT EXISTS `tbl_chapters` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_id` int NOT NULL,
  `chapter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_chapters`
--

INSERT INTO `tbl_chapters` (`id`, `city_id`, `chapter_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chapter1', '2025-01-22 09:36:35', '2025-01-22 09:36:35'),
(2, 1, 'achiever', '2025-01-24 03:56:35', '2025-01-24 03:56:35'),
(3, 1, 'best', '2025-01-24 03:56:51', '2025-01-24 03:56:51'),
(4, 2, 'achiver', '2025-01-24 04:00:14', '2025-01-24 04:00:14'),
(5, 2, 'beest', '2025-01-24 04:00:21', '2025-01-24 04:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

DROP TABLE IF EXISTS `tbl_cities`;
CREATE TABLE IF NOT EXISTS `tbl_cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_id` int NOT NULL,
  `state_id` int NOT NULL,
  `district_id` int NOT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`id`, `country_id`, `state_id`, `district_id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, 1, 12, 292, 'Akkode', '2025-01-21 04:46:19', '2025-01-21 04:49:31'),
(2, 1, 12, 795, 'Erammlloor', '2025-01-24 04:00:02', '2025-01-24 04:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

DROP TABLE IF EXISTS `tbl_countries`;
CREATE TABLE IF NOT EXISTS `tbl_countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `country` (`country_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'INDIA', '2024-08-14 11:40:52', '2024-08-19 06:44:06'),
(2, 'QATAR', '2024-08-16 06:57:41', '2024-08-16 06:57:41'),
(3, 'UAE', '2024-08-16 06:57:48', '2024-08-16 06:57:48'),
(4, 'Bahrain', '2024-08-16 06:58:01', '2024-08-16 06:58:01'),
(5, 'KUWAIT', '2024-08-16 06:58:43', '2024-08-16 06:58:43'),
(6, 'KSA', '2024-08-16 06:59:04', '2024-08-16 06:59:04'),
(7, 'OMAN', '2024-08-16 08:47:44', '2024-08-16 08:47:44'),
(8, 'SAUDI ARABIA', '2024-08-16 08:54:19', '2024-08-16 08:54:19'),
(10, 'SEYCHELLES ', '2024-09-04 10:13:56', '2024-09-04 10:13:56'),
(13, 'Uk', NULL, NULL),
(14, 'UGANDA', NULL, NULL),
(15, 'Khathar', '2025-01-21 08:08:22', '2025-01-21 08:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daily_works`
--

DROP TABLE IF EXISTS `tbl_daily_works`;
CREATE TABLE IF NOT EXISTS `tbl_daily_works` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('start','ongoing','completed','pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_date` datetime NOT NULL,
  `edited_by` int DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_daily_works`
--

INSERT INTO `tbl_daily_works` (`id`, `title`, `description`, `status`, `remark`, `created_by`, `created_date`, `edited_by`, `edited_date`, `created_at`, `updated_at`) VALUES
(1, 'Dail 1', 'sssdd', 'ongoing', 'sdddd', 1, '2025-03-17 06:43:35', 1, '2025-03-17 06:43:41', '2025-03-17 01:13:35', '2025-03-17 01:13:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

DROP TABLE IF EXISTS `tbl_departments`;
CREATE TABLE IF NOT EXISTS `tbl_departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `department` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `department` (`department`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`id`, `department`, `createdAt`, `updatedAt`) VALUES
(1, 'Accounts', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designations`
--

DROP TABLE IF EXISTS `tbl_designations`;
CREATE TABLE IF NOT EXISTS `tbl_designations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_designations`
--

INSERT INTO `tbl_designations` (`id`, `designation`, `createdAt`, `updatedAt`) VALUES
(1, 'Accountant', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_districts`
--

DROP TABLE IF EXISTS `tbl_districts`;
CREATE TABLE IF NOT EXISTS `tbl_districts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country_id` int NOT NULL,
  `state_id` int NOT NULL,
  `district_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_district_countrys` (`country_id`),
  KEY `fk_district_states` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=796 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_districts`
--

INSERT INTO `tbl_districts` (`id`, `country_id`, `state_id`, `district_name`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Anantapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 1, 'Chittoor', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 1, 'East Godavari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 1, 'Alluri Sitarama Raju', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 1, 'Anakapalli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 1, 'Annamaya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 1, 'Bapatla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 1, 'Eluru', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 1, 'Guntur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 1, 'Kadapa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 1, 'Kakinada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 1, 'Konaseema', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 1, 'Krishna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 1, 'Kurnool', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 1, 'Manyam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, 1, 'N T Rama Rao', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 1, 1, 'Nandyal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 1, 1, 'Nellore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 1, 1, 'Palnadu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, 1, 'Prakasam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, 1, 'Sri Balaji', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, 1, 'Sri Satya Sai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, 1, 'Srikakulam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, 1, 'Visakhapatnam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 1, 1, 'Vizianagaram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 1, 1, 'West Godavari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 1, 2, 'Anjaw', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 1, 2, 'Bichom', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 1, 2, 'Siang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 1, 2, 'Changlang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, 2, 'Dibang Valley', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 1, 2, 'East Kameng', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 2, 'East Siang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 1, 2, 'Kamle', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 2, 'Keyi Panyor', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 1, 2, 'Kra Daadi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 1, 2, 'Kurung Kumey', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 1, 2, 'Lepa Rada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 1, 2, 'Lohit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 1, 2, 'Longding', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 1, 2, 'Lower Dibang Valley', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 1, 2, 'Lower Siang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 1, 2, 'Lower Subansiri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, 2, 'Namsai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 1, 2, 'Pakke Kessang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 1, 2, 'Papum Pare', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 1, 2, 'Shi Yomi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 1, 2, 'Tawang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 1, 2, 'Tirap', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, 2, 'Upper Siang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 1, 2, 'Upper Subansiri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 1, 2, 'West Kameng', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 1, 2, 'West Siang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 1, 3, 'Bajali', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 1, 3, 'Baksa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 1, 3, 'Barpeta', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 1, 3, 'Biswanath', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 1, 3, 'Bongaigaon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 1, 3, 'Cachar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 1, 3, 'Charaideo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 1, 3, 'Chirang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 1, 3, 'Darrang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 1, 3, 'Dhemaji', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 1, 3, 'Dhubri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 1, 3, 'Dibrugarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 1, 3, 'Dima Hasao', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 1, 3, 'Goalpara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 1, 3, 'Golaghat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 1, 3, 'Hailakandi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 1, 3, 'Hojai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 1, 3, 'Jorhat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 1, 3, 'Kamrup Rural', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 1, 3, 'Kamrup Metropolitan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 1, 3, 'Karbi Anglong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 1, 3, 'Karimganj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 1, 3, 'Kokrajhar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 1, 3, 'Lakhimpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 1, 3, 'Majuli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 1, 3, 'Morigaon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 1, 3, 'Nagaon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 1, 3, 'Nalbari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 1, 3, 'Sivasagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 1, 3, 'Sonitpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 1, 3, 'South Salmara-Mankachar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 1, 3, 'Tamulpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 1, 3, 'Tinsukia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 1, 3, 'Udalguri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 1, 3, 'West Karbi Anglong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 1, 4, 'Araria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 1, 4, 'Arwal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 1, 4, 'Aurangabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 1, 4, 'Banka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 1, 4, 'Begusarai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 1, 4, 'Bhagalpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 1, 4, 'Bhojpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 1, 4, 'Buxar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 1, 4, 'Darbhanga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 1, 4, 'East Champaran', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 1, 4, 'Gaya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 1, 4, 'Gopalganj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 1, 4, 'Jamui', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 1, 4, 'Jehanabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 1, 4, 'Kaimur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 1, 4, 'Katihar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 1, 4, 'Khagaria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 1, 4, 'Kishanganj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 1, 4, 'Lakhisarai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 1, 4, 'Madhepura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 1, 4, 'Madhubani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 1, 4, 'Munger', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 1, 4, 'Muzaffarpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 1, 4, 'Nalanda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 1, 4, 'Nawada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 1, 4, 'Patna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 1, 4, 'Purnia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 1, 4, 'Rohtas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 1, 4, 'Saharsa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 1, 4, 'Samastipur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 1, 4, 'Saran', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 1, 4, 'Sheikhpura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 1, 4, 'Sheohar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 1, 4, 'Sitamarhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 1, 4, 'Siwan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 1, 4, 'Supaul', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 1, 4, 'Vaishali', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 1, 4, 'West Champaran', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 1, 5, 'Balod', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 1, 5, 'Baloda Bazar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 1, 5, 'Balrampur Ramanujganj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 1, 5, 'Bastar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 1, 5, 'Bemetara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 1, 5, 'Bijapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 1, 5, 'Bilaspur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 1, 5, 'Dantewada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 1, 5, 'Dhamtari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 1, 5, 'Durg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 1, 5, 'Gariaband', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 1, 5, 'Gaurela Pendra Marwahi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 1, 5, 'Janjgir Champa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 1, 5, 'Jashpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 1, 5, 'Kabirdham', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 1, 5, 'Kanker', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 1, 5, 'Khairagarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 1, 5, 'Kondagaon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 1, 5, 'Korba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 1, 5, 'Koriya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 1, 5, 'Mahasamund', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 1, 5, 'Manendragarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 1, 5, 'Mohla Manpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 1, 5, 'Mungeli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 1, 5, 'Narayanpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 1, 5, 'Raigarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 1, 5, 'Raipur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 1, 5, 'Rajnandgaon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 1, 5, 'Sakti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 1, 5, 'Sarangarh Bilaigarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 1, 5, 'Sukma', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 1, 5, 'Surajpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 1, 5, 'Surguja', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 1, 6, 'North Goa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 1, 6, 'South Goa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 1, 7, 'Ahmedabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 1, 7, 'Amreli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 1, 7, 'Anand', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 1, 7, 'Aravalli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 1, 7, 'Banaskantha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 1, 7, 'Bharuch', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 1, 7, 'Bhavnagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 1, 7, 'Botad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 1, 7, 'Chhota Udaipur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 1, 7, 'Dahod', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 1, 7, 'Dang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 1, 7, 'Devbhoomi Dwarka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 1, 7, 'Gandhinagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 1, 7, 'Gir Somnath', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 1, 7, 'Jamnagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 1, 7, 'Junagadh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 1, 7, 'Kheda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 1, 7, 'Kutch', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 1, 7, 'Mahisagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 1, 7, 'Mehsana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 1, 7, 'Morbi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 1, 7, 'Narmada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 1, 7, 'Navsari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 1, 7, 'Panchmahal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 1, 7, 'Patan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 1, 7, 'Porbandar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 1, 7, 'Rajkot', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 1, 7, 'Sabarkantha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 1, 7, 'Surat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 1, 7, 'Surendranagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 1, 7, 'Tapi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 1, 7, 'Vadodara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 1, 7, 'Valsad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 1, 8, 'Ambala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 1, 8, 'Bhiwani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 1, 8, 'Charkhi Dadri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 1, 8, 'Faridabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 1, 8, 'Fatehabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 1, 8, 'Gurugram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 1, 8, 'Hisar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 1, 8, 'Jhajjar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 1, 8, 'Jind', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 1, 8, 'Kaithal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 1, 8, 'Karnal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 1, 8, 'Kurukshetra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 1, 8, 'Mahendragarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 1, 8, 'Nuh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 1, 8, 'Palwal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 1, 8, 'Panchkula', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 1, 8, 'Panipat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 1, 8, 'Rewari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 1, 8, 'Rohtak', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 1, 8, 'Sirsa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 1, 8, 'Sonipat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 1, 8, 'Yamunanagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 1, 9, 'Bilaspur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 1, 9, 'Chamba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 1, 9, 'Hamirpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 1, 9, 'Kangra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 1, 9, 'Kinnaur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 1, 9, 'Kullu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 1, 9, 'Lahaul Spiti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 1, 9, 'Mandi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 1, 9, 'Shimla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 1, 9, 'Sirmaur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 1, 9, 'Solan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 1, 9, 'Una', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 1, 10, 'Bokaro', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 1, 10, 'Chatra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 1, 10, 'Deoghar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 1, 10, 'Dhanbad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 1, 10, 'Dumka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 1, 10, 'East Singhbhum', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 1, 10, 'Garhwa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 1, 10, 'Giridih', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 1, 10, 'Godda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 1, 10, 'Gumla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 1, 10, 'Hazaribagh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 1, 10, 'Jamtara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 1, 10, 'Khunti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 1, 10, 'Koderma', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 1, 10, 'Latehar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 1, 10, 'Lohardaga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 1, 10, 'Pakur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 1, 10, 'Palamu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(247, 1, 10, 'Ramgarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(248, 1, 10, 'Ranchi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(249, 1, 10, 'Sahebganj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(250, 1, 10, 'Seraikela Kharsawan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(251, 1, 10, 'Simdega', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(252, 1, 10, 'West Singhbhum', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(253, 1, 11, 'Bagalkot', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(254, 1, 11, 'Bangalore Rural', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(255, 1, 11, 'Bangalore Urban', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(256, 1, 11, 'Belgaum', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(257, 1, 11, 'Bellary', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(258, 1, 11, 'Bidar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(259, 1, 11, 'Chamarajanagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(260, 1, 11, 'Chikkaballapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(261, 1, 11, 'Chikkamagaluru', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(262, 1, 11, 'Chitradurga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(263, 1, 11, 'Dakshina Kannada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(264, 1, 11, 'Davanagere', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(265, 1, 11, 'Dharwad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(266, 1, 11, 'Gadag', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(267, 1, 11, 'Kalaburagi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(268, 1, 11, 'Hassan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(269, 1, 11, 'Haveri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(270, 1, 11, 'Kodagu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(271, 1, 11, 'Kolar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(272, 1, 11, 'Koppal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(273, 1, 11, 'Mandya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(274, 1, 11, 'Mysore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(275, 1, 11, 'Raichur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(276, 1, 11, 'Ramanagara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(277, 1, 11, 'Shimoga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(278, 1, 11, 'Tumkur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(279, 1, 11, 'Udupi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(280, 1, 11, 'Uttara Kannada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(281, 1, 11, 'Vijayanagara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(282, 1, 11, 'Vijayapura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(283, 1, 11, 'Yadgir', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(284, 1, 12, 'Alappuzha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(285, 1, 12, 'Ernakulam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(286, 1, 12, 'Idukki', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(287, 1, 12, 'Kannur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(288, 1, 12, 'Kasaragod', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(289, 1, 12, 'Kollam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(290, 1, 12, 'Kottayam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(291, 1, 12, 'Kozhikode', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(292, 1, 12, 'Malappuram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(293, 1, 12, 'Palakkad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(294, 1, 12, 'Pathanamthitta', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(295, 1, 12, 'Thiruvananthapuram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(296, 1, 12, 'Thrissur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(297, 1, 12, 'Wayanad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(298, 1, 13, 'Agar Malwa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(299, 1, 13, 'Alirajpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(300, 1, 13, 'Anuppur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(301, 1, 13, 'Ashoknagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(302, 1, 13, 'Balaghat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(303, 1, 13, 'Barwani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(304, 1, 13, 'Betul', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(305, 1, 13, 'Bhind', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(306, 1, 13, 'Bhopal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(307, 1, 13, 'Burhanpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(308, 1, 13, 'Chhatarpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(309, 1, 13, 'Chhindwara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(310, 1, 13, 'Damoh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(311, 1, 13, 'Datia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(312, 1, 13, 'Dewas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(313, 1, 13, 'Dhar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(314, 1, 13, 'Dindori', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(315, 1, 13, 'Guna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(316, 1, 13, 'Gwalior', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(317, 1, 13, 'Harda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(318, 1, 13, 'Hoshangabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(319, 1, 13, 'Indore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(320, 1, 13, 'Jabalpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(321, 1, 13, 'Jhabua', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(322, 1, 13, 'Katni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(323, 1, 13, 'Khandwa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(324, 1, 13, 'Khargone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(325, 1, 13, 'Maihar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(326, 1, 13, 'Mandla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(327, 1, 13, 'Mandsaur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(328, 1, 13, 'Mauganj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(329, 1, 13, 'Morena', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(330, 1, 13, 'Narsinghpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(331, 1, 13, 'Neemuch', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(332, 1, 13, 'Niwari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(333, 1, 13, 'Pandhurna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(334, 1, 13, 'Panna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(335, 1, 13, 'Raisen', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(336, 1, 13, 'Rajgarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(337, 1, 13, 'Ratlam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(338, 1, 13, 'Rewa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(339, 1, 13, 'Sagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(340, 1, 13, 'Satna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(341, 1, 13, 'Sehore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(342, 1, 13, 'Seoni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(343, 1, 13, 'Shahdol', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(344, 1, 13, 'Shajapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(345, 1, 13, 'Sheopur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(346, 1, 13, 'Shivpuri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(347, 1, 13, 'Sidhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(348, 1, 13, 'Singrauli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(349, 1, 13, 'Tikamgarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(350, 1, 13, 'Ujjain', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(351, 1, 13, 'Umaria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(352, 1, 13, 'Vidisha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(353, 1, 14, 'Ahmednagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(354, 1, 14, 'Akola', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(355, 1, 14, 'Amravati', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(356, 1, 14, 'Aurangabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(357, 1, 14, 'Beed', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(358, 1, 14, 'Bhandara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(359, 1, 14, 'Buldhana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(360, 1, 14, 'Chandrapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(361, 1, 14, 'Dhule', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(362, 1, 14, 'Gadchiroli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(363, 1, 14, 'Gondia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(364, 1, 14, 'Hingoli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(365, 1, 14, 'Jalgaon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(366, 1, 14, 'Jalna', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(367, 1, 14, 'Kolhapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(368, 1, 14, 'Latur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(369, 1, 14, 'Mumbai City', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(370, 1, 14, 'Mumbai Suburban', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(371, 1, 14, 'Nagpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(372, 1, 14, 'Nanded', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(373, 1, 14, 'Nandurbar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(374, 1, 14, 'Nashik', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(375, 1, 14, 'Osmanabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(376, 1, 14, 'Palghar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(377, 1, 14, 'Parbhani', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(378, 1, 14, 'Pune', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(379, 1, 14, 'Raigad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(380, 1, 14, 'Ratnagiri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(381, 1, 14, 'Sangli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(382, 1, 14, 'Satara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(383, 1, 14, 'Sindhudurg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(384, 1, 14, 'Solapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(385, 1, 14, 'Thane', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(386, 1, 14, 'Wardha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(387, 1, 14, 'Washim', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(388, 1, 14, 'Yavatmal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(389, 1, 15, 'Bishnupur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(390, 1, 15, 'Chandel', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(391, 1, 15, 'Churachandpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(392, 1, 15, 'Imphal East', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(393, 1, 15, 'Imphal West', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(394, 1, 15, 'Jiribam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(395, 1, 15, 'Kakching', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(396, 1, 15, 'Kamjong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(397, 1, 15, 'Kangpokpi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(398, 1, 15, 'Noney', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(399, 1, 15, 'Pherzawl', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(400, 1, 15, 'Senapati', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(401, 1, 15, 'Tamenglong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(402, 1, 15, 'Tengnoupal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(403, 1, 15, 'Thoubal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(404, 1, 15, 'Ukhrul', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(405, 1, 16, 'East Garo Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(406, 1, 16, 'East Jaintia Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(407, 1, 16, 'East Khasi Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(408, 1, 16, 'Mairang (Eastern West Khasi Hills)', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(409, 1, 16, 'North Garo Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(410, 1, 16, 'Ri Bhoi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(411, 1, 16, 'South Garo Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(412, 1, 16, 'South West Garo Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(413, 1, 16, 'South West Khasi Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(414, 1, 16, 'West Garo Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(415, 1, 16, 'West Jaintia Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(416, 1, 16, 'West Khasi Hills', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(417, 1, 17, 'Aizawl', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(418, 1, 17, 'Champhai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(419, 1, 17, 'Hnahthial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(420, 1, 17, 'Khawzawl', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(421, 1, 17, 'Kolasib', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(422, 1, 17, 'Lawngtlai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(423, 1, 17, 'Lunglei', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(424, 1, 17, 'Mamit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(425, 1, 17, 'Saiha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(426, 1, 17, 'Saitual', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(427, 1, 17, 'Serchhip', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(428, 1, 18, 'Chumukedima', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(429, 1, 18, 'Dimapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(430, 1, 18, 'Kiphire', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(431, 1, 18, 'Kohima', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(432, 1, 18, 'Longleng', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(433, 1, 18, 'Mokokchung', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(434, 1, 18, 'Mon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(435, 1, 18, 'Niuland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(436, 1, 18, 'Noklak', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(437, 1, 18, 'Peren', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(438, 1, 18, 'Phek', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(439, 1, 18, 'Shamator', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(440, 1, 18, 'Tseminyu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(441, 1, 18, 'Tuensang', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(442, 1, 18, 'Wokha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(443, 1, 18, 'Zunheboto', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(444, 1, 19, 'Angul', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(445, 1, 19, 'Balangir', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(446, 1, 19, 'Balasore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(447, 1, 19, 'Bargarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(448, 1, 19, 'Bhadrak', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(449, 1, 19, 'Boudh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(450, 1, 19, 'Cuttack', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(451, 1, 19, 'Debagarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(452, 1, 19, 'Dhenkanal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(453, 1, 19, 'Gajapati', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(454, 1, 19, 'Ganjam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(455, 1, 19, 'Jagatsinghpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(456, 1, 19, 'Jajpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(457, 1, 19, 'Jharsuguda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(458, 1, 19, 'Kalahandi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(459, 1, 19, 'Kandhamal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(460, 1, 19, 'Kendrapara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(461, 1, 19, 'Kendujhar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(462, 1, 19, 'Khordha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(463, 1, 19, 'Koraput', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(464, 1, 19, 'Malkangiri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(465, 1, 19, 'Mayurbhanj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(466, 1, 19, 'Nabarangpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(467, 1, 19, 'Nayagarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(468, 1, 19, 'Nuapada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(469, 1, 19, 'Puri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(470, 1, 19, 'Rayagada', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(471, 1, 19, 'Sambalpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(472, 1, 19, 'Subarnapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(473, 1, 19, 'Sundergarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(474, 1, 20, 'Amritsar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(475, 1, 20, 'Barnala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(476, 1, 20, 'Bathinda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(477, 1, 20, 'Faridkot', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(478, 1, 20, 'Fatehgarh Sahib', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(479, 1, 20, 'Fazilka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(480, 1, 20, 'Firozpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(481, 1, 20, 'Gurdaspur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(482, 1, 20, 'Hoshiarpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(483, 1, 20, 'Jalandhar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(484, 1, 20, 'Kapurthala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(485, 1, 20, 'Ludhiana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(486, 1, 20, 'Malerkotla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(487, 1, 20, 'Mansa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(488, 1, 20, 'Moga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(489, 1, 20, 'Mohali', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(490, 1, 20, 'Muktsar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(491, 1, 20, 'Pathankot', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(492, 1, 20, 'Patiala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(493, 1, 20, 'Rupnagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(494, 1, 20, 'Sangrur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(495, 1, 20, 'Shaheed Bhagat Singh Nagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(496, 1, 20, 'Tarn Taran', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(497, 1, 21, 'Ajmer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(498, 1, 21, 'Alwar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(499, 1, 21, 'Anupgarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(500, 1, 21, 'Balotra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(501, 1, 21, 'Banswara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(502, 1, 21, 'Baran', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(503, 1, 21, 'Barmer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(504, 1, 21, 'Beawar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(505, 1, 21, 'Bharatpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(506, 1, 21, 'Bhilwara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(507, 1, 21, 'Bikaner', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(508, 1, 21, 'Bundi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(509, 1, 21, 'Chittorgarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(510, 1, 21, 'Churu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(511, 1, 21, 'Dausa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(512, 1, 21, 'Deeg', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(513, 1, 21, 'Dholpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(514, 1, 21, 'Didwana-Kuchaman', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(515, 1, 21, 'Dudu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(516, 1, 21, 'Dungarpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(517, 1, 21, 'Gangapur City', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(518, 1, 21, 'Hanumangarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(519, 1, 21, 'Jaipur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(520, 1, 21, 'Jaipur Rural', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(521, 1, 21, 'Jaisalmer', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(522, 1, 21, 'Jalore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(523, 1, 21, 'Jhalawar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(524, 1, 21, 'Jhunjhunu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(525, 1, 21, 'Jodhpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(526, 1, 21, 'Jodhpur Rural', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(527, 1, 21, 'Karauli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(528, 1, 21, 'Kekri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(529, 1, 21, 'Khairthal?Tijara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(530, 1, 21, 'Kota', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(531, 1, 21, 'Kotputli-Behror', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(532, 1, 21, 'Nagaur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(533, 1, 21, 'Neem ka Thana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(534, 1, 21, 'Pali', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(535, 1, 21, 'Phalodi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(536, 1, 21, 'Pratapgarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(537, 1, 21, 'Rajsamand', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(538, 1, 21, 'Salumbar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(539, 1, 21, 'Sanchore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(540, 1, 21, 'Sawai Madhopur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(541, 1, 21, 'Shahpura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(542, 1, 21, 'Sikar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(543, 1, 21, 'Sirohi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(544, 1, 21, 'Sri Ganganagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(545, 1, 21, 'Tonk', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(546, 1, 21, 'Udaipur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(547, 1, 22, 'East Sikkim', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(548, 1, 22, 'North Sikkim', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(549, 1, 22, 'Pakyong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(550, 1, 22, 'Soreng', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(551, 1, 22, 'South Sikkim', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(552, 1, 22, 'West Sikkim', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(553, 1, 23, 'Ariyalur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(554, 1, 23, 'Chengalpattu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(555, 1, 23, 'Chennai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(556, 1, 23, 'Coimbatore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(557, 1, 23, 'Cuddalore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(558, 1, 23, 'Dharmapuri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(559, 1, 23, 'Dindigul', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(560, 1, 23, 'Erode', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(561, 1, 23, 'Kallakurichi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(562, 1, 23, 'Kanchipuram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(563, 1, 23, 'Kanyakumari', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(564, 1, 23, 'Karur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(565, 1, 23, 'Krishnagiri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(566, 1, 23, 'Madurai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(567, 1, 23, 'Mayiladuthurai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(568, 1, 23, 'Nagapattinam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(569, 1, 23, 'Namakkal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(570, 1, 23, 'Nilgiris', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(571, 1, 23, 'Perambalur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(572, 1, 23, 'Pudukkottai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(573, 1, 23, 'Ramanathapuram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(574, 1, 23, 'Ranipet', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(575, 1, 23, 'Salem', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(576, 1, 23, 'Sivaganga', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(577, 1, 23, 'Tenkasi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(578, 1, 23, 'Thanjavur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(579, 1, 23, 'Theni', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(580, 1, 23, 'Thoothukudi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(581, 1, 23, 'Tiruchirappalli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(582, 1, 23, 'Tirunelveli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(583, 1, 23, 'Tirupattur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(584, 1, 23, 'Tiruppur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(585, 1, 23, 'Tiruvallur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(586, 1, 23, 'Tiruvannamalai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(587, 1, 23, 'Tiruvarur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(588, 1, 23, 'Vellore', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(589, 1, 23, 'Viluppuram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(590, 1, 23, 'Virudhunagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(591, 1, 24, 'Adilabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(592, 1, 24, 'Bhadradri Kothagudem', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(593, 1, 24, 'Hyderabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(594, 1, 24, 'Jagtial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(595, 1, 24, 'Jangaon', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(596, 1, 24, 'Jayashankar Bhupalpally', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(597, 1, 24, 'Jogulamba Gadwal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(598, 1, 24, 'Kamareddy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(599, 1, 24, 'Karimnagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(600, 1, 24, 'Khammam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(601, 1, 24, 'Komaram Bheem', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(602, 1, 24, 'Mahabubabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(603, 1, 24, 'Mahbubnagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(604, 1, 24, 'Mancherial', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(605, 1, 24, 'Medak', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(606, 1, 24, 'Medchal Malkajgiri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(607, 1, 24, 'Mulugu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(608, 1, 24, 'Nagarkurnool', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(609, 1, 24, 'Nalgonda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(610, 1, 24, 'Narayanpet', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(611, 1, 24, 'Nirmal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(612, 1, 24, 'Nizamabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(613, 1, 24, 'Peddapalli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(614, 1, 24, 'Rajanna Sircilla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(615, 1, 24, 'Ranga Reddy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(616, 1, 24, 'Sangareddy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(617, 1, 24, 'Siddipet', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(618, 1, 24, 'Suryapet', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(619, 1, 24, 'Vikarabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(620, 1, 24, 'Wanaparthy', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(621, 1, 24, 'Warangal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(622, 1, 24, 'Hanamkonda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(623, 1, 24, 'Yadadri Bhuvanagiri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(624, 1, 25, 'Dhalai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(625, 1, 25, 'Gomati', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(626, 1, 25, 'Khowai', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(627, 1, 25, 'North Tripura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(628, 1, 25, 'Sepahijala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(629, 1, 25, 'South Tripura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(630, 1, 25, 'Unakoti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(631, 1, 25, 'West Tripura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(632, 1, 26, 'Agra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(633, 1, 26, 'Aligarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(634, 1, 26, 'Prayagraj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(635, 1, 26, 'Ambedkar Nagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(636, 1, 26, 'Amethi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(637, 1, 26, 'Amroha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(638, 1, 26, 'Auraiya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(639, 1, 26, 'Azamgarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(640, 1, 26, 'Baghpat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(641, 1, 26, 'Bahraich', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(642, 1, 26, 'Ballia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(643, 1, 26, 'Balrampur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(644, 1, 26, 'Banda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(645, 1, 26, 'Barabanki', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(646, 1, 26, 'Bareilly', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(647, 1, 26, 'Basti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(648, 1, 26, 'Bhadohi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(649, 1, 26, 'Bijnor', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(650, 1, 26, 'Budaun', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(651, 1, 26, 'Bulandshahr', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(652, 1, 26, 'Chandauli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(653, 1, 26, 'Chitrakoot', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(654, 1, 26, 'Deoria', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(655, 1, 26, 'Etah', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(656, 1, 26, 'Etawah', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(657, 1, 26, 'Ayodhya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(658, 1, 26, 'Farrukhabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(659, 1, 26, 'Fatehpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(660, 1, 26, 'Firozabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(661, 1, 26, 'Gautam Buddha Nagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(662, 1, 26, 'Ghaziabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(663, 1, 26, 'Ghazipur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(664, 1, 26, 'Gonda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(665, 1, 26, 'Gorakhpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(666, 1, 26, 'Hamirpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(667, 1, 26, 'Hapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(668, 1, 26, 'Hardoi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(669, 1, 26, 'Hathras', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(670, 1, 26, 'Jalaun', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(671, 1, 26, 'Jaunpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(672, 1, 26, 'Jhansi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(673, 1, 26, 'Kannauj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(674, 1, 26, 'Kanpur Dehat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(675, 1, 26, 'Kanpur Nagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(676, 1, 26, 'Kasganj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(677, 1, 26, 'Kaushambi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(678, 1, 26, 'Kheri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(679, 1, 26, 'Kushinagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(680, 1, 26, 'Lalitpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(681, 1, 26, 'Lucknow', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(682, 1, 26, 'Maharajganj', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(683, 1, 26, 'Mahoba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(684, 1, 26, 'Mainpuri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(685, 1, 26, 'Mathura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(686, 1, 26, 'Mau', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(687, 1, 26, 'Meerut', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(688, 1, 26, 'Mirzapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(689, 1, 26, 'Moradabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(690, 1, 26, 'Muzaffarnagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(691, 1, 26, 'Pilibhit', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(692, 1, 26, 'Pratapgarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(693, 1, 26, 'Raebareli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(694, 1, 26, 'Rampur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(695, 1, 26, 'Saharanpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(696, 1, 26, 'Sambhal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(697, 1, 26, 'Sant Kabir Nagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(698, 1, 26, 'Shahjahanpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(699, 1, 26, 'Shamli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(700, 1, 26, 'Shravasti', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(701, 1, 26, 'Siddharthnagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(702, 1, 26, 'Sitapur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(703, 1, 26, 'Sonbhadra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(704, 1, 26, 'Sultanpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(705, 1, 26, 'Unnao', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(706, 1, 26, 'Varanasi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(707, 1, 27, 'Almora', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(708, 1, 27, 'Bageshwar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(709, 1, 27, 'Chamoli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(710, 1, 27, 'Champawat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(711, 1, 27, 'Dehradun', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(712, 1, 27, 'Haridwar', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tbl_districts` (`id`, `country_id`, `state_id`, `district_name`, `created_at`, `updated_at`) VALUES
(713, 1, 27, 'Nainital', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(714, 1, 27, 'Pauri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(715, 1, 27, 'Pithoragarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(716, 1, 27, 'Rudraprayag', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(717, 1, 27, 'Tehri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(718, 1, 27, 'Udham Singh Nagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(719, 1, 27, 'Uttarkashi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(720, 1, 28, 'Alipurduar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(721, 1, 28, 'Bankura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(722, 1, 28, 'Birbhum', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(723, 1, 28, 'Cooch Behar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(724, 1, 28, 'Dakshin Dinajpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(725, 1, 28, 'Darjeeling', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(726, 1, 28, 'Hooghly', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(727, 1, 28, 'Howrah', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(728, 1, 28, 'Jalpaiguri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(729, 1, 28, 'Jhargram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(730, 1, 28, 'Kalimpong', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(731, 1, 28, 'Kolkata', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(732, 1, 28, 'Malda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(733, 1, 28, 'Murshidabad', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(734, 1, 28, 'Nadia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(735, 1, 28, 'North 24 Parganas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(736, 1, 28, 'Paschim Bardhaman', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(737, 1, 28, 'Paschim Medinipur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(738, 1, 28, 'Purba Bardhaman', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(739, 1, 28, 'Purba Medinipur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(740, 1, 28, 'Purulia', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(741, 1, 28, 'South 24 Parganas', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(742, 1, 28, 'Uttar Dinajpur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(743, 1, 29, 'Nicobar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(744, 1, 29, 'North Middle Andaman', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(745, 1, 29, 'South Andaman', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(746, 1, 30, 'Chandigarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(747, 1, 31, 'Dadra and Nagar Haveli', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(748, 1, 31, 'Daman', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(749, 1, 31, 'Diu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(750, 1, 32, 'Central Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(751, 1, 32, 'East Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(752, 1, 32, 'New Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(753, 1, 32, 'North Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(754, 1, 32, 'North East Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(755, 1, 32, 'North West Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(756, 1, 32, 'Shahdara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(757, 1, 32, 'South Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(758, 1, 32, 'South East Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(759, 1, 32, 'South West Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(760, 1, 32, 'West Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(761, 1, 33, 'Anantnag', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(762, 1, 33, 'Bandipora', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(763, 1, 33, 'Baramulla', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(764, 1, 33, 'Budgam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(765, 1, 33, 'Doda', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(766, 1, 33, 'Ganderbal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(767, 1, 33, 'Jammu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(768, 1, 33, 'Kathua', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(769, 1, 33, 'Kishtwar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(770, 1, 33, 'Kulgam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(771, 1, 33, 'Kupwara', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(772, 1, 33, 'Poonch', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(773, 1, 33, 'Pulwama', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(774, 1, 33, 'Rajouri', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(775, 1, 33, 'Ramban', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(776, 1, 33, 'Reasi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(777, 1, 33, 'Samba', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(778, 1, 33, 'Shopian', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(779, 1, 33, 'Srinagar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(780, 1, 33, 'Udhampur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(781, 1, 34, 'Lakshadweep', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(782, 1, 35, 'Kargil', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(783, 1, 35, 'Leh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(784, 1, 36, 'Karaikal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(785, 1, 36, 'Mahe', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(786, 1, 36, 'Puducherry', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(787, 1, 36, 'Yanam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(788, 1, 14, 'Mumbai', '2024-09-04 05:43:07', '2024-09-04 05:43:07'),
(789, 1, 33, 'Baramula', '2024-09-04 07:07:19', '2024-09-04 07:07:19'),
(790, 1, 1, 'NIZAMABAD', '2024-09-04 10:20:32', '2024-09-04 10:20:32'),
(791, 1, 12, 'Thrichur', '2024-09-04 11:02:34', '2024-09-04 11:02:34'),
(792, 2, 38, 'testt didt', NULL, NULL),
(793, 1, 14, 'SOLAPUR', NULL, NULL),
(794, 1, 26, 'RAMPUR', NULL, NULL),
(795, 1, 12, 'Alapuzha', '2025-01-21 08:10:05', '2025-01-21 08:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enquiry_types`
--

DROP TABLE IF EXISTS `tbl_enquiry_types`;
CREATE TABLE IF NOT EXISTS `tbl_enquiry_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `enquiry_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_memberships`
--

DROP TABLE IF EXISTS `tbl_memberships`;
CREATE TABLE IF NOT EXISTS `tbl_memberships` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `business_category_id` int NOT NULL,
  `firm_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int NOT NULL,
  `chapter_id` int NOT NULL,
  `membership_type_id` int DEFAULT NULL,
  `join_date` date NOT NULL,
  `added_by` int NOT NULL,
  `added_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_memberships`
--

INSERT INTO `tbl_memberships` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `phone_number`, `address`, `business_category_id`, `firm_name`, `city_id`, `chapter_id`, `membership_type_id`, `join_date`, `added_by`, `added_date`, `created_at`, `updated_at`) VALUES
(1, 'new', 'sdd', 'entry', 'newentry@gmail.com', '9867239849', 'new entry', 1, 'aa', 1, 1, 1, '2025-01-13', 1, '2025-01-22', '2025-01-22 09:38:02', '2025-01-24 04:05:36'),
(2, 'new1', 'Abdul', 'entry', 'newentry0983@gmail.com', '986678888', 'new entry', 1, 'aa', 1, 1, 1, '2025-03-25', 1, '2025-03-11', '2025-03-11 12:51:40', '2025-03-11 12:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_membership_types`
--

DROP TABLE IF EXISTS `tbl_membership_types`;
CREATE TABLE IF NOT EXISTS `tbl_membership_types` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `membership_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_membership_types`
--

INSERT INTO `tbl_membership_types` (`id`, `membership_type`, `created_at`, `updated_at`) VALUES
(1, 'Premium', '2025-01-22 09:36:54', '2025-01-22 09:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mw_mytasks`
--

DROP TABLE IF EXISTS `tbl_mw_mytasks`;
CREATE TABLE IF NOT EXISTS `tbl_mw_mytasks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `task_id` int NOT NULL,
  `task_status_id` int NOT NULL,
  `task_status_date` datetime NOT NULL,
  `worktime_id` int NOT NULL,
  `user_id` int NOT NULL,
  `addedby` int NOT NULL,
  `added_date` datetime NOT NULL,
  `editedby` int DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_mw_mytasks`
--

INSERT INTO `tbl_mw_mytasks` (`id`, `task_id`, `task_status_id`, `task_status_date`, `worktime_id`, `user_id`, `addedby`, `added_date`, `editedby`, `edited_date`, `created_at`, `updated_at`) VALUES
(16, 2, 2, '2025-02-26 11:30:45', 12, 1, 22, '2025-03-10 17:00:02', 2, '2025-03-16 17:29:08', '2025-03-10 11:30:02', '2025-03-16 11:59:08'),
(17, 4, 4, '2025-02-26 11:31:16', 12, 1, 22, '2025-03-10 17:03:24', 2, '2025-03-16 17:29:18', '2025-03-10 11:33:24', '2025-03-16 11:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mw_mytask_trans`
--

DROP TABLE IF EXISTS `tbl_mw_mytask_trans`;
CREATE TABLE IF NOT EXISTS `tbl_mw_mytask_trans` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `mytask_id` int NOT NULL,
  `worktime_id` int NOT NULL,
  `task_date` datetime NOT NULL,
  `chapter_id` int NOT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sub_task_status_id` int DEFAULT NULL,
  `addedby` int NOT NULL,
  `added_date` datetime NOT NULL,
  `editedby` int DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_mw_mytask_trans`
--

INSERT INTO `tbl_mw_mytask_trans` (`id`, `mytask_id`, `worktime_id`, `task_date`, `chapter_id`, `remarks`, `sub_task_status_id`, `addedby`, `added_date`, `editedby`, `edited_date`, `created_at`, `updated_at`) VALUES
(1, 14, 12, '2025-02-26 02:57:29', 5, 'mnmn', NULL, 18, '2025-02-28 09:17:52', NULL, NULL, '2025-02-28 03:47:52', '2025-02-28 03:47:52'),
(2, 15, 12, '2025-02-27 14:23:36', 7, 'dtghf', NULL, 18, '2025-02-28 09:24:27', NULL, NULL, '2025-02-28 03:54:27', '2025-02-28 03:54:27'),
(4, 17, 1, '2025-02-27 15:03:11', 6, 'bj', NULL, 23, '2025-03-11 05:12:34', NULL, NULL, '2025-03-10 23:42:34', '2025-03-10 23:42:34'),
(5, 16, 1, '2025-02-27 14:23:36', 2, 'b', NULL, 1, '2025-03-11 17:32:15', NULL, NULL, '2025-03-11 12:02:15', '2025-03-11 12:02:15'),
(6, 17, 1, '2025-03-11 00:00:00', 2, 'sds', NULL, 1, '2025-03-11 18:25:08', NULL, NULL, '2025-03-11 12:55:08', '2025-03-11 12:55:08'),
(7, 17, 12, '2025-03-11 00:00:00', 3, 'xfdf', NULL, 1, '2025-03-11 18:30:10', NULL, NULL, '2025-03-11 13:00:10', '2025-03-11 13:00:10'),
(8, 17, 13, '2025-03-11 00:00:00', 1, 'ad', NULL, 1, '2025-03-11 18:31:00', NULL, NULL, '2025-03-11 13:01:00', '2025-03-11 13:01:00'),
(9, 17, 12, '2025-03-11 00:00:00', 2, 'iughu', NULL, 1, '2025-03-11 18:34:02', NULL, NULL, '2025-03-11 13:04:02', '2025-03-11 13:04:02'),
(10, 17, 13, '2025-03-11 00:00:00', 2, 'jbkj', NULL, 1, '2025-03-11 18:34:21', NULL, NULL, '2025-03-11 13:04:21', '2025-03-11 13:04:21'),
(11, 17, 12, '2025-03-11 00:00:00', 1, 'jh', 3, 1, '2025-03-11 18:37:13', NULL, NULL, '2025-03-11 13:07:13', '2025-03-11 13:07:13'),
(12, 16, 12, '2025-03-12 00:00:00', 1, 'gvyh', 2, 1, '2025-03-12 05:16:20', NULL, NULL, '2025-03-11 23:46:20', '2025-03-11 23:46:20'),
(13, 16, 12, '2025-03-12 00:00:00', 3, 'sdx', 2, 1, '2025-03-12 05:17:28', NULL, NULL, '2025-03-11 23:47:28', '2025-03-11 23:47:28'),
(14, 16, 12, '2025-03-12 00:00:00', 2, 'gvbg', 3, 1, '2025-03-12 05:17:56', NULL, NULL, '2025-03-11 23:47:56', '2025-03-11 23:47:56'),
(15, 16, 12, '2025-03-12 00:00:00', 4, 'jj', 4, 1, '2025-03-12 05:20:01', NULL, NULL, '2025-03-11 23:50:01', '2025-03-11 23:50:01'),
(16, 16, 12, '2025-03-12 00:00:00', 2, 'sss', 2, 1, '2025-03-12 05:23:01', NULL, NULL, '2025-03-11 23:53:01', '2025-03-11 23:53:01'),
(17, 16, 12, '2025-03-12 00:00:00', 3, 'hgh', 2, 1, '2025-03-12 05:24:41', NULL, NULL, '2025-03-11 23:54:41', '2025-03-11 23:54:41'),
(18, 16, 12, '2025-03-12 00:00:00', 2, 'ssdd', 3, 1, '2025-03-12 05:25:32', NULL, NULL, '2025-03-11 23:55:32', '2025-03-11 23:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mw_statuses`
--

DROP TABLE IF EXISTS `tbl_mw_statuses`;
CREATE TABLE IF NOT EXISTS `tbl_mw_statuses` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addedby` int NOT NULL,
  `added_date` datetime NOT NULL,
  `editedby` int DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_mw_statuses`
--

INSERT INTO `tbl_mw_statuses` (`id`, `status`, `addedby`, `added_date`, `editedby`, `edited_date`, `created_at`, `updated_at`) VALUES
(1, 'Start', 12, '2025-02-26 11:30:22', 1, '2025-03-11 05:01:50', '2025-02-26 06:00:22', '2025-03-10 23:31:50'),
(2, 'Pending', 12, '2025-02-26 11:30:45', 1, '2025-03-11 05:22:14', '2025-02-26 06:00:45', '2025-03-10 23:52:14'),
(3, 'Completed', 12, '2025-02-26 11:31:03', NULL, NULL, '2025-02-26 06:01:03', '2025-02-26 06:01:03'),
(4, 'No Need', 12, '2025-02-26 11:31:16', NULL, NULL, '2025-02-26 06:01:16', '2025-02-26 06:01:16'),
(6, 'Postponded', 1, '2025-03-11 05:22:27', NULL, NULL, '2025-03-10 23:52:27', '2025-03-10 23:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mw_tasks`
--

DROP TABLE IF EXISTS `tbl_mw_tasks`;
CREATE TABLE IF NOT EXISTS `tbl_mw_tasks` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `task` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dep_id` int NOT NULL,
  `user_id` int NOT NULL,
  `worktime_id` int NOT NULL,
  `addedby` int NOT NULL,
  `added_date` datetime NOT NULL,
  `editedby` int DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_mw_tasks`
--

INSERT INTO `tbl_mw_tasks` (`id`, `task`, `dep_id`, `user_id`, `worktime_id`, `addedby`, `added_date`, `editedby`, `edited_date`, `created_at`, `updated_at`) VALUES
(1, 'task 11jdjdkd', 1, 1, 12, 1, '2025-03-17 06:44:47', NULL, NULL, '2025-03-17 01:14:47', '2025-03-17 01:14:47'),
(2, 'task2', 1, 1, 1, 1, '2025-03-17 07:01:34', NULL, NULL, '2025-03-17 01:31:34', '2025-03-17 01:31:34'),
(3, 'task2', 1, 1, 1, 1, '2025-03-17 07:02:00', NULL, NULL, '2025-03-17 01:32:00', '2025-03-17 01:32:00'),
(4, 'ssss', 1, 2, 1, 1, '2025-03-17 07:29:15', 1, '2025-03-17 07:33:50', '2025-03-17 01:59:15', '2025-03-17 02:03:50'),
(5, 'asfsf', 1, 2, 12, 1, '2025-03-17 07:38:24', 1, '2025-03-17 07:38:30', '2025-03-17 02:08:24', '2025-03-17 02:08:30'),
(6, 'Watch unified timetable Calendar and intimate to all the concerned (item no. 7 CG’s HT offline meetings)\r\n- Daily', 1, 2, 12, 1, '2025-03-19 08:47:56', NULL, NULL, '2025-03-19 03:17:56', '2025-03-19 03:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mw_task_days`
--

DROP TABLE IF EXISTS `tbl_mw_task_days`;
CREATE TABLE IF NOT EXISTS `tbl_mw_task_days` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `task_id` int NOT NULL,
  `worktime_id` int NOT NULL,
  `added_by` int NOT NULL,
  `added_date` datetime NOT NULL,
  `edited_by` int DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mw_worktimes`
--

DROP TABLE IF EXISTS `tbl_mw_worktimes`;
CREATE TABLE IF NOT EXISTS `tbl_mw_worktimes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `worktime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `addedby` int NOT NULL,
  `added_date` datetime NOT NULL,
  `editedby` int DEFAULT NULL,
  `edited_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_mw_worktimes`
--

INSERT INTO `tbl_mw_worktimes` (`id`, `worktime`, `addedby`, `added_date`, `editedby`, `edited_date`, `created_at`, `updated_at`) VALUES
(1, '12', 8, '2025-02-25 10:31:12', 8, '2025-02-25 10:47:23', '2025-02-25 05:01:12', '2025-02-25 05:17:23'),
(12, '17th', 11, '2025-02-26 02:55:06', NULL, NULL, '2025-02-25 21:25:06', '2025-02-25 21:25:06'),
(13, '13', 1, '2025-03-11 05:16:19', 1, '2025-03-11 05:16:24', '2025-03-10 23:46:19', '2025-03-10 23:46:24'),
(14, '14', 2, '2025-03-16 17:24:09', 2, '2025-03-16 17:24:16', '2025-03-16 11:54:09', '2025-03-16 11:54:16'),
(15, '13tyuu', 1, '2025-03-17 07:39:03', 1, '2025-03-17 07:39:08', '2025-03-17 02:09:03', '2025-03-17 02:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`id`, `role`, `createdAt`, `updatedAt`) VALUES
(1, 'Superadmin', NULL, NULL),
(2, 'Admin', '2024-07-18 10:16:12', '2024-07-18 10:16:12'),
(3, 'Staff', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staffs`
--

DROP TABLE IF EXISTS `tbl_staffs`;
CREATE TABLE IF NOT EXISTS `tbl_staffs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `Join_date` date DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `country_id` int DEFAULT NULL,
  `address` text,
  `branch_id` int NOT NULL,
  `dept_id` int DEFAULT NULL,
  `design_id` int DEFAULT NULL,
  `mobile_number` bigint NOT NULL,
  `created_date` date NOT NULL,
  `added_by` int NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staff_user` (`user_id`),
  KEY `fk_staff_branch` (`branch_id`),
  KEY `fk_staff_country` (`country_id`),
  KEY `fk_staff_designation` (`design_id`),
  KEY `fk_staff_department` (`dept_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_staffs`
--

INSERT INTO `tbl_staffs` (`id`, `user_id`, `Join_date`, `birth_date`, `country_id`, `address`, `branch_id`, `dept_id`, `design_id`, `mobile_number`, `created_date`, `added_by`, `profile_image`, `createdAt`, `updatedAt`) VALUES
(1, 2, '2025-01-30', NULL, NULL, 'new entry\r\nnew entry', 1, 1, 1, 9867239849, '2025-01-30', 1, 'nil', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_states`
--

DROP TABLE IF EXISTS `tbl_states`;
CREATE TABLE IF NOT EXISTS `tbl_states` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country_id` int NOT NULL,
  `state_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_state_country` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_states`
--

INSERT INTO `tbl_states` (`id`, `country_id`, `state_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Andhra Pradesh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 'Arunachal Pradesh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 'Assam', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 'Bihar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 'Chhattisgarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 'Goa', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 'Gujarat', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 'Haryana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 'Himachal Pradesh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 'Jharkhand', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 'Karnataka', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 'Kerala', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 'Madhya Pradesh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 'Maharashtra', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 'Manipur', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, 'Meghalaya', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 1, 'Mizoram', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 1, 'Nagaland', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 1, 'Odisha', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, 'Punjab', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, 'Rajasthan', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, 'Sikkim', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, 'Tamil Nadu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, 'Telangana', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 1, 'Tripura', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 1, 'Uttar Pradesh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 1, 'Uttarakhand', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 1, 'West Bengal', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 1, 'Andaman and Nicobar', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 1, 'Chandigarh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, 'Dadra and Nagar Haveli and Daman and Diu', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 1, 'Delhi', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 'Jammu and Kashmir', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 1, 'Lakshadweep', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 'Ladakh', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 1, 'Puducherry', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 2, 'test', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int NOT NULL,
  `chapter_id` int DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_name` (`user_name`),
  KEY `fk_user_role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `password`, `role_id`, `chapter_id`, `createdAt`, `updatedAt`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '$2y$12$IkvcQhmClT605VGYas9RReHj214O0g7cXU3DIrlFukjjJGZxzFqfu', 1, NULL, '2024-07-17 23:51:55', '2024-07-17 23:51:55'),
(2, 'test', 'test user', 'testuser@gmail.com', '$2y$12$WWAzO6gYSd1DnHdlYxbKVOjX3PUSHJfOMdzKNMophwt4nVN8yT./2', 3, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_districts`
--
ALTER TABLE `tbl_districts`
  ADD CONSTRAINT `fk_district_countrys` FOREIGN KEY (`country_id`) REFERENCES `tbl_countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_district_states` FOREIGN KEY (`state_id`) REFERENCES `tbl_states` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_staffs`
--
ALTER TABLE `tbl_staffs`
  ADD CONSTRAINT `fk_staff_branch` FOREIGN KEY (`branch_id`) REFERENCES `tbl_branches` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_staff_country` FOREIGN KEY (`country_id`) REFERENCES `tbl_countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_staff_department` FOREIGN KEY (`dept_id`) REFERENCES `tbl_departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_staff_designation` FOREIGN KEY (`design_id`) REFERENCES `tbl_designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_staff_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_states`
--
ALTER TABLE `tbl_states`
  ADD CONSTRAINT `fk_state_country` FOREIGN KEY (`country_id`) REFERENCES `tbl_countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `tbl_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
