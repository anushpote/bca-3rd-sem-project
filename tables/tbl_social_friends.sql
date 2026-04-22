-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 02:25 PM
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
-- Table structure for table `tbl_social_friends`
--

CREATE TABLE `tbl_social_friends` (
  `fID` int(11) NOT NULL,
  `sID` int(11) NOT NULL,
  `rID` int(11) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `spfp` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` enum('accepted','pending','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_social_friends`
--

INSERT INTO `tbl_social_friends` (`fID`, `sID`, `rID`, `sname`, `spfp`, `status`) VALUES
(18, 24, 23, 'friend', '', 'pending'),
(19, 23, 24, 'Swacha', 'megan.png', 'pending'),
(20, 23, 7, 'Swacha', 'megan.png', 'pending'),
(21, 23, 8, 'Swacha', 'megan.png', 'pending'),
(22, 14, 24, 'Brotherman', 'Dental1.png', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_social_friends`
--
ALTER TABLE `tbl_social_friends`
  ADD PRIMARY KEY (`fID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_social_friends`
--
ALTER TABLE `tbl_social_friends`
  MODIFY `fID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
