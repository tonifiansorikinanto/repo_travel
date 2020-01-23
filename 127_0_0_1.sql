-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jan 2020 pada 05.40
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_magi`
--
CREATE DATABASE IF NOT EXISTS `db_magi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_magi`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'admin', 'developermagi', 'de3efa7d77c00d7ed710ff0bc353304b');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesan_custom`
--

CREATE TABLE `tb_pesan_custom` (
  `id_pesan` varchar(10) NOT NULL,
  `nomer` varchar(13) NOT NULL,
  `konten` varchar(50) NOT NULL,
  `tema` varchar(25) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `halaman` varchar(2) NOT NULL,
  `durasi` varchar(2) NOT NULL,
  `hal_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesan_dinamis`
--

CREATE TABLE `tb_pesan_dinamis` (
  `id_pesan` varchar(10) NOT NULL,
  `nomer` varchar(13) NOT NULL,
  `konten` varchar(50) NOT NULL,
  `tema` varchar(25) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `halaman` varchar(2) NOT NULL,
  `durasi` varchar(2) NOT NULL,
  `hal_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pesan_statis`
--

CREATE TABLE `tb_pesan_statis` (
  `id_pesan` varchar(10) NOT NULL,
  `nomer` varchar(13) NOT NULL,
  `konten` varchar(50) NOT NULL,
  `tema` varchar(25) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `halaman` varchar(2) NOT NULL,
  `durasi` varchar(2) NOT NULL,
  `hal_admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pesan_custom`
--
ALTER TABLE `tb_pesan_custom`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `tb_pesan_dinamis`
--
ALTER TABLE `tb_pesan_dinamis`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `tb_pesan_statis`
--
ALTER TABLE `tb_pesan_statis`
  ADD PRIMARY KEY (`id_pesan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Database: `db_travel`
--
CREATE DATABASE IF NOT EXISTS `db_travel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_travel`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Budi Setiawan', 'budi', 'eea2c1e5e921bba51478fb8ff99fa077'),
(2, 'Susanti Nopel', 'sansusan', 'ac575e3eecf0fa410518c2d3a2e7209f');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_liza`
--

CREATE TABLE `tb_liza` (
  `nomer` varchar(13) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `jam` varchar(5) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `lunas` varchar(1) NOT NULL,
  `harga_khusus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_liza`
--

INSERT INTO `tb_liza` (`nomer`, `nama`, `alamat`, `tanggal`, `jam`, `tujuan`, `lunas`, `harga_khusus`) VALUES
('0708794869369', 'Sumandeng', 'Boyolali', '2020-01-02', '15:00', 'Bunul', '1', '5000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siluet`
--

CREATE TABLE `tb_siluet` (
  `nomer` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `jam` varchar(5) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `lunas` varchar(1) NOT NULL,
  `harga_khusus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_siluet`
--

INSERT INTO `tb_siluet` (`nomer`, `nama`, `alamat`, `tanggal`, `jam`, `tujuan`, `lunas`, `harga_khusus`) VALUES
('0875987987987', 'Sugeng', 'Monas Jaya', '2020-01-09', '15:00', 'Meikarta', '1', '5000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_liza`
--
ALTER TABLE `tb_liza`
  ADD PRIMARY KEY (`nomer`);

--
-- Indeks untuk tabel `tb_siluet`
--
ALTER TABLE `tb_siluet`
  ADD PRIMARY KEY (`nomer`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
