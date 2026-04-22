-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 05:12 AM
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
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_social_friends`
--

INSERT INTO `tbl_social_friends` (`fID`, `sID`, `rID`, `sname`, `spfp`, `status`) VALUES
(138, 23, 25, 'Swacha', 'megan.png', 'accepted'),
(139, 14, 25, 'Brotherman', 'Dental1.png', 'accepted'),
(141, 23, 16, 'Swacha', 'megan.png', 'pending'),
(142, 23, 24, 'Swacha', 'megan.png', 'pending'),
(143, 23, 8, 'Swacha', 'megan.png', 'pending');

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
  MODIFY `fID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
