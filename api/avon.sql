-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2020 at 05:17 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-30+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avon`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_subject`
--

CREATE TABLE `assign_subject` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cc_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `cc_id`, `title`, `description`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'Ceat News', 'Test Desc', 1, NULL, NULL),
(2, 3, 'Mrf News', 'Test Mrf Desc', 2, NULL, NULL),
(3, 1, 'Apollo News', 'Test Apollo Desc', 3, NULL, NULL),
(5, 1, 'Apollo second   News', 'Test Apollo Desc', 3, NULL, NULL),
(6, 3, 'Mrf  second News', 'Test Mrf Second Desc', 2, NULL, NULL),
(7, 2, 'Ceat second News', 'Test Desc', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_tag`
--

CREATE TABLE `blog_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_tag`
--

INSERT INTO `blog_tag` (`id`, `blog_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 2, 1, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 2, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `c_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `c_id`, `name`, `email_id`, `phone_no`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 3, 'Ceat', 'ceat@gmail.com', '7800980098', 1, NULL, NULL),
(2, 1, 'Mrf', 'mrf@gmail.com', '7700909088', 5, NULL, NULL),
(3, 2, 'Apollo', 'apollo@gmail.com', '9089877878', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Switzerland', '2020-10-13 16:42:05', '0000-00-00 00:00:00'),
(2, 'Canada', '2020-10-13 16:42:05', '0000-00-00 00:00:00'),
(3, 'Japan', '2020-10-13 16:42:15', '0000-00-00 00:00:00'),
(4, 'Germany', '2020-10-13 16:42:15', '0000-00-00 00:00:00'),
(5, 'India', '2020-10-13 16:42:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` bigint(20) NOT NULL,
  `imageable_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(1, 'profile.png', 1, 'App\\Models\\Client ', NULL, NULL),
(2, 'banner.png', 2, 'App\\Models\\Blog', NULL, NULL),
(3, 'profile-2.png', 1, 'App\\Models\\Client ', NULL, NULL),
(4, 'banner-2.png', 2, 'App\\Models\\Blog', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '2020_10_08_074029_create_testing_2', 2),
(89, '2014_10_12_000000_create_users_table', 3),
(90, '2014_10_12_100000_create_password_resets_table', 3),
(91, '2019_08_19_000000_create_failed_jobs_table', 3),
(92, '2020_10_08_075001_create_testing', 3),
(93, '2020_10_08_075055_create_testing2', 3),
(94, '2020_10_08_075317_create_testing3', 3),
(95, '2020_10_13_054335_create_clients_table', 3),
(96, '2020_10_13_054554_create_blogs_table', 3),
(97, '2020_10_13_092013_create_tags_table', 4),
(99, '2020_10_13_093747_create_blog_tag', 5),
(100, '2020_10_16_101530_create_images_table', 6),
(101, '2020_10_17_032943_create_videos_table', 7),
(102, '2020_10_17_033044_create_taggables', 7),
(103, '2020_10_17_105917_create_tasks_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email_id`, `phone_no`, `created_at`) VALUES
(1, 'Demosss', 'demo@gmail.com', '7800089000', '2020-09-06 11:43:24'),
(4, 'Ramesh', 'ramesh@gmail.com', '780987656', '2020-09-06 11:44:17'),
(5, 'Vishnu', 'vishnu@gmail.com', '780987651', '2020-09-06 11:44:17'),
(6, 'testssss', 'test@gmail.com', '4356656545', '2020-09-06 13:18:38'),
(7, 'Vishu', 'vishu@gmail.com', '8989898989', '2020-09-13 16:02:16'),
(8, 'Ram', 'ram@gmail.com', '7890987890', '2020-09-13 16:02:33'),
(9, 'Kapil', 'kapil@gmail.com', '6780909431', '2020-09-13 16:03:05'),
(14, 'testdata', 'testdata@gmail.com', '9090876789', '2020-10-08 08:17:11'),
(15, 'testdata', 'testdata@gmail.com', '9090876789', '2020-10-08 08:17:21'),
(18, 'mtest', 'mtest@gmail.com', 'mtest@gmail.com', '2020-10-12 00:52:12'),
(19, 'mtest', 'mtest@gmail.com', '9809878900', '2020-10-12 00:52:38'),
(20, 'mtest', 'mtest@gmail.com', '+919809878900', '2020-10-12 00:53:31'),
(21, 'mtest  Singh', 'mtest@gmail.com', '+919809878900', '2020-10-12 00:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `code`, `created_at`) VALUES
(1, 'Math', 'D12', '2020-10-11 07:39:11'),
(2, 'Science', 'B19', '2020-10-11 07:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `tagblog`
--

CREATE TABLE `tagblog` (
  `id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagblog`
--

INSERT INTO `tagblog` (`id`, `b_id`, `t_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-10-13 09:51:31', '0000-00-00 00:00:00'),
(2, 1, 2, '2020-10-13 09:51:31', '0000-00-00 00:00:00'),
(3, 2, 2, '2020-10-13 09:51:31', '0000-00-00 00:00:00'),
(4, 2, 3, '2020-10-13 09:51:31', '0000-00-00 00:00:00'),
(5, 2, 1, '2020-10-13 09:51:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_id` bigint(20) NOT NULL,
  `taggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taggables`
--

INSERT INTO `taggables` (`tag_id`, `taggable_id`, `taggable_type`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\Models\\Blog', NULL, NULL),
(2, 2, 'App\\Models\\Video', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Latest', NULL, NULL),
(2, 'Popular', NULL, NULL),
(3, 'Oldest', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `email_id`, `phone_no`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', 'ss@gmail.com', '4356656546', NULL, '2020-10-19 06:50:49', '2020-10-21 10:28:11', NULL),
(9, 'test new', 'testnew@gmail.com', '7890987682', NULL, '2020-10-20 00:14:43', '2020-10-21 10:27:45', NULL),
(10, 'Sample', 'sample@gmail.com', '8989898989', NULL, '2020-10-20 10:23:00', '2020-10-21 10:27:57', NULL),
(11, 'Code', 'code@gmail.com', '6700009000', NULL, '2020-10-20 10:23:00', '2020-10-20 10:23:00', NULL),
(12, 'Improve', 'improve@gmail.com', '8999099990', NULL, '2020-10-20 10:23:00', '2020-10-20 10:23:00', NULL),
(13, 'Testing', 'testing@gmail.com', '7800091221', NULL, '2020-10-20 10:23:00', '2020-10-20 10:23:00', NULL),
(14, 'Testing again', 'testing2@gmail.com', '9800091221', NULL, '2020-10-20 10:23:00', '2020-10-20 10:23:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE `testing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testing2`
--

CREATE TABLE `testing2` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testing3`
--

CREATE TABLE `testing3` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `admission_no` varchar(50) NOT NULL,
  `phone_no` varchar(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `name`, `email_id`, `admission_no`, `phone_no`, `created_at`, `updated_at`) VALUES
(1, 'Code Improve', 'code@gmail.com', 'ADMIN', '9090909099', '2020-07-14 17:21:27', NULL),
(2, 'Arun', 'arun@gmail.com', 'CD001', '9190909876', '2020-07-14 17:21:27', NULL),
(3, 'Bhanu', 'bhanu@gmail.com', 'CD002', '9190909090', '2020-07-14 17:21:27', NULL),
(4, 'Bharti', 'bharti@gmail.com', 'CD003', '9898989898', '2020-07-14 17:21:27', NULL),
(5, 'Cherry', 'cherry@gmail.com', 'CD004', '7898757547', '2020-07-14 17:21:27', NULL),
(6, 'Dinesh', 'dinesh@gmail.com', 'CD005', '7808757090', '2020-07-14 17:21:27', NULL),
(7, 'Farahn', 'farahn@gmail.com', 'CD061', '9898757654', '2020-07-14 17:21:27', NULL),
(8, 'Geetika', 'geetika@gmail.com', 'CD062', '7898757666', '2020-07-14 17:21:27', NULL),
(9, 'Mahesh', 'mahesh@gmail.com', 'CD065', '7898757500', '2020-07-14 17:21:27', NULL),
(11, 'Raman', 'raman@gmail.com', 'CD070', '6700098009', '2020-07-14 17:21:27', NULL),
(12, 'Tails', 'tails@gmail.com', 'CD070', '6799098009', '2020-07-14 17:21:27', NULL),
(13, 'Vishnu', 'vishnu@gmail.com', 'CD077', '8900012541', '2020-07-14 17:21:27', NULL),
(21, 'jerrry', 'jerrry@gmail.com', 'J112122', '7800098009', '2020-08-24 07:49:56', NULL),
(22, 'jerrry', 'jerrry@gmail.com', 'J112122', '7800098009', '2020-08-24 07:50:16', NULL),
(23, 'Vishnu22', 'vishnu121@gmail.com', 'J112122', '7800098009', '2020-08-24 07:51:15', NULL),
(26, 'eee', '', '', '', '2020-08-24 23:47:06', '2020-08-24 23:47:06'),
(27, 'ssss', 'sss@gmail.com', '', '', '2020-08-25 00:03:05', '2020-08-25 00:03:05'),
(53, 'code', 'codeImprove0@example.com', '111', '8909890989', '2020-10-06 07:06:57', NULL),
(54, 'code', 'codeImprove20@example.com', '111', '8909890989', '2020-10-06 07:07:38', NULL),
(56, 'demo last', 'demo@example.com', '111', '8909890989', '2020-10-06 07:08:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id` int(11) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` enum('ADMIN','USER') NOT NULL DEFAULT 'USER',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id`, `email_id`, `user_id`, `password`, `user_type`, `status`, `created_at`) VALUES
(1, 'code@gmail.com', 1, '6ad14ba9986e3615423dfca256d04e3f', 'ADMIN', 'active', '2020-07-14 17:20:37'),
(2, 'arun@gmail.com', 2, '9190909090', 'USER', 'active', '2020-07-14 17:31:29'),
(3, 'bhanu@gmail.com', 3, '9190909090', 'USER', 'active', '2020-07-14 17:31:29'),
(4, 'bharti@gmail.com', 4, '9898989898', 'USER', 'active', '2020-07-14 17:31:29'),
(5, 'cherry@gmail.com', 5, '7898757547', 'USER', 'active', '2020-07-14 17:31:29'),
(6, 'dinesh@gmail.com', 6, '7808757090', 'USER', 'active', '2020-07-14 17:31:29'),
(7, 'farahn@gmail.com', 7, '9898757654', 'USER', 'active', '2020-07-14 17:31:29'),
(8, 'geetika@gmail.com', 8, '7898757666', 'USER', 'active', '2020-07-14 17:31:29'),
(9, 'mahesh@gmail.com', 9, '7898757500', 'USER', 'active', '2020-07-14 17:31:29'),
(10, 'nitin@gmail.com', 10, '9898757502', 'USER', 'active', '2020-07-14 17:31:29'),
(11, 'raman@gmail.com', 11, '6700098009', 'USER', 'active', '2020-07-14 17:31:29'),
(12, 'taail@gmail.com', 12, '6799098009', 'USER', 'active', '2020-07-14 17:31:29'),
(13, 'vishnu@gmail.com', 13, '8900012541', 'USER', 'active', '2020-07-14 17:31:29'),
(17, 'user@gmail.com', 14, '6ad14ba9986e3615423dfca256d04e3f', 'USER', 'active', '2020-07-14 17:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'first-video.mp4', NULL, NULL),
(2, 'second-video.mp4', NULL, NULL),
(3, 'third-video.mp4', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_subject`
--
ALTER TABLE `assign_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_tag`
--
ALTER TABLE `blog_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tagblog`
--
ALTER TABLE `tagblog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testing2`
--
ALTER TABLE `testing2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testing3`
--
ALTER TABLE `testing3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_subject`
--
ALTER TABLE `assign_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `blog_tag`
--
ALTER TABLE `blog_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tagblog`
--
ALTER TABLE `tagblog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `taggables`
--
ALTER TABLE `taggables`
  MODIFY `tag_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `testing2`
--
ALTER TABLE `testing2`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `testing3`
--
ALTER TABLE `testing3`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
