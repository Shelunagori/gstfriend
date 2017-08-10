-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2017 at 10:55 AM
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
  `company_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(30, NULL, 'Output GST', 23, 25, 26, 0);

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
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`, `state`, `freezed`, `company_id`) VALUES
(1, 'bsvhjdsbj', '', '', '', '', 0, 1),
(2, 'bmm,mmmm', '', '', '', '', 0, 1),
(3, 'aaaaaaaaaaaaaa', '', '', '', '', 0, 1),
(4, 'sssss', '', '', '', '', 0, 1),
(5, 'anil gurjar', '9462952929', 'anilgurjer371@gmail.com', 'balicha', 'rajasthan', 1, 1),
(6, 'Gopesh Parihaar', '9876543210', '', '', '', 0, 1);

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
  `total_amount_after_tax` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `transaction_date`, `customer_ledger_id`, `sales_ledger_id`, `total_amount_before_tax`, `total_cgst`, `total_sgst`, `total_amount_after_tax`) VALUES
(1, 1, '2017-07-31', 1, 1, '200.00', '12.00', '12.00', '224.00');

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
  `cgst_rate` decimal(5,2) DEFAULT NULL,
  `cgst_amount` decimal(12,2) DEFAULT NULL,
  `sgst_rate` decimal(5,2) DEFAULT NULL,
  `sgst_amount` decimal(12,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_rows`
--

INSERT INTO `invoice_rows` (`id`, `invoice_id`, `item_id`, `quantity`, `rate`, `amount`, `discount_rate`, `discount_amount`, `taxable_value`, `cgst_rate`, `cgst_amount`, `sgst_rate`, `sgst_amount`, `total`) VALUES
(1, 1, 1, '2.00', '100.00', '200.00', NULL, '0.00', '200.00', '6.00', '12.00', '6.00', '12.00', '224.00');

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
(1, 'item 1', '123', 0, 1),
(2, 'item 2', '123', 0, 1),
(3, 'item 3', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_masters`
--

CREATE TABLE `item_masters` (
  `id` int(15) NOT NULL,
  `item_id` int(10) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `cgst_ledger_id` int(10) NOT NULL,
  `sgst_ledger_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_masters`
--

INSERT INTO `item_masters` (`id`, `item_id`, `price`, `cgst_ledger_id`, `sgst_ledger_id`) VALUES
(1, 2, '100.00', 7, 13),
(2, 1, '1000.00', 8, 14),
(3, 3, '2000.00', 6, 12);

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
(2, 'Manoj Tanwar', 25, 0, 1, 4, 0, '0.00', ''),
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
(15, 'spx floew', 25, 0, 1, 5, 0, '0.00', NULL);

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
(17, 16, '655', 2, 3, '2017-08-05', 'fchgvj', 1),
(18, 17, '156543', 2, 3, '2017-08-04', 'bhnkj123556', 1),
(22, 18, '466', 2, 3, '2017-08-05', '79guijoil', 1),
(23, 19, '', 2, 3, '2017-08-05', '', 1);

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
(30, 18, 1, '5.00', '10.00', '15.00', '50.00', 35, 6, '2.10', 10, '0.88', '37.98'),
(31, 18, 3, '20.00', '20.00', '90.00', '400.00', 310, 8, '43.40', 10, '7.75', '361.15'),
(54, 22, 1, '20.00', '20.00', '10.00', '400.00', 390, 5, '9.75', 13, '35.10', '434.85'),
(55, 17, 1, '12.00', '20.00', '48.00', '240.00', 192, 5, '4.80', 10, '4.80', '201.60'),
(56, 17, 2, '25.00', '10.00', '50.00', '250.00', 200, 6, '12.00', 12, '12.00', '224.00'),
(57, 17, 3, '30.00', '10.00', '30.00', '300.00', 270, 7, '24.30', 13, '24.30', '318.60');

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
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `mobile`, `email`, `address`, `state`, `freezed`, `company_id`) VALUES
(1, 'anil', '', '', '', '', 0, 1),
(2, 'cvbcvb', '', '', '', '', 0, 1),
(3, 'anill', '9462952929', 'anilgurjer371@gmail.com', 'balicha', 'rajasthan', 1, 1),
(4, 'Manoj Tanwar', '', '', '', '', 0, 1),
(5, 'spx floew', '', '', '', '', 0, 1);

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
-- Indexes for table `item_masters`
--
ALTER TABLE `item_masters`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `accounting_groups`
--
ALTER TABLE `accounting_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoice_rows`
--
ALTER TABLE `invoice_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item_masters`
--
ALTER TABLE `item_masters`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ledgers`
--
ALTER TABLE `ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `nature_of_groups`
--
ALTER TABLE `nature_of_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `purchase_vouchers`
--
ALTER TABLE `purchase_vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `purchase_voucher_rows`
--
ALTER TABLE `purchase_voucher_rows`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;