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
-- Table structure for table `accounting_groups`
--

CREATE TABLE `accounting_groups` (
  `id` int(10) NOT NULL,
  `nature_of_group_id` int(10) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_groups`
--

INSERT INTO `accounting_groups` (`id`, `nature_of_group_id`, `name`, `parent_id`, `lft`, `rght`, `company_id`) VALUES
(1, 2, 'Branch / Divisions', NULL, 1, 2, 1),
(2, 2, 'Capital Account', NULL, 3, 6, 0),
(3, 1, 'Current Assets', NULL, 7, 20, 0),
(4, 2, 'Current Liabilities', NULL, 21, 28, 0),
(5, 4, 'Direct Expenses', NULL, 29, 30, 0),
(6, 3, 'Direct Incomes', NULL, 31, 32, 0),
(7, 1, 'Fixed Assets', NULL, 33, 34, 0),
(8, 4, 'Indirect Expenses', NULL, 35, 36, 0),
(9, 3, 'Indirect Incomes', NULL, 37, 38, 0),
(10, 1, 'Investments', NULL, 39, 40, 0),
(11, 2, 'Loans (Liability)', NULL, 41, 48, 0),
(12, 1, 'Misc. Expenses (ASSET)', NULL, 49, 50, 0),
(13, 4, 'Purchase Accounts', NULL, 51, 52, 0),
(14, 3, 'Sales Accounts', NULL, 53, 54, 0),
(15, 2, 'Suspense A/c', NULL, 55, 56, 0),
(16, NULL, 'Reserves & Surplus', 2, 4, 5, 1),
(17, NULL, 'Bank Accounts', 3, 8, 9, 1),
(18, NULL, 'Cash-in-hand', 3, 10, 11, 1),
(19, NULL, 'Deposits (Asset)', 3, 12, 13, 1),
(20, NULL, 'Loans & Advances (Asset)', 3, 14, 15, 1),
(21, NULL, 'Stock-in-hand', 3, 16, 17, 1),
(22, NULL, 'Sundry Debtors', 3, 18, 19, 1),
(23, NULL, 'Duties & Taxes', 4, 22, 23, 1),
(24, NULL, 'Provisions', 4, 24, 25, 1),
(25, NULL, 'Sundry Creditors', 4, 26, 27, 1),
(26, NULL, 'Bank OD A/c', 11, 42, 43, 1),
(27, NULL, 'Secured Loans', 11, 44, 45, 1),
(28, NULL, 'Unsecured Loans', 11, 46, 47, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_groups`
--
ALTER TABLE `accounting_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounting_groups`
--
ALTER TABLE `accounting_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
