-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2019 at 09:07 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `errorlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `dp_log`
--

CREATE TABLE `dp_log` (
  `id` int(5) NOT NULL,
  `ApplicationName` varchar(75) NOT NULL,
  `Source` varchar(500) NOT NULL,
  `InstanceId` int(50) NOT NULL,
  `Message` varchar(1000) NOT NULL,
  `StackTrace` varchar(2000) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dp_log`
--

INSERT INTO `dp_log` (`id`, `ApplicationName`, `Source`, `InstanceId`, `Message`, `StackTrace`, `CreatedOn`) VALUES
(4, 'ABCD', 'ABCD Pade15 line 10', 1234, 'this is a test Error', 'Sample stack trace', '2019-09-18 00:00:01'),
(5, 'ABCD', 'ABCD Pade15 line 10', 1234, 'this is a test Error', 'Sample stack trace', '2019-09-18 01:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dp_log`
--
ALTER TABLE `dp_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dp_log`
--
ALTER TABLE `dp_log`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
