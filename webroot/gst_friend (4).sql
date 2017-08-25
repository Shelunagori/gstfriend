-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2017 at 03:46 PM
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
-- Table structure for table `accounting_entries`
--

CREATE TABLE `accounting_entries` (
  `id` int(11) NOT NULL,
  `ledger_id` int(10) NOT NULL,
  `debit` decimal(12,2) NOT NULL,
  `credit` decimal(15,2) NOT NULL,
  `transaction_date` date NOT NULL,
  `purchase_voucher_id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `invoice_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_entries`
--

INSERT INTO `accounting_entries` (`id`, `ledger_id`, `debit`, `credit`, `transaction_date`, `purchase_voucher_id`, `company_id`, `invoice_id`) VALUES
(1, 35, '0.00', '1000.00', '2017-08-23', 1, 1, 0),
(2, 3, '892.86', '0.00', '2017-08-23', 1, 1, 0),
(3, 41, '107.14', '0.00', '2017-08-23', 1, 1, 0),
(4, 5, '500.00', '0.00', '2017-08-23', 1, 1, 0),
(5, 10, '500.00', '0.00', '2017-08-23', 1, 1, 0),
(6, 41, '200.00', '0.00', '2017-08-23', 1, 1, 0),
(7, 37, '0.00', '5000.00', '2017-08-23', 1, 1, 0),
(8, 3, '3800.00', '0.00', '2017-08-23', 1, 1, 0),
(9, 41, '200.00', '0.00', '2017-08-23', 1, 1, 0),
(10, 5, '500.00', '0.00', '2017-08-23', 1, 1, 0),
(11, 10, '500.00', '0.00', '2017-08-23', 1, 1, 0),
(12, 6, '250.00', '0.00', '2017-08-23', 1, 1, 0),
(13, 12, '250.00', '0.00', '2017-08-23', 1, 1, 0),
(14, 37, '0.00', '5000.00', '2017-08-23', 1, 1, 0),
(15, 3, '3300.00', '0.00', '2017-08-23', 1, 1, 0),
(16, 41, '1000.00', '0.00', '2017-08-24', 2, 1, 0),
(17, 6, '100.00', '0.00', '2017-08-24', 2, 1, 0),
(18, 12, '100.00', '0.00', '2017-08-24', 2, 1, 0),
(19, 52, '0.00', '2500.00', '2017-08-24', 2, 1, 0),
(20, 3, '1300.00', '0.00', '2017-08-24', 2, 1, 0),
(21, 34, '200.00', '0.00', '2017-08-24', 0, 1, 1),
(22, 24, '0.00', '4.76', '2017-08-24', 0, 1, 1),
(23, 20, '0.00', '4.76', '2017-08-24', 0, 1, 1),
(24, 34, '500.00', '0.00', '2017-08-24', 0, 1, 2),
(25, 46, '0.00', '53.57', '2017-08-24', 0, 1, 2),
(26, 34, '700.00', '0.00', '2017-08-24', 0, 1, 2),
(27, 23, '0.00', '0.00', '2017-08-24', 0, 1, 2),
(28, 19, '0.00', '0.00', '2017-08-24', 0, 1, 2),
(29, 24, '0.00', '4.76', '2017-08-24', 0, 1, 2),
(30, 20, '0.00', '4.76', '2017-08-24', 0, 1, 2),
(31, 41, '1000.00', '0.00', '2017-08-24', 2, 1, 0),
(32, 6, '100.00', '0.00', '2017-08-24', 2, 1, 0),
(33, 12, '100.00', '0.00', '2017-08-24', 2, 1, 0),
(34, 5, '50.00', '0.00', '2017-08-24', 2, 1, 0),
(35, 10, '50.00', '0.00', '2017-08-24', 2, 1, 0),
(36, 52, '0.00', '2500.00', '2017-08-24', 2, 1, 0),
(37, 3, '1200.00', '0.00', '2017-08-24', 2, 1, 0),
(38, 41, '1000.00', '0.00', '2017-08-24', 2, 1, 0),
(39, 6, '100.00', '0.00', '2017-08-24', 2, 1, 0),
(40, 12, '100.00', '0.00', '2017-08-24', 2, 1, 0),
(41, 5, '50.00', '0.00', '2017-08-24', 2, 1, 0),
(42, 10, '50.00', '0.00', '2017-08-24', 2, 1, 0),
(43, 7, '250.00', '0.00', '2017-08-24', 2, 1, 0),
(44, 13, '250.00', '0.00', '2017-08-24', 2, 1, 0),
(45, 52, '0.00', '2500.00', '2017-08-24', 2, 1, 0),
(46, 3, '700.00', '0.00', '2017-08-24', 2, 1, 0),
(47, 41, '1000.00', '0.00', '2017-08-24', 2, 1, 0),
(48, 6, '100.00', '0.00', '2017-08-24', 2, 1, 0),
(49, 12, '100.00', '0.00', '2017-08-24', 2, 1, 0),
(50, 5, '50.00', '0.00', '2017-08-24', 2, 1, 0),
(51, 10, '50.00', '0.00', '2017-08-24', 2, 1, 0),
(52, 7, '250.00', '0.00', '2017-08-24', 2, 1, 0),
(53, 13, '250.00', '0.00', '2017-08-24', 2, 1, 0),
(54, 43, '600.00', '0.00', '2017-08-24', 2, 1, 0),
(55, 52, '0.00', '2500.00', '2017-08-24', 2, 1, 0),
(56, 3, '100.00', '0.00', '2017-08-24', 2, 1, 0),
(57, 41, '200.00', '0.00', '2017-08-24', 1, 1, 0),
(58, 5, '500.00', '0.00', '2017-08-24', 1, 1, 0),
(59, 10, '500.00', '0.00', '2017-08-24', 1, 1, 0),
(60, 6, '250.00', '0.00', '2017-08-24', 1, 1, 0),
(61, 12, '250.00', '0.00', '2017-08-24', 1, 1, 0),
(62, 40, '100.00', '0.00', '2017-08-24', 1, 1, 0),
(63, 37, '0.00', '5000.00', '2017-08-24', 1, 1, 0),
(64, 3, '3200.00', '0.00', '2017-08-24', 1, 1, 0),
(65, 35, '0.00', '1123.00', '2017-08-24', 2, 1, 0),
(66, 3, '1069.52', '0.00', '2017-08-24', 2, 1, 0),
(67, 40, '53.48', '0.00', '2017-08-24', 2, 1, 0),
(68, 34, '200.00', '0.00', '2017-08-24', 0, 1, 3),
(69, 18, '0.00', '190.48', '2017-08-24', 0, 1, 3),
(70, 24, '0.00', '4.76', '2017-08-24', 0, 1, 3),
(71, 20, '0.00', '4.76', '2017-08-24', 0, 1, 3),
(72, 5, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(73, 10, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(74, 41, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(75, 37, '0.00', '5000.00', '2017-08-24', 1, 1, 0),
(76, 3, '2000.00', '0.00', '2017-08-24', 1, 1, 0),
(77, 41, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(78, 5, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(79, 10, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(80, 7, '100.00', '0.00', '2017-08-24', 1, 1, 0),
(81, 13, '100.00', '0.00', '2017-08-24', 1, 1, 0),
(82, 37, '0.00', '5000.00', '2017-08-24', 1, 1, 0),
(83, 3, '1800.00', '0.00', '2017-08-24', 1, 1, 0),
(84, 41, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(85, 5, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(86, 10, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(87, 7, '100.00', '0.00', '2017-08-24', 1, 1, 0),
(88, 13, '100.00', '0.00', '2017-08-24', 1, 1, 0),
(89, 37, '0.00', '5000.00', '2017-08-24', 1, 1, 0),
(90, 3, '1800.00', '0.00', '2017-08-24', 1, 1, 0),
(91, 41, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(92, 41, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(93, 41, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(94, 41, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(95, 5, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(96, 10, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(97, 10, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(98, 5, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(99, 10, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(100, 41, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(101, 37, '0.00', '5000.00', '2017-08-24', 1, 1, 0),
(102, 3, '2000.00', '0.00', '2017-08-24', 1, 1, 0),
(103, 41, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(104, 5, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(105, 10, '1000.00', '0.00', '2017-08-24', 1, 1, 0),
(106, 7, '500.00', '0.00', '2017-08-24', 1, 1, 0),
(107, 13, '500.00', '0.00', '2017-08-24', 1, 1, 0),
(108, 37, '0.00', '5000.00', '2017-08-24', 1, 1, 0),
(109, 3, '1000.00', '0.00', '2017-08-24', 1, 1, 0);

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
  `company_id` int(10) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounting_groups`
--

INSERT INTO `accounting_groups` (`id`, `nature_of_group_id`, `name`, `parent_id`, `lft`, `rght`, `company_id`, `status`) VALUES
(1, 2, 'Branch / Divisions', NULL, 1, 2, 1, 0),
(2, 2, 'Capital Account', NULL, 3, 6, 1, 0),
(3, 1, 'Current Assets', NULL, 7, 20, 1, 0),
(4, 2, 'Current Liabilities', NULL, 21, 32, 1, 0),
(5, 4, 'Direct Expenses', NULL, 33, 34, 1, 0),
(6, 3, 'Direct Incomes', NULL, 35, 36, 1, 0),
(7, 1, 'Fixed Assets', NULL, 37, 38, 1, 0),
(8, 4, 'Indirect Expenses', NULL, 39, 40, 1, 0),
(9, 3, 'Indirect Incomes', NULL, 41, 42, 1, 0),
(10, 1, 'Investments', NULL, 43, 44, 1, 0),
(11, 2, 'Loans (Liability)', NULL, 45, 52, 1, 0),
(12, 1, 'Misc. Expenses (ASSET)', NULL, 53, 54, 1, 0),
(13, 4, 'Purchase Accounts', NULL, 55, 56, 1, 0),
(14, 3, 'Sales Accounts', NULL, 57, 58, 1, 0),
(15, 2, 'Suspense A/c', NULL, 59, 60, 1, 0),
(16, NULL, 'Reserves & Surplus', 2, 4, 5, 1, 0),
(17, NULL, 'Bank Accounts', 3, 8, 9, 1, 0),
(18, NULL, 'Cash-in-hand', 3, 10, 11, 1, 0),
(19, NULL, 'Deposits (Asset)', 3, 12, 13, 1, 0),
(20, NULL, 'Loans & Advances (Asset)', 3, 14, 15, 1, 0),
(21, NULL, 'Stock-in-hand', 3, 16, 17, 1, 0),
(22, NULL, 'Sundry Debtors', 3, 18, 19, 1, 0),
(23, NULL, 'Duties & Taxes', 4, 22, 27, 1, 0),
(24, NULL, 'Provisions', 4, 28, 29, 1, 0),
(25, NULL, 'Sundry Creditors', 4, 30, 31, 1, 0),
(26, NULL, 'Bank OD A/c', 11, 46, 47, 1, 0),
(27, NULL, 'Secured Loans', 11, 48, 49, 1, 0),
(28, NULL, 'Unsecured Loans', 11, 50, 51, 1, 0),
(29, NULL, 'Input GST', 23, 23, 24, 1, 0),
(30, NULL, 'Output GST', 23, 25, 26, 1, 0),
(31, NULL, 'Petty Cash', 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `logo` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `state` varchar(25) NOT NULL,
  `phone_no` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `address`, `logo`, `district`, `state`, `phone_no`) VALUES
(1, 'phppoets', 'subhash nagar sevasram', 'f.png', 'udaipur', 'rajasthan', 1234567891),
(2, 'phppoets123', 'subhash nagar sevasram', 'f.jpg', 'udaipur123', 'rajasthan123', 12345678),
(3, 'Demo IT Solutions Pvt Ltd', 'subhash nagar sevasram', 'f.jpg', 'udaipur123', 'rajasthan123', 12345678);

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
  `state` varchar(100) NOT NULL,
  `freezed` tinyint(1) NOT NULL COMMENT '0==not freezed  1==freezed',
  `company_id` int(11) NOT NULL,
  `gstno` varchar(100) DEFAULT NULL,
  `status` int(5) NOT NULL COMMENT '0==not delete, 1==delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`, `state`, `freezed`, `company_id`, `gstno`, `status`) VALUES
(1, 'customer1', '1234567891', 'customer1@gmail.com', 'xyz', 'raj', 0, 1, 'gst003', 0),
(2, 'customer2', '4654564564', 'customer2@gmail.com', 'abc', '', 0, 1, 'gst1', 0),
(3, 'customer3', '4464646484', '', '', 'guj', 1, 1, '', 0),
(4, 'customer4', '4986461561', '', '', '', 0, 1, 'gst2', 0),
(5, 'anil gurjar', '8963023698', 'anilgurjer371@gmail.com', '', '', 0, 1, '', 0),
(6, 'fsdjkhgskv', '', '', '', '', 0, 1, '', 0),
(7, 'bghjb', '', '', '', '', 0, 1, '', 0),
(8, 'anil123', '4648489413', 'anil@gmial.vom', 'bkjbkj', 'raj', 1, 1, '123456', 0),
(9, 'customer1', '4984564984', 'fsfa@idsnvsidv.com', 'nfnk', 'jfvgujm', 0, 1, 'kbjk16532', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `customer_ledger_id` int(10) DEFAULT NULL,
  `customer_name` varchar(30) DEFAULT NULL,
  `sales_ledger_id` int(11) NOT NULL,
  `total_amount_before_tax` decimal(15,2) NOT NULL,
  `total_cgst` decimal(15,2) NOT NULL,
  `total_sgst` decimal(15,2) NOT NULL,
  `total_igst` decimal(15,2) NOT NULL,
  `total_amount_after_tax` decimal(15,2) NOT NULL,
  `invoicetype` varchar(10) NOT NULL,
  `status` int(5) NOT NULL COMMENT '0==not delete, 1==delete',
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `transaction_date`, `customer_ledger_id`, `customer_name`, `sales_ledger_id`, `total_amount_before_tax`, `total_cgst`, `total_sgst`, `total_igst`, `total_amount_after_tax`, `invoicetype`, `status`, `company_id`) VALUES
(2, 2, '2017-08-24', 34, '', 18, '636.90', '4.76', '4.76', '53.57', '700.00', 'Credit', 0, 1),
(3, 3, '2017-08-24', 34, '', 18, '190.48', '4.76', '4.76', '0.00', '200.00', 'Credit', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_rows`
--

CREATE TABLE `invoice_rows` (
  `id` int(10) NOT NULL,
  `invoice_id` int(10) NOT NULL,
  `item_id` int(10) DEFAULT NULL,
  `quantity` decimal(8,2) DEFAULT NULL,
  `rate` decimal(12,2) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `discount_rate` decimal(5,2) DEFAULT NULL,
  `discount_amount` decimal(12,2) DEFAULT NULL,
  `taxable_value` decimal(15,2) DEFAULT NULL,
  `cgst_rate` int(10) DEFAULT NULL,
  `cgst_amount` decimal(12,2) DEFAULT NULL,
  `sgst_rate` int(10) DEFAULT NULL,
  `sgst_amount` decimal(12,2) DEFAULT NULL,
  `igst_ledger_id` int(11) NOT NULL,
  `igst_amount` decimal(15,2) NOT NULL,
  `total` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_rows`
--

INSERT INTO `invoice_rows` (`id`, `invoice_id`, `item_id`, `quantity`, `rate`, `amount`, `discount_rate`, `discount_amount`, `taxable_value`, `cgst_rate`, `cgst_amount`, `sgst_rate`, `sgst_amount`, `igst_ledger_id`, `igst_amount`, `total`) VALUES
(1, 1, 11, '1.00', '190.48', '190.48', NULL, '0.00', '190.48', 24, '4.76', 20, '4.76', 0, '0.00', '200.00'),
(3, 2, 12, '1.00', '446.43', '446.43', NULL, '0.00', '446.43', 23, '0.00', 19, '0.00', 46, '53.57', '500.00'),
(4, 2, 11, '1.00', '190.48', '190.48', NULL, '0.00', '190.48', 24, '4.76', 20, '4.76', 0, '0.00', '200.00'),
(5, 3, 11, '1.00', '190.48', '190.48', NULL, '0.00', '190.48', 24, '4.76', 20, '4.76', 0, '0.00', '200.00');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `hsn_code` varchar(20) NOT NULL,
  `freezed` tinyint(1) NOT NULL COMMENT '0==not freezed 1==freezed',
  `company_id` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `cgst_ledger_id` int(10) NOT NULL,
  `sgst_ledger_id` int(10) NOT NULL,
  `igst_ledger_id` int(11) NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `input_cgst_ledger_id` int(11) NOT NULL,
  `input_sgst_ledger_id` int(11) NOT NULL,
  `input_igst_ledger_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0==not delete, 1==delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `hsn_code`, `freezed`, `company_id`, `price`, `cgst_ledger_id`, `sgst_ledger_id`, `igst_ledger_id`, `tax_type_id`, `input_cgst_ledger_id`, `input_sgst_ledger_id`, `input_igst_ledger_id`, `status`) VALUES
(10, 'item1', '123', 0, 1, '200.00', 24, 20, 0, 4, 5, 10, 0, 1),
(11, 'item1', '456', 0, 1, '200.00', 24, 20, 0, 4, 5, 10, 0, 1),
(12, 'dummy', '786', 0, 1, '500.00', 0, 0, 45, 3, 0, 0, 40, 0),
(13, 'Parle G', '456987456', 0, 2, '5.00', 0, 0, 45, 3, 0, 0, 40, 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_discounts`
--

CREATE TABLE `item_discounts` (
  `id` int(10) NOT NULL,
  `customer_ledger_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `discount` decimal(15,2) DEFAULT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_discounts`
--

INSERT INTO `item_discounts` (`id`, `customer_ledger_id`, `item_id`, `discount`, `company_id`) VALUES
(1, 31, 2, '15.00', 1),
(2, 32, 2, NULL, 1),
(3, 34, 2, '50.00', 1),
(7, 31, 1, NULL, 1),
(8, 32, 1, '20.00', 1),
(9, 34, 1, '20.00', 1),
(18, 31, 9, '100.00', 1),
(19, 32, 9, NULL, 1),
(20, 34, 9, '50.00', 1),
(21, 38, 9, NULL, 1),
(26, 31, 4, '20.00', 1),
(27, 32, 4, NULL, 1),
(28, 34, 4, '50.00', 1),
(29, 38, 4, NULL, 1),
(35, 31, 10, NULL, 1),
(36, 32, 10, NULL, 1),
(37, 34, 10, NULL, 1),
(38, 38, 10, '200.00', 1),
(39, 51, 10, NULL, 1);

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
  `customer_id` int(10) NOT NULL,
  `tax_percentage` decimal(5,2) NOT NULL,
  `gst_type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ledgers`
--

INSERT INTO `ledgers` (`id`, `name`, `accounting_group_id`, `freeze`, `company_id`, `supplier_id`, `customer_id`, `tax_percentage`, `gst_type`) VALUES
(3, 'Purchase Account', 13, 0, 1, 0, 0, '0.00', ''),
(4, '0% CGST', 29, 0, 1, 0, 0, '0.00', 'CGST'),
(5, '2.5% CGST', 29, 0, 1, 0, 0, '2.50', 'CGST'),
(6, '6% CGST', 29, 0, 1, 0, 0, '6.00', 'CGST'),
(7, '9% CGST', 29, 0, 1, 0, 0, '9.00', 'CGST'),
(8, '14% CGST', 29, 0, 1, 0, 0, '14.00', 'CGST'),
(9, '0% SGST', 29, 0, 1, 0, 0, '0.00', 'SGST'),
(10, '2.5% SGST', 29, 0, 1, 0, 0, '2.50', 'SGST'),
(12, '6% SGST', 29, 0, 1, 0, 0, '6.00', 'SGST'),
(13, '9% SGST', 29, 0, 1, 0, 0, '9.00', 'SGST'),
(14, '14% SGST', 29, 0, 1, 0, 0, '14.00', 'SGST'),
(18, 'Sales Accounts', 14, 0, 1, 0, 0, '0.00', ''),
(19, '0% SGST', 30, 0, 1, 0, 0, '0.00', 'SGST'),
(20, '2.5% SGST', 30, 0, 1, 0, 0, '2.50', 'SGST'),
(21, '6% SGST', 30, 0, 1, 0, 0, '6.00', 'SGST'),
(22, '9% SGST', 30, 0, 1, 0, 0, '9.00', 'SGST'),
(23, '0% CGST', 30, 0, 1, 0, 0, '0.00', 'CGST'),
(24, '2.5% CGST', 30, 0, 1, 0, 0, '2.50', 'CGST'),
(25, '6% CGST', 30, 0, 1, 0, 0, '6.00', 'CGST'),
(26, '9% CGST', 30, 0, 1, 0, 0, '9.00', 'CGST'),
(27, '14% CGST', 30, 0, 1, 0, 0, '14.00', 'CGST'),
(28, '14% SGST', 30, 0, 1, 0, 0, '14.00', 'SGST'),
(29, 'Petty Cash', 31, 0, 1, 0, 0, '0.00', ''),
(30, 'customer3', 22, 1, 1, 0, 3, '0.00', NULL),
(31, 'customer1', 22, 0, 1, 0, 1, '0.00', NULL),
(32, 'customer2', 22, 0, 1, 0, 2, '0.00', NULL),
(33, 'customer3', 22, 1, 1, 0, 3, '0.00', NULL),
(34, 'customer4', 22, 0, 1, 0, 4, '0.00', NULL),
(35, 'supplier1', 25, 0, 1, 1, 0, '0.00', NULL),
(36, 'supplier2', 25, 1, 1, 2, 0, '0.00', NULL),
(37, 'supplier3', 25, 0, 1, 3, 0, '0.00', NULL),
(38, 'anil gurjar', 22, 0, 1, 0, 5, '0.00', NULL),
(39, '0% IGST', 29, 0, 1, 0, 0, '0.00', 'IGST'),
(40, '5% IGST', 29, 0, 1, 0, 0, '5.00', 'IGST'),
(41, '12% IGST', 29, 0, 1, 0, 0, '12.00', 'IGST'),
(42, '18% IGST', 29, 0, 1, 0, 0, '18.00', 'IGST'),
(43, '28% IGST', 29, 0, 1, 0, 0, '28.00', 'IGST'),
(44, '0% IGST', 30, 0, 1, 0, 0, '0.00', 'IGST'),
(45, '5% IGST', 30, 0, 1, 0, 0, '5.00', 'IGST'),
(46, '12% IGST', 30, 0, 1, 0, 0, '12.00', 'IGST'),
(47, '18% IGST', 30, 0, 1, 0, 0, '18.00', 'IGST'),
(48, '28% IGST', 30, 0, 1, 0, 0, '28.00', 'IGST'),
(49, 'anil123', 22, 1, 1, 0, 8, '0.00', NULL),
(50, 'supplier1', 25, 1, 1, 4, 0, '0.00', NULL),
(51, 'customer1', 22, 0, 1, 0, 9, '0.00', NULL),
(52, 'hgoiwn', 25, 0, 1, 5, 0, '0.00', NULL);

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
-- Table structure for table `purchase_invoices`
--

CREATE TABLE `purchase_invoices` (
  `id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `invoice_no` int(50) NOT NULL,
  `supplier_ledger_id` int(15) NOT NULL,
  `base_amount` decimal(15,2) NOT NULL,
  `total_cgst` decimal(15,2) NOT NULL,
  `total_sgst` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `purchase_ledger_id` int(15) NOT NULL,
  `company_id` int(15) NOT NULL,
  `status` int(5) NOT NULL COMMENT '0==not delete, 1==delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_invoices`
--

INSERT INTO `purchase_invoices` (`id`, `transaction_date`, `invoice_no`, `supplier_ledger_id`, `base_amount`, `total_cgst`, `total_sgst`, `total`, `purchase_ledger_id`, `company_id`, `status`) VALUES
(1, '2017-08-24', 123456, 37, '1000.00', '4000.00', '0.00', '5000.00', 3, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_invoice_rows`
--

CREATE TABLE `purchase_invoice_rows` (
  `id` int(11) NOT NULL,
  `cgst_ledger_id` int(15) NOT NULL,
  `cgst_amount` decimal(15,2) NOT NULL,
  `sgst_ledger_id` int(15) NOT NULL,
  `sgst_amount` decimal(15,2) NOT NULL,
  `igst_ledger_id` int(11) NOT NULL,
  `igst_amount` decimal(15,2) NOT NULL,
  `purchase_invoice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_invoice_rows`
--

INSERT INTO `purchase_invoice_rows` (`id`, `cgst_ledger_id`, `cgst_amount`, `sgst_ledger_id`, `sgst_amount`, `igst_ledger_id`, `igst_amount`, `purchase_invoice_id`) VALUES
(52, 0, '0.00', 0, '0.00', 41, '1000.00', 1),
(53, 5, '1000.00', 0, '0.00', 0, '0.00', 1),
(54, 0, '0.00', 10, '1000.00', 0, '0.00', 1),
(55, 7, '500.00', 0, '0.00', 0, '0.00', 1),
(56, 0, '0.00', 13, '500.00', 0, '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_vouchers`
--

CREATE TABLE `purchase_vouchers` (
  `id` int(11) NOT NULL,
  `voucher_no` int(10) NOT NULL,
  `reference_no` varchar(100) NOT NULL,
  `supplier_ledger_id` int(10) NOT NULL,
  `purchase_ledger_id` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `narration` text NOT NULL,
  `total_amount_before_tax` decimal(15,2) NOT NULL,
  `total_cgst` decimal(15,2) NOT NULL,
  `total_sgst` decimal(15,2) NOT NULL,
  `total_igst` decimal(15,2) NOT NULL,
  `total_amount_after_tax` decimal(15,2) NOT NULL,
  `company_id` int(10) NOT NULL,
  `status` int(5) NOT NULL COMMENT '0==not delete, 1=delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_vouchers`
--

INSERT INTO `purchase_vouchers` (`id`, `voucher_no`, `reference_no`, `supplier_ledger_id`, `purchase_ledger_id`, `transaction_date`, `narration`, `total_amount_before_tax`, `total_cgst`, `total_sgst`, `total_igst`, `total_amount_after_tax`, `company_id`, `status`) VALUES
(1, 1, '123', 35, 3, '2017-08-23', 'demo', '892.86', '0.00', '0.00', '107.14', '1000.00', 1, 0),
(2, 2, '156', 35, 3, '2017-08-24', '', '1069.52', '0.00', '0.00', '53.48', '1123.00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_voucher_rows`
--

CREATE TABLE `purchase_voucher_rows` (
  `id` int(10) NOT NULL,
  `purchase_voucher_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `rate_per` decimal(15,2) NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `taxable_value` int(150) NOT NULL,
  `cgst_ledger_id` int(10) NOT NULL,
  `cgst_amount` decimal(15,2) NOT NULL,
  `sgst_ledger_id` int(10) NOT NULL,
  `sgst_amount` decimal(15,2) NOT NULL,
  `igst_ledger_id` int(11) NOT NULL,
  `igst_amount` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_voucher_rows`
--

INSERT INTO `purchase_voucher_rows` (`id`, `purchase_voucher_id`, `item_id`, `quantity`, `rate_per`, `discount_amount`, `amount`, `taxable_value`, `cgst_ledger_id`, `cgst_amount`, `sgst_ledger_id`, `sgst_amount`, `igst_ledger_id`, `igst_amount`, `total`) VALUES
(1, 1, 12, '12.00', '76.07', '20.00', '912.86', 892, 0, '0.00', 0, '0.00', 41, '107.14', '1000.00'),
(2, 2, 12, '1.00', '1069.52', NULL, '1069.52', 1069, 0, '0.00', 0, '0.00', 40, '53.48', '1123.00');

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
  `state` varchar(100) NOT NULL,
  `freezed` tinyint(1) NOT NULL COMMENT '0==not freezed  1==freezed',
  `company_id` int(11) NOT NULL,
  `gstno` varchar(100) NOT NULL,
  `status` int(5) NOT NULL COMMENT '0==not delete, 1==delete'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `email`, `address`, `state`, `freezed`, `company_id`, `gstno`, `status`) VALUES
(1, 'supplier1', '5644986496', 'supplier1@gmail.com', 'jhjckasbcjka', 'raj', 0, 1, 'gst002', 0),
(2, 'supplier2', '8798745645', '', '', '', 1, 1, '', 0),
(3, 'supplier3', '4848445646', 'supplier3@gmail.com', 'xyz', 'rajasthan', 0, 1, 'gst003', 0),
(4, 'supplier1', '5561564561', 'suppl@mail.com', 'gjgjk', 'guj', 1, 1, '23', 0),
(5, 'hgoiwn', 'j494656416', 'wfoimn@ndis.com', 'ewfi', 'kbkj,', 0, 1, 'ml.,156', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tax_types`
--

CREATE TABLE `tax_types` (
  `id` int(11) NOT NULL,
  `gst_type` varchar(100) NOT NULL,
  `percentage` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_types`
--

INSERT INTO `tax_types` (`id`, `gst_type`, `percentage`) VALUES
(1, '0% IGST', 0),
(2, '0% (CGST+SGST)', 0),
(3, '5% IGST', 5),
(4, '5% (CGST+SGST)', 5),
(5, '12% IGST', 12),
(6, '12% (CGST+SGST)', 12),
(7, '18% IGST', 18),
(8, '18% (CGST+SGST)', 18),
(9, '28% IGST', 28),
(10, '28% (CGST+SGST)', 28);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `otp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `company_id`, `mobile_no`, `email`, `otp`) VALUES
(2, 'Abhilash Lohar', 'hello', '$2y$10$5lD5bEZOEf6Gv5s50XEEYu352BwMCw2BrLIh.dIBV5uDcSLGghV4a', 1, '0', '', ''),
(4, 'hello', 'admin', '$2y$10$5lD5bEZOEf6Gv5s50XEEYu352BwMCw2BrLIh.dIBV5uDcSLGghV4a', 2, '0', '', ''),
(5, 'anil gurjar', 'anil', 'anil', 1, '9694981008', 'anilgurjer371@gmail.com', '749309'),
(6, 'shelu', 'shelu', '$2y$10$aE1uAP/8dkxXBdZ9t4wk2uW0AH.AXVMusm0RezjfQp58UNaofI36a', 1, '1234567', 'shelu@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounting_entries`
--
ALTER TABLE `accounting_entries`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_rows`
--
ALTER TABLE `invoice_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_discounts`
--
ALTER TABLE `item_discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ledgers`
--
ALTER TABLE `ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nature_of_groups`
--
ALTER TABLE `nature_of_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_invoice_rows`
--
ALTER TABLE `purchase_invoice_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_vouchers`
--
ALTER TABLE `purchase_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_voucher_rows`
--
ALTER TABLE `purchase_voucher_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_types`
--
ALTER TABLE `tax_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_type_rows`
--
ALTER TABLE `tax_type_rows`
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
-- AUTO_INCREMENT for table `accounting_entries`
--
ALTER TABLE `accounting_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `accounting_groups`
--
ALTER TABLE `accounting_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `invoice_rows`
--
ALTER TABLE `invoice_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `item_discounts`
--
ALTER TABLE `item_discounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `nature_of_groups`
--
ALTER TABLE `nature_of_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_invoice_rows`
--
ALTER TABLE `purchase_invoice_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `purchase_vouchers`
--
ALTER TABLE `purchase_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `purchase_voucher_rows`
--
ALTER TABLE `purchase_voucher_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tax_types`
--
ALTER TABLE `tax_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tax_type_rows`
--
ALTER TABLE `tax_type_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
