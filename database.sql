-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2020 pada 22.26
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
-- Struktur dari tabel `tb_cs`
--

CREATE TABLE `tb_cs` (
  `id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_cs`
--

INSERT INTO `tb_cs` (`id`, `password`) VALUES
(1, '28aa1357d2e11f00ef1b563e1ad6d01a');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal_liza`
--

CREATE TABLE `tb_jadwal_liza` (
  `id_jadwal` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `seat_use` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jadwal_liza`
--

INSERT INTO `tb_jadwal_liza` (`id_jadwal`, `tanggal`, `jam`, `id_mobil`, `seat_use`) VALUES
(1, '2020-03-02', '18:00', 2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal_siluet`
--

CREATE TABLE `tb_jadwal_siluet` (
  `id_jadwal` int(11) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `jam` varchar(50) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `seat_use` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_jadwal_siluet`
--

INSERT INTO `tb_jadwal_siluet` (`id_jadwal`, `tanggal`, `jam`, `id_mobil`, `seat_use`) VALUES
(1, '2020-03-02', '18:00', 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_liza`
--

CREATE TABLE `tb_liza` (
  `id` int(5) NOT NULL,
  `nomer` varchar(13) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jemput` varchar(50) NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `jam` varchar(5) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `penumpang` varchar(3) NOT NULL,
  `lunas` varchar(1) NOT NULL,
  `harga_khusus` varchar(50) NOT NULL,
  `ket` varchar(500) NOT NULL,
  `status_print` int(1) NOT NULL,
  `mobil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_liza`
--

INSERT INTO `tb_liza` (`id`, `nomer`, `nama`, `alamat`, `jemput`, `tanggal`, `jam`, `tujuan`, `penumpang`, `lunas`, `harga_khusus`, `ket`, `status_print`, `mobil`) VALUES
(18, '0989757569758', 'Mario', 'Malang', 'Malang Raya', '2020-03-04', '18:00', 'Surabaya Kota', '2', '1', '1000', 'Masuk', 0, ''),
(19, '0989757569758', 'Mario', 'Malang', 'Malang Raya', '2020-03-04', '18:00', 'Surabaya Kota', '2', '1', '1000', 'Masuk', 0, ''),
(20, '0865754685367', 'Luigi', 'Jakarta', 'Jakarta', '2020-03-06', '13:00', 'Malang', '1', '1', '5000', 'Liburr', 0, ''),
(21, '0896746874684', 'Maikel', 'Sidoarjo', 'Sidoarjo', '2020-02-05', '15:00', 'Juanda', '1', '2', '1000', 'Budal', 0, ''),
(22, '0896474684683', 'Yosep', 'Bandung', 'Bandung Raya Plaza', '2020-03-04', '09:00', 'Surabaya Kota', '1', '1', '5000', 'Masuk pak', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mobil_liza`
--

CREATE TABLE `tb_mobil_liza` (
  `id_mobil` int(11) NOT NULL,
  `mobil` varchar(50) NOT NULL,
  `penumpang` int(3) NOT NULL,
  `status` int(1) NOT NULL,
  `plat_nomor` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_mobil_liza`
--

INSERT INTO `tb_mobil_liza` (`id_mobil`, `mobil`, `penumpang`, `status`, `plat_nomor`) VALUES
(1, 'Avanza', 3, 0, 'M J0K022 ME'),
(2, 'Xenia', 3, 0, 'S 4SH14P EA'),
(3, 'Mercedes', 3, 0, 'S 4SSUDE !A'),
(4, 'Hijet 1000', 1, 0, 'X MA40A 12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_mobil_siluet`
--

CREATE TABLE `tb_mobil_siluet` (
  `id_mobil` int(11) NOT NULL,
  `mobil` varchar(50) NOT NULL,
  `penumpang` int(3) NOT NULL,
  `status` int(1) NOT NULL,
  `plat_nomor` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_mobil_siluet`
--

INSERT INTO `tb_mobil_siluet` (`id_mobil`, `mobil`, `penumpang`, `status`, `plat_nomor`) VALUES
(1, 'Avanza', 1, 0, 'M J0K022 ME'),
(4, 'Daihatsu', 3, 0, 'N 6969 CB'),
(6, 'Hijet 1000', 5, 0, 'N WOJ123 AS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siluet`
--

CREATE TABLE `tb_siluet` (
  `id` int(5) NOT NULL,
  `nomer` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jemput` varchar(50) NOT NULL,
  `tanggal` varchar(10) NOT NULL,
  `jam` varchar(5) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `penumpang` varchar(3) NOT NULL,
  `lunas` varchar(1) NOT NULL,
  `harga_khusus` varchar(50) NOT NULL,
  `ket` varchar(500) NOT NULL,
  `status_print` int(1) NOT NULL,
  `mobil` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_siluet`
--

INSERT INTO `tb_siluet` (`id`, `nomer`, `nama`, `alamat`, `jemput`, `tanggal`, `jam`, `tujuan`, `penumpang`, `lunas`, `harga_khusus`, `ket`, `status_print`, `mobil`) VALUES
(18, '0988976378638', 'Nurgacuga', 'Aestera', 'Aestera', '2020-02-26', '12:02', 'Surabaya Kota', '2', '1', '5000', 'Hunting', 0, ''),
(19, '0988976378638', 'Nurgacuga', 'Aestera', 'Aestera', '2020-02-26', '12:02', 'Surabaya Kota', '2', '1', '5000', 'Hunting', 0, ''),
(20, '0978946494864', 'Anjaynath', 'Ancient Forest', 'Ancient Forest', '2020-02-25', '18:00', 'Malang', '1', '1', '8000', 'Guarrr', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supervisor`
--

CREATE TABLE `tb_supervisor` (
  `id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_supervisor`
--

INSERT INTO `tb_supervisor` (`id`, `password`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_cs`
--
ALTER TABLE `tb_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_jadwal_liza`
--
ALTER TABLE `tb_jadwal_liza`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `tb_jadwal_siluet`
--
ALTER TABLE `tb_jadwal_siluet`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `tb_liza`
--
ALTER TABLE `tb_liza`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_mobil_liza`
--
ALTER TABLE `tb_mobil_liza`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `tb_mobil_siluet`
--
ALTER TABLE `tb_mobil_siluet`
  ADD PRIMARY KEY (`id_mobil`);

--
-- Indeks untuk tabel `tb_siluet`
--
ALTER TABLE `tb_siluet`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_supervisor`
--
ALTER TABLE `tb_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_cs`
--
ALTER TABLE `tb_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_liza`
--
ALTER TABLE `tb_jadwal_liza`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_siluet`
--
ALTER TABLE `tb_jadwal_siluet`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_liza`
--
ALTER TABLE `tb_liza`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_mobil_liza`
--
ALTER TABLE `tb_mobil_liza`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_mobil_siluet`
--
ALTER TABLE `tb_mobil_siluet`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_siluet`
--
ALTER TABLE `tb_siluet`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_supervisor`
--
ALTER TABLE `tb_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
