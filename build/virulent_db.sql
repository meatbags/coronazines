-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2020 at 05:51 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virulent_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(512) DEFAULT NULL,
  `role_nice_name` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_nice_name`) VALUES
(1, 'admin', 'Administrator'),
(2, 'editor', 'Editor');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  `user_name` varchar(500) DEFAULT NULL,
  `user_password` varchar(500) DEFAULT NULL,
  `user_created_at` int(11) DEFAULT NULL,
  `user_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_role_id`, `user_name`, `user_password`, `user_created_at`, `user_deleted`) VALUES
(1, 1, 'xavier', '$2y$10$crvWtoNLoEv8VDwLBDehV.uSPCKuzOhLB5x83MR91ltNFxye5cBzS', 1586073220, NULL),
(2, 2, 'meatbags', '$2y$10$cpnWRYqI7dQuHvjDWsx9FeuQ0ls1giSRxwIRH9V.m.oQQ2I2nHjhK', 1586132232, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `zine`
--

CREATE TABLE `zine` (
  `zine_id` int(11) NOT NULL,
  `zine_user_id` int(11) DEFAULT NULL,
  `zine_title` varchar(512) DEFAULT NULL,
  `zine_description` varchar(2048) DEFAULT NULL,
  `zine_author` varchar(512) DEFAULT NULL,
  `zine_ref` varchar(256) DEFAULT NULL,
  `zine_content` text,
  `zine_adult` tinyint(1) DEFAULT NULL,
  `zine_private` tinyint(1) DEFAULT NULL,
  `zine_protected` tinyint(1) DEFAULT NULL,
  `zine_password` varchar(512) DEFAULT NULL,
  `zine_created_at` int(11) DEFAULT NULL,
  `zine_updated_at` int(11) DEFAULT NULL,
  `zine_deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `zine`
--

INSERT INTO `zine` (`zine_id`, `zine_user_id`, `zine_title`, `zine_description`, `zine_author`, `zine_ref`, `zine_content`, `zine_adult`, `zine_private`, `zine_protected`, `zine_password`, `zine_created_at`, `zine_updated_at`, `zine_deleted`) VALUES
(1, 1, 'virulent', NULL, NULL, 'default', 'img/example/page_00.jpg;img/example/page_01.jpg;img/example/page_02.jpg;img/example/page_03.jpg;img/example/page_04.jpg;img/example/page_05.jpg;img/example/page_06.jpg;img/example/page_07.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'blank', NULL, NULL, 'blank', ';;;;;;;;;;;;;;;;;;;', NULL, NULL, 1, 'password', NULL, NULL, NULL),
(3, 1, 'lesbian nun pizza party', NULL, NULL, 'pizza', 'img/nuns/p0.jpg;\r\nimg/nuns/p6.jpg;\r\nimg/nuns/p1.jpg;\r\nimg/nuns/p2.jpg;\r\nimg/nuns/p7.jpg;\r\nimg/nuns/p5.jpg;\r\nimg/nuns/p3.jpg;\r\nimg/nuns/p8.jpg;\r\nimg/nuns/p9.jpg;\r\nimg/nuns/p4.jpg;', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `zine`
--
ALTER TABLE `zine`
  ADD PRIMARY KEY (`zine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zine`
--
ALTER TABLE `zine`
  MODIFY `zine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
