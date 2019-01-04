/*
Navicat MySQL Data Transfer

Source Server         : lokal
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_disposisi_new

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-01-04 09:28:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cetak_sp`
-- ----------------------------
DROP TABLE IF EXISTS `cetak_sp`;
CREATE TABLE `cetak_sp` (
  `sp_id` int(11) NOT NULL AUTO_INCREMENT,
  `sp_number` varchar(100) NOT NULL,
  `print_date` datetime DEFAULT NULL,
  `printed_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sp_id`),
  UNIQUE KEY `sp_number_UNIQUE` (`sp_number`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of cetak_sp
-- ----------------------------
INSERT INTO `cetak_sp` VALUES ('9', '01/SP/WSH-CHG/III/18', '2018-03-06 10:49:35', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('10', '02/SP/WSH-CHG/III/18', '2018-03-08 10:05:29', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('11', '01/SP/WSH-HST/III/18', '2018-03-08 10:06:08', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('12', '03/SP/WSH-CHG/III/18', '2018-03-08 10:34:24', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('13', '02/SP/WSH-HST/III/18', '2018-03-08 10:35:47', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('14', '04/SP/WSH-CHG/III/18', '2018-03-08 11:37:41', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('15', '03/SP/WSH-HST/III/18', '2018-03-08 11:37:47', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('16', '05/SP/WSH-CHG/III/18', '2018-03-15 09:21:24', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('17', '04/SP/WSH-HST/III/18', '2018-03-15 09:22:25', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('18', '06/SP/WSH-CHG/III/18', '2018-03-22 11:07:23', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('19', '05/SP/WSH-HST/III/18', '2018-03-22 11:07:28', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('23', '07/SP/WSH-CHG/III/18', '2018-03-29 15:30:35', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('24', '06/SP/WSH-HST/III/18', '2018-03-29 15:30:40', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('30', '07/SP/WSH-HST/IV/18', '2018-04-05 15:34:14', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('31', '08/SP/WSH-CHG/IV/18', '2018-04-05 15:34:31', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('32', '01/SP/WSH-SFC/IV/18', '2018-04-05 16:45:39', 'Faisal Mangoenkoesoemo');
INSERT INTO `cetak_sp` VALUES ('33', '09/SP/WSH-CHG/IV/18', '2018-04-12 09:37:12', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('34', '08/SP/WSH-HST/IV/18', '2018-04-12 09:37:18', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('35', '02/SP/WSH-SFC/IV/18', '2018-04-12 09:37:21', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('36', '10/SP/WSH-CHG/IV/18', '2018-04-12 09:45:51', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('37', '09/SP/WSH-HST/IV/18', '2018-04-12 09:45:56', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('38', '03/SP/WSH-SFC/IV/18', '2018-04-12 09:45:59', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('40', '04/SP/WSH-SFC/IV/18', '2018-04-16 09:59:49', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('48', '10/SP/WSH-HST/IV/18', '2018-04-20 09:38:01', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('49', '11/SP/WSH-CHG/IV/18', '2018-04-20 09:38:06', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('50', '12/SP/WSH-CHG/IV/18', '2018-04-26 10:28:33', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('51', '11/SP/WSH-HST/IV/18', '2018-04-26 10:28:35', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('52', '13/SP/WSH-CHG/V/18', '2018-05-03 09:35:01', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('53', '12/SP/WSH-HST/V/18', '2018-05-03 09:35:04', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('54', '14/SP/WSH-CHG/V/18', '2018-05-09 11:01:28', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('55', '13/SP/WSH-HST/V/18', '2018-05-09 11:01:32', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('56', '15/SP/WSH-CHG/V/18', '2018-05-14 14:34:17', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('57', '14/SP/WSH-HST/V/18', '2018-05-14 14:34:20', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('58', '16/SP/WSH-CHG/V/18', '2018-05-17 12:22:09', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('59', '15/SP/WSH-HST/V/18', '2018-05-17 12:22:11', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('60', '17/SP/WSH-CHG/V/18', '2018-05-24 14:08:27', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('61', '16/SP/WSH-HST/V/18', '2018-05-24 14:08:37', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('62', '18/SP/WSH-CHG/V/18', '2018-05-30 15:11:25', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('63', '17/SP/WSH-HST/V/18', '2018-05-30 15:11:27', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('64', '19/SP/WSH-CHG/VI/18', '2018-06-07 15:13:21', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('65', '18/SP/WSH-HST/VI/18', '2018-06-07 15:13:25', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('66', '19/SP/WSH-HST/VI/18', '2018-06-21 14:09:15', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('67', '20/SP/WSH-CHG/VI/18', '2018-06-21 14:09:39', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('68', '20/SP/WSH-HST/VI/18', '2018-06-28 14:20:22', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('69', '21/SP/WSH-CHG/VI/18', '2018-06-28 14:20:24', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('70', '22/SP/WSH-CHG/VII/18', '2018-07-05 14:26:34', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('71', '21/SP/WSH-HST/VII/18', '2018-07-05 14:26:52', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('74', '23/SP/WSH-CHG/VII/18', '2018-07-12 12:58:26', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('75', '22/SP/WSH-HST/VII/18', '2018-07-12 12:58:37', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('76', '24/SP/WSH-CHG/VII/18', '2018-07-19 14:05:37', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('77', '23/SP/WSH-HST/VII/18', '2018-07-19 14:05:40', 'komunikasi');
INSERT INTO `cetak_sp` VALUES ('78', '25/SP/WSH-CHG/VII/18', '2018-07-20 15:20:17', 'komunikasi');

-- ----------------------------
-- Table structure for `tbl_berita`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_berita`;
CREATE TABLE `tbl_berita` (
  `arsip_kd` char(20) NOT NULL,
  `berita_kd` char(50) NOT NULL,
  `jenis_kd` int(11) NOT NULL,
  `sifat_kd` int(3) NOT NULL,
  `perwakilan_kd` int(3) NOT NULL,
  `jabatan_pengirim` varchar(50) NOT NULL,
  `derajat_kd` char(3) NOT NULL,
  `tgl_berita` date NOT NULL,
  `tgl_diarsipkan` date NOT NULL,
  `perihal_berita` varchar(255) NOT NULL,
  `berita_file` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_disposisi` char(1) NOT NULL DEFAULT 'T',
  `tgl_disposisi` datetime DEFAULT NULL,
  `berita_disposisikan` char(1) NOT NULL DEFAULT 'T',
  `berita_fungsi_disposisi` int(2) NOT NULL COMMENT 'kd fungsi yang dapat melakukan disposisi',
  `berita_input_fungsi` int(2) NOT NULL COMMENT 'fungsi kd yang menginput berita ',
  `berita_berkas_disposisi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`arsip_kd`),
  KEY `fk_tbl_berita_tbl_jenis_berita1_idx` (`jenis_kd`),
  KEY `fk_tbl_berita_tbl_perwakilan1_idx` (`perwakilan_kd`),
  KEY `fk_tbl_berita_tbl_derajat1_idx` (`derajat_kd`),
  CONSTRAINT `fk_tbl_berita_tbl_derajat1` FOREIGN KEY (`derajat_kd`) REFERENCES `tbl_derajat` (`derajat_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_berita_tbl_jenis_berita1` FOREIGN KEY (`jenis_kd`) REFERENCES `tbl_jenis_berita` (`jenis_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_berita_tbl_perwakilan1` FOREIGN KEY (`perwakilan_kd`) REFERENCES `tbl_perwakilan` (`perwakilan_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_berita
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_berita_keluar`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_berita_keluar`;
CREATE TABLE `tbl_berita_keluar` (
  `arsip_kd` varchar(20) NOT NULL,
  `sifat_kd` int(3) DEFAULT NULL,
  `berita_kd` varchar(50) DEFAULT NULL,
  `fungsi_kd` int(2) DEFAULT NULL,
  `tgl_berita` date DEFAULT NULL,
  `perihal_berita` varchar(255) DEFAULT NULL,
  `berita_file` varchar(100) DEFAULT NULL,
  `no_agenda` varchar(10) DEFAULT NULL,
  `jml_hal` int(5) DEFAULT NULL,
  PRIMARY KEY (`arsip_kd`),
  KEY `fk_tbl_berita_keluar_tbl_fungsi1_idx` (`fungsi_kd`),
  CONSTRAINT `fk_tbl_berita_keluar_tbl_fungsi1` FOREIGN KEY (`fungsi_kd`) REFERENCES `tbl_fungsi` (`fungsi_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_berita_keluar
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_derajat`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_derajat`;
CREATE TABLE `tbl_derajat` (
  `derajat_kd` char(3) NOT NULL,
  `derajat_nama` char(20) NOT NULL,
  PRIMARY KEY (`derajat_kd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_derajat
-- ----------------------------
INSERT INTO `tbl_derajat` VALUES ('111', 'Segera');
INSERT INTO `tbl_derajat` VALUES ('222', 'Sangat Segera');
INSERT INTO `tbl_derajat` VALUES ('333', 'Kilat');

-- ----------------------------
-- Table structure for `tbl_detail_berita`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_detail_berita`;
CREATE TABLE `tbl_detail_berita` (
  `detail_berita_id` int(11) NOT NULL AUTO_INCREMENT,
  `halaman` int(11) DEFAULT NULL,
  `pwk_code` varchar(5) DEFAULT NULL,
  `arsip_kd` char(20) DEFAULT NULL,
  `sp_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`detail_berita_id`),
  KEY `fk_table1_tbl_berita1_idx` (`arsip_kd`),
  KEY `fk_tbl_detail_berita_cetak_sp1_idx` (`sp_id`),
  CONSTRAINT `fk_table1_tbl_berita1` FOREIGN KEY (`arsip_kd`) REFERENCES `tbl_berita` (`arsip_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_detail_berita_cetak_sp1` FOREIGN KEY (`sp_id`) REFERENCES `cetak_sp` (`sp_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_detail_berita
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_disposisi`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_disposisi`;
CREATE TABLE `tbl_disposisi` (
  `disposisi_kd` int(10) NOT NULL AUTO_INCREMENT,
  `arsip_kd` char(20) NOT NULL,
  `tgl_disposisi` date NOT NULL,
  `disposisi_oleh` int(2) NOT NULL,
  `catatan` text NOT NULL,
  `disposisi_lanjutan` char(1) NOT NULL DEFAULT 'T' COMMENT 'Y=disposisi lanjutan; T=bukan dispo lanjutan',
  PRIMARY KEY (`disposisi_kd`),
  KEY `fk_tbl_disposisi_tbl_berita_idx` (`arsip_kd`),
  CONSTRAINT `fk_tbl_disposisi_tbl_berita` FOREIGN KEY (`arsip_kd`) REFERENCES `tbl_berita` (`arsip_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_disposisi
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_disposisi_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_disposisi_detail`;
CREATE TABLE `tbl_disposisi_detail` (
  `disposisi_detail_kd` int(10) NOT NULL AUTO_INCREMENT,
  `disposisi_kd` int(10) NOT NULL,
  `detail_fungsi_kd` int(2) NOT NULL,
  `detail_terima` char(1) NOT NULL DEFAULT 'T',
  `detail_korespondensi` text NOT NULL,
  `detail_waktu` datetime DEFAULT NULL,
  `berita_status_pengerjaan` char(1) DEFAULT NULL,
  `detail_perhatian` char(1) DEFAULT NULL,
  PRIMARY KEY (`disposisi_detail_kd`),
  KEY `fk_tbl_disposisi_detail_tbl_disposisi1_idx` (`disposisi_kd`),
  CONSTRAINT `fk_tbl_disposisi_detail_tbl_disposisi1` FOREIGN KEY (`disposisi_kd`) REFERENCES `tbl_disposisi` (`disposisi_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_disposisi_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_disposisi_instruksi`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_disposisi_instruksi`;
CREATE TABLE `tbl_disposisi_instruksi` (
  `disposisi_instruksi_kd` int(11) NOT NULL AUTO_INCREMENT,
  `arsip_kd` char(20) NOT NULL,
  `instruksi_kd` int(11) NOT NULL,
  `instruksi_perhatian` char(1) DEFAULT NULL,
  PRIMARY KEY (`disposisi_instruksi_kd`),
  KEY `fk_tbl_disposisi_instruksi_tbl_berita1_idx` (`arsip_kd`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_disposisi_instruksi
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_disposisi_lanjutan`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_disposisi_lanjutan`;
CREATE TABLE `tbl_disposisi_lanjutan` (
  `disposisi_lanjutan_kd` int(11) NOT NULL AUTO_INCREMENT,
  `arsip_kd` char(20) NOT NULL,
  `disposisi_lanjutan_oleh` int(2) NOT NULL,
  `disposisi_lanjutan_catatan` varchar(255) NOT NULL,
  `disposisi_lanjutan_tanggal` datetime NOT NULL,
  PRIMARY KEY (`disposisi_lanjutan_kd`),
  KEY `fk_tbl_disposisi_lanjutan_tbl_berita1_idx` (`arsip_kd`),
  CONSTRAINT `fk_tbl_disposisi_lanjutan_tbl_berita1` FOREIGN KEY (`arsip_kd`) REFERENCES `tbl_berita` (`arsip_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14366 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_disposisi_lanjutan
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_disposisi_lanjutan_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_disposisi_lanjutan_detail`;
CREATE TABLE `tbl_disposisi_lanjutan_detail` (
  `disposisi_lanjutan_detail_kd` int(11) NOT NULL AUTO_INCREMENT,
  `disposisi_lanjutan_kd` int(11) NOT NULL,
  `detail_user_kd` int(2) NOT NULL,
  `detail_terima` char(1) NOT NULL DEFAULT 'T',
  `detail_korespondensi` varchar(255) DEFAULT NULL,
  `detail_waktu` datetime DEFAULT NULL,
  `berita_status_pengerjaan` char(1) DEFAULT NULL,
  PRIMARY KEY (`disposisi_lanjutan_detail_kd`),
  KEY `fk_tbl_disposisi_lanjutan_detail_tbl_disposisi_lanjutan1_idx` (`disposisi_lanjutan_kd`),
  CONSTRAINT `fk_tbl_disposisi_lanjutan_detail_tbl_disposisi_lanjutan1` FOREIGN KEY (`disposisi_lanjutan_kd`) REFERENCES `tbl_disposisi_lanjutan` (`disposisi_lanjutan_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_disposisi_lanjutan_detail
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_disposisi_lanjutan_instruksi`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_disposisi_lanjutan_instruksi`;
CREATE TABLE `tbl_disposisi_lanjutan_instruksi` (
  `disposisi_lanjutan_instruksi_kd` int(11) NOT NULL AUTO_INCREMENT,
  `disposisi_lanjutan_kd` int(11) NOT NULL,
  `instruksi_kd` int(11) NOT NULL,
  PRIMARY KEY (`disposisi_lanjutan_instruksi_kd`),
  KEY `fk_tbl_disposisi_lanjutan_instruksi_tbl_disposisi_lanjutan1_idx` (`disposisi_lanjutan_kd`),
  CONSTRAINT `fk_tbl_disposisi_lanjutan_instruksi_tbl_disposisi_lanjutan1` FOREIGN KEY (`disposisi_lanjutan_kd`) REFERENCES `tbl_disposisi_lanjutan` (`disposisi_lanjutan_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_disposisi_lanjutan_instruksi
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_fungsi`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_fungsi`;
CREATE TABLE `tbl_fungsi` (
  `fungsi_kd` int(2) NOT NULL AUTO_INCREMENT,
  `nama_fungsi` varchar(150) NOT NULL,
  `status_fungsi` char(1) NOT NULL DEFAULT 'Y',
  `disposisi_fungsi` char(1) NOT NULL DEFAULT 'T',
  `fungsi_input` char(1) NOT NULL DEFAULT 'T',
  `fungsi_urut` int(2) NOT NULL,
  PRIMARY KEY (`fungsi_kd`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_fungsi
-- ----------------------------
INSERT INTO `tbl_fungsi` VALUES ('1', 'Konsul Jenderal', 'Y', 'Y', 'T', '1');
INSERT INTO `tbl_fungsi` VALUES ('2', 'Komunikasi', 'Y', 'T', 'Y', '13');
INSERT INTO `tbl_fungsi` VALUES ('3', 'Setpim', 'Y', 'T', 'Y', '17');
INSERT INTO `tbl_fungsi` VALUES ('30', 'DCM', 'T', 'T', 'T', '1');
INSERT INTO `tbl_fungsi` VALUES ('31', 'Politik', 'Y', 'T', 'T', '2');
INSERT INTO `tbl_fungsi` VALUES ('32', 'Ekonomi/HOC', 'Y', 'Y', 'T', '3');
INSERT INTO `tbl_fungsi` VALUES ('33', 'Penerangan', 'Y', 'T', 'T', '4');
INSERT INTO `tbl_fungsi` VALUES ('34', 'Protkons', 'Y', 'T', 'T', '5');
INSERT INTO `tbl_fungsi` VALUES ('35', 'Pertahanan', 'Y', 'T', 'T', '6');
INSERT INTO `tbl_fungsi` VALUES ('37', 'BIN', 'Y', 'T', 'T', '16');
INSERT INTO `tbl_fungsi` VALUES ('38', 'Perdagangan', 'Y', 'T', 'T', '8');
INSERT INTO `tbl_fungsi` VALUES ('39', 'Pendidikan', 'Y', 'T', 'T', '9');
INSERT INTO `tbl_fungsi` VALUES ('40', 'Perhubungan', 'Y', 'T', 'T', '10');
INSERT INTO `tbl_fungsi` VALUES ('41', 'Pertanian', 'Y', 'T', 'T', '11');
INSERT INTO `tbl_fungsi` VALUES ('42', 'Keuangan', 'Y', 'T', 'T', '14');
INSERT INTO `tbl_fungsi` VALUES ('43', 'Kepolisian', 'Y', 'T', 'T', '7');
INSERT INTO `tbl_fungsi` VALUES ('44', 'Asisten HOC', 'Y', 'T', 'T', '12');
INSERT INTO `tbl_fungsi` VALUES ('45', 'Perlengkapan', 'Y', 'T', 'T', '15');

-- ----------------------------
-- Table structure for `tbl_instruksi`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_instruksi`;
CREATE TABLE `tbl_instruksi` (
  `instruksi_kd` int(11) NOT NULL AUTO_INCREMENT,
  `instruksi_nama` varchar(100) NOT NULL,
  `instruksi_status` varchar(20) NOT NULL DEFAULT 'Aktif',
  `instruksi_order` int(2) DEFAULT NULL,
  PRIMARY KEY (`instruksi_kd`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_instruksi
-- ----------------------------
INSERT INTO `tbl_instruksi` VALUES ('1', 'Untuk Diselesaikan', 'Aktif', '1');
INSERT INTO `tbl_instruksi` VALUES ('2', 'Pelajari', 'Aktif', '2');
INSERT INTO `tbl_instruksi` VALUES ('3', 'Siapkan Jawaban', 'Aktif', '3');
INSERT INTO `tbl_instruksi` VALUES ('4', 'Untuk Perhatian', 'Aktif', '4');
INSERT INTO `tbl_instruksi` VALUES ('5', 'Untuk Diketahui', 'Aktif', '5');
INSERT INTO `tbl_instruksi` VALUES ('6', 'Bahas Bersama', 'Aktif', '6');
INSERT INTO `tbl_instruksi` VALUES ('7', 'Check', 'Aktif', '7');
INSERT INTO `tbl_instruksi` VALUES ('8', 'Untuk Diteruskan', 'Aktif', '8');
INSERT INTO `tbl_instruksi` VALUES ('9', 'Edarkan', 'Aktif', '9');
INSERT INTO `tbl_instruksi` VALUES ('10', 'Copy Untuk Saya', 'Aktif', '10');
INSERT INTO `tbl_instruksi` VALUES ('11', 'File', 'Aktif', '11');

-- ----------------------------
-- Table structure for `tbl_jenis_berita`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_jenis_berita`;
CREATE TABLE `tbl_jenis_berita` (
  `jenis_kd` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_nama` char(35) NOT NULL,
  PRIMARY KEY (`jenis_kd`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_jenis_berita
-- ----------------------------
INSERT INTO `tbl_jenis_berita` VALUES ('1', 'BERITA');
INSERT INTO `tbl_jenis_berita` VALUES ('2', 'FAKSIMILE');
INSERT INTO `tbl_jenis_berita` VALUES ('3', 'SURAT');
INSERT INTO `tbl_jenis_berita` VALUES ('4', 'NOTA DINAS');

-- ----------------------------
-- Table structure for `tbl_korespondensi`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_korespondensi`;
CREATE TABLE `tbl_korespondensi` (
  `korespondensi_id` int(5) NOT NULL AUTO_INCREMENT,
  `arsip_kd` varchar(20) NOT NULL,
  `user_nama` varchar(255) NOT NULL,
  `korespondensi_komentar` varchar(255) NOT NULL,
  `korespondensi_datetime` datetime NOT NULL,
  PRIMARY KEY (`korespondensi_id`),
  KEY `fk_tbl_korespondensi_tbl_berita1_idx` (`arsip_kd`),
  CONSTRAINT `fk_tbl_korespondensi_tbl_berita1` FOREIGN KEY (`arsip_kd`) REFERENCES `tbl_berita` (`arsip_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_korespondensi
-- ----------------------------

-- ----------------------------
-- Table structure for `tbl_perwakilan`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_perwakilan`;
CREATE TABLE `tbl_perwakilan` (
  `perwakilan_kd` int(3) NOT NULL AUTO_INCREMENT,
  `perwakilan_nama` char(100) NOT NULL,
  PRIMARY KEY (`perwakilan_kd`)
) ENGINE=InnoDB AUTO_INCREMENT=300 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_perwakilan
-- ----------------------------
INSERT INTO `tbl_perwakilan` VALUES ('1', 'Kementerian Luar Negeri');
INSERT INTO `tbl_perwakilan` VALUES ('3', 'Vanimo');
INSERT INTO `tbl_perwakilan` VALUES ('4', 'Phnompenh');
INSERT INTO `tbl_perwakilan` VALUES ('5', 'PTRI New York');
INSERT INTO `tbl_perwakilan` VALUES ('6', 'PTRI Jenewa');
INSERT INTO `tbl_perwakilan` VALUES ('7', 'Dili');
INSERT INTO `tbl_perwakilan` VALUES ('9', 'Lisabon');
INSERT INTO `tbl_perwakilan` VALUES ('10', 'London');
INSERT INTO `tbl_perwakilan` VALUES ('11', 'Kuala Lumpur');
INSERT INTO `tbl_perwakilan` VALUES ('12', 'Kuwait');
INSERT INTO `tbl_perwakilan` VALUES ('13', 'Prime Brussels');
INSERT INTO `tbl_perwakilan` VALUES ('14', 'Pretoria');
INSERT INTO `tbl_perwakilan` VALUES ('15', 'Abu Dhabi');
INSERT INTO `tbl_perwakilan` VALUES ('16', 'Addis Ababa');
INSERT INTO `tbl_perwakilan` VALUES ('17', 'Alger');
INSERT INTO `tbl_perwakilan` VALUES ('18', 'Amman');
INSERT INTO `tbl_perwakilan` VALUES ('19', 'Ankara');
INSERT INTO `tbl_perwakilan` VALUES ('20', 'Antananrivo');
INSERT INTO `tbl_perwakilan` VALUES ('21', 'Athena');
INSERT INTO `tbl_perwakilan` VALUES ('22', 'Bangkok');
INSERT INTO `tbl_perwakilan` VALUES ('23', 'Beijing');
INSERT INTO `tbl_perwakilan` VALUES ('24', 'Beirut');
INSERT INTO `tbl_perwakilan` VALUES ('25', 'Beograd');
INSERT INTO `tbl_perwakilan` VALUES ('26', 'Berlin');
INSERT INTO `tbl_perwakilan` VALUES ('27', 'Bern');
INSERT INTO `tbl_perwakilan` VALUES ('28', 'Bogota');
INSERT INTO `tbl_perwakilan` VALUES ('29', 'Brasilia');
INSERT INTO `tbl_perwakilan` VALUES ('30', 'Bratislava');
INSERT INTO `tbl_perwakilan` VALUES ('31', 'Brussel');
INSERT INTO `tbl_perwakilan` VALUES ('33', 'Bs. Begawan');
INSERT INTO `tbl_perwakilan` VALUES ('34', 'Bucharest');
INSERT INTO `tbl_perwakilan` VALUES ('35', 'Budapest');
INSERT INTO `tbl_perwakilan` VALUES ('36', 'Buenos Aires');
INSERT INTO `tbl_perwakilan` VALUES ('37', 'Cairo');
INSERT INTO `tbl_perwakilan` VALUES ('38', 'Canberra');
INSERT INTO `tbl_perwakilan` VALUES ('39', 'Caracas');
INSERT INTO `tbl_perwakilan` VALUES ('40', 'Colombo');
INSERT INTO `tbl_perwakilan` VALUES ('41', 'Dakar');
INSERT INTO `tbl_perwakilan` VALUES ('42', 'Damaskus');
INSERT INTO `tbl_perwakilan` VALUES ('43', 'Dar Essalaam');
INSERT INTO `tbl_perwakilan` VALUES ('44', 'Den haag');
INSERT INTO `tbl_perwakilan` VALUES ('45', 'Deplu');
INSERT INTO `tbl_perwakilan` VALUES ('46', 'Dili');
INSERT INTO `tbl_perwakilan` VALUES ('47', 'Doha');
INSERT INTO `tbl_perwakilan` VALUES ('48', 'Hanoi');
INSERT INTO `tbl_perwakilan` VALUES ('49', 'Harare');
INSERT INTO `tbl_perwakilan` VALUES ('50', 'Havana');
INSERT INTO `tbl_perwakilan` VALUES ('51', 'Helsinki');
INSERT INTO `tbl_perwakilan` VALUES ('52', 'Hong Kong');
INSERT INTO `tbl_perwakilan` VALUES ('53', 'Islamabad');
INSERT INTO `tbl_perwakilan` VALUES ('54', 'Jenewa');
INSERT INTO `tbl_perwakilan` VALUES ('55', 'Kabul');
INSERT INTO `tbl_perwakilan` VALUES ('56', 'Khartoum');
INSERT INTO `tbl_perwakilan` VALUES ('57', 'Kopenhagen');
INSERT INTO `tbl_perwakilan` VALUES ('58', 'Kuala Lumpur');
INSERT INTO `tbl_perwakilan` VALUES ('59', 'Kuwait');
INSERT INTO `tbl_perwakilan` VALUES ('60', 'Kyiv');
INSERT INTO `tbl_perwakilan` VALUES ('61', 'Lagos');
INSERT INTO `tbl_perwakilan` VALUES ('62', 'Lima');
INSERT INTO `tbl_perwakilan` VALUES ('63', 'Lisabon');
INSERT INTO `tbl_perwakilan` VALUES ('64', 'London');
INSERT INTO `tbl_perwakilan` VALUES ('65', 'Madrid');
INSERT INTO `tbl_perwakilan` VALUES ('66', 'Manila');
INSERT INTO `tbl_perwakilan` VALUES ('67', 'Mexico');
INSERT INTO `tbl_perwakilan` VALUES ('68', 'Moskow');
INSERT INTO `tbl_perwakilan` VALUES ('69', 'Nairobi');
INSERT INTO `tbl_perwakilan` VALUES ('70', 'New Delhi');
INSERT INTO `tbl_perwakilan` VALUES ('71', 'New York');
INSERT INTO `tbl_perwakilan` VALUES ('72', 'Oslo');
INSERT INTO `tbl_perwakilan` VALUES ('73', 'Ottawa');
INSERT INTO `tbl_perwakilan` VALUES ('74', 'Paramaribo');
INSERT INTO `tbl_perwakilan` VALUES ('75', 'Paris');
INSERT INTO `tbl_perwakilan` VALUES ('76', 'Phnom Penh');
INSERT INTO `tbl_perwakilan` VALUES ('77', 'Port Moresby');
INSERT INTO `tbl_perwakilan` VALUES ('78', 'Praha');
INSERT INTO `tbl_perwakilan` VALUES ('79', 'Pretoria');
INSERT INTO `tbl_perwakilan` VALUES ('80', 'Prime Brussel');
INSERT INTO `tbl_perwakilan` VALUES ('81', 'Pyongyang');
INSERT INTO `tbl_perwakilan` VALUES ('82', 'Rabat');
INSERT INTO `tbl_perwakilan` VALUES ('83', 'Riyadh');
INSERT INTO `tbl_perwakilan` VALUES ('84', 'Roma');
INSERT INTO `tbl_perwakilan` VALUES ('85', 'Sanaa');
INSERT INTO `tbl_perwakilan` VALUES ('86', 'Santiago');
INSERT INTO `tbl_perwakilan` VALUES ('87', 'Seoul');
INSERT INTO `tbl_perwakilan` VALUES ('88', 'Singapura');
INSERT INTO `tbl_perwakilan` VALUES ('89', 'Sofia');
INSERT INTO `tbl_perwakilan` VALUES ('90', 'Stockholm');
INSERT INTO `tbl_perwakilan` VALUES ('91', 'Tashkent');
INSERT INTO `tbl_perwakilan` VALUES ('92', 'Tehran');
INSERT INTO `tbl_perwakilan` VALUES ('93', 'Tokyo');
INSERT INTO `tbl_perwakilan` VALUES ('94', 'Tripoli');
INSERT INTO `tbl_perwakilan` VALUES ('95', 'Tunis');
INSERT INTO `tbl_perwakilan` VALUES ('96', 'Vanimo');
INSERT INTO `tbl_perwakilan` VALUES ('97', 'Vatikan');
INSERT INTO `tbl_perwakilan` VALUES ('98', 'Vientiane');
INSERT INTO `tbl_perwakilan` VALUES ('99', 'Washington');
INSERT INTO `tbl_perwakilan` VALUES ('100', 'Wellington');
INSERT INTO `tbl_perwakilan` VALUES ('101', 'Wina');
INSERT INTO `tbl_perwakilan` VALUES ('102', 'Windhoek');
INSERT INTO `tbl_perwakilan` VALUES ('103', 'Yangon');
INSERT INTO `tbl_perwakilan` VALUES ('104', 'Cape Town');
INSERT INTO `tbl_perwakilan` VALUES ('105', 'Melbourne');
INSERT INTO `tbl_perwakilan` VALUES ('106', 'Los Angeles');
INSERT INTO `tbl_perwakilan` VALUES ('107', 'Ho Chi Minh');
INSERT INTO `tbl_perwakilan` VALUES ('108', 'Johor Bahru');
INSERT INTO `tbl_perwakilan` VALUES ('109', 'Penang');
INSERT INTO `tbl_perwakilan` VALUES ('110', 'Kota Kinabalu');
INSERT INTO `tbl_perwakilan` VALUES ('111', 'Kuching');
INSERT INTO `tbl_perwakilan` VALUES ('112', 'Abuja');
INSERT INTO `tbl_perwakilan` VALUES ('113', 'DIRCO');
INSERT INTO `tbl_perwakilan` VALUES ('114', 'DPR-RI');
INSERT INTO `tbl_perwakilan` VALUES ('115', 'Kementerian Perdagangan');
INSERT INTO `tbl_perwakilan` VALUES ('116', 'Dharma Wanita Persatuan');
INSERT INTO `tbl_perwakilan` VALUES ('118', 'The Embassy of The Republic of Myanmar');
INSERT INTO `tbl_perwakilan` VALUES ('119', 'Panamacity');
INSERT INTO `tbl_perwakilan` VALUES ('120', 'Toronto');
INSERT INTO `tbl_perwakilan` VALUES ('121', 'Hamburg');
INSERT INTO `tbl_perwakilan` VALUES ('122', 'Quito');
INSERT INTO `tbl_perwakilan` VALUES ('123', 'Jeddah');
INSERT INTO `tbl_perwakilan` VALUES ('124', 'Seoul');
INSERT INTO `tbl_perwakilan` VALUES ('125', 'Embassy of Peru In Pretoria');
INSERT INTO `tbl_perwakilan` VALUES ('126', 'Embassy of the Republic of Peru');
INSERT INTO `tbl_perwakilan` VALUES ('127', 'Manama');
INSERT INTO `tbl_perwakilan` VALUES ('128', 'Manama');
INSERT INTO `tbl_perwakilan` VALUES ('129', 'Rep. Taipei LO in RSA');
INSERT INTO `tbl_perwakilan` VALUES ('130', 'Maputo');
INSERT INTO `tbl_perwakilan` VALUES ('131', 'Turki');
INSERT INTO `tbl_perwakilan` VALUES ('132', 'Osaka');
INSERT INTO `tbl_perwakilan` VALUES ('133', 'The embassy of Vietnam');
INSERT INTO `tbl_perwakilan` VALUES ('134', 'The Department of International Relations and Cooperation of the Republic of South Africa');
INSERT INTO `tbl_perwakilan` VALUES ('135', 'Dubai');
INSERT INTO `tbl_perwakilan` VALUES ('136', 'BAIS TNI');
INSERT INTO `tbl_perwakilan` VALUES ('137', 'MABES TNI');
INSERT INTO `tbl_perwakilan` VALUES ('138', 'The Embassy of the Republic of Serbia');
INSERT INTO `tbl_perwakilan` VALUES ('139', 'The Democratic Socialist Republic Of  Srilangka');
INSERT INTO `tbl_perwakilan` VALUES ('140', 'Ministry of Foreign Affairs an International Cooperation Libyan Embassy');
INSERT INTO `tbl_perwakilan` VALUES ('141', 'The High Commission of the Republic of Singapore');
INSERT INTO `tbl_perwakilan` VALUES ('142', 'The Embassy of the Republic of Cuba');
INSERT INTO `tbl_perwakilan` VALUES ('143', 'Songkhla');
INSERT INTO `tbl_perwakilan` VALUES ('144', 'Davao City');
INSERT INTO `tbl_perwakilan` VALUES ('145', 'Guangzhou');
INSERT INTO `tbl_perwakilan` VALUES ('146', 'the JOSIAH KATZ ROYAL');
INSERT INTO `tbl_perwakilan` VALUES ('147', 'Ghana High Comission');
INSERT INTO `tbl_perwakilan` VALUES ('148', 'Perth');
INSERT INTO `tbl_perwakilan` VALUES ('150', 'High Commision Of Malaysia');
INSERT INTO `tbl_perwakilan` VALUES ('151', 'Suriname');
INSERT INTO `tbl_perwakilan` VALUES ('152', 'Warsawa');
INSERT INTO `tbl_perwakilan` VALUES ('153', 'The Embassy of The Peoples Republic of China');
INSERT INTO `tbl_perwakilan` VALUES ('154', 'Suva');
INSERT INTO `tbl_perwakilan` VALUES ('155', 'Astana');
INSERT INTO `tbl_perwakilan` VALUES ('156', 'Muscat');
INSERT INTO `tbl_perwakilan` VALUES ('157', 'The MInistry of Foreign Affairs and International Cooperation of the Kingdom of Swaziland presents');
INSERT INTO `tbl_perwakilan` VALUES ('158', 'Consul General of the Republic of Indonesia Swaziland');
INSERT INTO `tbl_perwakilan` VALUES ('159', 'Kwazulu');
INSERT INTO `tbl_perwakilan` VALUES ('160', 'Mumbai');
INSERT INTO `tbl_perwakilan` VALUES ('161', 'Western Cape');
INSERT INTO `tbl_perwakilan` VALUES ('162', 'Kementerian Kesehatan');
INSERT INTO `tbl_perwakilan` VALUES ('163', 'Kementerian Perindustrian');
INSERT INTO `tbl_perwakilan` VALUES ('164', 'test');
INSERT INTO `tbl_perwakilan` VALUES ('165', 'Kementerian Kehutanan');
INSERT INTO `tbl_perwakilan` VALUES ('166', 'Kementeraian Pariwisata dan Ekonomi Kreatif');
INSERT INTO `tbl_perwakilan` VALUES ('167', 'Dir Sosbud OINB');
INSERT INTO `tbl_perwakilan` VALUES ('168', 'KJRI Los Angeles');
INSERT INTO `tbl_perwakilan` VALUES ('169', 'KJRI New York');
INSERT INTO `tbl_perwakilan` VALUES ('170', 'KJRI Jeddah');
INSERT INTO `tbl_perwakilan` VALUES ('171', 'KARO KEPEGAWAIAN');
INSERT INTO `tbl_perwakilan` VALUES ('172', 'KBRI Astana');
INSERT INTO `tbl_perwakilan` VALUES ('173', 'KBRI Canberra');
INSERT INTO `tbl_perwakilan` VALUES ('174', 'KBRI Canberra');
INSERT INTO `tbl_perwakilan` VALUES ('175', 'KBRI Budapest');
INSERT INTO `tbl_perwakilan` VALUES ('176', 'KBRI Cairo');
INSERT INTO `tbl_perwakilan` VALUES ('177', 'PTRI New York');
INSERT INTO `tbl_perwakilan` VALUES ('178', 'KBRI Kuala Lumpur');
INSERT INTO `tbl_perwakilan` VALUES ('179', 'KBRI Khartoum');
INSERT INTO `tbl_perwakilan` VALUES ('180', 'KEMENTERIAN KOORDINATOR POLHUKAM');
INSERT INTO `tbl_perwakilan` VALUES ('181', 'Chicago');
INSERT INTO `tbl_perwakilan` VALUES ('182', 'PTRI New York');
INSERT INTO `tbl_perwakilan` VALUES ('183', 'KBRI Windhoek');
INSERT INTO `tbl_perwakilan` VALUES ('184', 'KJRI Houston');
INSERT INTO `tbl_perwakilan` VALUES ('185', 'KBRI Washington, D.C.');
INSERT INTO `tbl_perwakilan` VALUES ('186', 'Sydney');
INSERT INTO `tbl_perwakilan` VALUES ('187', 'KBRI Phnompenh');
INSERT INTO `tbl_perwakilan` VALUES ('188', 'KBRI Beijing');
INSERT INTO `tbl_perwakilan` VALUES ('189', 'KBRI Ankara');
INSERT INTO `tbl_perwakilan` VALUES ('190', 'Roma');
INSERT INTO `tbl_perwakilan` VALUES ('191', 'San Francisco');
INSERT INTO `tbl_perwakilan` VALUES ('192', 'Baku');
INSERT INTO `tbl_perwakilan` VALUES ('193', 'Shanghai');
INSERT INTO `tbl_perwakilan` VALUES ('194', 'Darwin');
INSERT INTO `tbl_perwakilan` VALUES ('195', 'Noumea');
INSERT INTO `tbl_perwakilan` VALUES ('196', 'Dhaka');
INSERT INTO `tbl_perwakilan` VALUES ('197', 'PTRI ASEAN');
INSERT INTO `tbl_perwakilan` VALUES ('198', 'Kementerian Koordinator Bidang Maritim');
INSERT INTO `tbl_perwakilan` VALUES ('199', 'Sarajevo');
INSERT INTO `tbl_perwakilan` VALUES ('200', 'Sekretariat Negara');
INSERT INTO `tbl_perwakilan` VALUES ('201', 'Vancouver');
INSERT INTO `tbl_perwakilan` VALUES ('202', 'Karachi');
INSERT INTO `tbl_perwakilan` VALUES ('203', 'US DHS');
INSERT INTO `tbl_perwakilan` VALUES ('204', 'Zagreb');
INSERT INTO `tbl_perwakilan` VALUES ('205', 'Tawau');
INSERT INTO `tbl_perwakilan` VALUES ('206', 'FRANKFURT');
INSERT INTO `tbl_perwakilan` VALUES ('207', 'Embassy of Thailand');
INSERT INTO `tbl_perwakilan` VALUES ('208', 'DEPARTMENT OF STATE');
INSERT INTO `tbl_perwakilan` VALUES ('209', 'THE EMBASSY OF BURKINA FASO');
INSERT INTO `tbl_perwakilan` VALUES ('210', 'KARO ADMINISTRASI KMENTERIAN DAN PERWAKILAN');
INSERT INTO `tbl_perwakilan` VALUES ('211', 'KARO ADMINISTRASI KEMENTERIAN DAN PERWAKILAN');
INSERT INTO `tbl_perwakilan` VALUES ('212', 'KARO ADMINISTRASI KEMENTERIAN DAN PERWAKILAN');
INSERT INTO `tbl_perwakilan` VALUES ('213', 'DIRJEN INFORMASI DAN DIPLOMATIK PUBLIK');
INSERT INTO `tbl_perwakilan` VALUES ('214', 'SEKRETARIAT DPR RI');
INSERT INTO `tbl_perwakilan` VALUES ('215', 'MAIN CLINIC');
INSERT INTO `tbl_perwakilan` VALUES ('216', 'SANJAYA MOHOTTI ARACHCHIGE');
INSERT INTO `tbl_perwakilan` VALUES ('217', 'MARSEILLE');
INSERT INTO `tbl_perwakilan` VALUES ('218', 'TOBY CARDOSO');
INSERT INTO `tbl_perwakilan` VALUES ('219', 'EMBASSY OF THE PHILIPPINES');
INSERT INTO `tbl_perwakilan` VALUES ('220', 'KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN');
INSERT INTO `tbl_perwakilan` VALUES ('221', 'MABES KEPOLISIAN NEGARA REPUBLIK INDONESIA');
INSERT INTO `tbl_perwakilan` VALUES ('222', 'KEMENTERIAN LUAR NEGERI');
INSERT INTO `tbl_perwakilan` VALUES ('223', 'STAF UMUM PENGAMANAN KASAL');
INSERT INTO `tbl_perwakilan` VALUES ('224', 'Kementerian Perhubungan');
INSERT INTO `tbl_perwakilan` VALUES ('225', 'Kementerian Riset Teknologi dan Pendidikan Tinggi');
INSERT INTO `tbl_perwakilan` VALUES ('226', 'ISLAMIC DEVELOPMENT BANK');
INSERT INTO `tbl_perwakilan` VALUES ('227', 'THE EMBASSY OF THE REPUBLIC OF SINGAPORE');
INSERT INTO `tbl_perwakilan` VALUES ('228', 'EMBASSY OF PAKISTAN');
INSERT INTO `tbl_perwakilan` VALUES ('229', 'MIAMI UNIVERSITY');
INSERT INTO `tbl_perwakilan` VALUES ('230', 'ASPAM KASAL');
INSERT INTO `tbl_perwakilan` VALUES ('231', 'SEKRETARIS JENDERAL MPR');
INSERT INTO `tbl_perwakilan` VALUES ('232', 'SALINE COUNTY SHERIFF\'S OFFICE');
INSERT INTO `tbl_perwakilan` VALUES ('233', 'THE EURASIA CENTER');
INSERT INTO `tbl_perwakilan` VALUES ('234', 'EPLO AND EPIC ASSOCIATES');
INSERT INTO `tbl_perwakilan` VALUES ('235', 'DIREKTORAT JENDERAL PERUNDINGAN PERDAGANGAN INTERNASIONAL');
INSERT INTO `tbl_perwakilan` VALUES ('236', 'U.S. IMMIGRATION AND CUSTOMS ENFORCEMENT');
INSERT INTO `tbl_perwakilan` VALUES ('237', 'DR. ARIFIN M. SIREGAR');
INSERT INTO `tbl_perwakilan` VALUES ('238', 'ISTANBUL');
INSERT INTO `tbl_perwakilan` VALUES ('239', 'ARNOLD H. MATLIN, M.D.');
INSERT INTO `tbl_perwakilan` VALUES ('240', 'UNIVERSITY OF MINNESOTA');
INSERT INTO `tbl_perwakilan` VALUES ('241', 'ALIANSI PITA PUTIH INDONESIA');
INSERT INTO `tbl_perwakilan` VALUES ('242', 'THE ROYAL THAI EMBASSY');
INSERT INTO `tbl_perwakilan` VALUES ('243', 'THE EMBASSY OF THE REPUBLIC OF SENEGAL');
INSERT INTO `tbl_perwakilan` VALUES ('244', 'SEKRETARIAT JENDERAL DPR RI');
INSERT INTO `tbl_perwakilan` VALUES ('245', 'BPPT');
INSERT INTO `tbl_perwakilan` VALUES ('246', 'DIRJEN IMIGRASI');
INSERT INTO `tbl_perwakilan` VALUES ('247', 'AMNESTY INTERNATIONAL USA');
INSERT INTO `tbl_perwakilan` VALUES ('248', 'BADAN INTELIJEN STRATEGIS TNI');
INSERT INTO `tbl_perwakilan` VALUES ('249', 'DEPARTMENT OF HOMELAND SECURITY');
INSERT INTO `tbl_perwakilan` VALUES ('250', 'EMBASSY OF INDIA');
INSERT INTO `tbl_perwakilan` VALUES ('251', 'MABES POLRI');
INSERT INTO `tbl_perwakilan` VALUES ('252', 'BAGHDAD');
INSERT INTO `tbl_perwakilan` VALUES ('253', 'Karo Perencanaan dan Organisasi');
INSERT INTO `tbl_perwakilan` VALUES ('254', 'Biro Perencanaan dan Organisasi');
INSERT INTO `tbl_perwakilan` VALUES ('255', 'BADAN PENGAWAS OBAT MAKANAN');
INSERT INTO `tbl_perwakilan` VALUES ('256', 'BADAN PENGAWAS OBAT DAN MAKANAN');
INSERT INTO `tbl_perwakilan` VALUES ('257', 'KABAIS TNI');
INSERT INTO `tbl_perwakilan` VALUES ('258', 'LEMBAGA SANDI NEGARA');
INSERT INTO `tbl_perwakilan` VALUES ('259', 'DPR ACEH');
INSERT INTO `tbl_perwakilan` VALUES ('260', 'GRIEBOSKI GLOBAL STRATEGIES');
INSERT INTO `tbl_perwakilan` VALUES ('261', 'KEMENTERIAN PARIWISATA');
INSERT INTO `tbl_perwakilan` VALUES ('262', 'KEMENTERIAN KEUANGAN');
INSERT INTO `tbl_perwakilan` VALUES ('263', 'Embassy of Bahamas');
INSERT INTO `tbl_perwakilan` VALUES ('264', 'Bojonegoro');
INSERT INTO `tbl_perwakilan` VALUES ('265', 'KEMENTERIAN PARIWISATA');
INSERT INTO `tbl_perwakilan` VALUES ('266', 'Kementerian Pertahanan');
INSERT INTO `tbl_perwakilan` VALUES ('267', 'WHITE HOUSE CHRONICLE TV');
INSERT INTO `tbl_perwakilan` VALUES ('268', 'ANNE J SARTIEL');
INSERT INTO `tbl_perwakilan` VALUES ('269', 'BADAN NASIONAL PENEMPATAN DAN PERLINDUNGAN TENAGA KERJA INDONESIA');
INSERT INTO `tbl_perwakilan` VALUES ('270', 'KARO SDM');
INSERT INTO `tbl_perwakilan` VALUES ('271', 'PENGADILAN AGAMA MALANG');
INSERT INTO `tbl_perwakilan` VALUES ('272', 'KBRI Alger');
INSERT INTO `tbl_perwakilan` VALUES ('273', 'Pokja PLN');
INSERT INTO `tbl_perwakilan` VALUES ('274', 'Houston');
INSERT INTO `tbl_perwakilan` VALUES ('275', 'Other');
INSERT INTO `tbl_perwakilan` VALUES ('276', 'The US-ASEAN Business Council');
INSERT INTO `tbl_perwakilan` VALUES ('277', 'East-West Center');
INSERT INTO `tbl_perwakilan` VALUES ('278', 'Smithsonian');
INSERT INTO `tbl_perwakilan` VALUES ('279', 'National Press Club');
INSERT INTO `tbl_perwakilan` VALUES ('280', 'Women\'s Foreign Policy Group');
INSERT INTO `tbl_perwakilan` VALUES ('281', 'Pokja Panwaslu LN');
INSERT INTO `tbl_perwakilan` VALUES ('282', 'Lembaga Perlindungan Saksi dan Korban');
INSERT INTO `tbl_perwakilan` VALUES ('283', 'Kementerian Kelautan dan Perikanan');
INSERT INTO `tbl_perwakilan` VALUES ('284', 'National Maritime Intelligence-Integration Office');
INSERT INTO `tbl_perwakilan` VALUES ('285', 'KADIN');
INSERT INTO `tbl_perwakilan` VALUES ('286', 'PERMIAS');
INSERT INTO `tbl_perwakilan` VALUES ('287', 'Embassy of Brunei Darussalam');
INSERT INTO `tbl_perwakilan` VALUES ('288', 'Kementerian Energi dan Sumber Daya Mineral');
INSERT INTO `tbl_perwakilan` VALUES ('289', 'State of Nebraska');
INSERT INTO `tbl_perwakilan` VALUES ('290', 'Embassy of the Republic of The Gambia');
INSERT INTO `tbl_perwakilan` VALUES ('291', 'USINDO');
INSERT INTO `tbl_perwakilan` VALUES ('292', 'Badan Keamanan Laut');
INSERT INTO `tbl_perwakilan` VALUES ('293', 'KOPRI Kemenlu');
INSERT INTO `tbl_perwakilan` VALUES ('294', 'KORPRI Kemenlu');
INSERT INTO `tbl_perwakilan` VALUES ('295', 'Universitas Pertahanan');
INSERT INTO `tbl_perwakilan` VALUES ('296', 'CISV Indonesia');
INSERT INTO `tbl_perwakilan` VALUES ('297', 'Kementerian Hukum dan HAM');
INSERT INTO `tbl_perwakilan` VALUES ('298', 'International Monetary Fund');
INSERT INTO `tbl_perwakilan` VALUES ('299', 'Kementerian Komunikasi dan Informatika');

-- ----------------------------
-- Table structure for `tbl_setting`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_setting`;
CREATE TABLE `tbl_setting` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama_perwakilan` varchar(100) DEFAULT NULL,
  `nama_singkat_perwakilan` varchar(100) DEFAULT NULL,
  `nama_jabatan_kepala_perwakilan` varchar(100) DEFAULT NULL,
  `warna_latar` varchar(20) DEFAULT NULL,
  `alamat_perwakilan` varchar(255) DEFAULT NULL,
  `email_administrator` varchar(50) DEFAULT NULL,
  `email_administrator_password` varchar(50) NOT NULL,
  `user_notifikasi_email` char(1) NOT NULL,
  `status_config` int(1) DEFAULT '0' COMMENT '0=unset;1=setted;',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_setting
-- ----------------------------
INSERT INTO `tbl_setting` VALUES ('1', 'Konsulat Jenderal Republik Indonesia - Kuching', 'KJRI Kuching', 'Konsul Jenderal', 'green', '21, Lot 16557, Block 11,\r\nJalan Stutong, MTLD, \r\n93350 Kuching\r\nSarawak, Malaysia', 'kuching.kjri@kemlu.go.id', '12345', '', '1');

-- ----------------------------
-- Table structure for `tbl_sifat`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_sifat`;
CREATE TABLE `tbl_sifat` (
  `sifat_kd` int(3) NOT NULL AUTO_INCREMENT,
  `sifat_nama` varchar(100) NOT NULL,
  PRIMARY KEY (`sifat_kd`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_sifat
-- ----------------------------
INSERT INTO `tbl_sifat` VALUES ('1', 'RAHASIA');
INSERT INTO `tbl_sifat` VALUES ('2', 'BIASA');

-- ----------------------------
-- Table structure for `tbl_user`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `user_kd` int(2) NOT NULL AUTO_INCREMENT,
  `user_nama` char(25) NOT NULL,
  `user_password` char(50) NOT NULL,
  `user_namalengkap` char(40) NOT NULL,
  `fungsi_kd` int(2) NOT NULL,
  `user_status` char(1) NOT NULL,
  `user_menerima_disposisi` char(1) NOT NULL DEFAULT 'Y' COMMENT 'Y=dapat menerima, T=tidak dapat',
  `user_foto` varchar(100) NOT NULL DEFAULT 'avatar.jpg',
  `user_email` varchar(50) NOT NULL,
  `user_notifikasi_email` varchar(50) NOT NULL,
  `koordinator_fungsi` char(1) NOT NULL DEFAULT 'T' COMMENT 'Y=Koord. Fungsi; T=Bukan Koord Fungsi.',
  `home_staff` char(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`user_kd`),
  KEY `fk_tbl_user_tbl_fungsi1_idx` (`fungsi_kd`),
  CONSTRAINT `fk_tbl_user_tbl_fungsi1` FOREIGN KEY (`fungsi_kd`) REFERENCES `tbl_fungsi` (`fungsi_kd`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_user
-- ----------------------------
INSERT INTO `tbl_user` VALUES ('1', 'konjen', 'e10adc3949ba59abbe56e057f20f883e', 'Yonny Tri Prayitno', '1', 'Y', 'Y', 'dubes.jpg', 'b.bowoleksono@embassyofindonesia.org', '0', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('2', 'komunikasi', '161ebd7d45089b3446ee4e0d86dbcf92', 'komunikasi', '2', 'Y', 'Y', 'avatar.jpg', 'komunikasi@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('10', 'ardian', 'd25286fc1874187e268895d0c8233c75', 'Ardian Wicaksono', '6', 'Y', 'Y', 'avatar.jpg', 'ardian.wicaksono@embassyofindonesia.org', '0', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('11', 'daniel', 'e4665f7d4b1148cd3c32c9b620365813', 'Daniel TS. Simanjuntak', '8', 'Y', 'Y', 'avatar.jpg', 'daniel.simanjuntak@embassyofindonesia.org', '0', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('12', 'siuaji', 'a84219e2c550569480257772127e5d73', 'Siuaji Raja', '10', 'Y', 'Y', 'avatar.jpg', 'siuaji.raja@embassyofindonesia.org', '0', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('13', 'okto', 'da27ad529ad98fb7d11ec3a80f0ac4d2', 'Okto D. Manik', '12', 'Y', 'Y', 'avatar.jpg', 'oktomanik@embassyofindonesia.org', '0', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('14', 'pudjo', 'be266b32270625697b680a5b4890e4c8', 'Pudjo Wahyono', '14', 'Y', 'Y', 'avatar.jpg', 'athan@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('15', 'halili', 'e0c73f271862bf786b6da24e81daa5cb', 'Halili', '27', 'Y', 'Y', 'avatar.jpg', 'navalattache@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('16', 'benny', '4c15f8eedceedf90fc06afe947d3e4d0', 'Benedictus B. Koessetianto', '28', 'Y', 'Y', 'avatar.jpg', 'airattache@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('17', 'budi', '604b06725a2ecc751b6ce2bca45cf96b', 'Budi Alamsyah', '29', 'Y', 'Y', 'avatar.jpg', 'asathan@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('18', 'arief', 'c8eab5960105456415e5675703f98d5c', 'Arief Wicaksono', '15', 'Y', 'Y', 'avatar.jpg', 'atpolri@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('19', 'ekonomi', '77eec27036cb194bead2eff5b1b5a80c', 'Home Staf Ekonomi', '9', 'Y', 'Y', 'avatar.jpg', 'ekonomi@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('20', 'sidarto', '0befeb96b43f8dfea7f293e8665d7d15', 'Sidharto R. Suryodipuro', '5', 'Y', 'Y', 'avatar.jpg', 'arto@embassyofindonesia.org', '0', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('24', 'arto.suryodipuro', 'e4c2f100b2cc6895269b5b8926f4d663', 'Sidharto R. Suryodipuro', '30', 'T', 'T', 'avatar.jpg', 'arto.suryodipuro@embassyofindonesia.org', '0', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('25', 'rizal.purnama', 'f712359dbbd7272440617713fc21ee7d', 'Ahmad R. Purnama', '31', 'T', 'T', 'avatar.jpg', 'rizal.purnama@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('27', 'bhima', '0d0820768e6535af53774f41b7f566cc', 'Bhima Dwipayudhanto', '32', 'Y', 'Y', 'avatar.jpg', 'bhima@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('29', 'jodi.mahardi', '9ba889359e897c7683f834dad31faa1a', 'Jodi Mahardi', '32', 'T', 'T', 'jodi.jpg', 'jodi.mahardi@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('30', 'sesotyoningtyas', '4a1acd3752aefaaf905e1e57bad9381f', 'Anggarini Sesotyoningtyas', '32', 'T', 'T', 'Ririn.jpg', 'sesotyoningtyas@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('31', 'siuaji.raja', 'bef4ecd0c4385ecbbe4398399fea4098', 'Siuaji Raja', '33', 'Y', 'Y', 'Raja.jpg', 'siuaji.raja@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('32', 'dewi.justicia', 'bef4ecd0c4385ecbbe4398399fea4098', 'Dewi Justicia Meidiwati', '33', 'T', 'T', 'Dewi Meidiwaty.jpg', 'dewi.justicia@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('33', 'mukti.setianto', 'd1d865bc2edc4feca2aa85f92cdd4f7e', 'Mukti Setianto', '34', 'T', 'T', 'Mukti.jpg', 'mukti.setianto@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('34', 'oktomanik', 'bef4ecd0c4385ecbbe4398399fea4098', 'Okto Darius Manik', '34', 'T', 'T', 'Okto Dorinus Manik.jpg', 'oktomanik@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('35', 'febriaretnoningsih', 'bef4ecd0c4385ecbbe4398399fea4098', 'Febria Retnoningsih', '34', 'Y', 'Y', 'febriana.jpg', 'febriaretnoningsih@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('36', 'limantara', '530bee512de99d7acea96e6e596cc03d', 'Prayoga Limantara', '31', 'T', 'T', 'Prayoga Limantara.jpg', 'limantara@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('37', 'athan', 'b6f411e4b7b1ca00828dbbbcf6b190f0', 'Alfonsius Joko Takarianto', '35', 'Y', 'Y', 'pujo.jpg', 'defenceattache@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('38', 'navalattache', '6955430a8fd0439b202d6168c98b7247', 'Sungatijantoro', '35', 'Y', 'Y', 'Kol.-Laut-Halili.jpg', 'navalattache@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('39', 'airattache', 'bef4ecd0c4385ecbbe4398399fea4098', 'Atase Udara', '35', 'Y', 'Y', 'avatar.jpg', 'airattache@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('40', 'asathan', 'bef4ecd0c4385ecbbe4398399fea4098', 'Agung Nugroho Kusumaji', '35', 'Y', 'Y', 'budi.jpg', 'asathan@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('41', 'fms', '977fcdfb388745eb3e52dde53b03e37f', 'Mohamad Nafis', '35', 'Y', 'Y', 'pak Nafis.jpg', 'fms@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('42', 'reza.pahlevi', '0d0820768e6535af53774f41b7f566cc', 'Reza Pahlevi', '38', 'Y', 'Y', 'Ni-Made-Marthini.jpg', 'reza.pahlevi@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('43', 'antonius.ab', 'bef4ecd0c4385ecbbe4398399fea4098', 'Antonius Amarullah B', '38', 'T', 'T', 'antonius.jpg', 'antonius.ab@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('44', 'atpolri', 'bef4ecd0c4385ecbbe4398399fea4098', 'IGN Agung Suandika', '43', 'Y', 'Y', '20150713_125219_resized.jpg', 'atpolri@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('45', 'bhimo', '6ad14ba9986e3615423dfca256d04e3f', 'Bhimo W. Andoko', '39', 'Y', 'Y', 'Ngadirin.jpg', 'bhimo@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('46', 'attani', 'bef4ecd0c4385ecbbe4398399fea4098', 'Rindayuni Triavini', '41', 'Y', 'Y', 'rindayuni.jpg', 'attani@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('47', 'transportattache', 'bef4ecd0c4385ecbbe4398399fea4098', 'F. Budi Prayitno', '40', 'Y', 'T', 'budi prayitno.jpg', 'transportattache@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('48', 'yusirwan', 'e10adc3949ba59abbe56e057f20f883e', 'Yusirwan Fnu', '42', 'Y', 'Y', 'avatar.jpg', 'yusirwan@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('49', 'adinda', 'bef4ecd0c4385ecbbe4398399fea4098', 'Adinda Asti Gita', '42', 'T', 'T', 'Adinda Gita.jpg', 'adinda@embassyofindonesia.org', '0', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('50', 'ibrahim.debe', 'bef4ecd0c4385ecbbe4398399fea4098', 'Ibrahim Caraka Debe', '31', 'T', 'T', 'avatar.jpg', 'ibrahim.debe@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('52', 'victor.simatupang', 'ac68d539ebaada578a3525c684761703', 'Victor Simatupang', '37', 'T', 'T', 'Victor Simatupang.jpg', 'victor.simatupang@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('53', 'benton', 'ad4f35160b70ff391225104dffbadd09', 'Benton B. Padmanegara', '2', 'T', 'T', 'avatar.jpg', 'benton@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('54', 'wibowo', 'bef4ecd0c4385ecbbe4398399fea4098', 'Ari Wibowo', '2', 'T', 'T', 'avatar.jpg', 'wibowo@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('55', 'keuangan', 'bef4ecd0c4385ecbbe4398399fea4098', 'BPKRT Keuangan', '32', 'Y', 'T', 'avatar.jpg', 'yusirwan@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('61', 'meikawati', 'e10adc3949ba59abbe56e057f20f883e', 'Sri Meikawati', '45', 'Y', 'Y', 'avatar.jpg', 'meikawati@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('62', 'budi.suryasaputra', 'bef4ecd0c4385ecbbe4398399fea4098', 'Budi Suryasaputra', '33', 'T', 'T', 'avatar.jpg', 'budi.suryasaputra@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('63', 'defenceattache', '8507733906d2d45b45056929bba259de', 'Alfonsius Joko Takarianto', '35', 'Y', 'Y', 'avatar.jpg', 'defenceattache@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('64', 'armyattache', '8677ab4c6d4ac74115c42e830bc5ccb1', 'Tony Aris Setiawan', '35', 'Y', 'Y', 'avatar.jpg', 'armyattache@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('65', 'ismunandar', 'f5a2301410d25dc55d31389678adf773', 'Ismunandar', '39', 'T', 'T', 'avatar.jpg', 'ismunandar@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('67', 'mitra', 'ac7938d40cfc2307e2bf325d28e7884e', 'Mitra Dalil', '2', 'Y', 'T', 'avatar.jpg', 'mitra@embassyofindonesia.org', '1', 'T', 'T');
INSERT INTO `tbl_user` VALUES ('68', 'crony', 'ac7938d40cfc2307e2bf325d28e7884e', 'Chadijah Rony', '3', 'Y', 'Y', 'avatar.jpg', 'crony@embassyofindonesia.org', '1', 'Y', 'T');
INSERT INTO `tbl_user` VALUES ('69', 'faisal', 'ac7938d40cfc2307e2bf325d28e7884e', 'Faisal Mangoenkoesoemo', '3', 'Y', 'Y', 'avatar.jpg', 'faisal@embassyofindonesia.org', '1', 'Y', 'T');
INSERT INTO `tbl_user` VALUES ('70', 'perlengkapan', 'bef4ecd0c4385ecbbe4398399fea4098', 'BPKRT Perlengkapan', '32', 'Y', 'T', 'avatar.jpg', 'meikawati@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('71', 'askepegawaian', 'bef4ecd0c4385ecbbe4398399fea4098', 'Asisten HOC Kepegawaian', '44', 'T', 'T', 'avatar.jpg', '', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('72', 'asperlengkapan', 'bef4ecd0c4385ecbbe4398399fea4098', 'Asisten HOC Perlengkapan', '44', 'T', 'T', 'avatar.jpg', '', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('73', 'askeuangan', 'bef4ecd0c4385ecbbe4398399fea4098', 'Asisten HOC Keuangan', '44', 'T', 'T', 'avatar.jpg', '', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('74', 'aspelaporan', 'bef4ecd0c4385ecbbe4398399fea4098', 'Asisten HOC Pelaporan', '44', 'T', 'T', 'avatar.jpg', '', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('75', 'hoc', '161ebd7d45089b3446ee4e0d86dbcf92', 'HOC', '31', 'Y', 'Y', 'avatar.jpg', '', '0', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('76', 'ashocpeg', 'bef4ecd0c4385ecbbe4398399fea4098', 'Asisten HOC Kepegawaian', '44', 'T', 'T', 'avatar.jpg', '', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('77', 'ashockap', 'bef4ecd0c4385ecbbe4398399fea4098', 'Asisten HOC Perlengkapan', '44', 'T', 'T', 'avatar.jpg', '', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('78', 'ashockeu', 'bef4ecd0c4385ecbbe4398399fea4098', 'Asisten HOC Keuangan', '44', 'T', 'T', 'avatar.jpg', '', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('79', 'ashoclap', 'bef4ecd0c4385ecbbe4398399fea4098', 'Asisten HOC Pelaporan', '44', 'T', 'T', 'avatar.jpg', '', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('80', 'tk1', '161ebd7d45089b3446ee4e0d86dbcf92', 'Dewi J. Meidiwaty', '46', 'Y', 'Y', 'avatar.jpg', 'dewi.justicia@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('81', 'tk2', '161ebd7d45089b3446ee4e0d86dbcf92', 'Mukti Setianto', '46', 'Y', 'Y', 'avatar.jpg', 'mukti.setianto@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('82', 'tk3', '161ebd7d45089b3446ee4e0d86dbcf92', 'Prayoga Limantara', '46', 'T', 'T', 'avatar.jpg', 'limantara@embassyofindonesia.org', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('83', 'erlangga', '039a66ab04875d9dad6bff5e98a7b26e', 'Erlang E. Tjitrawasita', '2', 'Y', 'Y', 'avatar.jpg', 'erlangga@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('84', 'ferry.pasaribu', '72c79b4b67df043473f73bd48d639751', 'Ferry Akbar Pasaribu', '31', 'Y', 'Y', 'avatar.jpg', 'ferry.pasaribu@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('85', 'nugrohoboni', '45cff1ef6940509a05a3ea3fec41b2a6', 'Bonifasius Agung Nugroho', '34', 'Y', 'Y', 'avatar.jpg', 'nugrohoboni@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('86', 'ronald.eberhard', '0d0820768e6535af53774f41b7f566cc', 'Ronald Eberhard', '32', 'Y', 'Y', 'avatar.jpg', 'ronald.eberhard@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('87', 'margaretta', '0d0820768e6535af53774f41b7f566cc', 'Margaretta Puspita', '0', 'Y', 'Y', 'avatar.jpg', 'margaretta@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('88', 'margaretta', '0d0820768e6535af53774f41b7f566cc', 'Margaretta Puspita', '33', 'Y', 'Y', 'avatar.jpg', 'margaretta@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('89', 'dimashalif', '0d0820768e6535af53774f41b7f566cc', 'Dimas Halif', '3', 'Y', 'Y', 'avatar.jpg', 'dimashalif@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('90', 'harditya.s', '54404e94b246a12924973090d55335fa', 'Harditya Suryawanto', '31', 'Y', 'Y', 'avatar.jpg', 'harditya.s@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('91', 'muhaula', '5e77e4e73765fdc0be3816d50f7f2260', 'Muhammad Aula', '31', 'Y', 'Y', 'avatar.jpg', 'muhaula@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('92', 'rhindiarta', '0d0820768e6535af53774f41b7f566cc', 'Rahmat Hindiarta', '33', 'Y', 'Y', 'avatar.jpg', 'rhindiarta@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('93', 'theo', '0d0820768e6535af53774f41b7f566cc', 'Theodorus Satrionugroho', '34', 'Y', 'Y', 'avatar.jpg', 'theo@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('94', 'didietr', 'c8934803618f93068fc16994fa948b2d', 'Didiet Rosadie', '37', 'Y', 'Y', 'avatar.jpg', 'didietr@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('96', 'plain', '161ebd7d45089b3446ee4e0d86dbcf92', 'Unit Plain', '2', 'Y', 'Y', 'avatar.jpg', '', '0', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('97', 'bastian', '0aca756af1164028d754e12e125c2719', 'Bastian Maulana', '2', 'Y', 'Y', 'avatar.jpg', 'bastian@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('98', 'yudho', '0d0820768e6535af53774f41b7f566cc', 'Yudho Sasongko', '33', 'Y', 'Y', 'avatar.jpg', 'yudho@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('99', 'saptandri', '0d0820768e6535af53774f41b7f566cc', 'Saptandri Widiyanto', '40', 'Y', 'Y', 'avatar.jpg', 'saptandri@embassyofindonesia.org', '1', 'Y', 'Y');
INSERT INTO `tbl_user` VALUES ('100', 'rismayati', 'b4c9fd655becbbb18dda7ebf25306600', 'Irma Dewi Rismayati', '32', 'Y', 'Y', 'avatar.jpg', 'rismayati@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('101', 'sunny', '51e87cf3703c8b9ce05d78d6479e3a4b', 'Sunny Adrian', '38', 'Y', 'Y', 'avatar.jpg', 'sunny.adrian@embassyofindonesia.org', '1', 'T', 'Y');
INSERT INTO `tbl_user` VALUES ('102', 'anitafirman', '0d0820768e6535af53774f41b7f566cc', 'Anita Destyati Firman', '42', 'Y', 'Y', 'avatar.jpg', 'anitafirman@embassyofindonesia.org', '1', 'Y', 'Y');

-- ----------------------------
-- Table structure for `tbl_version`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_version`;
CREATE TABLE `tbl_version` (
  `version_id` int(11) NOT NULL AUTO_INCREMENT,
  `version_name` varchar(255) NOT NULL,
  `version_author` varchar(255) NOT NULL,
  `version_description` varchar(1000) NOT NULL,
  `version_release` date NOT NULL,
  PRIMARY KEY (`version_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_version
-- ----------------------------
INSERT INTO `tbl_version` VALUES ('1', '2.0', '@puskom', 'Penambahan fitur Import dari SIMBRA', '2014-03-26');
