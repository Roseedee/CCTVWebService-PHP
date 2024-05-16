-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 05:29 PM
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
(1, 'yalanetcom', '12345', 'admin', '2024-05-16 15:28:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `noti_id` int(10) NOT NULL,
  `notification` varchar(255) NOT NULL,
  `img_name` varchar(10) DEFAULT NULL,
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
(1, 'YALANETCOM', '0826537095', 'vernerlive.090@gmail.com', 'ปัตตานี ประเทศไทย', 'png');

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
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `worksite`
--
ALTER TABLE `worksite`
  MODIFY `worksite_id` int(10) NOT NULL AUTO_INCREMENT;

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
