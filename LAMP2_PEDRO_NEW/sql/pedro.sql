-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2019 at 06:13 AM
-- Server version: 5.7.19
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pedro`
--
CREATE DATABASE IF NOT EXISTS `pedro` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pedro`;

-- --------------------------------------------------------

--
-- Table structure for table `begin_point_info`
--

DROP TABLE IF EXISTS `begin_point_info`;
CREATE TABLE `begin_point_info` (
  `pointID` int(11) NOT NULL,
  `fileID` int(11) DEFAULT NULL,
  `point1` decimal(4,2) NOT NULL,
  `point2` decimal(4,2) NOT NULL,
  `point3` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `begin_point_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `end_point_info`
--

DROP TABLE IF EXISTS `end_point_info`;
CREATE TABLE `end_point_info` (
  `pointID` int(11) NOT NULL,
  `fileID` int(11) DEFAULT NULL,
  `point1` decimal(4,2) NOT NULL,
  `point2` decimal(4,2) NOT NULL,
  `point3` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `end_point_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_info`
--

DROP TABLE IF EXISTS `file_info`;
CREATE TABLE `file_info` (
  `fileID` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_info`
--


-- --------------------------------------------------------

--
-- Table structure for table `main_data_info`
--

DROP TABLE IF EXISTS `main_data_info`;
CREATE TABLE `main_data_info` (
  `dataID` int(11) NOT NULL,
  `fileID` int(11) DEFAULT NULL,
  `distance` decimal(4,2) NOT NULL,
  `ground_height` decimal(4,2) NOT NULL,
  `terrain_type` varchar(50) NOT NULL,
  `obstruction_height` decimal(4,2) NOT NULL,
  `obstruction_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_data_info`
--



-- --------------------------------------------------------

--
-- Table structure for table `path_info`
--

DROP TABLE IF EXISTS `path_info`;
CREATE TABLE `path_info` (
  `pathID` int(11) NOT NULL,
  `fileID` int(11) DEFAULT NULL,
  `path_name` varchar(100) NOT NULL,
  `path_length` decimal(4,1) NOT NULL,
  `descrip` varchar(255) NOT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `path_info`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `begin_point_info`
--
ALTER TABLE `begin_point_info`
  ADD PRIMARY KEY (`pointID`),
  ADD KEY `fileID` (`fileID`);

--
-- Indexes for table `end_point_info`
--
ALTER TABLE `end_point_info`
  ADD PRIMARY KEY (`pointID`),
  ADD KEY `fileID` (`fileID`);

--
-- Indexes for table `file_info`
--
ALTER TABLE `file_info`
  ADD PRIMARY KEY (`fileID`),
  ADD UNIQUE KEY `file_name` (`file_name`);

--
-- Indexes for table `main_data_info`
--
ALTER TABLE `main_data_info`
  ADD PRIMARY KEY (`dataID`),
  ADD KEY `fileID` (`fileID`);

--
-- Indexes for table `path_info`
--
ALTER TABLE `path_info`
  ADD PRIMARY KEY (`pathID`),
  ADD UNIQUE KEY `path_name` (`path_name`),
  ADD KEY `fileID` (`fileID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `begin_point_info`
--
ALTER TABLE `begin_point_info`
  MODIFY `pointID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `end_point_info`
--
ALTER TABLE `end_point_info`
  MODIFY `pointID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `file_info`
--
ALTER TABLE `file_info`
  MODIFY `fileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `main_data_info`
--
ALTER TABLE `main_data_info`
  MODIFY `dataID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `path_info`
--
ALTER TABLE `path_info`
  MODIFY `pathID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `begin_point_info`
--
ALTER TABLE `begin_point_info`
  ADD CONSTRAINT `begin_point_info_ibfk_1` FOREIGN KEY (`fileID`) REFERENCES `file_info` (`fileID`);

--
-- Constraints for table `end_point_info`
--
ALTER TABLE `end_point_info`
  ADD CONSTRAINT `end_point_info_ibfk_1` FOREIGN KEY (`fileID`) REFERENCES `file_info` (`fileID`);

--
-- Constraints for table `main_data_info`
--
ALTER TABLE `main_data_info`
  ADD CONSTRAINT `main_data_info_ibfk_1` FOREIGN KEY (`fileID`) REFERENCES `file_info` (`fileID`);

--
-- Constraints for table `path_info`
--
ALTER TABLE `path_info`
  ADD CONSTRAINT `path_info_ibfk_1` FOREIGN KEY (`fileID`) REFERENCES `file_info` (`fileID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;