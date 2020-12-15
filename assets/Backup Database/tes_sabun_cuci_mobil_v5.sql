-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2020 at 04:57 AM
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
  `id` int(11) NOT NULL,
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
(1, 'Sabun Aryanz', 'Jabar, Indonesia', '08123981232', '1231231232', 'halo@sabun-aryanz.com', 'http://sabun-aryanz.com', 'logo.png', '2020-11-16 03:02:30', '2020-12-02 02:40:37', 'gudang');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `cust_type` enum('retail','reseller') NOT NULL DEFAULT 'retail',
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
(4, 'Bruce lee', 'York New', '0854465478', 'reseller', '2020-11-16 21:47:20', 0),
(5, 'Jake Separow', 'Going Merry', '0845111487', 'retail', '2020-11-16 21:50:32', 0),
(6, 'tester', 'Tempat makan', '04567182332', 'retail', '2020-11-16 23:57:06', 0),
(7, 'tester2', 'Tempat makan 2', '0888888888', 'retail', '2020-11-16 23:59:53', 0),
(8, 'tester3', 'Tempat makan 3', '0888888889', 'reseller', '2020-11-17 00:01:03', 0),
(9, 'tester', 'Tempat makan', '0888888890', 'reseller', '2020-11-17 00:02:13', 0),
(10, 'Jackpot', 'Jendela', '085677839992', 'retail', '2020-11-17 00:45:27', 0),
(11, 'custo', 'omerr', '00000000000', 'reseller', '2020-11-17 01:29:31', 0),
(12, 'tes video', 'internet', '0888888888', 'retail', '2020-11-17 12:32:45', 0),
(13, 'tes 1', 'oqiewpq', '0804465456456', 'retail', '2020-11-19 15:43:24', 0),
(14, 'tes 2', 'qweqwe', '31323232323232', 'retail', '2020-11-19 15:44:41', 0),
(15, 'tes 4', 'saturnus', '08181815454', 'retail', '2020-11-19 15:45:30', 0),
(16, 'tesaja1', 'kosan', '0812837129838', 'retail', '2020-11-19 16:34:14', 0),
(17, 'mas 1', 'laptop', '0877123829371', 'reseller', '2020-11-19 19:09:24', 0),
(18, 'mas 2', 'komputer', '087717172662', 'retail', '2020-11-19 19:33:18', 0),
(19, 'mas 3', 'komputer', '087717172662', 'retail', '2020-11-19 19:33:39', 0),
(20, 'mas 3', 'kotak', '087717172662', 'retail', '2020-11-19 19:34:51', 0),
(21, 'mas 5', 'kimaia', '08888888882', 'retail', '2020-11-19 19:42:22', 0),
(22, 'mas 6', 'pleistesien', '0888321767227', 'retail', '2020-11-19 19:43:25', 0),
(23, 'mas 6', 'pleistesien', '0888321767227', 'retail', '2020-11-19 19:43:47', 0),
(24, 'joss 1', 'planet', '088892377743', 'reseller', '2020-11-19 19:44:41', 0),
(25, 'nama 1', 'Kepulauan 1000, Antartika', '08771231823', 'retail', '2020-11-20 15:00:00', 0),
(26, 'nama 2', 'Kepulauan 1001, Antartika', '08771231824', 'reseller', '2020-11-20 15:00:00', 0),
(27, 'nama 3', 'Kepulauan 1002, Antartika', '08771231825', 'retail', '2020-11-20 15:00:00', 0),
(28, 'nama 4', 'Kepulauan 1003, Antartika', '08771231826', 'retail', '2020-11-20 15:00:00', 0),
(29, 'nama 5', 'Kepulauan 1004, Antartika', '08771231827', 'retail', '2020-11-20 15:00:00', 0),
(30, 'nama 6', 'Kepulauan 1005, Antartika', '08771231828', 'reseller', '2020-11-20 15:00:00', 0),
(31, 'nama 7', 'Kepulauan 1006, Antartika', '08771231829', 'reseller', '2020-11-20 15:00:00', 0),
(32, 'nama 8', 'Kepulauan 1007, Antartika', '08771231830', 'retail', '2020-11-20 15:00:00', 0),
(33, 'nama 9', 'Kepulauan 1008, Antartika', '08771231831', 'reseller', '2020-11-20 15:00:00', 0),
(34, 'nama 10', 'Kepulauan 1009, Antartika', '08771231832', 'retail', '2020-11-20 15:00:00', 0),
(35, 'nama 11', 'Kepulauan 1010, Antartika', '08771231833', 'reseller', '2020-11-20 15:00:00', 0),
(36, 'nama 12', 'Kepulauan 1011, Antartika', '08771231834', 'retail', '2020-11-20 15:00:00', 0),
(37, 'nama 13', 'Kepulauan 1012, Antartika', '08771231835', 'reseller', '2020-11-20 15:00:00', 0),
(38, 'nama 14', 'Kepulauan 1013, Antartika', '08771231836', 'reseller', '2020-11-20 15:00:00', 0),
(39, 'nama 15', 'Kepulauan 1014, Antartika', '08771231837', 'retail', '2020-11-20 15:00:00', 0),
(40, 'nama 16', 'Kepulauan 1015, Antartika', '08771231838', 'reseller', '2020-11-20 15:00:00', 0),
(41, 'nama 17', 'Kepulauan 1016, Antartika', '08771231839', 'retail', '2020-11-20 15:00:00', 0),
(42, 'pleanggan', 'sdsadasdasdasdasd', '098765789876', 'reseller', '2020-11-21 15:51:28', 0),
(43, 'beruang 1', 'kutub', '087727712839', 'reseller', '2020-11-26 16:50:25', 0),
(44, 'beruang 2', 'kutub', '0812389378878', 'reseller', '2020-11-26 16:51:32', 0),
(45, 'beruang 3', 'kutub', '0846545451518', 'reseller', '2020-11-26 17:03:34', 0),
(46, 'beruang 4', 'kutub', '0856215444487', 'reseller', '2020-11-26 17:04:33', 0),
(47, 'Jhon', 'Greenland', '0871161166172', 'retail', '2020-12-09 12:56:08', 0),
(48, 'Shin', 'Blueland', '086272772661', 'retail', '2020-12-09 12:57:07', 0),
(49, 'Jhona', 'Redline', '09882712777', 'retail', '2020-12-09 13:48:26', 0),
(50, 'Albert Shicuan', 'Denpasar, Bali, Indonesia', '08465489798', 'reseller', '2020-12-11 14:00:13', 0),
(51, 'Aku retail', 'Dalam perut bumi yang jauh', '084465766548', 'retail', '2020-12-11 19:54:44', 0),
(52, 'Aku reseller', 'Di atas langit yang dingin dan gelap', '088456887945', 'reseller', '2020-12-11 19:55:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `custom_price`
--

CREATE TABLE `custom_price` (
  `id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_price`
--

INSERT INTO `custom_price` (`id`, `price`, `customer_id`, `product_code`, `created_at`, `is_deleted`) VALUES
(1, 500000, 3, 'DT003', '2020-11-20 15:00:00', 0),
(2, 450000, 3, 'DT001', '2020-11-20 15:00:00', 0),
(3, 125000, 11, 'DT005', '2020-11-20 15:00:00', 0),
(4, 40000, 24, 'DT004', '2020-11-20 15:00:00', 0),
(6, 50000, 24, 'DT005', '2020-11-20 15:00:00', 0),
(7, 1000, 24, 'DT001', '2020-11-20 15:00:00', 0),
(8, 25000, 24, 'DT002', '2020-11-20 15:00:00', 0),
(9, 63500, 24, 'DT006', '2020-11-20 15:00:00', 0),
(10, 10000, 44, 'DT001', '2020-11-26 17:02:58', 0),
(11, 7000, 46, 'DT005', '2020-11-30 19:10:10', 0),
(12, 23500, 46, 'DT001', '2020-11-26 17:51:47', 0),
(13, 14000, 46, 'DT003', '2020-11-26 17:51:47', 0),
(16, 89500, 24, 'DT003', '2020-12-09 13:46:19', 0),
(17, 79500, 49, 'DT004', '2020-12-09 13:49:17', 0),
(18, 12000, 49, 'DT001', '2020-12-09 16:12:07', 0),
(20, 500000, 46, 'DT007', '2020-12-09 22:53:48', 0),
(21, 300000, 49, 'DT006', '2020-12-10 22:55:42', 0),
(22, 650000, 48, 'DT007', '2020-12-10 22:58:30', 0),
(23, 75000, 48, 'DT003', '2020-12-10 22:58:30', 0),
(24, 315000, 48, 'DT006', '2020-12-10 22:59:15', 0),
(25, 32000, 50, 'DT012', '2020-12-11 14:01:28', 0),
(27, 40000, 52, 'DT012', '2020-12-11 19:57:06', 0),
(28, 95000, 52, 'DT011', '2020-12-11 19:57:06', 0),
(29, 58000, 52, 'DT005', '2020-12-11 19:57:06', 0),
(30, 100000, 52, 'DT004', '2020-12-11 19:57:06', 0),
(31, 56000, 52, 'DT003', '2020-12-11 19:57:06', 0),
(32, 33000, 52, 'DT002', '2020-12-11 19:57:06', 0),
(33, 31000, 52, 'DT001', '2020-12-11 19:57:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

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
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `phone`, `address`, `avatar`, `role_id`, `store_id`, `created_at`, `is_deleted`) VALUES
(0, 'superadmin', 'superadmin@msn.com', '$2a$08$g6axSKDVOvmKJOTOYUbK/OO1DP5vsSRPNtRBowHc.nQs2v5VGsoky', 'Kaisar', 'Sihir', '087717071998', 'Langit', 'avatar-7.png', 0, 1, '2020-11-18 22:55:22', 0),
(1, 'pemilik', 'pemilik@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Saya', 'Pemilik', '0871263612', 'Di kantor', 'avatar-1.png', 1, 1, '2020-11-10 22:48:27', 0),
(2, 'gudang', 'gudang@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Admin', 'Gudang', '087213513441', 'Di gudang', 'avatar-1.png', 2, 1, '2020-11-10 22:52:15', 0),
(3, 'kasir_cica', 'kasir_cica@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Cica', NULL, '0856123872', 'Di Cicalengka', 'avatar-1.png', 3, 2, '2020-11-10 22:54:23', 0),
(4, 'kasir_uber', 'kasir_uber@msn.com', '$2a$08$TewpSs2aYottWdQaZLCHjeNpMdTPBV.xizhqPrHCiuWC3aHIwfGpy', 'Kasir Uber', NULL, '08571123098', 'Di Ujung Beruang', 'avatar-1.png', 3, 3, '2020-11-10 22:54:23', 0),
(5, 'admins', 'admin1@jp.com', '$2a$08$HVX6fm.h9nJlfgYJxOlHOuKxvNB8ZJhWdB/qmuksTxaIJuT2RyoCG', 'dios', 'Ilham', '081236137132', 'Dipatiukur', 'avatar-0.png', 1, 1, '2020-11-17 03:19:40', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(100) NOT NULL,
  `paid_amount` int(21) NOT NULL,
  `left_to_paid` int(21) NOT NULL,
  `paid_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transaction_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_number`, `paid_amount`, `left_to_paid`, `paid_at`, `transaction_id`, `created_at`, `status`, `is_deleted`) VALUES
(8, '1/AR/12/2020', 529500, 0, '2020-12-14 08:46:42', 8, '2020-12-14 08:46:42', '0', 0),
(9, '2/KS/12/2020', 200000, 42000, '2020-12-14 08:48:22', 9, '2020-12-14 08:48:22', '0', 0),
(10, '3/KS/12/2020', 299000, 0, '2020-12-14 08:50:48', 10, '2020-12-14 08:50:48', '0', 0),
(11, '4/KS/12/2020', 100000, 62000, '2020-12-14 08:53:28', 11, '2020-12-14 08:53:28', '0', 0),
(13, '5/KS/12/2020', 356000, 0, '2020-12-14 10:13:31', 13, '2020-12-14 10:13:31', '0', 0),
(14, '6/KS/12/2020', 126000, 0, '2020-12-14 10:29:26', 14, '2020-12-14 10:29:26', '0', 0),
(15, '7/KS/12/2020', 120500, 0, '2020-12-14 10:38:10', 15, '2020-12-14 10:38:10', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item_price` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`id`, `quantity`, `item_price`, `invoice_id`, `product_id`) VALUES
(20, 1, 48500, 8, 9),
(21, 4, 112000, 8, 10),
(22, 4, 160000, 8, 12),
(23, 3, 81000, 9, 1),
(24, 4, 80000, 9, 5),
(25, 1, 35000, 10, 9),
(26, 1, 28000, 10, 10),
(27, 1, 25000, 10, 12),
(28, 5, 25000, 10, 13),
(29, 6, 162000, 11, 1),
(32, 4, 108000, 13, 1),
(33, 4, 140000, 13, 5),
(34, 3, 126000, 14, 6),
(35, 3, 36000, 15, 1),
(36, 1, 48500, 15, 9);

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id` int(11) NOT NULL,
  `kas_code` varchar(100) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text,
  `date` date NOT NULL,
  `debet` int(30) NOT NULL,
  `kredit` int(30) NOT NULL,
  `final_balance` int(30) NOT NULL,
  `type` enum('debet','kredit') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id`, `kas_code`, `title`, `description`, `date`, `debet`, `kredit`, `final_balance`, `type`, `created_at`, `created_by`) VALUES
(1, 'D/20/12/000001', 'Uang kas awal', NULL, '2020-12-14', 200000, 0, 200000, 'debet', '2020-12-13 20:15:12', 'superadmin'),
(7, 'D/20/12/000002', 'Checkout: INV 1/AR/12/2020', 'Total harga:529500 ; Total bayar:529500 ; Sisa harus dibayar:0 ; Oleh:superadmin', '2020-12-14', 529500, 0, 729500, 'debet', '2020-12-14 01:46:42', 'superadmin'),
(8, 'D/20/12/000003', 'Checkout: INV 2/KS/12/2020', 'Total harga:242000 ; Total bayar:200000 ; Sisa harus dibayar:42000 ; Oleh:superadmin', '2020-12-14', 200000, 0, 929500, 'debet', '2020-12-14 01:48:22', 'superadmin'),
(9, 'D/20/12/000004', 'Checkout: INV 3/KS/12/2020', 'Total harga:299000 ; Total bayar:299000 ; Sisa harus dibayar:0 ; Oleh:superadmin', '2020-12-14', 299000, 0, 1228500, 'debet', '2020-12-14 01:50:48', 'superadmin'),
(10, 'D/20/12/000005', 'Checkout: INV 4/KS/12/2020', 'Total harga:162000 ; Total bayar:100000 ; Sisa harus dibayar:62000 ; Oleh:superadmin', '2020-12-14', 100000, 0, 1328500, 'debet', '2020-12-14 01:53:28', 'superadmin'),
(11, 'D/20/12/000006', 'Checkout: INV 5/KS/12/2020', 'Total harga:356000 ; Total bayar:356000 ; Sisa harus dibayar:0 ; Oleh:kasir_cica', '2020-12-14', 356000, 0, 1684500, 'debet', '2020-12-14 03:13:31', 'kasir_cica'),
(12, 'D/20/12/000007', 'Checkout: INV 6/KS/12/2020', 'Total harga:126000 ; Total bayar:126000 ; Sisa harus dibayar:0 ; Oleh:kasir_cica', '2020-12-14', 126000, 0, 1810500, 'debet', '2020-12-14 03:29:26', 'kasir_cica'),
(13, 'D/20/12/000008', 'Checkout: INV 7/KS/12/2020', 'Total harga:120500 ; Total bayar:120500 ; Sisa harus dibayar:0 ; Oleh:kasir_cica', '2020-12-14', 120500, 0, 1931000, 'debet', '2020-12-14 03:38:10', 'kasir_cica');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

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
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `material_code`, `full_name`, `unit`, `volume`, `category`, `image`, `price_base`, `created_at`, `is_deleted`) VALUES
(1, 'BM001', 'Barang mentah 1', 'gram', 1, 'bahan', 'default.png', 11, '2020-11-16 17:40:30', 0),
(2, 'BM002', 'Barang mentah 2', 'gram', 1, 'bahan', 'default.png', 25, '2020-11-16 17:40:30', 0),
(3, 'BM003', 'Barang Mentah 3', 'gram', 1, 'bahan', 'default.png', 31, '2020-11-18 19:23:25', 0),
(4, 'BM004', 'Barang Mentah 4', 'gram', 1, 'bahan', 'default.png', 18, '2020-11-18 19:24:05', 0),
(5, 'BM005', 'Barang Mentah 5', 'gram', 1, 'kemasan', 'default.png', 17, '2020-11-18 19:24:26', 0),
(6, 'BM006', 'Barang Mentah 6', 'gram', 1, 'bahan', 'default.png', 25, '2020-11-28 02:34:37', 0),
(7, 'BM007', 'Barang Mentah 7', 'gram', 1, 'bahan', 'bukti_udah_di_upload_hehe.png', 14, '2020-11-28 02:35:23', 0),
(8, 'BM008', 'Barang Mentah 8', 'gram', 1, 'bahan', 'default.png', 32, '2020-11-28 02:46:39', 0),
(11, 'BM009', 'Cairan sabun biru', 'gram', 1, 'bahan', 'default.png', 25, '2020-12-11 13:27:48', 0),
(12, 'BM010', 'Cairan sabun merah', 'gram', 1, 'bahan', 'default.png', 12, '2020-12-11 13:31:13', 0),
(13, 'BM990', 'Tes inventory gaada row', 'gram', 1, 'bahan', 'default.png', 6, '2020-12-11 15:56:12', 0),
(14, 'BM991', 'Tes inventory ada row tapi 0', 'gram', 1, 'bahan', 'default.png', 8, '2020-12-11 15:56:32', 0),
(15, 'BM992', 'Tes inventory ada row dan >0', 'gram', 1, 'bahan', 'default.png', 54, '2020-12-11 15:57:04', 0),
(9, 'KMS001', 'Kemasan 500 ml', 'pcs', 1, 'kemasan', 'avatar-4.png', 12500, '2020-12-01 16:43:11', 0),
(10, 'KMS002', 'Kemasan 1 Liter', 'pcs', 1, 'kemasan', 'jerigen_1l.png', 17500, '2020-12-09 21:05:14', 0);

-- --------------------------------------------------------

--
-- Table structure for table `material_inventory`
--

CREATE TABLE `material_inventory` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL,
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
(1, 10, 1, 984, '2020-12-14 03:13:44', '2020-12-14 08:53:28', 'superadmin', 'superadmin', 0),
(2, 11, 1, 250, '2020-12-14 03:13:50', '2020-12-14 08:50:48', 'superadmin', 'superadmin', 0),
(3, 12, 1, 1450, '2020-12-14 03:13:55', '2020-12-14 09:53:25', 'superadmin', 'superadmin', 0),
(4, 9, 1, 36, '2020-12-14 03:14:04', '2020-12-14 08:50:48', 'superadmin', 'superadmin', 0),
(5, 7, 1, 275, '2020-12-14 03:14:09', '2020-12-14 08:50:48', 'superadmin', 'superadmin', 0),
(6, 2, 1, 200, '2020-12-14 06:47:38', '2020-12-14 06:47:38', 'superadmin', 'superadmin', 0),
(7, 3, 1, 448, '2020-12-14 06:47:44', '2020-12-14 10:14:39', 'superadmin', 'superadmin', 0),
(8, 4, 1, 200, '2020-12-14 06:47:49', '2020-12-14 06:47:49', 'superadmin', 'superadmin', 0),
(9, 5, 1, 200, '2020-12-14 06:47:54', '2020-12-14 06:47:54', 'superadmin', 'superadmin', 0),
(10, 6, 1, 200, '2020-12-14 06:47:58', '2020-12-14 06:47:58', 'superadmin', 'superadmin', 0),
(11, 8, 1, 200, '2020-12-14 06:48:06', '2020-12-14 06:48:06', 'superadmin', 'superadmin', 0),
(12, 15, 1, 230, '2020-12-14 06:48:33', '2020-12-14 06:48:33', 'superadmin', 'superadmin', 0),
(13, 1, 1, 6, '2020-12-14 09:55:12', '2020-12-14 09:55:12', 'superadmin', 'superadmin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `material_mutation`
--

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
-- Dumping data for table `material_mutation`
--

INSERT INTO `material_mutation` (`id`, `material_id`, `store_id`, `mutation_code`, `quantity`, `mutation_type`, `created_at`, `created_by`, `is_deleted`) VALUES
(30, 10, 1, '000001/MAT/KEL/14/12/2020', 1, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(31, 3, 1, '000002/MAT/KEL/14/12/2020', 86, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(32, 9, 1, '000003/MAT/KEL/14/12/2020', 4, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(33, 12, 1, '000004/MAT/KEL/14/12/2020', 200, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(34, 7, 1, '000005/MAT/KEL/14/12/2020', 140, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(35, 9, 1, '000006/MAT/KEL/14/12/2020', 4, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(36, 11, 1, '000007/MAT/KEL/14/12/2020', 200, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(37, 12, 1, '000008/MAT/KEL/14/12/2020', 240, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(38, 10, 1, '000009/MAT/KEL/14/12/2020', 3, 'keluar', '2020-12-14 08:48:22', 'superadmin', 0),
(39, 9, 1, '000010/MAT/KEL/14/12/2020', 4, 'keluar', '2020-12-14 08:48:22', 'superadmin', 0),
(40, 10, 1, '000011/MAT/KEL/14/12/2020', 1, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(41, 3, 1, '000012/MAT/KEL/14/12/2020', 86, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(42, 9, 1, '000013/MAT/KEL/14/12/2020', 1, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(43, 12, 1, '000014/MAT/KEL/14/12/2020', 50, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(44, 7, 1, '000015/MAT/KEL/14/12/2020', 35, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(45, 9, 1, '000016/MAT/KEL/14/12/2020', 1, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(46, 11, 1, '000017/MAT/KEL/14/12/2020', 50, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(47, 12, 1, '000018/MAT/KEL/14/12/2020', 60, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(48, 10, 1, '000019/MAT/KEL/14/12/2020', 5, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(49, 10, 1, '000020/MAT/KEL/14/12/2020', 6, 'keluar', '2020-12-14 08:53:28', 'superadmin', 0),
(50, 12, 1, '000021/MAT/MSK/14/12/2020', 1500, 'masuk', '2020-12-14 09:53:25', 'superadmin', 0),
(51, 1, 1, '000022/MAT/MSK/14/12/2020', 6, 'masuk', '2020-12-14 09:55:13', 'superadmin', 0),
(54, 10, 2, '000023/MAT/KEL/14/12/2020', 4, 'keluar', '2020-12-14 10:13:31', 'kasir_cica', 0),
(55, 9, 2, '000024/MAT/KEL/14/12/2020', 4, 'keluar', '2020-12-14 10:13:31', 'kasir_cica', 0),
(56, 3, 1, '000025/MAT/MSK/14/12/2020', 210, 'masuk', '2020-12-14 10:14:39', 'kasir_cica', 0),
(57, 10, 2, '000026/MAT/KEL/14/12/2020', 3, 'keluar', '2020-12-14 10:29:26', 'kasir_cica', 0),
(58, 10, 2, '000027/MAT/KEL/14/12/2020', 3, 'keluar', '2020-12-14 10:38:10', 'kasir_cica', 0),
(59, 10, 2, '000028/MAT/KEL/14/12/2020', 1, 'keluar', '2020-12-14 10:38:10', 'kasir_cica', 0),
(60, 3, 2, '000029/MAT/KEL/14/12/2020', 86, 'keluar', '2020-12-14 10:38:10', 'kasir_cica', 0),
(3, 12, 1, 'MUTATION-MATERIAL-2020-12-13248', 500, 'masuk', '2020-12-14 03:13:55', 'superadmin', 0),
(1, 10, 1, 'MUTATION-MATERIAL-2020-12-13355', 1000, 'masuk', '2020-12-14 03:13:44', 'superadmin', 0),
(5, 7, 1, 'MUTATION-MATERIAL-2020-12-13358', 250, 'masuk', '2020-12-14 03:14:09', 'superadmin', 0),
(4, 9, 1, 'MUTATION-MATERIAL-2020-12-13937', 50, 'masuk', '2020-12-14 03:14:04', 'superadmin', 0),
(2, 11, 1, 'MUTATION-MATERIAL-2020-12-13948', 500, 'masuk', '2020-12-14 03:13:50', 'superadmin', 0),
(9, 5, 1, 'MUTATION-MATERIAL-2020-12-1434', 200, 'masuk', '2020-12-14 06:47:54', 'superadmin', 0),
(13, 15, 1, 'MUTATION-MATERIAL-2020-12-14361', 230, 'masuk', '2020-12-14 06:48:33', 'superadmin', 0),
(7, 3, 1, 'MUTATION-MATERIAL-2020-12-14406', 200, 'masuk', '2020-12-14 06:47:44', 'superadmin', 0),
(8, 4, 1, 'MUTATION-MATERIAL-2020-12-14408', 200, 'masuk', '2020-12-14 06:47:49', 'superadmin', 0),
(6, 2, 1, 'MUTATION-MATERIAL-2020-12-14687', 200, 'masuk', '2020-12-14 06:47:39', 'superadmin', 0),
(12, 8, 1, 'MUTATION-MATERIAL-2020-12-14693', 200, 'masuk', '2020-12-14 06:48:06', 'superadmin', 0),
(10, 6, 1, 'MUTATION-MATERIAL-2020-12-14732', 200, 'masuk', '2020-12-14 06:47:58', 'superadmin', 0),
(11, 7, 1, 'MUTATION-MATERIAL-2020-12-14864', 200, 'masuk', '2020-12-14 06:48:02', 'superadmin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `unit` enum('mililiter','gram') NOT NULL DEFAULT 'mililiter',
  `volume` int(11) NOT NULL DEFAULT '0' COMMENT 'Jumlah dalam ml / gr',
  `image` varchar(250) DEFAULT 'default.png',
  `price_base` int(11) NOT NULL DEFAULT '0' COMMENT 'Harga dasar / Harga beli / HPP',
  `selling_price` int(11) NOT NULL DEFAULT '0' COMMENT 'Harga jual yang dibuat dari harga total komposisi untuk membuatnya',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_code`, `full_name`, `unit`, `volume`, `image`, `price_base`, `selling_price`, `created_at`, `is_deleted`) VALUES
(1, 'DT001', 'Sabun Dettol 50ml - versi4', 'gram', 50, 'DT001.png', 17500, 27000, '2020-11-17 13:44:04', 0),
(2, 'DT002', 'Sabun Dettol 150ml', 'mililiter', 150, 'default.png', 28990, 63000, '2020-11-17 13:44:04', 0),
(3, 'DT003', 'Sabun Dettol 500ml', 'mililiter', 500, 'default.png', 28000, 50000, '2020-11-17 13:44:04', 0),
(4, 'DT004', 'Sabun Dettol 1L', 'mililiter', 1000, 'default.png', 8070, 16000, '2020-11-18 15:37:08', 0),
(5, 'DT005', 'Sabun Dettol 1.5L', 'gram', 15, 'default.png', 12500, 35000, '2020-11-18 16:12:08', 0),
(6, 'DT006', 'Sabun Dettol 10L', 'mililiter', 10000, 'default.png', 17500, 42000, '2020-11-18 17:33:36', 0),
(7, 'DT007', 'Sabun Soap Batang 50gr', 'gram', 1000, 'DT007.jpeg', 3338, 10000, '2020-12-09 19:49:05', 0),
(8, 'DT008', 'Dettol liquid 500ml', 'gram', 1, 'default.png', 25000, 53000, '2020-12-10 01:08:34', 0),
(9, 'DT009', 'Sabun Dove Milkbath', 'gram', 50, 'default.png', 20166, 48500, '2020-12-12 18:53:22', 0),
(10, 'DT010', 'Sabun Brand New Rose', 'gram', 100, 'DT009.png', 13590, 28000, '2020-12-11 01:57:03', 0),
(11, 'DT011', 'Sabun Brand New Gold', 'gram', 1, 'default.png', 20025, 55000, '2020-12-11 01:58:25', 0),
(12, 'DT012', 'Sabun Hi-clean Silver', 'gram', 1000, 'DT011.png', 14470, 35000, '2020-12-11 13:52:56', 0),
(13, 'DT013', 'Sabun Ekonomis X', 'gram', 50, 'default.png', 17500, 0, '2020-12-11 15:39:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_composition`
--

CREATE TABLE `product_composition` (
  `id` int(11) NOT NULL,
  `volume` int(11) NOT NULL COMMENT 'Jumlah dalam ml / gr',
  `product_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_composition`
--

INSERT INTO `product_composition` (`id`, `volume`, `product_id`, `material_id`, `created_at`, `updated_at`, `is_deleted`) VALUES
(1, 1, 13, 10, '2020-12-14 06:57:05', '2020-12-14 06:57:05', 0),
(2, 1, 12, 9, '2020-12-14 07:00:02', '2020-12-14 07:00:02', 0),
(3, 50, 12, 11, '2020-12-14 07:00:02', '2020-12-14 07:00:02', 0),
(4, 60, 12, 12, '2020-12-14 07:00:02', '2020-12-14 07:00:02', 0),
(5, 1, 11, 10, '2020-12-14 07:00:54', '2020-12-14 07:00:54', 0),
(6, 5, 11, 12, '2020-12-14 07:00:54', '2020-12-14 07:00:54', 0),
(7, 5, 11, 11, '2020-12-14 07:00:54', '2020-12-14 07:00:54', 0),
(8, 10, 11, 8, '2020-12-14 07:00:54', '2020-12-14 07:00:54', 0),
(9, 32, 11, 7, '2020-12-14 07:00:54', '2020-12-14 07:00:54', 0),
(10, 52, 11, 1, '2020-12-14 07:00:54', '2020-12-14 07:00:54', 0),
(11, 14, 11, 2, '2020-12-14 07:00:54', '2020-12-14 07:00:54', 0),
(12, 10, 11, 3, '2020-12-14 07:00:54', '2020-12-14 07:00:54', 0),
(13, 20, 11, 5, '2020-12-14 07:00:54', '2020-12-14 07:00:54', 0),
(14, 1, 10, 9, '2020-12-14 07:01:31', '2020-12-14 07:01:31', 0),
(15, 50, 10, 12, '2020-12-14 07:01:31', '2020-12-14 07:01:31', 0),
(16, 35, 10, 7, '2020-12-14 07:01:31', '2020-12-14 07:01:31', 0),
(17, 1, 9, 10, '2020-12-14 07:02:02', '2020-12-14 07:02:02', 0),
(18, 86, 9, 3, '2020-12-14 07:02:02', '2020-12-14 07:02:02', 0),
(19, 125, 8, 12, '2020-12-14 07:02:47', '2020-12-14 07:02:47', 0),
(20, 240, 8, 11, '2020-12-14 07:02:48', '2020-12-14 07:02:47', 0),
(21, 1, 8, 10, '2020-12-14 07:02:48', '2020-12-14 07:02:47', 0),
(22, 30, 7, 12, '2020-12-14 07:03:39', '2020-12-14 07:03:39', 0),
(23, 30, 7, 11, '2020-12-14 07:03:39', '2020-12-14 07:03:39', 0),
(24, 54, 7, 7, '2020-12-14 07:03:39', '2020-12-14 07:03:39', 0),
(25, 46, 7, 8, '2020-12-14 07:03:39', '2020-12-14 07:03:39', 0),
(26, 1, 6, 10, '2020-12-14 07:05:28', '2020-12-14 07:05:28', 0),
(27, 1, 5, 9, '2020-12-14 07:05:44', '2020-12-14 07:05:44', 0),
(28, 150, 4, 11, '2020-12-14 07:06:03', '2020-12-14 07:06:03', 0),
(29, 360, 4, 12, '2020-12-14 07:06:03', '2020-12-14 07:06:03', 0),
(30, 1, 3, 10, '2020-12-14 07:07:19', '2020-12-14 07:07:19', 0),
(31, 420, 3, 2, '2020-12-14 07:07:19', '2020-12-14 07:07:19', 0),
(32, 180, 2, 4, '2020-12-14 07:08:16', '2020-12-14 07:08:16', 0),
(33, 100, 2, 6, '2020-12-14 07:08:16', '2020-12-14 07:08:16', 0),
(34, 250, 2, 1, '2020-12-14 07:08:16', '2020-12-14 07:08:16', 0),
(35, 120, 2, 2, '2020-12-14 07:08:16', '2020-12-14 07:08:16', 0),
(36, 1, 2, 10, '2020-12-14 07:08:16', '2020-12-14 07:08:16', 0),
(37, 1, 1, 10, '2020-12-14 07:08:45', '2020-12-14 07:08:45', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_mutation`
--

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
-- Dumping data for table `product_mutation`
--

INSERT INTO `product_mutation` (`id`, `product_id`, `store_id`, `mutation_code`, `quantity`, `mutation_type`, `created_at`, `created_by`, `is_deleted`) VALUES
(14, 9, 1, '000001/PRO/KEL/14/12/2020', 1, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(15, 10, 1, '000002/PRO/KEL/14/12/2020', 4, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(16, 12, 1, '000003/PRO/KEL/14/12/2020', 4, 'keluar', '2020-12-14 08:46:42', 'superadmin', 0),
(17, 1, 1, '000004/PRO/KEL/14/12/2020', 3, 'keluar', '2020-12-14 08:48:22', 'superadmin', 0),
(18, 5, 1, '000005/PRO/KEL/14/12/2020', 4, 'keluar', '2020-12-14 08:48:22', 'superadmin', 0),
(19, 9, 1, '000006/PRO/KEL/14/12/2020', 1, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(20, 10, 1, '000007/PRO/KEL/14/12/2020', 1, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(21, 12, 1, '000008/PRO/KEL/14/12/2020', 1, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(22, 13, 1, '000009/PRO/KEL/14/12/2020', 5, 'keluar', '2020-12-14 08:50:48', 'superadmin', 0),
(23, 1, 1, '000010/PRO/KEL/14/12/2020', 6, 'keluar', '2020-12-14 08:53:28', 'superadmin', 0),
(26, 1, 2, '000011/PRO/KEL/14/12/2020', 4, 'keluar', '2020-12-14 10:13:31', 'kasir_cica', 0),
(27, 5, 2, '000012/PRO/KEL/14/12/2020', 4, 'keluar', '2020-12-14 10:13:31', 'kasir_cica', 0),
(28, 6, 2, '000013/PRO/KEL/14/12/2020', 3, 'keluar', '2020-12-14 10:29:26', 'kasir_cica', 0),
(29, 1, 2, '000014/PRO/KEL/14/12/2020', 3, 'keluar', '2020-12-14 10:38:10', 'kasir_cica', 0),
(30, 9, 2, '000015/PRO/KEL/14/12/2020', 1, 'keluar', '2020-12-14 10:38:10', 'kasir_cica', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `created_at`, `is_deleted`) VALUES
(0, 'superadmin', '2020-11-10 22:46:29', 0),
(1, 'owner', '2020-11-10 22:46:29', 0),
(2, 'admin', '2020-11-10 22:46:29', 0),
(3, 'cashier', '2020-11-10 22:46:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `store_name` varchar(128) NOT NULL,
  `address` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `store_name`, `address`, `created_at`, `is_deleted`) VALUES
(1, 'Gudang Pusat', 'Jawa Barat, Indonesia', '2020-11-08 13:07:02', 0),
(2, 'Toko Cabang Cicalengka', 'Cicalengka', '2020-11-08 13:07:02', 0),
(3, 'Toko Cabang Ujung Berung', 'Ujung Berung', '2020-11-08 13:07:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trans_number` varchar(100) NOT NULL,
  `deliv_address` varchar(250) DEFAULT NULL,
  `price_total` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `due_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `trans_number`, `deliv_address`, `price_total`, `store_id`, `customer_id`, `employee_id`, `due_at`, `created_at`, `is_deleted`) VALUES
(8, 'TRX/12/2020/000001', 'Di atas langit yang dingin dan gelap', 529500, 1, 52, 0, '2020-12-14 08:46:42', '2020-12-14 08:46:42', 0),
(9, 'TRX/12/2020/000002', 'Blueland', 242000, 1, 48, 0, '2020-12-21 08:48:22', '2020-12-14 08:48:22', 0),
(10, 'TRX/12/2020/000003', 'Kepulauan 1014, Antartika', 299000, 1, 39, 0, '2020-12-14 08:50:48', '2020-12-14 08:50:48', 0),
(11, 'TRX/12/2020/000004', 'Going Merry Blueseaaaaaa', 162000, 1, 5, 0, '2020-12-21 08:53:28', '2020-12-14 08:53:28', 0),
(13, 'TRX/12/2020/000005', 'Dalam perut bumi yang jauh', 356000, 2, 51, 3, '2020-12-14 10:13:31', '2020-12-14 10:13:31', 0),
(14, 'TRX/12/2020/000006', 'Greenland', 126000, 2, 47, 3, '2020-12-14 10:29:26', '2020-12-14 10:29:26', 0),
(15, 'TRX/12/2020/000007', 'Redline', 120500, 2, 49, 3, '2020-12-14 10:38:10', '2020-12-14 10:38:10', 0);

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
  ADD KEY `transaction_id` (`transaction_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `custom_price`
--
ALTER TABLE `custom_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `material_inventory`
--
ALTER TABLE `material_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `material_mutation`
--
ALTER TABLE `material_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_composition`
--
ALTER TABLE `product_composition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `product_mutation`
--
ALTER TABLE `product_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `product_composition_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `product_composition_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
