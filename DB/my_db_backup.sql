SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: alat
#

DROP TABLE IF EXISTS `alat`;

CREATE TABLE `alat` (
  `id_alat` int NOT NULL AUTO_INCREMENT,
  `nama_alat` varchar(100) DEFAULT NULL,
  `id_merk` int DEFAULT NULL,
  `stok` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `tgl_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `id_ruang` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  PRIMARY KEY (`id_alat`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `alat` (`id_alat`, `nama_alat`, `id_merk`, `stok`, `id_satuan`, `tgl_input`, `tgl_update`, `id_user`, `id_kondisi`, `photo`, `keterangan`, `id_ruang`, `id_jurusan`) VALUES (1, 'Lampu Studio SK300', 2, '5', 1, '2023-02-11 18:06:18', '2023-02-11 18:06:18', NULL, 3, 'lampu-studio-sk300.jpg', 'teee', 1, NULL);


#
# TABLE STRUCTURE FOR: aplikasi
#

DROP TABLE IF EXISTS `aplikasi`;

CREATE TABLE `aplikasi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `tlp` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `brand` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `title` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nama_aplikasi` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `logo` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `copy_right` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `versi` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tahun` year DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nama_pengirim` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `brand`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`, `email`, `nama_pengirim`, `password`) VALUES (1, 'SEKOLAH ', 'jalan raya', '085838333009', NULL, 'INVENTARIS', 'INVENTARIS', 'Logo.png', 'Copy Right ©', '1.0.1', '2023', 'aryoblack88@gmail.com', 'Aryo Coding', 'pfpinffqxutdjexq');


#
# TABLE STRUCTURE FOR: bahan
#

DROP TABLE IF EXISTS `bahan`;

CREATE TABLE `bahan` (
  `id_bahan` int NOT NULL AUTO_INCREMENT,
  `nama_bahan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_merk` int DEFAULT NULL,
  `stok` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `id_ruang` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  PRIMARY KEY (`id_bahan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `bahan` (`id_bahan`, `nama_bahan`, `id_merk`, `stok`, `id_satuan`, `tgl_input`, `tgl_update`, `id_user`, `id_kondisi`, `photo`, `keterangan`, `id_ruang`, `id_jurusan`) VALUES (1, 'Tinta Printer', 2, '1', 1, '2023-02-12 13:33:33', '2023-02-12 13:33:33', 1, 3, 'tinta-printer.jpg', 'tesss', 1, NULL);


#
# TABLE STRUCTURE FOR: guru
#

DROP TABLE IF EXISTS `guru`;

CREATE TABLE `guru` (
  `id_guru` int NOT NULL AUTO_INCREMENT,
  `nama_guru` varchar(100) DEFAULT NULL,
  `id_jabatan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `photo` text,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `guru` (`id_guru`, `nama_guru`, `id_jabatan`, `photo`) VALUES (1, 'Ardi', '2', 'ardi.png');


#
# TABLE STRUCTURE FOR: jabatan
#

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES (2, 'Guru');


#
# TABLE STRUCTURE FOR: jurusan
#

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES (2, 'Akutansi');
INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES (3, 'Desain Grafis');
INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES (4, 'Multimedia');


#
# TABLE STRUCTURE FOR: kondisi
#

DROP TABLE IF EXISTS `kondisi`;

CREATE TABLE `kondisi` (
  `id_kondisi` int NOT NULL AUTO_INCREMENT,
  `kondisi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_kondisi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `kondisi` (`id_kondisi`, `kondisi`) VALUES (1, 'Maintenance');
INSERT INTO `kondisi` (`id_kondisi`, `kondisi`) VALUES (2, 'Rusak');
INSERT INTO `kondisi` (`id_kondisi`, `kondisi`) VALUES (3, 'Baik');


#
# TABLE STRUCTURE FOR: merk
#

DROP TABLE IF EXISTS `merk`;

CREATE TABLE `merk` (
  `id_merk` int NOT NULL AUTO_INCREMENT,
  `nama_merk` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `merk` (`id_merk`, `nama_merk`) VALUES (1, 'Lenovo');
INSERT INTO `merk` (`id_merk`, `nama_merk`) VALUES (2, 'Samsung');


#
# TABLE STRUCTURE FOR: pemakaian_bahan
#

DROP TABLE IF EXISTS `pemakaian_bahan`;

CREATE TABLE `pemakaian_bahan` (
  `id_pemakaian_bahan` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_bahan` int DEFAULT NULL,
  `id_jabatan` int DEFAULT NULL,
  `stok_out` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `tgl_out` date DEFAULT NULL,
  `id_guru` int DEFAULT NULL,
  `keterangan` text,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  PRIMARY KEY (`id_pemakaian_bahan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# TABLE STRUCTURE FOR: peminjaman
#

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_alat` int DEFAULT NULL,
  `id_jabatan` int DEFAULT NULL,
  `stok_out` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `tgl_out` date DEFAULT NULL,
  `id_guru` int DEFAULT NULL,
  `keterangan` text,
  `tgl_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  PRIMARY KEY (`id_peminjaman`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `peminjaman` (`id_peminjaman`, `nama`, `id_alat`, `id_jabatan`, `stok_out`, `id_satuan`, `id_kondisi`, `tgl_out`, `id_guru`, `keterangan`, `tgl_input`, `tgl_update`, `id_user`, `id_jurusan`) VALUES (2, 'Tesss', 1, 2, '1', 1, 3, '2023-02-12', 1, 'tessss', '2023-02-12 14:33:12', '2023-02-12 14:33:12', 30, 3);


#
# TABLE STRUCTURE FOR: pengembalian
#

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `id_pengembalian` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_alat` int DEFAULT NULL,
  `id_jabatan` int DEFAULT NULL,
  `stok_in` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `tgl_in` date DEFAULT NULL,
  `keterangan` text,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  PRIMARY KEY (`id_pengembalian`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# TABLE STRUCTURE FOR: ruang
#

DROP TABLE IF EXISTS `ruang`;

CREATE TABLE `ruang` (
  `id_ruang` int NOT NULL AUTO_INCREMENT,
  `nama_ruang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_ruang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`) VALUES (1, 'Ruang Aula');


#
# TABLE STRUCTURE FOR: satuan
#

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `satuan` (`id`, `nama_satuan`) VALUES (1, 'Strip');


#
# TABLE STRUCTURE FOR: tbl_akses_menu
#

DROP TABLE IF EXISTS `tbl_akses_menu`;

CREATE TABLE `tbl_akses_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_level` int NOT NULL,
  `id_menu` int NOT NULL,
  `view` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `add` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `edit` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `delete` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `print` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `upload` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `download` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `id_menu` (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=444 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (1, 1, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (69, 1, 57, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (94, 1, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (207, 1, 93, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (410, 6, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (411, 6, 57, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (412, 6, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (413, 6, 93, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (414, 1, 111, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (415, 6, 111, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (416, 1, 112, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (417, 6, 112, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (420, 7, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (421, 7, 57, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (422, 7, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (423, 7, 93, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (424, 7, 111, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (425, 7, 112, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (427, 1, 114, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (428, 6, 114, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (429, 7, 114, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (430, 8, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (431, 8, 57, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (432, 8, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (433, 8, 93, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (434, 8, 111, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (435, 8, 112, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (436, 8, 114, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (437, 9, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (438, 9, 57, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (439, 9, 61, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (440, 9, 93, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (441, 9, 111, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (442, 9, 112, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (443, 9, 114, 'N', 'N', 'N', 'N', 'N', 'N', 'N');


#
# TABLE STRUCTURE FOR: tbl_akses_submenu
#

DROP TABLE IF EXISTS `tbl_akses_submenu`;

CREATE TABLE `tbl_akses_submenu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `id_level` int NOT NULL,
  `id_submenu` int NOT NULL,
  `view` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `add` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `edit` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `delete` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `print` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `upload` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  `download` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `id_level` (`id_level`),
  KEY `id_submenu` (`id_submenu`)
) ENGINE=InnoDB AUTO_INCREMENT=423 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (2, 1, 2, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (4, 1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (6, 1, 7, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (9, 1, 10, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (209, 1, 44, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (284, 6, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (285, 6, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (286, 6, 7, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (287, 6, 10, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (288, 6, 44, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (295, 1, 55, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (296, 6, 55, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (327, 7, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (328, 7, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (329, 7, 7, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (330, 7, 10, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (331, 7, 44, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (335, 7, 55, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (351, 1, 71, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (352, 6, 71, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (353, 7, 71, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (354, 1, 72, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (355, 6, 72, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (356, 7, 72, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (357, 1, 73, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (358, 6, 73, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (359, 7, 73, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (360, 1, 74, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (361, 6, 74, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (362, 7, 74, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (363, 1, 75, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (364, 6, 75, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (365, 7, 75, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (366, 1, 76, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (367, 6, 76, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (368, 7, 76, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (369, 1, 77, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (370, 6, 77, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (371, 7, 77, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (372, 1, 78, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (373, 6, 78, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (374, 7, 78, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (375, 1, 79, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (376, 6, 79, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (377, 7, 79, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (378, 1, 80, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (379, 6, 80, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (380, 7, 80, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (381, 1, 81, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (382, 6, 81, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (383, 7, 81, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (384, 8, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (385, 8, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (386, 8, 7, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (387, 8, 10, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (388, 8, 44, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (389, 8, 55, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (390, 8, 71, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (391, 8, 72, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (392, 8, 73, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (393, 8, 74, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (394, 8, 75, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (395, 8, 76, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (396, 8, 77, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (397, 8, 78, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (398, 8, 79, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (399, 8, 80, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (400, 8, 81, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (401, 9, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (402, 9, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (403, 9, 7, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (404, 9, 10, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (405, 9, 44, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (406, 9, 55, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (407, 9, 71, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (408, 9, 72, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (409, 9, 73, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (410, 9, 74, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (411, 9, 75, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (412, 9, 76, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (413, 9, 77, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (414, 9, 78, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (415, 9, 79, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (416, 9, 80, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (417, 9, 81, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (418, 1, 82, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (419, 6, 82, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (420, 7, 82, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (421, 8, 82, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (422, 9, 82, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');


#
# TABLE STRUCTURE FOR: tbl_menu
#

DROP TABLE IF EXISTS `tbl_menu`;

CREATE TABLE `tbl_menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `urutan` bigint DEFAULT NULL,
  `is_active` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'Y',
  `parent` enum('Y') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'Y',
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', '1', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (57, 'Konfigurasi', '#', 'fas fa-users-cog', '15', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (61, 'Ganti Password', 'ganti_password', 'fas fa-key', '9', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (93, 'Master', '#', 'fas fa-database', '5', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (111, 'Transaksi', '#', 'fas fa-shopping-cart', '2', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (112, 'Laporan', '#', 'fas fa-book', '6', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (114, 'Asset', '#', 'fas fa-toolbox', '4', 'Y', 'Y');


#
# TABLE STRUCTURE FOR: tbl_submenu
#

DROP TABLE IF EXISTS `tbl_submenu`;

CREATE TABLE `tbl_submenu` (
  `id_submenu` int NOT NULL AUTO_INCREMENT,
  `nama_submenu` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `link` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_menu` int DEFAULT NULL,
  `is_active` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'Y',
  `urutan` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id_submenu`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (1, 'Menu', 'menu', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (2, 'Sub Menu', 'submenu', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (7, 'Aplikasi', 'aplikasi', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (10, 'User Level', 'userlevel', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (44, 'Data Pengguna', 'user', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (55, 'Satuan', 'satuan', 'far fa-circle', 93, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (71, 'Guru', 'guru', 'far fa-circle', 93, 'Y', 3);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (72, 'Jurusan', 'jurusan', 'far fa-circle', 93, 'Y', 4);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (73, 'Jabatan', 'jabatan', 'far fa-circle', 93, 'Y', 5);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (74, 'Merk', 'merk', 'far fa-circle', 93, 'Y', 1);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (75, 'Ruang', 'ruang', 'far fa-circle', 93, 'Y', 6);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (76, 'Peminjaman Alat', 'peminjaman', 'far fa-circle', 111, 'Y', 0);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (77, 'Pengembalian Alat', 'pengembalian', 'far fa-circle', 111, 'Y', 0);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (78, 'Alat', 'alat', 'far fa-circle', 114, 'Y', 0);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (79, 'Bahan', 'bahan', 'far fa-circle', 114, 'Y', 0);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (80, 'Kondisi', 'kondisi', 'far fa-circle', 93, 'Y', 0);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (81, 'Pemakaian Bahan', 'pemakaian_bahan', 'far fa-circle', 111, 'Y', 0);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (82, 'Kerusakan', 'kerusakan', 'far fa-circle', 111, 'Y', 0);


#
# TABLE STRUCTURE FOR: tbl_user
#

DROP TABLE IF EXISTS `tbl_user`;

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `full_name` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_level` int DEFAULT NULL,
  `image` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nohp` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `is_active` enum('Y','N') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'Y',
  `id_jurusan` int DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `nohp`, `email`, `is_active`, `id_jurusan`) VALUES (1, 'super.admin', 'Administrator', '$2y$05$Bl1UXpDrO8843SqKlnGkq.AjnPhDIGAbfKAoVUkqpUAp4um3LtrbW', 1, 'admin.jpg', '08129837323', 'admin11@gmail.com', 'Y', NULL);
INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `nohp`, `email`, `is_active`, `id_jurusan`) VALUES (30, 'teknisi', 'User', '$2y$05$RNsH6vZqDxWugJDgB7xxfOBGDvzFGyYcKkslBi2k61OwzSE/Prree', 6, 'user.png', NULL, NULL, 'Y', 3);
INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `nohp`, `email`, `is_active`, `id_jurusan`) VALUES (31, 'admin', 'Administrator', '$2y$05$CFPDfb0Yqk3ERLAoDrZ9FOzYjkBqTVqrtE9OZQSKSKrpCeev2vCkS', 7, 'admin2.jpg', NULL, NULL, 'Y', NULL);
INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `nohp`, `email`, `is_active`, `id_jurusan`) VALUES (32, 'komli', 'Komli', '$2y$05$CcV8.zrDORd0Pu5nK.7byOMZzAC4eLbM1gN07QXrlGTjQF2sR3i.S', 8, 'komli.png', NULL, NULL, 'Y', 3);
INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `nohp`, `email`, `is_active`, `id_jurusan`) VALUES (33, 'sarpras', 'Sarpras', '$2y$05$RyLhxggQFXRFQ/tTILHxm.adn.kMlVPaEtxS7ynvKDXrw0uMWMLeq', 9, 'sarpras.jpg', NULL, NULL, 'Y', NULL);


#
# TABLE STRUCTURE FOR: tbl_userlevel
#

DROP TABLE IF EXISTS `tbl_userlevel`;

CREATE TABLE `tbl_userlevel` (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (1, 'Super Admin');
INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (6, 'Teknisi');
INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (7, 'Admin');
INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (8, 'Komli');
INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (9, 'Staf Sarpras');


SET foreign_key_checks = 1;
