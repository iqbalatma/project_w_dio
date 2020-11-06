-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 05:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sabun`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_jadi`
--

CREATE TABLE `barang_jadi` (
  `kode_bj` varchar(8) NOT NULL,
  `nama_bj` varchar(128) NOT NULL,
  `harga_konsumen` int(11) NOT NULL,
  `harga_reseller` int(11) NOT NULL,
  `harga_grosir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `barang_mentah`
--

CREATE TABLE `barang_mentah` (
  `kode_bm` varchar(8) NOT NULL,
  `nama_bm` varchar(128) NOT NULL,
  `satuan_jenis` varchar(64) NOT NULL,
  `stok_bm` int(11) NOT NULL,
  `harga_bm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_mentah`
--

INSERT INTO `barang_mentah` (`kode_bm`, `nama_bm`, `satuan_jenis`, `stok_bm`, `harga_bm`) VALUES
('BM01', 'Barang Mentah 1', 'gram', 4500, 45),
('BM02', 'Barang Mentah 2', 'gram', 200, 7),
('BM03', 'Barang Mentah 3', 'gram', 6500, 15),
('BM04', 'Barang Mentah', 'gram', 13000, 26),
('BM05', 'Barang Mentah 5', 'gram', 200, 25),
('BM06', 'Barang Mentah 6', 'gram', 650, 31),
('BM07', 'Barang Mentah 7', 'gram', 8400, 52),
('BM08', 'Barang Mentah 8', 'gram', 700, 16),
('BM09', 'Barang Mentah 9', 'gram', 50, 8),
('BM10', 'Barang Mentah 10', 'gram', 300, 45);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kode_pelanggan` varchar(8) NOT NULL,
  `nama_pelanggan` varchar(128) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `nomor_telepon` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` varchar(8) NOT NULL,
  `cabang_toko` varchar(128) NOT NULL,
  `alamat_toko` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `cabang_toko`, `alamat_toko`) VALUES
('TK01', 'Toko Cabang 1 (Cicalengka)', 'Cicalengka'),
('TK02', 'Toko Cabang 2 (Ujung Berung)', 'Ujung Berung');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` varchar(8) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(512) NOT NULL,
  `nama_depan` varchar(64) NOT NULL,
  `nama_belakang` varchar(64) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_handphone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_jadi`
--
ALTER TABLE `barang_jadi`
  ADD PRIMARY KEY (`kode_bj`);

--
-- Indexes for table `barang_mentah`
--
ALTER TABLE `barang_mentah`
  ADD PRIMARY KEY (`kode_bm`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
