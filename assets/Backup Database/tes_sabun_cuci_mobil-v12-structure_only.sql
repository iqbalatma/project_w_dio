-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2021 at 03:04 PM
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
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 12:46 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 12:52 PM
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
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `customer`:
--   `store_id`
--       `store` -> `id`
--

-- --------------------------------------------------------

--
-- Table structure for table `custom_price`
--
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 12:51 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--
-- Creation: Jan 22, 2021 at 08:13 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 12:56 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 12:56 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 12:56 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `material`
--
-- Creation: Jan 22, 2021 at 08:13 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `material_inventory`
--
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 05:10 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `material_mutation`
--
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 05:10 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `product`
--
-- Creation: Jan 22, 2021 at 08:13 AM
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
  `is_deleted` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `product`:
--

-- --------------------------------------------------------

--
-- Table structure for table `product_composition`
--
-- Creation: Jan 22, 2021 at 08:13 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `product_inventory`
--
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 12:56 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `product_mutation`
--
-- Creation: Jan 22, 2021 at 08:13 AM
-- Last update: Jan 26, 2021 at 12:56 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `role`
--
-- Creation: Jan 22, 2021 at 08:13 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `store`
--
-- Creation: Jan 22, 2021 at 08:13 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--
-- Creation: Jan 26, 2021 at 01:30 PM
-- Last update: Jan 26, 2021 at 01:53 PM
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `trans_number` varchar(100) NOT NULL,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_price`
--
ALTER TABLE `custom_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_inventory`
--
ALTER TABLE `material_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_mutation`
--
ALTER TABLE `material_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_composition`
--
ALTER TABLE `product_composition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_inventory`
--
ALTER TABLE `product_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_mutation`
--
ALTER TABLE `product_mutation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
