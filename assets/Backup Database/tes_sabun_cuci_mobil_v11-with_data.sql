-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 12:39 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

--
-- Author: @Galaxx.dev
--
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
-- Creation: Jan 13, 2021 at 11:27 AM
--

DROP TABLE IF EXISTS `basic_info_meta`;
CREATE TABLE `basic_info_meta` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `contact_1` varchar(15) NOT NULL,
  `contact_2` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `website` varchar(250) NOT NULL,
  `logo` varchar(250) NOT NULL,
  `store_id` int(11) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `basic_info_meta`
--

TRUNCATE TABLE `basic_info_meta`;
--
-- Dumping data for table `basic_info_meta`
--

INSERT INTO `basic_info_meta` (`id`, `fullname`, `address`, `contact_1`, `contact_2`, `email`, `website`, `logo`, `store_id`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'Sabun Aryanz', 'Jabar, Indonesia', '08123981232', '1231231232', 'halo@sabun-aryanz.com', 'http://sabun-aryanz.com', 'logo.png', 1, '2020-11-16 03:02:30', '2020-12-02 02:40:37', 'gudang'),
(2, 'Sabun Aryanz', 'Cicalengka, Jabar, Indonesia', '123123', '123123', 'halo@sabun-aryanz.com', 'http://sabun-aryanz.com', 'logo.png', 2, '2021-01-13 18:00:00', '2021-01-13 18:00:00', NULL),
(3, 'Sabun Aryanz', 'Ujung Berung, Jabar, Indonesia', '5678987667', '1231232454', 'halo@sabun-aryanz.com', 'http://sabun-aryanz.com', 'logo.png', 3, '2021-01-13 18:00:00', '2021-01-13 18:33:11', 'kasiruber1');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--
-- Creation: Dec 22, 2020 at 08:07 PM
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `cust_type` enum('retail','reseller') NOT NULL DEFAULT 'retail',
  `store_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `customer`
--

TRUNCATE TABLE `customer`;
--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `full_name`, `address`, `phone`, `cust_type`, `store_id`, `created_at`, `is_deleted`) VALUES
(1, 'Jhon', 'Jalanan', '087717172662', 'retail', 2, '2020-12-23 03:06:55', 0),
(2, 'Shin', 'Jalanan Tengah', '0888888888', 'retail', 1, '2020-12-24 06:37:27', 0),
(3, 'Toko Cicalengka', 'Cicalengka', '08123981232', 'reseller', 1, '2021-01-12 02:33:53', 0),
(4, 'Toko Ujung Berung', 'Ujung Berung', '08123981232', 'reseller', 1, '2021-01-12 02:34:36', 0),
(5, 'Gudang Pusat', 'Jawa Barat, Indonesia', '08123981232', 'reseller', 1, '2021-01-12 02:39:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `custom_price`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `custom_price`;
CREATE TABLE `custom_price` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `custom_price`
--

TRUNCATE TABLE `custom_price`;
--
-- Dumping data for table `custom_price`
--

INSERT INTO `custom_price` (`id`, `price`, `customer_id`, `product_code`, `created_at`, `is_deleted`) VALUES
(1, 10000, 2, 'PR001', '2020-12-24 06:38:03', 0),
(2, 7000, 3, 'TYTY1', '2021-01-12 02:34:03', 0),
(3, 11500, 4, 'TYTY1', '2021-01-12 02:34:52', 0),
(4, 4500, 5, 'TYTY1', '2021-01-12 02:39:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `avatar` varchar(100) DEFAULT 'avatar-1.png',
  `role_id` int(11) DEFAULT '2',
  `store_id` int(11) DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `employee`
--

TRUNCATE TABLE `employee`;
--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone`, `address`, `avatar`, `role_id`, `store_id`, `created_at`, `is_deleted`) VALUES
(0, 'kaisar', 'kaisar@msn.com', '$2a$08$g6axSKDVOvmKJOTOYUbK/OO1DP5vsSRPNtRBowHc.nQs2v5VGsoky', 'Kaisar', 'Sihir', '080000000000', 'Langit', 'avatar-7.png', 0, 1, '2020-11-18 22:55:22', 0),
(1, 'pemilik', 'pemilik@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', '', 'Pemilik', '081111111111', 'Headquarters', 'avatar-1.png', 1, 1, '2020-11-10 22:48:27', 0),
(2, 'gudang1', 'gudang1@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Admin', 'Gudang 1', '082222222222', 'Di gudang', 'avatar-2.png', 2, 1, '2020-11-10 22:52:15', 0),
(3, 'gudang2', 'gudang2@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Admin', 'Gudang 2', '083333333333', 'Di gudang', 'avatar-2.png', 2, 1, '2020-11-10 22:52:15', 0),
(4, 'kasircica1', 'kasir_cica1@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Cica 1', NULL, '084444444444', 'Cicalengka', 'avatar-3.png', 3, 2, '2020-11-10 22:54:23', 0),
(5, 'kasircica2', 'kasir_cica2@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Cica 2', NULL, '084444444445', 'Cicalengka', 'avatar-3.png', 3, 2, '2020-11-10 22:54:23', 0),
(6, 'kasiruber1', 'kasir_uber1@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Uber 1', NULL, '085555555555', 'Ujung Beruang', 'avatar-3.png', 3, 3, '2020-11-10 22:54:23', 0),
(7, 'kasiruber2', 'kasir_uber2@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Uber 2', NULL, '085555555556', 'Ujung Beruang', 'avatar-3.png', 3, 3, '2020-11-10 22:54:23', 0),
(8, 'admins', 'admin1@jp.com', '$2a$08$eDBmz5BisfYClwo.rs5k.Ot8pqR.3Ub/X1.1ANTc5bbaMJyy0H9Y.', 'dios', 'Ilham', '081236137132', 'Dipatiukur', 'avatar-1.png', 1, 1, '2020-11-17 03:19:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--
-- Creation: Jan 13, 2021 at 08:06 AM
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `left_to_paid` bigint(20) NOT NULL,
  `paid_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paid_type` enum('cash','transfer','kontrabon') NOT NULL COMMENT 'paid_amount ; cash=normal ; transfer=0 ; kontrabon=0 ;',
  `payment_img` varchar(250) DEFAULT NULL COMMENT 'Nama img.ext dari bukti bayar invoice ini',
  `transaction_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `invoice`
--

TRUNCATE TABLE `invoice`;
--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_number`, `paid_amount`, `left_to_paid`, `paid_at`, `paid_type`, `payment_img`, `transaction_id`, `created_at`, `status`, `is_deleted`) VALUES
(15, '1/KS/01/2021', 20000, 0, '2021-01-13 11:03:41', 'cash', NULL, 13, '2021-01-13 11:03:41', '0', 0),
(1, '1/KS/12/2020', 325000, 39000, '2020-12-24 15:49:14', 'cash', NULL, 1, '2020-12-24 15:49:14', '0', 0),
(16, '2/AR/01/2021', 0, 8008000, '2021-01-13 11:06:49', 'kontrabon', NULL, 14, '2021-01-13 11:06:49', '1', 0),
(10, '2/KS/12/2020', 512000, 81000, '2020-12-24 16:52:17', 'cash', NULL, 10, '2020-12-24 16:52:17', '1', 0),
(17, '3/AR/01/2021', 0, 100000, '2021-01-13 11:07:23', 'transfer', NULL, 15, '2021-01-13 11:07:23', '0', 0),
(11, '3/KS/12/2020', 80000, 1000, '2020-12-24 17:01:28', 'cash', NULL, 10, '2020-12-24 17:01:28', '0', 0),
(18, '4/AR/01/2021', 200000, 7808000, '2021-01-13 11:42:12', 'cash', NULL, 14, '2021-01-13 11:42:12', '0', 0),
(12, '4/KS/12/2020', 0, 80000, '2020-12-24 18:14:31', 'kontrabon', NULL, 11, '2020-12-24 18:14:31', '0', 0),
(19, '5/KS/01/2021', 0, 30000, '2021-01-13 17:36:51', 'kontrabon', NULL, 16, '2021-01-13 17:36:51', '0', 0),
(13, '5/KS/12/2020', 0, 270000, '2020-12-24 18:15:02', 'transfer', NULL, 12, '2020-12-24 18:15:02', '1', 0),
(20, '6/KS/01/2021', 0, 50000, '2021-01-13 18:16:38', 'kontrabon', NULL, 17, '2021-01-13 18:16:38', '0', 0),
(14, '6/KS/12/2020', 50000, 220000, '2020-12-24 18:26:13', 'cash', NULL, 12, '2020-12-24 18:26:13', '0', 0),
(21, '7/KS/01/2021', 35000, 17000, '2021-01-13 18:23:22', 'cash', NULL, 18, '2021-01-13 18:23:22', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `invoice_item`;
CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `invoice_item`
--

TRUNCATE TABLE `invoice_item`;
--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`id`, `quantity`, `item_price`, `invoice_id`, `product_id`) VALUES
(1, 2, 40000, 1, 1),
(2, 12, 324000, 1, 2),
(19, 4, 80000, 10, 1),
(20, 19, 513000, 10, 2),
(21, 4, 80000, 12, 1),
(22, 10, 270000, 13, 2),
(23, 2, 20000, 15, 1),
(24, 395, 7900000, 16, 1),
(25, 4, 108000, 16, 2),
(26, 5, 100000, 17, 1),
(27, 3, 30000, 19, 1),
(28, 5, 50000, 20, 1),
(29, 4, 52000, 21, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `kas`;
CREATE TABLE `kas` (
  `id` int(11) NOT NULL,
  `kas_code` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text,
  `date` date NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `final_balance` bigint(20) NOT NULL,
  `type` enum('debet','kredit') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `kas`
--

TRUNCATE TABLE `kas`;
--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id`, `kas_code`, `title`, `description`, `date`, `debet`, `kredit`, `final_balance`, `type`, `created_at`, `created_by`) VALUES
(1, 'D/20/12/000001', 'Checkout: INV 1/KS/12/2020', 'Total harga:364000 ; Total bayar:325000 ; Sisa harus dibayar:39000 ; Oleh:kasircica1', '2020-12-24', 325000, 0, 325000, 'debet', '2020-12-24 08:49:15', 'kasircica1'),
(4, 'D/20/12/000002', 'Checkout: INV 2/KS/12/2020', 'Total harga:593000 ; Total bayar:512000 ; Sisa harus dibayar:81000 ; Oleh:kasircica1', '2020-12-24', 512000, 0, 837000, 'debet', '2020-12-24 09:52:17', 'kasircica1'),
(5, 'D/20/12/000003', 'Checkout: INV 4/KS/12/2020', 'Total harga:80000 ; Total bayar:0 ; Sisa harus dibayar:80000 ; Oleh:kasircica1', '2020-12-24', 0, 0, 837000, 'debet', '2020-12-24 11:14:31', 'kasircica1'),
(6, 'D/20/12/000004', 'Checkout: INV 5/KS/12/2020', 'Total harga:270000 ; Total bayar:0 ; Sisa harus dibayar:270000 ; Oleh:kasircica1', '2020-12-24', 0, 0, 837000, 'debet', '2020-12-24 11:15:03', 'kasircica1'),
(7, 'D/21/01/000001', 'Checkout: INV 1/KS/01/2021', 'Total harga:20000 ; Total bayar:20000 ; Sisa harus dibayar:0 ; Oleh:gudang1', '2021-01-13', 20000, 0, 857000, 'debet', '2021-01-13 04:03:42', 'gudang1'),
(8, 'D/21/01/000002', 'Checkout: INV 2/AR/01/2021', 'Total harga:8008000 ; Total bayar:0 ; Sisa harus dibayar:8008000 ; Oleh:gudang1', '2021-01-13', 0, 0, 857000, 'debet', '2021-01-13 04:06:50', 'gudang1'),
(9, 'D/21/01/000003', 'Checkout: INV 3/AR/01/2021', 'Total harga:100000 ; Total bayar:0 ; Sisa harus dibayar:100000 ; Oleh:gudang1', '2021-01-13', 0, 0, 857000, 'debet', '2021-01-13 04:07:23', 'gudang1'),
(10, 'K/21/01/000004', 'Beli gorengan', NULL, '2021-01-13', 0, 12000, 845000, 'kredit', '2021-01-13 04:25:53', 'gudang1'),
(11, 'K/21/01/000005', 'Beli mi ayam', NULL, '2021-01-13', 0, 22000, 823000, 'kredit', '2021-01-13 04:26:07', 'gudang1'),
(12, 'K/21/01/000006', 'Pengeluaran aja lupa saya juga apa', NULL, '2020-10-02', 0, 42500, 780500, 'kredit', '2021-01-13 04:26:30', 'gudang1'),
(13, 'D/21/01/000007', 'Checkout: INV 5/KS/01/2021', 'Total harga:30000 ; Total bayar:0 ; Sisa harus dibayar:30000 ; Oleh:kaisar', '2021-01-13', 0, 0, 780500, 'debet', '2021-01-13 10:36:51', 'kaisar'),
(14, 'D/21/01/000008', 'Checkout: INV 6/KS/01/2021', 'Total harga:50000 ; Total bayar:0 ; Sisa harus dibayar:50000 ; Oleh:kaisar', '2021-01-13', 0, 0, 780500, 'debet', '2021-01-13 11:16:38', 'kaisar'),
(15, 'D/21/01/000009', 'Checkout: INV 7/KS/01/2021', 'Total harga:52000 ; Total bayar:35000 ; Sisa harus dibayar:17000 ; Oleh:kaisar', '2021-01-13', 35000, 0, 815500, 'debet', '2021-01-13 11:23:22', 'kaisar');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `material_code` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `unit` enum('mililiter','gram','pcs') NOT NULL DEFAULT 'mililiter',
  `volume` int(11) NOT NULL DEFAULT '0' COMMENT 'Jumlah dalam ml / gr / pcs',
  `category` enum('bahan','kemasan') NOT NULL DEFAULT 'bahan',
  `image` varchar(250) DEFAULT 'default.png',
  `price_base` int(11) NOT NULL DEFAULT '0' COMMENT 'Harga dasar / Harga beli / HPP per unit(ml/gr/pcs)',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `material`
--

TRUNCATE TABLE `material`;
--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `material_code`, `full_name`, `unit`, `volume`, `category`, `image`, `price_base`, `created_at`, `is_deleted`) VALUES
(1, 'BM001', 'Biji kopi robusta', 'gram', 1, 'bahan', 'default.png', 70, '2020-12-23 02:56:49', 0),
(2, 'BM002', 'Cup Styrofoam 200ml', 'pcs', 1, 'bahan', 'default.png', 1500, '2020-12-23 02:57:18', 0),
(3, 'BM003', 'Gula Pasir Putih', 'gram', 1, 'bahan', 'default.png', 20, '2020-12-23 02:57:49', 0),
(4, 'BM004', 'Sedotan Plastik', 'pcs', 1, 'bahan', 'default.png', 200, '2020-12-23 02:58:09', 0),
(5, 'BM005', 'Air mineral', 'gram', 1, 'bahan', 'default.png', 9, '2020-12-28 01:32:57', 0),
(6, 'BM006', 'Sedotan Stainless Steel', 'pcs', 1, 'bahan', 'default.png', 450, '2020-12-28 01:48:26', 0),
(11, 'DIO1', 'Mentah 1', 'gram', 1, 'bahan', 'default.png', 500, '2021-01-13 15:47:27', 1),
(7, 'QQQ1', 'QUAQ', 'gram', 1, 'bahan', 'default.png', 200, '2021-01-11 13:03:54', 0),
(10, 'RRE1', 'RECING1', 'gram', 1, 'bahan', 'default.png', 250, '2021-01-12 03:51:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_inventory`
--
-- Creation: Jan 11, 2021 at 08:35 PM
--

DROP TABLE IF EXISTS `material_inventory`;
CREATE TABLE `material_inventory` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `critical_point` int(11) NOT NULL DEFAULT '10',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `material_inventory`
--

TRUNCATE TABLE `material_inventory`;
--
-- Dumping data for table `material_inventory`
--

INSERT INTO `material_inventory` (`id`, `material_id`, `store_id`, `quantity`, `critical_point`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 4, 1, 0, 10, '2020-12-27 14:54:12', '2021-01-12 03:58:47', 'gudang1', 'kaisar', 0),
(2, 3, 1, 5100, 10, '2020-12-27 14:54:18', '2021-01-12 03:58:47', 'gudang1', 'kaisar', 0),
(4, 6, 1, 119, 10, '2020-12-28 01:48:26', '2021-01-12 03:35:56', 'gudang1', 'kaisar', 0),
(5, 2, 1, 16, 10, '2021-01-11 12:00:55', '2021-01-12 03:58:47', 'kaisar', 'kaisar', 0),
(6, 7, 1, 228, 10, '2021-01-11 13:03:54', '2021-01-12 03:35:56', 'kaisar', 'kaisar', 0),
(7, 1, 1, 488155, 10, '2021-01-11 13:06:55', '2021-01-12 03:58:47', 'kaisar', 'kaisar', 0),
(8, 5, 1, 16, 10, '2021-01-11 13:07:15', '2021-01-11 13:07:15', 'kaisar', 'kaisar', 0),
(18, 10, 1, 0, 10, '2021-01-12 03:51:09', NULL, 'kaisar', NULL, 1),
(19, 11, 1, 0, 10, '2021-01-13 15:47:27', NULL, 'gudang1', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_mutation`
--
-- Creation: Jan 11, 2021 at 06:46 PM
--

DROP TABLE IF EXISTS `material_mutation`;
CREATE TABLE `material_mutation` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `mutation_code` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mutation_type` enum('keluar','masuk') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `material_mutation`
--

TRUNCATE TABLE `material_mutation`;
--
-- Dumping data for table `material_mutation`
--

INSERT INTO `material_mutation` (`id`, `material_id`, `store_id`, `mutation_code`, `quantity`, `mutation_type`, `created_at`, `created_by`, `is_deleted`) VALUES
(1, 4, 2, '000001/MAT/KEL/24/12/2020', 2, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(11, 2, 1, '000001/MAT/MSK/11/01/2021', 101, 'masuk', '2021-01-11 12:00:55', 'kaisar', 0),
(2, 3, 2, '000002/MAT/KEL/24/12/2020', 60, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(12, 1, 1, '000002/MAT/MSK/11/01/2021', 155, 'masuk', '2021-01-11 13:06:56', 'kaisar', 0),
(3, 2, 2, '000003/MAT/KEL/24/12/2020', 2, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(13, 5, 1, '000003/MAT/MSK/11/01/2021', 16, 'masuk', '2021-01-11 13:07:15', 'kaisar', 0),
(4, 1, 2, '000004/MAT/KEL/24/12/2020', 200, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(14, 6, 1, '000004/MAT/MSK/11/01/2021', 11, 'masuk', '2021-01-11 13:07:23', 'kaisar', 0),
(5, 4, 2, '000005/MAT/KEL/24/12/2020', 12, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(15, 2, 1, '000005/MAT/MSK/11/01/2021', 15, 'masuk', '2021-01-11 13:07:31', 'kaisar', 0),
(6, 3, 2, '000006/MAT/KEL/24/12/2020', 600, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(16, 7, 1, '000006/MAT/MSK/11/01/2021', 4, 'masuk', '2021-01-11 13:07:42', 'kaisar', 0),
(7, 2, 2, '000007/MAT/KEL/24/12/2020', 12, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(17, 7, 1, '000007/MAT/MSK/12/01/2021', 254, 'masuk', '2021-01-12 01:12:25', 'kaisar', 0),
(8, 1, 2, '000008/MAT/KEL/24/12/2020', 1440, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(18, 6, 1, '000008/MAT/MSK/12/01/2021', 123, 'masuk', '2021-01-12 02:59:49', 'kaisar', 0),
(67, 6, 1, '000009/MAT/KEL/12/01/2021', 15, 'keluar', '2021-01-12 03:35:56', 'kaisar', 0),
(9, 4, 1, '000009/MAT/MSK/27/12/2020', 100, 'masuk', '2020-12-27 14:54:12', 'gudang1', 0),
(68, 7, 1, '000010/MAT/KEL/12/01/2021', 30, 'keluar', '2021-01-12 03:35:56', 'kaisar', 0),
(10, 3, 1, '000010/MAT/MSK/27/12/2020', 100, 'masuk', '2020-12-27 14:54:18', 'gudang1', 0),
(69, 3, 1, '000011/MAT/MSK/12/01/2021', 10000, 'masuk', '2021-01-12 03:45:06', 'kaisar', 0),
(70, 1, 1, '000012/MAT/MSK/12/01/2021', 500000, 'masuk', '2021-01-12 03:56:31', 'kaisar', 0),
(83, 1, 1, '000013/MAT/KEL/12/01/2021', 12000, 'keluar', '2021-01-12 03:58:47', 'kaisar', 0),
(84, 2, 1, '000014/MAT/KEL/12/01/2021', 100, 'keluar', '2021-01-12 03:58:47', 'kaisar', 0),
(85, 3, 1, '000015/MAT/KEL/12/01/2021', 5000, 'keluar', '2021-01-12 03:58:47', 'kaisar', 0),
(86, 4, 1, '000016/MAT/KEL/12/01/2021', 100, 'keluar', '2021-01-12 03:58:47', 'kaisar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--
-- Creation: Dec 22, 2020 at 07:56 AM
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `unit` enum('gram','mililiter','liter','pcs','sachet','galon','drum','pail') NOT NULL DEFAULT 'mililiter',
  `volume` int(11) NOT NULL DEFAULT '0' COMMENT 'Jumlah dalam ''gram'',''mililiter'',''liter'',''pcs'',''sachet'',''galon'',''drum'',''pile''',
  `image` varchar(250) DEFAULT 'default.png',
  `price_base` int(11) NOT NULL DEFAULT '0' COMMENT 'Harga dasar / Harga beli / HPP',
  `selling_price` int(11) NOT NULL DEFAULT '0' COMMENT 'Harga jual normal untuk customer biasa',
  `reseller_price` int(11) NOT NULL DEFAULT '0' COMMENT 'Harga jual untuk customer reseller',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `product`
--

TRUNCATE TABLE `product`;
--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_code`, `full_name`, `unit`, `volume`, `image`, `price_base`, `selling_price`, `reseller_price`, `created_at`, `is_deleted`) VALUES
(4, 'KEPO1', 'tes1', 'mililiter', 100, 'default.png', 0, 0, 0, '2021-01-13 17:57:11', 0),
(1, 'PR001', 'Kopi Nikmat', 'pcs', 1, 'default.png', 9300, 20000, 0, '2020-12-23 03:58:42', 0),
(2, 'PR002', 'Kopi robusta blend', 'pcs', 1, 'default.png', 11100, 27000, 3000, '2020-12-23 16:43:25', 0),
(3, 'TYTY1', 'TES1', 'mililiter', 150, 'default.png', 859, 13000, 6500, '2021-01-11 16:04:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_composition`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `product_composition`;
CREATE TABLE `product_composition` (
  `id` int(11) NOT NULL,
  `volume` int(11) NOT NULL COMMENT 'Jumlah dalam ml / gr',
  `product_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `product_composition`
--

TRUNCATE TABLE `product_composition`;
--
-- Dumping data for table `product_composition`
--

INSERT INTO `product_composition` (`id`, `volume`, `product_id`, `material_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 1, 1, 4, '2020-12-23 15:20:19', '2020-12-23 15:20:19', 0),
(2, 30, 1, 3, '2020-12-23 15:20:19', '2020-12-23 15:20:19', 0),
(3, 1, 1, 2, '2020-12-23 15:20:19', '2020-12-23 15:20:19', 0),
(4, 100, 1, 1, '2020-12-23 15:20:19', '2020-12-23 15:20:19', 0),
(5, 1, 2, 4, '2020-12-23 16:44:09', '2020-12-23 16:44:09', 0),
(6, 50, 2, 3, '2020-12-23 16:44:09', '2020-12-23 16:44:09', 0),
(7, 1, 2, 2, '2020-12-23 16:44:09', '2020-12-23 16:44:09', 0),
(8, 120, 2, 1, '2020-12-23 16:44:09', '2020-12-23 16:44:09', 0),
(9, 2, 3, 7, '2021-01-11 16:04:50', '2021-01-11 16:04:50', 0),
(10, 1, 3, 6, '2021-01-11 16:04:50', '2021-01-11 16:04:50', 0),
(11, 1, 3, 5, '2021-01-13 16:20:37', '2021-01-13 16:20:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--
-- Creation: Dec 23, 2020 at 09:51 AM
--

DROP TABLE IF EXISTS `product_inventory`;
CREATE TABLE `product_inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '0',
  `critical_point` int(11) NOT NULL DEFAULT '10',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `product_inventory`
--

TRUNCATE TABLE `product_inventory`;
--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `product_id`, `store_id`, `quantity`, `critical_point`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 1, 2, 992, 0, '2020-12-23 16:47:37', '2020-12-24 18:14:31', 'gudang1', 'kasircica1', 0),
(2, 1, 3, 1000, 0, '2020-12-23 16:47:37', NULL, 'gudang1', NULL, 0),
(3, 2, 2, 971, 0, '2020-12-23 16:47:37', '2020-12-24 18:15:02', 'gudang1', 'kasircica1', 0),
(4, 2, 3, 1000, 0, '2020-12-23 16:47:37', NULL, 'gudang1', NULL, 0),
(5, 1, 1, 90, 10, '2020-12-24 06:43:26', '2021-01-13 18:16:38', 'gudang1', 'kaisar', 0),
(6, 2, 1, 97, 10, '2020-12-24 06:43:26', '2021-01-13 11:06:49', 'gudang1', 'gudang1', 0),
(14, 3, 1, 11, 10, '2021-01-12 03:35:56', '2021-01-13 18:23:22', NULL, 'kaisar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_mutation`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `product_mutation`;
CREATE TABLE `product_mutation` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `mutation_code` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mutation_type` enum('keluar','masuk') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `product_mutation`
--

TRUNCATE TABLE `product_mutation`;
--
-- Dumping data for table `product_mutation`
--

INSERT INTO `product_mutation` (`id`, `product_id`, `store_id`, `mutation_code`, `quantity`, `mutation_type`, `created_at`, `created_by`, `is_deleted`) VALUES
(1, 1, 2, '000001/PRO/KEL/24/12/2020', 2, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(55, 3, 1, '000001/PRO/MSK/12/01/2021', 15, 'masuk', '2021-01-12 03:35:56', 'kaisar', 0),
(2, 2, 2, '000002/PRO/KEL/24/12/2020', 12, 'keluar', '2020-12-24 15:49:14', 'kasircica1', 0),
(59, 2, 1, '000002/PRO/MSK/12/01/2021', 100, 'masuk', '2021-01-12 03:58:47', 'kaisar', 0),
(60, 1, 1, '000003/PRO/KEL/13/01/2021', 2, 'keluar', '2021-01-13 11:03:41', 'gudang1', 0),
(19, 1, 2, '000003/PRO/KEL/24/12/2020', 4, 'keluar', '2020-12-24 16:52:17', 'kasircica1', 0),
(61, 1, 1, '000004/PRO/KEL/13/01/2021', 395, 'keluar', '2021-01-13 11:06:49', 'gudang1', 0),
(20, 2, 2, '000004/PRO/KEL/24/12/2020', 19, 'keluar', '2020-12-24 16:52:17', 'kasircica1', 0),
(62, 2, 1, '000005/PRO/KEL/13/01/2021', 4, 'keluar', '2021-01-13 11:06:49', 'gudang1', 0),
(21, 1, 2, '000005/PRO/KEL/24/12/2020', 4, 'keluar', '2020-12-24 18:14:31', 'kasircica1', 0),
(63, 1, 1, '000006/PRO/KEL/13/01/2021', 5, 'keluar', '2021-01-13 11:07:23', 'gudang1', 0),
(22, 2, 2, '000006/PRO/KEL/24/12/2020', 10, 'keluar', '2020-12-24 18:15:02', 'kasircica1', 0),
(64, 1, 1, '000007/PRO/KEL/13/01/2021', 3, 'keluar', '2021-01-13 17:36:51', 'kaisar', 0),
(65, 1, 1, '000008/PRO/KEL/13/01/2021', 5, 'keluar', '2021-01-13 18:16:38', 'kaisar', 0),
(66, 3, 1, '000009/PRO/KEL/13/01/2021', 4, 'keluar', '2021-01-13 18:23:22', 'kaisar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `role`
--

TRUNCATE TABLE `role`;
--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `created_at`, `is_deleted`) VALUES
(0, 'kaisar', '2020-11-10 22:46:29', 0),
(1, 'owner', '2020-11-10 22:46:29', 0),
(2, 'admin', '2020-11-10 22:46:29', 0),
(3, 'cashier', '2020-11-10 22:46:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `store_name` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `store`
--

TRUNCATE TABLE `store`;
--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `store_name`, `address`, `created_at`, `is_deleted`) VALUES
(1, 'Gudang Pusat', 'Jawa Barat, Indonesia', '2020-11-08 13:07:02', 0),
(2, 'Toko Cicalengka', 'Cicalengka', '2020-11-08 13:07:02', 0),
(3, 'Toko Ujung Berung', 'Ujung Berung', '2020-11-08 13:07:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--
-- Creation: Dec 22, 2020 at 06:07 AM
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trans_number` varchar(100) NOT NULL,
  `deliv_address` varchar(250) NOT NULL,
  `price_total` bigint(20) NOT NULL,
  `store_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `due_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `transaction`
--

TRUNCATE TABLE `transaction`;
--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `trans_number`, `deliv_address`, `price_total`, `store_id`, `customer_id`, `employee_id`, `due_at`, `created_at`, `is_deleted`) VALUES
(13, 'TRX/01/2021/000001', 'Jalanan Tengah', 20000, 1, 2, 2, '2021-01-13 11:03:41', '2021-01-13 11:03:41', 0),
(14, 'TRX/01/2021/000002', 'Cicalengka', 8008000, 1, 3, 2, '2021-01-20 11:06:49', '2021-01-13 11:06:49', 0),
(15, 'TRX/01/2021/000003', 'Cicalengka', 100000, 1, 3, 2, '2021-01-20 11:07:23', '2021-01-13 11:07:23', 0),
(16, 'TRX/01/2021/000004', 'Jalanan scadasdasd', 30000, 1, 2, 0, '2021-01-20 17:36:51', '2021-01-13 17:36:51', 0),
(17, 'TRX/01/2021/000005', 'Jalanan Tengah', 50000, 1, 2, 0, '2021-01-20 18:16:38', '2021-01-13 18:16:38', 0),
(18, 'TRX/01/2021/000006', 'Jalanan Tengah', 52000, 1, 2, 0, '2021-01-20 18:23:22', '2021-01-13 18:23:22', 0),
(1, 'TRX/12/2020/000001', 'Jalanan', 364000, 2, 1, 4, '2020-12-31 15:49:14', '2020-12-24 15:49:14', 0),
(10, 'TRX/12/2020/000002', 'Jalanan di saidan', 593000, 2, 1, 4, '2020-12-31 16:52:17', '2020-12-24 16:52:17', 0),
(11, 'TRX/12/2020/000003', 'Jalanan', 80000, 2, 1, 4, '2020-12-31 18:14:31', '2020-12-24 18:14:31', 0),
(12, 'TRX/12/2020/000004', 'Jalanan', 270000, 2, 1, 4, '2020-12-31 18:15:02', '2020-12-24 18:15:02', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basic_info_meta`
--
ALTER TABLE `basic_info_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `custom_price`
--
ALTER TABLE `custom_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_code` (`product_code`);

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
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `left_to_paid` (`left_to_paid`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `product_id` (`product_id`),
  ADD KEY `store_id` (`store_id`);

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
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basic_info_meta`
--
ALTER TABLE `basic_info_meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `custom_price`
--
ALTER TABLE `custom_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `material_inventory`
--
ALTER TABLE `material_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `material_mutation`
--
ALTER TABLE `material_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_composition`
--
ALTER TABLE `product_composition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_mutation`
--
ALTER TABLE `product_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basic_info_meta`
--
ALTER TABLE `basic_info_meta`
  ADD CONSTRAINT `basic_info_meta_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `custom_price`
--
ALTER TABLE `custom_price`
  ADD CONSTRAINT `custom_price_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `custom_price_ibfk_2` FOREIGN KEY (`product_code`) REFERENCES `product` (`product_code`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD CONSTRAINT `invoice_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_item_ibfk_3` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `product_composition_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_composition_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_inventory`
--
ALTER TABLE `product_inventory`
  ADD CONSTRAINT `product_inventory_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_inventory_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_mutation`
--
ALTER TABLE `product_mutation`
  ADD CONSTRAINT `product_mutation_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_mutation_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
