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
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `id` int(11) NOT NULL,
  `content` varchar(100) NOT NULL,
  `filename` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `user` varchar(50) NOT NULL,
  `postTime` varchar(50) NOT NULL,
  `pfp` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`id`, `content`, `filename`, `user`, `postTime`, `pfp`, `likes`) VALUES
(83, 'Hello I am Sahaj. This is my Lamborgini', 'thumbnail8.png', 'Sahaj Man', '19-08-2024 01:45:18', 'tom.png', 3),
(86, 'These are things', 'thumbnail3.png', 'Swachha', '19-08-2024 05:54:00', 'cameron.png', 0),
(87, 'New feature added', '', 'Swachha', '19-08-2024 06:20:43', 'cameron.png', 0),
(88, 'Notes', 'cameron.png', 'Swachha', '19-08-2024 06:34:21', 'cameron.png', 0),
(89, 'Notes full', 'screencapture-file-C-xampp-htdocs-Assignment-1-github-onepage-index-html-2024-05-10-11_23_42.png', 'Swachha', '19-08-2024 06:38:52', 'cameron.png', 0),
(90, 'This is awesome.', 'screencapture-file-E-Web-Practise-Prac-3-index-html-2024-05-12-13_56_08.png', 'Swachha', '19-08-2024 06:40:23', 'cameron.png', 0),
(91, 'First video', 'video.mp4', 'Swachha', '19-08-2024 06:51:02', 'cameron.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
