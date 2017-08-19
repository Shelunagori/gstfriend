-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2017 at 09:18 AM
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
(1, 37, '0.00', '2000.00', '2017-08-17', 1, 1, 0),
(2, 3, '700.00', '0.00', '2017-08-17', 1, 1, 0),
(3, 5, '150.00', '0.00', '2017-08-17', 1, 1, 0),
(4, 10, '150.00', '0.00', '2017-08-17', 1, 1, 0),
(5, 7, '500.00', '0.00', '2017-08-17', 1, 1, 0),
(6, 13, '500.00', '0.00', '2017-08-17', 1, 1, 0),
(7, 37, '0.00', '1400.00', '2017-08-17', 2, 1, 0),
(8, 3, '1000.00', '0.00', '2017-08-17', 2, 1, 0),
(9, 5, '200.00', '0.00', '2017-08-17', 2, 1, 0),
(10, 10, '200.00', '0.00', '2017-08-17', 2, 1, 0);

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
(1, 'phppoets', 'subhash nagar sevasram', 'f.png', 'udaipur', 'rajasthan', 1234567891);

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
(4, 'customer4', '4986461561', '', '', '', 0, 1, 'gst2'),
(5, 'anil gurjar', '8963023698', 'anilgurjer371@gmail.com', '', '', 0, 1, ''),
(6, 'fsdjkhgskv', '', '', '', '', 0, 1, ''),
(7, 'bghjb', '', '', '', '', 0, 1, '');

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
  `total_amount_after_tax` decimal(15,2) NOT NULL,
  `invoicetype` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `input_igst_ledger_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `hsn_code`, `freezed`, `company_id`, `price`, `cgst_ledger_id`, `sgst_ledger_id`, `igst_ledger_id`, `tax_type_id`, `input_cgst_ledger_id`, `input_sgst_ledger_id`, `input_igst_ledger_id`) VALUES
(4, 'GMCH', 'aa', 0, 1, '1000.00', 24, 20, 0, 4, 5, 10, 0),
(5, 'GMCH 2', '1234456', 0, 1, '123456.00', 27, 28, 0, 10, 8, 14, 0),
(6, 'demo', '1234', 0, 1, '12000.00', 0, 0, 45, 3, 0, 0, 40),
(7, 'test', '12345', 0, 1, '12345.00', 26, 22, 0, 8, 7, 13, 0);

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
(48, '28% IGST', 30, 0, 1, 0, 0, '28.00', 'IGST');

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
  `company_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `purchase_invoice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice_rows`
--
ALTER TABLE `invoice_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `item_discounts`
--
ALTER TABLE `item_discounts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `nature_of_groups`
--
ALTER TABLE `nature_of_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `purchase_invoices`
--
ALTER TABLE `purchase_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_invoice_rows`
--
ALTER TABLE `purchase_invoice_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_vouchers`
--
ALTER TABLE `purchase_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_voucher_rows`
--
ALTER TABLE `purchase_voucher_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
