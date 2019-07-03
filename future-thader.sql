-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2019 at 06:26 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `future-thader`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'اوامر الشبكة', '2019-06-21 11:33:09', '2019-06-21 11:33:09');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_06_26_110013_create_roles_table', 1),
(4, '2018_06_26_110120_create_permissions_table', 1),
(5, '2018_07_01_104552_create_reports_table', 1),
(6, '2018_07_01_123905_create_app_seetings_table', 1),
(7, '2018_07_02_074616_create_socials_table', 1),
(8, '2019_06_29_083607_create_supervisor_employees_table', 2);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `permissions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permissions`, `role_id`, `created_at`, `updated_at`) VALUES
(60, 'dashboard', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(61, 'permissionslist', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(62, 'addpermissionspage', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(63, 'addpermission', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(64, 'editpermissionpage', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(65, 'updatepermission', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(66, 'deletepermission', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(67, 'admins', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(68, 'addadmin', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(69, 'updateadmin', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(70, 'deleteadmin', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(71, 'deleteadmins', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(72, 'users', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(73, 'adduser', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(74, 'updateuser', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(75, 'deleteuser', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(76, 'deleteusers', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(77, 'send-fcm', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(78, 'allreports', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(79, 'deletereports', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(80, 'settings', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(81, 'sitesetting', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(82, 'about', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(83, 'add-social', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(84, 'update-social', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(85, 'delete-social', 2, '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(86, 'dashboard', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(87, 'permissionslist', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(88, 'addpermissionspage', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(89, 'addpermission', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(90, 'editpermissionpage', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(91, 'updatepermission', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(92, 'deletepermission', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(93, 'admins', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(94, 'addadmin', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(95, 'updateadmin', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(96, 'deleteadmin', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(97, 'deleteadmins', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(98, 'users', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(99, 'adduser', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(100, 'updateuser', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(101, 'deleteuser', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(102, 'deleteusers', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(103, 'send-fcm', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(104, 'allreports', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(105, 'deletereports', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(106, 'settings', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(107, 'sitesetting', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(108, 'about', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(109, 'add-social', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(110, 'update-social', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(111, 'delete-social', 3, '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(112, 'dashboard', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(113, 'permissionslist', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(114, 'addpermissionspage', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(115, 'addpermission', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(116, 'editpermissionpage', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(117, 'updatepermission', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(118, 'deletepermission', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(119, 'admins', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(120, 'addadmin', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(121, 'updateadmin', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(122, 'deleteadmin', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(123, 'deleteadmins', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(124, 'users', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(125, 'adduser', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(126, 'updateuser', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(127, 'deleteuser', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(128, 'deleteusers', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(129, 'send-fcm', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(130, 'allreports', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(131, 'deletereports', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(132, 'settings', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(133, 'sitesetting', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(134, 'about', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(135, 'add-social', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(136, 'update-social', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(137, 'delete-social', 4, '2019-06-28 18:16:02', '2019-06-28 18:16:02'),
(283, 'dashboard', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(284, 'permissionslist', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(285, 'addpermissionspage', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(286, 'addpermission', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(287, 'editpermissionpage', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(288, 'updatepermission', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(289, 'deletepermission', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(290, 'admins', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(291, 'addadmin', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(292, 'updateadmin', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(293, 'deleteadmin', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(294, 'deleteadmins', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(295, 'users', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(296, 'adduser', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(297, 'updateuser', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(298, 'deleteuser', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(299, 'deleteusers', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(300, 'send-fcm', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(301, 'employees', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(302, 'addEmployee', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(303, 'updateEmployee', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(304, 'deleteEmployee', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(305, 'deleteEmployees', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(306, 'supervisors', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(307, 'addSupervisor', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(308, 'updateSupervisor', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(309, 'deleteSupervisor', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(310, 'deleteSupervisors', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(311, 'libraries', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(312, 'addLibrary', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(313, 'updateLibrary', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(314, 'deleteLibrary', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(315, 'deleteLibraries', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(316, 'orders', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(317, 'allreports', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(318, 'deletereports', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(319, 'settings', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(320, 'sitesetting', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(321, 'about', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(322, 'add-social', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(323, 'update-social', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00'),
(324, 'delete-social', 1, '2019-06-29 09:36:00', '2019-06-29 09:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `event` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supervisor` int(11) NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `event`, `supervisor`, `ip`, `country`, `city`, `area`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'قام Admin باضافة عضو جديد', 1, '118.173.85.158', 'TH', '', '', 1, '2019-06-28 18:00:46', '2019-06-28 18:00:46'),
(2, 'قام Admin بتعديل بيانات العضو', 1, '199.113.84.254', 'US', '', '', 1, '2019-06-28 18:09:00', '2019-06-28 18:09:00'),
(3, 'قام Admin باضافة عضو جديد', 1, '82.29.105.135', 'GB', 'Heckmondwike', 'Kirklees', 1, '2019-06-29 05:56:05', '2019-06-29 05:56:05'),
(4, 'قام Admin بتعديل بيانات العضو', 1, '42.13.14.196', 'KR', '', '', 1, '2019-06-29 06:00:57', '2019-06-29 06:00:57'),
(5, 'قام Admin بتعديل بيانات العضو', 1, '37.206.190.68', 'IT', '', '', 1, '2019-06-29 06:15:50', '2019-06-29 06:15:50'),
(6, 'قام Admin باضافة عضو جديد', 1, '12.131.50.108', 'US', '', '', 1, '2019-06-29 07:51:58', '2019-06-29 07:51:58'),
(7, 'قام Admin باضافة عضو جديد', 1, '64.83.35.211', 'US', 'Baltimore', 'Maryland', 1, '2019-06-29 07:53:48', '2019-06-29 07:53:48'),
(8, 'قام Admin باضافة عضو جديد', 1, '29.132.216.97', 'US', '', '', 1, '2019-06-29 07:55:13', '2019-06-29 07:55:13'),
(9, 'قام Admin باضافة عضو جديد', 1, '186.109.216.64', 'AR', 'Vaqueros', 'Salta', 1, '2019-06-29 08:07:08', '2019-06-29 08:07:08'),
(10, 'قام Admin باضافة المشرف جديد', 1, '13.192.168.250', 'US', '', '', 1, '2019-06-29 08:12:20', '2019-06-29 08:12:20'),
(11, 'قام Admin مشرف ١تم تعديل قائمة الموظفين لدي المشرف ', 1, '241.27.106.2', '', '', '', 1, '2019-06-29 08:32:29', '2019-06-29 08:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'مدير عام', '2019-06-21 11:33:09', '2019-06-21 11:33:09'),
(2, 'مشرف', '2019-06-28 18:15:10', '2019-06-28 18:15:10'),
(3, 'موظف', '2019-06-28 18:15:39', '2019-06-28 18:15:39'),
(4, 'مكتبات', '2019-06-28 18:16:02', '2019-06-28 18:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_employees`
--

CREATE TABLE `supervisor_employees` (
  `id` int(10) UNSIGNED NOT NULL,
  `supervisor` int(10) UNSIGNED NOT NULL,
  `employee` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supervisor_employees`
--

INSERT INTO `supervisor_employees` (`id`, `supervisor`, `employee`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2019-06-29 08:32:29', '2019-06-29 08:32:29'),
(2, 3, 4, '2019-06-29 08:32:29', '2019-06-29 08:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `active` int(11) NOT NULL DEFAULT 0,
  `checked` int(11) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL DEFAULT 0,
  `lat` decimal(16,14) DEFAULT NULL,
  `lng` decimal(16,14) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `code`, `avatar`, `active`, `checked`, `role`, `lat`, `lng`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'aait@aait.sa', '$2y$10$rgPC9pcjRqWtZzF/ZFSni.ikfFG/zLUC9MrLRXRDNhaIrLI7PNrq2', '01024963844', NULL, 'default.png', 1, 1, 1, NULL, NULL, '5YP6C5IT7q0ZJyYY1OFbOeqQNY8VJQ3CLylf7NWSH1sylsgl5Js1tYCLuZeS', '2019-06-21 11:35:52', '2019-06-21 11:38:49'),
(2, 'shams', 'shams@email.com', '$2y$10$hby3J402GuSKKeUJJ.A/NuZXzWFQK17kIwjXXs58HICI1uE502OV6', '0102345678', NULL, '5d1671edce1eb-1561752045-7EaX6WZonP.jpg', 0, 0, 3, NULL, NULL, NULL, '2019-06-28 18:00:45', '2019-06-28 18:09:00'),
(3, 'مشرف ١', 'm4ref@email.com', '$2y$10$ndZzRx4SvPeW6Po2fjKAZO1Xccgi59Ggw13kTuw6dg8k./PKUH.Xe', '0108765432', NULL, '5d171994a87ef-1561794964-WssuUpag3j.png', 1, 1, 2, NULL, NULL, NULL, '2019-06-29 05:56:04', '2019-06-29 06:15:49'),
(4, 'موظف ١', 'em1@email.com', '$2y$10$Tyo4K7ekQa.1rmLf11Rlgu22FbSNKD8ocvSnsw5UiVNQzxurjKlOy', '0102345677', NULL, '5d1734bd8a6c8-1561801917-2TWmrr1sLa.jpg', 1, 0, 3, NULL, NULL, NULL, '2019-06-29 07:51:57', '2019-06-29 07:52:27'),
(5, 'موظف ٢', 'em2@email.com', '$2y$10$KRFIxGkkPoh9FhNGSx5c6O8ambeYM.ZUMVYrgnQ/SxdQ4epjxR5ia', '0102345688', NULL, '5d17352bad427-1561802027-DKhVzOIhlT.jpg', 0, 0, 3, NULL, NULL, NULL, '2019-06-29 07:53:47', '2019-06-29 07:53:47'),
(6, 'موظف 3', 'em3@email.com', '$2y$10$pIrWiHxx3TPGPGFhYKrXeuBhgg5TM0MpFwVspBpTWnHNOXZslAmsC', '05012234567', NULL, '5d17358153933-1561802113-0kNuoM4P2z.png', 0, 0, 3, NULL, NULL, NULL, '2019-06-29 07:55:13', '2019-06-29 07:55:13'),
(7, 'موظف 4', 'em4@email.com', '$2y$10$0H9MxDJcVyviqDBiKyX8uuS5qVv5H/ala9aEvrjL.k.qJbO8BI8rm', '0501234567', NULL, '5d17384b811cb-1561802827-kDDPKImIjF.png', 0, 0, 3, NULL, NULL, NULL, '2019-06-29 08:07:07', '2019-06-29 08:07:07'),
(8, 'مشرف ٢', 'super2@email.com', '123456', '0101234567', NULL, '5d1739841066d-1561803140-o2InaOJFEo.png', 0, 0, 2, NULL, NULL, NULL, '2019-06-29 08:12:20', '2019-06-29 08:12:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
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
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisor_employees`
--
ALTER TABLE `supervisor_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supervisor_employees_supervisor_foreign` (`supervisor`),
  ADD KEY `supervisor_employees_employee_foreign` (`employee`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supervisor_employees`
--
ALTER TABLE `supervisor_employees`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `supervisor_employees`
--
ALTER TABLE `supervisor_employees`
  ADD CONSTRAINT `supervisor_employees_employee_foreign` FOREIGN KEY (`employee`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `supervisor_employees_supervisor_foreign` FOREIGN KEY (`supervisor`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
