-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2020 at 10:52 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cctv_installation`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `id` int(11) NOT NULL,
  `id_survei` int(11) NOT NULL,
  `id_installasi` int(11) NOT NULL,
  `bahan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`id`, `id_survei`, `id_installasi`, `bahan`, `jumlah`, `satuan`) VALUES
(1, 1, 1, 'CCTV', 50, 'pcs'),
(2, 1, 1, 'Kabel LAN', 10, 'Meter'),
(3, 1, 1, 'Monitor 24 Inc', 2, 'pcs'),
(4, 2, 2, 'Kabel', 10, ' Meter');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `type` enum('Survei','Installasi') NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `type`, `name`) VALUES
(1, 'Survei', '2020-01-14(02-28-39pm)'),
(2, 'Survei', '2020-01-14(10-28-38pm)');

-- --------------------------------------------------------

--
-- Table structure for table `images_detail`
--

CREATE TABLE `images_detail` (
  `id` int(11) NOT NULL,
  `id_images` int(11) NOT NULL,
  `path` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images_detail`
--

INSERT INTO `images_detail` (`id`, `id_images`, `path`, `name`) VALUES
(1, 1, 'assets/images/survei/', 'survei_2020-01-14(02-28-39pm).jpg'),
(2, 1, 'assets/images/survei/', 'survei_2020-01-14(02-28-39pm)1.jpg'),
(3, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm).jpg'),
(4, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)1.jpg'),
(5, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)2.jpg'),
(6, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)3.jpg'),
(7, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)4.jpg'),
(8, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)5.jpg'),
(9, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)6.jpg'),
(10, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)7.jpg'),
(11, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)8.jpg'),
(12, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)9.jpg'),
(13, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)10.jpg'),
(14, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)11.jpg'),
(15, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)12.jpg'),
(16, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)13.jpg'),
(17, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)14.jpg'),
(18, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)15.jpg'),
(19, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)16.jpg'),
(20, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)17.jpg'),
(21, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)18.jpg'),
(22, 2, 'assets/images/survei/', 'survei_2020-01-14(10-28-38pm)19.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `installasi`
--

CREATE TABLE `installasi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_survei` int(11) NOT NULL,
  `tgl_installasi` date NOT NULL,
  `id_alat` int(11) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status` enum('Belum Dikerjakan','Proses Installasi','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `level_user`
--

CREATE TABLE `level_user` (
  `id` int(11) NOT NULL,
  `level_user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level_user`
--

INSERT INTO `level_user` (`id`, `level_user`) VALUES
(1, 'Admin'),
(2, 'Teknisi');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `li_class` varchar(50) NOT NULL,
  `a_href` varchar(50) NOT NULL,
  `a_class` varchar(50) NOT NULL,
  `a_icon` varchar(50) NOT NULL,
  `p_icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`, `li_class`, `a_href`, `a_class`, `a_icon`, `p_icon`) VALUES
(1, 'Dashboard', 'nav-item', 'admin', 'nav-link', 'nav-icon fas fa-tachometer-alt', ''),
(2, 'Master', 'nav-item', '#', 'nav-link', 'nav-icon fas fa-book', 'right fas fa-angle-left'),
(3, 'Installasi', 'nav-item', '#', 'nav-link', 'nav-icon fas fa-hammer', 'right fas fa-angle-left'),
(4, 'Survei', 'nav-item', '#', 'nav-link', 'nav-icon fas fa-search', 'right fas fa-angle-left'),
(5, 'Setting', 'nav-item', '#', 'nav-link', 'nav-icon fas fa-cog', 'right fas fa-angle-left');

-- --------------------------------------------------------

--
-- Table structure for table `m_alat`
--

CREATE TABLE `m_alat` (
  `id` int(11) NOT NULL,
  `nama_alat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_alat`
--

INSERT INTO `m_alat` (`id`, `nama_alat`) VALUES
(1, 'Alat 1'),
(3, 'Alat 2'),
(4, 'Alat 3');

-- --------------------------------------------------------

--
-- Table structure for table `m_alat_detail`
--

CREATE TABLE `m_alat_detail` (
  `id` int(11) NOT NULL,
  `id_alat` int(11) NOT NULL,
  `detail_alat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_alat_detail`
--

INSERT INTO `m_alat_detail` (`id`, `id_alat`, `detail_alat`) VALUES
(1, 1, 'Palu'),
(4, 1, 'Bor'),
(5, 3, 'CCTV'),
(6, 1, 'Pengukur'),
(7, 1, 'tang');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_installasi`
--

CREATE TABLE `permintaan_installasi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `instansi` varchar(50) NOT NULL,
  `jk` enum('Laki-laki','Perempuan') NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `status` enum('Permintaan','Survei','Installasi','Selesai') NOT NULL DEFAULT 'Permintaan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `sub_menu` varchar(50) NOT NULL,
  `li_class` varchar(50) NOT NULL,
  `a_href` varchar(50) NOT NULL,
  `a_class` varchar(50) NOT NULL,
  `a_icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `id_menu`, `sub_menu`, `li_class`, `a_href`, `a_class`, `a_icon`) VALUES
(1, 1, '', '', '', '', ''),
(2, 2, 'Master Alat', 'nav-item', 'master/alat', 'nav-link', 'fas fa-angle-right nav-icon'),
(3, 2, 'Master Bahan', 'nav-item', 'master/bahan', 'nav-link', 'fas fa-angle-right nav-icon'),
(4, 3, 'Permintaan Installasi', 'nav-item', 'installasi/permintaan_installasi', 'nav-link', 'fas fa-angle-right nav-icon'),
(5, 3, 'Installasi', 'nav-item', 'installasi', 'nav-link', 'fas fa-angle-right nav-icon'),
(6, 5, 'Menus', 'nav-item', 'setting/menus', 'nav-link', 'fas fa-angle-right nav-icon'),
(7, 5, 'Users', 'nav-item', 'setting/users', 'nav-link', 'fas fa-angle-right nav-icon'),
(9, 4, 'Survei', 'nav-item', 'survei', 'nav-link', 'fas fa-angle-right nav-icon'),
(10, 4, 'Hasil Survei', 'nav-item', 'survei/hasil', 'nav-link', 'fas fa-angle-right nav-icon');

-- --------------------------------------------------------

--
-- Table structure for table `survei`
--

CREATE TABLE `survei` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_permintaan` int(11) NOT NULL,
  `tgl_survei` date NOT NULL,
  `mulai` datetime NOT NULL,
  `selesai` datetime NOT NULL,
  `id_photos` int(11) NOT NULL,
  `catatan` varchar(200) NOT NULL,
  `status` enum('Ditolak','Dimulai','Selesai','Diterima') NOT NULL DEFAULT 'Ditolak'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'default_avatar.png',
  `email` varchar(50) NOT NULL,
  `no_t` varchar(14) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `status_teknisi` enum('OFF JOB','ON JOB') NOT NULL DEFAULT 'OFF JOB'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `id_level`, `fullname`, `password`, `foto`, `email`, `no_t`, `alamat`, `status`, `status_teknisi`) VALUES
(1, 1, 'Cindy Winatha', '$2y$10$TfWCKQgh.34cd8nMnEuGLOE5JWtM0hI5nARC/XLxbuB92EEnIa0TS', 'default_avatar.png', 'administrator@cctv.com', '0000', 'Jl cctv installation', 1, 'OFF JOB'),
(6, 2, 'Aan', '$2y$10$c.a8TVsLi89Hih.nIHmLj.dkrKHE.1QB9U0aWig34WlAVgsMwq3sy', 'default_avatar.png', 'ann@cctv.com', '0000', 'kayu agung', 1, 'OFF JOB'),
(7, 2, 'Edi', '$2y$10$Dr0UeC43yPEjcEP.YT71/ebw.ZbjkcvjgJjL7RbK0JNt5fVpPJFXi', 'default_avatar.png', 'edi@cctv.com', '0000', 'pasar kuto', 1, 'OFF JOB');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `id_level`, `id_menu`, `id_submenu`) VALUES
(2, 1, 1, 1),
(3, 1, 2, 2),
(5, 1, 3, 4),
(6, 1, 3, 5),
(8, 1, 4, 9),
(10, 1, 5, 7),
(11, 1, 4, 10),
(12, 2, 4, 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images_detail`
--
ALTER TABLE `images_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installasi`
--
ALTER TABLE `installasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_alat`
--
ALTER TABLE `m_alat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_alat_detail`
--
ALTER TABLE `m_alat_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_alat` (`id_alat`);

--
-- Indexes for table `permintaan_installasi`
--
ALTER TABLE `permintaan_installasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `survei`
--
ALTER TABLE `survei`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_menu` (`id_menu`),
  ADD KEY `id_submenu` (`id_submenu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images_detail`
--
ALTER TABLE `images_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `installasi`
--
ALTER TABLE `installasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `level_user`
--
ALTER TABLE `level_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_alat`
--
ALTER TABLE `m_alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_alat_detail`
--
ALTER TABLE `m_alat_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permintaan_installasi`
--
ALTER TABLE `permintaan_installasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `survei`
--
ALTER TABLE `survei`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `installasi`
--
ALTER TABLE `installasi`
  ADD CONSTRAINT `installasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `m_alat_detail`
--
ALTER TABLE `m_alat_detail`
  ADD CONSTRAINT `m_alat_detail_ibfk_1` FOREIGN KEY (`id_alat`) REFERENCES `m_alat` (`id`);

--
-- Constraints for table `permintaan_installasi`
--
ALTER TABLE `permintaan_installasi`
  ADD CONSTRAINT `permintaan_installasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD CONSTRAINT `sub_menu_ibfk_1` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`);

--
-- Constraints for table `survei`
--
ALTER TABLE `survei`
  ADD CONSTRAINT `survei_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level_user` (`id`);

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `user_access_menu_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level_user` (`id`),
  ADD CONSTRAINT `user_access_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `user_access_menu_ibfk_3` FOREIGN KEY (`id_submenu`) REFERENCES `sub_menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
