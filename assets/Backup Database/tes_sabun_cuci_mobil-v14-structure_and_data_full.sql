-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2021 at 04:18 AM
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
(1, 'Jhon', 'Jalanan', '087717172662', 'retail', 2, '2020-12-23 03:06:55', 0, 0),
(2, 'Shin', 'Jalanan Tengah', '0888888888', 'retail', 1, '2020-12-24 06:37:27', 0, 0),
(3, 'Toko Cicalengka', 'Cicalengka', '08123981232', 'reseller', 1, '2021-01-12 02:33:53', 1, 0),
(4, 'Toko Ujung Berung', 'Ujung Berung', '08123981232', 'reseller', 1, '2021-01-12 02:34:36', 1, 0),
(5, 'Gudang Pusat', 'Jawa Barat, Indonesia', '08123981232', 'reseller', 1, '2021-01-12 02:39:31', 0, 0),
(6, 'Cust uber 1', 'jalan jalan', '0888888888888', 'retail', 3, '2021-01-26 19:51:17', 0, 0),
(7, 'Cust uber 2', 'jalan kemana', '0777777777777', 'retail', 3, '2021-01-26 19:51:51', 0, 0),
(8, 'Cust uber 3', 'jalan madinnah', '06666666666666', 'reseller', 3, '2021-01-26 19:52:10', 0, 0),
(9, 'tes1', 'jalanan', '08888888888', 'retail', 1, '2021-01-28 21:24:40', 0, 0),
(10, 'toko cicalengka', 'jalanan', '0111111111111', 'reseller', 1, '2021-01-29 20:27:22', 0, 0),
(11, 'toko ujung berung', 'jalananns', '01111111111111', 'reseller', 1, '2021-01-29 21:23:16', 0, 0);

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
--
-- Dumping data for table `custom_price`
--

INSERT INTO `custom_price` (`id`, `price`, `customer_id`, `product_code`, `created_at`, `is_deleted`) VALUES
(1, 10000, 2, 'PR001', '2020-12-24 06:38:03', 0),
(2, 7000, 3, 'TYTY1', '2021-01-12 02:34:03', 0),
(3, 11500, 4, 'TYTY1', '2021-01-12 02:34:52', 0),
(4, 4500, 5, 'TYTY1', '2021-01-12 02:39:42', 0),
(5, 25000, 6, 'PR002', '2021-01-26 19:51:31', 0);

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
(7, 'kasiruber2', 'kasir_uber2@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Uber 2', NULL, '085555555556', 'Ujung Beruang', 'avatar-3.png', 3, 3, '2020-11-10 22:54:23', 0),
(8, 'admins', 'admin1@jp.com', '$2a$08$eDBmz5BisfYClwo.rs5k.Ot8pqR.3Ub/X1.1ANTc5bbaMJyy0H9Y.', 'dios', 'Ilham', '081236137132', 'Dipatiukur', 'avatar-1.png', 1, 1, '2020-11-17 03:19:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--
-- Creation: Jan 28, 2021 at 02:08 PM
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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `invoice`:
--   `transaction_id`
--       `transaction` -> `id`
--

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
(24, '10/CB/01/2021', 13000, 47000, '2021-01-26 07:32:29', 'cash', NULL, 19, '2021-01-26 07:32:29', '0', 0),
(25, '11/CB/01/2021', 0, 0, '2021-01-26 07:33:05', 'cash', NULL, 20, '2021-01-26 07:33:05', '0', 0),
(26, '12/KS/01/2021', 100000, 8000, '2021-01-26 07:41:57', 'cash', NULL, 21, '2021-01-26 07:41:57', '1', 0),
(27, '13/KS/01/2021', 5000, 3000, '2021-01-26 07:42:10', 'cash', NULL, 21, '2021-01-26 07:42:09', '0', 0),
(28, '14/KS/01/2021', 0, 54000, '2021-01-26 07:42:24', 'kontrabon', NULL, 22, '2021-01-26 07:42:24', '0', 0),
(34, '15/CB/01/2021', 0, 10000, '2021-01-26 07:48:45', 'cash', NULL, 28, '2021-01-26 07:48:45', '0', 0),
(35, '16/CB/01/2021', 0, 0, '2021-01-26 07:51:07', 'cash', NULL, 29, '2021-01-26 07:51:07', '0', 0),
(36, '17/CB/01/2021', 0, 840000, '2021-01-26 07:52:33', 'cash', NULL, 30, '2021-01-26 07:52:33', '0', 0),
(37, '18/CB/01/2021', 0, 20000, '2021-01-26 07:54:18', 'cash', NULL, 31, '2021-01-26 07:54:18', '0', 0),
(38, '19/CB/01/2021', 0, 20000, '2021-01-26 07:54:44', 'cash', NULL, 32, '2021-01-26 07:54:44', '0', 0),
(16, '2/AR/01/2021', 0, 8008000, '2021-01-13 11:06:49', 'kontrabon', NULL, 14, '2021-01-13 11:06:49', '1', 0),
(10, '2/KS/12/2020', 512000, 81000, '2020-12-24 16:52:17', 'cash', NULL, 10, '2020-12-24 16:52:17', '1', 0),
(39, '20/CB/01/2021', 0, 60000, '2021-01-26 07:55:13', 'cash', NULL, 33, '2021-01-26 07:55:13', '0', 0),
(52, '21/CB/01/2021', 0, 200000, '2021-01-26 09:38:12', 'cash', NULL, 46, '2021-01-26 09:38:12', '0', 0),
(53, '22/CB/01/2021', 0, 135000, '2021-01-26 10:38:37', 'cash', NULL, 47, '2021-01-26 10:38:37', '0', 0),
(54, '23/CB/01/2021', 0, 20000, '2021-01-26 10:52:01', 'cash', NULL, 48, '2021-01-26 10:52:01', '0', 0),
(57, '24/CB/01/2021', 0, 40000, '2021-01-26 11:03:13', 'cash', NULL, 52, '2021-01-26 11:03:13', '0', 0),
(58, '25/CB/01/2021', 0, 121000, '2021-01-26 11:06:18', 'kontrabon', NULL, 53, '2021-01-26 11:06:18', '0', 0),
(59, '26/CB/01/2021', 0, 100000, '2021-01-26 11:10:36', 'kontrabon', NULL, 54, '2021-01-26 11:10:36', '0', 0),
(67, '27/CB/01/2021', 0, 215000, '2021-01-26 11:35:51', 'kontrabon', NULL, 62, '2021-01-26 11:35:51', '0', 0),
(68, '28/CB/01/2021', 0, 60000, '2021-01-26 11:40:30', 'kontrabon', NULL, 63, '2021-01-26 11:40:30', '1', 0),
(69, '29/CB/01/2021', 0, 101000, '2021-01-26 11:41:52', 'kontrabon', NULL, 64, '2021-01-26 11:41:52', '0', 0),
(17, '3/AR/01/2021', 0, 100000, '2021-01-13 11:07:23', 'transfer', NULL, 15, '2021-01-13 11:07:23', '0', 0),
(11, '3/KS/12/2020', 80000, 1000, '2020-12-24 17:01:28', 'cash', NULL, 10, '2020-12-24 17:01:28', '0', 0),
(70, '30/CB/01/2021', 0, 221000, '2021-01-26 11:48:27', 'kontrabon', NULL, 65, '2021-01-26 11:48:27', '0', 0),
(71, '31/CB/01/2021', 0, 20000, '2021-01-26 15:45:35', 'kontrabon', NULL, 66, '2021-01-26 15:45:35', '1', 0),
(89, '32/CB/01/2021', 15000, 45000, '2021-01-26 17:32:25', 'cash', NULL, 63, '2021-01-26 17:32:24', '0', 0),
(90, '33/CB/01/2021', 10000, 10000, '2021-01-26 17:34:29', 'cash', NULL, 66, '2021-01-26 17:34:29', '0', 0),
(92, '34/KS/01/2021', 200000, 60000, '2021-01-26 19:56:40', 'cash', NULL, 68, '2021-01-26 19:56:40', '1', 0),
(93, '35/KS/01/2021', 15000, 45000, '2021-01-27 06:27:40', 'cash', NULL, 68, '2021-01-27 06:27:40', '0', 0),
(94, '36/KS/01/2021', 0, 239000, '2021-01-27 06:43:49', 'transfer', NULL, 69, '2021-01-27 06:43:49', '0', 0),
(95, '37/KS/01/2021', 12000, 18000, '2021-01-27 06:44:21', 'cash', NULL, 70, '2021-01-27 06:44:21', '0', 0),
(96, '38/CB/01/2021', 0, 181000, '2021-01-27 06:45:56', 'kontrabon', NULL, 71, '2021-01-27 06:45:56', '0', 0),
(98, '39/KS/01/2021', 0, 100000, '2021-01-27 10:26:27', 'kontrabon', NULL, 72, '2021-01-27 10:26:27', '0', 0),
(18, '4/AR/01/2021', 200000, 7808000, '2021-01-13 11:42:12', 'cash', NULL, 14, '2021-01-13 11:42:12', '0', 0),
(12, '4/KS/12/2020', 0, 80000, '2020-12-24 18:14:31', 'kontrabon', NULL, 11, '2020-12-24 18:14:31', '0', 0),
(99, '40/CB/01/2021', 0, 100000, '2021-01-29 15:24:18', 'kontrabon', NULL, 73, '2021-01-29 15:24:18', '1', 0),
(100, '41/CB/01/2021', 50000, 50000, '2021-01-29 15:27:28', 'cash', NULL, 73, '2021-01-29 15:27:28', '1', 0),
(101, '42/CB/01/2021', 12000, 38000, '2021-01-29 17:21:25', 'cash', NULL, 73, '2021-01-29 17:21:25', '1', 0),
(102, '43/CB/01/2021', 8000, 30000, '2021-01-29 17:21:34', 'cash', NULL, 73, '2021-01-29 17:21:34', '0', 0),
(103, '44/KS/01/2021', 10000, 30000, '2021-01-29 18:31:42', 'cash', NULL, 75, '2021-01-29 18:31:42', '1', 0),
(104, '45/KS/01/2021', 20500, 9500, '2021-01-29 18:32:02', 'cash', NULL, 75, '2021-01-29 18:32:01', '0', 0),
(105, '46/KS/01/2021', 0, 50000, '2021-01-29 18:44:37', 'kontrabon', NULL, 76, '2021-01-29 18:44:37', '1', 0),
(106, '47/KS/01/2021', 25000, 25000, '2021-01-29 18:45:12', 'cash', NULL, 76, '2021-01-29 18:45:12', '0', 0),
(107, '48/CB/01/2021', 0, 60000, '2021-01-29 21:23:53', 'kontrabon', NULL, 77, '2021-01-29 21:23:53', '1', 0),
(108, '49/CB/01/2021', 15000, 45000, '2021-01-29 21:24:24', 'cash', NULL, 77, '2021-01-29 21:24:24', '0', 0),
(19, '5/KS/01/2021', 0, 30000, '2021-01-13 17:36:51', 'kontrabon', NULL, 16, '2021-01-13 17:36:51', '1', 0),
(13, '5/KS/12/2020', 0, 270000, '2020-12-24 18:15:02', 'transfer', NULL, 12, '2020-12-24 18:15:02', '1', 0),
(109, '50/CB/01/2021', 0, 40000, '2021-01-29 23:01:54', 'kontrabon', NULL, 78, '2021-01-29 23:01:54', '0', 0),
(110, '51/CB/01/2021', 0, 243000, '2021-01-29 23:02:45', 'kontrabon', NULL, 79, '2021-01-29 23:02:45', '0', 0),
(111, '52/CB/01/2021', 0, 54000, '2021-01-29 23:07:52', 'kontrabon', NULL, 80, '2021-01-29 23:07:52', '0', 0),
(112, '53/CB/01/2021', 0, 108000, '2021-01-29 23:09:15', 'kontrabon', NULL, 81, '2021-01-29 23:09:15', '0', 0),
(20, '6/KS/01/2021', 0, 50000, '2021-01-13 18:16:38', 'kontrabon', NULL, 17, '2021-01-13 18:16:38', '0', 0),
(14, '6/KS/12/2020', 50000, 220000, '2020-12-24 18:26:13', 'cash', NULL, 12, '2020-12-24 18:26:13', '0', 0),
(21, '7/KS/01/2021', 35000, 17000, '2021-01-13 18:23:22', 'cash', NULL, 18, '2021-01-13 18:23:22', '0', 0),
(22, '8/KS/01/2021', 15000, 15000, '2021-01-26 07:22:21', 'cash', NULL, 16, '2021-01-26 07:22:20', '0', 0),
(23, '9/CB/01/2021', 0, 60000, '2021-01-26 07:29:29', 'cash', NULL, 19, '2021-01-26 07:29:29', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--
-- Creation: Jan 28, 2021 at 02:08 PM
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
(29, 4, 52000, 21, 3),
(30, 3, 60000, 23, 1),
(31, 2, 40000, 25, 1),
(32, 4, 108000, 26, 2),
(33, 2, 54000, 28, 2),
(39, 2, 40000, 34, 1),
(40, 2, 40000, 35, 1),
(41, 4, 108000, 35, 2),
(42, 42, 840000, 36, 1),
(43, 1, 20000, 37, 1),
(44, 1, 20000, 38, 1),
(45, 3, 60000, 39, 1),
(58, 10, 200000, 52, 1),
(59, 5, 135000, 53, 2),
(60, 6, 120000, 54, 1),
(62, 2, 40000, 57, 1),
(63, 2, 40000, 58, 1),
(64, 3, 81000, 58, 2),
(65, 5, 100000, 59, 1),
(80, 4, 80000, 67, 1),
(81, 5, 135000, 67, 2),
(82, 3, 60000, 68, 1),
(83, 1, 20000, 69, 1),
(84, 3, 81000, 69, 2),
(85, 7, 140000, 70, 1),
(86, 3, 81000, 70, 2),
(87, 1, 20000, 71, 1),
(90, 3, 60000, 92, 1),
(91, 8, 200000, 92, 2),
(92, 5, 50000, 94, 1),
(93, 7, 189000, 94, 2),
(94, 3, 30000, 95, 1),
(95, 5, 100000, 96, 1),
(96, 3, 81000, 96, 2),
(98, 5, 100000, 98, 1),
(99, 5, 100000, 99, 1),
(100, 4, 40000, 103, 1),
(101, 5, 50000, 105, 1),
(102, 3, 60000, 107, 1),
(103, 2, 40000, 109, 1),
(104, 9, 243000, 110, 2),
(105, 2, 54000, 111, 2),
(106, 4, 108000, 112, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Jan 30, 2021 at 12:19 AM
--

DROP TABLE IF EXISTS `kas`;
CREATE TABLE `kas` (
  `id` int(11) NOT NULL,
  `kas_code` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `date` date NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
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
(15, 'D/21/01/000009', 'Checkout: INV 7/KS/01/2021', 'Total harga:52000 ; Total bayar:35000 ; Sisa harus dibayar:17000 ; Oleh:kaisar', '2021-01-13', 35000, 0, 815500, 'debet', '2021-01-13 11:23:22', 'kaisar'),
(16, 'D/21/01/000010', 'Checkout: INV 12/KS/01/2021', 'Total harga:108000 ; Total bayar:100000 ; Sisa harus dibayar:8000 ; Oleh:gudang1', '2021-01-26', 100000, 0, 915500, 'debet', '2021-01-26 00:41:57', 'gudang1'),
(17, 'D/21/01/000011', 'Checkout: INV 14/KS/01/2021', 'Total harga:54000 ; Total bayar:0 ; Sisa harus dibayar:54000 ; Oleh:gudang1', '2021-01-26', 0, 0, 915500, 'debet', '2021-01-26 00:42:25', 'gudang1'),
(18, 'D/21/01/000012', 'Checkout ke Cabang: <br>INV 15/CB/01/2021', 'Total harga:40000 ; Total bayar:30000 ; Sisa harus dibayar:10000 ; Oleh:gudang1', '2021-01-26', 30000, 0, 945500, 'debet', '2021-01-26 00:48:45', 'gudang1'),
(19, 'D/21/01/000013', 'Checkout ke Cabang:\nINV 16/CB/01/2021', 'Total harga:148000 ; Total bayar:1480000 ; Sisa harus dibayar:-1332000 ; Oleh:gudang1', '2021-01-26', 148000, 0, 1093500, 'debet', '2021-01-26 00:51:08', 'gudang1'),
(23, 'D/21/01/000014', 'Checkout ke Cabang: INV 23/CB/01/2021', 'Total harga:120000 ; Total bayar:100000 ; Sisa harus dibayar:20000 ; Oleh:gudang1', '2021-01-26', 100000, 0, 1193500, 'debet', '2021-01-26 03:52:02', 'gudang1'),
(27, 'D/21/01/000015', 'Bayar Utang: INV 32/CB/01/2021', 'Sisa utang awal:60000 ; Total bayar:15000 ; Sisa harus dibayar:45000 ; Oleh:gudang1', '2021-01-26', 15000, 0, 1208500, 'debet', '2021-01-26 10:32:25', 'gudang1'),
(28, 'D/21/01/000016', 'Bayar Utang: INV 33/CB/01/2021', 'Sisa utang awal:20000 ; Total bayar:10000 ; Sisa harus dibayar:10000 ; Oleh:gudang1', '2021-01-26', 10000, 0, 1218500, 'debet', '2021-01-26 10:34:29', 'gudang1'),
(30, 'D/21/01/000017', 'Checkout: INV 34/KS/01/2021', 'Total harga:260000 ; Total bayar:200000 ; Sisa harus dibayar:60000 ; Oleh:kasiruber1', '2021-01-26', 200000, 0, 1418500, 'debet', '2021-01-26 12:56:40', 'kasiruber1'),
(31, 'D/21/01/000018', 'Bayar Utang: INV 35/KS/01/2021', 'Sisa utang awal:60000 ; Total bayar:15000 ; Sisa harus dibayar:45000 ; Oleh:kasiruber1', '2021-01-27', 15000, 0, 1433500, 'debet', '2021-01-26 23:27:40', 'kasiruber1'),
(32, 'D/21/01/000019', 'Checkout: INV 37/KS/01/2021', 'Total harga:30000 ; Total bayar:12000 ; Sisa harus dibayar:18000 ; Oleh:gudang1', '2021-01-27', 12000, 0, 1445500, 'debet', '2021-01-26 23:44:21', 'gudang1'),
(33, 'D/21/01/000020', 'Bayar Utang: INV 41/CB/01/2021', 'Sisa utang awal:100000 ; Total bayar:50000 ; Sisa harus dibayar:50000 ; Oleh:gudang1', '2021-01-29', 50000, 0, 1495500, 'debet', '2021-01-29 08:27:28', 'gudang1'),
(34, 'D/21/01/000021', 'Bayar Utang: INV 42/CB/01/2021', 'Sisa utang awal:50000 ; Total bayar:12000 ; Sisa harus dibayar:38000 ; Oleh:gudang1', '2021-01-29', 12000, 0, 1507500, 'debet', '2021-01-29 10:21:25', 'gudang1'),
(35, 'D/21/01/000022', 'Bayar Utang: INV 43/CB/01/2021', 'Sisa utang awal:38000 ; Total bayar:8000 ; Sisa harus dibayar:30000 ; Oleh:gudang1', '2021-01-29', 8000, 0, 1515500, 'debet', '2021-01-29 10:21:34', 'gudang1'),
(36, 'D/21/01/000023', 'Checkout: INV 44/KS/01/2021', 'Total harga:40000 ; Total bayar:10000 ; Sisa harus dibayar:30000 ; Oleh:gudang1', '2021-01-29', 10000, 0, 1525500, 'debet', '2021-01-29 11:31:42', 'gudang1'),
(37, 'D/21/01/000024', 'Bayar Utang: INV 45/KS/01/2021', 'Sisa utang awal:30000 ; Total bayar:20500 ; Sisa harus dibayar:9500 ; Oleh:gudang1', '2021-01-29', 20500, 0, 1546000, 'debet', '2021-01-29 11:32:02', 'gudang1'),
(38, 'D/21/01/000025', 'Bayar Utang: INV 47/KS/01/2021', 'Sisa utang awal:50000 ; Total bayar:25000 ; Sisa harus dibayar:25000 ; Oleh:gudang1', '2021-01-29', 25000, 0, 1571000, 'debet', '2021-01-29 11:45:12', 'gudang1'),
(39, 'D/21/01/000026', 'Bayar Utang: INV 49/CB/01/2021', 'Sisa utang awal:60000 ; Total bayar:15000 ; Sisa harus dibayar:45000 ; Oleh:gudang1', '2021-01-29', 15000, 0, 1586000, 'debet', '2021-01-29 14:24:24', 'gudang1'),
(40, 'D/21/01/000027', 'AWALUDIN', NULL, '2020-12-28', 213000, 0, 1799000, 'debet', '2021-01-29 15:45:06', 'pemilik'),
(41, 'D/21/01/000028', 'bakso goreng', NULL, '2020-12-28', 15000, 0, 1814000, 'debet', '2021-01-29 15:52:21', 'pemilik'),
(42, 'K/21/01/000029', 'Energi', 'Energi drink', '2021-01-22', 0, 145000, 1669000, 'kredit', '2021-01-30 00:09:03', 'gudang1'),
(43, 'K/21/01/000030', 'Energize', NULL, '2020-12-31', 0, 137500, 1531500, 'kredit', '2021-01-30 00:19:59', 'gudang1');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Jan 30, 2021 at 01:12 AM
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
(12, 'BB001', 'Detergen biru', 'gram', 1, 'bahan', 'default.png', 14, '2021-01-30 07:45:51', 0),
(13, 'BB002', 'Detergen pink', 'gram', 1, 'bahan', 'default.png', 17, '2021-01-30 07:46:07', 0),
(14, 'BB003', 'Detergen silver', 'gram', 1, 'bahan', 'default.png', 11, '2021-01-30 07:46:18', 0),
(15, 'BB004', 'Detergen kuning', 'gram', 1, 'bahan', 'default.png', 21, '2021-01-30 07:46:37', 0),
(1, 'BM001', 'Biji kopi robusta', 'gram', 1, 'bahan', 'default.png', 70, '2020-12-23 02:56:49', 0),
(2, 'BM002', 'Cup Styrofoam 200ml', 'pcs', 1, 'bahan', 'default.png', 1500, '2020-12-23 02:57:18', 0),
(3, 'BM003', 'Gula Pasir Putih', 'gram', 1, 'bahan', 'default.png', 20, '2020-12-23 02:57:49', 0),
(4, 'BM004', 'Sedotan Plastik', 'gram', 1, 'bahan', 'default.png', 750, '2020-12-23 02:58:09', 0),
(5, 'BM005', 'Air mineral', 'gram', 1, 'bahan', 'default.png', 9, '2020-12-28 01:32:57', 0),
(6, 'BM006', 'Sedotan Stainless Steel', 'pcs', 1, 'bahan', 'default.png', 450, '2020-12-28 01:48:26', 0),
(11, 'DIO1', 'Mentah 1', 'gram', 1, 'bahan', 'default.png', 500, '2021-01-13 15:47:27', 1),
(7, 'QQQ1', 'QUAQ', 'gram', 1, 'bahan', 'default.png', 230, '2021-01-11 13:03:54', 0),
(10, 'RRE1', 'RECING1', 'gram', 1, 'bahan', 'default.png', 250, '2021-01-12 03:51:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `material_inventory`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Jan 30, 2021 at 02:57 AM
--

DROP TABLE IF EXISTS `material_inventory`;
CREATE TABLE `material_inventory` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
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
(1, 4, 1, 975, 10, '2020-12-27 14:54:12', '2021-01-29 15:20:56', 'gudang1', 'gudang1', 0),
(2, 3, 1, 4110, 10, '2020-12-27 14:54:18', '2021-01-29 15:20:56', 'gudang1', 'gudang1', 0),
(4, 6, 1, 109, 10, '2020-12-28 01:48:26', '2021-01-26 11:55:34', 'gudang1', 'gudang1', 0),
(5, 2, 1, 24991, 10, '2021-01-11 12:00:55', '2021-01-29 15:20:56', 'kaisar', 'gudang1', 0),
(6, 7, 1, 208, 10, '2021-01-11 13:03:54', '2021-01-26 11:55:34', 'kaisar', 'gudang1', 0),
(7, 1, 1, 485415, 10, '2021-01-11 13:06:55', '2021-01-29 15:20:56', 'kaisar', 'gudang1', 0),
(8, 5, 1, 1006, 10, '2021-01-11 13:07:15', '2021-01-26 12:09:48', 'kaisar', 'gudang1', 0),
(18, 10, 1, 0, 10, '2021-01-12 03:51:09', NULL, 'kaisar', NULL, 1),
(19, 11, 1, 0, 10, '2021-01-13 15:47:27', NULL, 'gudang1', NULL, 1),
(20, 12, 1, 754750, 10, '2021-01-30 07:45:51', '2021-01-30 09:57:13', 'pemilik', 'gudang1', 0),
(21, 13, 1, 900250, 10, '2021-01-30 07:46:07', '2021-01-30 09:57:02', 'pemilik', 'gudang1', 0),
(22, 14, 1, 614750, 10, '2021-01-30 07:46:18', '2021-01-30 09:57:13', 'pemilik', 'gudang1', 0),
(23, 15, 1, 712250, 10, '2021-01-30 07:46:37', '2021-01-30 09:57:13', 'pemilik', 'gudang1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `material_mutation`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Jan 30, 2021 at 02:57 AM
--

DROP TABLE IF EXISTS `material_mutation`;
CREATE TABLE `material_mutation` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `mutation_code` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
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
(86, 4, 1, '000016/MAT/KEL/12/01/2021', 100, 'keluar', '2021-01-12 03:58:47', 'kaisar', 0),
(87, 5, 1, '000017/MAT/KEL/26/01/2021', 10, 'keluar', '2021-01-26 11:55:34', 'gudang1', 0),
(88, 6, 1, '000018/MAT/KEL/26/01/2021', 10, 'keluar', '2021-01-26 11:55:34', 'gudang1', 0),
(89, 7, 1, '000019/MAT/KEL/26/01/2021', 20, 'keluar', '2021-01-26 11:55:34', 'gudang1', 0),
(90, 5, 1, '000020/MAT/MSK/26/01/2021', 1000, 'masuk', '2021-01-26 12:09:48', 'pemilik', 0),
(91, 4, 1, '000021/MAT/MSK/26/01/2021', 1000, 'masuk', '2021-01-26 12:09:58', 'pemilik', 0),
(92, 2, 1, '000022/MAT/MSK/26/01/2021', 25000, 'masuk', '2021-01-26 12:10:09', 'pemilik', 0),
(93, 1, 1, '000023/MAT/KEL/29/01/2021', 1000, 'keluar', '2021-01-29 14:47:56', 'gudang1', 0),
(94, 2, 1, '000024/MAT/KEL/29/01/2021', 10, 'keluar', '2021-01-29 14:47:56', 'gudang1', 0),
(95, 3, 1, '000025/MAT/KEL/29/01/2021', 300, 'keluar', '2021-01-29 14:47:56', 'gudang1', 0),
(96, 4, 1, '000026/MAT/KEL/29/01/2021', 10, 'keluar', '2021-01-29 14:47:56', 'gudang1', 0),
(97, 1, 1, '000027/MAT/KEL/29/01/2021', 300, 'keluar', '2021-01-29 15:20:45', 'gudang1', 0),
(98, 2, 1, '000028/MAT/KEL/29/01/2021', 3, 'keluar', '2021-01-29 15:20:45', 'gudang1', 0),
(99, 3, 1, '000029/MAT/KEL/29/01/2021', 90, 'keluar', '2021-01-29 15:20:45', 'gudang1', 0),
(100, 4, 1, '000030/MAT/KEL/29/01/2021', 3, 'keluar', '2021-01-29 15:20:45', 'gudang1', 0),
(101, 1, 1, '000031/MAT/KEL/29/01/2021', 1440, 'keluar', '2021-01-29 15:20:56', 'gudang1', 0),
(102, 2, 1, '000032/MAT/KEL/29/01/2021', 12, 'keluar', '2021-01-29 15:20:56', 'gudang1', 0),
(103, 3, 1, '000033/MAT/KEL/29/01/2021', 600, 'keluar', '2021-01-29 15:20:56', 'gudang1', 0),
(104, 4, 1, '000034/MAT/KEL/29/01/2021', 12, 'keluar', '2021-01-29 15:20:56', 'gudang1', 0),
(105, 15, 1, '000035/MAT/MSK/30/01/2021', 10000, 'masuk', '2021-01-30 09:53:25', 'pemilik', 0),
(106, 14, 1, '000036/MAT/MSK/30/01/2021', 10000, 'masuk', '2021-01-30 09:53:31', 'pemilik', 0),
(107, 13, 1, '000037/MAT/MSK/30/01/2021', 10000, 'masuk', '2021-01-30 09:53:39', 'pemilik', 0),
(108, 13, 1, '000038/MAT/MSK/30/01/2021', 10000, 'masuk', '2021-01-30 09:53:50', 'pemilik', 0),
(109, 12, 1, '000039/MAT/MSK/30/01/2021', 10000, 'masuk', '2021-01-30 09:54:14', 'pemilik', 0),
(110, 15, 1, '000040/MAT/MSK/30/01/2021', 1000000, 'masuk', '2021-01-30 09:56:15', 'pemilik', 0),
(111, 14, 1, '000041/MAT/MSK/30/01/2021', 1000000, 'masuk', '2021-01-30 09:56:22', 'pemilik', 0),
(112, 13, 1, '000042/MAT/MSK/30/01/2021', 1000000, 'masuk', '2021-01-30 09:56:28', 'pemilik', 0),
(113, 12, 1, '000043/MAT/MSK/30/01/2021', 1000000, 'masuk', '2021-01-30 09:56:38', 'pemilik', 0),
(114, 12, 1, '000044/MAT/KEL/30/01/2021', 44000, 'keluar', '2021-01-30 09:56:46', 'gudang1', 0),
(115, 13, 1, '000045/MAT/KEL/30/01/2021', 51000, 'keluar', '2021-01-30 09:56:46', 'gudang1', 0),
(116, 14, 1, '000046/MAT/KEL/30/01/2021', 254000, 'keluar', '2021-01-30 09:56:46', 'gudang1', 0),
(117, 15, 1, '000047/MAT/KEL/30/01/2021', 124000, 'keluar', '2021-01-30 09:56:46', 'gudang1', 0),
(118, 12, 1, '000048/MAT/KEL/30/01/2021', 191250, 'keluar', '2021-01-30 09:57:02', 'gudang1', 0),
(119, 13, 1, '000049/MAT/KEL/30/01/2021', 68750, 'keluar', '2021-01-30 09:57:02', 'gudang1', 0),
(120, 14, 1, '000050/MAT/KEL/30/01/2021', 121250, 'keluar', '2021-01-30 09:57:02', 'gudang1', 0),
(121, 15, 1, '000051/MAT/KEL/30/01/2021', 153750, 'keluar', '2021-01-30 09:57:02', 'gudang1', 0),
(122, 12, 1, '000052/MAT/KEL/30/01/2021', 20000, 'keluar', '2021-01-30 09:57:13', 'gudang1', 0),
(123, 14, 1, '000053/MAT/KEL/30/01/2021', 20000, 'keluar', '2021-01-30 09:57:13', 'gudang1', 0),
(124, 15, 1, '000054/MAT/KEL/30/01/2021', 20000, 'keluar', '2021-01-30 09:57:13', 'gudang1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--
-- Creation: Jan 30, 2021 at 01:08 AM
-- Last update: Jan 30, 2021 at 02:49 AM
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
(4, 'KEPO1', 'tes1', 'mililiter', 100, 'default.png', 0, 0, 0, '2021-01-13 17:57:11', NULL, 0),
(1, 'PR001', 'Kopi Nikmat', 'pcs', 1, 'default.png', 9850, 20000, 0, '2020-12-23 03:58:42', '2021-01-30 08:12:04', 0),
(2, 'PR002', 'Kopi robusta blend', 'pcs', 1, 'default.png', 11650, 27000, 3000, '2020-12-23 16:43:25', '2021-01-30 08:12:04', 0),
(5, 'SBN001', 'Sabun cuci piring 1', 'liter', 2, 'default.png', 460, 1500, 1500, '2021-01-30 07:45:02', '2021-01-30 08:12:04', 0),
(6, 'SBN002', 'Sabun detergen - XXL', 'drum', 1, 'default.png', 6727, 30000, 25000, '2021-01-30 09:48:14', NULL, 0),
(7, 'SBN003', 'Sabun detergen - XL', 'galon', 3, 'default.png', 6881, 28000, 21500, '2021-01-30 09:48:34', NULL, 0),
(3, 'TYTY1', 'TES1', 'mililiter', 150, 'default.png', 919, 13000, 6500, '2021-01-11 16:04:23', '2021-01-30 08:12:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_composition`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Jan 30, 2021 at 02:49 AM
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
(11, 1, 3, 5, '2021-01-13 16:20:37', '2021-01-13 16:20:37', 0),
(12, 10, 5, 12, '2021-01-30 07:46:57', '2021-01-30 07:46:57', 0),
(13, 10, 5, 14, '2021-01-30 07:46:57', '2021-01-30 07:46:57', 0),
(14, 10, 5, 15, '2021-01-30 07:46:57', '2021-01-30 07:46:57', 0),
(15, 123, 6, 15, '2021-01-30 09:49:00', '2021-01-30 09:49:00', 0),
(16, 153, 6, 12, '2021-01-30 09:49:00', '2021-01-30 09:49:00', 0),
(17, 55, 6, 13, '2021-01-30 09:49:00', '2021-01-30 09:49:00', 0),
(18, 97, 6, 14, '2021-01-30 09:49:00', '2021-01-30 09:49:00', 0),
(19, 254, 7, 14, '2021-01-30 09:49:42', '2021-01-30 09:49:42', 0),
(20, 124, 7, 15, '2021-01-30 09:49:42', '2021-01-30 09:49:42', 0),
(21, 44, 7, 12, '2021-01-30 09:49:42', '2021-01-30 09:49:42', 0),
(22, 51, 7, 13, '2021-01-30 09:49:43', '2021-01-30 09:49:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Jan 30, 2021 at 02:57 AM
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
(1, 1, 2, 997, 0, '2020-12-23 16:47:37', '2021-01-29 23:01:54', 'gudang1', 'gudang1', 0),
(2, 1, 3, 1062, 0, '2020-12-23 16:47:37', '2021-01-26 19:56:40', 'gudang1', 'kasiruber1', 0),
(3, 2, 2, 973, 0, '2020-12-23 16:47:37', '2021-01-29 23:09:15', 'gudang1', 'gudang1', 0),
(4, 2, 3, 1013, 0, '2020-12-23 16:47:37', '2021-01-29 23:07:52', 'gudang1', 'gudang1', 0),
(5, 1, 1, 3, 10, '2020-12-24 06:43:26', '2021-01-29 23:01:54', 'gudang1', 'gudang1', 0),
(6, 2, 1, 68, 10, '2020-12-24 06:43:26', '2021-01-29 23:09:15', 'gudang1', 'gudang1', 0),
(14, 3, 1, 21, 10, '2021-01-12 03:35:56', '2021-01-26 11:55:34', NULL, 'gudang1', 0),
(15, 7, 1, 1000, 10, '2021-01-30 09:56:47', '2021-01-30 09:56:46', 'gudang1', 'gudang1', 0),
(16, 6, 1, 1250, 10, '2021-01-30 09:57:02', '2021-01-30 09:57:02', 'gudang1', 'gudang1', 0),
(17, 5, 1, 2000, 10, '2021-01-30 09:57:13', '2021-01-30 09:57:13', 'gudang1', 'gudang1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_mutation`
--
-- Creation: Jan 28, 2021 at 02:08 PM
-- Last update: Jan 30, 2021 at 02:57 AM
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
(66, 3, 1, '000009/PRO/KEL/13/01/2021', 4, 'keluar', '2021-01-13 18:23:22', 'kaisar', 0),
(67, 1, 1, '000010/PRO/KEL/26/01/2021', 3, 'keluar', '2021-01-26 07:29:29', 'gudang1', 0),
(68, 1, 3, '000011/PRO/MSK/26/01/2021', 3, 'masuk', '2021-01-26 07:29:29', 'gudang1', 0),
(69, 1, 1, '000012/PRO/KEL/26/01/2021', 2, 'keluar', '2021-01-26 07:33:05', 'gudang1', 0),
(70, 1, 3, '000013/PRO/MSK/26/01/2021', 2, 'masuk', '2021-01-26 07:33:05', 'gudang1', 0),
(71, 2, 1, '000014/PRO/KEL/26/01/2021', 4, 'keluar', '2021-01-26 07:41:57', 'gudang1', 0),
(72, 2, 1, '000015/PRO/KEL/26/01/2021', 2, 'keluar', '2021-01-26 07:42:24', 'gudang1', 0),
(78, 1, 1, '000016/PRO/KEL/26/01/2021', 2, 'keluar', '2021-01-26 07:48:45', 'gudang1', 0),
(79, 1, 3, '000017/PRO/MSK/26/01/2021', 2, 'masuk', '2021-01-26 07:48:45', 'gudang1', 0),
(80, 1, 1, '000018/PRO/KEL/26/01/2021', 2, 'keluar', '2021-01-26 07:51:07', 'gudang1', 0),
(81, 2, 1, '000019/PRO/KEL/26/01/2021', 4, 'keluar', '2021-01-26 07:51:07', 'gudang1', 0),
(82, 1, 3, '000020/PRO/MSK/26/01/2021', 2, 'masuk', '2021-01-26 07:51:07', 'gudang1', 0),
(83, 2, 3, '000021/PRO/MSK/26/01/2021', 4, 'masuk', '2021-01-26 07:51:07', 'gudang1', 0),
(84, 1, 1, '000022/PRO/KEL/26/01/2021', 42, 'keluar', '2021-01-26 07:52:33', 'gudang1', 0),
(85, 1, 3, '000023/PRO/MSK/26/01/2021', 42, 'masuk', '2021-01-26 07:52:33', 'gudang1', 0),
(86, 1, 1, '000024/PRO/KEL/26/01/2021', 1, 'keluar', '2021-01-26 07:54:18', 'gudang1', 0),
(87, 1, 3, '000025/PRO/MSK/26/01/2021', 1, 'masuk', '2021-01-26 07:54:18', 'gudang1', 0),
(88, 1, 1, '000026/PRO/KEL/26/01/2021', 1, 'keluar', '2021-01-26 07:54:44', 'gudang1', 0),
(89, 1, 3, '000027/PRO/MSK/26/01/2021', 1, 'masuk', '2021-01-26 07:54:44', 'gudang1', 0),
(90, 1, 1, '000028/PRO/KEL/26/01/2021', 3, 'keluar', '2021-01-26 07:55:13', 'gudang1', 0),
(91, 1, 3, '000029/PRO/MSK/26/01/2021', 3, 'masuk', '2021-01-26 07:55:13', 'gudang1', 0),
(110, 1, 2, '000030/PRO/KEL/26/01/2021', 10, 'keluar', '2021-01-26 09:38:12', 'gudang1', 0),
(111, 1, 2, '000031/PRO/MSK/26/01/2021', 10, 'masuk', '2021-01-26 09:38:12', 'gudang1', 0),
(112, 2, 3, '000032/PRO/KEL/26/01/2021', 5, 'keluar', '2021-01-26 10:38:37', 'gudang1', 0),
(113, 2, 3, '000033/PRO/MSK/26/01/2021', 5, 'masuk', '2021-01-26 10:38:37', 'gudang1', 0),
(114, 1, 2, '000034/PRO/KEL/26/01/2021', 6, 'keluar', '2021-01-26 10:52:01', 'gudang1', 0),
(115, 1, 2, '000035/PRO/MSK/26/01/2021', 6, 'masuk', '2021-01-26 10:52:01', 'gudang1', 0),
(118, 1, 2, '000036/PRO/KEL/26/01/2021', 2, 'keluar', '2021-01-26 11:03:13', 'gudang1', 0),
(119, 1, 2, '000037/PRO/MSK/26/01/2021', 2, 'masuk', '2021-01-26 11:03:13', 'gudang1', 0),
(120, 1, 3, '000038/PRO/KEL/26/01/2021', 2, 'keluar', '2021-01-26 11:06:18', 'gudang1', 0),
(121, 2, 3, '000039/PRO/KEL/26/01/2021', 3, 'keluar', '2021-01-26 11:06:18', 'gudang1', 0),
(122, 1, 3, '000040/PRO/MSK/26/01/2021', 2, 'masuk', '2021-01-26 11:06:18', 'gudang1', 0),
(123, 2, 3, '000041/PRO/MSK/26/01/2021', 3, 'masuk', '2021-01-26 11:06:18', 'gudang1', 0),
(124, 1, 2, '000042/PRO/KEL/26/01/2021', 5, 'keluar', '2021-01-26 11:10:36', 'gudang1', 0),
(125, 1, 2, '000043/PRO/MSK/26/01/2021', 5, 'masuk', '2021-01-26 11:10:36', 'gudang1', 0),
(150, 1, 1, '000044/PRO/KEL/26/01/2021', 4, 'keluar', '2021-01-26 11:35:51', 'gudang1', 0),
(151, 2, 1, '000045/PRO/KEL/26/01/2021', 5, 'keluar', '2021-01-26 11:35:51', 'gudang1', 0),
(152, 1, 2, '000046/PRO/MSK/26/01/2021', 4, 'masuk', '2021-01-26 11:35:51', 'gudang1', 0),
(153, 2, 2, '000047/PRO/MSK/26/01/2021', 5, 'masuk', '2021-01-26 11:35:51', 'gudang1', 0),
(154, 1, 1, '000048/PRO/KEL/26/01/2021', 3, 'keluar', '2021-01-26 11:40:30', 'gudang1', 0),
(155, 1, 2, '000049/PRO/MSK/26/01/2021', 3, 'masuk', '2021-01-26 11:40:30', 'gudang1', 0),
(156, 1, 1, '000050/PRO/KEL/26/01/2021', 1, 'keluar', '2021-01-26 11:41:52', 'gudang1', 0),
(157, 2, 1, '000051/PRO/KEL/26/01/2021', 3, 'keluar', '2021-01-26 11:41:52', 'gudang1', 0),
(158, 1, 3, '000052/PRO/MSK/26/01/2021', 1, 'masuk', '2021-01-26 11:41:52', 'gudang1', 0),
(159, 2, 3, '000053/PRO/MSK/26/01/2021', 3, 'masuk', '2021-01-26 11:41:52', 'gudang1', 0),
(160, 1, 1, '000054/PRO/KEL/26/01/2021', 7, 'keluar', '2021-01-26 11:48:27', 'gudang1', 0),
(161, 2, 1, '000055/PRO/KEL/26/01/2021', 3, 'keluar', '2021-01-26 11:48:27', 'gudang1', 0),
(162, 1, 3, '000056/PRO/MSK/26/01/2021', 7, 'masuk', '2021-01-26 11:48:27', 'gudang1', 0),
(163, 2, 3, '000057/PRO/MSK/26/01/2021', 3, 'masuk', '2021-01-26 11:48:27', 'gudang1', 0),
(164, 3, 1, '000058/PRO/MSK/26/01/2021', 10, 'masuk', '2021-01-26 11:55:34', 'gudang1', 0),
(165, 1, 1, '000059/PRO/KEL/26/01/2021', 1, 'keluar', '2021-01-26 15:45:35', 'pemilik', 0),
(166, 1, 3, '000060/PRO/MSK/26/01/2021', 1, 'masuk', '2021-01-26 15:45:35', 'pemilik', 0),
(169, 1, 3, '000061/PRO/KEL/26/01/2021', 3, 'keluar', '2021-01-26 19:56:40', 'kasiruber1', 0),
(170, 2, 3, '000062/PRO/KEL/26/01/2021', 8, 'keluar', '2021-01-26 19:56:40', 'kasiruber1', 0),
(171, 1, 1, '000063/PRO/KEL/27/01/2021', 5, 'keluar', '2021-01-27 06:43:49', 'gudang1', 0),
(172, 2, 1, '000064/PRO/KEL/27/01/2021', 7, 'keluar', '2021-01-27 06:43:49', 'gudang1', 0),
(173, 1, 1, '000065/PRO/KEL/27/01/2021', 3, 'keluar', '2021-01-27 06:44:21', 'gudang1', 0),
(174, 1, 1, '000066/PRO/KEL/27/01/2021', 5, 'keluar', '2021-01-27 06:45:56', 'gudang1', 0),
(175, 2, 1, '000067/PRO/KEL/27/01/2021', 3, 'keluar', '2021-01-27 06:45:56', 'gudang1', 0),
(176, 1, 2, '000068/PRO/MSK/27/01/2021', 5, 'masuk', '2021-01-27 06:45:56', 'gudang1', 0),
(177, 2, 2, '000069/PRO/MSK/27/01/2021', 3, 'masuk', '2021-01-27 06:45:56', 'gudang1', 0),
(179, 1, 2, '000070/PRO/KEL/27/01/2021', 5, 'keluar', '2021-01-27 10:26:27', 'kasircica1', 0),
(180, 1, 1, '000071/PRO/MSK/29/01/2021', 10, 'masuk', '2021-01-29 14:47:56', 'gudang1', 0),
(181, 1, 1, '000072/PRO/MSK/29/01/2021', 3, 'masuk', '2021-01-29 15:20:45', 'gudang1', 0),
(182, 2, 1, '000073/PRO/MSK/29/01/2021', 12, 'masuk', '2021-01-29 15:20:56', 'gudang1', 0),
(183, 1, 1, '000074/PRO/KEL/29/01/2021', 5, 'keluar', '2021-01-29 15:24:18', 'gudang1', 0),
(184, 1, 2, '000075/PRO/MSK/29/01/2021', 5, 'masuk', '2021-01-29 15:24:18', 'gudang1', 0),
(185, 1, 1, '000076/PRO/KEL/29/01/2021', 4, 'keluar', '2021-01-29 18:31:42', 'gudang1', 0),
(186, 1, 1, '000077/PRO/KEL/29/01/2021', 5, 'keluar', '2021-01-29 18:44:37', 'gudang1', 0),
(187, 1, 1, '000078/PRO/KEL/29/01/2021', 3, 'keluar', '2021-01-29 21:23:53', 'gudang1', 0),
(188, 1, 2, '000079/PRO/MSK/29/01/2021', 3, 'masuk', '2021-01-29 21:23:53', 'gudang1', 0),
(189, 1, 1, '000080/PRO/KEL/29/01/2021', 2, 'keluar', '2021-01-29 23:01:54', 'gudang1', 0),
(190, 1, 2, '000081/PRO/MSK/29/01/2021', 2, 'masuk', '2021-01-29 23:01:54', 'gudang1', 0),
(191, 2, 1, '000082/PRO/KEL/29/01/2021', 9, 'keluar', '2021-01-29 23:02:45', 'gudang1', 0),
(192, 2, 3, '000083/PRO/MSK/29/01/2021', 9, 'masuk', '2021-01-29 23:02:45', 'gudang1', 0),
(193, 2, 1, '000084/PRO/KEL/29/01/2021', 2, 'keluar', '2021-01-29 23:07:52', 'gudang1', 0),
(194, 2, 3, '000085/PRO/MSK/29/01/2021', 2, 'masuk', '2021-01-29 23:07:52', 'gudang1', 0),
(195, 2, 1, '000086/PRO/KEL/29/01/2021', 4, 'keluar', '2021-01-29 23:09:15', 'gudang1', 0),
(196, 2, 2, '000087/PRO/MSK/29/01/2021', 4, 'masuk', '2021-01-29 23:09:15', 'gudang1', 0),
(197, 7, 1, '000088/PRO/MSK/30/01/2021', 1000, 'masuk', '2021-01-30 09:56:46', 'gudang1', 0),
(198, 6, 1, '000089/PRO/MSK/30/01/2021', 1250, 'masuk', '2021-01-30 09:57:02', 'gudang1', 0),
(199, 5, 1, '000090/PRO/MSK/30/01/2021', 2000, 'masuk', '2021-01-30 09:57:13', 'gudang1', 0);

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
-- Creation: Jan 28, 2021 at 02:08 PM
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trans_number` varchar(100) NOT NULL,
  `deliv_fullname` varchar(128) NOT NULL,
  `deliv_address` varchar(250) NOT NULL,
  `deliv_phone` varchar(16) NOT NULL,
  `price_total` bigint(20) NOT NULL,
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

INSERT INTO `transaction` (`id`, `trans_number`, `deliv_fullname`, `deliv_address`, `deliv_phone`, `price_total`, `store_id`, `customer_id`, `employee_id`, `due_at`, `created_at`, `is_deleted`) VALUES
(13, 'TRX/01/2021/000001', '', 'Jalanan Tengah', '', 20000, 1, 2, 2, '2021-01-13 11:03:41', '2021-01-13 11:03:41', 0),
(14, 'TRX/01/2021/000002', '', 'Cicalengka', '', 8008000, 1, 3, 2, '2021-01-20 11:06:49', '2021-01-13 11:06:49', 0),
(15, 'TRX/01/2021/000003', '', 'Cicalengka', '', 100000, 1, 3, 2, '2021-01-20 11:07:23', '2021-01-13 11:07:23', 0),
(16, 'TRX/01/2021/000004', '', 'Jalanan scadasdasd', '', 30000, 1, 2, 0, '2021-01-20 17:36:51', '2021-01-13 17:36:51', 0),
(17, 'TRX/01/2021/000005', '', 'Jalanan Tengah', '', 50000, 1, 2, 0, '2021-01-20 18:16:38', '2021-01-13 18:16:38', 0),
(18, 'TRX/01/2021/000006', '', 'Jalanan Tengah', '', 52000, 1, 2, 0, '2021-01-20 18:23:22', '2021-01-13 18:23:22', 0),
(19, 'TRX/01/2021/000007', '', 'Cicalengka', '', 60000, 1, 3, 2, '2021-02-02 07:29:29', '2021-01-26 07:29:29', 0),
(20, 'TRX/01/2021/000008', '', 'Cicalengka', '', 40000, 1, 3, 2, '2021-01-26 07:33:05', '2021-01-26 07:33:05', 0),
(21, 'TRX/01/2021/000009', '', 'Jalanan Tengah', '', 108000, 1, 2, 2, '2021-02-02 07:41:57', '2021-01-26 07:41:57', 0),
(22, 'TRX/01/2021/000010', '', 'Jalanan Tengah', '', 54000, 1, 2, 2, '2021-02-02 07:42:24', '2021-01-26 07:42:24', 0),
(28, 'TRX/01/2021/000011', '', 'Cicalengka', '', 40000, 1, 3, 2, '2021-02-02 07:48:45', '2021-01-26 07:48:45', 0),
(29, 'TRX/01/2021/000012', '', 'Cicalengka', '', 148000, 1, 3, 2, '2021-01-26 07:51:07', '2021-01-26 07:51:07', 0),
(30, 'TRX/01/2021/000013', '', 'Ujung Berung', '', 840000, 1, 4, 2, '2021-02-02 07:52:33', '2021-01-26 07:52:33', 0),
(31, 'TRX/01/2021/000014', '', 'Cicalengka', '', 20000, 1, 3, 2, '2021-02-02 07:54:18', '2021-01-26 07:54:18', 0),
(32, 'TRX/01/2021/000015', '', 'Cicalengka', '', 20000, 1, 3, 2, '2021-02-02 07:54:44', '2021-01-26 07:54:44', 0),
(33, 'TRX/01/2021/000016', '', 'Ujung Berung', '', 60000, 1, 4, 2, '2021-02-02 07:55:13', '2021-01-26 07:55:13', 0),
(46, 'TRX/01/2021/000017', '', 'Cicalengka', '', 200000, 2, 3, 2, '2021-02-02 09:38:12', '2021-01-26 09:38:12', 0),
(47, 'TRX/01/2021/000018', '', 'Ujung Berung', '', 135000, 3, 4, 2, '2021-02-02 10:38:37', '2021-01-26 10:38:37', 0),
(48, 'TRX/01/2021/000019', '', 'Cicalengka', '', 120000, 2, 3, 2, '2021-02-02 10:52:01', '2021-01-26 10:52:01', 0),
(52, 'TRX/01/2021/000020', '', 'Cicalengka', '', 40000, 1, 3, 2, '2021-02-02 11:03:13', '2021-01-26 11:03:13', 0),
(53, 'TRX/01/2021/000021', '', 'Ujung Berung', '', 121000, 1, 4, 2, '2021-02-02 11:06:18', '2021-01-26 11:06:18', 0),
(54, 'TRX/01/2021/000022', '', 'Cicalengka', '', 100000, 1, 3, 2, '2021-02-02 11:10:36', '2021-01-26 11:10:36', 0),
(62, 'TRX/01/2021/000023', '', 'Cicalengka', '', 215000, 1, 3, 2, '2021-02-02 11:35:51', '2021-01-26 11:35:51', 0),
(63, 'TRX/01/2021/000024', '', 'Cicalengka', '', 60000, 1, 3, 2, '2021-02-02 11:40:30', '2021-01-26 11:40:30', 0),
(64, 'TRX/01/2021/000025', '', 'Ujung Berung', '', 101000, 1, 4, 2, '2021-02-02 11:41:52', '2021-01-26 11:41:52', 0),
(65, 'TRX/01/2021/000026', '', 'Ujung Berung', '', 221000, 1, 4, 2, '2021-02-02 11:48:27', '2021-01-26 11:48:27', 0),
(66, 'TRX/01/2021/000027', '', 'Ujung Berung', '', 20000, 1, 4, 1, '2021-02-02 15:45:35', '2021-01-26 15:45:35', 0),
(68, 'TRX/01/2021/000028', '', 'ALAMAT CUSTOM BLOK C NOMOR 666, BEKASI SELATAN, JABARALAMAT CUSTOM BLOK C NOMOR 666, BEKASI SELATAN, JABAR', '7666766676667', 260000, 3, 6, 6, '2021-02-02 19:56:40', '2021-01-26 19:56:40', 0),
(69, 'TRX/01/2021/000029', '', 'Jalanan Tengah 123', '0888888888123', 239000, 1, 2, 2, '2021-02-03 06:43:49', '2021-01-27 06:43:49', 0),
(70, 'TRX/01/2021/000030', '', 'Jalanan Tengah', '0888888888', 30000, 1, 2, 2, '2021-02-03 06:44:21', '2021-01-27 06:44:21', 0),
(71, 'TRX/01/2021/000031', '', 'Cicalengka 123', '06666666666123', 181000, 1, 3, 2, '2021-02-03 06:45:56', '2021-01-27 06:45:56', 0),
(72, 'TRX/01/2021/000032', 'Jhon', 'Jalanan', '087717172662', 100000, 2, 1, 4, '2021-02-03 10:26:27', '2021-01-27 10:26:27', 0),
(73, 'TRX/01/2021/000033', 'Toko Cicalengka', 'Cicalengka', '08123981232', 100000, 1, 3, 2, '2021-02-05 15:24:18', '2021-01-29 15:24:18', 0),
(75, 'TRX/01/2021/000034', 'Shin', 'Jalanan Tengah', '0888888888', 40000, 1, 2, 2, '2021-02-05 18:31:42', '2021-01-29 18:31:42', 0),
(76, 'TRX/01/2021/000035', 'Shin', 'Jalanan Tengah dropship', '069696969', 50000, 1, 2, 2, '2021-02-05 18:44:37', '2021-01-29 18:44:37', 0),
(77, 'TRX/01/2021/000036', 'Toko Cicalengka', 'Cicalengka', '08123981232', 60000, 1, 3, 2, '2021-02-05 21:23:53', '2021-01-29 21:23:53', 0),
(78, 'TRX/01/2021/000037', 'Toko Cicalengka', 'Cicalengka', '08123981232', 40000, 1, 3, 2, '2021-02-05 23:01:54', '2021-01-29 23:01:54', 0),
(79, 'TRX/01/2021/000038', 'Toko Ujung Berung', 'Ujung Berung', '08123981232', 243000, 1, 4, 2, '2021-02-05 23:02:45', '2021-01-29 23:02:45', 0),
(80, 'TRX/01/2021/000039', 'Toko Ujung Berung', 'Ujung Berung', '08123981232', 54000, 1, 4, 2, '2021-02-05 23:07:52', '2021-01-29 23:07:52', 0),
(81, 'TRX/01/2021/000040', 'Toko Cicalengka', 'Cicalengka', '08123981232', 108000, 1, 3, 2, '2021-02-05 23:09:15', '2021-01-29 23:09:15', 0),
(1, 'TRX/12/2020/000001', '', 'Jalanan', '', 364000, 2, 1, 4, '2020-12-31 15:49:14', '2020-12-24 15:49:14', 0),
(10, 'TRX/12/2020/000002', '', 'Jalanan di saidan', '', 593000, 2, 1, 4, '2020-12-31 16:52:17', '2020-12-24 16:52:17', 0),
(11, 'TRX/12/2020/000003', '', 'Jalanan', '', 80000, 2, 1, 4, '2020-12-31 18:14:31', '2020-12-24 18:14:31', 0),
(12, 'TRX/12/2020/000004', '', 'Jalanan', '', 270000, 2, 1, 4, '2020-12-31 18:15:02', '2020-12-24 18:15:02', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `custom_price`
--
ALTER TABLE `custom_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `material_inventory`
--
ALTER TABLE `material_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `material_mutation`
--
ALTER TABLE `material_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_composition`
--
ALTER TABLE `product_composition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_mutation`
--
ALTER TABLE `product_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
