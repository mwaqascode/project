-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2024 at 07:39 PM
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
-- Database: `userdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `mobile`, `photo`) VALUES
(21, 'new man', 'new@users.com', '1234567890', 'b85809c5ca1c4d12d99a616cfae7ca83.jpg'),
(40, 'khanam', 'khanam@gmail.com', '5555555555', '60d7b0c52d28a77a436ee1c2c28ea7ad.jpg'),
(41, 'riya', 'riya@gmail.com', '8888888888', '2304c989a826275f8691444e44e936fc.jpg'),
(42, 'priya', 'priya@gmaim.com', '8588744651', '638cc648d2b5f0ec719722ea99611b82.jpg'),
(43, 'riya', 'riya@gmail.com', '6666666665', '373fa7e97d97400ecff92bd904d03c98.jpg'),
(44, 'dc', 'dc@gmail.com', '6666685468', 'fb813bdc1fb21c113f2eca4e3a990c13.jpg'),
(47, 'c', 'c@gmail.com', '5555555555', '031663e15ae6cfd19ddbed5dc5c8a9cc.jpg'),
(48, 'd', 'd@gmail.com', '3333333333', 'd3565a197bb9006a2ca9caab69de70ed.jpg'),
(49, 'd', 'd@gmail.com', '5555555555', 'a040360319b81914b9eea34fc6013fa4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
