-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2017 at 01:18 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `tax_type_rows`
--

CREATE TABLE `tax_type_rows` (
  `id` int(11) NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `tax_type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_type_rows`
--

INSERT INTO `tax_type_rows` (`id`, `tax_type_id`, `tax_type_name`) VALUES
(1, 1, '0% IGST'),
(2, 2, '0% CGST'),
(3, 2, '0% SGST'),
(4, 3, '5% IGST'),
(5, 4, '2.5% CGST'),
(6, 4, '2.5% SGST'),
(7, 5, '12% IGST'),
(8, 6, '6% CGST'),
(9, 6, '6% SGST'),
(10, 7, '18% IGST'),
(11, 8, '9% CGST'),
(12, 8, '9% SGST'),
(13, 9, '28% IGST'),
(14, 10, '14% CGST'),
(15, 10, '14% SGST');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tax_type_rows`
--
ALTER TABLE `tax_type_rows`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tax_type_rows`
--
ALTER TABLE `tax_type_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
