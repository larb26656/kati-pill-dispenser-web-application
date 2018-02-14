-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2018 at 05:48 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kati`
--

-- --------------------------------------------------------

--
-- Table structure for table `behavior`
--

CREATE TABLE `behavior` (
  `Behavior_id` int(11) NOT NULL,
  `Behavior_type` enum('tookpill','forgottakepill','comebutnotakepill') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Behavior_datetime` datetime NOT NULL,
  `Schedule_id` int(11) NOT NULL,
  `Pill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `behavior`
--

INSERT INTO `behavior` (`Behavior_id`, `Behavior_type`, `Behavior_datetime`, `Schedule_id`, `Pill_id`) VALUES
(32, 'tookpill', '2018-02-06 17:22:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `behavior_firebase_database_sent_error_log`
--

CREATE TABLE `behavior_firebase_database_sent_error_log` (
  `Behavior_firebase_database_sent_error_log_id` int(11) NOT NULL,
  `Behavior_id` int(11) NOT NULL,
  `Outsider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `behavior_firebase_notification_sent_error_log`
--

CREATE TABLE `behavior_firebase_notification_sent_error_log` (
  `Behavior_firebase_notification_sent_error_log_id` int(11) NOT NULL,
  `Behavior_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `behavior_notification`
--

CREATE TABLE `behavior_notification` (
  `Behavior_notification_id` int(11) NOT NULL,
  `Behavior_id` int(11) NOT NULL,
  `Member_id` int(11) NOT NULL,
  `Msg_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `behavior_notification`
--

INSERT INTO `behavior_notification` (`Behavior_notification_id`, `Behavior_id`, `Member_id`, `Msg_status`) VALUES
(29, 30, 1, 0),
(30, 31, 1, 0),
(31, 32, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `Conversation_id` int(11) NOT NULL,
  `Conversation_quiz` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Conversation_type` enum('date','time','pill_dispenser','weather','calculator','memo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Conversation_language` enum('thai','english') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_id` int(11) NOT NULL,
  `Conversation_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`Conversation_id`, `Conversation_quiz`, `Conversation_type`, `Conversation_language`, `Pill_id`, `Conversation_visiblestatus`) VALUES
(1, 'weather', 'weather', 'english', 0, 0),
(2, 'กี่โมงแล้ว', 'time', 'thai', 0, 1),
(3, 'mem', 'memo', 'english', 0, 1),
(6, 'head', 'pill_dispenser', 'thai', 1, 1),
(7, 'อากาศ', 'weather', 'thai', 0, 1),
(8, 'cal', 'calculator', 'english', 0, 1),
(9, 'วันที่', 'date', 'thai', 0, 1),
(10, 'date', 'date', 'english', 0, 1),
(11, 'time', 'time', 'english', 0, 1),
(12, 'เตือนความจำ', 'memo', 'thai', 0, 1),
(13, 'memo', 'memo', 'english', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dispenser`
--

CREATE TABLE `dispenser` (
  `Dispenser_id` int(11) NOT NULL,
  `Schedule_id` int(11) NOT NULL,
  `Slot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dispenser`
--

INSERT INTO `dispenser` (`Dispenser_id`, `Schedule_id`, `Slot_id`) VALUES
(260, 209, 19),
(261, 210, 19),
(262, 211, 19),
(263, 212, 19);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Member_id` int(11) NOT NULL,
  `Member_firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Member_surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Member_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Admin_permission` tinyint(1) NOT NULL,
  `Member_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Member_id`, `Member_firstname`, `Member_surname`, `username`, `password`, `Member_email`, `Admin_permission`, `Member_visiblestatus`) VALUES
(1, 'ต่อลาภ', 'ไทยเขียว', 'larb26656', '123456789', 'larb26656@gmail.com', 1, 1),
(2, 'ทดสอบ', 'dasd', 'asdasasdasda', 'asd', 'pic/member/307.jpg', 0, 0),
(3, 'สมศรี', 'นารี', 'test1234', '123456789', 'pic/member/lonely-cat-iari-putra.jpg', 0, 0),
(4, 'สมชาย', 'มาครับ', 'zazaza01', '563214789', 'pic/member/error-advice-triangle-with-exclamation-mark_318-27587.jpg', 0, 1),
(5, 'สมชุบ', 'ทองเปรม', 'somchop1', '123456789', 'pic/member/784931-topic-ix-6.jpg', 0, 1),
(6, 'ทอดสอบ', 'หหห', 'test2222', '123456789', 'aaa@sdasdas.com', 0, 1),
(7, 'asdasd', 'asdasd', 'sssssssss', '1234', 'asdsd@gmail.com', 0, 1),
(8, 'asdasdasd', 'asdasd', 'aaaaaaaaaaaa', '1234', 'asdasd@sasd.com', 0, 1),
(9, 'asdasdasd', 'asdasdas', 'aaaaaaaaaaaa', '1234', 'asdasd@sasd.com', 0, 1),
(10, 'asdasd', 'asdasdas', '12345678', '1234', 'asdasd@sasd.com', 0, 1),
(11, 'asdasd', 'asdasdas', 'asdxczxczxc', '1234', 'asdasd@sasd.com', 0, 1),
(12, 'หฟกฟหก', 'ฟหกฟหก', 'asdasdsss', '1234', 'asdasd@sasd.com', 0, 1),
(13, 'สมชาย', 'เรียนดี', 'somchai01', '1234', 'asdasd@sasd.com', 0, 1),
(14, 'ssss', 'sss', 'asdasdasda', '123456789', 'adsasd@hotm.com', 0, 1),
(15, '', '', '', '', '', 0, 1),
(16, 'test', 'test', 'asdbxzxcz', '123456789', 'asdasd@sasd.com', 0, 1),
(17, '', '', '', '', '', 0, 1),
(18, '', '', '', '', '', 0, 1),
(19, 'asda', '', '', '', '', 0, 1),
(20, 'asdasd', '', '', '', '', 0, 1),
(21, 'asdasd', '', '', '', '', 0, 1),
(22, 'หหหห', 'หหห', 'asdasdasdas', '123456789', 'larb266562@gmail.com', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

CREATE TABLE `memo` (
  `Memo_id` int(11) NOT NULL,
  `Memo_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Memo_notification_date` date NOT NULL,
  `Memo_notification_time` time NOT NULL,
  `Memo_notification_day` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Memo_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memo`
--

INSERT INTO `memo` (`Memo_id`, `Memo_desc`, `Memo_notification_date`, `Memo_notification_time`, `Memo_notification_day`, `Memo_visiblestatus`) VALUES
(3, 'hh', '2018-02-06', '00:00:00', '', 1),
(4, 'asdas', '2018-02-08', '00:00:00', '', 0),
(5, 'asdasd', '2018-02-08', '15:05:00', '', 1),
(6, 'asdasd', '2018-02-09', '14:35:00', '', 1),
(7, 'zzzzz', '0000-00-00', '13:40:00', '0100000', 1),
(8, 'asdsa', '0000-00-00', '13:35:00', '0100000', 1),
(9, '8888', '0000-00-00', '13:20:00', '1111111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `memo_log`
--

CREATE TABLE `memo_log` (
  `Memo_log_id` int(11) NOT NULL,
  `Memo_id` int(11) NOT NULL,
  `Memo_log_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outsider`
--

CREATE TABLE `outsider` (
  `Outsider_id` int(11) NOT NULL,
  `Outsider_firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Outsider_surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Outsider_level` enum('caregiver','doctor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Outsider_token` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Outsider_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `outsider`
--

INSERT INTO `outsider` (`Outsider_id`, `Outsider_firstname`, `Outsider_surname`, `Outsider_level`, `Outsider_token`, `Outsider_visiblestatus`) VALUES
(1, 'นายต่อลาภs', 'ไทยเขียว', 'doctor', 'dTKDp_ehhbw:APA91bGpUSvPk72vFHZAzcbKBGw4jWBoDFLfcwY5_6rIKyZg_G8ISOeVirFeVCnVZS7wYCunvSIJxuL3CCyGDOhI6ylylqN3PQhlhFC5amyX8Bf8Gyu1XDz2oeldcOxv8jRQuM-_1t_j', 1),
(12, 'sss', 'ไทยเขียว2', 'caregiver', 'eDMWVXGQkaI:APA91bG6hY4DKkJiCUuW-hNLpEZFFjNcQV8-tjVCpOkHvW4io8NoaJq6QBxeviBTthsEgaQWpj7YVXz3wQeoQXVtMYLwdoG-shbETwIPcOSsSVSoBObQy4oNOBkEfH8m23XB7UICfLCq', 1),
(13, 'สมชุบ', 'ทองเปรม', '', '123456', 0),
(14, 'สมชาย', 'อดนอน', '', 'cXQrylpGvgc:APA91bFYTllY_cHP4mkD_Zy8xNk9gigwN3P8NQD1uq0FYzT1y1lfOCTW9ZGqFxtPnE_TIWS380R1Hbro4sxSVVBOwbttqArdn32Njyd46NGRPpat0qUzZULPauaGDGpVccVfn-oD5PpO', 1),
(15, 'test', 'tttt', 'doctor', '111', 0),
(16, 'asdxxx', 'asd', 'caregiver', 's', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pill`
--

CREATE TABLE `pill` (
  `Pill_id` int(11) NOT NULL,
  `Pill_commonname_thai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_commonname_english` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_brandname_thai` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_brandname_english` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_properties_thai` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_properties_english` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_duration` enum('painorfever','beforebreakfast','beforelunch','beforedinner') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_dispenseramount` int(1) NOT NULL,
  `Pill_left` int(2) NOT NULL,
  `Pill_expiry_date` date NOT NULL,
  `Pill_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `pill`
--

INSERT INTO `pill` (`Pill_id`, `Pill_commonname_thai`, `Pill_commonname_english`, `Pill_brandname_thai`, `Pill_brandname_english`, `Pill_properties_thai`, `Pill_properties_english`, `Pill_duration`, `Pill_dispenseramount`, `Pill_left`, `Pill_expiry_date`, `Pill_visiblestatus`) VALUES
(1, 'พาราเซตามอล 500 มก.', 'para', 'BURAPHA', '', 'ยาบรรเทาปวดลดไข้', '', 'painorfever', 2, 15, '2020-06-04', 1),
(2, 'ยาแก้ปวดหัว', '', 'ฟกหกฟ', '', 'แก้ปวดหัว', '', 'beforebreakfast', 1, 0, '2017-08-19', 0),
(3, 'ฟหก', '', 'ฟหก ', '', 'ฟหก', '', 'beforelunch', 10, 15, '2017-08-18', 1),
(4, 'test', '', 'test ', '', 'แก้หวัด', '', 'beforedinner', 3, 20, '2017-08-24', 1),
(5, 'assad', '', 'asd ', '', 'asd', '', 'painorfever', 2, 5, '2017-09-15', 1),
(6, 'หหห', '', 'หห ', '', 'หห', '', 'beforedinner', 3, 3, '2017-09-12', 1),
(7, 'asd', '', 'asd ', '', 'asd', '', 'painorfever', 2, 2, '2017-11-10', 1),
(8, 'พาราเซตามอล', 'Paracetamol', 'ทดสอบยา ', 'test ', 'หห', 'ss', 'painorfever', 1, 0, '2017-12-02', 1),
(9, 'ยาแคปซูลสีฟ้า-ชมพูู', 'ยาแคปซูลสีฟ้า-ชมพูู', 'ยาแคปซูลสีฟ้า-ชมพูู ', 'ยาแคปซูลสีฟ้า-ชมพูู ', 'ยาแคปซูลสีฟ้า-ชมพูู', 'ยาแคปซูลสีฟ้า-ชมพูู', 'painorfever', 1, 15, '2017-12-05', 1),
(10, 'ยาเม็ดกลมสีขาว', 'ยาเม็ดกลมสีขาว', 'ยาเม็ดกลมสีขาว ', 'ยาเม็ดกลมสีขาว ', 'ยาเม็ดกลมสีขาว', 'ยาเม็ดกลมสีขาว', 'painorfever', 2, 6, '2017-12-05', 1),
(11, 'testt', 'testt', 'test ', 'test ', 'test', 'test', 'beforelunch', 2, 4, '2018-02-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pill_log`
--

CREATE TABLE `pill_log` (
  `Pill_log_id` int(11) NOT NULL,
  `Pill_log_type` enum('almostoutofstock','outofstock') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_log_datetime` datetime NOT NULL,
  `Pill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pill_log`
--

INSERT INTO `pill_log` (`Pill_log_id`, `Pill_log_type`, `Pill_log_datetime`, `Pill_id`) VALUES
(1, '', '2017-06-30 00:00:00', 1),
(2, '', '2017-08-25 02:34:50', 2),
(3, '', '2017-08-25 02:34:57', 2),
(4, '', '2017-08-25 02:38:03', 2),
(5, '', '2017-08-25 02:38:36', 2),
(6, '', '2017-08-25 02:40:50', 2),
(7, '', '2017-08-25 02:41:23', 2),
(8, '', '2017-08-25 02:42:05', 2),
(9, '', '2017-08-25 02:44:04', 2),
(10, '', '2017-08-25 02:45:20', 2),
(11, '', '2017-08-25 02:46:32', 2),
(12, '', '2017-08-25 02:46:44', 2),
(13, '', '2017-08-25 02:47:02', 2),
(14, '', '2017-08-25 02:51:55', 2),
(15, '', '2017-08-25 02:52:11', 2),
(16, '', '2017-08-25 02:52:24', 2),
(17, '', '2017-08-25 02:52:35', 2),
(18, '', '2017-08-25 02:52:39', 2),
(19, '', '2017-08-25 02:55:13', 2),
(20, '', '2017-08-25 03:02:57', 2),
(21, '', '2017-08-25 03:03:08', 2),
(22, '', '2017-08-25 03:03:10', 2),
(23, '', '2017-08-25 03:03:18', 2),
(24, 'outofstock', '2017-11-06 03:03:23', 2),
(25, 'almostoutofstock', '2017-11-06 03:39:08', 2),
(26, '', '2017-08-25 03:39:11', 2),
(27, 'outofstock', '2017-11-22 22:35:08', 3),
(28, 'outofstock', '2017-11-22 22:35:34', 3),
(29, 'outofstock', '2017-11-22 22:36:06', 3),
(30, '', '2017-11-23 00:15:29', 3),
(31, 'almostoutofstock', '2017-11-23 00:16:43', 3),
(32, 'outofstock', '2017-11-23 00:17:16', 3),
(33, 'outofstock', '2017-11-25 10:26:34', 7),
(34, 'outofstock', '2017-11-25 10:26:58', 7),
(35, 'outofstock', '2017-11-25 10:33:21', 7),
(36, 'outofstock', '2017-11-25 10:37:29', 7),
(37, 'outofstock', '2017-11-25 10:39:43', 7),
(38, 'outofstock', '2017-11-25 10:39:58', 7),
(39, 'outofstock', '2017-11-25 10:42:10', 7),
(40, 'outofstock', '2017-11-25 10:43:11', 7),
(41, 'outofstock', '2017-11-25 13:22:23', 7),
(42, 'outofstock', '2017-11-25 13:24:19', 7),
(43, 'outofstock', '2017-11-25 13:29:12', 7),
(44, 'outofstock', '2017-11-25 13:44:39', 7),
(45, 'outofstock', '2017-11-25 14:00:09', 7),
(46, 'outofstock', '2017-11-25 14:02:35', 7),
(47, 'almostoutofstock', '2017-11-25 14:08:09', 7),
(48, 'outofstock', '2017-11-25 15:09:59', 7),
(49, 'almostoutofstock', '2017-11-25 15:17:11', 2),
(50, 'almostoutofstock', '2017-11-25 15:19:06', 2),
(51, 'almostoutofstock', '2017-11-25 15:19:13', 2),
(52, 'outofstock', '2017-11-25 15:19:20', 2),
(53, 'outofstock', '2017-11-25 15:19:32', 2),
(54, 'almostoutofstock', '2017-11-25 15:44:53', 2),
(55, 'outofstock', '2017-11-25 15:45:16', 2),
(56, 'outofstock', '2017-11-25 15:45:29', 2),
(57, 'almostoutofstock', '2017-11-25 19:58:56', 5),
(58, 'almostoutofstock', '2017-12-01 11:39:10', 8),
(59, 'almostoutofstock', '2017-12-01 11:52:42', 8),
(60, 'almostoutofstock', '2017-12-01 11:53:24', 8),
(61, 'almostoutofstock', '2017-12-01 11:53:32', 8),
(62, 'outofstock', '2017-12-01 11:53:41', 8),
(63, 'outofstock', '2017-12-01 11:53:51', 8),
(64, 'almostoutofstock', '2017-12-01 13:39:05', 8),
(65, 'almostoutofstock', '2017-12-01 13:40:21', 8),
(66, 'almostoutofstock', '2017-12-01 13:40:25', 8),
(67, 'outofstock', '2017-12-01 13:40:29', 8),
(68, 'outofstock', '2017-12-01 13:40:44', 8),
(69, 'outofstock', '2018-01-08 11:22:39', 1),
(70, 'outofstock', '2018-01-08 11:22:58', 1),
(71, 'outofstock', '2018-01-08 11:24:23', 1),
(72, 'outofstock', '2018-01-08 11:28:03', 1),
(73, 'outofstock', '2018-01-08 11:28:12', 1),
(76, 'outofstock', '2018-01-08 11:38:16', 1),
(77, 'outofstock', '2018-01-08 11:38:50', 1),
(78, 'outofstock', '2018-01-08 11:40:46', 1),
(79, 'outofstock', '2018-01-08 11:41:57', 1),
(80, 'outofstock', '2018-01-08 11:42:14', 1),
(81, 'outofstock', '2018-01-08 11:42:57', 1),
(82, 'outofstock', '2018-01-08 11:46:20', 1),
(83, 'outofstock', '2018-01-08 11:46:47', 1),
(84, 'almostoutofstock', '2018-01-08 11:47:45', 1),
(85, 'outofstock', '2018-01-08 11:49:16', 1),
(86, 'outofstock', '2018-01-08 11:53:53', 1),
(87, 'outofstock', '2018-01-08 11:54:15', 1),
(88, 'outofstock', '2018-01-08 13:38:51', 1),
(89, 'outofstock', '2018-01-08 13:48:03', 1),
(90, 'outofstock', '2018-01-08 13:48:17', 1),
(91, 'outofstock', '2018-01-08 15:26:38', 1),
(92, 'outofstock', '2018-01-08 15:27:25', 1),
(93, 'outofstock', '2018-01-08 15:31:53', 1),
(94, 'outofstock', '2018-01-08 15:32:24', 1),
(95, 'outofstock', '2018-01-08 15:33:25', 1),
(96, 'outofstock', '2018-01-08 15:33:52', 1),
(97, 'outofstock', '2018-01-08 15:34:31', 1),
(98, 'outofstock', '2018-01-08 15:35:05', 1),
(99, 'outofstock', '2018-01-08 15:35:27', 1),
(100, 'outofstock', '2018-01-08 15:35:57', 1),
(101, 'outofstock', '2018-01-08 15:53:02', 1),
(102, 'outofstock', '2018-01-08 15:53:12', 1),
(103, 'outofstock', '2018-01-08 15:53:25', 1),
(104, 'outofstock', '2018-01-08 15:55:41', 1),
(105, 'outofstock', '2018-01-08 16:28:31', 1),
(106, 'outofstock', '2018-01-08 16:29:28', 1),
(107, 'outofstock', '2018-01-08 16:30:59', 1),
(108, 'outofstock', '2018-01-08 16:31:19', 1),
(109, 'outofstock', '2018-01-08 16:35:40', 1),
(110, 'outofstock', '2018-01-08 16:37:57', 1),
(111, 'outofstock', '2018-01-08 16:41:57', 1),
(112, 'outofstock', '2018-01-08 16:42:37', 1),
(113, 'outofstock', '2018-01-08 16:44:36', 1),
(114, 'outofstock', '2018-01-08 16:52:32', 1),
(115, 'outofstock', '2018-01-08 16:53:16', 1),
(116, 'outofstock', '2018-01-09 10:33:47', 1),
(117, 'outofstock', '2018-01-09 10:36:10', 1),
(118, 'outofstock', '2018-01-09 10:36:27', 1),
(119, 'outofstock', '2018-01-09 10:36:40', 1),
(120, 'outofstock', '2018-01-09 10:48:44', 1),
(121, 'outofstock', '2018-01-09 10:57:12', 1),
(122, 'outofstock', '2018-01-09 10:57:26', 1),
(123, 'outofstock', '2018-01-16 16:11:49', 8),
(124, 'outofstock', '2018-01-16 16:13:08', 8),
(125, 'almostoutofstock', '2018-01-17 14:01:56', 10),
(126, 'outofstock', '2018-01-17 14:02:18', 10),
(127, 'outofstock', '2018-01-19 12:47:40', 1),
(128, 'outofstock', '2018-01-19 12:54:36', 1),
(129, 'outofstock', '2018-02-04 22:38:32', 1),
(130, 'outofstock', '2018-02-04 22:39:38', 1),
(131, 'outofstock', '2018-02-04 22:42:30', 1),
(132, 'outofstock', '2018-02-04 22:42:45', 1),
(133, 'almostoutofstock', '2018-02-05 09:55:11', 10),
(134, 'outofstock', '2018-02-05 10:41:47', 10),
(135, 'outofstock', '2018-02-05 10:42:31', 10),
(136, 'outofstock', '2018-02-05 10:44:49', 10),
(137, 'almostoutofstock', '2018-02-06 11:06:38', 9),
(138, 'almostoutofstock', '2018-02-06 11:09:47', 9),
(139, 'almostoutofstock', '2018-02-06 11:12:00', 9),
(140, 'almostoutofstock', '2018-02-06 13:52:32', 4),
(141, 'almostoutofstock', '2018-02-06 14:15:10', 3),
(142, 'almostoutofstock', '2018-02-06 14:15:14', 3),
(143, 'outofstock', '2018-02-06 15:53:09', 1),
(144, 'outofstock', '2018-02-06 15:53:14', 1),
(145, 'outofstock', '2018-02-06 15:53:35', 1),
(146, 'almostoutofstock', '2018-02-06 16:00:00', 9),
(147, 'almostoutofstock', '2018-02-06 16:02:23', 9),
(148, 'almostoutofstock', '2018-02-06 17:15:19', 9),
(149, 'outofstock', '2018-02-06 17:21:40', 9);

-- --------------------------------------------------------

--
-- Table structure for table `pill_log_firebase_database_sent_error_log`
--

CREATE TABLE `pill_log_firebase_database_sent_error_log` (
  `Pill_log_firebase_database_sent_error_log_id` int(11) NOT NULL,
  `Pill_log_id` int(11) NOT NULL,
  `Outsider_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pill_log_firebase_notification_sent_error_log`
--

CREATE TABLE `pill_log_firebase_notification_sent_error_log` (
  `Pill_log_firebase_notification_sent_error_log_id` int(11) NOT NULL,
  `Pill_log_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `pill_log_notification`
--

CREATE TABLE `pill_log_notification` (
  `Pill_log_notification_id` int(11) NOT NULL,
  `Pill_log_id` int(11) NOT NULL,
  `Member_id` int(11) NOT NULL,
  `Msg_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pill_log_notification`
--

INSERT INTO `pill_log_notification` (`Pill_log_notification_id`, `Pill_log_id`, `Member_id`, `Msg_status`) VALUES
(23, 19, 1, 0),
(24, 19, 3, 1),
(25, 19, 4, 1),
(26, 19, 5, 0),
(27, 20, 1, 0),
(28, 20, 3, 1),
(29, 20, 4, 1),
(30, 20, 5, 0),
(31, 21, 1, 0),
(32, 21, 3, 1),
(33, 21, 4, 1),
(34, 21, 5, 0),
(35, 22, 1, 0),
(36, 22, 3, 1),
(37, 22, 4, 1),
(38, 22, 5, 0),
(39, 23, 1, 0),
(40, 23, 3, 1),
(41, 23, 4, 1),
(42, 23, 5, 0),
(43, 24, 1, 0),
(44, 24, 3, 1),
(45, 24, 4, 1),
(46, 24, 5, 0),
(47, 25, 1, 0),
(48, 25, 3, 1),
(49, 25, 4, 1),
(50, 25, 5, 0),
(51, 26, 1, 0),
(52, 26, 3, 1),
(53, 26, 4, 1),
(54, 26, 5, 0),
(55, 28, 1, 0),
(56, 29, 1, 0),
(57, 30, 1, 0),
(58, 31, 1, 0),
(59, 32, 1, 0),
(60, 33, 1, 0),
(61, 34, 1, 0),
(62, 35, 1, 0),
(63, 36, 1, 0),
(64, 37, 1, 0),
(65, 38, 1, 0),
(66, 39, 1, 0),
(67, 40, 1, 0),
(68, 41, 1, 0),
(69, 42, 1, 0),
(70, 43, 1, 0),
(71, 44, 1, 0),
(72, 45, 1, 0),
(73, 46, 1, 0),
(74, 47, 1, 0),
(75, 48, 1, 0),
(76, 49, 1, 0),
(77, 50, 1, 0),
(78, 51, 1, 0),
(79, 52, 1, 0),
(80, 53, 1, 0),
(81, 54, 1, 0),
(82, 55, 1, 0),
(83, 56, 1, 0),
(84, 57, 1, 0),
(85, 58, 1, 0),
(86, 59, 1, 0),
(87, 60, 1, 0),
(88, 61, 1, 0),
(89, 62, 1, 0),
(90, 63, 1, 0),
(91, 64, 1, 0),
(92, 65, 1, 0),
(93, 66, 1, 0),
(94, 67, 1, 0),
(95, 68, 1, 0),
(96, 84, 1, 0),
(97, 85, 1, 0),
(98, 86, 1, 0),
(99, 87, 1, 0),
(100, 88, 1, 0),
(101, 89, 1, 0),
(102, 90, 1, 0),
(103, 91, 1, 0),
(104, 92, 1, 0),
(105, 93, 1, 0),
(106, 94, 1, 0),
(107, 95, 1, 0),
(108, 96, 1, 0),
(109, 97, 1, 0),
(110, 98, 1, 0),
(111, 99, 1, 0),
(112, 100, 1, 0),
(113, 101, 1, 0),
(114, 102, 1, 0),
(115, 103, 1, 0),
(116, 104, 1, 0),
(117, 105, 1, 0),
(118, 106, 1, 0),
(119, 107, 1, 0),
(120, 108, 1, 0),
(121, 109, 1, 0),
(122, 110, 1, 0),
(123, 111, 1, 0),
(124, 112, 1, 0),
(125, 113, 1, 0),
(126, 114, 1, 0),
(127, 115, 1, 0),
(128, 116, 1, 0),
(129, 117, 1, 0),
(130, 118, 1, 0),
(131, 119, 1, 0),
(132, 120, 1, 0),
(133, 121, 1, 0),
(134, 122, 1, 0),
(135, 123, 1, 0),
(136, 124, 1, 0),
(137, 125, 1, 0),
(138, 126, 1, 0),
(139, 127, 1, 0),
(140, 128, 1, 0),
(141, 129, 1, 0),
(142, 130, 1, 0),
(143, 131, 1, 0),
(144, 132, 1, 0),
(145, 133, 1, 0),
(146, 134, 1, 0),
(147, 135, 1, 0),
(148, 136, 1, 0),
(149, 137, 1, 0),
(150, 138, 1, 0),
(151, 139, 1, 0),
(152, 140, 1, 0),
(153, 141, 1, 0),
(154, 142, 1, 0),
(155, 143, 1, 0),
(156, 144, 1, 0),
(157, 145, 1, 0),
(158, 146, 1, 0),
(159, 147, 1, 0),
(160, 148, 1, 0),
(161, 149, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `Provinces_id` int(5) NOT NULL,
  `Provinces_name_thai` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Provinces_name_english` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`Provinces_id`, `Provinces_name_thai`, `Provinces_name_english`) VALUES
(1, 'กรุงเทพมหานคร', 'Bangkok'),
(2, 'สมุทรปราการ', 'Samut Prakan'),
(3, 'นนทบุรี', 'Nonthaburi'),
(4, 'ปทุมธานี', 'Pathum Thani'),
(5, 'พระนครศรีอยุธยา', 'Phra Nakhon Si Ayutthaya'),
(6, 'อ่างทอง', 'Ang Thong'),
(7, 'ลพบุรี', 'Loburi'),
(8, 'สิงห์บุรี', 'Sing Buri'),
(9, 'ชัยนาท', 'Chai Nat'),
(10, 'สระบุรี', 'Saraburi'),
(11, 'ชลบุรี', 'Chon Buri'),
(12, 'ระยอง', 'Rayong'),
(13, 'จันทบุรี', 'Chanthaburi'),
(14, 'ตราด', 'Trat'),
(15, 'ฉะเชิงเทรา', 'Chachoengsao'),
(16, 'ปราจีนบุรี', 'Prachin Buri'),
(17, 'นครนายก', 'Nakhon Nayok'),
(18, 'สระแก้ว', 'Sa Kaeo'),
(19, 'นครราชสีมา', 'Nakhon Ratchasima'),
(20, 'บุรีรัมย์', 'Buri Ram'),
(21, 'สุรินทร์', 'Surin'),
(22, 'ศรีสะเกษ', 'Si Sa Ket'),
(23, 'อุบลราชธานี', 'Ubon Ratchathani'),
(24, 'ยโสธร', 'Yasothon'),
(25, 'ชัยภูมิ', 'Chaiyaphum'),
(26, 'อำนาจเจริญ', 'Amnat Charoen'),
(27, 'หนองบัวลำภู', 'Nong Bua Lam Phu'),
(28, 'ขอนแก่น', 'Khon Kaen'),
(29, 'อุดรธานี', 'Udon Thani'),
(30, 'เลย', 'Loei'),
(31, 'หนองคาย', 'Nong Khai'),
(32, 'มหาสารคาม', 'Maha Sarakham'),
(33, 'ร้อยเอ็ด', 'Roi Et'),
(34, 'กาฬสินธุ์', 'Kalasin'),
(35, 'สกลนคร', 'Sakon Nakhon'),
(36, 'นครพนม', 'Nakhon Phanom'),
(37, 'มุกดาหาร', 'Mukdahan'),
(38, 'เชียงใหม่', 'Chiang Mai'),
(39, 'ลำพูน', 'Lamphun'),
(40, 'ลำปาง', 'Lampang'),
(41, 'อุตรดิตถ์', 'Uttaradit'),
(42, 'แพร่', 'Phrae'),
(43, 'น่าน', 'Nan'),
(44, 'พะเยา', 'Phayao'),
(45, 'เชียงราย', 'Chiang Rai'),
(46, 'แม่ฮ่องสอน', 'Mae Hong Son'),
(47, 'นครสวรรค์', 'Nakhon Sawan'),
(48, 'อุทัยธานี', 'Uthai Thani'),
(49, 'กำแพงเพชร', 'Kamphaeng Phet'),
(50, 'ตาก', 'Tak'),
(51, 'สุโขทัย', 'Sukhothai'),
(52, 'พิษณุโลก', 'Phitsanulok'),
(53, 'พิจิตร', 'Phichit'),
(54, 'เพชรบูรณ์', 'Phetchabun'),
(55, 'ราชบุรี', 'Ratchaburi'),
(56, 'กาญจนบุรี', 'Kanchanaburi'),
(57, 'สุพรรณบุรี', 'Suphan Buri'),
(58, 'นครปฐม', 'Nakhon Pathom'),
(59, 'สมุทรสาคร', 'Samut Sakhon'),
(60, 'สมุทรสงคราม', 'Samut Songkhram'),
(61, 'เพชรบุรี', 'Phetchaburi'),
(62, 'ประจวบคีรีขันธ์', 'Prachuap Khiri Khan'),
(63, 'นครศรีธรรมราช', 'Nakhon Si Thammarat'),
(64, 'กระบี่', 'Krabi'),
(65, 'พังงา', 'Phangnga'),
(66, 'ภูเก็ต', 'Phuket'),
(67, 'สุราษฎร์ธานี', 'Surat Thani'),
(68, 'ระนอง', 'Ranong'),
(69, 'ชุมพร', 'Chumphon'),
(70, 'สงขลา', 'Songkhla'),
(71, 'สตูล', 'Satun'),
(72, 'ตรัง', 'Trang'),
(73, 'พัทลุง', 'Phatthalung'),
(74, 'ปัตตานี', 'Pattani'),
(75, 'ยะลา', 'Yala'),
(76, 'นราธิวาส', 'Narathiwat'),
(77, 'บึงกาฬ', 'buogkan');

-- --------------------------------------------------------

--
-- Table structure for table `robot_setting`
--

CREATE TABLE `robot_setting` (
  `Robot_setting_id` int(11) NOT NULL,
  `Robot_lang` enum('thai','english') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Provinces_id` int(11) NOT NULL,
  `Robot_connect_status` tinyint(1) NOT NULL,
  `Pill_dispenser_status` tinyint(1) NOT NULL,
  `Pill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `robot_setting`
--

INSERT INTO `robot_setting` (`Robot_setting_id`, `Robot_lang`, `Provinces_id`, `Robot_connect_status`, `Pill_dispenser_status`, `Pill_id`) VALUES
(1, 'thai', 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `Schedule_id` int(11) NOT NULL,
  `Schedule_time` time NOT NULL,
  `Schedule_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`Schedule_id`, `Schedule_time`, `Schedule_visiblestatus`) VALUES
(209, '01:10:00', 0),
(210, '02:05:00', 0),
(211, '01:05:00', 0),
(212, '01:05:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE `slot` (
  `Slot_id` int(11) NOT NULL,
  `Slot_num` int(1) NOT NULL,
  `Pill_id` int(11) NOT NULL,
  `Slot_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slot`
--

INSERT INTO `slot` (`Slot_id`, `Slot_num`, `Pill_id`, `Slot_visiblestatus`) VALUES
(1, 0, 5, 0),
(2, 0, 3, 0),
(3, 0, 0, 0),
(4, 0, 2, 0),
(5, 0, 1, 0),
(6, 0, 0, 0),
(7, 0, 0, 0),
(8, 0, 0, 0),
(9, 1, 1, 0),
(10, 1, 6, 0),
(11, 2, 5, 0),
(12, 2, 5, 0),
(13, 3, 1, 1),
(14, 4, 2, 0),
(15, 4, 2, 0),
(16, 1, 8, 0),
(17, 4, 3, 0),
(18, 4, 7, 1),
(19, 1, 9, 1),
(20, 2, 10, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `behavior`
--
ALTER TABLE `behavior`
  ADD PRIMARY KEY (`Behavior_id`);

--
-- Indexes for table `behavior_firebase_database_sent_error_log`
--
ALTER TABLE `behavior_firebase_database_sent_error_log`
  ADD PRIMARY KEY (`Behavior_firebase_database_sent_error_log_id`);

--
-- Indexes for table `behavior_firebase_notification_sent_error_log`
--
ALTER TABLE `behavior_firebase_notification_sent_error_log`
  ADD PRIMARY KEY (`Behavior_firebase_notification_sent_error_log_id`);

--
-- Indexes for table `behavior_notification`
--
ALTER TABLE `behavior_notification`
  ADD PRIMARY KEY (`Behavior_notification_id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`Conversation_id`);

--
-- Indexes for table `dispenser`
--
ALTER TABLE `dispenser`
  ADD PRIMARY KEY (`Dispenser_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Member_id`);

--
-- Indexes for table `memo`
--
ALTER TABLE `memo`
  ADD PRIMARY KEY (`Memo_id`);

--
-- Indexes for table `memo_log`
--
ALTER TABLE `memo_log`
  ADD PRIMARY KEY (`Memo_log_id`);

--
-- Indexes for table `outsider`
--
ALTER TABLE `outsider`
  ADD PRIMARY KEY (`Outsider_id`);

--
-- Indexes for table `pill`
--
ALTER TABLE `pill`
  ADD PRIMARY KEY (`Pill_id`);

--
-- Indexes for table `pill_log`
--
ALTER TABLE `pill_log`
  ADD PRIMARY KEY (`Pill_log_id`);

--
-- Indexes for table `pill_log_firebase_database_sent_error_log`
--
ALTER TABLE `pill_log_firebase_database_sent_error_log`
  ADD PRIMARY KEY (`Pill_log_firebase_database_sent_error_log_id`);

--
-- Indexes for table `pill_log_firebase_notification_sent_error_log`
--
ALTER TABLE `pill_log_firebase_notification_sent_error_log`
  ADD PRIMARY KEY (`Pill_log_firebase_notification_sent_error_log_id`);

--
-- Indexes for table `pill_log_notification`
--
ALTER TABLE `pill_log_notification`
  ADD PRIMARY KEY (`Pill_log_notification_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`Provinces_id`);

--
-- Indexes for table `robot_setting`
--
ALTER TABLE `robot_setting`
  ADD PRIMARY KEY (`Robot_setting_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`Schedule_id`);

--
-- Indexes for table `slot`
--
ALTER TABLE `slot`
  ADD PRIMARY KEY (`Slot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `behavior`
--
ALTER TABLE `behavior`
  MODIFY `Behavior_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `behavior_firebase_database_sent_error_log`
--
ALTER TABLE `behavior_firebase_database_sent_error_log`
  MODIFY `Behavior_firebase_database_sent_error_log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `behavior_firebase_notification_sent_error_log`
--
ALTER TABLE `behavior_firebase_notification_sent_error_log`
  MODIFY `Behavior_firebase_notification_sent_error_log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `behavior_notification`
--
ALTER TABLE `behavior_notification`
  MODIFY `Behavior_notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `Conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `dispenser`
--
ALTER TABLE `dispenser`
  MODIFY `Dispenser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `memo`
--
ALTER TABLE `memo`
  MODIFY `Memo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `memo_log`
--
ALTER TABLE `memo_log`
  MODIFY `Memo_log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `outsider`
--
ALTER TABLE `outsider`
  MODIFY `Outsider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `pill`
--
ALTER TABLE `pill`
  MODIFY `Pill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pill_log`
--
ALTER TABLE `pill_log`
  MODIFY `Pill_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
--
-- AUTO_INCREMENT for table `pill_log_firebase_database_sent_error_log`
--
ALTER TABLE `pill_log_firebase_database_sent_error_log`
  MODIFY `Pill_log_firebase_database_sent_error_log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pill_log_firebase_notification_sent_error_log`
--
ALTER TABLE `pill_log_firebase_notification_sent_error_log`
  MODIFY `Pill_log_firebase_notification_sent_error_log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pill_log_notification`
--
ALTER TABLE `pill_log_notification`
  MODIFY `Pill_log_notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `Provinces_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `Schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;
--
-- AUTO_INCREMENT for table `slot`
--
ALTER TABLE `slot`
  MODIFY `Slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
