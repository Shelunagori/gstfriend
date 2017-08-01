-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2017 at 08:17 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gst_friend`
--

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `accounting_group_id` int(10) NOT NULL,
  `freeze` tinyint(1) NOT NULL COMMENT '0==unfreezed 1==freezed',
  `company_id` int(10) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledgers`
--

INSERT INTO `ledgers` (`id`, `name`, `accounting_group_id`, `freeze`, `company_id`, `supplier_id`, `customer_id`) VALUES
(1, 'bsvhjdsbj', 1, 0, 1, 0, 0),
(2, 'bmm,mmmm', 1, 0, 1, 0, 2),
(3, 'bmm,mmmm', 1, 0, 1, 0, 0),
(4, 'aaaaaaaaaaaaaa', 2, 0, 1, 0, 3),
(5, 'aaaaaaaaaaaaaa', 2, 0, 1, 0, 0),
(6, 'sssss', 13, 0, 1, 0, 4),
(7, 'cvbcvb', 25, 0, 1, 2, 0),
(8, 'anill', 13, 0, 1, 3, 0),
(9, 'anil gurjar', 0, 0, 1, 0, 5),
(10, 'abhilash ji', 25, 0, 1, 4, 0),
(11, 'retailor', 13, 0, 1, 0, 6),
(12, 'retailor', 13, 0, 1, 0, 7),
(13, 'vhjvhjm', 13, 1, 1, 0, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
