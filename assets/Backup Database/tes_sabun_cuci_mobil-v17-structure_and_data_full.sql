-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2021 at 04:36 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

--
-- Author: @Galaxxdev - dioilham.com
--
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Creation: Jan 28, 2021 at 02:08 PM
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
  `store_id` int(11) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_by` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `basic_info_meta`:
--   `store_id`
--       `store` -> `id`
--

--
-- Truncate table before insert `basic_info_meta`
--

TRUNCATE TABLE `basic_info_meta`;
--
-- Dumping data for table `basic_info_meta`
--

INSERT INTO `basic_info_meta` (`id`, `fullname`, `address`, `contact_1`, `contact_2`, `email`, `website`, `logo`, `store_id`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'Sabun Aryanz - gudang', 'Jabar, Indonesia', '08123981232', '1231231232', 'halo@sabun-aryanz.com', 'http://sabun-aryanz.com', 'logo.png', 1, '2020-11-16 03:02:30', '2021-01-26 18:01:18', 'gudang1'),
(2, 'Sabun Aryanz - kasir cica 1', 'Cicalengka, Jabar, Indonesia', '08111111111', '08222222222', 'halo@sabun-aryanz.com', 'http://sabun-aryanz.com', 'logo.png', 2, '2021-01-13 18:00:00', '2021-01-26 18:01:46', 'kasircica1'),
(3, 'Sabun Aryanz - kasir uber 1', 'Ujung Berung, Jabar, Indonesia', '5678987667', '1231232454', 'halo@sabun-aryanz.com', 'http://sabun-aryanz.com', 'logo.png', 3, '2021-01-13 18:00:00', '2021-01-26 19:46:48', 'kasiruber1');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--
-- Creation: Jan 29, 2021 at 01:53 PM
-- Last update: Mar 16, 2021 at 03:12 AM
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `cust_type` enum('retail','reseller') NOT NULL DEFAULT 'retail',
  `store_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `is_store` tinyint(2) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `customer`:
--   `store_id`
--       `store` -> `id`
--

--
-- Truncate table before insert `customer`
--

TRUNCATE TABLE `customer`;
--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `full_name`, `address`, `phone`, `cust_type`, `store_id`, `created_at`, `is_store`, `is_deleted`) VALUES
(1, 'Toko Cicalengka', 'Cicalengka, Jawa Barat, ID', '086969696969', 'reseller', 1, '2021-02-01 02:33:53', 1, 0),
(2, 'Toko Ujung Berung', 'Ujung Berung, Jawa Barat, ID', '086969696969', 'reseller', 1, '2021-02-01 02:33:53', 1, 0),
(12, 'dio', 'jalanan', '081232131231', 'reseller', 1, '2021-03-09 18:05:23', 0, 0),
(13, 'Yaha', 'jalanann', '08465456145612', 'reseller', 2, '2021-03-16 10:07:16', 0, 0),
(14, 'Metallica', 'asdasdasasdsa', '0844456456456', 'retail', 3, '2021-03-16 10:12:32', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `custom_price`
--
-- Creation: Jan 28, 2021 at 02:08 PM
--

DROP TABLE IF EXISTS `custom_price`;
CREATE TABLE `custom_price` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `custom_price`:
--   `customer_id`
--       `customer` -> `id`
--   `product_code`
--       `product` -> `product_code`
--

--
-- Truncate table before insert `custom_price`
--

TRUNCATE TABLE `custom_price`;
-- --------------------------------------------------------

--
-- Table structure for table `employee`
--
-- Creation: Jan 28, 2021 at 02:08 PM
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
  `role_id` int(11) DEFAULT 2,
  `store_id` int(11) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `employee`:
--   `role_id`
--       `role` -> `id`
--   `store_id`
--       `store` -> `id`
--

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
(7, 'kasiruber2', 'kasir_uber2@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Uber 2', NULL, '085555555556', 'Ujung Beruang', 'avatar-3.png', 3, 3, '2020-11-10 22:54:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--
-- Creation: Mar 16, 2021 at 01:53 AM
-- Last update: Mar 16, 2021 at 03:13 AM
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `left_to_paid` bigint(20) NOT NULL,
  `paid_at` datetime NOT NULL DEFAULT current_timestamp(),
  `paid_type` enum('cash','transfer','kontrabon') NOT NULL COMMENT 'paid_amount ; cash=normal ; transfer=0 ; kontrabon=0 ;',
  `payment_img` varchar(250) DEFAULT NULL COMMENT 'Nama img.ext dari bukti bayar invoice ini',
  `transaction_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `invoice`:
--   `transaction_id`
--       `transaction` -> `id`
--   `store_id`
--       `store` -> `id`
--

--
-- Truncate table before insert `invoice`
--

TRUNCATE TABLE `invoice`;
--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_number`, `paid_amount`, `left_to_paid`, `paid_at`, `paid_type`, `payment_img`, `transaction_id`, `store_id`, `created_at`, `status`, `is_deleted`) VALUES
(1, '1/AR/03/2021', 515000, 260000, '2021-03-09 18:16:38', 'cash', NULL, 1, 1, '2021-03-09 18:16:38', '0', 0),
(2, '2/AR/03/2021', 1500000, 0, '2021-03-09 19:16:19', 'cash', NULL, 2, 1, '2021-03-09 19:16:19', '0', 0),
(3, '3/CB/03/2021', 50000, 0, '2021-03-09 21:19:56', 'kontrabon', NULL, 3, 1, '2021-03-09 21:19:56', '0', 0),
(4, '4/AR/03/2021', 1100000, 0, '2021-03-09 21:20:24', 'cash', NULL, 4, 1, '2021-03-09 21:20:24', '0', 0),
(5, '5/AR/03/2021', 50000, 0, '2021-03-09 21:20:35', 'kontrabon', NULL, 5, 1, '2021-03-09 21:20:35', '0', 0),
(8, '6/AR/03/2021', 250000, 0, '2021-03-16 10:01:57', 'kontrabon', NULL, 7, 1, '2021-03-16 10:01:57', '0', 0),
(9, '1/AR/03/2021', 50000, 0, '2021-03-16 10:08:49', 'kontrabon', NULL, 12, 2, '2021-03-16 10:08:49', '0', 0),
(11, '7/CB/03/2021', 0, 125000, '2021-03-16 10:11:35', 'kontrabon', NULL, 17, 1, '2021-03-16 10:11:35', '0', 0),
(12, '8/CB/03/2021', 0, 2952000, '2021-03-16 10:12:14', 'kontrabon', NULL, 18, 1, '2021-03-16 10:12:14', '0', 0),
(13, '1/KS/03/2021', 500000, 236000, '2021-03-16 10:12:44', 'cash', NULL, 19, 3, '2021-03-16 10:12:44', '0', 0),
(14, '2/KS/03/2021', 0, 100000, '2021-03-16 10:13:10', 'kontrabon', NULL, 20, 3, '2021-03-16 10:13:10', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Mar 16, 2021 at 03:13 AM
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
-- RELATIONSHIPS FOR TABLE `invoice_item`:
--   `product_id`
--       `product` -> `id`
--   `invoice_id`
--       `invoice` -> `id`
--

--
-- Truncate table before insert `invoice_item`
--

TRUNCATE TABLE `invoice_item`;
--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`id`, `quantity`, `item_price`, `invoice_id`, `product_id`) VALUES
(1, 13, 650000, 1, 1),
(2, 5, 125000, 1, 2),
(3, 20, 500000, 2, 2),
(4, 29, 638000, 2, 3),
(5, 1, 50000, 3, 1),
(6, 22, 1100000, 4, 1),
(7, 1, 50000, 5, 1),
(8, 5, 250000, 8, 1),
(9, 1, 50000, 9, 1),
(10, 5, 125000, 11, 2),
(11, 60, 1500000, 12, 2),
(12, 66, 1452000, 12, 3),
(13, 23, 736000, 13, 2),
(14, 4, 100000, 14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--
-- Creation: Feb 03, 2021 at 03:18 PM
-- Last update: Mar 16, 2021 at 03:12 AM
--

DROP TABLE IF EXISTS `kas`;
CREATE TABLE `kas` (
  `id` int(11) NOT NULL,
  `kas_code` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `debet` bigint(20) UNSIGNED NOT NULL,
  `kredit` bigint(20) UNSIGNED NOT NULL,
  `final_balance` bigint(20) NOT NULL,
  `type` enum('debet','kredit') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `kas`:
--

--
-- Truncate table before insert `kas`
--

TRUNCATE TABLE `kas`;
--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id`, `kas_code`, `title`, `description`, `date`, `debet`, `kredit`, `final_balance`, `type`, `created_at`, `created_by`) VALUES
(1, 'D/21/03/000001', 'Checkout: INV 1/AR/03/2021', 'Total harga:775000 ; Total bayar:500000 ; Sisa harus dibayar:275000 ; Oleh:gudang1', '2021-03-09', 500000, 0, 500000, 'debet', '2021-03-09 11:16:39', 'gudang1'),
(2, 'D/21/03/000002', 'Checkout: INV 2/AR/03/2021', 'Total harga:1138000 ; Total bayar:1500000 ; Sisa harus dibayar:-362000 ; Oleh:gudang1', '2021-03-09', 1138000, 0, 1638000, 'debet', '2021-03-09 12:16:19', 'gudang1'),
(3, 'D/21/03/000003', 'Checkout: INV 4/AR/03/2021', 'Total harga:1100000 ; Total bayar:1000000 ; Sisa harus dibayar:100000 ; Oleh:gudang1', '2021-03-09', 1000000, 0, 2638000, 'debet', '2021-03-09 14:20:25', 'gudang1'),
(4, 'D/21/03/000004', 'Bayar Utang: INV 5/AR/03/2021', 'Sisa utang awal:35000 ; Total bayar:5000 ; Sisa harus dibayar:30000 ; Oleh:gudang1', '2021-03-16', 5000, 0, 2643000, 'debet', '2021-03-16 02:56:17', 'gudang1'),
(5, 'D/21/03/000005', 'Bayar Utang: INV 5/AR/03/2021', 'Sisa utang awal:30000 ; Total bayar:3000 ; Sisa harus dibayar:27000 ; Oleh:gudang1', '2021-03-16', 3000, 0, 2646000, 'debet', '2021-03-16 02:56:30', 'gudang1'),
(6, 'D/21/03/000006', 'Bayar Utang: INV 5/AR/03/2021', 'Sisa utang awal:27000 ; Total bayar:27000 ; Sisa harus dibayar:0 ; Oleh:gudang1', '2021-03-16', 27000, 0, 2673000, 'debet', '2021-03-16 02:56:39', 'gudang1'),
(7, 'D/21/03/000007', 'Bayar Utang: INV 3/CB/03/2021', 'Sisa utang awal:48766 ; Total bayar:48766 ; Sisa harus dibayar:0 ; Oleh:gudang1', '2021-03-16', 48766, 0, 2721766, 'debet', '2021-03-16 02:57:38', 'gudang1'),
(8, 'D/21/03/000008', 'Bayar Utang: INV 1/AR/03/2021', 'Sisa utang awal:275000 ; Total bayar:15000 ; Sisa harus dibayar:260000 ; Oleh:gudang1', '2021-03-16', 15000, 0, 2736766, 'debet', '2021-03-16 02:58:11', 'gudang1'),
(9, 'D/21/03/000009', 'Bayar Utang: INV 5/AR/03/2021', 'Sisa utang awal:30000 ; Total bayar:30000 ; Sisa harus dibayar:0 ; Oleh:gudang1', '2021-03-16', 30000, 0, 2766766, 'debet', '2021-03-16 02:58:32', 'gudang1'),
(10, 'D/21/03/000010', 'Bayar Utang: INV 5/AR/03/2021', 'Sisa utang awal:48000 ; Total bayar:2000 ; Sisa harus dibayar:46000 ; Oleh:gudang1', '2021-03-16', 2000, 0, 2768766, 'debet', '2021-03-16 02:59:45', 'gudang1'),
(11, 'D/21/03/000011', 'Bayar Utang: INV 5/AR/03/2021', 'Sisa utang awal:46000 ; Total bayar:46000 ; Sisa harus dibayar:0 ; Oleh:gudang1', '2021-03-16', 46000, 0, 2814766, 'debet', '2021-03-16 02:59:50', 'gudang1'),
(12, 'D/21/03/000012', 'Bayar Utang: INV 6/AR/03/2021', 'Sisa utang awal:250000 ; Total bayar:15000 ; Sisa harus dibayar:235000 ; Oleh:gudang1', '2021-03-16', 15000, 0, 2829766, 'debet', '2021-03-16 03:02:45', 'gudang1'),
(13, 'D/21/03/000013', 'Bayar Utang: INV 6/AR/03/2021', 'Sisa utang awal:235000 ; Total bayar:50000 ; Sisa harus dibayar:185000 ; Oleh:gudang1', '2021-03-16', 50000, 0, 2879766, 'debet', '2021-03-16 03:02:53', 'gudang1'),
(14, 'D/21/03/000014', 'Bayar Utang: INV 6/AR/03/2021', 'Sisa utang awal:185000 ; Total bayar:185000 ; Sisa harus dibayar:0 ; Oleh:gudang1', '2021-03-16', 185000, 0, 3064766, 'debet', '2021-03-16 03:03:10', 'gudang1'),
(15, 'D/21/03/000015', 'Bayar Utang: INV 1/AR/03/2021', 'Sisa utang awal:50000 ; Total bayar:40000 ; Sisa harus dibayar:10000 ; Oleh:kasircica1', '2021-03-16', 40000, 0, 3104766, 'debet', '2021-03-16 03:09:16', 'kasircica1'),
(16, 'D/21/03/000016', 'Bayar Utang: INV 1/AR/03/2021', 'Sisa utang awal:10000 ; Total bayar:10000 ; Sisa harus dibayar:0 ; Oleh:kasircica1', '2021-03-16', 10000, 0, 3114766, 'debet', '2021-03-16 03:09:21', 'kasircica1'),
(17, 'D/21/03/000017', 'Checkout: INV 1/KS/03/2021', 'Total harga:736000 ; Total bayar:500000 ; Sisa harus dibayar:236000 ; Oleh:kasiruber1', '2021-03-16', 500000, 0, 3614766, 'debet', '2021-03-16 03:12:44', 'kasiruber1');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--
-- Creation: Jan 28, 2021 at 02:08 PM
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `material_code` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `unit` enum('mililiter','gram','pcs') NOT NULL DEFAULT 'mililiter',
  `volume` int(11) NOT NULL DEFAULT 0 COMMENT 'Jumlah dalam ml / gr / pcs',
  `category` enum('bahan','kemasan') NOT NULL DEFAULT 'bahan',
  `image` varchar(250) DEFAULT 'default.png',
  `price_base` int(11) NOT NULL DEFAULT 0 COMMENT 'Harga dasar / Harga beli / HPP per unit(ml/gr/pcs)',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `material`:
--

--
-- Truncate table before insert `material`
--

TRUNCATE TABLE `material`;
--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `material_code`, `full_name`, `unit`, `volume`, `category`, `image`, `price_base`, `created_at`, `is_deleted`) VALUES
(1, 'BB1', 'bahan baku 1', 'gram', 1, 'bahan', 'default.png', 10, '2021-03-09 18:06:12', 0),
(2, 'BB2', 'bahan baku 2', 'gram', 1, 'bahan', 'default.png', 16, '2021-03-09 18:06:24', 0),
(3, 'BB3', 'bahan baku 3', 'pcs', 1, 'bahan', 'default.png', 12000, '2021-03-09 18:07:03', 0),
(4, 'BB4', 'bahan baku 4', 'pcs', 1, 'bahan', 'default.png', 23000, '2021-03-09 18:07:12', 0),
(5, 'BB5', 'bahan baku 5', 'mililiter', 1, 'bahan', 'default.png', 7, '2021-03-09 18:07:28', 0),
(6, 'BB6', 'bahan baku 6', 'mililiter', 1, 'bahan', 'default.png', 19, '2021-03-09 18:07:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `material_inventory`
--
-- Creation: Jan 28, 2021 at 02:08 PM
--

DROP TABLE IF EXISTS `material_inventory`;
CREATE TABLE `material_inventory` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `quantity` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `critical_point` int(11) NOT NULL DEFAULT 10,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `material_inventory`:
--   `material_id`
--       `material` -> `id`
--   `store_id`
--       `store` -> `id`
--

--
-- Truncate table before insert `material_inventory`
--

TRUNCATE TABLE `material_inventory`;
--
-- Dumping data for table `material_inventory`
--

INSERT INTO `material_inventory` (`id`, `material_id`, `store_id`, `quantity`, `critical_point`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 1, 1, 1132000, 10, '2021-03-09 18:06:12', '2021-03-09 18:13:24', 'pemilik', 'pemilik', 0),
(2, 2, 1, 1178000, 10, '2021-03-09 18:06:24', '2021-03-09 18:14:36', 'pemilik', 'pemilik', 0),
(3, 3, 1, 1600, 10, '2021-03-09 18:07:03', '2021-03-09 18:15:34', 'pemilik', 'pemilik', 0),
(4, 4, 1, 1812, 10, '2021-03-09 18:07:12', '2021-03-09 21:02:12', 'pemilik', 'pemilik', 0),
(5, 5, 1, 1102000, 10, '2021-03-09 18:07:28', '2021-03-09 18:15:34', 'pemilik', 'pemilik', 0),
(6, 6, 1, 1092000, 10, '2021-03-09 18:07:37', '2021-03-09 18:13:12', 'pemilik', 'pemilik', 0);

-- --------------------------------------------------------

--
-- Table structure for table `material_mutation`
--
-- Creation: Jan 28, 2021 at 02:08 PM
--

DROP TABLE IF EXISTS `material_mutation`;
CREATE TABLE `material_mutation` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `mutation_code` varchar(100) NOT NULL,
  `quantity` bigint(20) UNSIGNED NOT NULL,
  `mutation_type` enum('keluar','masuk') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `material_mutation`:
--   `material_id`
--       `material` -> `id`
--   `store_id`
--       `store` -> `id`
--

--
-- Truncate table before insert `material_mutation`
--

TRUNCATE TABLE `material_mutation`;
--
-- Dumping data for table `material_mutation`
--

INSERT INTO `material_mutation` (`id`, `material_id`, `store_id`, `mutation_code`, `quantity`, `mutation_type`, `created_at`, `created_by`, `is_deleted`) VALUES
(1, 1, 1, '000001/MAT/MSK/09/03/2021', 2000, 'masuk', '2021-03-09 18:07:52', 'pemilik', 0),
(2, 2, 1, '000002/MAT/MSK/09/03/2021', 2000, 'masuk', '2021-03-09 18:07:57', 'pemilik', 0),
(3, 3, 1, '000003/MAT/MSK/09/03/2021', 2000, 'masuk', '2021-03-09 18:08:04', 'pemilik', 0),
(4, 4, 1, '000004/MAT/MSK/09/03/2021', 2000, 'masuk', '2021-03-09 18:08:09', 'pemilik', 0),
(5, 5, 1, '000005/MAT/MSK/09/03/2021', 2000, 'masuk', '2021-03-09 18:08:14', 'pemilik', 0),
(6, 6, 1, '000006/MAT/MSK/09/03/2021', 2000, 'masuk', '2021-03-09 18:08:19', 'pemilik', 0),
(7, 1, 1, '000007/MAT/MSK/09/03/2021', 200000, 'masuk', '2021-03-09 18:12:07', 'pemilik', 0),
(8, 2, 1, '000008/MAT/MSK/09/03/2021', 200000, 'masuk', '2021-03-09 18:12:11', 'pemilik', 0),
(9, 5, 1, '000009/MAT/MSK/09/03/2021', 200000, 'masuk', '2021-03-09 18:12:17', 'pemilik', 0),
(10, 6, 1, '000010/MAT/MSK/09/03/2021', 200000, 'masuk', '2021-03-09 18:12:23', 'pemilik', 0),
(11, 1, 1, '000011/MAT/KEL/09/03/2021', 70000, 'keluar', '2021-03-09 18:12:50', 'pemilik', 0),
(12, 4, 1, '000012/MAT/KEL/09/03/2021', 200, 'keluar', '2021-03-09 18:12:50', 'pemilik', 0),
(13, 6, 1, '000013/MAT/KEL/09/03/2021', 110000, 'keluar', '2021-03-09 18:12:50', 'pemilik', 0),
(14, 6, 1, '000014/MAT/MSK/09/03/2021', 1000000, 'masuk', '2021-03-09 18:13:12', 'pemilik', 0),
(15, 5, 1, '000015/MAT/MSK/09/03/2021', 1000000, 'masuk', '2021-03-09 18:13:16', 'pemilik', 0),
(16, 2, 1, '000016/MAT/MSK/09/03/2021', 1000000, 'masuk', '2021-03-09 18:13:20', 'pemilik', 0),
(17, 1, 1, '000017/MAT/MSK/09/03/2021', 1000000, 'masuk', '2021-03-09 18:13:24', 'pemilik', 0),
(18, 2, 1, '000018/MAT/KEL/09/03/2021', 24000, 'keluar', '2021-03-09 18:14:36', 'pemilik', 0),
(19, 3, 1, '000019/MAT/KEL/09/03/2021', 200, 'keluar', '2021-03-09 18:14:36', 'pemilik', 0),
(20, 5, 1, '000020/MAT/KEL/09/03/2021', 40000, 'keluar', '2021-03-09 18:14:36', 'pemilik', 0),
(21, 3, 1, '000021/MAT/KEL/09/03/2021', 200, 'keluar', '2021-03-09 18:15:34', 'pemilik', 0),
(22, 5, 1, '000022/MAT/KEL/09/03/2021', 60000, 'keluar', '2021-03-09 18:15:34', 'pemilik', 0),
(23, 4, 1, '000023/MAT/MSK/09/03/2021', 12, 'masuk', '2021-03-09 21:02:12', 'gudang1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--
-- Creation: Jan 30, 2021 at 01:08 AM
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `unit` enum('gram','mililiter','liter','pcs','sachet','galon','drum','pail') NOT NULL DEFAULT 'mililiter',
  `volume` int(11) NOT NULL DEFAULT 0 COMMENT 'Jumlah dalam ''gram'',''mililiter'',''liter'',''pcs'',''sachet'',''galon'',''drum'',''pile''',
  `image` varchar(250) DEFAULT 'default.png',
  `price_base` int(11) NOT NULL DEFAULT 0 COMMENT 'Harga dasar / Harga beli / HPP',
  `selling_price` int(11) NOT NULL DEFAULT 0 COMMENT 'Harga jual normal untuk customer biasa',
  `reseller_price` int(11) NOT NULL DEFAULT 0 COMMENT 'Harga jual untuk customer reseller',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `product`:
--

--
-- Truncate table before insert `product`
--

TRUNCATE TABLE `product`;
--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_code`, `full_name`, `unit`, `volume`, `image`, `price_base`, `selling_price`, `reseller_price`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 'PR001', 'Produk 1', 'mililiter', 100, 'default.png', 36950, 56000, 50000, '2021-03-09 18:09:41', '2021-03-09 18:11:41', 0),
(2, 'PR002', 'Produk 2', 'liter', 17, 'default.png', 15320, 32000, 25000, '2021-03-09 18:14:03', NULL, 0),
(3, 'PR003', 'Produk 3', 'pcs', 1, 'default.png', 14100, 25000, 22000, '2021-03-09 18:15:01', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_composition`
--
-- Creation: Jan 28, 2021 at 02:08 PM
--

DROP TABLE IF EXISTS `product_composition`;
CREATE TABLE `product_composition` (
  `id` int(11) NOT NULL,
  `volume` int(11) NOT NULL COMMENT 'Jumlah dalam ml / gr',
  `product_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `product_composition`:
--   `product_id`
--       `product` -> `id`
--   `material_id`
--       `material` -> `id`
--

--
-- Truncate table before insert `product_composition`
--

TRUNCATE TABLE `product_composition`;
--
-- Dumping data for table `product_composition`
--

INSERT INTO `product_composition` (`id`, `volume`, `product_id`, `material_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 350, 1, 1, '2021-03-09 18:10:12', '2021-03-09 18:11:07', 0),
(2, 1, 1, 4, '2021-03-09 18:10:12', '2021-03-09 18:10:36', 0),
(3, 550, 1, 6, '2021-03-09 18:10:12', '2021-03-09 18:11:07', 0),
(4, 120, 2, 2, '2021-03-09 18:14:19', '2021-03-09 18:14:19', 0),
(5, 1, 2, 3, '2021-03-09 18:14:19', '2021-03-09 18:14:19', 0),
(6, 200, 2, 5, '2021-03-09 18:14:19', '2021-03-09 18:14:19', 0),
(7, 1, 3, 3, '2021-03-09 18:15:18', '2021-03-09 18:15:18', 0),
(8, 300, 3, 5, '2021-03-09 18:15:18', '2021-03-09 18:15:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Mar 16, 2021 at 03:13 AM
--

DROP TABLE IF EXISTS `product_inventory`;
CREATE TABLE `product_inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `critical_point` int(11) NOT NULL DEFAULT 10,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `created_by` varchar(15) DEFAULT NULL,
  `updated_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `product_inventory`:
--   `product_id`
--       `product` -> `id`
--   `store_id`
--       `store` -> `id`
--

--
-- Truncate table before insert `product_inventory`
--

TRUNCATE TABLE `product_inventory`;
--
-- Dumping data for table `product_inventory`
--

INSERT INTO `product_inventory` (`id`, `product_id`, `store_id`, `quantity`, `critical_point`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 1, 1, 158, 10, '2021-03-09 18:12:50', '2021-03-16 10:01:57', 'pemilik', 'gudang1', 0),
(2, 2, 1, 110, 10, '2021-03-09 18:14:36', '2021-03-16 10:12:14', 'pemilik', 'gudang1', 0),
(3, 3, 1, 105, 10, '2021-03-09 18:15:34', '2021-03-16 10:12:14', 'pemilik', 'gudang1', 0),
(4, 1, 2, 0, 10, '2021-03-09 21:19:56', '2021-03-16 10:08:49', 'gudang1', 'kasircica1', 0),
(5, 2, 2, 5, 10, '2021-03-16 10:11:35', '2021-03-16 10:11:35', 'gudang1', 'gudang1', 0),
(6, 2, 3, 37, 10, '2021-03-16 10:12:14', '2021-03-16 10:12:44', 'gudang1', 'kasiruber1', 0),
(7, 3, 3, 62, 10, '2021-03-16 10:12:14', '2021-03-16 10:13:10', 'gudang1', 'kasiruber1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_mutation`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Mar 16, 2021 at 03:13 AM
--

DROP TABLE IF EXISTS `product_mutation`;
CREATE TABLE `product_mutation` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `mutation_code` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `mutation_type` enum('keluar','masuk') DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(15) DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `product_mutation`:
--   `product_id`
--       `product` -> `id`
--   `store_id`
--       `store` -> `id`
--

--
-- Truncate table before insert `product_mutation`
--

TRUNCATE TABLE `product_mutation`;
--
-- Dumping data for table `product_mutation`
--

INSERT INTO `product_mutation` (`id`, `product_id`, `store_id`, `mutation_code`, `quantity`, `mutation_type`, `created_at`, `created_by`, `is_deleted`) VALUES
(1, 1, 1, '000001/PRO/MSK/09/03/2021', 200, 'masuk', '2021-03-09 18:12:50', 'pemilik', 0),
(2, 2, 1, '000002/PRO/MSK/09/03/2021', 200, 'masuk', '2021-03-09 18:14:36', 'pemilik', 0),
(3, 3, 1, '000003/PRO/MSK/09/03/2021', 200, 'masuk', '2021-03-09 18:15:34', 'pemilik', 0),
(4, 1, 1, '000004/PRO/KEL/09/03/2021', 13, 'keluar', '2021-03-09 18:16:38', 'gudang1', 0),
(5, 2, 1, '000005/PRO/KEL/09/03/2021', 5, 'keluar', '2021-03-09 18:16:38', 'gudang1', 0),
(6, 2, 1, '000006/PRO/KEL/09/03/2021', 20, 'keluar', '2021-03-09 19:16:19', 'gudang1', 0),
(7, 3, 1, '000007/PRO/KEL/09/03/2021', 29, 'keluar', '2021-03-09 19:16:19', 'gudang1', 0),
(8, 1, 1, '000008/PRO/KEL/09/03/2021', 1, 'keluar', '2021-03-09 21:19:56', 'gudang1', 0),
(9, 1, 2, '000009/PRO/MSK/09/03/2021', 1, 'masuk', '2021-03-09 21:19:56', 'gudang1', 0),
(10, 1, 1, '000010/PRO/KEL/09/03/2021', 22, 'keluar', '2021-03-09 21:20:24', 'gudang1', 0),
(11, 1, 1, '000011/PRO/KEL/09/03/2021', 1, 'keluar', '2021-03-09 21:20:35', 'gudang1', 0),
(12, 1, 1, '000012/PRO/KEL/16/03/2021', 5, 'keluar', '2021-03-16 10:01:57', 'gudang1', 0),
(13, 1, 2, '000013/PRO/KEL/16/03/2021', 1, 'keluar', '2021-03-16 10:08:49', 'kasircica1', 0),
(14, 2, 1, '000014/PRO/KEL/16/03/2021', 5, 'keluar', '2021-03-16 10:11:35', 'gudang1', 0),
(15, 2, 2, '000015/PRO/MSK/16/03/2021', 5, 'masuk', '2021-03-16 10:11:35', 'gudang1', 0),
(16, 2, 1, '000016/PRO/KEL/16/03/2021', 60, 'keluar', '2021-03-16 10:12:14', 'gudang1', 0),
(17, 3, 1, '000017/PRO/KEL/16/03/2021', 66, 'keluar', '2021-03-16 10:12:14', 'gudang1', 0),
(18, 2, 3, '000018/PRO/MSK/16/03/2021', 60, 'masuk', '2021-03-16 10:12:14', 'gudang1', 0),
(19, 3, 3, '000019/PRO/MSK/16/03/2021', 66, 'masuk', '2021-03-16 10:12:14', 'gudang1', 0),
(20, 2, 3, '000020/PRO/KEL/16/03/2021', 23, 'keluar', '2021-03-16 10:12:44', 'kasiruber1', 0),
(21, 3, 3, '000021/PRO/KEL/16/03/2021', 4, 'keluar', '2021-03-16 10:13:10', 'kasiruber1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--
-- Creation: Jan 28, 2021 at 02:08 PM
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `role`:
--

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
-- Creation: Jan 28, 2021 at 02:08 PM
--

DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `store_name` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `store`:
--

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
-- Creation: Mar 16, 2021 at 01:49 AM
-- Last update: Mar 16, 2021 at 03:13 AM
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trans_number` varchar(100) NOT NULL,
  `deliv_fullname` varchar(128) NOT NULL,
  `deliv_address` varchar(250) NOT NULL,
  `deliv_phone` varchar(16) NOT NULL,
  `price_total` bigint(20) NOT NULL,
  `hpp_total` bigint(20) NOT NULL,
  `store_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `due_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `transaction`:
--   `store_id`
--       `store` -> `id`
--   `customer_id`
--       `customer` -> `id`
--   `employee_id`
--       `employee` -> `id`
--

--
-- Truncate table before insert `transaction`
--

TRUNCATE TABLE `transaction`;
--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `trans_number`, `deliv_fullname`, `deliv_address`, `deliv_phone`, `price_total`, `hpp_total`, `store_id`, `customer_id`, `employee_id`, `due_at`, `created_at`, `is_deleted`) VALUES
(1, 'TRX/03/2021/000001', 'dio', 'jalanan', '081232131231', 775000, 556950, 1, 12, 2, '2021-03-16 18:16:38', '2021-03-09 18:16:38', 0),
(2, 'TRX/03/2021/000002', 'dio', 'jalanan', '081232131231', 1138000, 715300, 1, 12, 2, '2021-03-09 19:16:19', '2021-03-09 19:16:19', 0),
(3, 'TRX/03/2021/000003', 'Toko Cicalengka', 'Cicalengka, Jawa Barat, ID', '086969696969', 50000, 0, 1, 1, 2, '2021-03-16 21:19:56', '2021-03-09 21:19:56', 0),
(4, 'TRX/03/2021/000004', 'dio', 'jalanan', '081232131231', 1100000, 812900, 1, 12, 2, '2021-03-16 21:20:24', '2021-03-09 21:20:24', 0),
(5, 'TRX/03/2021/000005', 'dio', 'jalanan', '081232131231', 50000, 36950, 1, 12, 2, '2021-03-16 21:20:35', '2021-03-09 21:20:35', 0),
(7, 'TRX/03/2021/000006', 'dio', 'jalanan', '081232131231', 250000, 184750, 1, 12, 2, '2021-03-23 10:01:57', '2021-03-16 10:01:57', 0),
(12, 'TRX/03/2021/000007', 'Yaha', 'jalanann', '08465456145612', 50000, 36950, 2, 13, 4, '2021-03-23 10:08:49', '2021-03-16 10:08:49', 0),
(17, 'TRX/03/2021/000008', 'Toko Cicalengka', 'Cicalengka, Jawa Barat, ID', '086969696969', 125000, 0, 1, 1, 2, '2021-03-23 10:11:35', '2021-03-16 10:11:35', 0),
(18, 'TRX/03/2021/000009', 'Toko Ujung Berung', 'Ujung Berung, Jawa Barat, ID', '086969696969', 2952000, 0, 1, 2, 2, '2021-03-23 10:12:14', '2021-03-16 10:12:14', 0),
(19, 'TRX/03/2021/000010', 'Metallica', 'asdasdasasdsa', '0844456456456', 736000, 352360, 3, 14, 6, '2021-03-23 10:12:44', '2021-03-16 10:12:44', 0),
(20, 'TRX/03/2021/000011', 'Metallica', 'asdasdasasdsa', '0844456456456', 100000, 56400, 3, 14, 6, '2021-03-23 10:13:10', '2021-03-16 10:13:10', 0);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `left_to_paid` (`left_to_paid`),
  ADD KEY `invoice_number` (`invoice_number`),
  ADD KEY `store_id` (`store_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_id` (`store_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `trans_number` (`trans_number`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `custom_price`
--
ALTER TABLE `custom_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `material_inventory`
--
ALTER TABLE `material_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `material_mutation`
--
ALTER TABLE `material_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_composition`
--
ALTER TABLE `product_composition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_mutation`
--
ALTER TABLE `product_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_ibfk_3` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
