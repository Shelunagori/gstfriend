-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2017 at 07:16 AM
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
(7, 37, '0.00', '5773.50', '2017-08-10', 1, 1, 0),
(8, 3, '5520.00', '0.00', '2017-08-10', 1, 1, 0),
(9, 5, '122.50', '0.00', '2017-08-10', 1, 1, 0),
(10, 10, '122.50', '0.00', '2017-08-10', 1, 1, 0),
(11, 4, '0.00', '0.00', '2017-08-10', 1, 1, 0),
(12, 9, '0.00', '0.00', '2017-08-10', 1, 1, 0),
(13, 5, '4.25', '0.00', '2017-08-10', 1, 1, 0),
(14, 10, '4.25', '0.00', '2017-08-10', 1, 1, 0),
(15, 32, '3385.80', '0.00', '2017-08-10', 0, 1, 1),
(16, 18, '0.00', '2970.00', '2017-08-10', 0, 1, 1),
(17, 25, '0.00', '118.80', '2017-08-10', 0, 1, 1),
(18, 21, '0.00', '118.80', '2017-08-10', 0, 1, 1),
(19, 26, '0.00', '89.10', '2017-08-10', 0, 1, 1),
(20, 22, '0.00', '89.10', '2017-08-10', 0, 1, 1),
(21, 31, '2146.13', '0.00', '2017-08-10', 0, 1, 3),
(22, 18, '0.00', '1978.00', '2017-08-10', 0, 1, 3),
(23, 24, '0.00', '49.45', '2017-08-10', 0, 1, 3),
(24, 21, '0.00', '118.68', '2017-08-10', 0, 1, 3),
(25, 31, '1144.60', '0.00', '2017-08-10', 0, 1, 4),
(26, 18, '0.00', '970.00', '2017-08-10', 0, 1, 4),
(27, 26, '0.00', '87.30', '2017-08-10', 0, 1, 4),
(28, 22, '0.00', '87.30', '2017-08-10', 0, 1, 4),
(29, 31, '1156.40', '0.00', '2017-08-11', 0, 1, 5),
(30, 18, '0.00', '980.00', '2017-08-11', 0, 1, 5),
(31, 26, '0.00', '88.20', '2017-08-11', 0, 1, 5),
(32, 22, '0.00', '88.20', '2017-08-11', 0, 1, 5);

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
(4, 2, 'Current Liabilities', NULL, 21, 32, 0),
(5, 4, 'Direct Expenses', NULL, 33, 34, 0),
(6, 3, 'Direct Incomes', NULL, 35, 36, 0),
(7, 1, 'Fixed Assets', NULL, 37, 38, 0),
(8, 4, 'Indirect Expenses', NULL, 39, 40, 0),
(9, 3, 'Indirect Incomes', NULL, 41, 42, 0),
(10, 1, 'Investments', NULL, 43, 44, 0),
(11, 2, 'Loans (Liability)', NULL, 45, 52, 0),
(12, 1, 'Misc. Expenses (ASSET)', NULL, 53, 54, 0),
(13, 4, 'Purchase Accounts', NULL, 55, 56, 0),
(14, 3, 'Sales Accounts', NULL, 57, 58, 0),
(15, 2, 'Suspense A/c', NULL, 59, 60, 0),
(16, NULL, 'Reserves & Surplus', 2, 4, 5, 1),
(17, NULL, 'Bank Accounts', 3, 8, 9, 1),
(18, NULL, 'Cash-in-hand', 3, 10, 11, 1),
(19, NULL, 'Deposits (Asset)', 3, 12, 13, 1),
(20, NULL, 'Loans & Advances (Asset)', 3, 14, 15, 1),
(21, NULL, 'Stock-in-hand', 3, 16, 17, 1),
(22, NULL, 'Sundry Debtors', 3, 18, 19, 1),
(23, NULL, 'Duties & Taxes', 4, 22, 27, 1),
(24, NULL, 'Provisions', 4, 28, 29, 1),
(25, NULL, 'Sundry Creditors', 4, 30, 31, 1),
(26, NULL, 'Bank OD A/c', 11, 46, 47, 1),
(27, NULL, 'Secured Loans', 11, 48, 49, 1),
(28, NULL, 'Unsecured Loans', 11, 50, 51, 1),
(29, NULL, 'Input GST', 23, 23, 24, 0),
(30, NULL, 'Output GST', 23, 25, 26, 0),
(31, NULL, 'Petty Cash', 0, 0, 0, 1);

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
  `state` varchar(100) NOT NULL,
  `freezed` tinyint(1) NOT NULL COMMENT '0==not freezed  1==freezed',
  `company_id` int(11) NOT NULL,
  `gstno` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`, `state`, `freezed`, `company_id`, `gstno`) VALUES
(1, 'customer1', '1234567891', 'customer1@gmail.com', 'xyz', 'raj', 0, 1, 'gst003'),
(2, 'customer2', '4654564564', 'customer2@gmail.com', 'abc', '', 0, 1, 'gst1'),
(3, 'customer3', '4464646484', '', '', 'guj', 1, 1, ''),
(4, 'customer4', '4986461561', '', '', '', 0, 1, 'gst2');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `customer_ledger_id` int(10) NOT NULL,
  `sales_ledger_id` int(11) NOT NULL,
  `total_amount_before_tax` decimal(15,2) NOT NULL,
  `total_cgst` decimal(15,2) NOT NULL,
  `total_sgst` decimal(15,2) NOT NULL,
  `total_amount_after_tax` decimal(15,2) NOT NULL,
  `invoicetype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `transaction_date`, `customer_ledger_id`, `sales_ledger_id`, `total_amount_before_tax`, `total_cgst`, `total_sgst`, `total_amount_after_tax`, `invoicetype`) VALUES
(1, 1, '2017-08-10', 32, 18, '2970.00', '207.90', '207.90', '3385.80', 'Credit'),
(2, 2, '2017-08-10', 31, 18, '0.00', '0.00', '0.00', '0.00', 'Credit'),
(3, 3, '2017-08-10', 31, 18, '1978.00', '49.45', '118.68', '2146.13', 'Credit'),
(4, 4, '2017-08-10', 31, 18, '970.00', '87.30', '87.30', '1144.60', 'Credit'),
(5, 5, '2017-08-11', 31, 18, '980.00', '88.20', '88.20', '1156.40', 'Credit');

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
  `total` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_rows`
--

INSERT INTO `invoice_rows` (`id`, `invoice_id`, `item_id`, `quantity`, `rate`, `amount`, `discount_rate`, `discount_amount`, `taxable_value`, `cgst_rate`, `cgst_amount`, `sgst_rate`, `sgst_amount`, `total`) VALUES
(1, 1, 2, '1.00', '2000.00', '2000.00', NULL, '20.00', '1980.00', 25, '118.80', 21, '118.80', '2217.60'),
(2, 1, 1, '1.00', '1000.00', '1000.00', NULL, '10.00', '990.00', 26, '89.10', 22, '89.10', '1168.20'),
(3, 2, NULL, '1.00', NULL, '0.00', NULL, NULL, '0.00', NULL, '0.00', NULL, '0.00', '0.00'),
(4, 3, 2, '1.00', '2000.00', '2000.00', NULL, '22.00', '1978.00', 24, '49.45', 21, '118.68', '2146.13'),
(5, 4, 1, '1.00', '1000.00', '1000.00', NULL, '30.00', '970.00', 26, '87.30', 22, '87.30', '1144.60'),
(6, 5, 1, '1.00', '1000.00', '1000.00', NULL, '20.00', '980.00', 26, '88.20', 22, '88.20', '1156.40');

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
  `sgst_ledger_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `hsn_code`, `freezed`, `company_id`, `price`, `cgst_ledger_id`, `sgst_ledger_id`) VALUES
(1, 'item1', 'hsn001', 0, 1, '1000.00', 26, 22),
(2, 'item2', 'hsn002', 0, 1, '2000.00', 25, 21),
(3, 'item3', 'hsn003', 1, 1, '500.00', 24, 20);

-- --------------------------------------------------------

--
-- Table structure for table `item_discounts`
--

CREATE TABLE `item_discounts` (
  `id` int(10) NOT NULL,
  `customer_ledger_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `discount` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_discounts`
--

INSERT INTO `item_discounts` (`id`, `customer_ledger_id`, `item_id`, `discount`) VALUES
(1, 31, 2, '15.00'),
(2, 32, 2, NULL),
(3, 34, 2, '50.00'),
(7, 31, 1, NULL),
(8, 32, 1, '20.00'),
(9, 34, 1, '20.00');

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
(3, 'Purchase Account', 13, 0, 0, 0, 0, '0.00', ''),
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
(18, 'Sales Accounts', 14, 0, 0, 0, 0, '0.00', ''),
(19, '0% SGST', 30, 0, 1, 0, 0, '0.00', 'SGST'),
(20, '2.5% SGST', 30, 0, 1, 0, 0, '2.50', 'SGST'),
(21, '6% SGST', 30, 0, 1, 0, 0, '6.00', 'SGST'),
(22, '9% SGST', 30, 0, 1, 0, 0, '9.00', 'SGST'),
(23, '0% CGST', 30, 0, 1, 0, 0, '0.00', 'CGST'),
(24, '2.5% CGST', 30, 0, 1, 0, 0, '2.50', 'CGST'),
(25, '6% CGST', 30, 0, 1, 0, 0, '6.00', 'CGST'),
(26, '9% CGST', 30, 0, 1, 0, 0, '9.00', 'CGST'),
(27, '14%CGST', 30, 0, 1, 0, 0, '14.00', 'CGST'),
(28, '14% SGST', 30, 0, 1, 0, 0, '14.00', 'SGST'),
(29, 'Petty Cash', 31, 0, 1, 0, 0, '0.00', ''),
(30, 'customer3', 22, 1, 1, 0, 3, '0.00', NULL),
(31, 'customer1', 22, 0, 1, 0, 1, '0.00', NULL),
(32, 'customer2', 22, 0, 1, 0, 2, '0.00', NULL),
(33, 'customer3', 22, 1, 1, 0, 3, '0.00', NULL),
(34, 'customer4', 22, 0, 1, 0, 4, '0.00', NULL),
(35, 'supplier1', 25, 0, 1, 1, 0, '0.00', NULL),
(36, 'supplier2', 25, 1, 1, 2, 0, '0.00', NULL),
(37, 'supplier3', 25, 0, 1, 3, 0, '0.00', NULL);

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
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_vouchers`
--

INSERT INTO `purchase_vouchers` (`id`, `voucher_no`, `reference_no`, `supplier_ledger_id`, `purchase_ledger_id`, `transaction_date`, `narration`, `company_id`) VALUES
(1, 1, '123', 37, 3, '2017-08-10', 'xyz', 1);

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
  `discount_amount` decimal(10,2) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `taxable_value` int(150) NOT NULL,
  `cgst_ledger_id` int(10) NOT NULL,
  `cgst_amount` decimal(15,2) NOT NULL,
  `sgst_ledger_id` int(10) NOT NULL,
  `sgst_amount` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_voucher_rows`
--

INSERT INTO `purchase_voucher_rows` (`id`, `purchase_voucher_id`, `item_id`, `quantity`, `rate_per`, `discount_amount`, `amount`, `taxable_value`, `cgst_ledger_id`, `cgst_amount`, `sgst_ledger_id`, `sgst_amount`, `total`) VALUES
(3, 1, 2, '10.00', '500.00', '100.00', '5000.00', 4900, 5, '122.50', 10, '122.50', '5145.00'),
(4, 1, 1, '5.00', '100.00', '50.00', '500.00', 450, 4, '0.00', 9, '0.00', '450.00'),
(5, 1, 1, '10.00', '20.00', '30.00', '200.00', 170, 5, '4.25', 10, '4.25', '178.50');

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
  `gstno` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `email`, `address`, `state`, `freezed`, `company_id`, `gstno`) VALUES
(1, 'supplier1', '5644986496', 'supplier1@gmail.com', 'jhjckasbcjka', 'raj', 0, 1, 'gst002'),
(2, 'supplier2', '8798745645', '', '', '', 1, 1, ''),
(3, 'supplier3', '4848445646', 'supplier3@gmail.com', 'xyz', 'rajasthan', 0, 1, 'gst003');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `accounting_groups`
--
ALTER TABLE `accounting_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `invoice_rows`
--
ALTER TABLE `invoice_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item_discounts`
--
ALTER TABLE `item_discounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `nature_of_groups`
--
ALTER TABLE `nature_of_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `purchase_vouchers`
--
ALTER TABLE `purchase_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_voucher_rows`
--
ALTER TABLE `purchase_voucher_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
