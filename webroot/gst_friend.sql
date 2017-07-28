-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2017 at 08:22 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

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
-- Table structure for table `accounting_groups`
--

CREATE TABLE `accounting_groups` (
  `id` int(10) NOT NULL,
  `nature_of_group_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_groups`
--

INSERT INTO `accounting_groups` (`id`, `nature_of_group_id`, `name`, `parent_id`, `lft`, `rght`) VALUES
(1, 2, 'Branch / Divisions', NULL, 1, 2),
(2, 2, 'Capital Account', NULL, 3, 6),
(3, 0, 'Reserves & Surplus', 2, 4, 5),
(4, 1, 'Current Assets', NULL, 7, 12),
(5, 0, 'Bank Accounts', 4, 8, 9),
(6, 0, 'Cash-in-hand', 4, 10, 11),
(7, 2, 'Current Liabilities', NULL, 13, 18),
(8, 4, 'Direct Expenses', NULL, 19, 20),
(9, 3, 'Direct Incomes', NULL, 21, 22),
(10, 0, 'Duties & Taxes', 7, 14, 17),
(11, 0, 'Output GST', 10, 15, 16);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`) VALUES
(1, 'phppoets');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `freezed` tinyint(1) NOT NULL COMMENT '0==not freezed  1==freezed',
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`, `freezed`, `company_id`) VALUES
(1, 'anil gurjar', '9462952929', 'anilgurjer371@gmail.com', 'balicha', 0, 1),
(2, 'abhilash ji', '8963023698', 'ajad@gmail.com', 'balicha', 1, 1),
(3, 'ajad ', '8963023698', 'ajad123@gmail.com', 'balicha', 1, 1),
(4, 'anil', '8949998165', 'ftyftyu@vghvh.com', 'gyvvbjkb', 1, 1),
(5, 'dqwudfqd', '4561616121', '3iwfwb@bhjbc.com', 'cbscbhhj', 0, 1),
(6, 'dqwudfqd', '4561616121', '3iwfwb@bhjbc.comq', 'cbscbhhj', 0, 1),
(7, 'dqwudfqd', '4561616121', '3iwfwb@bhjbc.comqgh', 'cbscbhhj', 0, 1),
(8, 'sgcyuascg7', '4984966498', 'quiccc@icuwuic.com', 'ucbhuwsbchj xjq', 1, 1),
(9, 'ascvuau', '5984916314', 'bchjbu@huibcuas.com', 'nsuabfauidja', 1, 1),
(10, 'fbdsajfbdsjkam', '5616366532', 'nfjknwfqk@giegrnsdk.com', 'nfwjfnwdksa', 1, 0),
(11, 'hdsuighdsuifhkovjdsuihcsdiucskxjk', '9841549635', 'scuisj@ifnwik.com', 'fwuivfndsiacfscdsjik', 1, 1),
(12, 'fqwugqhqeuifqwoejqwfu', '9461498613', 'FJODAOI@EFOIEFLW.COM', 'coaisfnasdofakfnaia', 1, 1),
(13, 'ffh', '4656464666', 'fwifhihi@ncdsvjk.com', 'fhifsasj', 1, 1),
(14, 'aaaaa', '9999999999', 'aaaaa@sdf.com', 'dasdacdas', 1, 1),
(15, 'ffffffff', '7897897897', 'ddsdsds@sgdg.com', 'hhhghghghj', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hsn_code` varchar(20) NOT NULL,
  `freezed` tinyint(1) NOT NULL COMMENT '0==not freezed 1==freezed',
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `hsn_code`, `freezed`, `company_id`) VALUES
(1, 'stl', '123456', 1, 1),
(2, 'anil', 'fjeoifjwe90324', 0, 1),
(3, 'safsa', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ledgers`
--

CREATE TABLE `ledgers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `accounting_group_id` int(10) NOT NULL,
  `freeze` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledgers`
--

INSERT INTO `ledgers` (`id`, `name`, `accounting_group_id`, `freeze`) VALUES
(1, 'test ledger 1', 4, 0),
(2, 'SBBJ Bank', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ledger_accounts`
--

CREATE TABLE `ledger_accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `freezed` tinyint(1) NOT NULL COMMENT '0==not freezed 1==freezed',
  `company_id` int(15) NOT NULL,
  `supplier_id` int(15) NOT NULL,
  `customer_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledger_accounts`
--

INSERT INTO `ledger_accounts` (`id`, `name`, `freezed`, `company_id`, `supplier_id`, `customer_id`) VALUES
(1, 'anil gurjar', 0, 1, 0, 5),
(2, 'dqwudfqd', 0, 1, 0, 7),
(3, 'sgcyuascg7', 1, 1, 0, 8),
(4, 'ascvuau', 1, 1, 0, 9),
(5, 'hdsuighdsuifhkovjdsuihcsdiucskxjk', 1, 1, 0, 11),
(6, 'fqwugqhqeuifqwoejqwfuidfhq', 1, 1, 0, 12),
(7, 'dyuhlvfujfwuihd', 1, 1, 2, 0),
(8, 'jsan', 0, 1, 3, 0),
(9, 'aaaaaaaaaaaaaaa', 1, 1, 0, 0),
(10, 'ffffffff', 1, 1, 0, 0),
(11, 'sadas', 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nature_of_groups`
--

CREATE TABLE `nature_of_groups` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nature_of_groups`
--

INSERT INTO `nature_of_groups` (`id`, `name`) VALUES
(1, 'Assets'),
(2, 'Liabilities'),
(3, 'Income'),
(4, 'Expenses');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `freezed` tinyint(1) NOT NULL COMMENT '0==not freezed  1==freezed',
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `email`, `address`, `freezed`, `company_id`) VALUES
(2, 'dyuhlvfujfwuihd', '4618965384', 'asda@wfeowi.com', 'foiewfnqewks', 1, 1),
(3, 'jsan', 'lkj', 'lk@lkjlklk.dfds', 'sdsad', 0, 1),
(4, 'aaaaasssss', '7894561237', 'ddddd@gmaail.com', 'ytrftyy', 1, 1),
(5, 'aaaaaaaaaaaaaaa', '7987897989', 'avgzv@bhvbh.com', 'yvghh', 0, 1),
(6, 'sadas', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `company_id`) VALUES
(2, 'Abhilash Lohar', 'hello', '$2y$10$5lD5bEZOEf6Gv5s50XEEYu352BwMCw2BrLIh.dIBV5uDcSLGghV4a', 1),
(3, 'anil', 'admin', '5d41402abc4b2a76b9719d911017c592', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_groups`
--
ALTER TABLE `accounting_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledger_accounts`
--
ALTER TABLE `ledger_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nature_of_groups`
--
ALTER TABLE `nature_of_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_groups`
--
ALTER TABLE `accounting_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ledger_accounts`
--
ALTER TABLE `ledger_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `nature_of_groups`
--
ALTER TABLE `nature_of_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
