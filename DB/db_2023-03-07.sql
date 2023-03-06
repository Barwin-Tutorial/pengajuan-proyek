/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - inventaris
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`inventaris` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

/*Table structure for table `alat` */

DROP TABLE IF EXISTS `alat`;

CREATE TABLE `alat` (
  `id_alat` int NOT NULL AUTO_INCREMENT,
  `barcode` varchar(20) NOT NULL,
  `nama_alat` varchar(100) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `stok` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `tgl_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `id_ruang` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  `tahun` int NOT NULL,
  PRIMARY KEY (`id_alat`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

/*Data for the table `alat` */

insert  into `alat`(`id_alat`,`barcode`,`nama_alat`,`merk`,`stok`,`id_satuan`,`tgl_input`,`tgl_update`,`id_user`,`id_kondisi`,`photo`,`keterangan`,`id_ruang`,`id_jurusan`,`tahun`) values 
(8,'A23020002','DSLR 800D','Canon',7,14,'2023-02-27 07:33:16','2023-02-27 07:33:16',1,3,NULL,'',4,NULL,2019),
(9,'A23030001','Penggaris 100cm','Joyko',1,14,'2023-03-02 21:15:00','2023-03-02 21:15:00',1,3,NULL,'-',4,NULL,2022),
(11,'A23030002','Steples Besar','Joyko',8,14,'2023-03-02 22:04:26','2023-03-02 22:04:26',1,3,NULL,'-',2,NULL,2023),
(12,'A23030003','Printer L 120','Epson',8,17,'2023-03-02 22:22:33','2023-03-02 22:22:33',1,3,NULL,'-',2,NULL,2023);

/*Table structure for table `aplikasi` */

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

/*Data for the table `aplikasi` */

insert  into `aplikasi`(`id`,`nama_owner`,`alamat`,`tlp`,`brand`,`title`,`nama_aplikasi`,`logo`,`copy_right`,`versi`,`tahun`,`email`,`nama_pengirim`,`password`) values 
(1,'Kevin Ricky Utama','Jl. Raya Desa Purbayasa RT01/RW03, Kec. Padamara, Kab. Purbalingga, Jawa Tengah (53372)','085158744619',NULL,'INVENSMANKA','INVENSMANKA','Logo_SmkN_1_KLG_PNG.png','Skripsi ©','1.0.1',2023,'aryoblack88@gmail.com','Aryo Coding','pfpinffqxutdjexq');

/*Table structure for table `bahan` */

DROP TABLE IF EXISTS `bahan`;

CREATE TABLE `bahan` (
  `id_bahan` int NOT NULL AUTO_INCREMENT,
  `barcode` varchar(20) NOT NULL,
  `nama_bahan` varchar(100) DEFAULT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `stok` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `id_ruang` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  PRIMARY KEY (`id_bahan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

/*Data for the table `bahan` */

insert  into `bahan`(`id_bahan`,`barcode`,`nama_bahan`,`merk`,`stok`,`id_satuan`,`tgl_input`,`tgl_update`,`id_user`,`id_kondisi`,`photo`,`keterangan`,`id_ruang`,`id_jurusan`) values 
(2,'B23020001','Emulsi 2050','Alta',10,19,'2023-02-28 15:45:25','2023-02-28 15:45:25',NULL,NULL,NULL,'-',NULL,NULL),
(3,'B23020002','Emulsi 1030','Alta',10,19,'2023-02-28 15:45:44','2023-02-28 15:45:44',NULL,NULL,NULL,'-',NULL,NULL);

/*Table structure for table `dana` */

DROP TABLE IF EXISTS `dana`;

CREATE TABLE `dana` (
  `id_dana` int NOT NULL,
  `dana` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dana` */

insert  into `dana`(`id_dana`,`dana`) values 
(0,'Dana 1');

/*Table structure for table `guru` */

DROP TABLE IF EXISTS `guru`;

CREATE TABLE `guru` (
  `id_guru` int NOT NULL AUTO_INCREMENT,
  `nama_guru` varchar(100) DEFAULT NULL,
  `id_jabatan` varchar(100) DEFAULT NULL,
  `photo` text,
  PRIMARY KEY (`id_guru`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

/*Data for the table `guru` */

insert  into `guru`(`id_guru`,`nama_guru`,`id_jabatan`,`photo`) values 
(1,'Ardi','2','ardi.png');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id_jabatan`,`nama_jabatan`) values 
(2,'Guru Produktif'),
(3,'Siswa'),
(4,'Toolman'),
(5,'Guru Non-Produktif');

/*Table structure for table `jurusan` */

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

/*Data for the table `jurusan` */

insert  into `jurusan`(`id_jurusan`,`nama_jurusan`) values 
(3,'Desain Komunikasi Visual (TG)'),
(4,'Desain Komunikasi Visual (MM)'),
(6,'Sarpras'),
(7,'Kuliner'),
(8,'Teknik Otomotif'),
(9,'Teknik Mesin'),
(10,'Akuntansi Keuangan Lembaga'),
(11,'Teknik Pengelasan Dan Fabrikasi Logam');

/*Table structure for table `kerusakan_alat` */

DROP TABLE IF EXISTS `kerusakan_alat`;

CREATE TABLE `kerusakan_alat` (
  `id_kerusakan_alat` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `id_alat` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `stok_out` double DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_jurusan` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_pengembalian` int DEFAULT NULL,
  PRIMARY KEY (`id_kerusakan_alat`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

/*Data for the table `kerusakan_alat` */

/*Table structure for table `kerusakan_bahan` */

DROP TABLE IF EXISTS `kerusakan_bahan`;

CREATE TABLE `kerusakan_bahan` (
  `id_kerusakan_bahan` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `id_bahan` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `stok_out` double DEFAULT NULL,
  `tgl_input` date DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_jurusan` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id_kerusakan_bahan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

/*Data for the table `kerusakan_bahan` */

/*Table structure for table `kondisi` */

DROP TABLE IF EXISTS `kondisi`;

CREATE TABLE `kondisi` (
  `id_kondisi` int NOT NULL AUTO_INCREMENT,
  `kondisi` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_kondisi`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

/*Data for the table `kondisi` */

insert  into `kondisi`(`id_kondisi`,`kondisi`) values 
(1,'Maintenance'),
(2,'Rusak'),
(3,'Baik'),
(5,'Expired');

/*Table structure for table `merk` */

DROP TABLE IF EXISTS `merk`;

CREATE TABLE `merk` (
  `id_merk` int NOT NULL AUTO_INCREMENT,
  `nama_merk` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

/*Data for the table `merk` */

insert  into `merk`(`id_merk`,`nama_merk`) values 
(1,'Lenovo'),
(2,'Samsung'),
(3,'Sidu'),
(4,'Ixora'),
(5,'Logitech'),
(6,'ASUS'),
(7,'LG'),
(8,'Acer'),
(9,'Krisbow'),
(10,'Epson'),
(11,'HP'),
(12,'Brother');

/*Table structure for table `pemakaian_bahan` */

DROP TABLE IF EXISTS `pemakaian_bahan`;

CREATE TABLE `pemakaian_bahan` (
  `id_pemakaian_bahan` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
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
  `penanggung_jawab` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pemakaian_bahan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

/*Data for the table `pemakaian_bahan` */

/*Table structure for table `peminjaman` */

DROP TABLE IF EXISTS `peminjaman`;

CREATE TABLE `peminjaman` (
  `id_peminjaman` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
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
  `penanggung_jawab` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_peminjaman`),
  KEY `id_alat` (`id_alat`),
  KEY `id_guru` (`id_guru`),
  KEY `id_jurusan` (`id_jurusan`),
  CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_alat`) REFERENCES `alat` (`id_alat`),
  CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_guru`) REFERENCES `guru` (`id_guru`),
  CONSTRAINT `peminjaman_ibfk_3` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

/*Data for the table `peminjaman` */

insert  into `peminjaman`(`id_peminjaman`,`nama`,`id_alat`,`id_jabatan`,`stok_out`,`id_satuan`,`id_kondisi`,`tgl_out`,`id_guru`,`keterangan`,`tgl_input`,`tgl_update`,`id_user`,`id_jurusan`,`penanggung_jawab`,`foto`,`barcode`,`status`) values 
(1,'Abc',9,4,2,14,3,'2023-03-07',NULL,'tess','2023-03-07 05:43:05','2023-03-07 06:17:01',1,NULL,'csdfs','RVRrZ1k4Q0NGUkIxMW02K04ydEVTQT09.png','','0');

/*Table structure for table `pengembalian` */

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `id_pengembalian` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `id_alat` int DEFAULT NULL,
  `id_jabatan` int DEFAULT NULL,
  `stok_in` double DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `tgl_in` date DEFAULT NULL,
  `tgl_out` date NOT NULL,
  `keterangan` text,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  `foto` varchar(500) NOT NULL,
  `id_peminjaman` int NOT NULL,
  PRIMARY KEY (`id_pengembalian`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

/*Data for the table `pengembalian` */

insert  into `pengembalian`(`id_pengembalian`,`nama`,`id_alat`,`id_jabatan`,`stok_in`,`id_satuan`,`id_kondisi`,`tgl_in`,`tgl_out`,`keterangan`,`tgl_input`,`tgl_update`,`id_user`,`id_jurusan`,`foto`,`id_peminjaman`) values 
(6,'Abc',9,4,2,14,1,'2023-03-07','2023-03-07','tess','2023-03-07 06:16:49','2023-03-07 06:16:49',1,NULL,'enl4QkN6ZjN3M1B1YWdnVkxtTGRnUT091.png',1);

/*Table structure for table `perbaikan_alat` */

DROP TABLE IF EXISTS `perbaikan_alat`;

CREATE TABLE `perbaikan_alat` (
  `id_perbaikan_alat` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `id_alat` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `id_kondisi` int DEFAULT NULL,
  `stok` double DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `keterangan` text,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_jurusan` int DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `id_pengembalian` int DEFAULT NULL,
  PRIMARY KEY (`id_perbaikan_alat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

/*Data for the table `perbaikan_alat` */

insert  into `perbaikan_alat`(`id_perbaikan_alat`,`nama`,`id_alat`,`id_satuan`,`id_kondisi`,`stok`,`tgl_masuk`,`tgl_keluar`,`foto`,`keterangan`,`create_date`,`update_date`,`id_jurusan`,`id_user`,`id_pengembalian`) values 
(1,NULL,9,14,1,2,'2023-03-15',NULL,NULL,'tess','2023-03-07 05:54:43','2023-03-07 05:54:43',NULL,NULL,NULL),
(4,NULL,9,14,1,2,'2023-03-07',NULL,'enl4QkN6ZjN3M1B1YWdnVkxtTGRnUT091.png','tess','2023-03-07 06:16:49','2023-03-07 06:16:49',NULL,1,6);

/*Table structure for table `ruang` */

DROP TABLE IF EXISTS `ruang`;

CREATE TABLE `ruang` (
  `id_ruang` int NOT NULL AUTO_INCREMENT,
  `nama_ruang` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_ruang`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

/*Data for the table `ruang` */

insert  into `ruang`(`id_ruang`,`nama_ruang`) values 
(1,'Teknopark'),
(2,'Sarpras'),
(4,'Desain Grafika'),
(5,'R. Kelas 1'),
(6,'R. Kelas 2'),
(7,'R. Kelas 3');

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `satuan` */

insert  into `satuan`(`id`,`nama_satuan`) values 
(1,'Strip'),
(13,'Rim'),
(14,'Pcs'),
(15,'Kg'),
(16,'Pack'),
(17,'Unit'),
(18,'Sheet'),
(19,'Botol'),
(21,'Karton');

/*Table structure for table `tahun` */

DROP TABLE IF EXISTS `tahun`;

CREATE TABLE `tahun` (
  `id_tahun` int NOT NULL,
  `tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tahun` */

insert  into `tahun`(`id_tahun`,`tahun`) values 
(0,'2023');

/*Table structure for table `tbl_akses_menu` */

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

/*Data for the table `tbl_akses_menu` */

insert  into `tbl_akses_menu`(`id`,`id_level`,`id_menu`,`view`,`add`,`edit`,`delete`,`print`,`upload`,`download`) values 
(1,1,1,'Y','N','N','N','N','N','N'),
(69,1,57,'Y','Y','Y','Y','Y','Y','N'),
(94,1,61,'Y','Y','Y','Y','Y','Y','N'),
(207,1,93,'Y','N','N','N','N','N','N'),
(410,6,1,'Y','N','N','N','N','N','N'),
(411,6,57,'N','N','N','N','N','N','N'),
(412,6,61,'Y','Y','Y','Y','Y','N','N'),
(413,6,93,'Y','N','N','N','N','N','N'),
(414,1,111,'Y','Y','Y','Y','Y','Y','Y'),
(415,6,111,'Y','N','N','N','N','N','N'),
(416,1,112,'Y','N','N','N','N','N','N'),
(417,6,112,'Y','Y','Y','Y','Y','Y','Y'),
(420,7,1,'Y','N','N','N','N','N','N'),
(421,7,57,'Y','N','N','N','N','N','N'),
(422,7,61,'Y','Y','Y','Y','Y','Y','Y'),
(423,7,93,'Y','N','N','N','N','N','N'),
(424,7,111,'Y','N','N','N','N','N','N'),
(425,7,112,'Y','N','N','N','N','N','N'),
(427,1,114,'Y','N','N','N','N','N','N'),
(428,6,114,'Y','Y','Y','Y','Y','Y','Y'),
(429,7,114,'Y','N','N','N','N','N','N'),
(430,8,1,'Y','N','N','N','N','N','N'),
(431,8,57,'N','N','N','N','N','N','N'),
(432,8,61,'Y','Y','Y','Y','Y','Y','Y'),
(433,8,93,'N','N','N','N','N','N','N'),
(434,8,111,'Y','N','N','N','N','N','N'),
(435,8,112,'Y','N','N','N','N','N','N'),
(436,8,114,'Y','N','N','N','N','N','N'),
(437,9,1,'Y','N','N','N','N','N','N'),
(438,9,57,'N','N','N','N','N','N','N'),
(439,9,61,'Y','N','N','N','N','N','N'),
(440,9,93,'Y','N','N','N','N','N','N'),
(441,9,111,'Y','N','N','N','N','N','N'),
(442,9,112,'Y','Y','Y','Y','Y','Y','Y'),
(443,9,114,'Y','Y','Y','Y','Y','Y','Y');

/*Table structure for table `tbl_akses_submenu` */

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
) ENGINE=InnoDB AUTO_INCREMENT=438 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_akses_submenu` */

insert  into `tbl_akses_submenu`(`id`,`id_level`,`id_submenu`,`view`,`add`,`edit`,`delete`,`print`,`upload`,`download`) values 
(2,1,2,'Y','Y','Y','Y','Y','Y','N'),
(4,1,1,'Y','Y','Y','Y','Y','Y','N'),
(6,1,7,'Y','Y','Y','Y','Y','Y','N'),
(9,1,10,'Y','Y','Y','Y','Y','Y','N'),
(209,1,44,'Y','Y','Y','Y','Y','Y','Y'),
(284,6,1,'N','N','N','N','N','N','N'),
(285,6,2,'N','N','N','N','N','N','N'),
(286,6,7,'N','N','N','N','N','N','N'),
(287,6,10,'N','N','N','N','N','N','N'),
(288,6,44,'N','N','N','N','N','N','N'),
(295,1,55,'Y','Y','Y','Y','Y','Y','Y'),
(296,6,55,'Y','Y','Y','Y','Y','N','N'),
(327,7,1,'N','N','N','N','N','N','N'),
(328,7,2,'N','N','N','N','N','N','N'),
(329,7,7,'Y','Y','Y','Y','Y','Y','Y'),
(330,7,10,'Y','Y','Y','Y','Y','Y','Y'),
(331,7,44,'Y','Y','Y','Y','Y','Y','Y'),
(335,7,55,'Y','Y','Y','Y','Y','Y','Y'),
(354,1,72,'Y','Y','Y','Y','Y','Y','Y'),
(355,6,72,'N','N','N','N','N','N','N'),
(356,7,72,'Y','Y','Y','Y','Y','Y','N'),
(357,1,73,'Y','Y','Y','Y','Y','Y','Y'),
(358,6,73,'N','N','N','N','N','N','N'),
(359,7,73,'Y','Y','Y','Y','Y','Y','N'),
(363,1,75,'Y','Y','Y','Y','Y','Y','Y'),
(364,6,75,'N','N','N','N','N','N','N'),
(365,7,75,'Y','N','N','N','N','N','N'),
(366,1,76,'Y','Y','Y','Y','Y','Y','Y'),
(367,6,76,'Y','Y','Y','Y','Y','Y','Y'),
(368,7,76,'Y','N','N','N','N','N','N'),
(369,1,77,'Y','Y','Y','Y','Y','Y','Y'),
(370,6,77,'Y','Y','Y','Y','Y','Y','Y'),
(371,7,77,'Y','N','N','N','N','N','N'),
(372,1,78,'Y','Y','Y','Y','Y','Y','Y'),
(373,6,78,'Y','Y','Y','Y','Y','Y','Y'),
(374,7,78,'Y','N','N','N','N','N','N'),
(375,1,79,'Y','Y','Y','Y','Y','Y','Y'),
(376,6,79,'Y','Y','Y','Y','Y','Y','Y'),
(377,7,79,'Y','N','N','N','N','N','N'),
(378,1,80,'Y','Y','Y','Y','Y','Y','Y'),
(379,6,80,'N','N','N','N','N','N','N'),
(380,7,80,'Y','N','N','N','N','N','N'),
(381,1,81,'Y','Y','Y','Y','Y','Y','Y'),
(382,6,81,'Y','Y','Y','Y','Y','Y','Y'),
(383,7,81,'Y','N','N','N','N','N','N'),
(384,8,1,'N','N','N','N','N','N','N'),
(385,8,2,'N','N','N','N','N','N','N'),
(386,8,7,'N','N','N','N','N','N','N'),
(387,8,10,'N','N','N','N','N','N','N'),
(388,8,44,'N','N','N','N','N','N','N'),
(389,8,55,'N','N','N','N','N','N','N'),
(391,8,72,'N','N','N','N','N','N','N'),
(392,8,73,'N','N','N','N','N','N','N'),
(394,8,75,'N','N','N','N','N','N','N'),
(395,8,76,'Y','N','N','N','N','N','N'),
(396,8,77,'Y','N','N','N','N','N','N'),
(397,8,78,'Y','N','N','N','N','N','N'),
(398,8,79,'Y','N','N','N','N','N','N'),
(399,8,80,'N','N','N','N','N','N','N'),
(400,8,81,'Y','N','N','N','N','N','N'),
(401,9,1,'N','N','N','N','N','N','N'),
(402,9,2,'N','N','N','N','N','N','N'),
(403,9,7,'N','N','N','N','N','N','N'),
(404,9,10,'N','N','N','N','N','N','N'),
(405,9,44,'N','N','N','N','N','N','N'),
(406,9,55,'Y','Y','Y','Y','Y','Y','Y'),
(408,9,72,'N','N','N','N','N','N','N'),
(409,9,73,'N','N','N','N','N','N','N'),
(411,9,75,'N','N','N','N','N','N','N'),
(412,9,76,'Y','Y','Y','Y','Y','Y','Y'),
(413,9,77,'Y','Y','Y','Y','Y','Y','Y'),
(414,9,78,'Y','Y','Y','Y','Y','Y','Y'),
(415,9,79,'Y','Y','Y','Y','Y','Y','Y'),
(416,9,80,'Y','Y','Y','Y','Y','Y','Y'),
(417,9,81,'Y','Y','Y','Y','Y','Y','Y'),
(418,1,82,'Y','Y','Y','Y','Y','Y','Y'),
(419,6,82,'Y','Y','Y','Y','Y','Y','Y'),
(420,7,82,'Y','N','N','N','N','N','N'),
(421,8,82,'Y','N','N','N','N','N','N'),
(422,9,82,'Y','Y','Y','Y','Y','Y','Y'),
(428,1,84,'Y','Y','Y','Y','Y','Y','Y'),
(429,6,84,'Y','Y','Y','Y','Y','Y','Y'),
(430,7,84,'N','N','N','N','N','N','N'),
(431,8,84,'N','N','N','N','N','N','N'),
(432,9,84,'N','N','N','N','N','N','N'),
(433,1,85,'Y','Y','Y','Y','Y','Y','Y'),
(434,6,85,'Y','Y','Y','Y','Y','Y','N'),
(435,7,85,'N','N','N','N','N','N','N'),
(436,8,85,'N','N','N','N','N','N','N'),
(437,9,85,'N','N','N','N','N','N','N');

/*Table structure for table `tbl_menu` */

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

/*Data for the table `tbl_menu` */

insert  into `tbl_menu`(`id_menu`,`nama_menu`,`link`,`icon`,`urutan`,`is_active`,`parent`) values 
(1,'Dashboard','dashboard','fas fa-tachometer-alt',1,'Y','Y'),
(57,'Konfigurasi','#','fas fa-users-cog',15,'Y','Y'),
(61,'Ganti Password','ganti_password','fas fa-key',9,'Y','Y'),
(93,'Master','#','fas fa-database',5,'Y','Y'),
(111,'Transaksi','#','fas fa-shopping-cart',2,'Y','Y'),
(112,'Laporan','laporan','fas fa-book',6,'Y','Y'),
(114,'Asset','#','fas fa-toolbox',4,'Y','Y');

/*Table structure for table `tbl_submenu` */

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
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_submenu` */

insert  into `tbl_submenu`(`id_submenu`,`nama_submenu`,`link`,`icon`,`id_menu`,`is_active`,`urutan`) values 
(1,'Menu','menu','far fa-circle',57,'Y',NULL),
(2,'Sub Menu','submenu','far fa-circle',57,'Y',NULL),
(7,'Aplikasi','aplikasi','far fa-circle',57,'Y',NULL),
(10,'User Level','userlevel','far fa-circle',57,'Y',NULL),
(44,'Data Pengguna','user','far fa-circle',57,'Y',NULL),
(55,'Satuan','satuan','far fa-circle',93,'Y',NULL),
(72,'Jurusan','jurusan','far fa-circle',93,'Y',4),
(73,'Jabatan','jabatan','far fa-circle',93,'Y',5),
(75,'Ruang','ruang','far fa-circle',93,'Y',6),
(76,'Peminjaman Alat','peminjaman','far fa-circle',111,'Y',0),
(77,'Pengembalian Alat','pengembalian','far fa-circle',111,'Y',0),
(78,'Alat','alat','far fa-circle',114,'Y',0),
(79,'Bahan','bahan','far fa-circle',114,'Y',0),
(80,'Kondisi','kondisi','far fa-circle',93,'Y',0),
(81,'Pemakaian Bahan','pemakaian_bahan','far fa-circle',111,'Y',0),
(82,'Kerusakan Alat','kerusakan_alat','far fa-circle',111,'Y',0),
(84,'Kerusakan Bahan','kerusakan_bahan','far fa-circle',111,'Y',0),
(85,'Perbaikan Alat','perbaikan_alat','far fa-circle',111,'Y',0);

/*Table structure for table `tbl_user` */

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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_user` */

insert  into `tbl_user`(`id_user`,`username`,`full_name`,`password`,`id_level`,`image`,`nohp`,`email`,`is_active`,`id_jurusan`) values 
(1,'super.admin','Administrator','$2y$05$Bl1UXpDrO8843SqKlnGkq.AjnPhDIGAbfKAoVUkqpUAp4um3LtrbW',1,'admin.jpg','08129837323','admin11@gmail.com','Y',NULL),
(30,'teknisi','User','$2y$05$RNsH6vZqDxWugJDgB7xxfOBGDvzFGyYcKkslBi2k61OwzSE/Prree',6,'user.png',NULL,NULL,'Y',3),
(31,'admin','Administrator','$2y$05$CFPDfb0Yqk3ERLAoDrZ9FOzYjkBqTVqrtE9OZQSKSKrpCeev2vCkS',7,'admin2.jpg',NULL,NULL,'N',NULL),
(32,'komli','Komli','$2y$05$CcV8.zrDORd0Pu5nK.7byOMZzAC4eLbM1gN07QXrlGTjQF2sR3i.S',8,'komli.png',NULL,NULL,'Y',3),
(33,'sarpras','Sarpras','$2y$05$RyLhxggQFXRFQ/tTILHxm.adn.kMlVPaEtxS7ynvKDXrw0uMWMLeq',9,'sarpras.jpg',NULL,NULL,'Y',NULL),
(34,'pipit','Pipit Ella Fiantia','$2y$05$nuoyiJJSkA76.1PbRy2ra.ZHPj7pK4VzZ/hwLPgFATpbHXCCoB5T2',6,NULL,NULL,NULL,'Y',2),
(35,'rovi','Rovi Aprianto','$2y$05$zxWpQRtSiWs0fTcqN9UJUOGgT9uzcJXcLNxFxCg2myh39GmE9JE9m',9,NULL,NULL,NULL,'Y',4),
(36,'trisna','Trisna Widada','$2y$05$1rR5xmscM37OUhTrUfdVEubxiQjABTewNqm2C2Ro0OhVamngL1Q36',8,NULL,NULL,NULL,'Y',6),
(37,'ujang','Ujang W','$2y$05$3tz70e2uZvds2.P6EHCXWeJRze6nfD8P2/BnrkvpGsLO0qQZ3obBm',8,NULL,NULL,NULL,'Y',NULL);

/*Table structure for table `tbl_userlevel` */

DROP TABLE IF EXISTS `tbl_userlevel`;

CREATE TABLE `tbl_userlevel` (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tbl_userlevel` */

insert  into `tbl_userlevel`(`id_level`,`nama_level`) values 
(1,'Super Admin'),
(6,'Teknisi'),
(7,'Admin'),
(8,'Waka Sarpras'),
(9,'Staf Sarpras');

/* Trigger structure for table `kerusakan_alat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_kerusakan_alat` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `insert_kerusakan_alat` AFTER INSERT ON `kerusakan_alat` FOR EACH ROW UPDATE alat SET stok = stok-new.stok_out WHERE id_alat=new.id_alat */$$


DELIMITER ;

/* Trigger structure for table `kerusakan_alat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_kerusakan_alat` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `update_kerusakan_alat` AFTER UPDATE ON `kerusakan_alat` FOR EACH ROW UPDATE alat SET stok = stok+new.stok_out-new.stok_out WHERE id_alat=new.id_alat */$$


DELIMITER ;

/* Trigger structure for table `kerusakan_alat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_kerusakan_alat` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `delete_kerusakan_alat` BEFORE DELETE ON `kerusakan_alat` FOR EACH ROW UPDATE alat SET stok = stok+old.stok_out WHERE id_alat=old.id_alat */$$


DELIMITER ;

/* Trigger structure for table `pemakaian_bahan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_pemakaian_bahan` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `insert_pemakaian_bahan` AFTER INSERT ON `pemakaian_bahan` FOR EACH ROW UPDATE bahan SET stok=stok - new.stok_out WHERE id_bahan=new.id_bahan */$$


DELIMITER ;

/* Trigger structure for table `pemakaian_bahan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_pemaian_bahan` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `update_pemaian_bahan` AFTER UPDATE ON `pemakaian_bahan` FOR EACH ROW UPDATE bahan SET stok=stok + old.stok_out - new.stok_out WHERE id_bahan=new.id_bahan */$$


DELIMITER ;

/* Trigger structure for table `pemakaian_bahan` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `del_pemakaian_bahan` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `del_pemakaian_bahan` BEFORE DELETE ON `pemakaian_bahan` FOR EACH ROW UPDATE bahan SET stok=stok + old.stok_out WHERE id_bahan=old.id_bahan */$$


DELIMITER ;

/* Trigger structure for table `peminjaman` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_peminjaman_alat` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `insert_peminjaman_alat` AFTER INSERT ON `peminjaman` FOR EACH ROW UPDATE alat SET stok=stok-new.stok_out WHERE id_alat=new.id_alat */$$


DELIMITER ;

/* Trigger structure for table `peminjaman` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_peminjaman_alat` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `update_peminjaman_alat` AFTER UPDATE ON `peminjaman` FOR EACH ROW UPDATE alat SET stok=stok+old.stok_out-new.stok_out WHERE id_alat=old.id_alat */$$


DELIMITER ;

/* Trigger structure for table `peminjaman` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `del_peminjaman_alat` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `del_peminjaman_alat` BEFORE DELETE ON `peminjaman` FOR EACH ROW UPDATE alat SET stok=stok + old.stok_out WHERE id_alat=old.id_alat */$$


DELIMITER ;

/* Trigger structure for table `pengembalian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_pengembalian` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `insert_pengembalian` AFTER INSERT ON `pengembalian` FOR EACH ROW UPDATE alat SET stok=stok+new.stok_in WHERE id_alat=new.id_alat */$$


DELIMITER ;

/* Trigger structure for table `pengembalian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_pengembalian` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `update_pengembalian` BEFORE UPDATE ON `pengembalian` FOR EACH ROW UPDATE alat set stok = stok-old.stok_in + new.stok_in WHERE id_alat=old.id_alat */$$


DELIMITER ;

/* Trigger structure for table `pengembalian` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_pengembalian` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `delete_pengembalian` BEFORE DELETE ON `pengembalian` FOR EACH ROW UPDATE alat SET stok = stok-old.stok_in WHERE id_alat=old.id_alat */$$


DELIMITER ;

/* Trigger structure for table `perbaikan_alat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `insert_perbaikan_alat` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `insert_perbaikan_alat` AFTER INSERT ON `perbaikan_alat` FOR EACH ROW UPDATE alat SET stok = stok-new.stok WHERE id_alat=new.id_alat */$$


DELIMITER ;

/* Trigger structure for table `perbaikan_alat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_perbaikan_alat` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `update_perbaikan_alat` AFTER UPDATE ON `perbaikan_alat` FOR EACH ROW UPDATE alat SET stok = stok+old.stok-new.stok WHERE id_alat=new.id_alat */$$


DELIMITER ;

/* Trigger structure for table `perbaikan_alat` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `delete_perbaikan_alat` */$$

/*!50003 CREATE */ /*!50003 TRIGGER `delete_perbaikan_alat` BEFORE DELETE ON `perbaikan_alat` FOR EACH ROW UPDATE alat SET stok = stok+old.stok WHERE id_alat=old.id_alat */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
