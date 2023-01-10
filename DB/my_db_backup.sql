SET foreign_key_checks = 0;
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

INSERT INTO `aplikasi` (`id`, `nama_owner`, `alamat`, `tlp`, `brand`, `title`, `nama_aplikasi`, `logo`, `copy_right`, `versi`, `tahun`, `email`, `nama_pengirim`, `password`) VALUES (1, 'Sistem Inventory Instalasi Farmasi', 'jalan raya', '085838333009', NULL, 'Inventory', 'Inventory', 'Logo.png', 'Copy Right ©', '1.0.0.0', '2022', 'aryoblack88@gmail.com', 'Aryo Coding', 'pfpinffqxutdjexq');


#
# TABLE STRUCTURE FOR: barang
#

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `barcode` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `kdbarang` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `kemasan` int DEFAULT NULL,
  `perundangan` int DEFAULT NULL,
  `berat` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `rak` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `aktivasi` enum('Ya','Tidak') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'Ya',
  `user_input` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `stok` double NOT NULL DEFAULT '0',
  `batch` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `thn_pengadaan` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `no_ijin_edar` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `manufaktur_date` date DEFAULT NULL,
  `nosbbk` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `sumber_dana` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ed` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nama_barang` (`nama`),
  KEY `id_gudang` (`id_gudang`),
  KEY `perundangan` (`perundangan`),
  KEY `kemasan` (`kemasan`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`),
  CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`perundangan`) REFERENCES `perundangan` (`id`),
  CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`kemasan`) REFERENCES `satuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `barang` (`id`, `barcode`, `kdbarang`, `nama`, `harga`, `kemasan`, `perundangan`, `berat`, `rak`, `aktivasi`, `user_input`, `id_gudang`, `stok`, `batch`, `thn_pengadaan`, `no_ijin_edar`, `manufaktur_date`, `nosbbk`, `sumber_dana`, `ed`) VALUES (1, '2341', '2341', 'Barang 1', '8000', 1, 1, 'gr', 'R1', 'Ya', 1, 1, '0', '', '', '', '0000-00-00', '', '', '0000-00-00');
INSERT INTO `barang` (`id`, `barcode`, `kdbarang`, `nama`, `harga`, `kemasan`, `perundangan`, `berat`, `rak`, `aktivasi`, `user_input`, `id_gudang`, `stok`, `batch`, `thn_pengadaan`, `no_ijin_edar`, `manufaktur_date`, `nosbbk`, `sumber_dana`, `ed`) VALUES (4, '1234', '1234', 'Barang 2', '90000', 1, 1, '12333', 'R1', 'Ya', 1, 1, '0', '', '', '', '0000-00-00', '', '', '0000-00-00');


#
# TABLE STRUCTURE FOR: gudang
#

DROP TABLE IF EXISTS `gudang`;

CREATE TABLE `gudang` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `notelp` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `gudang` (`id`, `nama`, `notelp`, `alamat`) VALUES (1, 'Gudang A', '1245678', 'jalansndasa');
INSERT INTO `gudang` (`id`, `nama`, `notelp`, `alamat`) VALUES (2, 'Gudang B', '21231231', 'asdasdasdasda');


#
# TABLE STRUCTURE FOR: keluar
#

DROP TABLE IF EXISTS `keluar`;

CREATE TABLE `keluar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `user_input` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `tgl_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `faktur` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `user_input` (`user_input`),
  KEY `id_gudang` (`id_gudang`),
  CONSTRAINT `keluar_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  CONSTRAINT `keluar_ibfk_3` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `keluar` (`id`, `id_pelanggan`, `tanggal`, `user_input`, `id_gudang`, `tgl_input`, `faktur`) VALUES (3, 2, '2023-01-04 07:48:30', 1, 1, '2023-01-04 19:49:05', 'KB-00001-1/04-01-2023');


#
# TABLE STRUCTURE FOR: keluar_detail
#

DROP TABLE IF EXISTS `keluar_detail`;

CREATE TABLE `keluar_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_keluar` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `jumlah` double DEFAULT '0',
  `sisa` double NOT NULL DEFAULT '0',
  `harga_jual` double NOT NULL DEFAULT '0',
  `kemasan` int DEFAULT NULL,
  `ed` date DEFAULT NULL,
  `nobatch` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  KEY `id_keluar` (`id_keluar`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `keluar_detail_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `keluar_detail_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `keluar_detail` (`id`, `id_keluar`, `id_barang`, `jumlah`, `sisa`, `harga_jual`, `kemasan`, `ed`, `nobatch`, `id_user`) VALUES (1, 3, 1, '2', '0', '8000', 1, '2024-06-04', '213123', 1);


#
# TABLE STRUCTURE FOR: pelanggan
#

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `kp_instalasi` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `admin_farmasi` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `notelp` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_input` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_gudang` (`id_gudang`),
  CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `kp_instalasi`, `admin_farmasi`, `notelp`, `user_input`, `id_gudang`) VALUES (2, 'Pelanggan 1', 'alamat 1', 'pimpinan 1', 'petugas 1', '123456', 1, 1);


#
# TABLE STRUCTURE FOR: pemesanan
#

DROP TABLE IF EXISTS `pemesanan`;

CREATE TABLE `pemesanan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nosp` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tgl_datang` date DEFAULT NULL,
  `id_supplier` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `user_input` int DEFAULT NULL,
  `tgl_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_gudang` (`id_gudang`),
  CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `pemesanan` (`id`, `nosp`, `tanggal`, `tgl_datang`, `id_supplier`, `id_gudang`, `user_input`, `tgl_input`) VALUES (1, 'SP-00001-1/31-12-202', '2022-12-31', '2023-02-25', 1, 1, 1, '2022-12-31 09:21:04');


#
# TABLE STRUCTURE FOR: pemesanan_detail
#

DROP TABLE IF EXISTS `pemesanan_detail`;

CREATE TABLE `pemesanan_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_pemesanan` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `id_satuan` int DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pemesanan` (`id_pemesanan`),
  KEY `id_barang` (`id_barang`),
  KEY `id_satuan` (`id_satuan`),
  CONSTRAINT `pemesanan_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  CONSTRAINT `pemesanan_detail_ibfk_3` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `pemesanan_detail` (`id`, `id_pemesanan`, `id_barang`, `id_satuan`, `jumlah`, `keterangan`, `id_user`) VALUES (11, 1, 1, 1, '5', NULL, 1);
INSERT INTO `pemesanan_detail` (`id`, `id_pemesanan`, `id_barang`, `id_satuan`, `jumlah`, `keterangan`, `id_user`) VALUES (12, 1, 4, 1, '3', NULL, 1);


#
# TABLE STRUCTURE FOR: penerimaan
#

DROP TABLE IF EXISTS `penerimaan`;

CREATE TABLE `penerimaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `faktur` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_supplier` int DEFAULT NULL,
  `user_input` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `tgl_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `sumber` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `id_gudang` (`id_gudang`),
  KEY `id_supplier` (`id_supplier`),
  CONSTRAINT `penerimaan_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`),
  CONSTRAINT `penerimaan_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `penerimaan` (`id`, `faktur`, `tanggal`, `id_supplier`, `user_input`, `id_gudang`, `tgl_input`, `sumber`) VALUES (1, 'PNR-00001-1/04-01-2023', '2023-01-04', 1, 1, 1, '2023-01-04 19:47:59', 'stok opname');


#
# TABLE STRUCTURE FOR: penerimaan_detail
#

DROP TABLE IF EXISTS `penerimaan_detail`;

CREATE TABLE `penerimaan_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_penerimaan` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `kemasan` int DEFAULT NULL,
  `nobatch` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ed` date DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_penerimaan` (`id_penerimaan`),
  KEY `id_barang` (`id_barang`),
  KEY `kemasan` (`kemasan`),
  CONSTRAINT `penerimaan_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  CONSTRAINT `penerimaan_detail_ibfk_3` FOREIGN KEY (`kemasan`) REFERENCES `satuan` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `penerimaan_detail` (`id`, `id_penerimaan`, `id_barang`, `harga`, `jumlah`, `kemasan`, `nobatch`, `ed`, `id_user`) VALUES (4, 1, 1, '8000', '15', 1, '213123', '2024-06-04', 1);
INSERT INTO `penerimaan_detail` (`id`, `id_penerimaan`, `id_barang`, `harga`, `jumlah`, `kemasan`, `nobatch`, `ed`, `id_user`) VALUES (5, 1, 1, '8000', '10', 1, '321231', '2024-06-04', 1);


#
# TABLE STRUCTURE FOR: perundangan
#

DROP TABLE IF EXISTS `perundangan`;

CREATE TABLE `perundangan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `perundangan` (`id`, `nama`, `id_gudang`) VALUES (1, 'Bebas', NULL);
INSERT INTO `perundangan` (`id`, `nama`, `id_gudang`) VALUES (2, 'OOT', NULL);
INSERT INTO `perundangan` (`id`, `nama`, `id_gudang`) VALUES (3, 'Alkes', NULL);
INSERT INTO `perundangan` (`id`, `nama`, `id_gudang`) VALUES (4, 'Prekursor', NULL);


#
# TABLE STRUCTURE FOR: produsen
#

DROP TABLE IF EXISTS `produsen`;

CREATE TABLE `produsen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_produsen` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `produsen` (`id`, `nama_produsen`) VALUES (2, 'Produsen 1');


#
# TABLE STRUCTURE FOR: retur_keluar
#

DROP TABLE IF EXISTS `retur_keluar`;

CREATE TABLE `retur_keluar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `id_keluar` int DEFAULT NULL,
  `id_pelanggan` int DEFAULT NULL,
  `user_input` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `id_gudang` (`id_gudang`),
  CONSTRAINT `retur_keluar_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `retur_keluar_ibfk_2` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: retur_keluar_detail
#

DROP TABLE IF EXISTS `retur_keluar_detail`;

CREATE TABLE `retur_keluar_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_retur_keluar` int DEFAULT NULL,
  `id_keluar_detail` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `id_kemasan` int DEFAULT NULL,
  `ed` date DEFAULT NULL,
  `nobatch` varbinary(50) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_barang` (`id_barang`),
  KEY `id_retur_keluar` (`id_retur_keluar`),
  KEY `id_kemasan` (`id_kemasan`),
  CONSTRAINT `retur_keluar_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `retur_keluar_detail_ibfk_3` FOREIGN KEY (`id_kemasan`) REFERENCES `satuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# TABLE STRUCTURE FOR: retur_penerimaan
#

DROP TABLE IF EXISTS `retur_penerimaan`;

CREATE TABLE `retur_penerimaan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date DEFAULT NULL,
  `id_penerimaan` int DEFAULT NULL,
  `id_supplier` int DEFAULT NULL,
  `user_input` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `tgl_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_supplier` (`id_supplier`),
  KEY `id_gudang` (`id_gudang`),
  CONSTRAINT `retur_penerimaan_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `retur_penerimaan_ibfk_2` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `retur_penerimaan` (`id`, `tanggal`, `id_penerimaan`, `id_supplier`, `user_input`, `id_gudang`, `tgl_input`) VALUES (3, '2023-01-04', 1, 1, 1, 1, '2023-01-04 21:49:51');


#
# TABLE STRUCTURE FOR: retur_penerimaan_detail
#

DROP TABLE IF EXISTS `retur_penerimaan_detail`;

CREATE TABLE `retur_penerimaan_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_retur_penerimaan` int DEFAULT NULL,
  `id_detail_penerimaan` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `id_kemasan` int DEFAULT NULL,
  `ed` date DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `id_user` int DEFAULT NULL,
  `nobatch` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_retur_penerimaan` (`id_retur_penerimaan`),
  KEY `id_barang` (`id_barang`),
  KEY `id_kemasan` (`id_kemasan`),
  CONSTRAINT `retur_penerimaan_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `retur_penerimaan_detail_ibfk_3` FOREIGN KEY (`id_kemasan`) REFERENCES `satuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `retur_penerimaan_detail` (`id`, `id_retur_penerimaan`, `id_detail_penerimaan`, `id_barang`, `id_kemasan`, `ed`, `jumlah`, `id_user`, `nobatch`) VALUES (5, 3, 4, 1, 1, '2024-06-04', '1', 1, '213123');


#
# TABLE STRUCTURE FOR: satuan
#

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO `satuan` (`id`, `nama`, `id_gudang`) VALUES (1, 'Strip', NULL);


#
# TABLE STRUCTURE FOR: stok_opname
#

DROP TABLE IF EXISTS `stok_opname`;

CREATE TABLE `stok_opname` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_transaksi` int DEFAULT NULL,
  `id_barang` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `transaksi` enum('Stok Opname','Barang Masuk','Barang Keluar','Koreksi Stok','Retur Keluar','Retur Penerimaan') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ed` date DEFAULT NULL,
  `nobatch` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `masuk` double NOT NULL DEFAULT '0',
  `keluar` double NOT NULL DEFAULT '0',
  `keterangan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `user_input` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `tgl_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_barang_fk` (`id_barang`),
  KEY `stok_opname_ibfk_1` (`id_gudang`),
  CONSTRAINT `stok_opname_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`),
  CONSTRAINT `stok_opname_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `stok_opname` (`id`, `id_transaksi`, `id_barang`, `tanggal`, `transaksi`, `ed`, `nobatch`, `masuk`, `keluar`, `keterangan`, `user_input`, `id_gudang`, `tgl_input`) VALUES (1, 4, 1, '2023-01-04', 'Barang Masuk', '2024-06-04', '213123', '15', '0', NULL, 1, 1, '2023-01-04 19:47:59');
INSERT INTO `stok_opname` (`id`, `id_transaksi`, `id_barang`, `tanggal`, `transaksi`, `ed`, `nobatch`, `masuk`, `keluar`, `keterangan`, `user_input`, `id_gudang`, `tgl_input`) VALUES (2, 5, 1, '2023-01-04', 'Barang Masuk', '2024-06-04', '321231', '10', '0', NULL, 1, 1, '2023-01-04 19:47:59');
INSERT INTO `stok_opname` (`id`, `id_transaksi`, `id_barang`, `tanggal`, `transaksi`, `ed`, `nobatch`, `masuk`, `keluar`, `keterangan`, `user_input`, `id_gudang`, `tgl_input`) VALUES (3, 1, 1, '2023-01-04', 'Barang Keluar', '2024-06-04', '213123', '0', '2', NULL, 1, 1, '2023-01-04 19:49:05');
INSERT INTO `stok_opname` (`id`, `id_transaksi`, `id_barang`, `tanggal`, `transaksi`, `ed`, `nobatch`, `masuk`, `keluar`, `keterangan`, `user_input`, `id_gudang`, `tgl_input`) VALUES (5, 5, 1, '2023-01-04', 'Retur Penerimaan', '2024-06-04', '213123', '0', '1', NULL, 1, 1, '2023-01-04 21:49:51');


#
# TABLE STRUCTURE FOR: supplier
#

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `notelp` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `sipa` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_input` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `id_produsen` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_ibfk_1` (`id_gudang`),
  KEY `supplier_ibfk_2` (`user_input`),
  CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`),
  CONSTRAINT `supplier_ibfk_2` FOREIGN KEY (`user_input`) REFERENCES `tbl_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `supplier` (`id`, `nama`, `notelp`, `alamat`, `sipa`, `user_input`, `id_gudang`, `id_produsen`) VALUES (1, 'penyedia 1', '123435345', 'tess', NULL, 1, NULL, 2);


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
) ENGINE=InnoDB AUTO_INCREMENT=420 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (1, 1, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (69, 1, 57, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (94, 1, 61, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (207, 1, 93, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (410, 6, 1, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (411, 6, 57, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (412, 6, 61, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (413, 6, 93, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (414, 1, 111, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (415, 6, 111, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (416, 1, 112, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (417, 6, 112, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (418, 1, 113, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_menu` (`id`, `id_level`, `id_menu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (419, 6, 113, 'N', 'N', 'N', 'N', 'N', 'N', 'N');


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
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=latin1;

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
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (289, 1, 52, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (290, 6, 52, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (291, 1, 53, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (292, 6, 53, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (293, 1, 54, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (294, 6, 54, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (295, 1, 55, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (296, 6, 55, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (297, 1, 56, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (298, 6, 56, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (299, 1, 57, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (300, 6, 57, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (301, 1, 58, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (302, 6, 58, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (303, 1, 59, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (304, 6, 59, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (305, 1, 60, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (306, 6, 60, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (307, 1, 61, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (308, 6, 61, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (309, 1, 62, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (310, 6, 62, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (311, 1, 63, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (312, 6, 63, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (313, 1, 64, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (314, 6, 64, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (315, 1, 65, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (316, 6, 65, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (317, 1, 66, 'Y', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (318, 6, 66, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (319, 1, 67, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (320, 6, 67, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (321, 1, 68, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (322, 6, 68, 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (323, 1, 69, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y');
INSERT INTO `tbl_akses_submenu` (`id`, `id_level`, `id_submenu`, `view`, `add`, `edit`, `delete`, `print`, `upload`, `download`) VALUES (324, 6, 69, 'N', 'N', 'N', 'N', 'N', 'N', 'N');


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
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (1, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', '1', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (57, 'Konfigurasi', '#', 'fas fa-users-cog', '15', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (61, 'Ganti Password', 'ganti_password', 'fas fa-key', '9', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (93, 'Data Master', '#', 'fas fa-database', '5', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (111, 'Transaksi', '#', 'fas fa-shopping-cart', '2', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (112, 'Laporan', '#', 'fas fa-book', '6', 'Y', 'Y');
INSERT INTO `tbl_menu` (`id_menu`, `nama_menu`, `link`, `icon`, `urutan`, `is_active`, `parent`) VALUES (113, 'Grafik', 'grafik', 'nav-icon fas fa-chart-pie', '5', 'Y', 'Y');


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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (1, 'Menu', 'menu', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (2, 'Sub Menu', 'submenu', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (7, 'Aplikasi', 'aplikasi', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (10, 'User Level', 'userlevel', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (44, 'Data Pengguna', 'user', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (52, 'Barang', 'barang', 'far fa-circle', 93, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (53, 'Penyedia', 'supplier', 'far fa-circle', 93, 'Y', 0);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (54, 'Pelanggan', 'pelanggan', 'far fa-circle', 93, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (55, 'Satuan', 'satuan', 'far fa-circle', 93, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (56, 'Barang Masuk', 'masuk', 'far fa-circle', 111, 'Y', 1);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (57, 'Barang Keluar', 'keluar', 'far fa-circle', 111, 'Y', 2);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (58, 'Gudang', 'gudang', 'far fa-circle', 57, 'Y', NULL);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (59, 'Pengembalian Masuk', 'retur_penerimaan', 'far fa-circle', 111, 'Y', 3);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (60, 'Stok Opname', 'stok', 'far fa-circle', 111, 'Y', 5);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (61, 'Arus Stok', 'arus_stok', 'far fa-circle', 112, 'Y', 3);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (62, 'Barang Keluar', 'lap_kb', 'far fa-circle', 112, 'Y', 1);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (63, 'Barang Masuk', 'lap_tb', 'far fa-circle', 112, 'Y', 2);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (64, 'Golongan Obat', 'perundangan', 'far fa-circle', 93, 'Y', 0);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (65, 'Sisa Stok', 'sisa_stok', 'far fa-circle', 112, 'Y', 4);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (66, 'Expired Obat', 'expired', 'far fa-circle', 112, 'Y', 5);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (67, 'Pengembalian Keluar', 'retur_keluar', 'far fa-circle', 111, 'Y', 4);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (68, 'Produsen', 'produsen', 'far fa-circle', 93, 'Y', 4);
INSERT INTO `tbl_submenu` (`id_submenu`, `nama_submenu`, `link`, `icon`, `id_menu`, `is_active`, `urutan`) VALUES (69, 'Pemesanan', 'pemesanan', 'far fa-circle', 111, 'Y', 7);


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
  `id_gudang` int DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_level` (`id_level`),
  KEY `id_gudang_fk` (`id_gudang`),
  CONSTRAINT `id_gudang_fk` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `nohp`, `email`, `is_active`, `id_gudang`) VALUES (1, 'admin', 'Administrator', '$2y$05$Bl1UXpDrO8843SqKlnGkq.AjnPhDIGAbfKAoVUkqpUAp4um3LtrbW', 1, 'admin.jpg', '08129837323', 'admin11@gmail.com', 'Y', 1);
INSERT INTO `tbl_user` (`id_user`, `username`, `full_name`, `password`, `id_level`, `image`, `nohp`, `email`, `is_active`, `id_gudang`) VALUES (30, 'user', 'User', '$2y$05$KZmtybRugl1zs3.3EPx/YeqSLd8qVx1OiuWmM6Z9h7OMuG.Id5L0W', 6, 'user.png', NULL, NULL, 'Y', 2);


#
# TABLE STRUCTURE FOR: tbl_userlevel
#

DROP TABLE IF EXISTS `tbl_userlevel`;

CREATE TABLE `tbl_userlevel` (
  `id_level` int NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (1, 'admin');
INSERT INTO `tbl_userlevel` (`id_level`, `nama_level`) VALUES (6, 'user');


#
# TABLE STRUCTURE FOR: template_color
#

DROP TABLE IF EXISTS `template_color`;

CREATE TABLE `template_color` (
  `id` int NOT NULL AUTO_INCREMENT,
  `header` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dark_sidebar` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `light_sidebar` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `logo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `template_color` (`id`, `header`, `dark_sidebar`, `light_sidebar`, `logo`) VALUES (1, NULL, NULL, NULL, NULL);


SET foreign_key_checks = 1;
