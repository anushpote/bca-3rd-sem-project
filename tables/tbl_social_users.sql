-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2024 at 07:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social_users`
--

CREATE TABLE `tbl_social_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `filename` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `address` varchar(50) NOT NULL,
  `joined` varchar(50) NOT NULL,
  `background` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `about` varchar(100) NOT NULL,
  `web` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_social_users`
--

INSERT INTO `tbl_social_users` (`id`, `username`, `email`, `password`, `filename`, `address`, `joined`, `background`, `about`, `web`) VALUES
(7, 'Swachha', 'baidyaswachha@gmail.com', '482c811da5d5b4bc6d497ffa98491e38', 'cameron.png', 'Chakupat, Lalitpur', '18-08-2024', 'thumbnail4.png', 'My name Jeff. I am from the thing', ''),
(8, 'Sahaj Man', 'Sahaj@gmail.com', 'b20505f7d91c9c6039ae837ad18fc45b', 'tom.png', 'Patan Dhoka, Lalitpur', '18-08-2024', 'thumbnail7.png', 'I am sahaj and I like to code', ''),
(12, 'Dummy', 'dummy@gmail.com', '1d153e08196eec6495edb16ecff25220', 'gerard.png', 'dumville', '19-08-2024', '', 'My name is Dummy', 'shopocalypse.atwebpa'),
(13, 'Anush', 'anushpote@gmail.com', 'e50e379a06990a84578348176326ce98', 'simon.png', 'Banepa', '19-08-2024', 'thumbnail2.png', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_social_users`
--
ALTER TABLE `tbl_social_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_social_users`
--
ALTER TABLE `tbl_social_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
