-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 20, 2026 at 11:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_rekam_medis`
--

-- --------------------------------------------------------

--
-- Table structure for table `antrian`
--

CREATE TABLE `antrian` (
  `id_antrian` int(11) NOT NULL,
  `nomor_bpjs` varchar(20) NOT NULL,
  `poli_tujuan` varchar(50) NOT NULL,
  `nomor_antrian` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('menunggu','selesai','batal') DEFAULT 'menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `antrian`
--

INSERT INTO `antrian` (`id_antrian`, `nomor_bpjs`, `poli_tujuan`, `nomor_antrian`, `tanggal`, `status`) VALUES
(7, '1237329', 'gigi', 1, '2026-04-19', 'menunggu'),
(8, '1237329', 'umum', 1, '2026-04-19', 'menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `nip` varchar(20) NOT NULL,
  `nama_dokter` varchar(100) NOT NULL,
  `poli_dokter` varchar(50) NOT NULL,
  `hari` varchar(100) DEFAULT NULL,
  `jam` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`nip`, `nama_dokter`, `poli_dokter`, `hari`, `jam`) VALUES
('9999997', 'dokter', 'Poli Umum', 'senin', '08.00-12.20');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `nomor_bpjs` varchar(20) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`nomor_bpjs`, `nama_pasien`, `alamat`, `jenis_kelamin`) VALUES
('1237329', 'scythe1', 'biawan gg2', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rujukan`
--

CREATE TABLE `rujukan` (
  `id_rujukan` int(11) NOT NULL,
  `no_rujukan` varchar(20) NOT NULL,
  `no_bpjs` varchar(20) NOT NULL,
  `rs_tujuan` varchar(100) NOT NULL,
  `keluhan` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('Diterima','Dikirim','Ditolak') DEFAULT 'Dikirim'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `role` enum('admin','dokter','user') DEFAULT 'user',
  `bpjs` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `password`, `nip`, `role`, `bpjs`, `alamat`) VALUES
(2, 'dokter', 'mainepep', '9999997', 'dokter', NULL, 'biawan gang2'),
(3, 'admin', 'admin1', NULL, 'admin', NULL, NULL),
(4, 'scythe1', 'mainepep', NULL, 'user', '1237329', 'biawan gg2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `antrian`
--
ALTER TABLE `antrian`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `fk_antrian_pasien` (`nomor_bpjs`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`nomor_bpjs`);

--
-- Indexes for table `rujukan`
--
ALTER TABLE `rujukan`
  ADD PRIMARY KEY (`id_rujukan`),
  ADD KEY `fk_rujukan_pasien` (`no_bpjs`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `unique_nip` (`nip`),
  ADD UNIQUE KEY `unique_bpjs` (`bpjs`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `antrian`
--
ALTER TABLE `antrian`
  MODIFY `id_antrian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rujukan`
--
ALTER TABLE `rujukan`
  MODIFY `id_rujukan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `antrian`
--
ALTER TABLE `antrian`
  ADD CONSTRAINT `fk_antrian_pasien` FOREIGN KEY (`nomor_bpjs`) REFERENCES `pasien` (`nomor_bpjs`) ON DELETE CASCADE;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `fk_dokter_users` FOREIGN KEY (`nip`) REFERENCES `users` (`nip`) ON DELETE CASCADE;

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `fk_pasien_users` FOREIGN KEY (`nomor_bpjs`) REFERENCES `users` (`bpjs`) ON DELETE CASCADE;

--
-- Constraints for table `rujukan`
--
ALTER TABLE `rujukan`
  ADD CONSTRAINT `fk_rujukan_pasien` FOREIGN KEY (`no_bpjs`) REFERENCES `pasien` (`nomor_bpjs`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
