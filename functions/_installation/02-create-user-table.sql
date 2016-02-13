-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2016 at 05:49 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `qiam_db`
--
CREATE DATABASE IF NOT EXISTS `qiam_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `qiam_db`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(64) NOT NULL,
  `course_description` text NOT NULL,
  `course_thumb` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`, `course_thumb`) VALUES
(1, 'حقوق الانسان - الجزء الاول', 'يتحدرث هذا المسار عن المفاهيم الاساسية في حقوق الانسان حيث يفسر معنى حقوق الانسان والمبادئ الاساية التي يقوم عليها وفئات حقوق الانسان او ما يسمى باجيال حقوق الانسان \r\nثم يتطرق الى المواثيق والعهود الدولية الخاصة بحقوق الانسان', 'img/meterial_cover/b_1.png'),
(2, 'حقوق الطفل', 'ينبع مفهوم حقوق الطفل من نفس المبادئ التي تقوم عليها حقوق الانسان ، وقد ظهر هذا المفهوم كنتيجة للمطالب الدولية بحماية الطفل والطفولة ', 'img/meterial_cover/b_2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `mail_box`
--

DROP TABLE IF EXISTS `mail_box`;
CREATE TABLE `mail_box` (
  `mail_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE `materials` (
  `material_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `material_order` tinyint(1) NOT NULL,
  `material_type` varchar(8) NOT NULL,
  `material_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `course_id`, `material_order`, `material_type`, `material_value`) VALUES
(1, 1, 1, 'prezi', 'dklahgldsgaakdhsjk'),
(2, 1, 2, 'text', 'bbbbbbbbbbbbbbbbbbbbbbb'),
(3, 1, 3, 'flash', 'vbvcbxcbvcx'),
(4, 2, 1, 'html5', 'http://qiamstore.s3-website-us-east-1.amazonaws.com/courses/course_1/index.html');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
CREATE TABLE `progress` (
  `course_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'user''s activation status',
  `user_activation_hash` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_rememberme_token` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attemps',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_registration_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_registration_ip` varchar(39) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0.0.0.0',
  `user_dispaly_name` varchar(39) DEFAULT 'NULL',
  `user_profilepicture` varchar(39) DEFAULT '/img/default_profilepicture.png',
  `user_class` varchar(39) DEFAULT 'User',
  `user_orgnization` varchar(39) DEFAULT NULL,
  `user_mark` int(11) NOT NULL DEFAULT '50'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_rememberme_token`, `user_failed_logins`, `user_last_failed_login`, `user_registration_datetime`, `user_registration_ip`, `user_dispaly_name`, `user_profilepicture`, `user_class`, `user_orgnization`, `user_mark`) VALUES
(1, 'oalgorani', '$2y$10$jytdIggBEZ4PoUFyQtSYYupNTk7Cr.kez0Xidsz9Dc5GEQJZUAl4i', 'zx@zx.zx', 1, '9181dc184a7621ece2e2d74f0b5ebc327870fa03', NULL, NULL, '508f7a3bfeb27ac508b75627e0807509fa9f92aa22ca2cae837d3c298d20cc2c', 0, NULL, '2016-01-25 01:45:42', '::1', 'NULL', '/img/default_profilepicture.png', 'مدير', 'منصة قيم', 850);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `mail_box`
--
ALTER TABLE `mail_box`
  ADD PRIMARY KEY (`mail_id`),
  ADD KEY `mail_id` (`mail_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mail_box`
--
ALTER TABLE `mail_box`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=2;