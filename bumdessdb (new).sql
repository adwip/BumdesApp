-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2020 at 05:46 PM
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
-- Database: `bumdessdb`
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
  `foto_user` varchar(20) DEFAULT NULL,
  `waktu_reg` datetime NOT NULL,
  `status_akt` varchar(10) DEFAULT NULL,
  `waktu_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `kategori`, `kontak`, `foto_user`, `waktu_reg`, `status_akt`, `waktu_login`) VALUES
('0081578813144', 'Tiyo BUMDes', 'tibumdes', '098f6bcd4621d373cade4e832627b4f6', 'MNG', '0832-5604-0453', NULL, '2020-03-10 02:09:11', NULL, NULL);

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `hapus_admin` BEFORE DELETE ON `admin` FOR EACH ROW BEGIN
	UPDATE log_admin SET admin=NULL, del_ad=old.nama WHERE admin=old.id_admin;
END
$$
DELIMITER ;

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
  `gambar` varchar(20) DEFAULT NULL,
  `kepemilikan` varchar(5) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `ket_aset` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aset_disewakan`
--

CREATE TABLE `aset_disewakan` (
  `id_aset_sewa` varchar(15) NOT NULL,
  `aset_sw` varchar(15) NOT NULL,
  `harga_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bagi_hasil_aset`
--

CREATE TABLE `bagi_hasil_aset` (
  `id_bgh` varchar(15) NOT NULL,
  `deld_aset` varchar(100) DEFAULT NULL,
  `aset_bh` varchar(15) DEFAULT NULL,
  `aset_luar` varchar(100) DEFAULT NULL,
  `mitra` varchar(15) NOT NULL,
  `pers_bumdes` int(11) NOT NULL,
  `pers_mitra` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_bgh` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagi_hasil_aset`
--

INSERT INTO `bagi_hasil_aset` (`id_bgh`, `deld_aset`, `aset_bh`, `aset_luar`, `mitra`, `pers_bumdes`, `pers_mitra`, `tanggal_mulai`, `tanggal_selesai`, `status_bgh`) VALUES
('0041581040525', NULL, NULL, 'Airbus A380', '0071578756545', 40, 60, '2020-01-03', '2022-01-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dividen_profit`
--

CREATE TABLE `dividen_profit` (
  `id_gdiv` varchar(15) NOT NULL,
  `jumlah_div` int(11) DEFAULT NULL,
  `tahun_div` varchar(5) NOT NULL,
  `cat_gdiv` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `dividen_profit`
--
DELIMITER $$
CREATE TRIGGER `hapus_penerima` BEFORE DELETE ON `dividen_profit` FOR EACH ROW BEGIN
	DELETE FROM penerima_dividen WHERE id_div = old.id_gdiv;
END
$$
DELIMITER ;

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
(1, '0071583299853', 'BELI', 20000, '2020-03-10'),
(2, '0071583299853', 'JUAL', 30000, '2020-03-10'),
(3, '0071583299853', 'BELI', 30000, '2020-03-10'),
(4, '0071583299853', 'JUAL', 25000, '2020-03-10'),
(5, '0071583299853', 'JUAL', 37000, '2020-03-10');

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
('0071581917999', 'Telur', 25000, 15000, 1),
('0071581949090', 'Uranium', 30000, 20000, 3),
('0071583299853', 'Pertamax', 30000, 25000, 1),
('0071583943120', 'Plutonium', 90000000, 60000000, 3);

--
-- Triggers `komoditas`
--
DELIMITER $$
CREATE TRIGGER `hapus_komoditas` BEFORE DELETE ON `komoditas` FOR EACH ROW BEGIN
	DELETE FROM histori_harga_komoditas WHERE komoditas = old.id_kom;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `perubahan_harga` AFTER UPDATE ON `komoditas` FOR EACH ROW BEGIN

    IF new.harga_beli <> old.harga_beli THEN
    	INSERT INTO `histori_harga_komoditas` (`komoditas`, `jenis`, `harga_lama`, `tanggal`) VALUES (new.id_kom, 'BELI', old.harga_beli, NOW());
    END IF;
    
    IF new.harga_jual <> old.harga_jual THEN
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
  `del_ad` varchar(50) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_admin`
--

INSERT INTO `log_admin` (`id_temp`, `log`, `admin`, `del_ad`, `tanggal`, `waktu`) VALUES
(508, '[TAMBAH][PENYEWAAN][0021583820815] Penyewaan aset Buldozer mulai dari 10-03-2020 selama 5 hari oleh Tiyo', '0081578813144', NULL, '2020-03-10', '13:13:36'),
(509, '[EDIT][PRODUK DAGANG][0071583299853] Mengubah data barang dagang Avtur', '0081578813144', NULL, '2020-03-10', '13:39:35'),
(510, '[EDIT][PRODUK DAGANG][0071583299853] Mengubah data barang dagang Avtur', '0081578813144', NULL, '2020-03-10', '13:43:36'),
(511, '[EDIT][PRODUK DAGANG][0071583299853] Mengubah data barang dagang Avtur', '0081578813144', NULL, '2020-03-10', '13:44:22'),
(512, '[EDIT][PRODUK DAGANG][0071583299853] Mengubah data barang dagang Avtur', '0081578813144', NULL, '2020-03-10', '13:44:42'),
(513, '[EDIT][PRODUK DAGANG][0071583299853] Mengubah data barang dagang Avtur', '0081578813144', NULL, '2020-03-10', '13:45:06'),
(514, '[EDIT][PRODUK DAGANG][0071583299853] Mengubah data barang dagang Avtur', '0081578813144', NULL, '2020-03-10', '13:45:12'),
(515, '[EDIT][PRODUK DAGANG][0071583299853] Mengubah data barang dagang Pertamax', '0081578813144', NULL, '2020-03-10', '13:51:55'),
(516, '[HAPUS][PENYEWAAN][0021583820815] Menghapus jadwal penyewaan aset', '0081578813144', NULL, '2020-03-10', '20:46:48'),
(517, '[HAPUS][KEUANGAN][0061583820815] Menghapus transaksi dari penyewaan aset oleh sistem', '0081578813144', NULL, '2020-03-10', '20:46:48'),
(518, '[HAPUS][PENYEWAAN][0021583299561] Menghapus jadwal penyewaan aset', '0081578813144', NULL, '2020-03-10', '20:47:52'),
(519, '[HAPUS][KEUANGAN][0061583567736][0021583299561] Menghapus transaksi dari penyewaan aset oleh sistem', '0081578813144', NULL, '2020-03-10', '20:47:52'),
(520, '[HAPUS][ASET DISEWAKAN] Menghapus aset undefined dari daftar aset disewakan', '0081578813144', NULL, '2020-03-11', '10:57:06'),
(521, '[TAMBAH][SEWA] Menambah aset  untuk disewakan', '0081578813144', NULL, '2020-03-11', '10:57:40'),
(522, '[TAMBAH][ASET SEWA][0031583899693] Menambah aset Excavator untuk disewakan', '0081578813144', NULL, '2020-03-11', '11:08:13'),
(523, '[HAPUS][ASET DISEWAKAN][0031583899693] Menghapus aset Excavator dari daftar aset disewakan', '0081578813144', NULL, '2020-03-11', '11:11:47'),
(524, '[TAMBAH][PENYEWAAN][0021583899982] Penyewaan aset Buldozer mulai dari 11-03-2020 selama 6 hari oleh Tony stark', '0081578813144', NULL, '2020-03-11', '11:13:02'),
(525, '[HAPUS][PENYEWAAN][0021583899982] Menghapus jadwal penyewaan aset', '0081578813144', NULL, '2020-03-11', '11:17:48'),
(526, '[HAPUS][KEUANGAN][0061583899982][0021583899982] Menghapus transaksi dari penyewaan aset oleh sistem', '0081578813144', NULL, '2020-03-11', '11:17:48'),
(527, '[TAMBAH][PENYEWAAN][0021583901495] Penyewaan aset Buldozer mulai dari 11-03-2020 selama 7 hari oleh Steve rogers', '0081578813144', NULL, '2020-03-11', '11:38:16'),
(528, '[TAMBAH][KEUANGAN][PENYEWAAN][0021583901495][0061583901496] Penambahan pemasukan dari transaksi sewa Buldozer mulai dari 11-03-2020 selama 7 hari oleh Steve rogers', '0081578813144', NULL, '2020-03-11', '11:38:16'),
(529, '[HAPUS][PENYEWAAN][0021583901495] Menghapus jadwal penyewaan aset', '0081578813144', NULL, '2020-03-11', '13:45:07'),
(530, '[HAPUS][KEUANGAN][0061583901496][0021583901495] Menghapus transaksi dari penyewaan aset oleh sistem', '0081578813144', NULL, '2020-03-11', '13:45:08'),
(531, '[HAPUS][ASET DISEWAKAN][0031583899060] Menghapus aset Buldozer dari daftar aset disewakan', '0081578813144', NULL, '2020-03-11', '14:12:15'),
(532, '[TAMBAH][BAGI HASIL] Menambah kerja sama bagi hasil untuk aset  dari aset Internal dengan  mulai tanggal 11-03-2020 selama 12 bulan', '0081578813144', NULL, '2020-03-11', '14:16:12'),
(533, '[TAMBAH][BAGI HASIL][0041583911257] Menambah kerja sama bagi hasil untuk aset C5 Galaxy cargo military plane dari aset Eksternal dengan  mulai tanggal 2020-03-11 selama 12 bulan', '0081578813144', NULL, '2020-03-11', '14:20:57'),
(534, '[TAMBAH][BAGI HASIL][0041583911279] Menambah kerja sama bagi hasil untuk aset C17 Globemaster dari aset Eksternal dengan  mulai tanggal 2020-03-11 selama 12 bulan', '0081578813144', NULL, '2020-03-11', '14:21:20'),
(535, '[TAMBAH][BAGI HASIL][0041583911481] Menambah kerja sama bagi hasil untuk aset Airbus A400M Military cargo dari aset Eksternal dengan  mulai tanggal 2020-03-11 selama 12 bulan', '0081578813144', NULL, '2020-03-11', '14:24:42'),
(536, '[TAMBAH][BAGI HASIL][0041583911584] Menambah kerja sama bagi hasil untuk aset F-35 Lightning B dari aset Eksternal dengan PT. Maju kena mundur kena (Persero) Tbk mulai tanggal 2020-03-11 selama 12 bulan', '0081578813144', NULL, '2020-03-11', '14:26:24'),
(537, '[TAMBAH] [BAGI HASIL USAHA] Menambah bagi hasil usaha tahunan untuk tahun 2020 untuk sebanyak 3 entitas', '0081578813144', NULL, '2020-03-11', '14:50:10'),
(538, '[TAMBAH][BAGI HASIL USAHA][0091583913427] Menambah bagi hasil usaha tahunan untuk tahun 2015 untuk sebanyak 3 entitas', '0081578813144', NULL, '2020-03-11', '14:57:08'),
(539, '[TAMBAH][BAGI HASIL USAHA][0091583913461] Menambah bagi hasil usaha tahunan tahun 2016 untuk sebanyak 3 entitas', '0081578813144', NULL, '2020-03-11', '14:57:41'),
(540, '[TAMBAH][ASET][0051583926662] Penambahan aset Airbus A340-400M dengan kondisi Baru dalam keadaan Baik melalui proses Non-beli', '0081578813144', NULL, '2020-03-11', '18:37:43'),
(541, '[TAMBAH][KEUANGAN][BELI ASET][0061583927870][0051583927869] Pembelian aset Boeing 747-400 dengan kondisi Baru dalam keadaan Baik', '0081578813144', NULL, '2020-03-11', '18:57:50'),
(542, '[TAMBAH][ASET][0051583927869] Penambahan aset Boeing 747-400 dengan kondisi Baru dalam keadaan Baik melalui proses Beli', '0081578813144', NULL, '2020-03-11', '18:57:50'),
(543, '[TAMBAH][KEUANGAN] Menambah transaksi Debit sebesar 5000000', '0081578813144', NULL, '2020-03-11', '19:06:09'),
(544, '[TAMBAH][KEUANGAN][0061583928610] Menambah transaksi kas Masuk (Debit) sebesar 5000000', '0081578813144', NULL, '2020-03-11', '19:10:10'),
(545, '[TAMBAH][KEUANGAN][0061583928632] Menambah transaksi kas Masuk (Debit) sebesar Rp. 5000000', '0081578813144', NULL, '2020-03-11', '19:10:32'),
(546, '[TAMBAH][REKANAN] Penambahan rekanan baru, dengan nama rekanan AT&T Inc', '0081578813144', NULL, '2020-03-11', '19:14:51'),
(547, '[TAMBAH][REKANAN][0071583929166] Penambahan rekanan baru, dengan nama rekanan Google Inc', '0081578813144', NULL, '2020-03-11', '19:19:26'),
(548, '[TAMBAH][ADMIN][0081583930519] Penambahan admin bernama Stevenson dari Pemerintah desa', '0081578813144', NULL, '2020-03-11', '19:42:01'),
(549, '[TAMBAH][LOGISTIK][0011583931002] Penambahan stok masuk Uranium sebanyak 50 Pcs dengan cara Beli', '0081578813144', NULL, '2020-03-11', '19:50:02'),
(550, '[TAMBAH][STOK MASUK][0011583942027] Penambahan stok masuk Telur sebanyak 80 Kg dengan cara Beli', '0081578813144', NULL, '2020-03-11', '22:53:47'),
(551, '[KELUAR][BARANG][0011583942314] Stok Telur keluar sebanyak 90 Kg untuk Distribusi kepada AT', '0081578813144', NULL, '2020-03-11', '22:58:35'),
(552, '[TAMBAH][STOK KELUAR][0011583942461] Stok Uranium keluar sebanyak 47 Pcs untuk Distribusi kepada Google Inc', '0081578813144', NULL, '2020-03-11', '23:01:02'),
(553, '[TAMBAH][KOMODITAS] Penambahan komoditas baru Microchip', '0081578813144', NULL, '2020-03-11', '23:02:14'),
(554, '[TAMBAH][KOMODITAS][0071583943120] Penambahan komoditas baru Plutonium', '0081578813144', NULL, '2020-03-11', '23:12:00'),
(555, '[EDIT][STOK MASUK][0011583545011] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-11', '23:13:17'),
(556, '[EDIT][KEUANGAN][STOK MASUK][0011583545011] Perubahan data keuangan untuk pembelian Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-11', '23:13:17'),
(557, '[EDIT][BARANG KELUAR][0011583942461] Perubahan data Uranium keluar/distribusi sebanyak 47 Pcs', '0081578813144', NULL, '2020-03-11', '23:14:04'),
(558, '[EDIT][KEUANGAN][STOK KELUAR][0011583942461] Perubahan catatan keuangan dari penjualan Uranium sebanyak 47 Pcs untuk Distribusi kepada Google Inc', '0081578813144', NULL, '2020-03-11', '23:14:04'),
(559, '[EDIT][STOK KELUAR][0011583942461] Perubahan data Uranium keluar/distribusi sebanyak 47 Pcs', '0081578813144', NULL, '2020-03-11', '23:15:22'),
(560, '[EDIT][KEUANGAN][STOK KELUAR][0011583942461] Perubahan catatan keuangan dari penjualan Uranium sebanyak 47 Pcs untuk Distribusi kepada Google Inc', '0081578813144', NULL, '2020-03-11', '23:15:22'),
(561, '[EDIT][STOK KELUAR][0011583942461] Perubahan data Uranium keluar/distribusi sebanyak 89 Pcs', '0081578813144', NULL, '2020-03-11', '23:15:47'),
(562, '[EDIT][KEUANGAN][STOK KELUAR][0011583942461] Perubahan catatan keuangan dari penjualan Uranium sebanyak 89 Pcs untuk Distribusi kepada Google Inc', '0081578813144', NULL, '2020-03-11', '23:15:48'),
(563, '[EDIT][STOK KELUAR][0011583942461] Perubahan data Uranium keluar/distribusi sebanyak 89 Pcs', '0081578813144', NULL, '2020-03-11', '23:16:17'),
(564, '[EDIT][STOK MASUK][0071583942534] Mengubah data barang dagang Microchip', '0081578813144', NULL, '2020-03-11', '23:17:19'),
(565, '[EDIT][KOMODITAS][0071583942534] Perubahan data barang dagang Microchip', '0081578813144', NULL, '2020-03-11', '23:18:40'),
(566, '[TAMBAH][ASET SEWA][0031583943556] Menambah aset Airbus A340-400M untuk disewakan', '0081578813144', NULL, '2020-03-11', '23:19:16'),
(567, '[TAMBAH][PENYEWAAN][0021583943610] Penyewaan aset Airbus A340-400M mulai dari 11-03-2020 selama 7 hari oleh Bucky barnes', '0081578813144', NULL, '2020-03-11', '23:20:10'),
(568, '[TAMBAH][KEUANGAN][PENYEWAAN][0021583943610][0061583943610] Pemasukan dari penyewaan Airbus A340-400M oleh Bucky barnes', '0081578813144', NULL, '2020-03-11', '23:20:10'),
(569, '[EDIT][PENYEWAAN][0021583943610] Perubahan data penyewaan aset Airbus A340-400M oleh Bucky barnes selama 8 hari, dimulai dari tanggal 11-03-2020', '0081578813144', NULL, '2020-03-11', '23:20:34'),
(570, '[EDIT][KEUANGAN][PENYEWAAN][][0021583943610] Perubahan catatan keuangan dari penyewaan aset Airbus A340-400M oleh Bucky barnes selama 8 hari, dimulai dari tanggal 11-03-2020', '0081578813144', NULL, '2020-03-11', '23:20:35'),
(571, '[EDIT][PENYEWAAN][0021583943610] Perubahan data penyewaan aset Airbus A340-400M oleh Bucky barnes selama 8 hari, dimulai dari tanggal 11-03-2020', '0081578813144', NULL, '2020-03-11', '23:27:36'),
(572, '[EDIT][KEUANGAN][PENYEWAAN][][0021583943610] Perubahan catatan keuangan dari penyewaan aset Airbus A340-400M oleh Bucky barnes selama 8 hari, dimulai dari tanggal 11-03-2020', '0081578813144', NULL, '2020-03-11', '23:27:37'),
(573, '[EDIT][PENYEWAAN][0021583943610] Perubahan data penyewaan aset Airbus A340-400M oleh Bucky barnes selama 8 hari, dimulai dari tanggal 11-03-2020', '0081578813144', NULL, '2020-03-11', '23:28:18'),
(574, '[EDIT][KEUANGAN][PENYEWAAN][Array][0021583943610] Perubahan catatan keuangan dari penyewaan aset Airbus A340-400M oleh Bucky barnes selama 8 hari, dimulai dari tanggal 11-03-2020', '0081578813144', NULL, '2020-03-11', '23:28:18'),
(575, '[EDIT][PENYEWAAN][0021583943610] Perubahan data penyewaan aset Airbus A340-400M oleh Bucky barnes selama 8 hari, dimulai dari tanggal 11-03-2020', '0081578813144', NULL, '2020-03-11', '23:28:58'),
(576, '[EDIT][KEUANGAN][PENYEWAAN][0061583943610][0021583943610] Perubahan catatan keuangan dari penyewaan aset Airbus A340-400M oleh Bucky barnes selama 8 hari, dimulai dari tanggal 11-03-2020', '0081578813144', NULL, '2020-03-11', '23:28:58'),
(577, '[EDIT][ASET DISEWAKAN] Peruabahan harga sewa Airbus A340-400M menjadi Rp. 650000', '0081578813144', NULL, '2020-03-11', '23:32:28'),
(578, '[EDIT][ASET DISEWAKAN][0031583943556] Perubahan harga sewa Airbus A340-400M menjadi Rp. 680000', '0081578813144', NULL, '2020-03-11', '23:33:17'),
(579, '[EDIT][BAGI HASIL ASET] Peruabahan kerjasama bagi hasil C5 Galaxy cargo military plane dengan PT. Maju kena mundur kena (Persero) Tbk dengan pembagian BUMDes 30% dan Mitra 70% mulai dari tanggal 11-03-2020 selama 15 bulan', '0081578813144', NULL, '2020-03-11', '23:43:19'),
(580, '[EDIT][BAGI HASIL][0041583911257] Peruabahan kerjasama bagi hasil C5 Galaxy cargo military plane dengan PT. Maju kena mundur kena (Persero) Tbk dengan pembagian BUMDes 30% dan Mitra 70% mulai dari tanggal 11-03-2020 selama 16 bulan', '0081578813144', NULL, '2020-03-11', '23:44:28'),
(581, '[EDIT][BAGI HASIL][0041583911257] Perubahan kerjasama bagi hasil C5 Galaxy cargo military plane dengan PT. Maju kena mundur kena (Persero) Tbk dengan pembagian BUMDes 30% dan Mitra 70% mulai dari tanggal 11-03-2020 selama 17 bulan', '0081578813144', NULL, '2020-03-11', '23:44:50'),
(582, '[EDIT][BAGI HASIL USAHA][0091583913427] Perubahan bagi hasil usaha tahun 2014 dengan 3 penerima, dengan nilai Rp. 500000', '0081578813144', NULL, '2020-03-11', '23:45:56'),
(583, '', '0081578813144', NULL, '2020-03-11', '23:48:31'),
(584, '[EDIT][KEUANGAN][BELI ASET][0061583927870][0051583927869] Menambah catatan keuangan dari pembelian Boeing 747-400 dengan kondisi Baru, keadaan Rusak', '0081578813144', NULL, '2020-03-11', '23:48:31'),
(585, '', '0081578813144', NULL, '2020-03-11', '23:48:49'),
(586, '[EDIT][KEUANGAN][BELI ASET][0061583927870][0051583927869] Menambah catatan keuangan dari pembelian Boeing 747-400 dengan kondisi Baru, keadaan Baik', '0081578813144', NULL, '2020-03-11', '23:48:50'),
(587, '[EDIT][ASET][0051583927869] Perubahan data aset Boeing 747-400 dengan kondisi Baru, keadaan Rusak', '0081578813144', NULL, '2020-03-12', '00:22:32'),
(588, '[EDIT][KEUANGAN][BELI ASET][0061583927870][0051583927869] Menambah catatan keuangan dari pembelian Boeing 747-400 dengan kondisi Baru, keadaan Rusak', '0081578813144', NULL, '2020-03-12', '00:22:32'),
(589, '[EDIT][KEUANGAN][0061583928632] Perubahan keuangan pada transaksi  sebesar Rp. 5500000', '0081578813144', NULL, '2020-03-12', '00:23:36'),
(590, '[EDIT][REKANAN] [0071583929166] Perubahan data rekanan Google Inc Co', '0081578813144', NULL, '2020-03-12', '00:24:28'),
(591, '[HAPUS][STOK MASUK][0011583545011] Menghapus rekaman stok masuk', '0081578813144', NULL, '2020-03-12', '00:26:20'),
(592, '[HAPUS][KEUANGAN][0061583545012] Menghapus transaksi otomatis dari pembelian logistik dagang oleh sistem', '0081578813144', NULL, '2020-03-12', '00:26:20'),
(593, '[HAPUS][STOK MASUK][0011583931002] Menghapus rekaman stok masuk', '0081578813144', NULL, '2020-03-12', '00:27:32'),
(594, '[HAPUS][KEUANGAN][STOK MASUK][0061583931002][0011583931002] Menghapus transaksi otomatis dari pembelian logistik dagang oleh sistem', '0081578813144', NULL, '2020-03-12', '00:27:32'),
(595, '[HAPUS][STOK MASUK][0011583942027] Menghapus data stok/logistik masuk', '0081578813144', NULL, '2020-03-12', '00:30:37'),
(596, '[HAPUS][KEUANGAN][STOK MASUK][0061583942027][0011583942027] Menghapus transaksi dari pembelian logistik dagang', '0081578813144', NULL, '2020-03-12', '00:30:37'),
(597, '[HAPUS][DISTRIBUSI/KELUAR][0011583942314] Menghapus rekaman stok keluar/distribusi', '0081578813144', NULL, '2020-03-12', '00:30:58'),
(598, '[HAPUS][KEUANGAN][0061583942315] Menghapus transaksi otomatis dari dagang oleh sistem', '0081578813144', NULL, '2020-03-12', '00:30:58'),
(599, '[HAPUS][STOK KELUAR / DISTRIBUSI][0011583942461] Menghapus rekap stok keluar/distribusi', '0081578813144', NULL, '2020-03-12', '00:46:50'),
(600, '[HAPUS][KEUANGAN][STOK KELUAR / DISTRIBUSI][0061583942462][0011583942461] Menghapus kas transaksi penjualan/dristibusi barang', '0081578813144', NULL, '2020-03-12', '00:46:51'),
(601, '[HAPUS][KOMODITAS][0071583942534] Menghapus komoditas dagang', '0081578813144', NULL, '2020-03-12', '00:48:19'),
(602, '[HAPUS][PENYEWAAN][0021583943610] Menghapus jadwal penyewaan aset', '0081578813144', NULL, '2020-03-12', '00:48:54'),
(603, '[HAPUS][KEUANGAN][0061583943610][0021583943610] Menghapus transaksi dari penyewaan aset oleh sistem', '0081578813144', NULL, '2020-03-12', '00:48:55'),
(604, '[HAPUS][ASET DISEWAKAN][0031583943556] Menghapus aset Airbus A340-400M dari daftar aset disewakan', '0081578813144', NULL, '2020-03-12', '00:50:36'),
(605, '[HAPUS][BAGI HASIL][0041583910972] Menghapus/membatalkan kerjasama bagi hasil', '0081578813144', NULL, '2020-03-12', '00:51:09'),
(606, '[HAPUS][BAGI HASIL USAHA][0091583913427] Menghapus pembagian hasil usaha tahun 2014', '0081578813144', NULL, '2020-03-12', '00:52:04'),
(607, '[HAPUS][ASET][0051583648399] Menghapus Excavator dari daftar aset dimiliki', '0081578813144', NULL, '2020-03-12', '00:58:45'),
(608, '[HAPUS][KEUANGAN][0061583928632] Menghapus transaksi keuangan', '0081578813144', NULL, '2020-03-12', '00:59:41'),
(609, '[TAMBAH][REKANAN][0071583949622] Penambahan rekanan baru, dengan nama rekanan Test', '0081578813144', NULL, '2020-03-12', '01:00:22'),
(610, '[HAPUS][REKANAN][0071583949622] Menghapus Test dari daftar rekanan usaha BUMDes', '0081578813144', NULL, '2020-03-12', '01:00:32'),
(611, '[HAPUS][USER][0081583930519] Menghapus Stevenson dari daftar pengguna sistem', '0081578813144', NULL, '2020-03-12', '01:00:55'),
(612, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:25:40'),
(613, '[EDIT][KEUANGAN][STOK MASUK][0011583301297] Perubahan data keuangan untuk pembelian Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:25:40'),
(614, '[EDIT][KEUANGAN][STOK MASUK][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:25:41'),
(615, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:26:02'),
(616, '[EDIT][KEUANGAN][STOK MASUK][0011583301297] Perubahan data keuangan untuk pembelian Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:26:02'),
(617, '[EDIT][KEUANGAN][STOK MASUK][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:26:03'),
(618, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:28:30'),
(619, '[EDIT][KEUANGAN][STOK MASUK][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:28:30'),
(620, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:30:00'),
(621, '[EDIT][KEUANGAN][STOK MASUK][0061583545261][0061583545261][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:30:00'),
(622, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:30:44'),
(623, '[EDIT][KEUANGAN][STOK MASUK][0061583545261][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 10 Kg', '0081578813144', NULL, '2020-03-12', '09:30:44'),
(624, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 12 Kg', '0081578813144', NULL, '2020-03-12', '09:36:15'),
(625, '[EDIT][KEUANGAN][STOK MASUK][0061583545261][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 12 Kg', '0081578813144', NULL, '2020-03-12', '09:36:15'),
(626, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:36:28'),
(627, '[EDIT][KEUANGAN][STOK MASUK][0061583545261][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:36:28'),
(628, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:36:40'),
(629, '[EDIT][KEUANGAN][STOK MASUK][0061583545261][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:36:40'),
(630, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:36:59'),
(631, '[EDIT][KEUANGAN][STOK MASUK][][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:36:59'),
(632, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:38:25'),
(633, '[EDIT][KEUANGAN][STOK MASUK][][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:38:25'),
(634, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:41:53'),
(635, '[EDIT][KEUANGAN][STOK MASUK][][0011583301297] Perubahan catatan keuangan dari pembelian Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:41:54'),
(636, '[EDIT][STOK MASUK][0011583301297] Perubahan data stok masuk untuk komoditas Pertamax sebanyak 15 Kg', '0081578813144', NULL, '2020-03-12', '09:44:28'),
(637, '[EDIT][STOK KELUAR][0011583490821] Perubahan data Telur keluar/distribusi sebanyak 25 Kg', '0081578813144', NULL, '2020-03-12', '09:45:07'),
(638, '[EDIT][KEUANGAN][STOK KELUAR][0011583490821] Perubahan catatan keuangan dari penjualan Telur sebanyak 25 Kg untuk Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', '0081578813144', NULL, '2020-03-12', '09:45:07'),
(639, '[EDIT][STOK KELUAR][0011583490821] Perubahan data Telur keluar/distribusi sebanyak 25 Kg', '0081578813144', NULL, '2020-03-12', '09:49:59'),
(640, '[EDIT][KEUANGAN][STOK KELUAR][0061583542969][0011583490821] Perubahan catatan keuangan dari penjualan Telur sebanyak 25 Kg untuk Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', '0081578813144', NULL, '2020-03-12', '09:49:59'),
(641, '[EDIT][STOK KELUAR][0011583490821] Perubahan data Telur keluar/distribusi sebanyak 25 Kg', '0081578813144', NULL, '2020-03-12', '09:50:39'),
(642, '[EDIT][KEUANGAN][STOK KELUAR][0061583542969][0011583490821] Perubahan catatan keuangan dari penjualan Telur sebanyak 25 Kg untuk Distribusi kepada AT', '0081578813144', NULL, '2020-03-12', '09:50:39'),
(643, '[EDIT][STOK KELUAR][0011583490821] Perubahan data Telur keluar/distribusi sebanyak 25 Kg', '0081578813144', NULL, '2020-03-12', '09:50:59'),
(644, '[EDIT][KEUANGAN][STOK KELUAR][0061583542969][0011583490821] Perubahan catatan keuangan dari penjualan Telur sebanyak 25 Kg untuk Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', '0081578813144', NULL, '2020-03-12', '09:50:59'),
(645, '[EDIT][STOK KELUAR][0011583490821] Perubahan data Telur keluar/distribusi sebanyak 25 Kg', '0081578813144', NULL, '2020-03-12', '09:51:19'),
(646, '[EDIT][KOMODITAS][0071583299853] Perubahan data barang dagang Pertamax', '0081578813144', NULL, '2020-03-12', '09:51:55'),
(647, '[EDIT][KOMODITAS][0071583299853] Perubahan data barang dagang Pertamax', '0081578813144', NULL, '2020-03-12', '09:52:09'),
(648, '[TAMBAH][ASET SEWA][0031583981555] Menambah aset Airbus A340-400M untuk disewakan', '0081578813144', NULL, '2020-03-12', '09:52:36'),
(649, '[TAMBAH][PENYEWAAN][0021583981592] Penyewaan aset Airbus A340-400M mulai dari 12-03-2020 selama 7 hari oleh Vladimir putin', '0081578813144', NULL, '2020-03-12', '09:53:13'),
(650, '[TAMBAH][KEUANGAN][PENYEWAAN][0021583981592][0061583981593] Pemasukan dari penyewaan Airbus A340-400M oleh Vladimir putin', '0081578813144', NULL, '2020-03-12', '09:53:13'),
(651, '[EDIT][PENYEWAAN][0021583981592] Perubahan data penyewaan aset Airbus A340-400M oleh Vladimir putin selama 7 hari, dimulai dari tanggal 12-03-2020', '0081578813144', NULL, '2020-03-12', '09:56:12'),
(652, '[EDIT][KEUANGAN][PENYEWAAN][0061583981593][0021583981592] Perubahan catatan keuangan dari penyewaan aset Airbus A340-400M oleh Vladimir putin selama 7 hari, dimulai dari tanggal 12-03-2020', '0081578813144', NULL, '2020-03-12', '09:56:13'),
(653, '[EDIT][PENYEWAAN][0021583981592] Perubahan data penyewaan aset Airbus A340-400M oleh Vladimir putin selama 7 hari, dimulai dari tanggal 12-03-2020', '0081578813144', NULL, '2020-03-12', '09:56:32'),
(654, '[EDIT][KEUANGAN][PENYEWAAN][0061583981593][0021583981592] Perubahan catatan keuangan dari penyewaan aset Airbus A340-400M oleh Vladimir putin selama 7 hari, dimulai dari tanggal 12-03-2020', '0081578813144', NULL, '2020-03-12', '09:56:32'),
(655, '[EDIT][ASET DISEWAKAN][0031583981555] Perubahan harga sewa Airbus A340-400M menjadi Rp. 850000', '0081578813144', NULL, '2020-03-12', '09:57:07'),
(656, '[EDIT][BAGI HASIL][0041583911257] Perubahan kerjasama bagi hasil C5 Galaxy cargo military plane dengan PT. Maju kena mundur kena (Persero) Tbk dengan pembagian BUMDes 30% dan Mitra 70% mulai dari tanggal 11-03-2020 selama 18 bulan', '0081578813144', NULL, '2020-03-12', '09:57:55'),
(657, '[EDIT][BAGI HASIL USAHA][0091583913461] Perubahan bagi hasil usaha tahun 2016 dengan 3 penerima, dengan nilai Rp. 500000', '0081578813144', NULL, '2020-03-12', '10:02:57'),
(658, '[EDIT][ASET][0051583927869] Perubahan data aset Boeing 747-400 dengan kondisi Baru, keadaan Rusak', '0081578813144', NULL, '2020-03-12', '10:03:30'),
(659, '[EDIT][KEUANGAN][BELI ASET][][0051583927869] Menambah catatan keuangan dari pembelian Boeing 747-400 dengan kondisi Baru, keadaan Rusak', '0081578813144', NULL, '2020-03-12', '10:03:30'),
(660, '[EDIT][ASET][0051583927869] Perubahan data aset Boeing 747-400 dengan kondisi Baru, keadaan Rusak', '0081578813144', NULL, '2020-03-12', '10:04:14'),
(661, '[EDIT][ASET][0051583927869] Perubahan data aset Boeing 747-400 dengan kondisi Baru, keadaan Baik', '0081578813144', NULL, '2020-03-12', '10:04:27'),
(662, '[EDIT][KEUANGAN][BELI ASET][0061583927870][0051583927869] Menambah catatan keuangan dari pembelian Boeing 747-400 dengan kondisi Baru, keadaan Baik', '0081578813144', NULL, '2020-03-12', '10:04:28'),
(663, '[EDIT][KEUANGAN][0061583727046] Perubahan keuangan pada transaksi  sebesar Rp. 22000000', '0081578813144', NULL, '2020-03-12', '10:18:03'),
(664, '[EDIT][REKANAN] [0071583929166] Perubahan data rekanan Google Inc Corp', '0081578813144', NULL, '2020-03-12', '10:18:40'),
(665, '[TAMBAH][BAGI HASIL USAHA][0091584624561] Menambah bagi hasil usaha tahunan tahun 2020 untuk sebanyak 4 entitas', '0081578813144', NULL, '2020-03-19', '20:29:22'),
(666, '[EDIT][ASET][0051578813210] Perubahan data aset  dengan kondisi Baru, keadaan Baik', '0081578813144', NULL, '2020-03-19', '21:16:32'),
(667, '[EDIT][ASET][0051578813210] Perubahan data aset  dengan kondisi Baru, keadaan Baik', '0081578813144', NULL, '2020-03-19', '21:16:42'),
(668, '[HAPUS][ASET][0051578813210] Menghapus  dari daftar aset', '0081578813144', NULL, '2020-03-19', '21:17:14'),
(669, '[TAMBAH][STOK MASUK][0011584627522] Penambahan stok masuk Plutonium sebanyak 60 Pcs dengan cara Beli', '0081578813144', NULL, '2020-03-19', '21:18:43'),
(670, '[TAMBAH][STOK MASUK][0011584627522] Penambahan stok masuk Plutonium sebanyak 60 Pcs dengan cara Beli', '0081578813144', NULL, '2020-03-19', '21:18:43'),
(671, '[TAMBAH][KEUANGAN][STOK MASUK][0011584628101] Menambah arus kas keluar (Kredit) pembelian Plutonium sebanyak 23 Pcs', '0081578813144', NULL, '2020-03-19', '21:28:21'),
(672, '[TAMBAH][STOK MASUK][0011584628101] Penambahan stok masuk Plutonium sebanyak 23 Pcs dengan cara Beli', '0081578813144', NULL, '2020-03-19', '21:28:21'),
(673, '[TAMBAH][KEUANGAN][STOK MASUK][0061584628226][0011584628226] Menambah arus kas keluar (Kredit) pembelian Plutonium sebanyak 40 Pcs', '0081578813144', NULL, '2020-03-19', '21:30:26'),
(674, '[TAMBAH][STOK MASUK][0011584628226] Penambahan stok masuk Plutonium sebanyak 40 Pcs dengan cara Beli', '0081578813144', NULL, '2020-03-19', '21:30:26'),
(675, '[TAMBAH][STOK KELUAR][0011584634475] Stok Telur keluar sebanyak 50 Kg untuk Distribusi kepada AT', '0081578813144', NULL, '2020-03-19', '23:14:36'),
(676, '[TAMBAH][KEUANGAN][STOK KELUAR][0061584634717][0011584634716] Menambah arus kas masuk (Debit) untuk penjualan Pertamax sebanyak 3 Kg', '0081578813144', NULL, '2020-03-19', '23:18:37'),
(677, '[TAMBAH][STOK KELUAR][0011584634716] Stok Pertamax keluar sebanyak 3 Kg untuk Distribusi kepada Google Inc Corp', '0081578813144', NULL, '2020-03-19', '23:18:37'),
(678, '[TAMBAH][KEUANGAN][STOK KELUAR][0061584635513][0011584635513] Menambah arus kas masuk (Debit) untuk penjualan Telur sebanyak 5 Kg', '0081578813144', NULL, '2020-03-19', '23:31:54'),
(679, '[TAMBAH][STOK KELUAR][0011584635513] Stok Telur keluar sebanyak 5 Kg untuk Distribusi kepada AT', '0081578813144', NULL, '2020-03-19', '23:31:54'),
(680, '[TAMBAH][PENYEWAAN][0021584636291] Penyewaan aset Airbus A340-400M mulai dari 19-03-2020 selama 6 hari oleh Gatot Nurmantyo', '0081578813144', NULL, '2020-03-19', '23:44:51'),
(681, '[TAMBAH][KEUANGAN][PENYEWAAN][0021584636291][0061584636291] Pemasukan dari penyewaan Airbus A340-400M oleh Gatot Nurmantyo', '0081578813144', NULL, '2020-03-19', '23:44:51'),
(682, '[HAPUS][STOK MASUK][0011584628101] Menghapus data stok/logistik masuk', '0081578813144', NULL, '2020-03-21', '10:58:36'),
(683, '[HAPUS][KEUANGAN][STOK MASUK][0061584628101][0011584628101] Menghapus transaksi dari pembelian logistik dagang', '0081578813144', NULL, '2020-03-21', '10:58:37'),
(684, '[TAMBAH][KOMODITAS][0071584763475] Penambahan komoditas baru Semangka', '0081578813144', NULL, '2020-03-21', '11:04:35'),
(685, '[HAPUS][KOMODITAS][0071584763475] Menghapus komoditas dagang', '0081578813144', NULL, '2020-03-21', '11:13:47'),
(686, '[HAPUS][PENYEWAAN][0021584636291] Menghapus jadwal penyewaan aset', '0081578813144', NULL, '2020-03-21', '11:59:36'),
(687, '[HAPUS][KEUANGAN][0061584636291][0021584636291] Menghapus transaksi dari penyewaan aset', '0081578813144', NULL, '2020-03-21', '11:59:36'),
(688, '[HAPUS][ASET DISEWAKAN][0031583981555] Menghapus aset Airbus A340-400M dari daftar aset disewakan', '0081578813144', NULL, '2020-03-21', '11:59:57'),
(689, '[HAPUS][BAGI HASIL][0041583911584] Menghapus/membatalkan kerjasama bagi hasil', '0081578813144', NULL, '2020-03-21', '15:36:38'),
(690, '[HAPUS][BAGI HASIL][0041583911481] Menghapus/membatalkan kerjasama bagi hasil', '0081578813144', NULL, '2020-03-21', '15:36:41'),
(691, '[HAPUS][BAGI HASIL][0041583911279] Menghapus/membatalkan kerjasama bagi hasil', '0081578813144', NULL, '2020-03-21', '15:36:43'),
(692, '[HAPUS][BAGI HASIL][0041583911257] Menghapus/membatalkan kerjasama bagi hasil', '0081578813144', NULL, '2020-03-21', '15:36:46'),
(693, '[BATAL][BAGI HASIL][0041581040525] Membatalkan kerjasama bagi hasil', '0081578813144', NULL, '2020-03-22', '16:37:11'),
(694, '[BATAL][BAGI HASIL][0041581040525] Membatalkan kerjasama bagi hasil', '0081578813144', NULL, '2020-03-22', '16:39:28'),
(695, '[BATAL][BAGI HASIL][0041581040525] Membatalkan kerjasama bagi hasil', '0081578813144', NULL, '2020-03-22', '16:41:24'),
(696, '[HAPUS][BAGI HASIL][0041584780552] Menghapus kerjasama bagi hasil', '0081578813144', NULL, '2020-03-22', '16:41:36'),
(697, '[BATAL][BAGI HASIL][0041581040525] Membatalkan kerjasama bagi hasil', '0081578813144', NULL, '2020-03-22', '16:44:05'),
(698, '[HAPUS][BAGI HASIL USAHA][0091584624561] Menghapus pembagian hasil usaha tahun 2020', '0081578813144', NULL, '2020-03-23', '12:05:49'),
(699, '[HAPUS][ASET][0051581245007] Menghapus Pesawat dari daftar aset', '0081578813144', NULL, '2020-03-23', '12:41:26'),
(700, '[HAPUS][ASET][0051583927869] Menghapus Boeing 747-400 dari daftar aset', '0081578813144', NULL, '2020-03-23', '12:41:53'),
(701, '[HAPUS][ASET][0051583926662] Menghapus Airbus A340-400M dari daftar aset', '0081578813144', NULL, '2020-03-23', '12:42:14'),
(702, '[TAMBAH][KEUANGAN][BELI ASET][0061584942265][0051584942263] Pembelian aset Boeing 747-8 dengan kondisi Baru, dan keadaan Baik', '0081578813144', NULL, '2020-03-23', '12:44:25'),
(703, '[TAMBAH][ASET][0051584942263] Penambahan aset Boeing 747-8 dengan kondisi Baru dalam keadaan Baik melalui proses Beli', '0081578813144', NULL, '2020-03-23', '12:44:25'),
(704, '[HAPUS][ASET][0051584942263] Menghapus Boeing 747-8 dari daftar aset', '0081578813144', NULL, '2020-03-23', '13:04:10'),
(705, '[HAPUS][KEUANGAN][BELI ASET][0061584942265][0051584942263] Menghapus kas keluar (Kredit) untuk pembelian aset', '0081578813144', NULL, '2020-03-23', '13:04:10'),
(706, '[TAMBAH][KEUANGAN][0061584943539] Menambah transaksi kas Masuk (Debit) sebesar Rp. 5000000', '0081578813144', NULL, '2020-03-23', '13:05:39'),
(707, '[TAMBAH][KEUANGAN][0061584943564] Menambah transaksi kas Keluar (Kredit) sebesar Rp. 2000000', '0081578813144', NULL, '2020-03-23', '13:06:04'),
(708, '[HAPUS][KEUANGAN][0061584943539] Menghapus transaksi keuangan', '0081578813144', NULL, '2020-03-23', '13:06:24'),
(709, '[HAPUS][KEUANGAN][0061584943564] Menghapus transaksi keuangan', '0081578813144', NULL, '2020-03-23', '13:06:39'),
(710, '[HAPUS][USER][0081583736792] Menghapus carix dari daftar pengguna sistem', '0081578813144', NULL, '2020-03-23', '13:07:10'),
(711, '[HAPUS][REKANAN][0071583929166] Menghapus Google Inc Corp dari daftar rekanan usaha BUMDes', '0081578813144', NULL, '2020-03-23', '13:07:41'),
(712, '[EDIT][BAGI HASIL][0041581040525] Perubahan kerjasama bagi hasil Airbus A380 dengan PT. Maju kena mundur kena (Persero) Tbk dengan pembagian BUMDes 40% dan Mitra 60% mulai dari tanggal 03-01-2020 selama 12 bulan', '0081578813144', NULL, '2020-03-23', '22:00:53'),
(713, '[EDIT][BAGI HASIL][0041581040525] Perubahan kerjasama bagi hasil Airbus A380 dengan PT. Maju kena mundur kena (Persero) Tbk dengan pembagian BUMDes 40% dan Mitra 60% mulai dari tanggal 03-01-2020 selama 24 bulan', '0081578813144', NULL, '2020-03-23', '22:03:15'),
(714, '[TAMBAH][PEMBAYARAN][BAGI HASIL][4001585051720][0041581040525] Menambah pembayaran hasil dari kerjasama bagi hasil penggunaan aset', '0081578813144', NULL, '2020-03-24', '19:08:40'),
(715, '[TAMBAH][KEUANGAN][BAGI HASIL] [0061585051720][4001585051720] Menambah pemasukan dari kerjasama bagi hasil dengan  dari aset 24-03-2020', '0081578813144', NULL, '2020-03-24', '19:08:40'),
(716, '[TAMBAH][PEMBAYARAN][BAGI HASIL][4001585052066][0041581040525] Menambah pembayaran hasil dari kerjasama bagi hasil penggunaan aset', '0081578813144', NULL, '2020-03-24', '19:14:26'),
(717, '[TAMBAH][PEMBAYARAN][BAGI HASIL][4001585052076][0041581040525] Menambah pembayaran hasil dari kerjasama bagi hasil penggunaan aset', '0081578813144', NULL, '2020-03-24', '19:14:37'),
(718, '[TAMBAH][PEMBAYARAN][BAGI HASIL][4001585052206][0041581040525] Menambah pembayaran hasil dari kerjasama bagi hasil penggunaan aset', '0081578813144', NULL, '2020-03-24', '19:16:46');

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
('0071578756545', 'PT. Maju kena mundur kena (Persero) Tbk', 'Diego maradona | Edited', 'Jln. Jenderal Sudirman, Jakarta Utara, Indonesia | Edited', '09098768564300', NULL, 'Aktif'),
('0071583928891', 'AT&T Inc', 'Randall L. Stephenson', 'Dallas, Texas, United States', '0909-0404-0506', NULL, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pemb_bagi_hasil`
--

CREATE TABLE `pemb_bagi_hasil` (
  `id_pbgh` varchar(15) NOT NULL,
  `id_bagi` varchar(15) DEFAULT NULL,
  `pen_bumdes` int(11) NOT NULL,
  `pen_mitra` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `catatan` varchar(100) NOT NULL,
  `tanggal_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemb_bagi_hasil`
--

INSERT INTO `pemb_bagi_hasil` (`id_pbgh`, `id_bagi`, `pen_bumdes`, `pen_mitra`, `jumlah`, `catatan`, `tanggal_bayar`) VALUES
('4001584780551', '0041584780551', 0, 0, 500000, 'Pembayaran ke 1', '2020-05-20'),
('4001585051720', '0041581040525', 0, 0, 6000000, 'Test 1', '2020-03-24'),
('4001585052066', '0041581040525', 0, 0, 6000000, 'Test 2', '2020-03-24'),
('4001585052076', '0041581040525', 0, 0, 7000000, 'Test 3', '2020-03-24'),
('4001585052206', '0041581040525', 0, 0, 6000000, 'Test 4', '2020-03-24');

--
-- Triggers `pemb_bagi_hasil`
--
DELIMITER $$
CREATE TRIGGER `hitung_pembagian` BEFORE INSERT ON `pemb_bagi_hasil` FOR EACH ROW BEGIN
	DECLARE p_bumdes INT;
    DECLARE p_mitra INT;
    
    SET p_bumdes = (SELECT pers_bumdes FROM bagi_hasil_aset WHERE id_bgh=new.id_bagi);
    SET p_mitra = 100-p_bumdes;
    
    SET new.pen_bumdes = (p_bumdes/100)*new.jumlah;
    SET new.pen_mitra = (p_mitra/100)*new.jumlah;
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penerima_dividen`
--

CREATE TABLE `penerima_dividen` (
  `id_ent_div` varchar(15) NOT NULL,
  `id_div` varchar(15) NOT NULL,
  `entitas_div` varchar(100) NOT NULL,
  `pers_jumlah_div` int(11) NOT NULL,
  `status_pemb_div` varchar(3) DEFAULT NULL,
  `tanggal_pemb_div` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_sewa`, `deld_aset`, `aset`, `penyewa`, `kontak`, `tanggal_mulai`, `tanggal_selesai`, `harga`) VALUES
('0021580982432', NULL, '0051578736008', 'Robert', '080898768564', '2020-02-06', '2020-02-11', 3000000),
('0021581074602', NULL, '0051578813210', 'Robert Downey jr 2', '080898768564', '2020-02-07', '2020-02-13', 4800000),
('0021583981592', NULL, '0051583926662', 'Vladimir putin', '050504049376', '2020-03-12', '2020-03-19', 5700000);

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
  `tanggal_fin` date NOT NULL,
  `last_change` datetime NOT NULL,
  `foreg_id` varchar(15) DEFAULT NULL,
  `actor` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekap_keuangan`
--

INSERT INTO `rekap_keuangan` (`id_fin`, `jenis`, `keterangan`, `debit`, `kredit`, `sld`, `tanggal_fin`, `last_change`, `foreg_id`, `actor`) VALUES
('0061581957987', 'IN', 'Modal', 500000000, NULL, 500000000, '2020-02-17', '2020-02-17 23:46:27', NULL, 'User'),
('0061581986448', 'OUT', 'Pembelian/stok masuk Telur sebanyak 500 Kg', NULL, 800000, 479200000, '2020-02-18', '2020-02-18 07:40:48', '0011581986447', 'System'),
('0061581986770', 'OUT', 'Pembelian/stok masuk Uranium sebanyak 543 Pcs', NULL, 1500000, 476800000, '2020-02-18', '2020-02-18 07:46:10', '0011581986770', 'System'),
('0061581987008', 'OUT', 'Pembelian/stok masuk Telur sebanyak 70 Kg', NULL, 500000, 476300000, '2020-02-18', '2020-02-18 07:50:08', '0011581987008', 'System'),
('0061582002388', 'IN', 'Penerimaan dari penjualan Telur sebanyak 100 Kg untuk tujuan Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', 500000, NULL, 497600000, '2020-02-18', '2020-02-18 12:06:28', '0011582002388', 'System'),
('0061582002431', 'IN', 'Penerimaan dari penjualan Uranium sebanyak 3 Pcs untuk tujuan Non-distribusi', 600000, NULL, 498200000, '2020-02-18', '2020-02-18 12:07:11', '0011582002431', 'System'),
('0061582444700', 'OUT', 'Pembelian/stok masuk Telur sebanyak 600 Kg', NULL, 6000000, 492200000, '2020-02-23', '2020-02-23 14:58:20', '0011582444700', 'System'),
('0061582468819', 'IN', 'Penerimaan dari penjualan Uranium sebanyak 40 Pcs untuk tujuan Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', 1000000, NULL, 493200000, '2020-02-23', '2020-02-23 21:40:19', '0011582468818', 'System'),
('0061582644294', 'OUT', 'Pembelian/stok masuk Uranium sebanyak 200 Pcs', NULL, 5000000, 488200000, '2020-02-25', '2020-02-25 22:24:54', '0011582644294', 'System'),
('0061583489058', 'OUT', 'Pembelian logistik dagang Telur sebanyak 50 Kg', NULL, 100000, 492900000, '2020-03-04', '2020-03-06 17:04:18', '0011581988173', 'System'),
('0061583489755', 'OUT', 'Pembelian/stok masuk Uranium sebanyak 20 Pcs', NULL, 900000, 442000000, '2020-03-06', '2020-03-06 17:15:55', '0011583489754', 'System'),
('0061583489786', 'OUT', 'Pembelian/stok masuk Uranium sebanyak 50 Pcs', NULL, 2000000, 490000000, '2020-03-06', '2020-03-06 17:16:26', '0011583489786', 'System'),
('0061583489820', 'OUT', 'Pembelian logistik dagang Uranium sebanyak 40 Pcs', NULL, 50000000, 440000000, '2020-03-06', '2020-03-06 17:17:00', '0011583489700', 'System'),
('0061583542969', 'IN', 'Penerimaan dari penjualan Telur sebanyak 25 Kg untuk tujuan Distribusi kepada PT. Maju kena mundur kena (Persero) Tbk', 12000000, NULL, 425900000, '2020-03-06', '2020-03-12 09:49:59', '0011583490821', 'System'),
('0061583545261', 'OUT', 'Pembelian logistik dagang Pertamax sebanyak 15 Kg', NULL, 2500000, 423900000, '2020-03-05', '2020-03-12 09:30:44', '0011583301297', 'System'),
('0061583726343', 'OUT', 'Pembelian aset Excavator dengan kondisi Baru, keadaan Baik', NULL, 800000, 445200000, '2019-05-20', '2020-03-09 10:59:03', '0051583648399', 'System'),
('0061583727046', 'IN', 'Test fin1', 22000000, NULL, 462400000, '2020-03-09', '2020-03-09 12:17:36', NULL, 'User'),
('0061583927870', 'OUT', 'Pembelian aset Boeing 747-400 dengan kondisi Baru, keadaan Baik', NULL, 50000000, 412400000, '2020-03-11', '2020-03-11 18:57:50', '0051583927869', 'System'),
('0061583928369', 'IN', 'Pemasukan dari penjualan telur 20 Kg', 5000000, NULL, 417400000, '2020-03-11', '2020-03-11 19:06:09', NULL, 'User'),
('0061583928610', 'IN', 'Pemasukan dari penjualan telur 25 Kg', 5000000, NULL, 424400000, '2020-03-11', '2020-03-11 19:10:10', NULL, 'User'),
('0061583981593', 'IN', 'Penerimaan dari penyewaan aset Airbus A340-400M oleh Vladimir putin selama 7 hari, dimulai dari tanggal 12-03-2020', 5700000, NULL, 431600000, '2020-03-12', '2020-03-12 09:56:32', '0021583981592', 'System'),
('0061584627523', 'OUT', 'Pembelian/stok masuk Plutonium sebanyak 60 Pcs', NULL, 600000, 431000000, '2020-03-19', '2020-03-19 21:18:43', '0011584627522', 'System'),
('0061584628226', 'OUT', 'Pembelian/stok masuk Plutonium sebanyak 40 Pcs', NULL, 630000, 430140000, '2020-03-19', '2020-03-19 21:30:26', '0011584628226', 'System'),
('0061584634476', 'IN', 'Penerimaan dari penjualan Telur sebanyak 50 Kg untuk tujuan Distribusi kepada AT', 100000, NULL, 430240000, '2020-03-19', '2020-03-19 23:14:36', '0011584634475', 'System'),
('0061584634717', 'IN', 'Penerimaan dari penjualan Pertamax sebanyak 3 Kg untuk tujuan Distribusi kepada Google Inc Corp', 5098000, NULL, 435338000, '2020-03-19', '2020-03-19 23:18:37', '0011584634716', 'System'),
('0061584635513', 'IN', 'Penerimaan dari penjualan Telur sebanyak 5 Kg untuk tujuan Distribusi kepada AT', 200000, NULL, 435538000, '2020-03-19', '2020-03-19 23:31:53', '0011584635513', 'System'),
('0061585051720', 'IN', 'Pembayaran bagi hasil usaha dengan  dari aset 24-03-2020', 6000000, NULL, 441538000, '2020-03-24', '2020-03-24 19:08:40', '0041581040525', 'System');

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
(3, 'Pcs', 'Pieces'),
(4, 'Ton', NULL),
(7, 'M', NULL),
(8, 'Cm', NULL);

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
('0011581986447', '0071581917999', 'IN', 500, 1, 500, '2020-02-18', '2020-02-18 07:40:47'),
('0011581986770', '0071581949090', 'IN', 543, 3, 543, '2020-02-18', '2020-02-18 07:46:10'),
('0011581987008', '0071581917999', 'IN', 70, 1, 570, '2020-02-18', '2020-02-18 07:50:08'),
('0011581988173', '0071581917999', 'IN', 50, 1, 620, '2020-03-04', '2020-03-06 16:30:35'),
('0011582002388', '0071581917999', 'OUT', 100, 1, 520, '2020-02-18', '2020-02-18 12:06:28'),
('0011582002431', '0071581949090', 'OUT', 3, 3, 540, '2020-02-18', '2020-02-18 12:07:11'),
('0011582444700', '0071581917999', 'IN', 600, 1, 1120, '2020-02-23', '2020-02-23 14:58:20'),
('0011582468818', '0071581949090', 'OUT', 40, 4, 500, '2020-02-23', '2020-02-23 21:40:18'),
('0011582644294', '0071581949090', 'IN', 200, 3, 700, '2020-02-25', '2020-02-25 22:24:54'),
('0011583301297', '0071583299853', 'IN', 15, 1, 15, '2020-03-05', '2020-03-12 09:36:28'),
('0011583489700', '0071581949090', 'IN', 40, 3, 740, '2020-03-06', '2020-03-06 17:15:00'),
('0011583489754', '0071581949090', 'IN', 20, 3, 760, '2020-03-06', '2020-03-06 17:15:54'),
('0011583489786', '0071581949090', 'IN', 50, 3, 810, '2020-03-06', '2020-03-06 17:16:26'),
('0011583490821', '0071581917999', 'OUT', 25, 1, 595, '2020-03-06', '2020-03-06 21:54:13'),
('0011584627522', '0071583943120', 'IN', 60, 3, 60, '2020-03-19', '2020-03-19 21:18:42'),
('0011584628226', '0071583943120', 'IN', 40, 3, 100, '2020-03-19', '2020-03-19 21:30:26'),
('0011584634475', '0071581917999', 'OUT', 50, 1, 545, '2020-03-19', '2020-03-19 23:14:35'),
('0011584634716', '0071583299853', 'OUT', 3, 1, 12, '2020-03-19', '2020-03-19 23:18:36'),
('0011584635513', '0071581917999', 'OUT', 5, 1, 540, '2020-03-19', '2020-03-19 23:31:53');

--
-- Triggers `stok_item`
--
DELIMITER $$
CREATE TRIGGER `hapus_data_stok` BEFORE DELETE ON `stok_item` FOR EACH ROW BEGIN
	IF old.jenis = 'IN' THEN
    	DELETE FROM stok_masuk WHERE id_prb = old.id_stok;
    ELSE
    	DELETE FROM stok_keluar WHERE id_prb = old.id_stok;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_data_stok` BEFORE INSERT ON `stok_item` FOR EACH ROW BEGIN
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
DELIMITER $$
CREATE TRIGGER `update_data_stok` BEFORE UPDATE ON `stok_item` FOR EACH ROW BEGIN
	DECLARE stok_akhir int;
    DECLARE jumlah_data int;
    DECLARE temp int;
    
    SET stok_akhir = (select `stok` from `stok_item` WHERE komoditas=new.komoditas order by `last_change` DESC limit 1);
    SET jumlah_data = (SELECT COUNT(id_stok) FROM stok_item WHERE komoditas=new.komoditas);
    
    
    
    IF new.jumlah <> old.jumlah THEN
    	IF (jumlah_data=1) THEN
            SET new.stok =  new.jumlah;
        ELSE
            IF (new.jenis='IN') THEN
                IF (new.jumlah > old.jumlah) THEN
                    SET temp = new.jumlah - old.jumlah;
                    SET new.stok = stok_akhir + temp;
                ELSE
                    SET temp = old.jumlah - new.jumlah;
                    SET new.stok = stok_akhir - temp;
                END IF;
             ELSE
                IF (new.jumlah > old.jumlah) THEN
                    SET temp = new.jumlah - old.jumlah;
                    SET new.stok = stok_akhir - temp;
                ELSE
                    SET temp = old.jumlah - new.jumlah;
                    SET new.stok = stok_akhir + temp;
                END IF;
              END IF;
          END IF;
        SET new.last_change = NOW();
     END IF;
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
(2, '0011582002388', 'Distribusi', 500000, NULL, '0071578756545', ''),
(4, '0011582002431', 'Non-distribusi', 600000, NULL, NULL, ''),
(5, '0011582468818', 'Distribusi', 1000000, 200000, '0071578756545', 'Test counting margin'),
(6, '0011583490821', 'Distribusi', 12000000, 200000, '0071578756545', 'Test1'),
(7, '0011584634475', 'Distribusi', 100000, 0, '0071583928891', 'Test client 1'),
(8, '0011584634716', 'Distribusi', 5098000, 5023000, '0071583929166', 'Test client 2'),
(9, '0011584635513', 'Distribusi', 200000, 125000, '0071583928891', 'Test client 4');

--
-- Triggers `stok_keluar`
--
DELIMITER $$
CREATE TRIGGER `hitung_margin_insert` BEFORE INSERT ON `stok_keluar` FOR EACH ROW BEGIN
	DECLARE hgb int;
    DECLARE kom varchar(15);
    DECLARE total int;
    DECLARE total_out int;
    
    SET kom = (SELECT komoditas FROM stok_item WHERE id_stok=new.id_prb);
    SET hgb = (SELECT harga_beli FROM komoditas WHERE id_kom=kom);
    SET total_out = (SELECT jumlah FROM stok_item WHERE id_stok=new.id_prb);
    
    IF new.nilai_transaksi <> 0 THEN
    	SET total = new.nilai_transaksi-(total_out*hgb);
        IF total < 0 THEN
            SET new.margin = 0;
        ELSE
            SET new.margin = total;
        END IF;
    END IF;
    
END
$$
DELIMITER ;

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
(1, '0011581986447', 'Beli', 800000, ''),
(3, '0011581986770', 'Beli', 1500000, ''),
(4, '0011581987008', 'Beli', 500000, ''),
(5, '0011581988173', 'Beli', 100000, 'Test edit 06/03/2020'),
(6, '0011582444700', 'Beli', 6000000, ''),
(7, '0011582644294', 'Beli', 5000000, ''),
(8, '0011583301297', 'Beli', 2500000, 'Testt3'),
(9, '0011583489700', 'Beli', 50000000, ''),
(10, '0011583489754', 'Beli', 900000, ''),
(11, '0011583489786', 'Non-beli', NULL, ''),
(12, '0011584627522', 'Beli', 600000, 'Test client'),
(14, '0011584628226', 'Beli', 630000, 'Test client 3');

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
  ADD PRIMARY KEY (`id_gdiv`);

--
-- Indexes for table `histori_harga_komoditas`
--
ALTER TABLE `histori_harga_komoditas`
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
  ADD PRIMARY KEY (`id_pbgh`);

--
-- Indexes for table `penerima_dividen`
--
ALTER TABLE `penerima_dividen`
  ADD PRIMARY KEY (`id_ent_div`);

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
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `log_admin`
--
ALTER TABLE `log_admin`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=719;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
