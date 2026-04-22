-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 01:42 PM
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
-- Table structure for table `tbl_social_messages`
--

CREATE TABLE `tbl_social_messages` (
  `messageID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `message` varchar(128) NOT NULL,
  `dateandtime` varchar(100) NOT NULL,
  `toUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_social_messages`
--

INSERT INTO `tbl_social_messages` (`messageID`, `userID`, `message`, `dateandtime`, `toUser`) VALUES
(9, 8, 'Hello Swachha', '23-08-2024 01:07:29', 7),
(10, 7, '              Hemmsodasd', '23-08-2024 01:14:22', 8),
(11, 7, '              jhsdjkasdas', '23-08-2024 01:14:30', 8),
(12, 8, 'yello', '23-08-2024 01:16:15', 7),
(13, 7, '              kjrkajdkasjd', '23-08-2024 01:16:42', 8),
(14, 7, '   HSAHDFJKHHSAF           ', '23-08-2024 01:20:31', 12),
(15, 7, '              SDASDASD', '23-08-2024 01:20:50', 12),
(16, 7, 'safdasdffas', '23-08-2024 01:21:50', 12),
(17, 7, 'safdasdffas', '23-08-2024 01:24:40', 12),
(18, 7, '              asfasf', '23-08-2024 01:24:43', 12),
(19, 7, '          jhjkdfashjkfhas    ', '23-08-2024 01:24:48', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_social_messages`
--
ALTER TABLE `tbl_social_messages`
  ADD PRIMARY KEY (`messageID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_social_messages`
--
ALTER TABLE `tbl_social_messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
