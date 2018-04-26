-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2018 at 06:09 AM
-- Server version: 10.0.30-MariaDB-0+deb8u2
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kati`
--

-- --------------------------------------------------------

--
-- Table structure for table `behavior`
--

CREATE TABLE IF NOT EXISTS `behavior` (
`Behavior_id` int(11) NOT NULL,
  `Behavior_type` enum('tookpill','forgottakepill','comebutnotakepill') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Behavior_datetime` datetime NOT NULL,
  `Schedule_id` int(11) NOT NULL,
  `Pill_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `behavior_notification`
--

CREATE TABLE IF NOT EXISTS `behavior_notification` (
`Behavior_notification_id` int(11) NOT NULL,
  `Behavior_id` int(11) NOT NULL,
  `Member_id` int(11) NOT NULL,
  `Msg_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `Config_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Config_value` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Config_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`Config_name`, `Config_value`, `Config_visiblestatus`) VALUES
('Robot_connect_status', '1', 1),
('Robot_face_status', 'normal', 1),
('Robot_get_schedule_status', '1', 1),
('Robot_lang', 'thai', 1),
('Robot_pill_dispenser_pill_id', '0', 1),
('Robot_pill_dispenser_status', '0', 1),
('Robot_provinces_id', '5', 1),
('Robot_status', 'free', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
`Conversation_id` int(11) NOT NULL,
  `Conversation_quiz` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Conversation_type` enum('date','time','pill_dispenser','weather','calculator','memo') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Conversation_language` enum('thai','english') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_id` int(11) NOT NULL,
  `Conversation_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dispenser`
--

CREATE TABLE IF NOT EXISTS `dispenser` (
`Dispenser_id` int(11) NOT NULL,
  `Schedule_id` int(11) NOT NULL,
  `Slot_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `firebase_error_log`
--

CREATE TABLE IF NOT EXISTS `firebase_error_log` (
`Firebase_error_log_id` int(11) NOT NULL,
  `Firebase_error_log_service` enum('notification','database') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Firebase_error_log_JSON_detail` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
`Member_id` int(11) NOT NULL,
  `Member_firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Member_surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Member_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Admin_permission` tinyint(1) NOT NULL,
  `Member_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`Member_id`, `Member_firstname`, `Member_surname`, `username`, `password`, `Member_email`, `Admin_permission`, `Member_visiblestatus`) VALUES
(1, 'Admin', 'Kati System', 'admin', '123456789', 'admin@kati.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

CREATE TABLE IF NOT EXISTS `memo` (
`Memo_id` int(11) NOT NULL,
  `Memo_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `Memo_notification_date` date NOT NULL,
  `Memo_notification_time` time NOT NULL,
  `Memo_notification_day` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Memo_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `memo_log`
--

CREATE TABLE IF NOT EXISTS `memo_log` (
`Memo_log_id` int(11) NOT NULL,
  `Memo_id` int(11) NOT NULL,
  `Memo_log_datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outsider`
--

CREATE TABLE IF NOT EXISTS `outsider` (
`Outsider_id` int(11) NOT NULL,
  `Outsider_firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Outsider_surname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Outsider_level` enum('caregiver','doctor','patient') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Outsider_token` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Outsider_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pill`
--

CREATE TABLE IF NOT EXISTS `pill` (
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `pill_log`
--

CREATE TABLE IF NOT EXISTS `pill_log` (
`Pill_log_id` int(11) NOT NULL,
  `Pill_log_type` enum('almostoutofstock','outofstock') COLLATE utf8mb4_unicode_ci NOT NULL,
  `Pill_log_datetime` datetime NOT NULL,
  `Pill_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pill_log_notification`
--

CREATE TABLE IF NOT EXISTS `pill_log_notification` (
`Pill_log_notification_id` int(11) NOT NULL,
  `Pill_log_id` int(11) NOT NULL,
  `Member_id` int(11) NOT NULL,
  `Msg_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE IF NOT EXISTS `provinces` (
`Provinces_id` int(5) NOT NULL,
  `Provinces_name_thai` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `Provinces_name_english` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
`Schedule_id` int(11) NOT NULL,
  `Schedule_time` time NOT NULL,
  `Schedule_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE IF NOT EXISTS `slot` (
`Slot_id` int(11) NOT NULL,
  `Slot_num` int(1) NOT NULL,
  `Pill_id` int(11) NOT NULL,
  `Slot_visiblestatus` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `behavior`
--
ALTER TABLE `behavior`
 ADD PRIMARY KEY (`Behavior_id`);

--
-- Indexes for table `behavior_notification`
--
ALTER TABLE `behavior_notification`
 ADD PRIMARY KEY (`Behavior_notification_id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`Config_name`);

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
-- Indexes for table `firebase_error_log`
--
ALTER TABLE `firebase_error_log`
 ADD PRIMARY KEY (`Firebase_error_log_id`);

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
MODIFY `Behavior_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT for table `behavior_notification`
--
ALTER TABLE `behavior_notification`
MODIFY `Behavior_notification_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
MODIFY `Conversation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `dispenser`
--
ALTER TABLE `dispenser`
MODIFY `Dispenser_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=310;
--
-- AUTO_INCREMENT for table `firebase_error_log`
--
ALTER TABLE `firebase_error_log`
MODIFY `Firebase_error_log_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
MODIFY `Member_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `memo`
--
ALTER TABLE `memo`
MODIFY `Memo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `memo_log`
--
ALTER TABLE `memo_log`
MODIFY `Memo_log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `outsider`
--
ALTER TABLE `outsider`
MODIFY `Outsider_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `pill`
--
ALTER TABLE `pill`
MODIFY `Pill_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pill_log`
--
ALTER TABLE `pill_log`
MODIFY `Pill_log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `pill_log_notification`
--
ALTER TABLE `pill_log_notification`
MODIFY `Pill_log_notification_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
MODIFY `Provinces_id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
MODIFY `Schedule_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=238;
--
-- AUTO_INCREMENT for table `slot`
--
ALTER TABLE `slot`
MODIFY `Slot_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
