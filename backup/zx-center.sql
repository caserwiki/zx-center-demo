-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-06-08 11:37:40
-- 服务器版本： 8.0.12
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `zx-center`
--
CREATE DATABASE IF NOT EXISTS `zx-center` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `zx-center`;

-- --------------------------------------------------------

--
-- 表的结构 `admin_extensions`
--

DROP TABLE IF EXISTS `admin_extensions`;
CREATE TABLE `admin_extensions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `is_enabled` tinyint(4) NOT NULL DEFAULT '0',
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_extensions`
--

INSERT INTO `admin_extensions` (`id`, `name`, `version`, `is_enabled`, `options`, `created_at`, `updated_at`) VALUES
(1, 'zx-center.operation-log', '1.0.0', 1, NULL, '2021-05-28 04:44:53', '2021-05-28 04:44:56');

-- --------------------------------------------------------

--
-- 表的结构 `admin_extension_histories`
--

DROP TABLE IF EXISTS `admin_extension_histories`;
CREATE TABLE `admin_extension_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `version` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_extension_histories`
--

INSERT INTO `admin_extension_histories` (`id`, `name`, `type`, `version`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'zx-center.operation-log', 2, '1.0.0', 'create_opration_log_table.php', '2021-05-28 04:44:53', '2021-05-28 04:44:53'),
(2, 'zx-center.operation-log', 1, '1.0.0', 'Initialize extension.', '2021-05-28 04:44:53', '2021-05-28 04:44:53');

-- --------------------------------------------------------

--
-- 表的结构 `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extension` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `show` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `extension`, `show`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 'Index', 'feather icon-bar-chart-2', '/', '', 1, '2021-05-27 20:05:36', NULL),
(2, 0, 8, 'Admin', 'feather icon-settings', '', '', 1, '2021-05-27 20:05:36', '2021-06-07 07:49:39'),
(3, 2, 9, 'Users', '', 'auth/users', '', 1, '2021-05-27 20:05:36', '2021-06-07 07:49:39'),
(4, 2, 10, 'Roles', '', 'auth/roles', '', 1, '2021-05-27 20:05:36', '2021-06-07 07:49:39'),
(5, 2, 11, 'Permission', '', 'auth/permissions', '', 1, '2021-05-27 20:05:36', '2021-06-07 07:49:39'),
(6, 2, 12, 'Menu', '', 'auth/menu', '', 1, '2021-05-27 20:05:36', '2021-06-07 07:49:39'),
(7, 2, 13, 'Extensions', '', 'auth/extensions', '', 1, '2021-05-27 20:05:36', '2021-06-07 07:49:39'),
(8, 0, 14, 'Operation Log', '', 'auth/operation-logs', 'zx-center.operation-log', 1, '2021-05-28 04:44:52', '2021-06-07 07:49:39'),
(9, 0, 2, 'Task', 'fa-wpforms', NULL, '', 1, '2021-05-28 05:03:20', '2021-06-07 07:50:06'),
(11, 16, 6, '广告组', 'fa-youtube-square', 'campaign', '', 1, NULL, '2021-06-07 07:50:06'),
(12, 16, 7, '广告计划', 'fa-yoast', 'ad', '', 1, NULL, '2021-06-07 07:50:06'),
(13, 9, 3, 'Product', 'fa-th-list', 'product', '', 1, '2021-05-28 08:40:48', '2021-06-07 07:50:06'),
(14, 9, 4, 'Task', 'fa-th', 'task', '', 1, '2021-05-28 08:41:25', '2021-06-07 07:50:06'),
(16, 0, 5, 'advert', 'fa-youtube-play', NULL, '', 1, '2021-06-07 07:49:09', '2021-06-07 07:50:06');

-- --------------------------------------------------------

--
-- 表的结构 `admin_operation_log`
--

DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_permissions`
--

DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '0',
  `parent_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `order`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Auth management', 'auth-management', '', '', 1, 0, '2021-05-27 20:05:36', NULL),
(2, 'Users', 'users', '', '/auth/users*', 2, 1, '2021-05-27 20:05:36', NULL),
(3, 'Roles', 'roles', '', '/auth/roles*', 3, 1, '2021-05-27 20:05:36', NULL),
(4, 'Permissions', 'permissions', '', '/auth/permissions*', 4, 1, '2021-05-27 20:05:36', NULL),
(5, 'Menu', 'menu', '', '/auth/menu*', 5, 1, '2021-05-27 20:05:36', NULL),
(6, 'Extension', 'extension', '', '/auth/extensions*', 6, 1, '2021-05-27 20:05:36', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_permission_menu`
--

DROP TABLE IF EXISTS `admin_permission_menu`;
CREATE TABLE `admin_permission_menu` (
  `permission_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_roles`
--

DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', '2021-05-27 20:05:36', '2021-05-27 20:05:37');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_menu`
--

DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu` (
  `role_id` bigint(20) NOT NULL,
  `menu_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 16, '2021-06-07 07:49:09', '2021-06-07 07:49:09');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_permissions`
--

DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions` (
  `role_id` bigint(20) NOT NULL,
  `permission_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_users`
--

DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users` (
  `role_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_users`
--

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-05-27 20:05:37', '2021-05-27 20:05:37'),
(1, 2, '2021-05-28 06:31:35', '2021-05-28 06:31:35');

-- --------------------------------------------------------

--
-- 表的结构 `admin_settings`
--

DROP TABLE IF EXISTS `admin_settings`;
CREATE TABLE `admin_settings` (
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_settings`
--

INSERT INTO `admin_settings` (`slug`, `value`, `created_at`, `updated_at`) VALUES
('footer_remove', '1', '2021-06-02 06:27:24', '2021-06-02 06:27:24'),
('grid_row_actions_right', '0', '2021-06-02 06:27:25', '2021-06-02 06:27:25'),
('sidebar_style', '', '2021-06-02 06:27:25', '2021-06-02 06:27:25'),
('site_debug', '0', '2021-06-02 06:27:03', '2021-06-02 06:27:03'),
('site_lang', 'zh_CN', '2021-06-02 06:27:03', '2021-06-02 06:27:03'),
('site_logo', '', '2021-06-02 06:27:03', '2021-06-02 06:27:03'),
('site_logo_mini', '', '2021-06-02 06:27:03', '2021-06-02 06:27:03'),
('site_logo_text', '', '2021-06-02 06:27:03', '2021-06-02 06:27:03'),
('site_title', '', '2021-06-02 06:27:03', '2021-06-02 06:27:03'),
('site_url', '', '2021-06-02 06:27:03', '2021-06-02 06:27:03'),
('theme_color', 'green', '2021-06-02 06:27:24', '2021-06-02 06:27:24');

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$1rxKv3ktAAhMwZTO5GPBm.cZsdQucK7hEyv2HcP.yf.rpGCfgsDPC', 'Administrator', 'images/logo.jpg', NULL, '2021-05-27 20:05:36', '2021-05-28 04:45:38'),
(2, 'zanxin', '$2y$10$ppyFMzlsYP.w.RgO5J1GZujeRIJTJ2NsKjGoL.Tm0Wzxl6P.r.xRe', '昝薪', NULL, NULL, '2021-05-28 06:31:17', '2021-05-28 06:31:17');

-- --------------------------------------------------------

--
-- 表的结构 `ad_ad`
--

DROP TABLE IF EXISTS `ad_ad`;
CREATE TABLE `ad_ad` (
  `id` int(10) UNSIGNED NOT NULL,
  `campaign_id` int(11) NOT NULL COMMENT '广告组id',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '计划名称',
  `status` tinyint(4) NOT NULL COMMENT '计划状态',
  `delivery_range` tinyint(4) NOT NULL COMMENT '投放范围',
  `union_video_type` tinyint(4) NOT NULL COMMENT '投放形式',
  `extra` json DEFAULT NULL COMMENT '投放目标参数',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ad_ad`
--

INSERT INTO `ad_ad` (`id`, `campaign_id`, `name`, `status`, `delivery_range`, `union_video_type`, `extra`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'ad1', 0, 2, 2, NULL, '2021-05-28 08:49:57', '2021-05-28 08:49:57', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `ad_campaign`
--

DROP TABLE IF EXISTS `ad_campaign`;
CREATE TABLE `ad_campaign` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '广告组状态',
  `landing_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '广告组推广目的',
  `budget_mode` tinyint(4) NOT NULL DEFAULT '0' COMMENT '广告组预算类型',
  `budget` int(11) NOT NULL DEFAULT '0' COMMENT '广告组预算',
  `delivery_related_num` tinyint(4) NOT NULL DEFAULT '0' COMMENT '广告组商品类型',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `ad_campaign`
--

INSERT INTO `ad_campaign` (`id`, `name`, `status`, `landing_type`, `budget_mode`, `budget`, `delivery_related_num`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'campaign1', 1, 3, 0, 50000, 3, '2021-05-28 08:49:42', '2021-05-28 08:49:42', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
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
-- 表的结构 `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_01_04_173148_create_admin_tables', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_09_07_090635_create_admin_settings_table', 1),
(6, '2020_09_22_015815_create_admin_extensions_table', 1),
(7, '2020_11_01_083237_update_admin_menu_table', 1),
(8, '2021_06_07_104608_create_task_table', 2),
(9, '2021_05_28_155734_create_ad_ad_table', 3),
(10, '2021_05_28_155810_create_ad_campaign_table', 3),
(11, '2021_05_28_163446_create_product_table', 4);

-- --------------------------------------------------------

--
-- 表的结构 `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '灭天', '2021-05-28 08:43:10', '2021-05-28 08:43:10', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `p1` int(11) NOT NULL DEFAULT '0' COMMENT '发布人',
  `p2` int(11) NOT NULL DEFAULT '0' COMMENT '执行人',
  `product` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '产品',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '任务说明',
  `status` tinyint(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '状态',
  `finish_at` timestamp NULL DEFAULT NULL COMMENT '完成时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `task`
--

INSERT INTO `task` (`id`, `parent_id`, `name`, `p1`, `p2`, `product`, `description`, `status`, `finish_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 'task1', 1, 2, 1, 'explain1', 0, NULL, '2021-05-28 07:28:07', '2021-06-04 03:41:28', NULL),
(2, 0, 'task3', 1, 1, 1, 'explain3', 1, NULL, '2021-05-28 09:46:53', '2021-05-28 09:46:53', NULL),
(4, 2, 'task11', 1, 2, 1, 'explain11', 2, NULL, '2021-05-28 07:28:07', '2021-05-28 08:47:31', NULL),
(6, 2, '', 1, 1, 1, '犯得上发射点发烦烦烦烦烦烦烦烦烦烦烦烦 烦烦烦烦烦烦烦烦烦烦烦烦烦烦烦', 0, NULL, '2021-06-04 03:38:39', '2021-06-04 03:38:39', NULL),
(7, 1, '', 1, 2, 1, '反对法烦烦烦烦烦烦方法', 0, NULL, '2021-06-04 03:41:28', '2021-06-04 03:41:28', NULL),
(8, 0, 'work3', 2, 1, 1, '任务描述3', 2, '2021-06-07 02:45:04', '2021-06-04 03:51:32', '2021-06-07 02:45:04', NULL),
(9, 8, '', 2, 1, 1, '大苏打', 0, NULL, '2021-06-07 02:44:53', '2021-06-07 02:44:53', NULL),
(10, 8, '', 2, 1, 1, 'close', 0, NULL, '2021-06-07 02:45:04', '2021-06-07 02:45:04', NULL),
(11, 0, '富文本', 2, 2, 1, '<p><img src=\"http://zx-center.local/uploads/tinymce/images/f121d135f39f03e48da5fe5e8ced5b0a60bdb99a447bd.jpg\" alt=\"\" width=\"162\" height=\"163\" /></p>\r\n<p>&nbsp;</p>\r\n<p>富文本测试</p>\r\n<p>段落1</p>', 0, '2021-06-09 06:16:31', '2021-06-07 06:16:49', '2021-06-07 06:16:49', NULL),
(12, 0, '富文本测试富文本', 2, 2, 1, '<p><img src=\"http://zx-center.local/uploads/tinymce/images/f121d135f39f03e48da5fe5e8ced5b0a60bdc2db5e312.jpg\" alt=\"\" width=\"124\" height=\"124\" />富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试</p>\r\n<p>&nbsp;</p>\r\n<ol>\r\n<li>富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试富文本测试</li>\r\n<li>富文本测试</li>\r\n<li>&nbsp;</li>\r\n<li>&nbsp;</li>\r\n<li>富文本测试富文本测试富文本测试富文本测试富文本测试</li>\r\n</ol>', 1, '2021-06-10 06:56:08', '2021-06-07 06:56:33', '2021-06-07 07:41:24', NULL),
(13, 12, '', 2, 2, 1, '<p>测试 <img src=\"http://zx-center.local/uploads/tinymce/images/f121d135f39f03e48da5fe5e8ced5b0a60bdcd9eba72c.jpg\" alt=\"\" width=\"222\" height=\"222\" /></p>', 0, NULL, '2021-06-07 07:41:24', '2021-06-07 07:41:24', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

DROP TABLE IF EXISTS `users`;
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

--
-- 转储表的索引
--

--
-- 表的索引 `admin_extensions`
--
ALTER TABLE `admin_extensions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_extensions_name_unique` (`name`);

--
-- 表的索引 `admin_extension_histories`
--
ALTER TABLE `admin_extension_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_extension_histories_name_index` (`name`);

--
-- 表的索引 `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_operation_log_user_id_index` (`user_id`);

--
-- 表的索引 `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_permissions_slug_unique` (`slug`);

--
-- 表的索引 `admin_permission_menu`
--
ALTER TABLE `admin_permission_menu`
  ADD UNIQUE KEY `admin_permission_menu_permission_id_menu_id_unique` (`permission_id`,`menu_id`);

--
-- 表的索引 `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_roles_slug_unique` (`slug`);

--
-- 表的索引 `admin_role_menu`
--
ALTER TABLE `admin_role_menu`
  ADD UNIQUE KEY `admin_role_menu_role_id_menu_id_unique` (`role_id`,`menu_id`);

--
-- 表的索引 `admin_role_permissions`
--
ALTER TABLE `admin_role_permissions`
  ADD UNIQUE KEY `admin_role_permissions_role_id_permission_id_unique` (`role_id`,`permission_id`);

--
-- 表的索引 `admin_role_users`
--
ALTER TABLE `admin_role_users`
  ADD UNIQUE KEY `admin_role_users_role_id_user_id_unique` (`role_id`,`user_id`);

--
-- 表的索引 `admin_settings`
--
ALTER TABLE `admin_settings`
  ADD PRIMARY KEY (`slug`);

--
-- 表的索引 `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_username_unique` (`username`);

--
-- 表的索引 `ad_ad`
--
ALTER TABLE `ad_ad`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `ad_campaign`
--
ALTER TABLE `ad_campaign`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- 表的索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- 表的索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_extensions`
--
ALTER TABLE `admin_extensions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `admin_extension_histories`
--
ALTER TABLE `admin_extension_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用表AUTO_INCREMENT `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用表AUTO_INCREMENT `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234;

--
-- 使用表AUTO_INCREMENT `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用表AUTO_INCREMENT `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `ad_ad`
--
ALTER TABLE `ad_ad`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `ad_campaign`
--
ALTER TABLE `ad_campaign`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 使用表AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
