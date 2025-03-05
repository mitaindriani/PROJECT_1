-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 05, 2025 at 04:08 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apk2`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_jadwal`
--

CREATE TABLE `master_jadwal` (
  `hari` varchar(20) NOT NULL,
  `jam_masuk` datetime DEFAULT NULL,
  `jam_pulang` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `master_jadwal`
--

INSERT INTO `master_jadwal` (`hari`, `jam_masuk`, `jam_pulang`) VALUES
('Friday', '2025-02-25 14:58:00', '2025-02-25 14:58:00'),
('Monday', '2025-02-25 15:07:00', '2025-02-25 15:07:00'),
('Thursday', '2025-02-25 14:55:00', '2025-02-25 14:55:00'),
('Tuesday', '2025-02-25 14:00:00', '2025-02-25 19:21:00'),
('Wednesday', '2025-02-26 14:25:00', '2025-02-26 14:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` enum('X','XI','XII') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jurusan` enum('RPL','TKJ','TKR','TBSM','TEI') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_absen`
--

INSERT INTO `tb_absen` (`id`, `nama`, `kelas`, `jurusan`, `tanggal_waktu`, `foto`, `keterangan`, `status`) VALUES
(26, 'andik', 'XI', 'TKJ', '2025-02-25 13:15:12', 'Screenshot 2024-02-18 160924.png', 'masuk', 'sakit'),
(29, 'a', 'XII', 'TKR', '2025-02-25 13:46:47', 'Screenshot 2025-01-15 141531.png', 'masuk', 'sakit'),
(30, 'a', 'XI', 'RPL', '2025-02-25 15:52:21', 'Screenshot 2025-01-14 144059.png', 'masuk', 'sakit'),
(31, 'a', 'XI', 'TKR', '2025-02-26 08:19:55', 'Screenshot 2025-01-16 151942.png', 'izin', 'sakit');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id` int NOT NULL,
  `id_guru` varchar(225) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `tanggal_waktu` datetime NOT NULL,
  `foto` varchar(225) NOT NULL,
  `keterangan` enum('masuk','izin','sakit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id`, `id_guru`, `nama`, `tanggal_waktu`, `foto`, `keterangan`) VALUES
(11, '666', 'a', '2025-01-23 00:00:00', 'rose.jpg', 'masuk'),
(12, '666', 'a', '2025-01-23 00:00:00', 'Snaptik.app_72925828940846072382.jpg', 'masuk'),
(15, '666', 'a', '2025-01-24 00:00:00', '8c52bcb0096e3fa6b0d17a93c239da48.jpg', 'masuk'),
(17, '666', 'a', '2025-02-03 00:00:00', 'tiktok.png', 'masuk'),
(21, '666', 'a', '2025-02-07 00:00:00', '5eff6c25d920f6a78fda288e6589bf8b.jpg', 'sakit'),
(24, '0008765', 'lol', '2025-02-10 00:00:00', 'Screenshot 2025-01-21 140725.png', 'izin'),
(25, '0008765', 'mita', '2025-02-18 09:08:31', 'WIN_20231215_18_45_30_Pro.jpg', 'sakit');

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru2`
--

CREATE TABLE `tb_guru2` (
  `id` int NOT NULL,
  `id_guru` varchar(225) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `tanggal_waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_guru2`
--

INSERT INTO `tb_guru2` (`id`, `id_guru`, `nama`, `tanggal_waktu`) VALUES
(2, 'hgjyy', 'mita', '2025-01-23 00:00:00'),
(3, '0008765', 'asad', '2025-01-23 00:00:00'),
(5, '666', 'fara', '2025-01-23 00:00:00'),
(6, '12345', 'tomen', '2025-01-24 00:00:00'),
(7, '0008765', 'andik', '2025-02-18 09:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_login`
--

CREATE TABLE `tb_login` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_login`
--

INSERT INTO `tb_login` (`id`, `username`, `password`) VALUES
(1, 'mita', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pulang`
--

CREATE TABLE `tb_pulang` (
  `id` int NOT NULL,
  `nama` varchar(225) NOT NULL,
  `kelas` enum('X','XI','XII') NOT NULL,
  `jurusan` enum('RPL','TKJ','TKR','TBSM','TEI') NOT NULL,
  `tanggal_waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pulang`
--

INSERT INTO `tb_pulang` (`id`, `nama`, `kelas`, `jurusan`, `tanggal_waktu`) VALUES
(2, 'andik', 'XII', 'RPL', '2025-01-14 00:00:00'),
(4, 'mita', 'XI', 'RPL', '2025-01-14 00:00:00'),
(5, 'fara', 'X', 'TBSM', '2025-01-14 00:00:00'),
(6, 'a', 'X', 'RPL', '2025-01-17 00:00:00'),
(7, 'fara', 'XI', 'RPL', '2025-01-17 00:00:00'),
(8, 'andik', 'X', 'TBSM', '2025-01-22 00:00:00'),
(9, 'mita', 'X', 'TBSM', '2025-01-22 00:00:00'),
(11, 'mita', 'XI', 'RPL', '2025-01-23 00:00:00'),
(12, 'bagos', 'XII', 'TBSM', '2025-01-24 00:00:00'),
(13, 'andik', 'XI', 'TKJ', '2025-02-07 00:00:00'),
(14, 'laaaaaaaaaaaaaaaaaaaaaa', 'XI', 'TEI', '2025-02-07 00:00:00'),
(15, 'k', 'X', 'TKJ', '2025-02-07 00:00:00'),
(16, 'm', 'X', 'TBSM', '2025-02-07 00:00:00'),
(17, 'lol', 'XII', 'TKR', '2025-02-07 00:00:00'),
(18, 'andik', 'XI', 'TKJ', '2025-02-07 00:00:00'),
(19, 'asad', 'X', 'TKJ', '2025-02-07 00:00:00'),
(20, 'andik', 'XI', 'TKJ', '2025-02-07 00:00:00'),
(21, 'andik', 'XI', 'TKR', '2025-02-07 00:00:00'),
(23, 'mita', 'XI', 'TKJ', '2025-02-07 00:00:00'),
(24, 'mita', 'X', 'TKJ', '2025-02-07 00:00:00'),
(25, 'kikiii', 'X', 'RPL', '2025-02-07 00:00:00'),
(26, 'mita', 'XI', 'RPL', '2025-02-18 09:08:59'),
(27, 'mita', 'XI', 'TKJ', '2025-02-18 11:44:08'),
(28, 'andik', 'XI', 'TKJ', '2025-02-20 14:30:25'),
(29, 'mita', 'X', 'TKJ', '2025-02-20 14:32:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_jadwal`
--
ALTER TABLE `master_jadwal`
  ADD PRIMARY KEY (`hari`);

--
-- Indexes for table `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_guru2`
--
ALTER TABLE `tb_guru2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_login`
--
ALTER TABLE `tb_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_pulang`
--
ALTER TABLE `tb_pulang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_guru2`
--
ALTER TABLE `tb_guru2`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_login`
--
ALTER TABLE `tb_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_pulang`
--
ALTER TABLE `tb_pulang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
