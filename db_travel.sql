-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2020 at 06:08 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Budi Setiawan', 'budi', 'eea2c1e5e921bba51478fb8ff99fa077'),
(2, 'Susanti Nopel', 'sansusan', 'ac575e3eecf0fa410518c2d3a2e7209f');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cs`
--

CREATE TABLE `tb_cs` (
  `id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cs`
--

INSERT INTO `tb_cs` (`id`, `password`) VALUES
(1, '28aa1357d2e11f00ef1b563e1ad6d01a');

-- --------------------------------------------------------

--
-- Table structure for table `tb_liza`
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
-- Dumping data for table `tb_liza`
--

INSERT INTO `tb_liza` (`id`, `nomer`, `nama`, `alamat`, `jemput`, `tanggal`, `jam`, `tujuan`, `penumpang`, `lunas`, `harga_khusus`, `ket`, `status_print`, `mobil`) VALUES
(1, '0789579587957', 'Susan Putri Youw', 'Malang', 'Meikarta', '25-01-2020', '18:00', 'Surabaya', '3', '2', '2000', 'sss', 1, '. Mobil = jazz'),
(2, '0874879487498', 'Joko Widodo', 'Rajajowas 1', 'Rajajowas 2', '06-02-2020', '03:30', 'Rajajowas 3', '11', '2', '10000', 'xx, Generasi Bangsa, Marado', 1, '. Mobil = jazz'),
(3, '0879857598579', 'Marinka', 'Malang', 'Bandung', '09-02-2020', '20:19', 'Surabaya', '2', '1', '2', 'Juna, Jigang, Marado, amado', 1, '. Mobil = avia'),
(4, '0983739837938', 'Bella', 'Jambangan', 'Jombang', '26-01-2020', '03:09', 'Balkot', '25', '2', '800', 'e, Jigang, best, amado', 1, ''),
(5, '8794879487498', 'Acer', 'Predator', 'lima', '07-02-2020', '03:30', 'Malang', '200', '2', '90', 'Baru, Generasi Bangsa, best', 1, ''),
(6, '9809848748947', 'Tara aRtsssss', 'Kemayoran', 'Bandung', '22-02-2020', '19:00', 'Malang', '20', '1', '1000', 'Beautiful', 1, ''),
(9, '9012357912912', 'tonikin', 'kedawung city', '', '01-05-2020', '11:00', 'Carter', '3', '1', '10', 'asd', 0, ''),
(10, '9012357912912', 'hera', 'rhea', '', '22-02-2020', '03:02', 'Juanda', '4', '2', '-', 'asd', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siluet`
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
-- Dumping data for table `tb_siluet`
--

INSERT INTO `tb_siluet` (`id`, `nomer`, `nama`, `alamat`, `jemput`, `tanggal`, `jam`, `tujuan`, `penumpang`, `lunas`, `harga_khusus`, `ket`, `status_print`, `mobil`) VALUES
(1, '0789867697697', 'Sehat', 'Mana', '', '14-02-2020', '03:00', 'Surabaya Kota', '20', '1', 'Rp. 100.000', 'lorem ipsum dolor sit amet', 0, '. Mobil = asd'),
(2, '0870847084704', 'Nama', 'naratnab', '', '13-02-2020', '20:20', 'Juanda', '20', '1', '90', 'data2. Mobil = muse', 0, ''),
(3, '0878748479847', 'Nugroho Joyo', 'Meikarta', 'Singapura', '06-02-2020', '22:22', 'Amerika', '19', '1', '2000', 'data 3. Mobil = avanza', 1, ''),
(4, '0980298729822', 'Surya Adi', 'Malang', 'test', '24-01-2020', '09:20', 'Bandung', '2', '2', '9000', 'data4. Mobil = avanza', 1, ''),
(5, '09876543212', 'Alex', 'Malang', 'Jakarta', '02-02-2020', '03:02', 'Juanda', '6', '1', '2000', 'Hallo sai, jazz', 1, ''),
(8, '0789867697697', 'Sehat', 'Mana', 'rhea', '05-02-2020', '06:00', 'Surabaya Kota', '3', '2', '100', 'asd, jazz', 1, ''),
(9, '1029837902', 'tonikin', 'asdl;k', 'asdkl;', '01-01-2020', '00:00', 'Malang', '1', '1', '1', 'asd', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supervisor`
--

CREATE TABLE `tb_supervisor` (
  `id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_supervisor`
--

INSERT INTO `tb_supervisor` (`id`, `password`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_cs`
--
ALTER TABLE `tb_cs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_liza`
--
ALTER TABLE `tb_liza`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siluet`
--
ALTER TABLE `tb_siluet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_supervisor`
--
ALTER TABLE `tb_supervisor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_cs`
--
ALTER TABLE `tb_cs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_liza`
--
ALTER TABLE `tb_liza`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_siluet`
--
ALTER TABLE `tb_siluet`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_supervisor`
--
ALTER TABLE `tb_supervisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
