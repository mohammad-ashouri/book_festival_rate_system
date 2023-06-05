-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 05, 2023 at 06:03 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssmp_bookfestival`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_list`
--

DROP TABLE IF EXISTS `bank_list`;
CREATE TABLE IF NOT EXISTS `bank_list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `bank_list`
--

INSERT INTO `bank_list` (`id`, `name`) VALUES
(1, 'آینده'),
(2, 'اقتصاد نوین'),
(3, 'ایران زمین'),
(4, 'پارسیان'),
(5, 'پاسارگاد'),
(6, 'پست بانک ایران'),
(7, 'تجارت'),
(8, 'توسعه تعاون'),
(9, 'توسعه صادرات ایران'),
(10, 'خاورمیانه'),
(11, 'دی'),
(12, 'رسالت'),
(13, 'رفاه'),
(14, 'سامان'),
(15, 'سپه'),
(16, 'سرمایه'),
(17, 'سینا'),
(18, 'شهر'),
(19, 'صادرات'),
(20, 'صنعت و معدن'),
(21, 'کارآفرین'),
(22, 'کشاورزی'),
(23, 'مسکن'),
(24, 'ملت'),
(25, 'ملی'),
(26, 'مهر ایران');

-- --------------------------------------------------------

--
-- Table structure for table `cooperations`
--

DROP TABLE IF EXISTS `cooperations`;
CREATE TABLE IF NOT EXISTS `cooperations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `family` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `national_code` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `hawzah_file_number` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'شماره پرونده حوزوی',
  `cooperation_percentage` int NOT NULL,
  `mobile` varchar(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `adder` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `added_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `edited_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_cooperations_national_code` (`national_code`),
  KEY `fk_cooperations_article` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci COMMENT='Table for store cooperators informations';

-- --------------------------------------------------------

--
-- Table structure for table `ejmali`
--

DROP TABLE IF EXISTS `ejmali`;
CREATE TABLE IF NOT EXISTS `ejmali` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_code` int NOT NULL,
  `r1` float NOT NULL COMMENT 'اولویت و روزآمدی مسئله یا موضوع',
  `r2` float NOT NULL COMMENT 'ارزش علمی و نو بودن محتوا',
  `r3` float NOT NULL COMMENT 'استفاده مناسب از منابع معتبر',
  `r4` float NOT NULL COMMENT 'اثربخشی و میزان تاثیرگذاری در حل مشکلات علمی و کاربردی',
  `sum` float NOT NULL,
  `level` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL COMMENT 'نوبت اجمالی',
  `rater` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `rate_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `edited_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ejmali_article` (`article_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci COMMENT='Table for ejmali rates';

-- --------------------------------------------------------

--
-- Table structure for table `festival`
--

DROP TABLE IF EXISTS `festival`;
CREATE TABLE IF NOT EXISTS `festival` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `start_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `starter` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `extension_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `extensioner` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `finish_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `finisher` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci COMMENT='Table for administration of festivals';

--
-- Dumping data for table `festival`
--

INSERT INTO `festival` (`id`, `name`, `start_date`, `starter`, `extension_date`, `extensioner`, `finish_date`, `finisher`, `active`) VALUES
(25, 'بیست و پنجم', '1401/01/01', '1', NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `operation` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `url` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `dateandtime` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `browser` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  PRIMARY KEY (`id`),
  KEY `fk_logs_users_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci COMMENT='Logs\nincludes:\n1- logins\n2- operations\n3- logouts';

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `operation`, `url`, `dateandtime`, `ip_address`, `browser`) VALUES
(1, 1, 'Logout user= 1', 'localhost/book_festival_rate_system/logout.php', '1402/3/10 19:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(2, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/10 19:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(3, 0, 'NotFoundUser - Entered User=test', 'localhost/book_festival_rate_system/chk.php', '1402/3/10 22:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(4, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/10 22:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(5, 0, 'Access Denied', 'localhost/book_festival_rate_system/posts_manager.php', '1402/3/10 22:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(6, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/11 17:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(7, 0, 'Access Denied', 'localhost/book_festival_rate_system/posts_manager.php', '1402/3/11 18:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(8, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/12 10:54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(9, 0, 'Access Denied', 'localhost/book_festival_rate_system/posts_manager.php', '1402/3/12 12:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(10, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/12 22:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(11, 0, 'Access Denied', 'localhost/book_festival_rate_system/posts_manager.php', '1402/3/12 22:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(12, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/13 19:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(13, 0, 'Access Denied', 'localhost/book_festival_rate_system/posts_manager.php', '1402/3/13 19:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(14, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/14 10:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(15, 0, 'Access Denied', 'localhost/book_festival_rate_system/posts_manager.php', '1402/3/14 10:31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(16, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/14 13:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(17, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/15 09:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0'),
(18, 1, 'CityAdminLoginSuccess', 'localhost/book_festival_rate_system/chk.php', '1402/3/15 20:59', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/113.0');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `link` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `access` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `Is_Parent` tinyint NOT NULL,
  `childs` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `level` int DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `subject`, `link`, `icon`, `access`, `Is_Parent`, `childs`, `level`, `active`) VALUES
(2, 'صفحه اصلی', 'panel.php', 'fa-home', '1|2|3|4|5', 0, NULL, 1, 1),
(3, 'مدیریت آثار', 'posts_manager.php', 'fa-book', '3|4', 0, NULL, 2, 1),
(4, 'مدیریت نسخه های نشریه', 'version_manager.php', 'fa-sitemap', '3|4|5', 0, NULL, 3, 0),
(5, 'مدیریت مقالات', 'article_manager.php', 'fa-newspaper-o ', '3|4|5', 0, NULL, 4, 0),
(6, 'اختصاص اثر به ارزیاب', '#', 'fa-send', '3|4', 1, '12|13', 5, 0),
(7, 'آمار و گزارشات', '#', 'fa-bar-chart', '3|4', 1, NULL, 6, 1),
(8, 'مدیریت کاربران', 'user_manager.php', 'fa-users', '3|4', 0, NULL, 7, 1),
(9, 'مدیریت جشنواره', 'festival_manager.php', 'fa-star-half-o', '3|4', 0, NULL, 8, 1),
(10, 'مدیریت کاتالوگ ها', 'catalogs.php', 'fa-toggle-on', '3|4', 0, NULL, 9, 1),
(11, 'خروج از سامانه', 'logout.php', 'fa-sign-out', '1|2|3|4|5', 0, NULL, 10, 1),
(12, 'اجمالی', 'set_ejmali.php', '', '3|4', 2, NULL, 1, 1),
(13, 'تفصیلی', 'set_tafsili.php', '', '3|4', 2, NULL, 2, 1),
(14, '', '', '', '', 0, NULL, NULL, 1),
(15, 'هیئت داوری و شورای علمی', 'Proceedings.php', 'fa-comments', '3|4', 0, NULL, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `festival_id` int NOT NULL,
  `rate_status` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL DEFAULT 'اجمالی' COMMENT 'نوبت ارزیابی',
  `avg_ejmali_g1` float DEFAULT NULL COMMENT ' میانگین کل ارزیابی های اجمالی گروه اول این اثر ',
  `avg_ejmali_g2` float DEFAULT NULL COMMENT ' میانگین کل ارزیابی های اجمالی گروه دوم این اثر ',
  `avg_tafsili` float DEFAULT NULL COMMENT ' میانگین کل ارزیابی های تفصیلی این اثر ',
  `grade` float DEFAULT NULL COMMENT 'نمره نهایی',
  `proceeding_id` int DEFAULT NULL,
  `chosen_status` tinyint(1) DEFAULT '0' COMMENT 'وضعیت برگزیدگی\r\n1- برگزیده\r\n2- غیر برگزیده',
  `chosen_subject` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'نوع برگزیدگی این اثر',
  `adder` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL COMMENT 'ثبت کننده',
  `date_added` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL COMMENT 'تاریخ ثبت',
  `editor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'ویرایش کننده',
  `edited_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ ویرایش',
  `ejmali1_ratercode_g1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کد ارزیاب اجمالی 1',
  `ejmali1_registrar_g1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کاربر اختصاص دهنده به اجمالی یکم',
  `ejmali1_set_date_g1` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ و زمان اختصاص اثر اجمالی یکم به ارزیاب',
  `ejmali1_g1_done` int NOT NULL DEFAULT '0',
  `ejmali2_ratercode_g1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کد ارزیاب اجمالی 2',
  `ejmali2_registrar_g1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کاربر اختصاص دهنده به اجمالی دوم',
  `ejmali2_set_date_g1` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ و زمان اختصاص اثر اجمالی دوم به ارزیاب',
  `ejmali2_g1_done` int NOT NULL DEFAULT '0',
  `ejmali3_ratercode_g1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کد ارزیاب اجمالی 3',
  `ejmali3_registrar_g1` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کاربر اختصاص دهنده به اجمالی سوم',
  `ejmali3_set_date_g1` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ و زمان اختصاص اثر اجمالی سوم به ارزیاب',
  `ejmali3_g1_done` int NOT NULL DEFAULT '0',
  `ejmali1_ratercode_g2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کد ارزیاب اجمالی 1',
  `ejmali1_registrar_g2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کاربر اختصاص دهنده به اجمالی یکم',
  `ejmali1_set_date_g2` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ و زمان اختصاص اثر اجمالی یکم به ارزیاب',
  `ejmali1_g2_done` int NOT NULL DEFAULT '0',
  `ejmali2_ratercode_g2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کد ارزیاب اجمالی 2',
  `ejmali2_registrar_g2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کاربر اختصاص دهنده به اجمالی دوم',
  `ejmali2_set_date_g2` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ و زمان اختصاص اثر اجمالی دوم به ارزیاب',
  `ejmali2_g2_done` int NOT NULL DEFAULT '0',
  `ejmali3_ratercode_g2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کد ارزیاب اجمالی 3',
  `ejmali3_registrar_g2` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کاربر اختصاص دهنده به اجمالی سوم',
  `ejmali3_set_date_g2` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ و زمان اختصاص اثر اجمالی سوم به ارزیاب',
  `ejmali3_g2_done` int NOT NULL DEFAULT '0',
  `tafsili1_ratercode` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کد ارزیاب تفصیلی 1',
  `tafsili1_registrar` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کاربر اختصاص دهنده به تفصیلی اول',
  `tafsili1_set_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ و زمان اختصاص اثر تفصیلی یکم به ارزیاب',
  `tafsili2_ratercode` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کد ارزیاب تفصیلی 2',
  `tafsili2_registrar` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کاربر اختصاص دهنده به تفصیلی دوم',
  `tafsili2_set_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ و زمان اختصاص اثر تفصیلی دوم به ارزیاب',
  `tafsili3_ratercode` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کد ارزیاب تفصیلی 3',
  `tafsili3_registrar` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'کاربر اختصاص دهنده به تفصیلی سوم',
  `tafsili3_set_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT 'تاریخ و زمان اختصاص اثر تفصیلی سوم به ارزیاب',
  `tafsili1_done` int DEFAULT '0',
  `tafsili2_done` int DEFAULT '0',
  `tafsili3_done` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id` (`post_id`),
  KEY `fk_article_mag` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci COMMENT='Table for information of articles';

-- --------------------------------------------------------

--
-- Table structure for table `proceedings`
--

DROP TABLE IF EXISTS `proceedings`;
CREATE TABLE IF NOT EXISTS `proceedings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `opinion_of_the_jury` text CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci COMMENT 'نظر هیئت داوری',
  `jury_suggestion` int DEFAULT NULL COMMENT 'پیشنهاد هیئت داوری',
  `opinion_of_the_scientific_council` int DEFAULT NULL COMMENT 'نظر شورای علمی',
  `scientific_council_suggestion` int DEFAULT NULL,
  `adder` int NOT NULL,
  `added_date` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scientific_group`
--

DROP TABLE IF EXISTS `scientific_group`;
CREATE TABLE IF NOT EXISTS `scientific_group` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci COMMENT='Table for managing scientific groups';

--
-- Dumping data for table `scientific_group`
--

INSERT INTO `scientific_group` (`id`, `name`) VALUES
(1, 'تفسیر و علوم قرآن'),
(2, 'حدیث، درایه و رجال'),
(3, 'فلسفه'),
(4, 'اخلاق و عرفان'),
(5, 'تاریخ، سیره و تراجم'),
(6, 'فقه و اصول'),
(7, 'کتب مرجع'),
(8, 'ادبیات و هنر'),
(9, 'علوم اجتماعی'),
(10, 'تصحیح و تعلیق'),
(11, 'ترجمه'),
(12, 'کلام'),
(13, 'انقلاب اسلامی ایران'),
(14, 'اقتصاد'),
(15, 'حقوق'),
(16, 'روانشناسی'),
(17, 'علوم تربیتی'),
(18, 'علوم سیاسی'),
(19, 'مدیریت'),
(20, 'سایر');

-- --------------------------------------------------------

--
-- Table structure for table `special_type`
--

DROP TABLE IF EXISTS `special_type`;
CREATE TABLE IF NOT EXISTS `special_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `active` int NOT NULL DEFAULT '1',
  `adder` int NOT NULL,
  `added_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `editor` int DEFAULT NULL,
  `edited_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci COMMENT='Table for managing Special Types';

-- --------------------------------------------------------

--
-- Table structure for table `tafsili`
--

DROP TABLE IF EXISTS `tafsili`;
CREATE TABLE IF NOT EXISTS `tafsili` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int NOT NULL,
  `r1` float NOT NULL COMMENT 'روزآمدی موضوع و ابتنای آن بر نیاز جامعه و نظام',
  `r1_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `r2` float NOT NULL COMMENT 'رعایت شاخص های محتوایی و ساختاری مقالات علمی پژوهشی',
  `r2_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `r3` float NOT NULL COMMENT 'رعایت روشمندی متناسب با مسئله',
  `r3_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `r4` float NOT NULL COMMENT 'میزان نوآوری در تولید نظریه و اهمیت آن در دانش',
  `r4_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `r5` float NOT NULL COMMENT 'میزان خلاقیت و نوآوری در تولید روش و ساختار دانشی جدید',
  `r5_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `r6` float NOT NULL COMMENT 'نوآوری در نقد نظریه یا دفاع از نظریه و اصلاح و ارتقای آن',
  `r6_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `r7` float NOT NULL COMMENT 'جامعیت و غنای علمی و اتقان تحلیل و استدلال',
  `r7_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `r8` float NOT NULL COMMENT 'میزان تاثیرگذاری بر حل مشکلات عملی و کاربردی جامعه یا پاسخ به شبهات علمی موجود',
  `r8_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `r9_1` float NOT NULL COMMENT 'امتیاز ویژه - الف\r\nپاسداری و حراست از ارزش های دینی و انقلابی',
  `r9_1_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `r9_2` float NOT NULL COMMENT 'امتیاز ویژه - ب\r\nاثربخشی فوق العاده، برجستگی و جذابیت ویژه در نگارش',
  `r9_2_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci,
  `sum` float NOT NULL,
  `general_comment` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL COMMENT 'اظهار نظر کلی داور',
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `rater` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `rate_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `edited_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci COMMENT='Table for tafsili rates';

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `password` text CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `family` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `gender` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `national_code` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `address` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `type` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL COMMENT '1- rater\r\n2- header\r\n3- admin\r\n4- super-admin\r\n1- rater\r\n2- header\r\n3- admin\r\n4- super-admin',
  `approved` tinyint DEFAULT '1',
  `registrar` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `date_added` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `editor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  `edited_date` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_persian_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_persian_ci COMMENT='Table for All users.including:1- Raters2- Admins3- Headers4- Viewers';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `family`, `gender`, `national_code`, `phone`, `address`, `type`, `approved`, `registrar`, `date_added`, `editor`, `edited_date`) VALUES
(1, 'superadmin', '$argon2i$v=19$m=65536,t=4,p=1$NU52RExRekEzd2dPM1RwLg$kfO/AgItBI2wqTtyExlEwazmcDjZa6eGuz27JN9X4Qs', 'محمد', 'عاشوری', 'مرد', '0371714941', '09398888226', 'قم سی متری قائم', '4', 1, '', '', NULL, NULL),
(5, '123456789', '$argon2i$v=19$m=65536,t=4,p=1$aldyRzJGWHJSN2Q4dWJIZw$Yn5tY4a2Dwp935HAzjGg35OV+osMgX5BRdn+jSlWYIM', 'محمد', 'علیپور', 'مرد', '123456789', '09191969874', 'قم شیخ آباد', '1', 1, '1', '1402/3/15 21:11:54', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
