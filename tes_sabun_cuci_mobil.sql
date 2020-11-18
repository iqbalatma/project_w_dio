-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2020 at 05:08 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tes_sabun_cuci_mobil`
--

-- --------------------------------------------------------

--
-- Table structure for table `basic_info_meta`
--

CREATE TABLE `basic_info_meta` (
  `id` tinyint(10) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `contact_1` varchar(15) NOT NULL,
  `contact_2` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `website` varchar(250) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basic_info_meta`
--

INSERT INTO `basic_info_meta` (`id`, `fullname`, `address`, `contact_1`, `contact_2`, `email`, `website`, `logo`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'Sabun Aryanz', 'Jabar, Indonesia', '0812398123', '1231231232', 'halo@sabun-aryanz.com', 'https://sabun-aryanz.com', 'logo-hd.png', '2020-11-16 03:02:30', '2020-11-18 20:15:28', 'admins');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` tinyint(10) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `cust_type` enum('retail','reseller','wholesale') NOT NULL DEFAULT 'retail',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `full_name`, `address`, `phone`, `cust_type`, `created_at`, `is_deleted`) VALUES
(1, 'Joe Bidan', 'Menara', '0877213176782', 'retail', '2020-11-11 00:25:50', 0),
(2, 'Tori Obama', 'Timoer Timoer', '0877216126', 'retail', '2020-11-11 00:25:50', 0),
(3, 'Pawer Renjer', 'Imajinasi', '0856213125', 'retail', '2020-11-16 21:47:20', 0),
(4, 'Bruce lee', 'York New', '0854465478', 'wholesale', '2020-11-16 21:47:20', 0),
(5, 'Jake Separow', 'Going Merry', '0845111487', 'retail', '2020-11-16 21:50:32', 0),
(6, 'tester', 'Tempat makan', '04567182332', 'retail', '2020-11-16 23:57:06', 0),
(7, 'tester2', 'Tempat makan 2', '0888888888', 'retail', '2020-11-16 23:59:53', 0),
(8, 'tester3', 'Tempat makan 3', '0888888889', 'reseller', '2020-11-17 00:01:03', 0),
(9, 'tester', 'Tempat makan', '0888888890', 'reseller', '2020-11-17 00:02:13', 0),
(10, 'Jackpot', 'Jendela', '085677839992', 'retail', '2020-11-17 00:45:27', 0),
(11, 'custo', 'omerr', '00000000000', 'reseller', '2020-11-17 01:29:31', 0),
(12, 'tes video', 'internet', '0888888888', 'retail', '2020-11-17 12:32:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `custom_price`
--

CREATE TABLE `custom_price` (
  `id` tinyint(10) NOT NULL,
  `price` int(11) NOT NULL,
  `customer_id` tinyint(10) NOT NULL,
  `product_id` tinyint(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_price`
--

INSERT INTO `custom_price` (`id`, `price`, `customer_id`, `product_id`, `created_at`, `is_deleted`) VALUES
(1, 500000, 3, 1, '2020-11-18 22:24:48', 0),
(2, 450000, 3, 4, '2020-11-18 22:24:48', 0),
(3, 125000, 11, 3, '2020-11-18 22:25:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` tinyint(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'avatar-1.png',
  `role_id` tinyint(10) DEFAULT '2',
  `store_id` tinyint(10) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone`, `address`, `avatar`, `role_id`, `store_id`, `created_at`, `is_deleted`) VALUES
(0, 'superadmin', 'superadmin@msn.com', '$2a$08$g6axSKDVOvmKJOTOYUbK/OO1DP5vsSRPNtRBowHc.nQs2v5VGsoky', 'super', 'admin', '06969696969', 'langit', 'avatar-7.png', 1, 1, '2020-11-18 22:55:22', 0),
(1, 'pemilik', 'pemilik@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Saya', 'Pemilik', '0871263612', 'Di kantor', 'avatar-1.png', 2, 1, '2020-11-10 22:48:27', 0),
(2, 'gudang', 'gudang@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Admin', 'Gudang', '087213513441', 'Di gudang', 'avatar-1.png', 3, 1, '2020-11-10 22:52:15', 0),
(3, 'kasir_cica', 'kasir_cica@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Cica', NULL, '0856123872', 'Di Cicalengka', 'avatar-1.png', 4, 2, '2020-11-10 22:54:23', 0),
(4, 'kasir_uber', 'kasir_uber@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Uber', NULL, '08571123098', 'Di Ujung Beruang', 'avatar-1.png', 4, 3, '2020-11-10 22:54:23', 0),
(5, 'admins', 'admin1@jp.com', '$2a$08$HVX6fm.h9nJlfgYJxOlHOuKxvNB8ZJhWdB/qmuksTxaIJuT2RyoCG', 'dio', 'Ilham', '081236137132', 'Dipatiukur', 'avatar-0.png', 2, 1, '2020-11-17 03:19:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` tinyint(10) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `paid_amount` int(21) NOT NULL,
  `left_to_paid` int(21) NOT NULL,
  `paid_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transaction_id` tinyint(10) NOT NULL,
  `employee_id` tinyint(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` tinyint(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `invoice_id` tinyint(10) NOT NULL,
  `product_id` tinyint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` tinyint(10) NOT NULL,
  `material_code` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `unit` enum('mililiter','gram') NOT NULL DEFAULT 'mililiter',
  `volume` int(11) NOT NULL DEFAULT '0' COMMENT 'Jumlah dalam ml / gr',
  `category` enum('bahan','kemasan') NOT NULL DEFAULT 'bahan',
  `image` varchar(250) DEFAULT 'default.png',
  `price_base` int(11) NOT NULL DEFAULT '0' COMMENT 'Harga dasar / Harga beli / HPP per unit(ml/gr)',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `material_code`, `full_name`, `unit`, `volume`, `category`, `image`, `price_base`, `created_at`, `is_deleted`) VALUES
(1, 'BM001', 'Barang mentah 1', 'mililiter', 1000, 'bahan', 'default.png', 10000, '2020-11-16 17:40:30', 1),
(2, 'BM002', 'Barang mentah 2', 'mililiter', 233, 'bahan', 'default.png', 20000, '2020-11-16 17:40:30', 0),
(3, 'BM003', 'Barang Mentah 3', 'gram', 100, 'bahan', 'default.png', 5000, '2020-11-18 19:23:25', 0),
(4, 'BM004', 'Barang Mentah 4', 'gram', 500, 'bahan', 'default.png', 14000, '2020-11-18 19:24:05', 0),
(5, 'BM005', 'Barang Mentah 5', 'mililiter', 1500, 'kemasan', 'default.png', 15000, '2020-11-18 19:24:26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `material_inventory`
--

CREATE TABLE `material_inventory` (
  `id` tinyint(10) NOT NULL,
  `material_id` tinyint(10) NOT NULL,
  `store_id` tinyint(10) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_inventory`
--

INSERT INTO `material_inventory` (`id`, `material_id`, `store_id`, `quantity`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 1, 1, 100, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0),
(2, 1, 2, 88, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0),
(3, 2, 1, 92, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0),
(4, 2, 2, 56, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0),
(5, 4, 1, 120, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0),
(6, 4, 2, 80, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0),
(7, 4, 3, 25, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0),
(8, 3, 3, 44, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0),
(9, 5, 1, 12, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0),
(10, 5, 2, 34, '2020-11-18 19:31:43', NULL, 'admins', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `material_mutation`
--

CREATE TABLE `material_mutation` (
  `id` tinyint(10) NOT NULL,
  `material_id` tinyint(10) NOT NULL,
  `store_id` tinyint(10) NOT NULL,
  `mutation_code` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mutation_type` enum('keluar','masuk') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` tinyint(10) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `unit` enum('mililiter','gram') NOT NULL DEFAULT 'mililiter',
  `volume` int(11) NOT NULL DEFAULT '0' COMMENT 'Jumlah dalam ml / gr',
  `image` varchar(250) DEFAULT 'default.png',
  `price_base` int(11) NOT NULL DEFAULT '0' COMMENT 'Harga dasar / Harga beli / HPP',
  `price_retail` int(11) NOT NULL DEFAULT '0',
  `price_reseller` int(11) NOT NULL DEFAULT '0',
  `price_wholesale` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_code`, `full_name`, `unit`, `volume`, `image`, `price_base`, `price_retail`, `price_reseller`, `price_wholesale`, `created_at`, `is_deleted`) VALUES
(1, 'DT001', 'Sabun Dettol 50ml', 'mililiter', 50, 'default.png', 10000, 20000, 19000, 18000, '2020-11-17 13:44:04', 0),
(2, 'DT002', 'Sabun Dettol 150ml', 'mililiter', 150, 'default.png', 15000, 30000, 27000, 25000, '2020-11-17 13:44:04', 0),
(3, 'DT003', 'Sabun Dettol 500ml', 'mililiter', 500, 'default.png', 25000, 50000, 45000, 40000, '2020-11-17 13:44:04', 0),
(4, 'DT004', 'Sabun Dettol 1L', 'mililiter', 1000, 'default.png', 0, 0, 0, 0, '2020-11-18 15:37:08', 0),
(5, 'DT005', 'Sabun Dettol 1.5L', 'gram', 15, 'default.png', 20000, 50000, 45000, 43001, '2020-11-18 16:12:08', 0),
(6, 'DT006', 'Sabun Dettol 10L', 'mililiter', 10000, 'default.png', 0, 0, 0, 0, '2020-11-18 17:33:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_composition`
--

CREATE TABLE `product_composition` (
  `id` tinyint(10) NOT NULL,
  `volume` int(11) NOT NULL COMMENT 'Jumlah dalam ml / gr',
  `product_id` tinyint(10) DEFAULT NULL,
  `material_id` tinyint(10) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_composition`
--

INSERT INTO `product_composition` (`id`, `volume`, `product_id`, `material_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 10, 1, 2, '2020-11-18 15:56:03', NULL, 0),
(2, 50, 1, 1, '2020-11-18 16:40:30', NULL, 0),
(3, 5, 1, 5, '2020-11-18 19:43:37', NULL, 0),
(4, 10, 6, 1, '2020-11-18 19:43:37', NULL, 0),
(5, 3, 6, 2, '2020-11-18 19:43:37', NULL, 0),
(6, 5, 6, 4, '2020-11-18 19:43:37', NULL, 0),
(7, 3, 2, 5, '2020-11-18 19:43:37', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--

CREATE TABLE `product_inventory` (
  `id` tinyint(10) NOT NULL,
  `product_id` tinyint(10) NOT NULL,
  `store_id` tinyint(10) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `product_id`, `store_id`, `quantity`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 1, 1, 52, '2020-11-17 13:46:37', '2020-11-17 13:46:37', 'pemilik', 'pemilik', 0),
(2, 2, 1, 33, '2020-11-17 13:46:37', '2020-11-17 13:46:37', 'pemilik', 'pemilik', 0),
(3, 3, 1, 5, '2020-11-17 13:46:37', '2020-11-17 13:46:37', 'pemilik', 'pemilik', 0),
(4, 6, 1, 500, '2020-11-18 19:27:40', NULL, 'admins', NULL, 0),
(5, 1, 2, 100, '2020-11-18 19:27:40', NULL, 'admins', NULL, 0),
(6, 2, 2, 70, '2020-11-18 19:27:40', NULL, 'admins', NULL, 0),
(7, 5, 1, 300, '2020-11-18 19:27:40', NULL, 'admins', NULL, 0),
(8, 5, 1, 300, '2020-11-18 19:27:40', NULL, 'admins', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_mutation`
--

CREATE TABLE `product_mutation` (
  `id` tinyint(10) NOT NULL,
  `product_id` tinyint(10) NOT NULL,
  `store_id` tinyint(10) NOT NULL,
  `mutation_code` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mutation_type` enum('keluar','masuk') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` tinyint(10) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `created_at`, `is_deleted`) VALUES
(1, 'superadmin', '2020-11-10 22:46:29', 0),
(2, 'owner', '2020-11-10 22:46:29', 0),
(3, 'admin', '2020-11-10 22:46:29', 0),
(4, 'cashier', '2020-11-10 22:46:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` tinyint(10) NOT NULL,
  `store_name` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `store_name`, `address`, `created_at`, `is_deleted`) VALUES
(1, 'Kantor Pusat', 'Di kantor pusat pokoknya', '2020-11-08 13:07:02', 0),
(2, 'Toko Cabang 1 (Cicalengka)', 'Cicalengka', '2020-11-08 13:07:02', 0),
(3, 'Toko Cabang 2 (Ujung Berung)', 'Ujung Berung', '2020-11-08 13:07:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` tinyint(10) NOT NULL,
  `trans_number` varchar(100) NOT NULL,
  `price_total` int(11) NOT NULL,
  `store_id` tinyint(10) NOT NULL,
  `customer_id` tinyint(10) NOT NULL,
  `due_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basic_info_meta`
--
ALTER TABLE `basic_info_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_price`
--
ALTER TABLE `custom_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `address` (`address`),
  ADD KEY `role_id` (`role_id`) USING BTREE,
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_number`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_code`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `material_inventory`
--
ALTER TABLE `material_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `product_id` (`material_id`);

--
-- Indexes for table `material_mutation`
--
ALTER TABLE `material_mutation`
  ADD PRIMARY KEY (`mutation_code`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `item_id` (`material_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_code`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `product_composition`
--
ALTER TABLE `product_composition`
  ADD PRIMARY KEY (`id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_mutation`
--
ALTER TABLE `product_mutation`
  ADD PRIMARY KEY (`mutation_code`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `item_id` (`product_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`trans_number`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basic_info_meta`
--
ALTER TABLE `basic_info_meta`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `custom_price`
--
ALTER TABLE `custom_price`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `material_inventory`
--
ALTER TABLE `material_inventory`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `material_mutation`
--
ALTER TABLE `material_mutation`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_composition`
--
ALTER TABLE `product_composition`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_mutation`
--
ALTER TABLE `product_mutation`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` tinyint(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `custom_price`
--
ALTER TABLE `custom_price`
  ADD CONSTRAINT `custom_price_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `custom_price_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD CONSTRAINT `invoice_item_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `material_inventory`
--
ALTER TABLE `material_inventory`
  ADD CONSTRAINT `material_inventory_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material_inventory_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `material_mutation`
--
ALTER TABLE `material_mutation`
  ADD CONSTRAINT `material_mutation_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `material_mutation_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `product_composition`
--
ALTER TABLE `product_composition`
  ADD CONSTRAINT `product_composition_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `product_composition_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD CONSTRAINT `product_inventory_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `product_inventory_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_mutation`
--
ALTER TABLE `product_mutation`
  ADD CONSTRAINT `product_mutation_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
