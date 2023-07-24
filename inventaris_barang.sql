-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2023 at 02:04 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id_data_user` int(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id_data_user`, `alamat`, `kode_pos`, `kota`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
(1, 'jl tengah lidah wetan Gg 11 Rt 3 Rw 6', '60213', 'Surabaya', 'Surabaya', '2001-09-19', 'laki-laki', '2023-06-29 23:52:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `distribusi_collection`
--

CREATE TABLE `distribusi_collection` (
  `id_dist` int(10) NOT NULL,
  `no_meja` int(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `distribusi_management`
--

CREATE TABLE `distribusi_management` (
  `id_dist` int(10) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `histori_aktifitas`
--

CREATE TABLE `histori_aktifitas` (
  `id` int(255) DEFAULT NULL,
  `userid` varchar(100) NOT NULL,
  `aktifitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kat` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kat`, `nama`, `kode`, `created_at`, `updated_at`) VALUES
(100, 'mouse', 'MS', NULL, NULL),
(102, 'headset', 'HD', NULL, NULL),
(103, 'keyboard', 'KB', NULL, NULL),
(105, 'kabel power', 'KPW', NULL, NULL),
(109, 'ssd', 'SSD', NULL, NULL),
(110, 'battery cmos', 'BTCMOS', NULL, NULL),
(111, 'pci audio card', 'AUC', NULL, NULL),
(112, 'pci lan card', 'LANC', NULL, NULL),
(113, 'all in one', 'AIO', NULL, NULL),
(114, 'laptop', 'LAPTOP', NULL, NULL),
(115, 'printer', 'PR', NULL, NULL),
(116, 'scanner', 'SC', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `level_user`
--

CREATE TABLE `level_user` (
  `id_level` int(10) NOT NULL,
  `level` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level_user`
--

INSERT INTO `level_user` (`id_level`, `level`, `created_at`, `updated_at`) VALUES
(1, 'super admin', '2023-06-27 23:59:09', NULL),
(2, 'admin', '2023-06-27 23:59:09', NULL),
(3, 'standar', '2023-06-27 23:59:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `id_inventaris` varchar(100) NOT NULL,
  `id_kat` int(10) NOT NULL,
  `id_dist_coll` int(10) DEFAULT NULL,
  `id_dist_man` int(10) DEFAULT NULL,
  `id_status` int(10) NOT NULL,
  `userid` varchar(100) NOT NULL,
  `nama_merk` varchar(100) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `pengadaan` date NOT NULL,
  `keterangan_dist` text NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `status_kondisi_barang`
--

CREATE TABLE `status_kondisi_barang` (
  `id_status` int(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `kondisi` varchar(10) NOT NULL,
  `ket_status` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_kondisi_barang`
--

INSERT INTO `status_kondisi_barang` (`id_status`, `status`, `kondisi`, `ket_status`, `created_at`, `updated_at`) VALUES
(1, 'on_stock', 'normal', NULL, '2023-06-26 22:13:05', NULL),
(2, 'out_stock', 'rusak', NULL, '2023-06-26 22:13:05', NULL),
(3, 'distribusi', 'normal', NULL, '2023-06-26 22:14:05', NULL),
(4, 'rusak', 'rusak', NULL, '2023-06-26 22:14:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` varchar(100) NOT NULL,
  `id_level` int(10) NOT NULL,
  `id_data_user` int(10) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(150) NOT NULL,
  `nama_belakang` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `id_level`, `id_data_user`, `username`, `password`, `name`, `nama_belakang`, `created_at`, `updated_at`) VALUES
('1', 1, 1, 'admin', '$2y$10$gcBqHjTFcTPsxc/As.08BeKvdsL7yC1UNsUfLpZ7MRqwt/S8JLUZ2', 'abdi', 'arkananta', NULL, '2023-06-30 00:02:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id_data_user`);

--
-- Indexes for table `distribusi_collection`
--
ALTER TABLE `distribusi_collection`
  ADD PRIMARY KEY (`id_dist`);

--
-- Indexes for table `distribusi_management`
--
ALTER TABLE `distribusi_management`
  ADD PRIMARY KEY (`id_dist`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kat`);

--
-- Indexes for table `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id_inventaris`),
  ADD KEY `id_kat` (`id_kat`),
  ADD KEY `id_dist` (`id_dist_coll`,`id_status`,`userid`),
  ADD KEY `id_dist_man` (`id_dist_man`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `status_kondisi_barang`
--
ALTER TABLE `status_kondisi_barang`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_data_user` (`id_data_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id_data_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `distribusi_management`
--
ALTER TABLE `distribusi_management`
  MODIFY `id_dist` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level_user`
--
ALTER TABLE `level_user`
  MODIFY `id_level` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `status_kondisi_barang`
--
ALTER TABLE `status_kondisi_barang`
  MODIFY `id_status` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD CONSTRAINT `master_barang_ibfk_1` FOREIGN KEY (`id_kat`) REFERENCES `kategori_barang` (`id_kat`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `master_barang_ibfk_2` FOREIGN KEY (`id_dist_man`) REFERENCES `distribusi_management` (`id_dist`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `master_barang_ibfk_3` FOREIGN KEY (`id_dist_coll`) REFERENCES `distribusi_collection` (`id_dist`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `master_barang_ibfk_4` FOREIGN KEY (`id_status`) REFERENCES `status_kondisi_barang` (`id_status`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `master_barang_ibfk_5` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level_user` (`id_level`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_data_user`) REFERENCES `data_user` (`id_data_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
