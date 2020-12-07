-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2020 at 08:21 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `nama`, `email`, `password`) VALUES
(1, 'asu', 'robin@vanpersie.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama`) VALUES
(1, 'Komedi'),
(2, 'Horror');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `idkomentar` int(100) NOT NULL,
  `idpost` int(100) NOT NULL,
  `idpenulis` int(100) NOT NULL,
  `isi` varchar(1000) NOT NULL,
  `tgl_update` date NOT NULL,
  `email` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`idkomentar`, `idpost`, `idpenulis`, `isi`, `tgl_update`, `email`, `status`) VALUES
(2, 1, 0, 'su', '2020-10-24', 'andra.gws@gmail.com', 'unapprove'),
(3, 3, 0, 'aefae', '2020-10-24', 'gams@gmail.com', ''),
(4, 1, 1, 'afsf', '2020-10-24', 'robinvangamas@gmail.', ''),
(6, 1, 1, 'tes', '2020-10-25', 'robinvangamas@gmail.', 'approved'),
(7, 1, 0, 'qwe', '2020-10-25', 'asdad@com.com', 'approved'),
(8, 1, 0, 'fas', '2020-10-25', 'gams@gam.com', 'approved'),
(9, 4, 2, '123', '2020-10-25', 'adit@adit.com', 'approved'),
(10, 4, 0, 'werw', '2020-10-25', 'asdq@coasd', 'approved'),
(11, 4, 0, '123', '2020-10-25', 'a@a', 'approved'),
(12, 4, 0, '12312', '2020-10-25', 'aw@c', 'approved'),
(13, 4, 0, 'aaa', '2020-10-25', 'adit@a', 'approved'),
(14, 4, 0, 'asu', '2020-10-25', 'andra@ganteng', 'approved'),
(15, 4, 0, 'aaa', '2020-10-25', 'ghfq@aaa', 'approved'),
(16, 4, 0, 'qqq', '2020-10-25', 'tes@tes', 'approved'),
(17, 4, 0, 'TES', '2020-10-25', '', 'approved'),
(18, 4, 2, 'tes', '2020-10-25', 'adit@adit.com', 'approved'),
(19, 5, 3, 'halo', '2020-10-25', 'halo@bca.com', 'approved'),
(20, 5, 2, 'Halo2', '2020-10-25', 'adit@adit.com', 'unapprove'),
(21, 5, 3, 'tes', '2020-10-25', 'halo@bca.com', 'approved'),
(22, 3, 3, 'ets\r\n', '2020-10-25', 'halo@bca.com', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `idpenulis` int(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`idpenulis`, `nama`, `password`, `alamat`, `kota`, `email`, `no_telp`) VALUES
(1, 'adit asu', '123', 'Jl. 31', 'Airport West', 'robinvangamas@gmail.com', '085802513525'),
(2, 'adit', '123', 'adit memek', 'memek', 'adit@adit.com', '14045'),
(3, 'Halo', '123', 'Admin', 'Semarang', 'halo@bca.com', '021');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `idpost` int(100) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `idkategori` int(100) NOT NULL,
  `isi_post` varchar(1000) NOT NULL,
  `file_gambar` varchar(500) NOT NULL,
  `tgl_insert` date NOT NULL,
  `tgl_update` date NOT NULL,
  `idpenulis` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`idkomentar`),
  ADD KEY `idpost` (`idpost`),
  ADD KEY `idpenulis` (`idpenulis`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`idpenulis`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idpost`),
  ADD KEY `idkategori` (`idkategori`),
  ADD KEY `idpenulis` (`idpenulis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `idkomentar` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `idpenulis` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `idpost` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
