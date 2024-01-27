-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jan 2024 pada 21.38
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
-- Struktur dari tabel `t_kuesioner`
--

CREATE TABLE `t_kuesioner` (
  `id_kuesioner` int(11) NOT NULL,
  `judul_kuesioner` varchar(255) NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_kuesioner`
--

INSERT INTO `t_kuesioner` (`id_kuesioner`, `judul_kuesioner`, `mulai`, `selesai`, `id_pengguna`) VALUES
(1, 'Judul', '2024-01-25', '2024-01-27', 44);

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
(5, 'PPPoE CIAMPEL'),
(10, 'Tes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pengguna`
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
  `status_aktif` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pengguna`
--

INSERT INTO `t_pengguna` (`id_pengguna`, `role`, `nama_lengkap`, `username`, `email`, `no_hp`, `password`, `alamat`, `lokasi`, `status_aktif`) VALUES
(44, 'Admin', 'Admin 1', 'admin1', 'admin1@email.com', '081276543267', '$2y$10$cdyrgRChSlBoQyz/GnNOG.8n8qznV7I959vWcwOD1Nrec9qT2NU3y', 'Jalan Dago', 'PPPoE AbelNet', '1'),
(45, 'Admin', 'Admin 2', 'admin2', 'admin2@email.com', '081274749545', '$2y$10$Pc3KBbe1yrqZIxLVyQt45ee/a.1ZebiTb8Qli3B0R4eMU5fkMA/W6', 'Jalan Coblong', 'PPPoE CIAMPEL', '1'),
(46, 'Manajer', 'Manajer 1', 'manajer1', 'manajer1@email.com', '083171027936', '$2y$10$iZ1QAWAqVy2tkuUiGxKEaebA8X0bpx5vTo18NM3HFwRT/SoMNe3Qi', 'Jalan Jambi', 'PPPoE AbelNet', '1'),
(47, 'Manajer', 'Manajer 2', 'manajer2', 'manajer2@email.com', '083171022222', '$2y$10$bJJsCPTm3gNochJZNGgPS.I027UhnBpmcUjwtYJOYC6c7cYTzp8IW', 'Jalan Cihampelas', 'PPPoE CIAMPEL', '1'),
(48, 'Pelanggan', 'Pelanggan 1', 'pelanggan1', 'pelanggan1@email.com', '081271027939', '$2y$10$rB8H3J9ZQaNb9neRIutQ0OGBc2JOLik8NN5DLe0FlQdrkVnAGUsai', 'Jalan Naruto', 'PPPoE AbelNet', '1'),
(49, 'Pelanggan', 'Pelanggan 2', 'pelanggan2', 'pelanggan2@email.com', '081299887766', '$2y$10$ttLkkJ8KyPr9TmLJuLIbqeQoJMDu9VQcnwdcpGB60Y6L/BAjwhHS.', 'Jalan Kudus', 'PPPoE CIAMPEL', '1'),
(87, 'Pelanggan', 'Pelanggan 95', 'pelanggan95', 'pelanggan95@email.com', '089595959595', '$2y$10$MBitZRf5MYGUE7FxO1T6W.L8IHoWHhYcvWjDXPfx7ETTFsOUZKLQy', 'Dago', 'PPPoE AbelNet', '1'),
(88, 'Pelanggan', 'Pelanggan 96', 'pelanggan96', 'pelanggan96@email.com', '089696969696', '$2y$10$GE0sGkPQIL.a38I/M1GNwOSCao8uw2AqBNG0twxwtJi8VCG7371oe', 'Dipatiukur', 'PPPoE AbelNet', '1'),
(89, 'Pelanggan', 'Pelanggan 97', 'pelanggan97', 'pelanggan97@email.com', '089797979797', '$2y$10$tlvw3R7SE4LrXOgD22.eHeDWZmWRufBPwBGA2MQ2KKcz3pc.i77UK', 'Buahbatu', 'PPPoE AbelNet', '1'),
(90, 'Pelanggan', 'Pelanggan 98', 'pelanggan98', 'pelanggan98@email.com', '089898989898', '$2y$10$5KQHq3GJblaNH4FZgOL64uRGzxyCuTGbtzoeDx3UPaGiy07bpKg0e', 'Ciamis', 'PPPoE AbelNet', '1'),
(91, 'Pelanggan', 'Pelanggan 99', 'pelanggan99', 'pelanggan99@email.com', '089999999999', '$2y$10$vTeI50jnpPDVUMvHl4N.fO8zhLD0ksGWK8lSExSkRlB0Z5GKVv152', 'Cihampelas', 'PPPoE AbelNet', '1'),
(92, 'Pelanggan', 'Pelanggan 100', 'pelanggan100', 'pelanggan100@email.com', '081001001001', '$2y$10$PyC0VAwJdu68zQpkr8Bht.H4Z755dxnUfzIa2PvHiTrDO6LkFnWdm', 'Coblong', 'PPPoE AbelNet', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pernyataan`
--

CREATE TABLE `t_pernyataan` (
  `id_pernyataan` int(11) NOT NULL,
  `id_kuesioner` int(11) NOT NULL,
  `pernyataan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `t_pernyataan`
--

INSERT INTO `t_pernyataan` (`id_pernyataan`, `id_kuesioner`, `pernyataan`) VALUES
(1, 1, 'Pernyataan 1'),
(2, 1, 'Pernyataan 2'),
(3, 1, 'Pernyataan 2');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  ADD PRIMARY KEY (`id_kuesioner`);

--
-- Indeks untuk tabel `t_lokasi_server`
--
ALTER TABLE `t_lokasi_server`
  ADD PRIMARY KEY (`id_lokasi_server`);

--
-- Indeks untuk tabel `t_pengguna`
--
ALTER TABLE `t_pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `id_role` (`role`);

--
-- Indeks untuk tabel `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  ADD PRIMARY KEY (`id_pernyataan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_kuesioner`
--
ALTER TABLE `t_kuesioner`
  MODIFY `id_kuesioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `t_lokasi_server`
--
ALTER TABLE `t_lokasi_server`
  MODIFY `id_lokasi_server` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `t_pengguna`
--
ALTER TABLE `t_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `t_pernyataan`
--
ALTER TABLE `t_pernyataan`
  MODIFY `id_pernyataan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
