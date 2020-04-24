-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql310.epizy.com
-- Generation Time: Apr 23, 2020 at 04:26 PM
-- Server version: 5.6.45-86.1
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_24132456_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `gambar` varchar(64) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `jenis` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `gambar`, `nama`, `harga`, `stok`, `jenis`) VALUES
(21, '5d1bff65cb045.jpg', 'Brownies', 10000, 76, 'Makanan'),
(20, '5d1bff5418cc8.jpg', 'Intip', 5000, 80, 'Makanan'),
(18, '5d1bfec615d0b.png', 'Tempat Pensil', 10000, 0, 'Barang'),
(10, '5d1bfede4b526.jpg', 'Tas', 50000, 0, 'Barang'),
(11, '5d1bfeef1e3a1.jpg', 'Penghapus', 1500, 100, 'Barang'),
(12, '5d1bfefb6e800.jpg', 'Rautan Pensil', 500, 95, 'Barang'),
(13, '5d1bff0449743.jpg', 'Penggaris', 1000, 100, 'Barang'),
(19, '5d1bff41f38c2.jpg', 'Kaos Kaki ', 5000, 90, 'Barang'),
(17, '5d1bff754e21c.jpg', 'Pensil', 4000, 0, 'Barang'),
(23, '5d1bffa1b4655.jpg', 'Buku Tulis', 5000, 98, 'Barang'),
(24, '5d1bffb0e0eec.jpg', 'geraint', 0, 8, 'Barang');

-- --------------------------------------------------------

--
-- Table structure for table `formulir`
--

CREATE TABLE `formulir` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `noidentitas` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nohp` varchar(30) NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formulir`
--

INSERT INTO `formulir` (`id`, `gambar`, `nama`, `noidentitas`, `email`, `nohp`, `jk`) VALUES
(35, '5cc984be29c25.png', 'Admin', '17006912', 'greenrizky354@gmail.com', '088221018953', 'Laki-Laki'),
(45, '5cc98827ced6c.jpg', 'User', '1', '1@gmail.com', '1', 'Perempuan'),
(46, '5d1c16b9d286c.jpg', 'User Baru', '1111', '11@gmail.com', '082', 'Laki-Laki'),
(48, '5d1c00efb280c.jpg', 'Muh Rizki N', '17006912', 'greenrizky354@gmail.com', '08221018953', 'Laki-Laki'),
(50, '5d1c10111326f.jpg', 'Muh Rizki N', '17006912', 'greenrizky354@gmail.com', '08221018953', 'Laki-Laki'),
(49, '5d1c12cf81b0c.png', 'Torik Ganteng', '1234567890', 'ilham.arsyam@gmail.com', '0812345678', 'Laki-Laki');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `urut` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `gambar` varchar(250) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` int(11) NOT NULL,
  `banyak` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`urut`, `no`, `id`, `gambar`, `nama`, `harga`, `banyak`, `total`) VALUES
(27, 12, 45, '5c89967403287.jpg', 'Rautan Pensil', 500, 5, 50000),
(29, 5, 45, '5c8995585c3ca.png', 'Tempat Pensil', 10000, 10, 100000),
(39, 17, 46, '5d1bff754e21c.jpg', 'Pensil', 4000, 88, 352000),
(40, 10, 45, '5d1bfede4b526.jpg', 'Tas', 50000, 90, 4500000);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `status`) VALUES
(35, 'admin', '$2y$10$c4nQTqp.4/JV./GX9p2J0ufMOWuyi3c3TQOTa4fAMfS2uIRogxa9G', '1'),
(45, 'user', '$2y$10$UiqoJZ4HdNDg/W89LE3cF.qKh66aLsm6SV5RC.6sVvCGj6UUWyoEK', '0'),
(46, '1', '$2y$10$5/MkE6ZRubhZx3fHROCZbOtxVPckJ8merslbMtDRiLAUmD7FbT9kW', '0'),
(47, 'test', '$2y$10$J7QjzWIFU2vKhokuJUsnKuzi0lhZ3p8QqaO0Ed3lPUc87oBqBwtIO', '0'),
(48, 'rizki', '$2y$10$hnE4uy/rrVICdatB4baVl.jRc3Brp91GH6GmmWuNJfb6XnTMMliJ.', '0'),
(49, 'torik_ganteng', '$2y$10$odDvX7/BmIlKt75wrn0ve.Lzz19fkHr6Ma.yNOXtrr/O9g2B5nvuS', '0'),
(50, 'thoriq', '$2y$10$qfMj8rf6Uv9OsLDI1PUew..U14wSwTqmxjDijre2o6HihYME7M8lO', '0'),
(51, 'qwe', '$2y$10$YLj3tzGN6AYcvCUTYwPSW.PadTgAtiAbUH8rUgXo3Zb/lQv.pkbH6', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formulir`
--
ALTER TABLE `formulir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`urut`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `urut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
