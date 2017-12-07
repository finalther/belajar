-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for shanghai
CREATE DATABASE IF NOT EXISTS `shanghai` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `shanghai`;

-- Dumping structure for table shanghai.reff_role
CREATE TABLE IF NOT EXISTS `reff_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table shanghai.reff_role: ~2 rows (approximately)
/*!40000 ALTER TABLE `reff_role` DISABLE KEYS */;
INSERT INTO `reff_role` (`id`, `role`) VALUES
	(1, 'Administrator'),
	(2, 'Manager'),
	(3, 'Operator');
/*!40000 ALTER TABLE `reff_role` ENABLE KEYS */;

-- Dumping structure for table shanghai.tb_barang
CREATE TABLE IF NOT EXISTS `tb_barang` (
  `kode_barang` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanghai.tb_barang: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_barang` DISABLE KEYS */;
INSERT INTO `tb_barang` (`kode_barang`, `nama`, `harga`, `satuan`) VALUES
	('BRG2017120300001', 'kacang', 9000, 'kg');
/*!40000 ALTER TABLE `tb_barang` ENABLE KEYS */;

-- Dumping structure for table shanghai.tb_barang_keluar
CREATE TABLE IF NOT EXISTS `tb_barang_keluar` (
  `id_transaksi` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `jumlah_Stok` int(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `kode_barang` (`kode_barang`),
  CONSTRAINT `tb_barang_keluar_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanghai.tb_barang_keluar: ~1 rows (approximately)
/*!40000 ALTER TABLE `tb_barang_keluar` DISABLE KEYS */;
INSERT INTO `tb_barang_keluar` (`id_transaksi`, `kode_barang`, `tanggal`, `jumlah_Stok`, `keterangan`) VALUES
	('TRK2017120300001', 'BRG2017120300001', '2017-12-03', 1, 'keluar');
/*!40000 ALTER TABLE `tb_barang_keluar` ENABLE KEYS */;

-- Dumping structure for table shanghai.tb_barang_masuk
CREATE TABLE IF NOT EXISTS `tb_barang_masuk` (
  `id_transaksi` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `id_suplier` varchar(255) NOT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `jumlah` int(255) NOT NULL,
  `total_harga` varchar(255) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `kode_barang` (`kode_barang`),
  CONSTRAINT `tb_barang_masuk_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanghai.tb_barang_masuk: ~6 rows (approximately)
/*!40000 ALTER TABLE `tb_barang_masuk` DISABLE KEYS */;
INSERT INTO `tb_barang_masuk` (`id_transaksi`, `tanggal`, `id_suplier`, `kode_barang`, `keterangan`, `harga`, `jumlah`, `total_harga`) VALUES
	('TRM2017120300001', '2017-12-03', 'SUP2017120100001', 'BRG2017120300001', 'baru', '9000', 5, '45000');
/*!40000 ALTER TABLE `tb_barang_masuk` ENABLE KEYS */;

-- Dumping structure for table shanghai.tb_safety_stock
CREATE TABLE IF NOT EXISTS `tb_safety_stock` (
  `id_barang` varchar(255) NOT NULL,
  `stok` int(255) NOT NULL,
  `stok_aman` int(255) NOT NULL,
  `stok_warning` int(255) NOT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `tb_safety_stock_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `tb_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanghai.tb_safety_stock: ~5 rows (approximately)
/*!40000 ALTER TABLE `tb_safety_stock` DISABLE KEYS */;
INSERT INTO `tb_safety_stock` (`id_barang`, `stok`, `stok_aman`, `stok_warning`) VALUES
	('BRG2017120300001', 4, 3, 1);
/*!40000 ALTER TABLE `tb_safety_stock` ENABLE KEYS */;

-- Dumping structure for table shanghai.tb_suplier
CREATE TABLE IF NOT EXISTS `tb_suplier` (
  `id_suplier` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanghai.tb_suplier: ~2 rows (approximately)
/*!40000 ALTER TABLE `tb_suplier` DISABLE KEYS */;
INSERT INTO `tb_suplier` (`id_suplier`, `nama`, `alamat`, `telp`) VALUES
	('SUP2017120100001', 'reza ashari', 'kediri', '0987656'),
	('SUP2017120100002', 'anto', 'kediri', '098989884932'),
	('SUP2017120200003', 'randi', 'kediri', '0987657');
/*!40000 ALTER TABLE `tb_suplier` ENABLE KEYS */;

-- Dumping structure for table shanghai.tb_user
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id_user` int(255) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table shanghai.tb_user: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` (`id_user`, `nama`, `password`, `role`) VALUES
	(1, 'admin', 'adm', 1),
	(2, 'manager', 'mnj', 2),
	(3, 'operator', 'opr', 3);
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
