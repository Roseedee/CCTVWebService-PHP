-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2024 at 06:18 PM
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
(1, 'yalanetcom', '12345', 'admin', '2024-05-02 08:21:00', 1),
(2, 'testadmin', '12345', 'admin', '2024-05-02 08:22:09', 2),
(3, 'user1', '12345', 'customer', '2024-05-02 08:30:15', 3),
(5, 'user2', '12345', 'customer', '2024-05-02 09:32:02', 4),
(6, 'user3', '12345', 'customer', '2024-05-02 09:32:20', 5),
(7, 'user', '12345', 'customer', '2024-05-05 16:42:16', 6),
(8, 'testaccount', '1345', 'customer', '2024-05-05 16:43:31', 7),
(9, 'asdf', '', 'customer', '2024-05-06 15:46:00', 8),
(10, 'asdf', 'asdf', 'customer', '2024-05-06 16:01:48', 9),
(11, 'asdf', 'asdf', 'customer', '2024-05-06 16:03:29', 10),
(12, 'asdf', 'asdf', 'customer', '2024-05-06 16:03:50', 11),
(13, 'asdf', 'asdf', 'customer', '2024-05-06 16:04:00', 12),
(14, 'asdf', 'asdf', 'customer', '2024-05-06 16:12:03', 13),
(15, 'hawanee', '12345', 'customer', '2024-05-07 14:28:03', 14),
(16, 'asdf', 'asdf', 'customer', '2024-05-07 15:16:10', 15),
(17, 'asdf', '', 'customer', '2024-05-08 14:41:44', 16),
(18, 'asdf', 'asdf', 'customer', '2024-05-08 14:43:18', 17),
(19, 'asdf', 'asdf', 'customer', '2024-05-08 14:45:30', 18),
(20, 'asdf', 'asdf', 'customer', '2024-05-08 15:15:27', 19);

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

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`noti_id`, `notification`, `img_type`, `noti_datetime`, `noti_status`, `user_id`, `worksite_id`) VALUES
(1, 'กล้องหลังบ้านเสียครับ', NULL, '2024-05-02 10:02:31', 0, 3, 1),
(2, 'กล้องหน้าบ้านมันติดๆดับๆ', NULL, '2024-05-02 10:06:16', 0, 4, 5),
(3, 'เครื่องบันทึกมีเสียงบีบๆ', NULL, '2024-05-02 10:10:01', 0, 5, 4),
(4, 'กล้องดูย้อนหลังไม่ได้', NULL, '2024-05-02 11:00:13', 0, 3, 1),
(5, 'เน็ตหลุด', NULL, '2024-05-02 11:01:29', 0, 5, 4),
(7, 'wdssadfas', NULL, '2024-05-02 11:20:52', 0, 3, 1),
(8, 'efgsdfg', NULL, '2024-05-06 16:41:05', 0, 4, 3);

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

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_details`, `service_datetime`, `noti_id`) VALUES
(1, 'ซ่อมกล้องวงจรปิดหลังบ้าน', '2024-05-01', 1),
(2, 'ซ่อมสายไฟสายไฟมีปัญหา', '2024-05-08', 2),
(3, 'เปลี่ยนถ่านนาฬิกา', '2024-05-10', 3),
(4, 'วฟสหกา่ดฟหก', '2024-05-31', 4),
(5, 'ฟหกดฟห', '2024-05-01', 5),
(7, 'sdfasdf', '2024-06-29', 7),
(8, 'asdfasdf', '2024-05-09', 8);

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
(1, 'Abdullah Chemae', '0826537095', 'vernerlive.090@gmail.com', 'ยะลา ประเทศไทย', NULL),
(2, 'UserTest Admin', '9876543210', 'testemailadmin@gmail.com', 'สงขลา ประเทศไทย', NULL),
(3, 'ลูกค้าทดลอง คนที่1', '0123456789', 'testemail123@gmail.com', 'ปัตตานี ประเทศไทย', NULL),
(4, 'ลูกค้าทดลอง คนที่2', '9876543210', 'testemail123@gmail.com', 'ปัตตานี ประเทศไทย', NULL),
(5, 'ลูกค้าทดลอง คนที่3', '0123456789', 'testemail123@gmail.com', 'ปัตตานี ประเทศไทย', NULL),
(6, 'ลูกค้าทดลอง', '132456', 'test@gmail.com', 'ประเทศไทย', NULL),
(7, 'เทสลูกค้า', '13245678', 'customertest@gmail.com', 'กทม ประเทศไทย', 'jpg'),
(8, 'asdf', 'dfa', 'sdf', 'asdf', 'jpg'),
(9, 'asdf', 'asdf', 'asdf', 'asdf', NULL),
(10, 'asdf', 'asdf', 'asd', 'fasdf', NULL),
(11, 'asdf', 'asdf', 'asd', 'fasdf', 'jpg'),
(12, 'asdf', 'asdf', 'asd', 'fasdf', 'jpg'),
(13, 'asdf', 'asdf', 'asdf', 'asdf', 'jpg'),
(14, 'Hawanee baheng', '6544654', 'asdfasdf', 'asdf', 'jpg'),
(15, 'asdf', 'asdf', 'asdf', 'asdf', 'jpg'),
(16, 'asdf', 'asdf', 'as', 'dasdff', 'jpg'),
(17, 'asdf', 'asdf', 'asd', 'asdf', 'png'),
(18, 'asdf', 'asdf', 'asd', 'fasd', NULL),
(19, 'asdf', 'asdf', 'asd', 'fasdf', NULL);

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
(1, 'หน้างานที่1', 'ยะลา ประเทศไทย', 16, '2021-05-19', NULL, 3),
(3, 'หน้างานที่1', 'ปัตตานี ประเทศไทย', 4, '2024-05-09', NULL, 4),
(4, 'หน้างานที่1', 'ยะลา ประเทศไทย', 8, '2019-05-30', NULL, 5),
(5, 'หน้างานที่2', 'ปัตตานี ประเทศไทย', 32, '2024-05-18', NULL, 4),
(6, 'บ้านพ่อ', 'ยะลา ประเทศไทย', 16, '2019-05-24', 'เปลี่ยนกล้องเดิมใส่ชุดใหม่', 7),
(7, 'บ้านแม่', 'สงขลา ประเทศไทย', 8, '2024-05-01', 'งานปรับปรุ่ง', 14),
(8, 'บ้านยาย', 'ปัตตานี ประเทศไทย', 32, '2021-05-26', NULL, 14);

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
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `noti_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `worksite`
--
ALTER TABLE `worksite`
  MODIFY `worksite_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `worksite_image`
--
ALTER TABLE `worksite_image`
  MODIFY `img_id` int(10) NOT NULL AUTO_INCREMENT;

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
