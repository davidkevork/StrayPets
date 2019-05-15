-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: rds-db-master.cz05xyronygj.ap-southeast-2.rds.amazonaws.com
-- Generation Time: May 15, 2019 at 09:56 AM
-- Server version: 5.6.39
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messages`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `Id` bigint(10) NOT NULL,
  `FirstName` varchar(255) COLLATE utf8_bin NOT NULL,
  `LastName` varchar(255) COLLATE utf8_bin NOT NULL,
  `DOB` date NOT NULL,
  `Gender` varchar(10) COLLATE utf8_bin NOT NULL,
  `StreetAddress` varchar(255) COLLATE utf8_bin NOT NULL,
  `SuburbTown` varchar(255) COLLATE utf8_bin NOT NULL,
  `State` varchar(255) COLLATE utf8_bin NOT NULL,
  `PostCode` varchar(4) COLLATE utf8_bin NOT NULL,
  `EmailAddress` varchar(255) COLLATE utf8_bin NOT NULL,
  `PhoneNumber` varchar(10) COLLATE utf8_bin NOT NULL,
  `PetState` varchar(255) COLLATE utf8_bin NOT NULL,
  `Comment` longtext COLLATE utf8_bin NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(10) NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `Id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
