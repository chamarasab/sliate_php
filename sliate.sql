-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 14, 2022 at 11:28 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sliate`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(3) NOT NULL,
  `fee` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`code`, `name`, `duration`, `fee`, `created_at`, `updated_at`) VALUES
('HNDIT-2022-F', 'HNDIT (Full time)', 24, 150000.00, '2022-10-14 12:21:44', '2022-10-14 12:21:44'),
('HNDIT-2022-PT', 'HNDIT (Part time)', 24, 150000.00, '2022-10-14 13:09:17', '2022-10-14 13:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `task`, `course_code`, `created_at`, `updated_at`) VALUES
(1, 'Exercise 1', '<p><strong>Exercise 01</strong></p>\r\n\r\n<p><strong>1.&nbsp;</strong>Create a new webpage using <em>html </em>and <em>css </em>and display your name.</p>\r\n', 'HNDIT-2022-PT', '2022-10-14 13:11:06', '2022-10-14 13:11:06'),
(2, 'Assignment', '<p><strong>Assignment 01&nbsp;</strong></p>\r\n\r\n<p>1. Create new <u>html </u>web page and display your <em>School name.</em></p>\r\n', 'HNDIT-2022-F', '2022-10-14 13:13:55', '2022-10-14 13:13:55'),
(3, 'Assignment 2', '<p><strong>Assignment 2&nbsp;</strong></p>\r\n\r\n<p>Create simple one page website for your school.</p>\r\n\r\n<p><strong>1</strong>. You should include Internal, External, Inline CSS</p>\r\n\r\n<p><strong>2. </strong>Don&#39;t use&nbsp;bootstrap templates.</p>\r\n', 'HNDIT-2022-PT', '2022-10-14 15:47:14', '2022-10-14 15:47:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reg_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'student' COMMENT 'admin,student',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `address`, `gender`, `image`, `reg_no`, `dob`, `role`, `status`, `password`, `course_code`, `created_at`, `updated_at`) VALUES
(1, 'Chamara', 'chamara@sliate.lk', '7612345678', 'Kurunegala', 'Male', NULL, NULL, '1995-06-07', 'admin', 1, '93ddaff69570e77812f78008db95f065', NULL, '2022-10-14 12:57:27', '2022-10-14 12:59:27'),
(2, 'Malan', 'malan@sliate.lk', '7612345678', 'Melsiripura', 'Male', NULL, 'HNDIT2022F2', '1995-10-12', 'student', 1, '827ccb0eea8a706c4c34a16891f84e7b', 'HNDIT-2022-F', '2022-10-14 13:16:52', '2022-10-14 13:20:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
