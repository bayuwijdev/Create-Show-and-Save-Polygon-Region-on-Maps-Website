-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2016 at 07:15 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cobaregionmaps`
--

-- --------------------------------------------------------

--
-- Table structure for table `kartu_rfid_anggota`
--

CREATE TABLE `kartu_rfid_anggota` (
  `nomor_rfid_anggota` varchar(11) NOT NULL,
  `kode_anggota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kartu_rfid_anggota`
--

INSERT INTO `kartu_rfid_anggota` (`nomor_rfid_anggota`, `kode_anggota`) VALUES
('12345678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lahan_petani`
--

CREATE TABLE `lahan_petani` (
  `kode_lahan` int(11) NOT NULL,
  `nomor_rfid_anggota` varchar(11) NOT NULL,
  `points` text NOT NULL,
  `luas_lahan` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lahan_petani`
--

INSERT INTO `lahan_petani` (`kode_lahan`, `nomor_rfid_anggota`, `points`, `luas_lahan`) VALUES
(1, '12345678', '(-7.307984780163877, 107.65640258789062)(-7.311390105672049, 107.67871856689453)(-7.295725393504036, 107.67253875732422)(-7.297087564171992, 107.66395568847656)', 13.45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kartu_rfid_anggota`
--
ALTER TABLE `kartu_rfid_anggota`
  ADD PRIMARY KEY (`nomor_rfid_anggota`);

--
-- Indexes for table `lahan_petani`
--
ALTER TABLE `lahan_petani`
  ADD PRIMARY KEY (`kode_lahan`),
  ADD KEY `nomor_rfid_anggota` (`nomor_rfid_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lahan_petani`
--
ALTER TABLE `lahan_petani`
  MODIFY `kode_lahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lahan_petani`
--
ALTER TABLE `lahan_petani`
  ADD CONSTRAINT `lahan_petani_ibfk_1` FOREIGN KEY (`nomor_rfid_anggota`) REFERENCES `kartu_rfid_anggota` (`nomor_rfid_anggota`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
