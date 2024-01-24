-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jan 2024 pada 23.58
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
-- Database: `cv_abel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_detail_kuesioner`
--

CREATE TABLE `t_detail_kuesioner` (
  `id_detail_kuesioner` int(11) NOT NULL,
  `id_pernyataan` int(11) NOT NULL,
  `id_jawaban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_evaluasi`
--

CREATE TABLE `t_evaluasi` (
  `id_evaluasi` int(11) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `evaluasi` varchar(255) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_hasil_kuesioner`
--

CREATE TABLE `t_hasil_kuesioner` (
  `id_hasil_kuesioner` int(11) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_jawaban`
--

CREATE TABLE `t_jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `jawaban` varchar(100) NOT NULL,
  `point` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kuesioner`
--

CREATE TABLE `t_kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_detail_kuesioner` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pengguna`
--

CREATE TABLE `t_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `status_aktif` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pengguna`
--

INSERT INTO `t_pengguna` (`id_pengguna`, `id_role`, `nama_lengkap`, `username`, `email`, `no_hp`, `password`, `alamat`, `lokasi`, `status_aktif`) VALUES
(44, 1, 'Admin 1', 'admin1', 'admin1@email.com', '081276543267', '$2y$10$cdyrgRChSlBoQyz/GnNOG.8n8qznV7I959vWcwOD1Nrec9qT2NU3y', 'Jalan Dago', 'PPPoE AbelNet', '1'),
(45, 1, 'Admin 2', 'admin2', 'admin2@email.com', '081274749545', '$2y$10$Pc3KBbe1yrqZIxLVyQt45ee/a.1ZebiTb8Qli3B0R4eMU5fkMA/W6', 'Jalan Coblong', 'PPPoE CIAMPEL', '1'),
(46, 2, 'Manajer 1', 'manajer1', 'manajer1@email.com', '083171027936', '$2y$10$iZ1QAWAqVy2tkuUiGxKEaebA8X0bpx5vTo18NM3HFwRT/SoMNe3Qi', 'Jalan Jambi', 'PPPoE AbelNet', '1'),
(47, 2, 'Manajer 2', 'manajer2', 'manajer2@email.com', '083171022222', '$2y$10$bJJsCPTm3gNochJZNGgPS.I027UhnBpmcUjwtYJOYC6c7cYTzp8IW', 'Jalan Cihampelas', 'PPPoE CIAMPEL', '1'),
(48, 3, 'Pelanggan 1', 'pelanggan1', 'pelanggan1@email.com', '081271027939', '$2y$10$rB8H3J9ZQaNb9neRIutQ0OGBc2JOLik8NN5DLe0FlQdrkVnAGUsai', 'Jalan Naruto', 'PPPoE AbelNet', '1'),
(49, 3, 'Pelanggan 2', 'pelanggan2', 'pelanggan2@email.com', '081299887766', '$2y$10$ttLkkJ8KyPr9TmLJuLIbqeQoJMDu9VQcnwdcpGB60Y6L/BAjwhHS.', 'Jalan Kudus', 'PPPoE CIAMPEL', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_periode`
--

CREATE TABLE `t_periode` (
  `id_periode` int(11) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pernyataan`
--

CREATE TABLE `t_pernyataan` (
  `id_pernyataan` int(11) NOT NULL,
  `pernyataan` varchar(255) NOT NULL,
  `variabel` varchar(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_role`
--

CREATE TABLE `t_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_role`
--

INSERT INTO `t_role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Manajer'),
(3, 'Pelanggan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_detail_kuesioner`
--
ALTER TABLE `t_detail_kuesioner`
  ADD PRIMARY KEY (`id_detail_kuesioner`),
  ADD KEY `id_pernyataan` (`id_pernyataan`),
  ADD KEY `id_jawaban` (`id_jawaban`);

--
-- Indeks untuk tabel `t_evaluasi`
--
ALTER TABLE `t_evaluasi`
  ADD PRIMARY KEY (`id_evaluasi`),
  ADD KEY `id_kuesioner` (`id_kuesioner`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indeks untuk tabel `t_hasil_kuesioner`
--
ALTER TABLE `t_hasil_kuesioner`
  ADD PRIMARY KEY (`id_hasil_kuesioner`),
  ADD KEY `id_kuesioner` (`id_kuesioner`),
  ADD KEY `id_periode` (`id_periode`);

--
-- Indeks untuk tabel `t_jawaban`
--
ALTER TABLE `t_jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_detail_kuesioner` (`id_detail_kuesioner`);

--
-- Indeks untuk tabel `t_pengguna`
--
ALTER TABLE `t_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_role` (`id_role`);

--
-- Indeks untuk tabel `t_periode`
--
ALTER TABLE `t_periode`
  ADD PRIMARY KEY (`id_periode`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  ADD PRIMARY KEY (`id_pernyataan`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_detail_kuesioner`
--
ALTER TABLE `t_detail_kuesioner`
  MODIFY `id_detail_kuesioner` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_evaluasi`
--
ALTER TABLE `t_evaluasi`
  MODIFY `id_evaluasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_hasil_kuesioner`
--
ALTER TABLE `t_hasil_kuesioner`
  MODIFY `id_hasil_kuesioner` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_jawaban`
--
ALTER TABLE `t_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_pengguna`
--
ALTER TABLE `t_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `t_periode`
--
ALTER TABLE `t_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  MODIFY `id_pernyataan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `t_role`
--
ALTER TABLE `t_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_detail_kuesioner`
--
ALTER TABLE `t_detail_kuesioner`
  ADD CONSTRAINT `t_detail_kuesioner_ibfk_1` FOREIGN KEY (`id_pernyataan`) REFERENCES `t_pernyataan` (`id_pernyataan`),
  ADD CONSTRAINT `t_detail_kuesioner_ibfk_2` FOREIGN KEY (`id_jawaban`) REFERENCES `t_jawaban` (`id_jawaban`);

--
-- Ketidakleluasaan untuk tabel `t_evaluasi`
--
ALTER TABLE `t_evaluasi`
  ADD CONSTRAINT `t_evaluasi_ibfk_1` FOREIGN KEY (`id_kuesioner`) REFERENCES `t_kuesioner` (`id_kuesioner`),
  ADD CONSTRAINT `t_evaluasi_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `t_periode` (`id_periode`);

--
-- Ketidakleluasaan untuk tabel `t_hasil_kuesioner`
--
ALTER TABLE `t_hasil_kuesioner`
  ADD CONSTRAINT `t_hasil_kuesioner_ibfk_1` FOREIGN KEY (`id_kuesioner`) REFERENCES `t_kuesioner` (`id_kuesioner`),
  ADD CONSTRAINT `t_hasil_kuesioner_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `t_periode` (`id_periode`);

--
-- Ketidakleluasaan untuk tabel `t_jawaban`
--
ALTER TABLE `t_jawaban`
  ADD CONSTRAINT `t_jawaban_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `t_pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  ADD CONSTRAINT `t_kuesioner_ibfk_1` FOREIGN KEY (`id_periode`) REFERENCES `t_periode` (`id_periode`),
  ADD CONSTRAINT `t_kuesioner_ibfk_2` FOREIGN KEY (`id_detail_kuesioner`) REFERENCES `t_detail_kuesioner` (`id_detail_kuesioner`);

--
-- Ketidakleluasaan untuk tabel `t_pengguna`
--
ALTER TABLE `t_pengguna`
  ADD CONSTRAINT `t_pengguna_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `t_role` (`id_role`);

--
-- Ketidakleluasaan untuk tabel `t_periode`
--
ALTER TABLE `t_periode`
  ADD CONSTRAINT `t_periode_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `t_pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  ADD CONSTRAINT `t_pernyataan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `t_pengguna` (`id_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
