-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2020 at 10:38 AM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simaset`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `kode_barang` varchar(7) NOT NULL,
  `barcode` varchar(10) NOT NULL,
  `nm_barang` varchar(40) NOT NULL,
  `kode_golongan` varchar(3) NOT NULL,
  `sub_golongan` int(11) NOT NULL DEFAULT '0',
  `merk` varchar(20) DEFAULT NULL,
  `tipe` varchar(35) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `volume` varchar(15) DEFAULT NULL,
  `tgl_entry` date NOT NULL,
  `user_posting` varchar(10) NOT NULL,
  `total_unit` decimal(18,0) DEFAULT NULL,
  `masa_servis` int(11) DEFAULT NULL,
  `poto` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`kode_barang`, `barcode`, `nm_barang`, `kode_golongan`, `sub_golongan`, `merk`, `tipe`, `tahun`, `volume`, `tgl_entry`, `user_posting`, `total_unit`, `masa_servis`, `poto`) VALUES
('AST0005', 'AST0005', 'AC ', '1', 27, 'Panasonic', '1/2 PK', '2020', '10', '2020-07-03', 'admin', '20', 0, NULL),
('AST0003', 'AST0003', 'Laptop', '3', 23, 'Lenovo Think Pad X23', 'Ram 4gb', '2019', NULL, '2020-06-19', 'admin', '4', 4, 'Lenovo1.jpg'),
('AST0004', 'AST0004', 'KURSI', '3', 21, 'DAIMACHI', 'HIDROLIK', '2019', NULL, '2020-06-19', 'admin', '4', 1, 'Hidrolik1.jpg'),
('AST0002', 'AST0002', 'KURSI HIDROLIK', '4', 25, 'FUTURE', 'HIDROLIK', '2015', NULL, '2020-06-19', 'admin', '12', 0, 'Hidrolik2.jpg'),
('AST0001', 'AST0001', 'MEJA  RECEPSIONIS', '3', 21, 'BIG BROTHER', 'LANDSCAPE', '2016', '-', '2020-06-19', 'admin', '2', 0, 'Meja1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cabang`
--

CREATE TABLE `cabang` (
  `kode_cabang` varchar(5) NOT NULL,
  `nm_cabang` varchar(35) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `propinsi` varchar(35) NOT NULL,
  `kabupaten` varchar(35) NOT NULL,
  `telepon` varchar(10) NOT NULL,
  `pincab` varchar(35) NOT NULL,
  `user_posting` varchar(11) DEFAULT NULL,
  `tgl_posting` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cabang`
--

INSERT INTO `cabang` (`kode_cabang`, `nm_cabang`, `alamat`, `propinsi`, `kabupaten`, `telepon`, `pincab`, `user_posting`, `tgl_posting`) VALUES
('800', 'PT. AGUNG PEKANBARU', 'JLN DR SUTOMO NO . 13', 'RIAU ', 'PEKANBARU', '8889990', 'TONI PURNAMA', 'admin', '2011-12-16'),
('CB001', 'PT. MAJU MUNDUR', 'JAKARTA', 'JAKARTA TIMUR', '-', '-', '-', NULL, '2013-10-24');

-- --------------------------------------------------------

--
-- Table structure for table `cabangpusat`
--

CREATE TABLE `cabangpusat` (
  `kode_cabang` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cabangpusat`
--

INSERT INTO `cabangpusat` (`kode_cabang`) VALUES
('800'),
('800'),
('800');

-- --------------------------------------------------------

--
-- Table structure for table `golongan`
--

CREATE TABLE `golongan` (
  `kode_golongan` varchar(3) NOT NULL,
  `kode_harta` int(11) DEFAULT '0',
  `nm_golongan` varchar(30) NOT NULL,
  `keterangan` varchar(20) NOT NULL,
  `persen_susut` double DEFAULT NULL,
  `masa_manfaat` int(11) DEFAULT NULL,
  `tgl_posting` date NOT NULL,
  `user_posting` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `golongan`
--

INSERT INTO `golongan` (`kode_golongan`, `kode_harta`, `nm_golongan`, `keterangan`, `persen_susut`, `masa_manfaat`, `tgl_posting`, `user_posting`) VALUES
('1', 2, 'BANGUNAN PERMANEN', 'BANGUNAN PERMANEN', 5, 20, '2012-08-24', 'admin'),
('2', 2, 'BANGUNAN TIDAK PERMANEN', 'BANGUNAN TIDAK PERMA', 10, 10, '2012-08-24', 'admin'),
('3', 1, 'GOLONGAN 1', 'INVENTARIS GOLONGAN ', 25, 4, '2012-08-24', 'admin'),
('4', 3, 'GOLONGAN 2', 'INVENTARIS GOLONGAN ', 14, 8, '2012-08-24', 'admin'),
('5', 3, 'Golongan 3', '-', 2, 10, '2013-10-22', 'admin'),
('6', 2, 'Golongan 1', 'Golongan 1', NULL, NULL, '2020-06-30', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `harta_berwujud`
--

CREATE TABLE `harta_berwujud` (
  `kode_harta` varchar(4) NOT NULL,
  `nm_harta` varchar(25) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `tgl_posting` date DEFAULT NULL,
  `user_posting` varchar(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `harta_berwujud`
--

INSERT INTO `harta_berwujud` (`kode_harta`, `nm_harta`, `ket`, `tgl_posting`, `user_posting`) VALUES
('001', 'BUKAN BANGUNAN', 'ss', '2010-05-16', 'UUS010713'),
('002', 'BANGUNAN ', '-', '2010-05-16', 'UUS010713'),
('003', 'KAYU', 'Barang yang terbuat dari kayu', '2013-10-21', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `history_ubah`
--

CREATE TABLE `history_ubah` (
  `id_history` int(11) NOT NULL,
  `kode_inventarisasi` varchar(30) DEFAULT NULL,
  `status_before` int(2) DEFAULT NULL,
  `status_after` int(2) DEFAULT NULL,
  `tgl_ubah` date DEFAULT NULL,
  `keterangan_ubah` longtext,
  `user_ubah` varchar(13) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history_ubah`
--

INSERT INTO `history_ubah` (`id_history`, `kode_inventarisasi`, `status_before`, `status_after`, `tgl_ubah`, `keterangan_ubah`, `user_ubah`) VALUES
(1, '820-AST0003-RNG001-1-000001', 0, 0, '2012-06-06', NULL, 'admin'),
(2, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', NULL, 'admin'),
(3, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', 'bbb', 'admin'),
(4, '800-AST0004-RNG001-1-000001', 0, 0, '2012-08-24', NULL, 'admin'),
(5, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', NULL, 'admin'),
(6, '800-AST0004-RNG001-1-000001', 0, 0, '2012-08-24', NULL, 'admin'),
(7, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', NULL, 'admin'),
(8, '800-AST0006-RNG005-3-0000003', 1, 2, '2013-11-03', '-', NULL),
(9, '800-AST0002-RNG001-1-0000002', 1, 3, '2013-11-03', NULL, NULL),
(1, '820-AST0003-RNG001-1-000001', 0, 0, '2012-06-06', NULL, 'admin'),
(2, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', NULL, 'admin'),
(3, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', 'bbb', 'admin'),
(4, '800-AST0004-RNG001-1-000001', 0, 0, '2012-08-24', NULL, 'admin'),
(5, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', NULL, 'admin'),
(6, '800-AST0004-RNG001-1-000001', 0, 0, '2012-08-24', NULL, 'admin'),
(7, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', NULL, 'admin'),
(8, '800-AST0006-RNG005-3-0000003', 1, 2, '2013-11-03', '-', NULL),
(9, '800-AST0002-RNG001-1-0000002', 1, 3, '2013-11-03', NULL, NULL),
(1, '820-AST0003-RNG001-1-000001', 0, 0, '2012-06-06', NULL, 'admin'),
(2, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', NULL, 'admin'),
(3, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', 'bbb', 'admin'),
(4, '800-AST0004-RNG001-1-000001', 0, 0, '2012-08-24', NULL, 'admin'),
(5, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', NULL, 'admin'),
(6, '800-AST0004-RNG001-1-000001', 0, 0, '2012-08-24', NULL, 'admin'),
(7, '800-AST0004-RNG001-1-000003', 0, 0, '2012-08-24', NULL, 'admin'),
(8, '800-AST0006-RNG005-3-0000003', 1, 2, '2013-11-03', '-', NULL),
(9, '800-AST0002-RNG001-1-0000002', 1, 3, '2013-11-03', NULL, NULL);

--
-- Triggers `history_ubah`
--
DELIMITER $$
CREATE TRIGGER `update_status_inv` AFTER INSERT ON `history_ubah` FOR EACH ROW BEGIN
	update inventarisasi set `status`= new.status_after where kode_inventarisasi=new.kode_inventarisasi ;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `inventarisasi`
--

CREATE TABLE `inventarisasi` (
  `kode_inventarisasi` varchar(30) NOT NULL,
  `kode_barang` varchar(7) DEFAULT NULL,
  `id_pengadaan` varchar(18) DEFAULT NULL,
  `kode_cabang` varchar(3) DEFAULT NULL,
  `kode_unit` int(11) DEFAULT NULL,
  `kode_ruangan` varchar(6) DEFAULT NULL,
  `jumlah` decimal(10,0) DEFAULT NULL,
  `kondisi` varchar(15) DEFAULT NULL,
  `tgl_posting` date DEFAULT NULL,
  `user_posting` varchar(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `kode_pengadaan` varchar(30) DEFAULT NULL,
  `id_inventarisasi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inventarisasi`
--

INSERT INTO `inventarisasi` (`kode_inventarisasi`, `kode_barang`, `id_pengadaan`, `kode_cabang`, `kode_unit`, `kode_ruangan`, `jumlah`, `kondisi`, `tgl_posting`, `user_posting`, `status`, `kode_pengadaan`, `id_inventarisasi`) VALUES
('800-AST0002-RNG001-1-0000002', 'AST0002', '1', '800', 1, 'RNG001', '1', NULL, '2013-11-02', 'admin', 3, 'BRS-800-0000000001', 4),
('800-AST0001-RNG001-1-0000003', 'AST0001', '3', '800', 1, 'RNG001', '2', NULL, '2013-10-06', 'admin', 1, 'BRS-800-0000000002', 5),
('800-AST0006-RNG005-3-0000003', 'AST0006', '15', '800', 3, 'RNG005', '1', NULL, '2013-09-07', 'admin', 2, 'BRS-800-0000000004', 7),
('800-AST0002-RNG001-1-0000002', 'AST0002', '1', '800', 1, 'RNG001', '1', NULL, '2013-11-02', 'admin', 3, 'BRS-800-0000000001', 4),
('800-AST0001-RNG001-1-0000003', 'AST0001', '3', '800', 1, 'RNG001', '2', NULL, '2013-10-06', 'admin', 1, 'BRS-800-0000000002', 5),
('800-AST0006-RNG005-3-0000003', 'AST0006', '15', '800', 3, 'RNG005', '1', NULL, '2013-09-07', 'admin', 2, 'BRS-800-0000000004', 7),
('800-AST0002-RNG001-1-0000002', 'AST0002', '1', '800', 1, 'RNG001', '1', NULL, '2013-11-02', 'admin', 3, 'BRS-800-0000000001', 4),
('800-AST0001-RNG001-1-0000003', 'AST0001', '3', '800', 1, 'RNG001', '2', NULL, '2013-10-06', 'admin', 1, 'BRS-800-0000000002', 5),
('800-AST0006-RNG005-3-0000003', 'AST0006', '15', '800', 3, 'RNG005', '1', NULL, '2013-09-07', 'admin', 2, 'BRS-800-0000000004', 7);

--
-- Triggers `inventarisasi`
--
DELIMITER $$
CREATE TRIGGER `kurang_sisajumlah` AFTER INSERT ON `inventarisasi` FOR EACH ROW BEGIN
	update pengadaan set sisa_jumlah = (sisa_jumlah - new.jumlah) where id_pengadaan=new.id_pengadaan ;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id_pemeliharaan` int(11) NOT NULL,
  `kode_inventarisasi` varchar(30) DEFAULT NULL,
  `tgl_servis` date DEFAULT NULL,
  `tgl_servis_berikutnya` date DEFAULT NULL,
  `tempat_servis` varchar(40) DEFAULT NULL,
  `keluhan` varchar(80) DEFAULT NULL,
  `keterangan_pem` varchar(80) DEFAULT NULL,
  `tgl_posting` date DEFAULT NULL,
  `user_posting` varchar(11) DEFAULT NULL,
  `biaya_servis` decimal(18,0) DEFAULT NULL,
  `flag` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id_pemeliharaan`, `kode_inventarisasi`, `tgl_servis`, `tgl_servis_berikutnya`, `tempat_servis`, `keluhan`, `keterangan_pem`, `tgl_posting`, `user_posting`, `biaya_servis`, `flag`) VALUES
(1, '800-AST0003-RNG001-1-000001', '2012-08-25', '2013-02-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(2, '800-AST0003-RNG002-2-000001', '2012-08-25', '2013-02-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 1),
(3, '800-AST0001-RNG001-1-000001', '2012-08-25', '2012-08-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(4, '800-AST0002-RNG001-1-000001', '2012-08-25', '2012-08-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(5, '800-AST0002-RNG003-3-000001', '2012-08-25', '2012-08-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(6, '800-AST0005-RNG002-2-000001', '2012-08-25', '2013-02-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 1),
(7, '800-AST0005-RNG002-2-000001', '2012-08-25', '2013-02-25', 'LG CENTER', 'KURANG DINGIN', '-', '2012-08-25', 'admin', '50000', 0),
(8, '800-AST0003-RNG002-2-000001', '2012-08-25', '2013-02-25', 'BAGIAN IT KANTOR', 'MATI TOTAL', 'MB USAK , SO BELI BARI', '2012-08-25', 'admin', '300000', 0),
(11, '800-AST0006-RNG005-3-0000003', '2013-11-03', '2014-05-03', 'palu', '-', '-', '2013-11-03', NULL, '200', NULL),
(1, '800-AST0003-RNG001-1-000001', '2012-08-25', '2013-02-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(2, '800-AST0003-RNG002-2-000001', '2012-08-25', '2013-02-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 1),
(3, '800-AST0001-RNG001-1-000001', '2012-08-25', '2012-08-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(4, '800-AST0002-RNG001-1-000001', '2012-08-25', '2012-08-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(5, '800-AST0002-RNG003-3-000001', '2012-08-25', '2012-08-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(6, '800-AST0005-RNG002-2-000001', '2012-08-25', '2013-02-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 1),
(7, '800-AST0005-RNG002-2-000001', '2012-08-25', '2013-02-25', 'LG CENTER', 'KURANG DINGIN', '-', '2012-08-25', 'admin', '50000', 0),
(8, '800-AST0003-RNG002-2-000001', '2012-08-25', '2013-02-25', 'BAGIAN IT KANTOR', 'MATI TOTAL', 'MB USAK , SO BELI BARI', '2012-08-25', 'admin', '300000', 0),
(11, '800-AST0006-RNG005-3-0000003', '2013-11-03', '2014-05-03', 'palu', '-', '-', '2013-11-03', NULL, '200', NULL),
(1, '800-AST0003-RNG001-1-000001', '2012-08-25', '2013-02-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(2, '800-AST0003-RNG002-2-000001', '2012-08-25', '2013-02-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 1),
(3, '800-AST0001-RNG001-1-000001', '2012-08-25', '2012-08-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(4, '800-AST0002-RNG001-1-000001', '2012-08-25', '2012-08-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(5, '800-AST0002-RNG003-3-000001', '2012-08-25', '2012-08-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 0),
(6, '800-AST0005-RNG002-2-000001', '2012-08-25', '2013-02-25', '-', '-', 'INVENTARISASI', '2012-08-25', 'admin', '0', 1),
(7, '800-AST0005-RNG002-2-000001', '2012-08-25', '2013-02-25', 'LG CENTER', 'KURANG DINGIN', '-', '2012-08-25', 'admin', '50000', 0),
(8, '800-AST0003-RNG002-2-000001', '2012-08-25', '2013-02-25', 'BAGIAN IT KANTOR', 'MATI TOTAL', 'MB USAK , SO BELI BARI', '2012-08-25', 'admin', '300000', 0),
(11, '800-AST0006-RNG005-3-0000003', '2013-11-03', '2014-05-03', 'palu', '-', '-', '2013-11-03', NULL, '200', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int(11) NOT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  `kode_cabang` varchar(3) DEFAULT NULL,
  `kode_inventarisasi` varchar(30) DEFAULT NULL,
  `kode_inventarisasi_baru` varchar(30) DEFAULT NULL,
  `kode_aset` varchar(7) DEFAULT NULL,
  `ruang_lama` varchar(30) DEFAULT NULL,
  `ruang_baru` varchar(30) DEFAULT NULL,
  `unit_lama` int(11) DEFAULT '0',
  `unit_baru` int(11) DEFAULT '0',
  `jumlah` int(11) DEFAULT NULL,
  `user_posting` varchar(11) DEFAULT NULL,
  `keterangan` longtext,
  `id_inventarisasi` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mutasi`
--

INSERT INTO `mutasi` (`id_mutasi`, `tgl_mutasi`, `kode_cabang`, `kode_inventarisasi`, `kode_inventarisasi_baru`, `kode_aset`, `ruang_lama`, `ruang_baru`, `unit_lama`, `unit_baru`, `jumlah`, `user_posting`, `keterangan`, `id_inventarisasi`) VALUES
(5, '2013-11-02', '800', '800-AST0002-RNG001-1-0000001', '800-AST0002-RNG001-1-0000002', 'AST0002', 'RNG001', 'RNG001', 1, 1, 1, NULL, NULL, 4);

--
-- Triggers `mutasi`
--
DELIMITER $$
CREATE TRIGGER `update_mutasi_inv` AFTER INSERT ON `mutasi` FOR EACH ROW BEGIN
  update 
    inventarisasi 
  set
    kode_unit = new.unit_baru,
    kode_ruangan = new.ruang_baru,
    `kode_inventarisasi` = new.kode_inventarisasi_baru
   where id_inventarisasi=new.id_inventarisasi ;
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` int(11) NOT NULL,
  `kode_pengadaan` varchar(18) NOT NULL,
  `kode_barang` varchar(7) NOT NULL,
  `kode_cabang` varchar(3) NOT NULL,
  `kode_suplier` varchar(5) NOT NULL,
  `no_polisi` varchar(25) DEFAULT NULL,
  `no_bpkb` varchar(15) DEFAULT NULL,
  `no_sertifikat` varchar(60) DEFAULT NULL,
  `no_faktur` varchar(15) NOT NULL,
  `tgl_beli` date NOT NULL,
  `harga_beli` decimal(18,0) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sisa_jumlah` int(11) DEFAULT NULL,
  `user_posting` varchar(11) NOT NULL,
  `luas` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`id_pengadaan`, `kode_pengadaan`, `kode_barang`, `kode_cabang`, `kode_suplier`, `no_polisi`, `no_bpkb`, `no_sertifikat`, `no_faktur`, `tgl_beli`, `harga_beli`, `jumlah`, `sisa_jumlah`, `user_posting`, `luas`) VALUES
(1, 'BRS-800-0000000001', 'AST0002', '800', 'SP002', NULL, NULL, NULL, '200', '2013-10-15', '150000', 12, 5, 'admin', NULL),
(3, 'BRS-800-0000000002', 'AST0001', '800', 'SP002', NULL, NULL, NULL, '-', '2013-10-01', '0', 2, -4, 'admin', NULL),
(5, 'BRS-800-0000000003', 'AST0003', '800', 'SP002', NULL, NULL, NULL, '-', '2013-10-09', '0', 13, 10, 'admin', NULL),
(16, 'BRS-800-0000000005', 'AST0003', '800', '--Pil', '-', '-', '-', '092', '2013-11-14', '500000', 2, 2, 'admin', '-'),
(15, 'BRS-800-0000000004', 'AST0006', '800', 'SP001', NULL, NULL, NULL, '-', '2013-11-06', '222222', 2, -1, 'admin', NULL);

--
-- Triggers `pengadaan`
--
DELIMITER $$
CREATE TRIGGER `kembali_jumlahaset` AFTER DELETE ON `pengadaan` FOR EACH ROW BEGIN
	update aset set total_unit= (total_unit - old.jumlah) where kode_barang= old.kode_barang ;
    END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_aset` AFTER INSERT ON `pengadaan` FOR EACH ROW BEGIN
     update aset set total_unit= (total_unit + new.jumlah ) where (kode_barang=new.kode_barang)  ;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penyusutan`
--

CREATE TABLE `penyusutan` (
  `kode_barang` varchar(7) NOT NULL,
  `tgl_pengadaan` datetime NOT NULL,
  `kode_cabang` varchar(3) DEFAULT NULL,
  `jumlah_unit` decimal(18,0) DEFAULT NULL,
  `nilai_buku` decimal(18,0) DEFAULT NULL,
  `1` double DEFAULT NULL,
  `2` double DEFAULT NULL,
  `3` double DEFAULT NULL,
  `4` double DEFAULT NULL,
  `5` double DEFAULT NULL,
  `6` double DEFAULT NULL,
  `7` double DEFAULT NULL,
  `8` double DEFAULT NULL,
  `9` double DEFAULT NULL,
  `10` double DEFAULT NULL,
  `11` double DEFAULT NULL,
  `12` double DEFAULT NULL,
  `tahun_buku` decimal(18,0) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `kode_pengadaan` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penyusutan`
--

INSERT INTO `penyusutan` (`kode_barang`, `tgl_pengadaan`, `kode_cabang`, `jumlah_unit`, `nilai_buku`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `9`, `10`, `11`, `12`, `tahun_buku`, `status`, `kode_pengadaan`) VALUES
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000001'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2017', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020', '1', 'BRS-800-0000000002'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2017', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020', '1', 'BRS-800-0000000003'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000001'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2017', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020', '1', 'BRS-800-0000000002'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2017', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020', '1', 'BRS-800-0000000003'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000001'),
('AST0003', '2012-08-25 00:00:00', '800', '2', '9000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000001'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000002'),
('AST0001', '2012-08-25 00:00:00', '800', '1', '2000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2017', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019', '1', 'BRS-800-0000000002'),
('AST0002', '2012-08-25 00:00:00', '800', '2', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020', '1', 'BRS-800-0000000002'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2012', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2013', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2014', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2015', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2016', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2017', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2018', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2019', '1', 'BRS-800-0000000003'),
('AST0005', '2012-08-25 00:00:00', '800', '1', '4000000', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2020', '1', 'BRS-800-0000000003');

-- --------------------------------------------------------

--
-- Table structure for table `pertumbuhan`
--

CREATE TABLE `pertumbuhan` (
  `kode_barang` varchar(7) DEFAULT NULL,
  `kode_cabang` varchar(3) DEFAULT NULL,
  `tgl_pengadaan` datetime DEFAULT NULL,
  `jum_awal` decimal(18,0) DEFAULT NULL,
  `nilai_awal` double DEFAULT NULL,
  `jum_kurang` decimal(10,0) DEFAULT NULL,
  `nilai_kurang` double DEFAULT NULL,
  `jum_tambah` decimal(18,0) DEFAULT NULL,
  `nilai_tambah` double DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pertumbuhan`
--

INSERT INTO `pertumbuhan` (`kode_barang`, `kode_cabang`, `tgl_pengadaan`, `jum_awal`, `nilai_awal`, `jum_kurang`, `nilai_kurang`, `jum_tambah`, `nilai_tambah`, `status`) VALUES
('AST0003', '800', '2012-08-25 00:00:00', '2', 9000000, '0', 0, '0', 0, '1'),
('AST0001', '800', '2012-08-25 00:00:00', '1', 2000000, '0', 0, '0', 0, '1'),
('AST0002', '800', '2012-08-25 00:00:00', '2', 4000000, '0', 0, '0', 0, '1'),
('AST0005', '800', '2012-08-25 00:00:00', '1', 4000000, '0', 0, '0', 0, '1'),
('AST0003', '800', '2012-08-25 00:00:00', '2', 9000000, '0', 0, '0', 0, '1'),
('AST0001', '800', '2012-08-25 00:00:00', '1', 2000000, '0', 0, '0', 0, '1'),
('AST0002', '800', '2012-08-25 00:00:00', '2', 4000000, '0', 0, '0', 0, '1'),
('AST0005', '800', '2012-08-25 00:00:00', '1', 4000000, '0', 0, '0', 0, '1'),
('AST0003', '800', '2012-08-25 00:00:00', '2', 9000000, '0', 0, '0', 0, '1'),
('AST0001', '800', '2012-08-25 00:00:00', '1', 2000000, '0', 0, '0', 0, '1'),
('AST0002', '800', '2012-08-25 00:00:00', '2', 4000000, '0', 0, '0', 0, '1'),
('AST0005', '800', '2012-08-25 00:00:00', '1', 4000000, '0', 0, '0', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `kode_ruangan` varchar(6) NOT NULL,
  `nm_ruangan` varchar(30) NOT NULL,
  `keterangan` varchar(15) NOT NULL,
  `user_posting` varchar(11) DEFAULT NULL,
  `tgl_posting` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`kode_ruangan`, `nm_ruangan`, `keterangan`, `user_posting`, `tgl_posting`) VALUES
('RNG001', 'PELAYANAN NASABAH', 'PELNAS', 'ADMIN', '2012-08-25'),
('RNG002', 'BACK OFFICE', 'RUANG KERJA BAC', 'ADMIN', '2012-08-25'),
('RNG003', 'PEMIMPIN CABANG', 'RUANG PINCAB', 'ADMIN', '2012-08-25'),
('RNG004', 'MUSHOLA', 'RUANG MUSHOLA K', 'ADMIN', '2012-08-25'),
('RNG005', 'OUTDOOR', 'KENDERAAN', 'ADMIN', '2012-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status` int(11) NOT NULL DEFAULT '0',
  `nm_status` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status`, `nm_status`) VALUES
(1, 'BAIK'),
(2, 'RUSAK'),
(3, 'HILANG'),
(0, 'Lelang'),
(1, 'BAIK'),
(2, 'RUSAK'),
(3, 'HILANG'),
(0, 'Lelang'),
(1, 'BAIK'),
(2, 'RUSAK'),
(3, 'HILANG'),
(0, 'Lelang');

-- --------------------------------------------------------

--
-- Table structure for table `subgolongan`
--

CREATE TABLE `subgolongan` (
  `sub_golongan` varchar(4) NOT NULL,
  `kode_golongan` varchar(3) NOT NULL,
  `nm_subgolongan` varchar(50) NOT NULL,
  `tgl_posting` date NOT NULL,
  `user_posting` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subgolongan`
--

INSERT INTO `subgolongan` (`sub_golongan`, `kode_golongan`, `nm_subgolongan`, `tgl_posting`, `user_posting`) VALUES
('20', '6', 'MESIN KANTOR', '2012-08-10', 'admin'),
('21', '3', 'PERABOTAN KANTOR GOLONGAN 1', '2012-08-25', 'admin'),
('22', '3', 'MESIN KANTOR GOLONGAN 1', '2012-08-25', 'admin'),
('23', '3', 'KOMPUTER', '2012-08-25', 'admin'),
('24', '3', 'KENDERAAN RODA DUA', '2012-08-25', 'admin'),
('25', '4', 'PERABOTAN KANTOR GOLONGAN 2', '2012-08-25', 'admin'),
('26', '4', 'MESIN KANTOR GOLONGAN 2', '2012-08-25', 'admin'),
('27', '1', 'GEDUNG KANTOR', '2012-08-25', 'ADMIN'),
('28', '5', 'KENDERAAN RODA EMPAT', '2012-08-25', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `kode_suplier` varchar(5) NOT NULL,
  `nm_suplier` varchar(60) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `kota` varchar(35) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`kode_suplier`, `nm_suplier`, `alamat`, `kota`, `telepon`) VALUES
('SP001', 'MEGA KOMPUTER', 'PEKANBARU', 'RIAU', '908908'),
('SP002', 'PLAZA MEBEL', 'DUMAI', 'DUMAI', '07685646'),
('SP003', 'SARANA TEKNISI', 'JL.HANGTUAH IV NO.38 B', 'PEKANBARU', '909090'),
('SP004', 'BATAM JAYA ELEKTRONIK', 'JL.TUANKU TAMBUSAI', 'PEKANBARU', '345678'),
('SP005', 'PT ANGKASA PURA', 'Jln. Ahmad Yani NO. 30', 'PALEMBANG', '071100788');

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_combosubgol`
-- (See below for the actual view)
--
CREATE TABLE `tampil_combosubgol` (
`kode_golongan` varchar(3)
,`sub_golongan` varchar(4)
,`nm_subgolongan` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_detail_pengadaan`
-- (See below for the actual view)
--
CREATE TABLE `tampil_detail_pengadaan` (
`id_pengadaan` int(11)
,`kode_pengadaan` varchar(18)
,`kode_barang` varchar(7)
,`kode_suplier` varchar(5)
,`nm_barang` varchar(40)
,`jumlah` int(11)
,`harga_beli` decimal(18,0)
,`total` decimal(28,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_golongan`
-- (See below for the actual view)
--
CREATE TABLE `tampil_golongan` (
`kode_golongan` varchar(3)
,`kode_harta` int(11)
,`nm_golongan` varchar(30)
,`keterangan` varchar(20)
,`persen_susut` double
,`masa_manfaat` int(11)
,`tgl_posting` date
,`user_posting` varchar(11)
,`Jenis Harta` varchar(25)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_history`
-- (See below for the actual view)
--
CREATE TABLE `tampil_history` (
`id_history` int(11)
,`kode_inventarisasi` varchar(30)
,`status_before` int(2)
,`status_sebelum` varchar(10)
,`status_after` int(2)
,`status_sesudah` varchar(10)
,`tgl_ubah` date
,`keterangan_ubah` longtext
,`user_ubah` varchar(13)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_inventaris`
-- (See below for the actual view)
--
CREATE TABLE `tampil_inventaris` (
`kode_barang` varchar(7)
,`nm_barang` varchar(40)
,`kode_golongan` varchar(3)
,`sub_golongan` int(11)
,`merk` varchar(20)
,`tipe` varchar(35)
,`tahun` varchar(4)
,`volume` varchar(15)
,`tgl_entry` date
,`user_posting` varchar(10)
,`total_unit` decimal(18,0)
,`masa_servis` int(11)
,`poto` varchar(100)
,`nm_golongan` varchar(30)
,`nm_subgolongan` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_inventarisasi`
-- (See below for the actual view)
--
CREATE TABLE `tampil_inventarisasi` (
`kode_inventarisasi` varchar(30)
,`id_inventarisasi` int(11)
,`kode_barang` varchar(7)
,`kode_pengadaan` varchar(18)
,`nm_barang` varchar(40)
,`kode_cabang` varchar(3)
,`nm_cabang` varchar(35)
,`kode_ruangan` varchar(6)
,`nm_ruangan` varchar(30)
,`kode_unit` int(11)
,`nm_unit` varchar(30)
,`jumlah` decimal(10,0)
,`kondisi` varchar(15)
,`status` int(11)
,`nm_status` varchar(10)
,`tgl_posting` date
,`user_posting` varchar(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_inventarisasi_cari_brg`
-- (See below for the actual view)
--
CREATE TABLE `tampil_inventarisasi_cari_brg` (
`id_pengadaan` int(11)
,`kode_pengadaan` varchar(18)
,`kode_barang` varchar(7)
,`nm_barang` varchar(40)
,`kode_cabang` varchar(3)
,`total_unit` decimal(18,0)
,`sisa_jumlah` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_mutasi`
-- (See below for the actual view)
--
CREATE TABLE `tampil_mutasi` (
`id_mutasi` int(11)
,`tgl_mutasi` date
,`kode_aset` varchar(7)
,`nm_barang` varchar(40)
,`ruanglama` varchar(30)
,`ruangbaru` varchar(30)
,`unitlama` varchar(30)
,`unitbaru` varchar(30)
,`user_posting` varchar(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_mutasi_cari_brg`
-- (See below for the actual view)
--
CREATE TABLE `tampil_mutasi_cari_brg` (
`kode_inventarisasi` varchar(30)
,`id_inventarisasi` int(11)
,`kode_barang` varchar(7)
,`kode_pengadaan` varchar(18)
,`nm_barang` varchar(40)
,`kode_cabang` varchar(3)
,`nm_cabang` varchar(35)
,`kode_ruangan` varchar(6)
,`nm_ruangan` varchar(30)
,`kode_unit` int(11)
,`nm_unit` varchar(30)
,`jumlah` decimal(10,0)
,`kondisi` varchar(15)
,`nm_status` varchar(10)
,`status` int(11)
,`tgl_posting` date
,`user_posting` varchar(11)
,`merk` varchar(20)
,`tipe` varchar(35)
,`tgl_entry` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_pengadaan`
-- (See below for the actual view)
--
CREATE TABLE `tampil_pengadaan` (
`id_pengadaan` int(11)
,`kode_pengadaan` varchar(18)
,`kode_barang` varchar(7)
,`nm_barang` varchar(40)
,`kode_suplier` varchar(5)
,`nm_suplier` varchar(60)
,`jumlah` int(11)
,`harga_beli` decimal(18,0)
,`luas` varchar(15)
,`no_bpkb` varchar(15)
,`no_faktur` varchar(15)
,`no_polisi` varchar(25)
,`no_sertifikat` varchar(60)
,`sisa_jumlah` int(11)
,`tgl_beli` date
,`user_posting` varchar(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `tampil_subgolongan`
-- (See below for the actual view)
--
CREATE TABLE `tampil_subgolongan` (
`sub_golongan` varchar(4)
,`kode_golongan` varchar(3)
,`nm_subgolongan` varchar(50)
,`tgl_posting` date
,`user_posting` varchar(11)
,`nm_golongan` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `kode_unit` varchar(5) NOT NULL DEFAULT '0',
  `nm_unit` varchar(30) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `user_posting` varchar(11) DEFAULT NULL,
  `tgl_posting` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`kode_unit`, `nm_unit`, `keterangan`, `user_posting`, `tgl_posting`) VALUES
('1', 'PELAYANAN NASABAH', 'PELNAS', 'ADMIN', '2012-08-25'),
('2', 'BACK OFFICE', '', 'ADMIN', '2012-08-25'),
('3', 'MANAJER', '-', 'ADMIN', '2012-08-25'),
('4', 'OPERASIONAL', 'OPERASIONAL', NULL, '2012-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(10) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `level` varchar(15) NOT NULL,
  `kode_cabang` varchar(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `user_name`, `password`, `level`, `kode_cabang`) VALUES
(1, 'admin', 'admin', 'admin', '800'),
(2, 'taufik', 'taufik', 'user', '820'),
(3, 'ozan87', '111', 'admin', '800');

-- --------------------------------------------------------

--
-- Structure for view `tampil_combosubgol`
--
DROP TABLE IF EXISTS `tampil_combosubgol`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_combosubgol`  AS  select `golongan`.`kode_golongan` AS `kode_golongan`,`subgolongan`.`sub_golongan` AS `sub_golongan`,`subgolongan`.`nm_subgolongan` AS `nm_subgolongan` from (`subgolongan` join `golongan` on((`subgolongan`.`kode_golongan` = `golongan`.`kode_golongan`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_detail_pengadaan`
--
DROP TABLE IF EXISTS `tampil_detail_pengadaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_detail_pengadaan`  AS  (select `pengadaan`.`id_pengadaan` AS `id_pengadaan`,`pengadaan`.`kode_pengadaan` AS `kode_pengadaan`,`aset`.`kode_barang` AS `kode_barang`,`pengadaan`.`kode_suplier` AS `kode_suplier`,`aset`.`nm_barang` AS `nm_barang`,`pengadaan`.`jumlah` AS `jumlah`,`pengadaan`.`harga_beli` AS `harga_beli`,(`pengadaan`.`jumlah` * `pengadaan`.`harga_beli`) AS `total` from (`pengadaan` join `aset` on((`pengadaan`.`kode_barang` = `aset`.`kode_barang`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_golongan`
--
DROP TABLE IF EXISTS `tampil_golongan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_golongan`  AS  select `golongan`.`kode_golongan` AS `kode_golongan`,`golongan`.`kode_harta` AS `kode_harta`,`golongan`.`nm_golongan` AS `nm_golongan`,`golongan`.`keterangan` AS `keterangan`,`golongan`.`persen_susut` AS `persen_susut`,`golongan`.`masa_manfaat` AS `masa_manfaat`,`golongan`.`tgl_posting` AS `tgl_posting`,`golongan`.`user_posting` AS `user_posting`,`harta_berwujud`.`nm_harta` AS `Jenis Harta` from (`harta_berwujud` join `golongan` on((`harta_berwujud`.`kode_harta` = `golongan`.`kode_harta`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_history`
--
DROP TABLE IF EXISTS `tampil_history`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_history`  AS  (select `h`.`id_history` AS `id_history`,`h`.`kode_inventarisasi` AS `kode_inventarisasi`,`h`.`status_before` AS `status_before`,`s`.`nm_status` AS `status_sebelum`,`h`.`status_after` AS `status_after`,`a`.`nm_status` AS `status_sesudah`,`h`.`tgl_ubah` AS `tgl_ubah`,`h`.`keterangan_ubah` AS `keterangan_ubah`,`h`.`user_ubah` AS `user_ubah` from ((`history_ubah` `h` join `status` `s` on((`h`.`status_before` = `s`.`status`))) join `status` `a` on((`h`.`status_after` = `a`.`status`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_inventaris`
--
DROP TABLE IF EXISTS `tampil_inventaris`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_inventaris`  AS  select `aset`.`kode_barang` AS `kode_barang`,`aset`.`nm_barang` AS `nm_barang`,`aset`.`kode_golongan` AS `kode_golongan`,`aset`.`sub_golongan` AS `sub_golongan`,`aset`.`merk` AS `merk`,`aset`.`tipe` AS `tipe`,`aset`.`tahun` AS `tahun`,`aset`.`volume` AS `volume`,`aset`.`tgl_entry` AS `tgl_entry`,`aset`.`user_posting` AS `user_posting`,`aset`.`total_unit` AS `total_unit`,`aset`.`masa_servis` AS `masa_servis`,`aset`.`poto` AS `poto`,`golongan`.`nm_golongan` AS `nm_golongan`,`subgolongan`.`nm_subgolongan` AS `nm_subgolongan` from ((`golongan` join `aset` on((`golongan`.`kode_golongan` = `aset`.`kode_golongan`))) join `subgolongan` on((`golongan`.`kode_golongan` = `subgolongan`.`kode_golongan`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_inventarisasi`
--
DROP TABLE IF EXISTS `tampil_inventarisasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_inventarisasi`  AS  (select `i`.`kode_inventarisasi` AS `kode_inventarisasi`,`i`.`id_inventarisasi` AS `id_inventarisasi`,`i`.`kode_barang` AS `kode_barang`,`p`.`kode_pengadaan` AS `kode_pengadaan`,`a`.`nm_barang` AS `nm_barang`,`i`.`kode_cabang` AS `kode_cabang`,`c`.`nm_cabang` AS `nm_cabang`,`i`.`kode_ruangan` AS `kode_ruangan`,`r`.`nm_ruangan` AS `nm_ruangan`,`i`.`kode_unit` AS `kode_unit`,`u`.`nm_unit` AS `nm_unit`,`i`.`jumlah` AS `jumlah`,`i`.`kondisi` AS `kondisi`,`i`.`status` AS `status`,`s`.`nm_status` AS `nm_status`,`i`.`tgl_posting` AS `tgl_posting`,`i`.`user_posting` AS `user_posting` from ((((((`inventarisasi` `i` join `pengadaan` `p` on((`i`.`kode_pengadaan` = `p`.`kode_pengadaan`))) join `aset` `a` on((`p`.`kode_barang` = `a`.`kode_barang`))) join `cabang` `c` on((`i`.`kode_cabang` = `c`.`kode_cabang`))) join `ruangan` `r` on((`i`.`kode_ruangan` = `r`.`kode_ruangan`))) join `unit_kerja` `u` on((`i`.`kode_unit` = `u`.`kode_unit`))) join `status` `s` on((`i`.`status` = `s`.`status`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_inventarisasi_cari_brg`
--
DROP TABLE IF EXISTS `tampil_inventarisasi_cari_brg`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_inventarisasi_cari_brg`  AS  (select `p`.`id_pengadaan` AS `id_pengadaan`,`p`.`kode_pengadaan` AS `kode_pengadaan`,`p`.`kode_barang` AS `kode_barang`,`a`.`nm_barang` AS `nm_barang`,`p`.`kode_cabang` AS `kode_cabang`,`a`.`total_unit` AS `total_unit`,`p`.`sisa_jumlah` AS `sisa_jumlah` from (`pengadaan` `p` join `aset` `a` on((`p`.`kode_barang` = `a`.`kode_barang`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_mutasi`
--
DROP TABLE IF EXISTS `tampil_mutasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_mutasi`  AS  (select `m`.`id_mutasi` AS `id_mutasi`,`m`.`tgl_mutasi` AS `tgl_mutasi`,`m`.`kode_aset` AS `kode_aset`,`a`.`nm_barang` AS `nm_barang`,`r`.`nm_ruangan` AS `ruanglama`,`rb`.`nm_ruangan` AS `ruangbaru`,`u`.`nm_unit` AS `unitlama`,`ub`.`nm_unit` AS `unitbaru`,`m`.`user_posting` AS `user_posting` from ((((((`mutasi` `m` join `inventarisasi` `i` on((`m`.`kode_inventarisasi_baru` = `i`.`kode_inventarisasi`))) join `aset` `a` on((`a`.`kode_barang` = `m`.`kode_aset`))) join `ruangan` `r` on((`r`.`kode_ruangan` = `m`.`ruang_lama`))) join `ruangan` `rb` on((`rb`.`kode_ruangan` = `i`.`kode_ruangan`))) join `unit_kerja` `u` on((`u`.`kode_unit` = `m`.`unit_lama`))) join `unit_kerja` `ub` on((`ub`.`kode_unit` = `i`.`kode_unit`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_mutasi_cari_brg`
--
DROP TABLE IF EXISTS `tampil_mutasi_cari_brg`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_mutasi_cari_brg`  AS  (select `ti`.`kode_inventarisasi` AS `kode_inventarisasi`,`ti`.`id_inventarisasi` AS `id_inventarisasi`,`ti`.`kode_barang` AS `kode_barang`,`ti`.`kode_pengadaan` AS `kode_pengadaan`,`ti`.`nm_barang` AS `nm_barang`,`ti`.`kode_cabang` AS `kode_cabang`,`ti`.`nm_cabang` AS `nm_cabang`,`ti`.`kode_ruangan` AS `kode_ruangan`,`ti`.`nm_ruangan` AS `nm_ruangan`,`ti`.`kode_unit` AS `kode_unit`,`ti`.`nm_unit` AS `nm_unit`,`ti`.`jumlah` AS `jumlah`,`ti`.`kondisi` AS `kondisi`,`ti`.`nm_status` AS `nm_status`,`ti`.`status` AS `status`,`ti`.`tgl_posting` AS `tgl_posting`,`ti`.`user_posting` AS `user_posting`,`a`.`merk` AS `merk`,`a`.`tipe` AS `tipe`,`a`.`tgl_entry` AS `tgl_entry` from (`tampil_inventarisasi` `ti` join `aset` `a` on((`ti`.`kode_barang` = `a`.`kode_barang`)))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_pengadaan`
--
DROP TABLE IF EXISTS `tampil_pengadaan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_pengadaan`  AS  select `pengadaan`.`id_pengadaan` AS `id_pengadaan`,`pengadaan`.`kode_pengadaan` AS `kode_pengadaan`,`pengadaan`.`kode_barang` AS `kode_barang`,`aset`.`nm_barang` AS `nm_barang`,`suplier`.`kode_suplier` AS `kode_suplier`,`suplier`.`nm_suplier` AS `nm_suplier`,`pengadaan`.`jumlah` AS `jumlah`,`pengadaan`.`harga_beli` AS `harga_beli`,`pengadaan`.`luas` AS `luas`,`pengadaan`.`no_bpkb` AS `no_bpkb`,`pengadaan`.`no_faktur` AS `no_faktur`,`pengadaan`.`no_polisi` AS `no_polisi`,`pengadaan`.`no_sertifikat` AS `no_sertifikat`,`pengadaan`.`sisa_jumlah` AS `sisa_jumlah`,`pengadaan`.`tgl_beli` AS `tgl_beli`,`pengadaan`.`user_posting` AS `user_posting` from ((`aset` join `pengadaan` on((`aset`.`kode_barang` = `pengadaan`.`kode_barang`))) join `suplier` on((`suplier`.`kode_suplier` = `pengadaan`.`kode_suplier`))) ;

-- --------------------------------------------------------

--
-- Structure for view `tampil_subgolongan`
--
DROP TABLE IF EXISTS `tampil_subgolongan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `tampil_subgolongan`  AS  select `subgolongan`.`sub_golongan` AS `sub_golongan`,`subgolongan`.`kode_golongan` AS `kode_golongan`,`subgolongan`.`nm_subgolongan` AS `nm_subgolongan`,`subgolongan`.`tgl_posting` AS `tgl_posting`,`subgolongan`.`user_posting` AS `user_posting`,`golongan`.`nm_golongan` AS `nm_golongan` from (`subgolongan` join `golongan` on((`subgolongan`.`kode_golongan` = `golongan`.`kode_golongan`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `aset_kode_golongan` (`kode_golongan`),
  ADD KEY `aset_sub_golongan` (`sub_golongan`);

--
-- Indexes for table `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`kode_cabang`);

--
-- Indexes for table `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`kode_golongan`);

--
-- Indexes for table `harta_berwujud`
--
ALTER TABLE `harta_berwujud`
  ADD PRIMARY KEY (`kode_harta`);

--
-- Indexes for table `history_ubah`
--
ALTER TABLE `history_ubah`
  ADD KEY `id_history` (`id_history`);

--
-- Indexes for table `inventarisasi`
--
ALTER TABLE `inventarisasi`
  ADD KEY `id_inventarisasi` (`id_inventarisasi`);

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD KEY `id_pemeliharaan` (`id_pemeliharaan`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id_mutasi`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`kode_ruangan`);

--
-- Indexes for table `subgolongan`
--
ALTER TABLE `subgolongan`
  ADD PRIMARY KEY (`sub_golongan`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`kode_suplier`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`kode_unit`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_ubah`
--
ALTER TABLE `history_ubah`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `inventarisasi`
--
ALTER TABLE `inventarisasi`
  MODIFY `id_inventarisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id_pemeliharaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
