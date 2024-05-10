-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 07:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cctvwebservice_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `account_type` varchar(10) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `username`, `password`, `account_type`, `create_at`, `user_id`) VALUES
(1, 'yalanetcom', '12345', 'admin', '2024-05-10 16:21:15', 1),
(2, 'aswanee', '0650637013', 'customer', '2024-05-10 17:15:16', 2),
(3, '0123456789', '12345', 'customer', '2024-05-10 17:35:21', 3),
(4, '0862567586', '12345', 'customer', '2024-05-10 17:42:30', 4),
(5, 'yalapark', '12345', 'customer', '2024-05-10 17:44:48', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `noti_id` int(10) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `img_type` varchar(5) DEFAULT NULL,
  `noti_datetime` timestamp NOT NULL DEFAULT current_timestamp(),
  `noti_status` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(10) NOT NULL,
  `worksite_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(10) NOT NULL,
  `service_details` varchar(255) NOT NULL,
  `service_datetime` date NOT NULL,
  `noti_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `name_lastname` varchar(30) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address` varchar(30) NOT NULL,
  `img_type` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name_lastname`, `phone`, `email`, `address`, `img_type`) VALUES
(1, 'YALANETCOM', '0826537095', 'wernerlive.090@gmail.com', 'สะเตง อ.เมือง จ.ยะลา ในประเทศ', 'png'),
(2, 'อัสวาณี', '0650637013', '', 'นิบงบารู เข้าทางโรตีจำปา', NULL),
(3, 'แบแม', '0123456789', '', 'สะเตงนอก ยะลา', NULL),
(4, 'ลุงประยุกต์', '0123456789', '', 'มาลายูบางกอก ยะลา', NULL),
(5, 'Yala Park', '08567595867', '', 'ผังเมือง 4 ยะลา', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `worksite`
--

CREATE TABLE `worksite` (
  `worksite_id` int(10) NOT NULL,
  `worksite_name` varchar(20) NOT NULL,
  `address` varchar(30) NOT NULL,
  `camera_number` int(3) NOT NULL,
  `install_date` date NOT NULL,
  `other_details` varchar(255) DEFAULT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worksite`
--

INSERT INTO `worksite` (`worksite_id`, `worksite_name`, `address`, `camera_number`, `install_date`, `other_details`, `user_id`) VALUES
(1, 'งานก่อสร้างบ้าน', 'นิบงบารู เข้าทางโรตีจำปา', 1, '2024-05-11', 'เป็นหน้างานของลูกค้า ลูกค้าเป็นผู้รับเหมา', 2),
(2, 'บ้าน', 'มาลายูบางกอก', 16, '2024-05-11', 'งานปรับปรุง เพิ่มจำนวนกล้องจาก 10 เป็น 16', 3),
(3, 'ร้านไวนิว', 'ทางเข้ามัสยิด ผังเมือง 4 ยะลา', 8, '2024-05-11', '', 3),
(4, 'บ้าน', 'มาลายูบางกอก ยะลา', 8, '2024-05-11', '', 4),
(5, 'ห้องประชุมใหม่', 'ผังเมือง 4 ยะลา', 7, '2024-05-11', '', 5),
(6, 'Food Court', 'ผังเมือง 4 ยะลา', 8, '2024-05-11', '', 5),
(7, 'Ottari', 'ผังเมือง 4 ยะลา', 16, '2024-05-11', '', 5),
(8, 'Swensen\'s', 'ผังเมือง 4 ยะลา', 22, '2024-05-11', '', 5),
(9, 'Amazon ', 'ผังเมือง 4 ยะลา', 16, '2024-05-11', '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `worksite_image`
--

CREATE TABLE `worksite_image` (
  `img_id` int(10) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `worksite_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `worksite_image`
--

INSERT INTO `worksite_image` (`img_id`, `img_url`, `worksite_id`) VALUES
(1, '1_1715361464_0_1533.jpg', 1),
(2, '1_1715361464_1_1540_0.jpg', 1),
(3, '1_1715361464_2_1541_0.jpg', 1),
(4, '1_1715361464_3_Screenshot_25670509_131140.png', 1),
(5, '2_1715362667_0_IMG_25661205_141527.jpg', 2),
(6, '2_1715362667_1_IMG_25661205_141531.jpg', 2),
(7, '2_1715362667_2_IMG_25661205_141548.jpg', 2),
(8, '2_1715362667_3_IMG_25661205_141609.jpg', 2),
(9, '2_1715362667_4_Screenshot_25670406_105309.png', 2),
(10, '3_1715362863_0_IMG_25670117_165532.jpg', 3),
(11, '3_1715362863_1_IMG_25670117_165544.jpg', 3),
(12, '3_1715362863_2_IMG_25670117_181538.jpg', 3),
(13, '4_1715363018_0_IMG_25670220_091539.jpg', 4),
(14, '4_1715363018_1_IMG_25670220_091556.jpg', 4),
(15, '4_1715363018_2_IMG_25670220_093315.jpg', 4),
(16, '4_1715363018_3_Screenshot_25670220_131113.png', 4),
(17, '5_1715363199_0_IMG_25660918_103806.jpg', 5),
(18, '5_1715363199_1_IMG_25660918_103851.jpg', 5),
(19, '5_1715363199_2_IMG_25660918_103921.jpg', 5),
(20, '6_1715363305_0_IMG_25660918_102657.jpg', 6),
(21, '6_1715363305_1_IMG_25660918_102725.jpg', 6),
(22, '6_1715363305_2_IMG_25660918_102742.jpg', 6),
(23, '7_1715363365_0_IMG_5095.jpg', 7),
(24, '7_1715363365_1_IMG_5096.jpg', 7),
(25, '7_1715363365_2_IMG_5097.jpg', 7),
(26, '8_1715363417_0_IMG_5091.jpg', 8),
(27, '8_1715363417_1_IMG_5092.jpg', 8),
(28, '8_1715363417_2_IMG_5093.jpg', 8),
(29, '8_1715363417_3_IMG_5094.jpg', 8),
(30, '9_1715363469_0_IMG_5088.jpg', 9),
(31, '9_1715363469_1_IMG_5089.jpg', 9),
(32, '9_1715363469_2_IMG_5090.jpg', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`noti_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `worksite_id` (`worksite_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `noti_id` (`noti_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `worksite`
--
ALTER TABLE `worksite`
  ADD PRIMARY KEY (`worksite_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `worksite_image`
--
ALTER TABLE `worksite_image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `worksite_id` (`worksite_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `noti_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `worksite`
--
ALTER TABLE `worksite`
  MODIFY `worksite_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `worksite_image`
--
ALTER TABLE `worksite_image`
  MODIFY `img_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`worksite_id`) REFERENCES `worksite` (`worksite_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`noti_id`) REFERENCES `notification` (`noti_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worksite`
--
ALTER TABLE `worksite`
  ADD CONSTRAINT `worksite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worksite_image`
--
ALTER TABLE `worksite_image`
  ADD CONSTRAINT `worksite_image_ibfk_1` FOREIGN KEY (`worksite_id`) REFERENCES `worksite` (`worksite_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
