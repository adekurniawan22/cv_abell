-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jan 2024 pada 06.45
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

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
-- Struktur dari tabel `t_dimensi`
--

CREATE TABLE `t_dimensi` (
  `id_dimensi` int(11) NOT NULL,
  `dimensi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_dimensi`
--

INSERT INTO `t_dimensi` (`id_dimensi`, `dimensi`) VALUES
(1, 'Tangibles (Bukti Lansung)'),
(2, 'Reliability (Keandalan)'),
(3, 'Responsiveness (Daya Tanggap)'),
(4, 'Assurance (Kepastian)'),
(5, 'Emphaty (Empati)');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_jawaban`
--

CREATE TABLE `t_jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_pernyataan` int(11) NOT NULL,
  `presepsi` varchar(100) NOT NULL,
  `ekspetasi` varchar(100) NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kuesioner`
--

CREATE TABLE `t_kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `judul_kuesioner` varchar(255) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `id_pegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_kuesioner`
--

INSERT INTO `t_kuesioner` (`id_kuesioner`, `judul_kuesioner`, `mulai`, `selesai`, `id_pegawai`) VALUES
(11, 'Judul 2', '2024-01-21', '2024-01-27', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_lokasi_server`
--

CREATE TABLE `t_lokasi_server` (
  `id_lokasi_server` int(11) NOT NULL,
  `lokasi_server` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_lokasi_server`
--

INSERT INTO `t_lokasi_server` (`id_lokasi_server`, `lokasi_server`) VALUES
(1, 'PPPoE Tirtamulya R1'),
(2, 'PPPoE AbelNet'),
(3, 'PPPoE OLT KJ'),
(4, 'PPPoE OLT CITARIK'),
(5, 'PPPoE CIAMPEL');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pegawai`
--

CREATE TABLE `t_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pegawai`
--

INSERT INTO `t_pegawai` (`id_pegawai`, `jabatan`, `nama_lengkap`, `username`, `email`, `no_hp`, `password`, `alamat`) VALUES
(1, 'Manajer', 'Manajer 1', 'manajer1', 'manajer1@email.com', '0812747495454', '$2y$10$6lnE0sqZU36.DUX3UFLhuOnz6wYHBODxQVaqjJOGdzfi4QApYJ1BC', 'Jalan Dago, Nomor 414'),
(2, 'Manajer', 'Manajer 2', 'manajer2', 'manajer2@email.com', '083171027946', '$2y$10$GGv1HB3UZ9zJ0tVQeVYCq.tjVcC.FpX15VgKw5fUf3FQU/UEq80Gq', 'Jalan Cihampelas, Nomor 44'),
(3, 'Admin', 'Admin 1', 'admin1', 'admin1@email.com', '081277778899', '$2y$10$81mDK1HUQMWOKxgXxkprzeNBO1aLB1mT6grrFH1GbbfQWjYJ8Xztq', 'Jalan Dago, Nomor 12'),
(4, 'Admin', 'Admin 2', 'admin2', 'admin2@email.com', '083171976532', '$2y$10$p3T0KN4YSJ95oTkVMdepwuSadEnAnYFe0YgcBm7PRbcQhBq9kPP7q', 'Jalan Djuanda, Nomor 33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pelanggan`
--

CREATE TABLE `t_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `lokasi_server` varchar(100) NOT NULL,
  `status_aktif` enum('1','0') NOT NULL,
  `mulai_berlangganan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pelanggan`
--

INSERT INTO `t_pelanggan` (`id_pelanggan`, `id_pegawai`, `nama_lengkap`, `no_hp`, `alamat`, `lokasi_server`, `status_aktif`, `mulai_berlangganan`) VALUES
(1, 1, 'Pelanggan 1', '081299999999', 'Jalan Ciamis, Nomor 55', 'PPPoE AbelNet', '1', '2019-01-17'),
(2, 1, 'Pelanggan 2', '083199999999', 'Jalan Gatot Kaca, Nomor 14', 'PPPoE AbelNet', '1', '2021-01-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pernyataan`
--

CREATE TABLE `t_pernyataan` (
  `id_pernyataan` int(11) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `id_dimensi` int(11) NOT NULL,
  `pernyataan` varchar(255) NOT NULL,
  `rekomendasi_perbaikan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pernyataan`
--

INSERT INTO `t_pernyataan` (`id_pernyataan`, `id_kuesioner`, `id_dimensi`, `pernyataan`, `rekomendasi_perbaikan`) VALUES
(31, 11, 1, 'Tempat yang strategis', ''),
(32, 11, 1, 'Lingkungan perusahaan yang bersih dan nyaman', ''),
(33, 11, 1, 'Kelengkapan dan fasilitas yang disediakan', ''),
(34, 11, 2, 'Kesesuaian harga dan kualitas yang diberikan', ''),
(35, 11, 2, 'Pelayanan cepat tanggap yang baik', ''),
(36, 11, 2, 'Kemampian perusahaan dalam memberikan inforasi dengan baik', ''),
(37, 11, 3, 'Ketanggapan perusahaan dalam memenuhi kebutuhan pelanggan', ''),
(38, 11, 3, 'Kecepatan teknisi dalam menyelesaikan pekerjaan', ''),
(39, 11, 3, 'Internet yang cepat dan stabil', ''),
(40, 11, 4, 'Kualitas pelayanan yang baik', ''),
(41, 11, 4, 'Kesigapan perusahaan dalam menangani masalah', ''),
(42, 11, 4, 'Keamanan privasi dan informasi', ''),
(43, 11, 5, 'Penawaran promosi atau diskon khusus', ''),
(44, 11, 5, 'Kepedulian perusahaan dalam melayani pelanggan', ''),
(45, 11, 5, 'Perusahaan memenuhi keinginan serta kebutuhan pelanggan', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_sudah_isi_kuesioner`
--

CREATE TABLE `t_sudah_isi_kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_dimensi`
--
ALTER TABLE `t_dimensi`
  ADD PRIMARY KEY (`id_dimensi`);

--
-- Indeks untuk tabel `t_jawaban`
--
ALTER TABLE `t_jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_pernyataan` (`id_pernyataan`);

--
-- Indeks untuk tabel `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `t_lokasi_server`
--
ALTER TABLE `t_lokasi_server`
  ADD PRIMARY KEY (`id_lokasi_server`);

--
-- Indeks untuk tabel `t_pegawai`
--
ALTER TABLE `t_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  ADD PRIMARY KEY (`id_pernyataan`),
  ADD KEY `id_kuesioner` (`id_kuesioner`),
  ADD KEY `id_dimensi` (`id_dimensi`);

--
-- Indeks untuk tabel `t_sudah_isi_kuesioner`
--
ALTER TABLE `t_sudah_isi_kuesioner`
  ADD KEY `id_kuesioner` (`id_kuesioner`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_dimensi`
--
ALTER TABLE `t_dimensi`
  MODIFY `id_dimensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `t_jawaban`
--
ALTER TABLE `t_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `t_lokasi_server`
--
ALTER TABLE `t_lokasi_server`
  MODIFY `id_lokasi_server` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `t_pegawai`
--
ALTER TABLE `t_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  MODIFY `id_pernyataan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_jawaban`
--
ALTER TABLE `t_jawaban`
  ADD CONSTRAINT `t_jawaban_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `t_pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `t_jawaban_ibfk_2` FOREIGN KEY (`id_pernyataan`) REFERENCES `t_pernyataan` (`id_pernyataan`);

--
-- Ketidakleluasaan untuk tabel `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  ADD CONSTRAINT `t_kuesioner_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `t_pegawai` (`id_pegawai`);

--
-- Ketidakleluasaan untuk tabel `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  ADD CONSTRAINT `t_pelanggan_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `t_pegawai` (`id_pegawai`);

--
-- Ketidakleluasaan untuk tabel `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  ADD CONSTRAINT `t_pernyataan_ibfk_1` FOREIGN KEY (`id_kuesioner`) REFERENCES `t_kuesioner` (`id_kuesioner`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_pernyataan_ibfk_2` FOREIGN KEY (`id_dimensi`) REFERENCES `t_dimensi` (`id_dimensi`);

--
-- Ketidakleluasaan untuk tabel `t_sudah_isi_kuesioner`
--
ALTER TABLE `t_sudah_isi_kuesioner`
  ADD CONSTRAINT `t_sudah_isi_kuesioner_ibfk_1` FOREIGN KEY (`id_kuesioner`) REFERENCES `t_kuesioner` (`id_kuesioner`),
  ADD CONSTRAINT `t_sudah_isi_kuesioner_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `t_pelanggan` (`id_pelanggan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
