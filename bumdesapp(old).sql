-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2020 at 08:13 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumdesapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(15) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kategori` varchar(10) DEFAULT NULL,
  `kontak` varchar(15) DEFAULT NULL,
  `waktu_reg` datetime NOT NULL,
  `status_akt` varchar(10) DEFAULT NULL,
  `waktu_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `kategori`, `kontak`, `waktu_reg`, `status_akt`, `waktu_login`) VALUES
('0081578813144', 'Tiyo BUMDes', 'tibumdes', '25d55ad283aa400af464c76d713c07ad', 'MNG', '0000-0000-0000', '0000-00-00 00:00:00', NULL, NULL),
('0081578813175', 'Tiyo BUMDes', 'tibumdes', '25d55ad283aa400af464c76d713c07ad', 'MNG', '0000-0000-0000', '0000-00-00 00:00:00', NULL, NULL),
('0081578813229', 'Tiyo BUMDes', 'tibumdes', '25d55ad283aa400af464c76d713c07ad', 'GOV', '0000-0000-0000', '0000-00-00 00:00:00', NULL, NULL),
('0081578813430', 'Tiyo BUMDes', 'tibumdes', '25d55ad283aa400af464c76d713c07ad', 'MNG', '0000-0000-0000', '0000-00-00 00:00:00', 'Aktif', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` varchar(15) NOT NULL,
  `nomor_aset` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `sumber` varchar(10) NOT NULL,
  `harga_aset` int(11) DEFAULT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kondisi` varchar(10) NOT NULL,
  `keadaan` varchar(10) NOT NULL,
  `gambar` varchar(15) DEFAULT NULL,
  `kepemilikan` varchar(5) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `ket_aset` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id_aset`, `nomor_aset`, `nama`, `sumber`, `harga_aset`, `lokasi`, `kondisi`, `keadaan`, `gambar`, `kepemilikan`, `tanggal_masuk`, `ket_aset`) VALUES
('0051578736008', 'ASET/2019/BELI/MNG/BARU', 'Excavator', 'Non-beli', NULL, 'Dusun kalipuru, Kebumen', 'Baru', 'Baik', NULL, 'Ya', '2019-05-20', NULL),
('0051578813210', 'ASET/2019/BELI/MNG', 'Buldozer', 'Beli', 6000000, 'Dusun kalipuru, Kebumen', 'Baru', 'Baik', NULL, 'Ya', '2020-01-01', '');

-- --------------------------------------------------------

--
-- Table structure for table `aset_disewakan`
--

CREATE TABLE `aset_disewakan` (
  `id_aset_sewa` varchar(15) NOT NULL,
  `aset` varchar(15) NOT NULL,
  `harga_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bagi_hasil_aset`
--

CREATE TABLE `bagi_hasil_aset` (
  `id_bgh` varchar(15) NOT NULL,
  `deld_aset` varchar(100) DEFAULT NULL,
  `aset` varchar(15) DEFAULT NULL,
  `aset_luar` varchar(100) DEFAULT NULL,
  `mitra` varchar(15) NOT NULL,
  `pers_bumdes` int(11) NOT NULL,
  `pers_mitra` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagi_hasil_aset`
--

INSERT INTO `bagi_hasil_aset` (`id_bgh`, `deld_aset`, `aset`, `aset_luar`, `mitra`, `pers_bumdes`, `pers_mitra`, `tanggal_mulai`, `tanggal_selesai`) VALUES
('0041578735572', NULL, '0051578736008', NULL, '0071578756545', 60, 40, '2020-01-02', '2020-01-06'),
('0041578735576', NULL, '0051578813210', NULL, '0071578756545', 75, 25, '2020-01-03', '2020-01-07');

-- --------------------------------------------------------

--
-- Table structure for table `dividen_profit`
--

CREATE TABLE `dividen_profit` (
  `id_div` varchar(15) NOT NULL,
  `tujuan_div` varchar(100) NOT NULL,
  `pers_jumlah_div` int(11) NOT NULL,
  `jumlah_div` int(11) DEFAULT NULL,
  `tahun_div` varchar(5) NOT NULL,
  `status_div` varchar(6) DEFAULT NULL,
  `tanggal_bayar_div` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dividen_profit`
--

INSERT INTO `dividen_profit` (`id_div`, `tujuan_div`, `pers_jumlah_div`, `jumlah_div`, `tahun_div`, `status_div`, `tanggal_bayar_div`) VALUES
('0091578813144', 'Desa pujotirto', 20, 2000000, '2019', 'BAYAR', '2019-12-05 05:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `histori_harga_komoditas`
--

CREATE TABLE `histori_harga_komoditas` (
  `id_temp` int(11) NOT NULL,
  `komoditas` varchar(15) NOT NULL,
  `jenis` varchar(5) NOT NULL,
  `harga_lama` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_harga_komoditas`
--

INSERT INTO `histori_harga_komoditas` (`id_temp`, `komoditas`, `jenis`, `harga_lama`, `tanggal`) VALUES
(6, '0071578758398', 'BELI', 20000, '2020-01-14'),
(7, '0071578758398', 'JUAL', 40000, '2020-01-14'),
(8, '0071578758392', 'BELI', 80000, '2020-01-14'),
(9, '0071578758395', 'BELI', 140000, '2020-01-23'),
(10, '0071578758395', 'JUAL', 200000, '2020-01-23'),
(11, '0071578758395', 'BELI', 140000, '2020-01-23'),
(12, '0071578758395', 'BELI', 140000, '2020-01-23'),
(13, '0071580104977', 'BELI', 20000, '2020-01-27'),
(14, '0071580104977', 'JUAL', 40000, '2020-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `histori_harga_sewa`
--

CREATE TABLE `histori_harga_sewa` (
  `id_temp` int(11) NOT NULL,
  `aset_disewakan` varchar(15) DEFAULT NULL,
  `harga_lama` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_harga_sewa`
--

INSERT INTO `histori_harga_sewa` (`id_temp`, `aset_disewakan`, `harga_lama`, `tanggal`) VALUES
(1, 'ASW001', 100000, '2020-01-02'),
(2, 'ASW001', 50000, '2020-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `komoditas`
--

CREATE TABLE `komoditas` (
  `id_kom` varchar(15) NOT NULL,
  `nama_komoditas` varchar(30) NOT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `sat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komoditas`
--

INSERT INTO `komoditas` (`id_kom`, `nama_komoditas`, `harga_jual`, `harga_beli`, `sat`) VALUES
('0071578758391', 'Bon cabe', 20000, 15000, 1),
('0071578758392', 'Plutonium', 100000, 60000, 2),
('0071578758393', 'Uranium', 50000, 30000, 3),
('0071578758394', 'Batu bara', 500000, 300000, 4),
('0071578758395', 'Kobalt', 200000, 140000, 5),
('0071578758396', 'Gandum', 50000, 30000, 1),
('0071578758398', 'Telur', 70000, 50000, 1),
('0071580104977', 'Kuaci', 40000, 20000, 1),
('0071580114865', 'Minyak bumi', 200000, 120000, 4);

--
-- Triggers `komoditas`
--
DELIMITER $$
CREATE TRIGGER `perubahan_harga` AFTER UPDATE ON `komoditas` FOR EACH ROW BEGIN

    IF new.harga_beli <> old.harga_beli OR old.harga_beli <> '' THEN
    	INSERT INTO `histori_harga_komoditas` (`komoditas`, `jenis`, `harga_lama`, `tanggal`) VALUES (new.id_kom, 'BELI', old.harga_beli, NOW());
    END IF;
    
    IF new.harga_jual <> old.harga_jual OR old.harga_jual <> '' THEN
    	INSERT INTO `histori_harga_komoditas` (`komoditas`, `jenis`, `harga_lama`, `tanggal`) VALUES (new.id_kom, 'JUAL', old.harga_jual, NOW());
    END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_admin`
--

CREATE TABLE `log_admin` (
  `id_temp` int(11) NOT NULL,
  `log` text NOT NULL,
  `admin` varchar(15) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_admin`
--

INSERT INTO `log_admin` (`id_temp`, `log`, `admin`, `tanggal`, `waktu`) VALUES
(1, '[CREATE] [ADMIN] menambah admin baru', 'ADM001', '2019-12-11', '06:06:13'),
(2, '[UPDATE] [PERDAGANGAN] mengubah data transaksi dengan nomor transaksi TRS001', 'ADM003', '2019-12-18', '10:08:09'),
(3, '[DELETE][PERDAGANGAN] menghapus data distribusi dengan nomor distribusi DTR005', 'ADM002', '2019-12-11', '24:20:26'),
(4, '[TAMBAH][ADMIN] admin bernama Tiyo BUMDes', '00890989876', '2020-01-12', '14:12:24'),
(5, '[TAMBAH][ADMIN] penambahan admin bernama Tiyo BUMDes', '00890989876', '2020-01-12', '14:12:56'),
(6, '[TAMBAH][ADMIN] penambahan admin bernama Tiyo BUMDes', '00890989876', '2020-01-12', '14:13:49'),
(7, '[TAMBAH][ADMIN] penambahan admin bernama Tiyo BUMDes', '00890989876', '2020-01-12', '14:17:11'),
(8, '[TAMBAH][LOGISTIK] Penambahan stok masuk Bon cabe sebanyak 50 Kg dengan cara Non-beli', '0081578813144', '2020-01-25', '21:07:18'),
(9, '[TAMBAH][LOGISTIK] Penambahan stok masuk Bon cabe sebanyak 50 Kg dengan cara Beli', '0081578813144', '2020-01-25', '21:08:43'),
(10, '[KELUAR][BARANG] Stok Bon cabe keluar sebanyak 10 Kg untuk Distribusi kepada PT. Maju kena mundur ke', '0081578813144', '2020-01-27', '15:00:56'),
(11, '[KELUAR][BARANG] Stok Bon cabe keluar sebanyak 20 Kg untuk Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', '0081578813144', '2020-01-27', '15:06:47'),
(12, '[KELUAR][BARANG] Stok Bon cabe keluar sebanyak 40 Kg untuk Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', '0081578813144', '2020-01-27', '15:12:11'),
(13, '[KELUAR][BARANG] Stok Bon cabe keluar sebanyak 15 Kg untuk Non-distribusi', '0081578813144', '2020-01-27', '15:14:16'),
(14, '[KELUAR][BARANG] Stok Bon cabe keluar sebanyak 16 Kg untuk Non-distribusi', '0081578813144', '2020-01-27', '15:16:43'),
(15, '[KELUAR][BARANG] Stok Bon cabe keluar sebanyak 17 Kg untuk Non-distribusi', '0081578813144', '2020-01-27', '15:17:09'),
(16, '[KELUAR][BARANG] Stok Bon cabe keluar sebanyak 18 Kg untuk Non-distribusi', '0081578813144', '2020-01-27', '15:25:29'),
(17, '[KELUAR][BARANG] Stok Bon cabe keluar sebanyak 18 Kg untuk Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', '0081578813144', '2020-01-27', '15:28:38'),
(18, '[TAMBAH][KOMODITAS] Penambahan komoditas baruMinyak bumi', '0081578813144', '2020-01-27', '15:46:49'),
(19, '[TAMBAH][KOMODITAS] Penambahan komoditas baru Minyak bumi', '0081578813144', '2020-01-27', '15:47:45'),
(20, '[TAMBAH][PENYEWAAN] Penyewaan aset Excavator mulai dari 2020-01-27 selama 9 oleh Robert', '0081578813144', '2020-01-27', '16:54:08'),
(21, '[TAMBAH][PENYEWAAN] Penyewaan aset Buldozer mulai dari 27-01-2020 selama 5 oleh Robert', '0081578813144', '2020-01-27', '16:56:24'),
(22, '[TAMBAH][PENYEWAAN] Penyewaan aset Excavator mulai dari 27-01-2020 selama 5 oleh Robert Downey jr', '0081578813144', '2020-01-27', '16:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` varchar(15) NOT NULL,
  `nama_mitra` varchar(50) NOT NULL,
  `penanggung_jawab` varchar(30) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kontak_1` varchar(50) NOT NULL,
  `kontak_2` varchar(20) DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nama_mitra`, `penanggung_jawab`, `alamat`, `kontak_1`, `kontak_2`, `status`) VALUES
('0071578756545', 'PT. Maju kena mundur kena (Persero) Tbk', 'Diego maradona | Edited', 'Jln. Jenderal Sudirman, Jakarta Utara, Indonesia | Edited', '09098768564300', NULL, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pemb_bagi_hasil`
--

CREATE TABLE `pemb_bagi_hasil` (
  `id_temp` int(11) NOT NULL,
  `id_bagi` varchar(15) DEFAULT NULL,
  `bumdes` int(11) NOT NULL,
  `mitra` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `catatan` varchar(100) NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemb_bagi_hasil`
--

INSERT INTO `pemb_bagi_hasil` (`id_temp`, `id_bagi`, `bumdes`, `mitra`, `jumlah`, `catatan`, `tanggal_bayar`) VALUES
(6, '0041578735572', 0, 0, 500000, 'Pembayaran ke 1', '2020-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_sewa` varchar(15) NOT NULL,
  `deld_aset` varchar(100) DEFAULT NULL,
  `aset` varchar(15) DEFAULT NULL,
  `penyewa` varchar(50) NOT NULL,
  `kontak` varchar(20) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rekap_keuangan`
--

CREATE TABLE `rekap_keuangan` (
  `id_fin` varchar(15) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `debit` int(11) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL,
  `sld` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `last_change` datetime NOT NULL,
  `foreg_id` varchar(15) DEFAULT NULL,
  `actor` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekap_keuangan`
--

INSERT INTO `rekap_keuangan` (`id_fin`, `jenis`, `keterangan`, `debit`, `kredit`, `sld`, `tanggal`, `last_change`, `foreg_id`, `actor`) VALUES
('0061578749927', 'IN', 'Pemasukan dana suntikan dari desa', 500000, NULL, 1000000, '2019-05-20', '2020-01-11 20:38:47', NULL, 'User'),
('0061578749943', 'IN', 'Penerimaan bagi hasil dari suparman', 500000, NULL, 1500000, '2019-05-20', '2020-01-11 20:39:03', NULL, 'System'),
('0061578749969', 'IN', 'Penerimaan penyewaan aset', 500000, NULL, 2000000, '2019-05-20', '2020-01-11 20:39:29', NULL, 'System'),
('0061578749987', 'OUT', 'Pembayaran cicilan | Edited', NULL, 50000, 1950000, '2019-05-20', '2020-01-20 21:51:48', NULL, 'User'),
('0061579961323', 'OUT', 'Pembelian/stok masuk Bon cabe sebanyak 50 Kg', NULL, 500000, 1450000, '2020-01-25', '2020-01-25 21:08:43', '0011579961323', 'System'),
('0061580112056', 'IN', 'Penerimaan dari penjualan Bon cabe sebanyak 10 Kg untuk tujuan Distribusi kepada PT. Maju kena mundu', 200000, NULL, 1650000, '2020-01-27', '2020-01-27 15:00:56', '0011580112055', 'System'),
('0061580112407', 'IN', 'Penerimaan dari penjualan Bon cabe sebanyak 20 Kg untuk tujuan Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', 300000, NULL, 1950000, '2020-01-27', '2020-01-27 15:06:47', '0011580112407', 'System'),
('0061580113718', 'IN', 'Penerimaan dari penjualan Bon cabe sebanyak 18 Kg untuk tujuan Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', 800000, NULL, 2750000, '2020-01-27', '2020-01-27 15:28:38', '0011580113717', 'System'),
('0061580118848', 'IN', 'Penerimaan dari sewa aset Excavator mulai dari 2020-01-27 selama 9 oleh Robert', 630000, NULL, 3380000, '2020-01-27', '2020-01-27 16:54:08', '0021580118848', 'System'),
('0061580118984', 'IN', 'Penerimaan dari sewa aset Buldozer mulai dari 27-01-2020 selama 5 oleh Robert', 2000000, NULL, 5380000, '2020-01-27', '2020-01-27 16:56:24', '0021580118983', 'System');

--
-- Triggers `rekap_keuangan`
--
DELIMITER $$
CREATE TRIGGER `perubahan_rekap_keuangan` BEFORE UPDATE ON `rekap_keuangan` FOR EACH ROW BEGIN

	DECLARE last_saldo int;
    DECLARE jumlah_row varchar(15);
    DECLARE temp_nil int;
    
    SET last_saldo = (SELECT sld FROM rekap_keuangan ORDER BY last_change DESC LIMIT 1);
    SET jumlah_row = (SELECT COUNT(id_fin) FROM rekap_keuangan ORDER BY last_change);
    
    IF new.debit <> old.debit OR new.kredit <> old.kredit THEN
        IF jumlah_row = 1 THEN
            IF new.jenis = 'IN' THEN
                SET new.sld = new.debit;
            ELSE 
                SET new.sld = new.kredit;
            END IF;
        ELSE
            IF new.jenis = 'IN' AND new.debit > old.debit THEN
                SET temp_nil = new.debit - old.debit;
                SET new.sld = last_saldo + temp_nil;
            ELSEIF new.jenis = 'IN' AND new.debit < old.debit THEN
                SET temp_nil = old.debit - new.debit;
                SET new.sld = last_saldo - temp_nil;
            ELSEIF new.jenis = 'OUT' AND new.kredit > old.kredit THEN
                SET temp_nil = new.kredit - old.kredit;
                SET new.sld = last_saldo - temp_nil;
             ELSEIF new.jenis = 'OUT' AND new.kredit < old.kredit THEN
                SET temp_nil = old.kredit - new.kredit;
                SET new.sld = last_saldo + temp_nil;
             END IF;
            -- UPDATE `rekap_keuangan` SET `sld` = temp_nil WHERE `rekap_keuangan`.`id_fin` = last_id; --
          END IF;
          SET new.last_change = NOW();
      END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_saldo` BEFORE INSERT ON `rekap_keuangan` FOR EACH ROW BEGIN
	DECLARE saldo int;
    DECLARE r int;
    
    SET saldo = (select sld from rekap_keuangan order by last_change desc limit 1);
    SET r = (select count(sld) from rekap_keuangan order by last_change desc limit 1);
    
    IF(r=0) THEN
    	SET new.sld=new.debit;
    ELSE
    	IF(new.jenis='IN') THEN
        	SET new.sld = saldo + new.debit;
        ELSE 
        	SET new.sld = saldo - new.kredit;
        END IF;
     END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id` int(11) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `ket_satuan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id`, `satuan`, `ket_satuan`) VALUES
(1, 'Kg', 'Kilogram'),
(2, 'M', 'Meter'),
(3, 'Pcs', 'Pieces'),
(4, 'Unit', NULL),
(5, 'Buah', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stok_item`
--

CREATE TABLE `stok_item` (
  `id_stok` varchar(15) NOT NULL,
  `komoditas` varchar(15) DEFAULT NULL,
  `jenis` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `sat_barang` int(11) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `last_change` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_item`
--

INSERT INTO `stok_item` (`id_stok`, `komoditas`, `jenis`, `jumlah`, `sat_barang`, `stok`, `tanggal`, `last_change`) VALUES
('0011578976937', '0071578758391', 'IN', 500, 1, 500, '2020-01-14', '2020-01-14 11:42:17'),
('0011578977137', '0071578758391', 'OUT', 50, 1, 450, '2020-05-20', '2020-01-14 15:54:47'),
('0011579961238', '0071578758391', 'IN', 50, 1, 500, '2020-01-25', '2020-01-25 21:07:18'),
('0011579961323', '0071578758391', 'IN', 50, 1, 550, '2020-01-25', '2020-01-25 21:08:43'),
('0011580112055', '0071578758391', 'OUT', 10, 1, 540, '2020-01-27', '2020-01-27 15:00:55'),
('0011580112407', '0071578758391', 'OUT', 20, 1, 520, '2020-01-27', '2020-01-27 15:06:47'),
('0011580112544', '0071578758391', 'OUT', 20, 1, 500, '2020-01-27', '2020-01-27 15:09:04'),
('0011580112593', '0071578758391', 'OUT', 20, 1, 480, '2020-01-27', '2020-01-27 15:09:53'),
('0011580112635', '0071578758391', 'OUT', 20, 1, 460, '2020-01-27', '2020-01-27 15:10:35'),
('0011580112654', '0071578758391', 'OUT', 20, 1, 440, '2020-01-27', '2020-01-27 15:10:54'),
('0011580112673', '0071578758391', 'OUT', 20, 1, 420, '2020-01-27', '2020-01-27 15:11:13'),
('0011580112731', '0071578758391', 'OUT', 40, 1, 380, '2020-01-27', '2020-01-27 15:12:11'),
('0011580112855', '0071578758391', 'OUT', 15, 1, 365, '2020-01-27', '2020-01-27 15:14:15'),
('0011580113003', '0071578758391', 'OUT', 16, 1, 349, '2020-01-27', '2020-01-27 15:16:43'),
('0011580113029', '0071578758391', 'OUT', 17, 1, 332, '2020-01-27', '2020-01-27 15:17:09'),
('0011580113528', '0071578758391', 'OUT', 18, 1, 314, '2020-01-27', '2020-01-27 15:25:28'),
('0011580113717', '0071578758391', 'OUT', 18, 1, 296, '2020-01-27', '2020-01-27 15:28:37');

--
-- Triggers `stok_item`
--
DELIMITER $$
CREATE TRIGGER `perubahan_data` BEFORE UPDATE ON `stok_item` FOR EACH ROW BEGIN
	DECLARE nilai int;
    DECLARE id varchar(15);
    DECLARE tipe varchar(4);
    DECLARE temp int;
    
    SET nilai = (select `stok` from `stok_item` order by `last_change` DESC limit 1);
    SET id = (select `id_stok` from `stok_item` order by `last_change` DESC limit 2 OFFSET 1);
    SET tipe = (select `jenis` from `stok_item` WHERE `id_stok`=new.id_stok);
    
    
    
    IF (id=new.id_stok OR id='') THEN
    	SET new.stok =  new.jumlah;
    ELSE
    	IF (tipe='IN') THEN
        	IF (new.jumlah > old.jumlah) THEN
            	SET temp = new.jumlah - old.jumlah;
            	SET new.stok = nilai + temp;
           	ELSE
            	SET temp = old.jumlah - new.jumlah;
            	SET new.stok = nilai - temp;
    		END IF;
         ELSE
         	IF (new.jumlah > old.jumlah) THEN
            	SET temp = new.jumlah - old.jumlah;
            	SET new.stok = nilai - temp;
           	ELSE
            	SET temp = old.jumlah - new.jumlah;
            	SET new.stok = nilai + temp;
            END IF;
          END IF;
      END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_logistik` BEFORE INSERT ON `stok_item` FOR EACH ROW BEGIN
	DECLARE nilai int;
    DECLARE r int;
SET nilai = (select `stok` from `stok_item` where `komoditas`=new.komoditas order by last_change DESC limit 1);

SET r = (select COUNT(`stok`) from `stok_item` where `komoditas`=new.komoditas order by last_change DESC limit 1);

IF (r=0) THEN
	SET nilai = new.jumlah;
ELSE
	IF (new.jenis = 'IN') THEN
           SET nilai = nilai+new.jumlah;
      ELSE
           SET nilai = nilai-new.jumlah;
      END IF;
END IF;        
	SET new.stok = nilai;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id_temp` int(11) NOT NULL,
  `id_prb` varchar(15) NOT NULL,
  `tujuan` varchar(15) NOT NULL,
  `nilai_transaksi` int(11) DEFAULT NULL,
  `margin` int(11) DEFAULT NULL,
  `mitra` varchar(15) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_keluar`
--

INSERT INTO `stok_keluar` (`id_temp`, `id_prb`, `tujuan`, `nilai_transaksi`, `margin`, `mitra`, `catatan`) VALUES
(7, '0011578977137', 'Distribusi', 400000, 300000, '0071578756545', 'Pembelian aset untuk disewakan | Edited'),
(8, '0011580112055', 'Distribusi', 200000, NULL, '0071578756545', 'Test'),
(9, '0011580112407', 'Distribusi', 300000, NULL, '0071578756545', 'Test 3, tanpa catatan keaungan'),
(10, '0011580112731', 'Distribusi', 400000, NULL, '0071578756545', 'Test 4, tanpa catatan keuangan [REVISI]'),
(11, '0011580112855', 'Non-distribusi', NULL, NULL, NULL, 'Test 5, Non-dsitribusi'),
(12, '0011580113003', 'Non-distribusi', NULL, NULL, NULL, 'Test 6, Non-dsitribusi nilai transaksi null'),
(13, '0011580113029', 'Non-distribusi', 100000, NULL, NULL, 'Test 7, Non-dsitribusi nilai transaksi ada'),
(14, '0011580113528', 'Non-distribusi', NULL, NULL, NULL, 'Test 7, Non-dsitribusi nilai transaksi null, catat transaksi'),
(15, '0011580113717', 'Distribusi', 800000, NULL, '0071578756545', 'Test 8, Distribusi nilai transaksi ada, catat transaksi');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id_temp` int(11) NOT NULL,
  `id_prb` varchar(15) NOT NULL,
  `asal` varchar(10) NOT NULL,
  `nilai` int(11) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id_temp`, `id_prb`, `asal`, `nilai`, `catatan`) VALUES
(31, '0011578976937', 'Beli', 500000, 'Pembelian rutin'),
(32, '0011579961238', 'Non-beli', NULL, 'Test input'),
(33, '0011579961323', 'Beli', 500000, 'Test input2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indexes for table `aset_disewakan`
--
ALTER TABLE `aset_disewakan`
  ADD PRIMARY KEY (`id_aset_sewa`);

--
-- Indexes for table `bagi_hasil_aset`
--
ALTER TABLE `bagi_hasil_aset`
  ADD PRIMARY KEY (`id_bgh`);

--
-- Indexes for table `dividen_profit`
--
ALTER TABLE `dividen_profit`
  ADD PRIMARY KEY (`id_div`);

--
-- Indexes for table `histori_harga_komoditas`
--
ALTER TABLE `histori_harga_komoditas`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indexes for table `histori_harga_sewa`
--
ALTER TABLE `histori_harga_sewa`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indexes for table `komoditas`
--
ALTER TABLE `komoditas`
  ADD PRIMARY KEY (`id_kom`);

--
-- Indexes for table `log_admin`
--
ALTER TABLE `log_admin`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `pemb_bagi_hasil`
--
ALTER TABLE `pemb_bagi_hasil`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indexes for table `rekap_keuangan`
--
ALTER TABLE `rekap_keuangan`
  ADD PRIMARY KEY (`id_fin`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_item`
--
ALTER TABLE `stok_item`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id_temp`),
  ADD KEY `id_prb` (`id_prb`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id_temp`),
  ADD KEY `id_prb` (`id_prb`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_harga_komoditas`
--
ALTER TABLE `histori_harga_komoditas`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `histori_harga_sewa`
--
ALTER TABLE `histori_harga_sewa`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `log_admin`
--
ALTER TABLE `log_admin`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pemb_bagi_hasil`
--
ALTER TABLE `pemb_bagi_hasil`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD CONSTRAINT `stok_keluar_ibfk_1` FOREIGN KEY (`id_prb`) REFERENCES `stok_item` (`id_stok`);

--
-- Constraints for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `stok_masuk_ibfk_1` FOREIGN KEY (`id_prb`) REFERENCES `stok_item` (`id_stok`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
