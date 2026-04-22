-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 05:43 PM
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
-- Database: `college`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book`
--

CREATE TABLE `tbl_book` (
  `book_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(155) DEFAULT NULL,
  `author` varchar(55) DEFAULT NULL,
  `qunatity` int(11) DEFAULT NULL,
  `price` float(20,1) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_book`
--

INSERT INTO `tbl_book` (`book_id`, `category_id`, `name`, `author`, `qunatity`, `price`, `status`) VALUES
(1, 1, 'Basic Math', 'M Ardirn', 30, 450.0, 'Active'),
(2, 1, 'Probability Math', 'M Ardirn', 20, 40.0, 'Active'),
(3, 2, 'Physics', 'M Admin', 20, 400.0, 'Active'),
(4, 2, 'Chemistry', 'M Admin', 40, 420.0, 'Active'),
(5, 3, 'Litrature English', 'Husan', 55, 320.0, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_book_category`
--

CREATE TABLE `tbl_book_category` (
  `book_category_id` int(11) NOT NULL,
  `title` varchar(155) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_book_category`
--

INSERT INTO `tbl_book_category` (`book_category_id`, `title`, `status`) VALUES
(1, 'Mathematics', NULL),
(2, 'Science', NULL),
(3, 'English', NULL),
(4, 'IT', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(155) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `username`, `gender`, `email`, `password`) VALUES
(4, 'Ganesh Gautam', 'ganesh122', 'Male', 'ganesh22@gmail.com', ''),
(7, 'Soyuz Nepal', '385114', 'Male', 'soyuz@gmail.com', '234234'),
(11, 'Anush', NULL, NULL, 'anush@gmail.com', NULL),
(12, 'Surav', NULL, NULL, 'surav@gmail.com', NULL),
(13, 'Swachha', NULL, NULL, 'swachha@gmail.com', NULL),
(14, 'Utprechhya', NULL, NULL, 'ut@gmail.com', NULL),
(15, 'Swachha', NULL, NULL, 'aman@gmail.com', NULL),
(16, 'Diksha', NULL, NULL, 'diksha@gmail.com', NULL),
(17, 'Nasala', NULL, NULL, 'nasala@gmail.com', NULL),
(21, 'sdf', 'sdfsdf', 'Male', 'aman@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_book_category`
--
ALTER TABLE `tbl_book_category`
  ADD PRIMARY KEY (`book_category_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_book`
--
ALTER TABLE `tbl_book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_book_category`
--
ALTER TABLE `tbl_book_category`
  MODIFY `book_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_book`
--
ALTER TABLE `tbl_book`
  ADD CONSTRAINT `tbl_book_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_book_category` (`book_category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
