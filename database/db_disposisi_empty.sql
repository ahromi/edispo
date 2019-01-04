-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2012 at 10:40 PM
-- Server version: 5.5.22
-- PHP Version: 5.3.10-1ubuntu3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_disposisi_new`
--
CREATE DATABASE `db_disposisi_new` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_disposisi_new`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berita`
--

CREATE TABLE IF NOT EXISTS `tbl_berita` (
  `arsip_kd` char(20) NOT NULL,
  `berita_kd` char(50) NOT NULL,
  `jenis_kd` int(2) NOT NULL,
  `sifat_kd` int(2) NOT NULL,
  `perwakilan_kd` int(3) NOT NULL,
  `jabatan_pengirim` varchar(50) NOT NULL,
  `derajat_kd` char(3) NOT NULL,
  `tgl_berita` date NOT NULL,
  `tgl_diarsipkan` date NOT NULL,
  `perihal_berita` varchar(255) NOT NULL,
  `berita_file` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_disposisi` char(1) NOT NULL DEFAULT 'T',
  `berita_disposisikan` char(1) NOT NULL DEFAULT 'T',
  PRIMARY KEY (`arsip_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_derajat`
--

CREATE TABLE IF NOT EXISTS `tbl_derajat` (
  `derajat_kd` char(3) NOT NULL,
  `derajat_nama` char(20) NOT NULL,
  PRIMARY KEY (`derajat_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_derajat`
--

INSERT INTO `tbl_derajat` (`derajat_kd`, `derajat_nama`) VALUES
('000', 'Biasa'),
('111', 'Segera'),
('222', 'Sangat Segera'),
('333', 'Kilat');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disposisi`
--

CREATE TABLE IF NOT EXISTS `tbl_disposisi` (
  `disposisi_kd` int(10) NOT NULL AUTO_INCREMENT,
  `arsip_kd` char(20) NOT NULL,
  `tgl_disposisi` date NOT NULL,
  `disposisi_oleh` int(2) NOT NULL,
  `catatan` text NOT NULL,
  PRIMARY KEY (`disposisi_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disposisi_detail`
--

CREATE TABLE IF NOT EXISTS `tbl_disposisi_detail` (
  `disposisi_detail_kd` int(10) NOT NULL AUTO_INCREMENT,
  `disposisi_kd` int(10) NOT NULL,
  `detail_fungsi_kd` int(2) NOT NULL,
  `detail_terima` char(1) NOT NULL DEFAULT 'T',
  `detail_korespondensi` text NOT NULL,
  PRIMARY KEY (`disposisi_detail_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disposisi_instruksi`
--

CREATE TABLE IF NOT EXISTS `tbl_disposisi_instruksi` (
  `disposisi_instruksi_kd` int(11) NOT NULL AUTO_INCREMENT,
  `arsip_kd` char(20) NOT NULL,
  `instruksi_kd` int(11) NOT NULL,
  PRIMARY KEY (`disposisi_instruksi_kd`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fungsi`
--

CREATE TABLE IF NOT EXISTS `tbl_fungsi` (
  `fungsi_kd` int(2) NOT NULL AUTO_INCREMENT,
  `nama_fungsi` varchar(150) NOT NULL,
  `status_fungsi` char(1) NOT NULL DEFAULT 'Y',
  `disposisi_fungsi` char(1) NOT NULL DEFAULT 'T',
  PRIMARY KEY (`fungsi_kd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_fungsi`
--

INSERT INTO `tbl_fungsi` (`fungsi_kd`, `nama_fungsi`, `status_fungsi`, `disposisi_fungsi`) VALUES
(1, '', 'Y', 'Y'),
(2, 'Petugas Komunikasi', 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instruksi`
--

CREATE TABLE IF NOT EXISTS `tbl_instruksi` (
  `instruksi_kd` int(11) NOT NULL AUTO_INCREMENT,
  `instruksi_nama` varchar(100) NOT NULL,
  `instruksi_status` varchar(20) NOT NULL DEFAULT 'Aktif',
  PRIMARY KEY (`instruksi_kd`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_instruksi`
--

INSERT INTO `tbl_instruksi` (`instruksi_kd`, `instruksi_nama`, `instruksi_status`) VALUES
(1, 'Untuk Diketahui', 'Aktif'),
(2, 'Untuk Diselesaikan', 'Aktif'),
(3, 'Temui Saya', 'Aktif'),
(4, 'Untuk Didiskusikan', 'Aktif'),
(5, 'Laporan', 'Aktif'),
(6, 'Tanggapan', 'Aktif'),
(7, 'Check', 'Aktif'),
(8, 'Siapkan Jawaban', 'Aktif'),
(9, 'Untuk Perhatian', 'Aktif'),
(10, 'Catat & kembalikan kepada saya', 'Aktif'),
(11, 'File', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_berita`
--

CREATE TABLE IF NOT EXISTS `tbl_jenis_berita` (
  `jenis_kd` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_nama` char(35) NOT NULL,
  PRIMARY KEY (`jenis_kd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_jenis_berita`
--

INSERT INTO `tbl_jenis_berita` (`jenis_kd`, `jenis_nama`) VALUES
(1, 'Berita Perwakilan'),
(2, 'Berita Kemlu'),
(3, 'Berita Ucapan'),
(4, 'Berita DWP'),
(5, 'Berita Faksimil');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perwakilan`
--

CREATE TABLE IF NOT EXISTS `tbl_perwakilan` (
  `perwakilan_kd` int(3) NOT NULL AUTO_INCREMENT,
  `perwakilan_nama` char(100) NOT NULL,
  PRIMARY KEY (`perwakilan_kd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `tbl_perwakilan`
--

INSERT INTO `tbl_perwakilan` (`perwakilan_kd`, `perwakilan_nama`) VALUES
(1, 'Kementerian Luar Negeri'),
(2, 'Abudhabi'),
(3, 'Vanimo'),
(4, 'Phnompenh'),
(5, 'PTRI NEW YORK'),
(6, 'PTRI JENEWA'),
(7, 'DILI'),
(8, 'DEPLU + ALL PWK'),
(9, 'LISABON'),
(10, 'LONDON'),
(11, 'KUALA LUMPUR'),
(12, 'KUWAIT'),
(13, 'PRIME BRUSSELS'),
(14, 'PRETORIA'),
(15, 'Abu Dhabi'),
(16, 'Addis Ababa'),
(17, 'Alger'),
(18, 'Amman'),
(19, 'Ankara'),
(20, 'Antananrivo'),
(21, 'Athena'),
(22, 'Bangkok'),
(23, 'Beijing'),
(24, 'Beirut'),
(25, 'Beograd'),
(26, 'Berlin'),
(27, 'Bern'),
(28, 'Bogota'),
(29, 'Brasilia'),
(30, 'Bratislava'),
(31, 'KBRI Brussel'),
(32, 'Brussel ME'),
(33, 'Bs. Begawan'),
(34, 'Bucharest'),
(35, 'Budapest'),
(36, 'Buenos Aires'),
(37, 'Cairo'),
(38, 'Canberra'),
(39, 'Caracas'),
(40, 'Colombo'),
(41, 'Dakar'),
(42, 'Damaskus'),
(43, 'Dar Essalaam'),
(44, 'Den haag'),
(45, 'Deplu'),
(46, 'Dili'),
(47, 'Doha'),
(48, 'Hanoi'),
(49, 'Harare'),
(50, 'Havana'),
(51, 'Helsinki'),
(52, 'Hong Kong'),
(53, 'Islamabad'),
(54, 'Jenewa'),
(55, 'Kabul'),
(56, 'Khartoum'),
(57, 'Kopenhagen'),
(58, 'Kuala Lumpur'),
(59, 'Kuwait'),
(60, 'Kyiv'),
(61, 'Lagos'),
(62, 'Lima'),
(63, 'Lisabon'),
(64, 'London'),
(65, 'Madrid'),
(66, 'Manila'),
(67, 'Mexico'),
(68, 'Moskow'),
(69, 'Nairobi'),
(70, 'New Delhi'),
(71, 'New York'),
(72, 'Oslo'),
(73, 'Ottawa'),
(74, 'Paramaribo'),
(75, 'Paris'),
(76, 'Phnom Penh'),
(77, 'Port Moresby'),
(78, 'Praha'),
(79, 'Pretoria'),
(80, 'Prime Brussel'),
(81, 'Pyongyang'),
(82, 'Rabat'),
(83, 'Riyadh'),
(84, 'Roma'),
(85, 'Sanaa'),
(86, 'Santiago'),
(87, 'Seoul'),
(88, 'Singapura'),
(89, 'Sofia'),
(90, 'Stockholm'),
(91, 'Tashkent'),
(92, 'Tehran'),
(93, 'Tokyo'),
(94, 'Tripoli'),
(95, 'Tunis'),
(96, 'Vanimo'),
(97, 'Vatikan'),
(98, 'Vientiane'),
(99, 'Washington'),
(100, 'Wellington'),
(101, 'Wina'),
(102, 'Windhoek'),
(103, 'Yangon'),
(104, 'Cape Town'),
(105, 'Melbourne'),
(106, 'Los Angeles'),
(107, 'Ho Chi Minh'),
(108, 'Johor Bahru'),
(109, 'Penang'),
(110, 'Kota Kinabalu'),
(111, 'Kuching'),
(112, 'Abuja'),
(113, 'DIRCO'),
(114, 'DPR-RI'),
(115, 'Kementerian Perdagangan'),
(116, 'Dharma Wanita Persatuan'),
(117, 'African National Congress (ANC'),
(118, 'The Embassy of The Republic of Myanmar'),
(119, 'Panamacity'),
(120, 'Toronto'),
(121, 'Hamburg'),
(122, 'Quito'),
(123, 'Jeddah'),
(124, 'Seoul'),
(125, 'Embassy of Peru In Pretoria'),
(126, 'Embassy of the Republic of Peru'),
(127, 'Manama'),
(128, 'Manama'),
(129, 'Rep. Taipei LO in RSA'),
(130, 'Maputo'),
(131, 'Turki'),
(132, 'Osaka'),
(133, 'The embassy of Vietnam'),
(134, 'The Department of International Relations and Cooperation of the Republic of South Africa'),
(135, 'Dubai'),
(136, 'KA BAIS TNI'),
(137, 'BAIS TNI'),
(138, 'The Embassy of the Republic of Serbia'),
(139, 'THE DEMOCRATIC SOCIALIST REPUBLIC OF SRILANKA'),
(140, 'Ministry of Foreign Affairs an International Cooperation Libyan Embassy'),
(141, 'The High Commission of the Republic of Singapore'),
(142, 'The Embassy of the Republic of Cuba'),
(143, 'Songkhla'),
(144, 'Davao City'),
(145, 'Guangzhou'),
(146, 'the JOSIAH KATZ ROYAL'),
(147, 'Ghana High Comission'),
(148, 'Perth'),
(149, 'Atlantic Internet Service Provider'),
(150, 'High Commision Of Malaysia'),
(151, 'Suriname'),
(152, 'Warsawa'),
(153, 'The Embassy of The Peoples Republic of China'),
(154, 'Suva'),
(155, 'Astana'),
(156, 'Muscat'),
(157, 'The MInistry of Foreign Affairs and International Cooperation of the Kingdom of Swaziland presents'),
(158, 'Consul General of the Republic of Indonesia Swaziland'),
(159, 'Kwazulu'),
(160, 'Mumbai'),
(161, 'Western Cape');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE IF NOT EXISTS `tbl_setting` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama_perwakilan` varchar(100) DEFAULT NULL,
  `nama_singkat_perwakilan` varchar(100) DEFAULT NULL,
  `nama_jabatan_kepala_perwakilan` varchar(100) DEFAULT NULL,
  `warna_latar` varchar(20) DEFAULT NULL,
  `alamat_perwakilan` varchar(255) DEFAULT NULL,
  `email_administrator` varchar(50) DEFAULT NULL,
  `email_administrator_password` varchar(50) NOT NULL,
  `user_notifikasi_email` char(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `nama_perwakilan`, `nama_singkat_perwakilan`, `nama_jabatan_kepala_perwakilan`, `warna_latar`, `alamat_perwakilan`, `email_administrator`, `email_administrator_password`, `user_notifikasi_email`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sifat`
--

CREATE TABLE IF NOT EXISTS `tbl_sifat` (
  `sifat_kd` int(3) NOT NULL AUTO_INCREMENT,
  `sifat_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`sifat_kd`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_sifat`
--

INSERT INTO `tbl_sifat` (`sifat_kd`, `sifat_nama`) VALUES
(1, 'Biasa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_kd` int(2) NOT NULL AUTO_INCREMENT,
  `user_nama` char(25) NOT NULL,
  `user_password` char(50) NOT NULL,
  `user_namalengkap` char(40) NOT NULL,
  `fungsi_kd` int(2) NOT NULL,
  `user_status` char(1) NOT NULL,
  `user_foto` varchar(100) NOT NULL DEFAULT 'avatar.jpg',
  `user_email` varchar(50) NOT NULL,
  `user_notifikasi_email` varchar(50) NOT NULL,
  PRIMARY KEY (`user_kd`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_kd`, `user_nama`, `user_password`, `user_namalengkap`, `fungsi_kd`, `user_status`, `user_foto`, `user_email`, `user_notifikasi_email`) VALUES
(1, '', '', '', 1, 'Y', 'avatar.jpg', '', ''),
(2, '', '', '', 1, 'Y', 'avatar.jpg', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
