-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 09, 2024 at 11:44 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlycancuoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `cccd`
--

CREATE TABLE `cccd` (
  `stt_cccd` int NOT NULL,
  `id_cccd` varchar(12) NOT NULL,
  `name_cccd` varchar(200) DEFAULT NULL,
  `dob_cccd` date DEFAULT NULL,
  `sex_cccd` varchar(5) DEFAULT NULL,
  `nationality_cccd` varchar(100) DEFAULT NULL,
  `home_cccd` varchar(255) DEFAULT NULL,
  `address_cccd` varchar(255) DEFAULT NULL,
  `features_cccd` varchar(255) DEFAULT NULL,
  `issue_cccd` date DEFAULT NULL,
  `doe_cccd` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cccd`
--
ALTER TABLE `cccd`
  ADD PRIMARY KEY (`id_cccd`),
  ADD UNIQUE KEY `stt_cccd` (`stt_cccd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cccd`
--
ALTER TABLE `cccd`
  MODIFY `stt_cccd` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
