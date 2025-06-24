-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 12:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `air`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemakaian`
--

CREATE TABLE `pemakaian` (
  `no` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `meter_awal` mediumint(9) NOT NULL,
  `meter_akhir` mediumint(9) NOT NULL,
  `pemakaian` mediumint(9) NOT NULL,
  `kd_tarif` char(3) NOT NULL,
  `tagihan` mediumint(9) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemakaian`
--

INSERT INTO `pemakaian` (`no`, `username`, `meter_awal`, `meter_akhir`, `pemakaian`, `kd_tarif`, `tagihan`, `tanggal`, `waktu`, `status`) VALUES
(11, 'warga10', 10, 17, 7, '', 0, '2025-05-11', '23:59:47', 'BLM LUNAS'),
(12, 'warga9', 10, 11, 1, '', 12000, '2025-05-28', '08:27:10', 'BLM LUNAS'),
(13, 'warga9', 20, 40, 20, 'T1', 240000, '2025-04-12', '14:29:11', 'BLM LUNAS'),
(17, 'warga0', 1, 3, 2, 'T1', 24000, '2025-04-13', '15:35:12', 'BLM LUNAS'),
(18, 'warga0', 10, 21, 11, 'T1', 132000, '2025-05-28', '08:45:41', 'BLM LUNAS'),
(19, 'warga0', 10, 13, 3, 'T1', 36000, '2025-05-28', '08:34:34', 'BLM LUNAS'),
(21, 'warga9', 12, 40, 20, 'T1', 240000, '2025-03-12', '14:29:11', 'BLM LUNAS'),
(22, 'aku', 0, 16, 16, 'T1', 192000, '2025-06-24', '16:46:19', 'BLM LUNAS'),
(23, 'aku', 0, 13, 13, 'T1', 156000, '2025-06-24', '16:54:26', 'LUNAS'),
(24, 'warga10', 2, 10, 8, 't2', 136000, '2025-06-24', '17:04:33', 'BLM LUNAS');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `kd_tarif` char(3) NOT NULL,
  `tarif` mediumint(9) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`kd_tarif`, `tarif`, `tipe`, `status`) VALUES
('T1', 12000, 'RT', 'AKTIF'),
('t2', 17000, 'Kos', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `alamat`, `kota`, `telephone`, `level`, `tipe`, `status`) VALUES
('admin', '$2y$10$b8s7S0UPlmNjK5K1n5a1JORQAZdvm4vsLV35gWv/P0tklQH/DjhTC', 'Admin Web', 'Polines', 'Semarang', '02411', 'admin', '-', 'AKTIF'),
('admin2', '$2y$10$pPtHie.G1psmc7O/Ep9J2OY8m99xyep28wfyVymhYBvWZgWGeaRgi', 'Admin Web', 'lagiihh', 'Semarang', '0241112', 'admin', 'RT', 'AKTIF'),
('admin3', '$2y$10$6ULcc6u3gj4zY5hQwCUz2.Gx5rzXLiv1AQsEBOPbvc.MyoqzuM8B2', 'saya', 'banyumanik', 'semarang', '32123929', 'admin', 'kos', 'AKTIF'),
('aku', '$2y$10$99P549gd1F8KrHSe5sViyO6bnB7hL5QWLurbIyGBRA5C3MH0rqsoq', 'ramdhan', 'sana', 'Semarang', '082131', 'warga', 'RT', 'AKTIF'),
('bendahara', '$2y$10$HCzt94.nBqe.0.SGUl36Iu98od2ovDYPkOk4BH8.3vPcuF2ST4XOa', 'bendahara air', 'Polines', 'Semarang', '024111', 'bendahara', '-', 'aktif'),
('petugas', '$2y$10$k/PbTpBTeQlo9kvRynWlIOQo27xHjz93q9ryrExKWJsF16T2nvSsu', 'petugas air', 'Polines', 'Semarang', '024111', 'petugas', '-', 'aktif'),
('warga', '$2y$10$D901ex2D4j06Bza3bVCXwunOle0d3TUuVMv9rgZEFYwzeE2MdXZu2', 'warga air', 'Polines', 'Semarang', '024111', 'warga', '-', 'aktif'),
('warga10', '$2y$10$wQ7RAqPxZlV6l63G7MWLjuXwM110Lhh2As0oH1Gz4mIkPzxClshWm', 'warga indo', 'jl. jalan', 'tegal', '0889237483', 'warga', 'Kos', 'AKTIF'),
('warga9', '$2y$10$mx4AW/Yk5lF149v./egu4uwtQpd4JV9S0kXzrXGtLOScvUvgH1JJe', 'warga9', 'banymanik', 'semarang', '088827394', 'warga', 'RT', 'AKTIF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pemakaian`
--
ALTER TABLE `pemakaian`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`kd_tarif`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemakaian`
--
ALTER TABLE `pemakaian`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
