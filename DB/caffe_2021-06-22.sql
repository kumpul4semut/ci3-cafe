# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.1.38-MariaDB)
# Database: caffe
# Generation Time: 2021-06-22 13:06:54 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table daftar_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `daftar_menu`;

CREATE TABLE `daftar_menu` (
  `id_menu` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_menu` varchar(50) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(50) DEFAULT NULL,
  `status` enum('tersedia','habis') DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `daftar_menu` WRITE;
/*!40000 ALTER TABLE `daftar_menu` DISABLE KEYS */;

INSERT INTO `daftar_menu` (`id_menu`, `id_kategori`, `nama_menu`, `stok`, `harga`, `status`)
VALUES
	(1,1,'MAKAN1',10,1000,'tersedia');

/*!40000 ALTER TABLE `daftar_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table detail_pesanan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detail_pesanan`;

CREATE TABLE `detail_pesanan` (
  `id_detail_pesanan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_menu` int(11) DEFAULT NULL,
  `kode_pesanan` varchar(15) DEFAULT NULL,
  `jumlah` int(50) DEFAULT NULL,
  PRIMARY KEY (`id_detail_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table jabatan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `jabatan` WRITE;
/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`)
VALUES
	(1,'admin');

/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table kategori
# ------------------------------------------------------------

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id_kategori` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`)
VALUES
	(1,'Makanan'),
	(2,'Minuman');

/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table meja
# ------------------------------------------------------------

DROP TABLE IF EXISTS `meja`;

CREATE TABLE `meja` (
  `id_meja` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_meja` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_meja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `meja` WRITE;
/*!40000 ALTER TABLE `meja` DISABLE KEYS */;

INSERT INTO `meja` (`id_meja`, `nama_meja`)
VALUES
	(2,'Meja 1'),
	(3,'Meja 2');

/*!40000 ALTER TABLE `meja` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table metode
# ------------------------------------------------------------

DROP TABLE IF EXISTS `metode`;

CREATE TABLE `metode` (
  `id_metode` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_metode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_metode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table notifikasi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notifikasi`;

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_rel` int(11) DEFAULT NULL,
  `dari` int(11) DEFAULT NULL,
  `ke` int(11) DEFAULT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `isi` text,
  PRIMARY KEY (`id_notifikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table pelanggan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `no_tlp` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table pesanan
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pesanan`;

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_meja` int(11) DEFAULT NULL,
  `kode_pesanan` varchar(15) DEFAULT NULL,
  `kode_transaksi` varchar(15) DEFAULT NULL,
  `tgl_pemesanan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jam_pesan` time DEFAULT NULL,
  `jumlah_pesan` varchar(50) DEFAULT NULL,
  `jumlah_bayar` varchar(100) DEFAULT NULL,
  `status` enum('menunggu','terbooking','proses','selesai') DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table profil
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profil`;

CREATE TABLE `profil` (
  `id_profil` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_resto` varchar(50) DEFAULT NULL,
  `alamat` text,
  `tentang` text,
  `nama_pemilik` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `profil` WRITE;
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;

INSERT INTO `profil` (`id_profil`, `nama_resto`, `alamat`, `tentang`, `nama_pemilik`)
VALUES
	(1,'a1','a','a','a');

/*!40000 ALTER TABLE `profil` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table transaksi
# ------------------------------------------------------------

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_metode` int(11) DEFAULT NULL,
  `kode_transaksi` varchar(15) DEFAULT NULL,
  `jumlah_pesan` int(50) DEFAULT NULL,
  `jumlah_harga` int(50) DEFAULT NULL,
  `jumlah_bayar` int(50) DEFAULT NULL,
  `bukti_bayar` text,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `jabatan` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` text,
  `level` enum('owner','kasir','koki','pelayan') DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id_user`, `nama`, `jabatan`, `username`, `password`, `level`)
VALUES
	(1,'Admin',1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','owner');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
