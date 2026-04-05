-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2026 at 03:44 AM
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
-- Database: `db_pwd2025`
--
CREATE DATABASE IF NOT EXISTS `db_pwd2025` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_pwd2025`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biomhs`
--

CREATE TABLE `tbl_biomhs` (
  `bid` int NOT NULL,
  `bnim` varchar(10) DEFAULT NULL,
  `bnmlengkap` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `btmptlhr` varchar(100) DEFAULT NULL,
  `btgllhr` varchar(50) DEFAULT NULL,
  `bhobi` varchar(100) DEFAULT NULL,
  `bpasangan` varchar(100) DEFAULT NULL,
  `bpekerjaan` varchar(100) DEFAULT NULL,
  `bnmortu` varchar(100) DEFAULT NULL,
  `bnmkakak` varchar(100) DEFAULT NULL,
  `bnmadik` varchar(100) DEFAULT NULL,
  `dcreated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_biomhs`
--

INSERT INTO `tbl_biomhs` (`bid`, `bnim`, `bnmlengkap`, `btmptlhr`, `btgllhr`, `bhobi`, `bpasangan`, `bpekerjaan`, `bnmortu`, `bnmkakak`, `bnmadik`, `dcreated_at`) VALUES
(7, '2511500012', 'Leonard Kevin Fernando', 'Sungailiat', '11 Opet 2029', 'Ngebucin', 'Livia', 'Mahasiswa', 'Ga tau Mikir Kidz', '-', '-', '2026-01-07 15:05:02'),
(8, '2511500007', 'Jeffrey Deryata', 'Sungailiat', '30 April 2007', 'Aviasi, Gaming, Music', 'Ga punya', 'Mahasiswa', 'Nama', '-', '-', '2026-01-07 15:07:19'),
(9, '2511500001', 'Richie Christian', 'Pangkal Pinang', 'Dktau', 'Poke maen ml', 'SadBoy', 'Mahasiswa', '-', '-', '-', '2026-01-07 20:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tamu`
--

CREATE TABLE `tbl_tamu` (
  `cid` int NOT NULL,
  `cnama` varchar(100) DEFAULT NULL,
  `cemail` varchar(100) DEFAULT NULL,
  `cpesan` text,
  `dcreated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_tamu`
--

INSERT INTO `tbl_tamu` (`cid`, `cnama`, `cemail`, `cpesan`, `dcreated_at`) VALUES
(17, 'Richie Christian', 'RichiePoke@gmail.com', 'Richie kebelet punye cewe', '2025-12-24 12:13:41'),
(18, 'Richie Christian', 'RichiePoke@gmail.com', 'Richie ngp k gay', '2025-12-24 12:14:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_biomhs`
--
ALTER TABLE `tbl_biomhs`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  ADD PRIMARY KEY (`cid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_biomhs`
--
ALTER TABLE `tbl_biomhs`
  MODIFY `bid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_tamu`
--
ALTER TABLE `tbl_tamu`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Database: `db_pwdbio2026`
--
CREATE DATABASE IF NOT EXISTS `db_pwdbio2026` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_pwdbio2026`;
--
-- Database: `jadwalguru`
--
CREATE DATABASE IF NOT EXISTS `jadwalguru` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `jadwalguru`;

-- --------------------------------------------------------

--
-- Table structure for table `tabelmapel`
--

CREATE TABLE `tabelmapel` (
  `Kd_mapel` varchar(5) NOT NULL,
  `Nm_mapel` varchar(35) DEFAULT NULL,
  `KKM` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_admin`
--

CREATE TABLE `tabel_admin` (
  `Id_admin` int NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Nama_lengkap` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_admin`
--

INSERT INTO `tabel_admin` (`Id_admin`, `Username`, `Nama_lengkap`, `Password`) VALUES
(1, 'Jeffrey Deryata', 'admin', '12345'),
(1, 'Jeffrey Deryata', 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_guru`
--

CREATE TABLE `tabel_guru` (
  `Kd_guru` varchar(5) NOT NULL,
  `Id_user` int DEFAULT NULL,
  `Nm_guru` varchar(50) DEFAULT NULL,
  `Jenkel` varchar(10) DEFAULT NULL,
  `Pend_terakhir` varchar(20) DEFAULT NULL,
  `Hp` int DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id_user` int NOT NULL,
  `Username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Role` enum('Admin','Guru','Siswa') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id_user`, `Username`, `Password`, `Role`) VALUES
(1, 'Jeffrey Deryata', 'admin', 'Admin'),
(3, 'Widiya Serena', '12345', 'Guru'),
(4, 'Richie Christian', '12345', 'Siswa'),
(5, 'admin', 'admin', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabelmapel`
--
ALTER TABLE `tabelmapel`
  ADD PRIMARY KEY (`Kd_mapel`);

--
-- Indexes for table `tabel_guru`
--
ALTER TABLE `tabel_guru`
  ADD PRIMARY KEY (`Kd_guru`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Database: `kuliah`
--
CREATE DATABASE IF NOT EXISTS `kuliah` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `kuliah`;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mhs`
--

CREATE TABLE `tabel_mhs` (
  `NIM` char(12) NOT NULL,
  `NAMA` varchar(100) NOT NULL,
  `ALAMAT` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mhs`
--

INSERT INTO `tabel_mhs` (`NIM`, `NAMA`, `ALAMAT`) VALUES
('311500012', 'AHMAD', 'JAKARTA'),
('311500045', 'ANI', 'JAKARTA'),
('322500023', 'RINA', 'CILEDUNG');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kuliah`
--

CREATE TABLE `tbl_kuliah` (
  `NIM` char(12) DEFAULT NULL,
  `KODE` varchar(100) NOT NULL,
  `KEL` varchar(6) NOT NULL,
  `NILAI` char(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_kuliah`
--

INSERT INTO `tbl_kuliah` (`NIM`, `KODE`, `KEL`, `NILAI`) VALUES
(NULL, 'KP124', 'AA', '80'),
(NULL, 'KP124', 'AA', '50'),
(NULL, 'KP125', 'AB', '60');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mhs`
--
ALTER TABLE `tabel_mhs`
  ADD PRIMARY KEY (`NIM`);

--
-- Indexes for table `tbl_kuliah`
--
ALTER TABLE `tbl_kuliah`
  ADD KEY `NIM` (`NIM`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_kuliah`
--
ALTER TABLE `tbl_kuliah`
  ADD CONSTRAINT `tbl_kuliah_ibfk_1` FOREIGN KEY (`NIM`) REFERENCES `tabel_mhs` (`NIM`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `test`;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM_MHS` char(12) NOT NULL,
  `NM_MHS` varchar(100) NOT NULL,
  `SEMESTER` char(2) NOT NULL,
  `JURUSAN` varchar(6) NOT NULL,
  `JADWAL` varchar(6) DEFAULT NULL,
  `KELAS` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM_MHS`, `NM_MHS`, `SEMESTER`, `JURUSAN`, `JADWAL`, `KELAS`) VALUES
('2511500001', 'RICHIE', '1', 'TI', 'PAGI', 'TI1A'),
('2511500007', 'JEFFREY', '1', 'TI', 'PAGI', 'TI1A'),
('2511500012', 'KEPIN', '1', 'TI', 'MALAM', 'TI1B');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM_MHS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
