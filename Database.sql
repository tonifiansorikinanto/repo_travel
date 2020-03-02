-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Mar 2020 pada 18.56
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
(1, '0789579587957', 'Susan Putri Youw', 'Malang', 'Meikarta', '25-01-2020', '18:00', 'Surabaya', '3', '2', '2000', 'sss, Isa BInova', 0, ''),
(2, '0874879487498', 'Joko Widodo', 'Rajajowas 1', 'Rajajowas 2', '06-02-2020', '03:30', 'Rajajowas 1', '11', '1', '10000', 'xx, GeneraMobilSMK', 0, ''),
(3, '0879857598579', 'Marinka Chef', 'Malang', 'Bandung', '09-02-2020', '20:19', 'Surabaya', '21', '1', '2000', 'Juna, Jigang, Marado, amado', 1, ''),
(4, '0983739837938', 'Bella', 'Jambangan', 'Jombang', '26-01-2020', '03:09', 'Balkot', '25', '2', '800', 'e, Jigang, best, amado, as, ax, ll', 1, ''),
(5, '8794879487498', 'Acer', 'Predator', 'lima', '07-02-2020', '03:30', 'Malang', '200', '2', '90', 'Baru, Generasi Bangsa, best, as, ax, ll', 1, ''),
(6, '9809848748947', 'Tara aRtsssss', 'Kemayoran', 'Bandung', '22-02-2020', '19:00', 'Malang', '20', '1', '1000', 'Beautiful, Mobil = Xenia', 1, ''),
(8, '0738739879837', 'Susanto', 'Bandung', 'Malang', '13-02-2020', '23:00', 'Kemayoran', '2', '2', '1000', 'Masuk, IsaMobilSMK', 1, ''),
(9, '0875746673537', 'Abah Husein', 'Mojokerto', 'Mojosari', '19-02-2020', '18:00', 'Malang', '2', '2', '222', 'Budal', 0, ''),
(10, '0886476487628', 'Legiana', 'Astera', 'Astera', '22-02-2020', '20:00', 'Ancient Forest', '1', '1', '2000', 'Hunting', 0, ''),
(11, '0898398767836', 'Uzumaki Mito', 'Bandung Monas', 'Monas Raya', '26-02-2020', '18:00', 'Malang', '6', '1', '8000', 'Liburan', 0, ''),
(12, '0898398767836', 'Uzumaki Mito', 'Bandung Monas', 'Monas Raya', '26-02-2020', '18:00', 'Malang', '6', '1', '8000', 'Liburan', 0, ''),
(13, '0898398767836', 'Uzumaki Mito', 'Bandung Monas', 'Monas Raya', '26-02-2020', '18:00', 'Malang', '6', '1', '8000', 'Liburan', 0, ''),
(14, '0898398767836', 'Uzumaki Mito', 'Bandung Monas', 'Monas Raya', '26-02-2020', '18:00', 'Malang', '6', '1', '8000', 'Liburan', 0, ''),
(15, '0898398767836', 'Uzumaki Mito', 'Bandung Monas', 'Monas Raya', '26-02-2020', '18:00', 'Malang', '6', '1', '8000', 'Liburan', 0, ''),
(16, '0898398767836', 'Uzumaki Mito', 'Bandung Monas', 'Monas Raya', '26-02-2020', '18:00', 'Malang', '6', '1', '8000', 'Liburan', 0, ''),
(17, '0978397387398', 'Anya Geraldine', 'Surabaya', 'Surabaya Menggok Kanan', '26-02-2020', '08:00', 'Surabaya Kota', '1', '2', '5000', 'Libur\r\n', 0, '');

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
(2, 'Xenia', 3, 0, 'S 4SH14P EA');

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
(18, '0988976378638', 'Nurgacuga', 'Aestera', 'Aestera', '26-02-2020', '12:02', 'Surabaya Kota', '2', '1', '5000', 'Hunting', 0, ''),
(19, '0988976378638', 'Nurgacuga', 'Aestera', 'Aestera', '26-02-2020', '12:02', 'Surabaya Kota', '2', '1', '5000', 'Hunting', 0, ''),
(20, '0978946494864', 'Anjaynath', 'Ancient Forest', 'Ancient Forest', '25-02-2020', '18:00', 'Malang', '1', '1', '8000', 'Guarrr', 0, '');

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
-- AUTO_INCREMENT untuk tabel `tb_jadwal_siluet`
--
ALTER TABLE `tb_jadwal_siluet`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_liza`
--
ALTER TABLE `tb_liza`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_mobil_liza`
--
ALTER TABLE `tb_mobil_liza`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
