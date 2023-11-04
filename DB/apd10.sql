-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2023 at 04:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apd`
--

-- --------------------------------------------------------

--
-- Table structure for table `aplikasi`
--

CREATE TABLE `aplikasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_owner` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tlp` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `brand` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nama_aplikasi` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `logo` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `copy_right` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `versi` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nama_pengirim` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `aplikasi`
--

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `brand`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`, `email`, `nama_pengirim`, `password`) VALUES
(1, 'Suttan Adjie Maula Herman', '', '085158744619', NULL, 'APD', 'Aplikasi Pengelolaan Dokumentasi Proyek', 'mimin.png', '©', '1.0.0', '2023', 'suttan@gmail.com', 'Suttan', 'pfpinffqxutdjexq');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akses_menu`
--

CREATE TABLE `tbl_akses_menu` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `view` enum('Y','N') NOT NULL DEFAULT 'N',
  `add` enum('Y','N') NOT NULL DEFAULT 'N',
  `edit` enum('Y','N') NOT NULL DEFAULT 'N',
  `delete` enum('Y','N') NOT NULL DEFAULT 'N',
  `print` enum('Y','N') NOT NULL DEFAULT 'N',
  `upload` enum('Y','N') NOT NULL DEFAULT 'N',
  `download` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_akses_menu`
--

INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES
(1, 1, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(69, 1, 57, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N'),
(94, 1, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N'),
(207, 1, 93, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N'),
(410, 6, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(411, 6, 57, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(412, 6, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'N'),
(413, 6, 93, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(430, 8, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(431, 8, 57, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(432, 8, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(433, 8, 93, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(437, 9, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(438, 9, 57, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(439, 9, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N'),
(440, 9, 93, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(444, 10, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(445, 10, 57, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(446, 10, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'N'),
(447, 10, 93, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(448, 1, 115, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(449, 6, 115, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(450, 8, 115, 'Y', 'N', 'Y', 'N', 'N', 'N', 'Y'),
(451, 9, 115, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(452, 10, 115, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(453, 11, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(454, 11, 57, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(455, 11, 61, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(456, 11, 93, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(457, 11, 115, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(464, 1, 115, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(465, 6, 115, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(466, 8, 115, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(467, 9, 115, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(468, 10, 115, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(469, 11, 115, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(470, 1, 118, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(471, 6, 118, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(472, 8, 118, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(473, 9, 118, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(474, 10, 118, 'Y', 'N', 'N', 'N', 'N', 'N', 'N'),
(475, 11, 118, 'N', 'N', 'N', 'N', 'N', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akses_submenu`
--

CREATE TABLE `tbl_akses_submenu` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_level` int(11) NOT NULL,
  `id_submenu` int(11) NOT NULL,
  `view` enum('Y','N') NOT NULL DEFAULT 'N',
  `add` enum('Y','N') NOT NULL DEFAULT 'N',
  `edit` enum('Y','N') NOT NULL DEFAULT 'N',
  `delete` enum('Y','N') NOT NULL DEFAULT 'N',
  `print` enum('Y','N') NOT NULL DEFAULT 'N',
  `upload` enum('Y','N') NOT NULL DEFAULT 'N',
  `download` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_akses_submenu`
--

INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES
(2, 1, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N'),
(4, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N'),
(6, 1, 7, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N'),
(9, 1, 10, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N'),
(209, 1, 44, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y'),
(284, 6, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(285, 6, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(286, 6, 7, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(287, 6, 10, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(288, 6, 44, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(384, 8, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(385, 8, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(386, 8, 7, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(387, 8, 10, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(388, 8, 44, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(401, 9, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(402, 9, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(403, 9, 7, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(404, 9, 10, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(405, 9, 44, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(438, 10, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(439, 10, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(440, 10, 7, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(441, 10, 10, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(442, 10, 44, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(443, 11, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(444, 11, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(445, 11, 7, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(446, 11, 10, 'N', 'N', 'N', 'N', 'N', 'N', 'N'),
(447, 11, 44, 'N', 'N', 'N', 'N', 'N', 'N', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen`
--

CREATE TABLE `tbl_dokumen` (
  `id_dokumen` int(11) NOT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `upload` varchar(200) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_input` int(11) DEFAULT NULL,
  `status` enum('0','1','2','3','4') DEFAULT '0',
  `upload1` varchar(200) DEFAULT NULL,
  `user_pengaju` int(11) DEFAULT NULL,
  `tgl_diajukan` date DEFAULT NULL,
  `user_setuju` int(11) DEFAULT NULL,
  `tgl_setuju` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_dokumen`
--

INSERT INTO `tbl_dokumen` (`id_dokumen`, `judul`, `upload`, `keterangan`, `tgl_input`, `tgl_update`, `user_input`, `status`, `upload1`, `user_pengaju`, `tgl_diajukan`, `user_setuju`, `tgl_setuju`) VALUES
(14, 'proyek 1', 'belajar.html', 'tes', '2023-06-13 02:27:31', '2023-06-13 02:28:57', 38, '2', 'meneruskan.html', 39, '2023-06-13', 40, '2023-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` bigint(20) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `parent` enum('Y') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES
(1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', 1, 'Y', 'Y'),
(57, 'Konfigurasi', '#', 'fas fa-users-cog', 15, 'Y', 'Y'),
(61, 'Ganti Password', 'ganti_password', 'fas fa-key', 9, 'Y', 'Y'),
(93, 'Dokumen', 'dokumen', 'fas fa-folder', 5, 'Y', 'Y'),
(115, 'Pengajuan', 'pengajuan', 'fas fa-folder-open', 2, 'Y', 'Y'),
(118, 'Laporan', 'pelaporan', 'fas fa-folder-open', 3, 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_submenu`
--

CREATE TABLE `tbl_submenu` (
  `id_submenu` int(11) NOT NULL,
  `nama_submenu` varchar(50) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `urutan` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_submenu`
--

INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES
(1, 'Menu', 'menu', 'far fa-circle', 57, 'Y', NULL),
(2, 'Sub Menu', 'submenu', 'far fa-circle', 57, 'Y', NULL),
(7, 'Aplikasi', 'aplikasi', 'far fa-circle', 57, 'Y', NULL),
(10, 'User Level', 'userlevel', 'far fa-circle', 57, 'Y', NULL),
(44, 'Data Pengguna', 'user', 'far fa-circle', 57, 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `full_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `nohp` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `nohp`, `email`, `is_active`) VALUES
(1, 'admin', 'Administrator', '$2y$05$ooPMOo2rn30nsr5a7akMm.09BUBXL1lMEOrxPNgUGndTr4tDqxvKq', 1, 'mimin.png', '08129837323', 'admin11@gmail.com', 'Y'),
(38, 'dokumentasi', 'ilham', '$2y$05$mfSvni.t8xxor4y/sLCJIOku19YyaC84GVU2zntSaxKuXt0ECcJgO', 6, 'mimin.png', NULL, NULL, 'Y'),
(39, 'pengaju', 'Edward', '$2y$05$b9nXTqoHOFmo/kZtFiluF.kAqVpofS71m6z6QSU6TOXqowyze7ueK', 8, 'mimin.png', NULL, NULL, 'Y'),
(40, 'penyetuju', 'Yayan', '$2y$05$G2OE65pT9fqCU35h69gLbuq3oDIFGe9jdp9U4LMA6/o2.zJk3t/o2', 9, 'mimin.png', NULL, NULL, 'Y'),
(41, 'pelaksana', 'Suttan', '$2y$05$G3uQcoeD5m0MnsFFqMCOr.UUSJ9l7KAk4bpC7vj3xkshY6x.UgBhy', 10, 'mimin.png', NULL, NULL, 'Y'),
(42, 'admin1', 'admin1', '7c222fb2927d828af22f592134e8932480637c0d', 1, 'mimin.png', NULL, NULL, 'Y'),
(43, 'supri', 'Chan', '$2y$05$snJpfj7fJ2kvkWhwcUKxnecqFqLbF64IYi7JCtN7SqDxKbXzgSQL.', 11, NULL, NULL, NULL, 'Y'),
(44, 'Andri', 'Andrian', '$2y$05$frxAPHXi20BsP7LTtT1KWudZ9ZGoBFbaN3bPtFhMKo6qe47xQ.lVC', 6, NULL, NULL, NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlevel`
--

CREATE TABLE `tbl_userlevel` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_userlevel`
--

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES
(1, 'Admin'),
(6, 'Dokumentasi'),
(8, 'Pengajuan'),
(9, 'Penyetuju'),
(10, 'Pelaksana'),
(11, 'Project Manajer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aplikasi`
--
ALTER TABLE `aplikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_submenu` (`id_submenu`);

--
-- Indexes for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  ADD PRIMARY KEY (`id_dokumen`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  ADD PRIMARY KEY (`id_level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aplikasi`
--
ALTER TABLE `aplikasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_akses_menu`
--
ALTER TABLE `tbl_akses_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=476;

--
-- AUTO_INCREMENT for table `tbl_akses_submenu`
--
ALTER TABLE `tbl_akses_submenu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=448;

--
-- AUTO_INCREMENT for table `tbl_dokumen`
--
ALTER TABLE `tbl_dokumen`
  MODIFY `id_dokumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `tbl_submenu`
--
ALTER TABLE `tbl_submenu`
  MODIFY `id_submenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_userlevel`
--
ALTER TABLE `tbl_userlevel`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
