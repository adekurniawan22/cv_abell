-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2024 at 10:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cv_abell`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_jawaban`
--

CREATE TABLE `t_jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_pernyataan` int(11) NOT NULL,
  `presepsi` varchar(100) NOT NULL,
  `ekspetasi` varchar(100) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_jawaban`
--

INSERT INTO `t_jawaban` (`id_jawaban`, `id_pernyataan`, `presepsi`, `ekspetasi`, `id_pengguna`) VALUES
(34, 15, 'S', 'S', 142),
(35, 16, 'S', 'TS', 142),
(36, 17, 'SS', 'SS', 142);

-- --------------------------------------------------------

--
-- Table structure for table `t_kuesioner`
--

CREATE TABLE `t_kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `judul_kuesioner` varchar(255) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_kuesioner`
--

INSERT INTO `t_kuesioner` (`id_kuesioner`, `judul_kuesioner`, `mulai`, `selesai`, `id_pengguna`) VALUES
(8, 'Kuesioner Kepuasan Pelanggan Periode 1', '2024-01-29', '2024-01-31', 155);

-- --------------------------------------------------------

--
-- Table structure for table `t_lokasi_server`
--

CREATE TABLE `t_lokasi_server` (
  `id_lokasi_server` int(11) NOT NULL,
  `lokasi_server` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_lokasi_server`
--

INSERT INTO `t_lokasi_server` (`id_lokasi_server`, `lokasi_server`) VALUES
(1, 'PPPoE Tirtamulya R1'),
(2, 'PPPoE AbelNet'),
(3, 'PPPoE OLT KJ'),
(4, 'PPPoE OLT CITARIK'),
(5, 'PPPoE CIAMPEL');

-- --------------------------------------------------------

--
-- Table structure for table `t_pengguna`
--

CREATE TABLE `t_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `status_aktif` enum('1','0') NOT NULL,
  `tanggal_langganan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pengguna`
--

INSERT INTO `t_pengguna` (`id_pengguna`, `role`, `nama_lengkap`, `username`, `email`, `no_hp`, `password`, `alamat`, `lokasi`, `status_aktif`, `tanggal_langganan`) VALUES
(144, 'Manajer', 'Manajer Budi', 'manajer', 'resaendrawan@gmail.com', '0822222222', '$2y$10$cm7MU8rwUMAB3BNuYUqceefMOCWVWUJ80BeAyWe7kbKZBKJtPEHVK', 'Cikampek, Karawang', '', '1', NULL),
(155, 'Admin', 'Resa Endrawan', 'admin', 'resaend13@gmail.com', '081234123411', '$2y$10$IffB197jTEXH6i0sCvJqR.mMbp.LxrlbsoouIqcMYm65peuwstZ9i', 'Cikampek', '', '1', NULL),
(156, 'Pelanggan', 'Pelanggan', 'pelanggan', 'resaendr@gmail.com', '083745252342', '$2y$10$Dg9f6rImB/T19VzsEl0VTus343RioG/9XYhqn4jprRIWSy3BZbnkm', 'Cikampek', 'PPPoE AbelNet', '1', '2024-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `t_pernyataan`
--

CREATE TABLE `t_pernyataan` (
  `id_pernyataan` int(11) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `pernyataan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_pernyataan`
--

INSERT INTO `t_pernyataan` (`id_pernyataan`, `id_kuesioner`, `pernyataan`) VALUES
(26, 8, 'Tempat yang strategis'),
(27, 8, 'Layanan sesuai dengan harga yang diberikan');

-- --------------------------------------------------------

--
-- Table structure for table `t_sudah_isi_form`
--

CREATE TABLE `t_sudah_isi_form` (
  `id_kuesioner` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_sudah_isi_form`
--

INSERT INTO `t_sudah_isi_form` (`id_kuesioner`, `id_pengguna`) VALUES
(4, 142);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_jawaban`
--
ALTER TABLE `t_jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`);

--
-- Indexes for table `t_lokasi_server`
--
ALTER TABLE `t_lokasi_server`
  ADD PRIMARY KEY (`id_lokasi_server`);

--
-- Indexes for table `t_pengguna`
--
ALTER TABLE `t_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_role` (`role`);

--
-- Indexes for table `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  ADD PRIMARY KEY (`id_pernyataan`),
  ADD KEY `id_kuesioner` (`id_kuesioner`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_jawaban`
--
ALTER TABLE `t_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_lokasi_server`
--
ALTER TABLE `t_lokasi_server`
  MODIFY `id_lokasi_server` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_pengguna`
--
ALTER TABLE `t_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  MODIFY `id_pernyataan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  ADD CONSTRAINT `t_pernyataan_ibfk_1` FOREIGN KEY (`id_kuesioner`) REFERENCES `t_kuesioner` (`id_kuesioner`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
