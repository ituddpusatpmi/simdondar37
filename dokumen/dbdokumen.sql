-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2015 at 04:48 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbdokumen`
--
CREATE DATABASE IF NOT EXISTS `dbdokumen` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbdokumen`;

-- --------------------------------------------------------

--
-- Table structure for table `eksternal`
--

CREATE TABLE IF NOT EXISTS `eksternal` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(200) DEFAULT NULL,
  `nama1` varchar(200) DEFAULT NULL,
  `nama2` varchar(200) DEFAULT NULL,
  `tingkat` varchar(200) DEFAULT NULL,
  `kontrol` varchar(200) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `no_versi` varchar(50) DEFAULT NULL,
  `tgl_setuju` varchar(100) DEFAULT NULL,
  `tgl_pelaksanaan` varchar(100) DEFAULT NULL,
  `tgl_peninjauan` varchar(100) DEFAULT NULL,
  `pembuat` varchar(200) DEFAULT NULL,
  `pemeriksa` varchar(200) DEFAULT NULL,
  `pengesah` varchar(200) DEFAULT NULL,
  `fileku` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `formulir`
--

CREATE TABLE IF NOT EXISTS `formulir` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(200) DEFAULT NULL,
  `nama1` varchar(200) DEFAULT NULL,
  `nama2` varchar(200) DEFAULT NULL,
  `tingkat` varchar(200) DEFAULT NULL,
  `kontrol` varchar(200) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `no_versi` varchar(50) DEFAULT NULL,
  `tgl_setuju` varchar(100) DEFAULT NULL,
  `tgl_pelaksanaan` varchar(100) DEFAULT NULL,
  `tgl_peninjauan` varchar(100) DEFAULT NULL,
  `pembuat` varchar(200) DEFAULT NULL,
  `pemeriksa` varchar(200) DEFAULT NULL,
  `pengesah` varchar(200) DEFAULT NULL,
  `fileku` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=227 ;

--
-- Dumping data for table `formulir`
--

INSERT INTO `formulir` (`nomor`, `bidang`, `nama1`, `nama2`, `tingkat`, `kontrol`, `periode`, `no_versi`, `tgl_setuju`, `tgl_pelaksanaan`, `tgl_peninjauan`, `pembuat`, `pemeriksa`, `pengesah`, `fileku`) VALUES
(2, 'Sistem Kualitas', 'Register Tanda Tangan', 'N/A', '3', 'UTDPKU-REG-SK-L3-001', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(7, 'Sistem Kualitas', 'Register Dokumen Kontrol', 'N/A', '3', 'UTDPKU-REG-SK-L3-002', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(8, 'Sistem Kualitas', 'Rencana Perubahan', 'N/A', '3', 'UTDPKU-SK-L3-003', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(9, 'Sistem Kualitas', 'Register Rencana Perubahan', 'N/A', '3', 'UTDPKU-REG-SK-L3-004', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(10, 'Sistem Kualitas', 'Register Audit Internal', 'N/A', '3', 'UTDPKU-REG-SK-L3-005', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(11, 'Sistem Kualitas', 'Laporan Audit Internal', 'N/A', '3', 'UTDPKU-SK-L3-006', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(12, 'Sistem Kualitas', 'Formulir Laporan Insiden', 'N/A', '3', 'UTDPKU-FORM-SK-L3-007', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(15, 'Sistem Kualitas', 'Daftar Distribusi Dokumen Terkendali', 'N/A', '3', 'UTDPKU-FORM-SK-L3-008', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(16, 'Logistik', 'Kartu Stok Barang', 'N/A', '3', 'UTDPKU-LOG-L3-009', 24, '001', '16 Mar 2015', '01 Apr 2015', '16 Apr 2016', 'Ismed Kadarisman, S.Sos', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(22, 'Logistik', 'Kartu Persediaan Stelling', 'N/A', '3', 'UTDPKU-LOG-L3-010', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Ismed Kadarisman, S.Sos', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(23, 'Sistem Kualitas', 'Laporan Hasil QC', 'N/A', '3', 'UTDPKU-SK-L3-011', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(24, 'Rumah Tangga', 'Formulir Kontrol Suhu Ruangan', 'N/A', '3', 'UTDPKU-FORM-RT-L3-012', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(25, 'Produksi', 'Formulir Kontrol Suhu Tempat Penyimpanan Darah', 'N/A', '3', 'UTDPKU-FORM-PROD-L3-013', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(26, 'Mobile Unit', 'Cek List dan Lembar  Kontrol Suhu Cool Box', 'N/A', '3', 'UTDPKU-FORM-MU-L3-014', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(27, 'Rumah Tangga', 'Formulir Kontrol Kebersihan Ruangan', 'N/A', '3', 'UTDPKU-FORM-RT-L3-015', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(32, 'Pelayanan', 'Formulir Donor Darah', 'N/A', '3', 'UTDPKU-FORM-PEL-L3-016', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(33, 'Pelayanan', 'Check List Persiapan Alat Pemeriksaan Pendahuluan', 'N/A', '3', 'UTDPKU-LC-PEL-L3-017', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(34, 'Pelayanan', 'Lembar Kerja Persiapan Alat Pemeriksaan Pendahuluan', 'N/A', '3', 'UTDPKU-LK-PEL-L3-018', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(35, 'Pelayanan', 'Check List Persiapan Reagensia Pemeriksaan Golongan Darah', 'N/A', '3', 'UTDPKU-LC-PEL-L3-019', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(36, 'Pelayanan', 'Lembar Kerja Persiapan Reagensia Pemeriksaan Golongan Darah', 'N/A', '3', 'UTDPKU-LK-PEL-L3-020', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(37, 'Pelayanan', 'Lembar Kerja Pemeriksaan HB', 'N/A', '3', 'UTDPKU-LK-PEL-L3-021', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(38, 'Pelayanan', 'Checklist Pemeriksaan Golongan Darah', 'N/A', '3', 'UTDPKU-LC-PEL-L3-022', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(39, 'Pelayanan', 'Lembar Kerja Pemeriksaan Golongan Darah', 'N/A', '3', 'UTDPKU-LK-PEL-L3-023', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(40, 'Pelayanan', 'Formulir Pencatatan Donor Ditolak', 'N/A', '3', 'UTDPKU-FORM-PEL-L3-024', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(41, 'Pelayanan', 'Check List Persiapan Alat Pengambilan Darah', 'N/A', '3', 'UTDPKU-LC-PEL-L3-025', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(42, 'Pelayanan', 'Lembar Kerja Persiapan Alat Pengambilan Darah', 'N/A', '3', 'UTDPKU-LK-PEL-L3-026', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(43, 'Pelayanan', 'Check List Pengambilan Darah Donor', 'N/A', '3', 'UTDPKU-LC-PEL-L3-027', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(44, 'Pelayanan', 'Check List Persiapan Alat Pemeriksaan IMLTD', 'N/A', '3', 'UTDPKU-LC-PEL-L3-028', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(45, 'Pelayanan', 'Lembar Kerja Persiapan Alat Pemeriksaan IMLTD', 'N/A', '3', 'UTDPKU-LK-PEL-L3-029', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(46, 'Pelayanan', 'Check List Persiapan Reagensia Pemeriksaan Uji Saring', 'N/A', '3', 'UTDPKU-LC-PEL-L3-030', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(47, 'Pelayanan', 'Lembar Kerja Persiapan Reagensia Uji Saring', 'N/A', '3', 'UTDPKU-LK-PEL-L3-031', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(48, 'Pelayanan', 'Check List Pemeriksaan HIV Reagen Architect', 'N/A', '3', 'UTDPKU-LC-PEL-L3-032', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(49, 'Pelayanan', 'Check List Pemeriksaan HBsAg Reagen Architect', 'N/A', '3', 'UTDPKU-LC-PEL-L3-033', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(50, 'Pelayanan', 'Check List Pemeriksaan Syphilis Reagen Architect', 'N/A', '3', 'UTDPKU-LC-PEL-L3-034', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(51, 'Pelayanan', 'Check List Pemeriksaan HCV Reagen Architect', 'N/A', '3', 'UTDPKU-LC-PEL-L3-035', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(52, 'Pelayanan', 'Check List Pemeriksaan Intec Advanced HBsAg ELISA Test Kit v2.0', 'N/A', '3', 'UTDPKU-LC-PEL-L3-036', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(53, 'Pelayanan', 'Check List Pemeriksaan Intec Advanced HIV 1&2 Elisa Test Kit', 'N/A', '3', 'UTDPKU-LC-PEL-L3-037', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(54, 'Pelayanan', 'Check List Pemeriksaan Intec Advanced HCV Elisa Test Kit v2.0', 'N/A', '3', 'UTDPKU-LC-PEL-L3-038', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(55, 'Pelayanan', 'Check List Pemeriksaan Intec Advanced TP Elisa Test Kit v2.0', 'N/A', '3', 'UTDPKU-LC-PEL-L3-039', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(56, 'Pelayanan', 'Check List Pemeriksaan Anti HCV Intec Strip', 'N/A', '3', 'UTDPKU-LC-PEL-L3-040', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(57, 'Pelayanan', 'Check List Pemeriksaan TPHA Intec Strip', 'N/A', '3', 'UTDPKU-LC-PEL-L3-041', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(58, 'Pelayanan', 'Check List Pemeriksaan Anti HIV Intec Strips', 'N/A', '3', 'UTDPKU-LC-PEL-L3-042', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(59, 'Pelayanan', 'Check List Pemeriksaan HBsAg Intec Strips', 'N/A', '3', 'UTDPKU-LC-PEL-L3-043', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(60, 'Pelayanan', 'Check List Persiapan Alat Konfirmasi Golongan Darah', 'N/A', '3', 'UTDPKU-LC-PEL-L3-044', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(61, 'Pelayanan', 'Lembar Kerja Persiapan Alat Konfirmasi Golongan Darah', 'N/A', '3', 'UTDPKU-LK-PEL-L3-045', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(62, 'Pelayanan', 'Check List Persiapan Reagensia Konfirmasi Golongan Darah', 'N/A', '3', 'UTDPKU-LC-PEL-L3-046', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(63, 'Pelayanan', 'Lembar Kerja Persiapan Reagensia Konfirmasi Golongan Darah', 'N/A', '3', 'UTDPKU-LK-PEL-L3-047', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(64, 'Pelayanan', 'Check List Pemisahan Serum/Plasma dari Sel Darah Merah', 'N/A', '3', 'UTDPKU-LC-PEL-L3-048', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(65, 'Pelayanan', 'Check List Pencucian Sel Darah Merah', 'N/A', '3', 'UTDPKU-LC-PEL-L3-049', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(66, 'Pelayanan', 'Check List dan Lembar Kerja Pemeriksaan Konfirmasi Golongan Darah', 'N/A', '3', 'UTDPKU-LC-PEL-L3-050', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(67, 'Pelayanan', 'Lembar Kerja Konfirmasi Golongan Darah ', 'N/A', '3', 'UTDPKU-LK-PEL-L3-051', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(68, 'Pelayanan', 'Check List Persiapan Alat Uji Saring NAT', 'N/A', '3', 'UTDPKU-LC-PEL-L3-052', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(69, 'Pelayanan', 'Lembar Kerja Persiapan Alat Pemeriksaan Uji Saring NAT', 'N/A', '3', 'UTDPKU-LK-PEL-L3-053', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(70, 'Pelayanan', 'Check List Persiapan Reagensia Uji Saring NAT', 'N/A', '3', 'UTDPKU-LC-PEL-L3-054', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(71, 'Pelayanan', 'Lembar Kerja Persiapan Reagensia Uji Saring NAT', 'N/A', '3', 'UTDPKU-LK-PEL-L3-055', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(72, 'Pelayanan', 'Check List Persiapan Reagensia Pemeriksaan NAT', 'N/A', '3', 'UTDPKU-LC-PEL-L3-056', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(73, 'Pelayanan', 'Check List Persiapan Pemeriksaan NAT', 'N/A', '3', 'UTDPKU-LC-PEL-L3-057', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(77, 'Produksi', 'Check List Persiapan Alat Pengolahan Komponen Darah', 'N/A', '3', 'UTDPKU-LC-PROD-L3-058', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(78, 'Produksi', 'Lembar Kerja Persiapan Alat Pengolahan Komponen Darah', 'N/A', '3', 'UTDPKU-LK-PROD-L3-059', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(79, 'Produksi', 'Lembah Hasil Pengolahan Komponen Darah', 'N/A', '3', 'UTDPKU-LH-PROD-L3-060', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(80, 'Produksi', 'Cek List Pencucian Sel Darah Merah', 'N/A', '3', 'UTDPKU-LC-PROD-L3-073', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(81, 'Produksi', 'Lembar Kerja Pencucian Sel Darah Merah', 'N/A', '3', 'UTDPKU-LK-PROD-L3-074', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(82, 'Produksi', 'Cek List Pemisahan Serum/ Plasma dari Sel Darah Merah', 'N/A', '3', 'UTDPKU-LC-PROD-L3-071', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(83, 'Produksi', 'Lembar Kerja Pemisahan Serum/ Plasma dari Sel Darah Merah', 'N/A', '3', 'UTDPKU-LK-PROD-L3-072', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(95, 'Produksi', 'Check List Persiapan Alat Uji Silang Serasi', 'N/A', '3', 'UTDPKU-LC-PROD-L3-067', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(96, 'Produksi', 'Lembar Kerja Persiapan Alat Uji Silang Serasi', 'N/A', '3', 'UTDPKU-LK-PROD-L3-068', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(97, 'Produksi', 'Cek List & Lembar Kerja Pemeriksaan Uji Silang Serasi Mayor Konvensional', 'N/A', '3', 'UTDPKU-LC-PROD-L3-081', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(98, 'Produksi', 'Lembar Hasil Pemeriksaan Uji Silang Serasi Mayor Konvensional', 'N/A', '3', 'UTDPKU-LH-PROD-L3-082', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(99, 'Produksi', 'Cek List & Lembar Kerja Pemeriksaan Uji Silang Serasi Minor Konvensional', 'N/A', '3', 'UTDPKU-LC-PROD-L3-083', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(100, 'Produksi', 'Lembar Hasil Pemeriksaan Uji Silang Serasi Minor Konvensional', 'N/A', '3', 'UTDPKU-LH-PROD-L3-084', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(101, 'Produksi', 'Cek List & Lembar Kerja Pemeriksaan Uji Silang Serasi Mayor Gel Test', 'N/A', '3', 'UTDPKU-LC-PROD-L3-077', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(103, 'Produksi', 'Lembar Hasil Pemeriksaan Uji Silang Serasi Mayor Gel Test', 'N/A', '3', 'UTDPKU-LH-PROD-L3-078', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(104, 'Produksi', 'Cek List & Lembar Kerja Pemeriksaan Uji Silang Serasi Minor Gel Test', 'N/A', '3', 'UTDPKU-LC-PROD-L3-079', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(105, 'Produksi', 'Lembar Hasil Pemeriksaan Uji Silang Serasi Minor Gel Test', 'N/A', '3', 'UTDPKU-LH-PROD-L3-080', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(106, 'Produksi', 'Cek List & Lembar Kerja Pemeriksaan Golongan Darah ABO & Rhesus Pasien Service', 'N/A', '3', 'UTDPKU-LC-PROD-L3-075', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(107, 'Produksi', 'Lembar Hasil Pemeriksaan Golongan Darah Pasien Service', 'N/A', '3', 'UTDPKU-LH-PROD-L3-076', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(108, 'Produksi', 'Cek List Persiapan Reagensia Pasien Service', 'N/A', '3', 'UTDPKU-LC-PROD-L3-069', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(109, 'Produksi', 'Lembar Kerja Persiapan Reagensia Pasien Service', 'N/A', '3', 'UTDPKU-LK-PROD-L3-070', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(110, 'Produksi', 'Lembar Kerja Test Validasi Reagensia ABO', 'N/A', '3', 'UTDPKU-LK-PROD-L3-061', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(111, 'Produksi', 'Lembar Hasil Test Validasi Reagensia ABO', 'N/A', '3', 'UTDPKU-LH-PROD-L3-062', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(112, 'Produksi', 'Lembar Kerja Test Validasi Reagensia Test Cell', 'N/A', '3', 'UTDPKU-LK-PROD-L3-063', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(113, 'Produksi', 'Lembar Kerja Test Validasi Reagensia AHG', 'N/A', '3', 'UTDPKU-LK-PROD-L3-065', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(114, 'Produksi', 'Lembar Hasil Test Validasi Reagensia Test Cell', 'N/A', '3', 'UTDPKU-LH-PROD-L3-064', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(115, 'Produksi', 'Lembar Hasil Validasi Reagensia AHG', 'N/A', '3', 'UTDPKU-LH-PROD-L3-066', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(116, 'Distribusi', 'Cek List Persiapan Alat Distribusi', 'N/A', '3', 'UTDPKU-LC-DIST-L3-085', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(117, 'Distribusi', 'Lembar Kerja Persiapan Alat Distribusi', 'N/A', '3', 'UTDPKU-LK-DIST-L3-086', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(118, 'Distribusi', 'Cek List Persiapan Reagensia Distribusi', 'N/A', '3', 'UTDPKU-LC-DIST-L3-087', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(119, 'Distribusi', 'Lembar Kerja Persiapan Reagensia Distribusi', 'N/A', '3', 'UTDPKU-LK-DIST-L3-088', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(120, 'Distribusi', 'Cek List Pemisahan Serum/ Plasma dari Sel Darah Merah Distribusi', 'N/A', '3', 'UTDPKU-LC-DIST-L3-089', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(121, 'Distribusi', 'Lembar Kerja Pemisahan Serum/ Plasma dari Sel Darah Merah Distribusi', 'N/A', '3', 'UTDPKU-LK-DIST-L3-090', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(122, 'Distribusi', 'Cek List & Lembar Kerja Pemeriksaan Golongan Darah', 'N/A', '3', 'UTDPKU-LC-DIST-L3-093', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(123, 'Mobile Unit', 'Cek List Penilaian Lokasi MU dan BU', 'N/A', '3', 'UTDPKU-LC-MU-L3-098', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(124, 'Sistem Kualitas', 'Cek List & Lembar Kerja Sterilisasi Peralatan', 'N/A', '3', 'UTDPKU-LC-SK-L3-099', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(125, 'Distribusi', 'Cek List Pencucian Sel Darah Merah Distribusi', 'N/A', '3', 'UTDPKU-LC-DIST-L3-091', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(126, 'Distribusi', 'Lembar Kerja Pencucian Sel Darah Merah Distribusi', 'N/A', '3', 'UTDPKU-LK-DIST-L3-092', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(127, 'Produksi', 'Lembar Kerja Bagian Produksi, Penyimpanan & Uji Silang Serasi', 'N/A', '3', 'UTDPKU-LK-PROD-L3-094', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(128, 'Produksi', 'Lembar Kerja Bagian Produksi, Penyimpanan & Uji Silang Serasi BDRS', 'N/A', '3', 'UTDPKU-LK-PROD-L3-095', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(129, 'Distribusi', 'Lembar Kerja Bagian Penerimaan Sampel dan Distribusi', 'N/A', '3', 'UTDPKU-LK-DIST-L3-096', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(130, 'Distribusi', 'Lembar Kerja Penerimaan Sampel dan Distribusi Stok Darah', 'N/A', '3', 'UTDPKU-LK-DIST-L3-097', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(131, 'Mobile Unit', 'Formulir Permintaan Jenis Kantong Pengambilan Darah MU & BU', 'N/A', '3', 'UTDPKU-FORM-MU-L3-100', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(132, 'Mobile Unit', 'Formulir Transportasi Darah MU & BU', 'N/A', '3', 'UTDPKU-FORM-MU-L3-101', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(133, 'Mobile Unit', 'Lay Out MU & BU', 'N/A', '3', 'UTDPKU-FORM-MU-L3-102', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(134, 'Pelayanan', 'Formulir Donor Aferesis', 'N/A', '3', 'UTDPKU-FORM-PEL-L3-103', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(135, 'Pelayanan', 'Lembar Hasil Pengambilan Tromboferesis', 'N/A', '3', 'UTDPKU-LH-PEL-L3-104', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(136, 'Pelayanan', 'Lembar Kerja Uji Saring Darah Donor', 'N/A', '3', 'UTDPKU-LK-PEL-L3-105', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', '', '', '', NULL),
(137, 'Rumah Tangga', 'Formulir Pencatatan Voltase Genset', 'N/A', '3', 'UTDPKU-FORM-RT-L3-106', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Ismed Kadarisman, S.Sos', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(138, 'Logistik', 'Lembar Kerja Pemeriksaan Alat & Bahan Logistik', 'N/A', '3', 'UTDPKU-LK-LOG-L3-107', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', 'Ismed Kadarisman, S.Sos', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(139, 'Pelayanan', 'Formulir Pencatatan Penggunaan Mesin Trima Accel', 'N/A', '3', 'UTDPKU-FORM-PEL-L3-108', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(140, 'Sistem Kualitas', 'Check List QC WB', 'N/A', '3', 'UTDPKU-LC-SK-L3-109', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(141, 'Sistem Kualitas', 'Laporan QC WB', 'N/A', '3', 'UTDPKU-LH-SK-L3-110', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(142, 'Sistem Kualitas', 'Lembar Kerja QC WB', 'N/A', '3', 'UTDPKU-LK-SK-L3-111', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(143, 'Sistem Kualitas', 'Check List QC PRC', 'N/A', '3', 'UTDPKU-LC-SK-L3-112', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(144, 'Sistem Kualitas', 'Laporan QC PRC', 'N/A', '3', 'UTDPKU-LH-SK-L3-113', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(145, 'Sistem Kualitas', 'Lembar Kerja QC PRC', 'N/A', '3', 'UTDPKU-LK-SK-L3-114', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(146, 'Sistem Kualitas', 'Cek List QC TC', 'N/A', '3', 'UTDPKU-LC-SK-L3-115', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(147, 'Sistem Kualitas', 'Laporan QC TC', 'N/A', '3', 'UTDPKU-LH-SK-L3-116', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(148, 'Sistem Kualitas', 'Lembar Kerja QC TC', 'N/A', '3', 'UTDPKU-LK-SK-L3-117', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(149, 'Sistem Kualitas', 'Cek List QC FFP', 'N/A', '3', 'UTDPKU-LC-SK-L3-118', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(150, 'Sistem Kualitas', 'Laporan QC FFP', 'N/A', '3', 'UTDPKU-LH-SK-L3-119', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(151, 'Sistem Kualitas', 'Lembar Kerja QC FFP', 'N/A', '3', 'UTDPKU-LK-SK-L3-120', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(152, 'Distribusi', 'Lembar Kerja PTKK 4/ Ketua TIM', 'N/A', '3', 'UTDPKU-LK-DIST-L3-121', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Dian I.K Singgih', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(153, 'Pelayanan', 'Buku Pemakaian Kantong Aftap', 'N/A', '3', 'UTDPKU-BK-PEL-L3-122', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(154, 'Pelayanan', 'Buku Pemakaian Alat-Alat Hb dan Aftap', 'N/A', '3', 'UTDPKU-BK-PEL-L3-123', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(155, 'Pelayanan', 'Buku Catatan Kejadian Gagal Aftap ', 'N/A', '3', 'UTDPKU-BK-PEL-L3-124', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(156, 'Pelayanan', 'Buku Catatan Hasil Kontrol Compolab ', 'N/A', '3', 'UTDPKU-BK-PEL-L3-125', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(157, 'Pelayanan', 'Buku Catatan Pasien Hb Tinggi (Polysitemia)', 'N/A', '3', 'UTDPKU-BK-PEL-L3-126', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(158, 'Pelayanan', 'Buku Catatan Donor Pengganti dan Donor Langsung ', 'N/A', '3', 'UTDPKU-BK-PEL-L3-127', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(159, 'Pelayanan', 'Buku Catatan Riwayat Donor Cekal', 'N/A', '3', 'UTDPKU-BK-PEL-L3-128', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(160, 'Pelayanan', 'Buku Orderan Darah dan Komponen Darah ', 'N/A', '3', 'UTDPKU-BK-PEL-L3-129', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(161, 'Pelayanan', 'Buku Catatan Donor Rhesus Negatif', 'N/A', '3', 'UTDPKU-BK-PEL-L3-130', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(162, 'Pelayanan', 'Buku Catatan Donor Pengganti Stok Darah Penuh', 'N/A', '3', 'UTDPKU-BK-PEL-L3-131', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(163, 'Pelayanan', 'Buku Serah Terima Piagam Donor Darah Sukarela', 'N/A', '3', 'UTDPKU-BK-PEL-L3-132', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(164, 'Pelayanan', 'Buku Serah Terima Alat-Alat Mobile Unit', 'N/A', '3', 'UTDPKU-BK-PEL-L3-133', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(165, 'Pelayanan', 'Buku Laporan Darah Masuk dari Mobile Unit', 'N/A', '3', 'UTDPKU-BK-PEL-L3-134', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(166, 'Pelayanan', 'Buku Uji Saring IMLTD', 'N/A', '3', 'UTDPKU-BK-PEL-L3-135', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(167, 'Pelayanan', 'Buku Pemakaian Reagensia IMLTD', 'N/A', '3', 'UTDPKU-BK-PEL-L3-136', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(168, 'Pelayanan', 'Buku Hasil Uji Saring Donor Aferesis', 'N/A', '3', 'UTDPKU-BK-PEL-L3-137', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(169, 'Pelayanan', 'Buku Catatan Donor HIV Reaktif', 'N/A', '3', 'UTDPKU-BK-PEL-L3-138', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(170, 'Pelayanan', 'Buku Trouble Shooting Alat Architect', 'N/A', '3', 'UTDPKU-BK-PEL-L3-139', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(171, 'Pelayanan', 'Buku Catatan Konfirmasi Golongan Darah', 'N/A', '3', 'UTDPKU-BK-PEL-L3-140', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(172, 'Pelayanan', 'Buku Hasil Konfirmasi Berubah Golongan Darah ke Mobile Unit', 'N/A', '3', 'UTDPKU-BK-PEL-L3-141', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(173, 'Pelayanan', 'Buku Hasil Konfirmasi Berubah Golongan Darah ke Pemeriksaan Awal', 'N/A', '3', 'UTDPKU-BK-PEL-L3-142', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(174, 'Pelayanan', 'Buku Penyerahan Sampel dari Mobile Unit ke Labor', 'N/A', '3', 'UTDPKU-BK-PEL-L3-143', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(175, 'Pelayanan', 'Buku Pemeriksaan Uji Saring NAT', 'N/A', '3', 'UTDPKU-BK-PEL-L3-144', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(176, 'Pelayanan', 'Buku Pemakaian Reagensia NAT', 'N/A', '3', 'UTDPKU-BK-PEL-L3-145', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(177, 'Pelayanan', 'Buku Perawatan Alat Panther NAT', 'N/A', '3', 'UTDPKU-BK-PEL-L3-146', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(178, 'Pelayanan', 'Buku Penerimaan Alat (Spare Part) Uji Saring', 'N/A', '3', 'UTDPKU-BK-PEL-L3-147', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', '', NULL),
(179, 'Produksi', 'Buku Reagensia', 'N/A', '3', 'UTDPKU-BK-PROD-L3-148', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(180, 'Produksi', 'Buku Kasus Incompatibel', 'N/A', '3', 'UTDPKU-BK-PROD-L3-149', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(181, 'Produksi', 'Buku Perawatan Alat', 'N/A', '3', 'UTDPKU-BK-PROD-L3-150', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(182, 'Produksi', 'Buku Pemakaian Kantong WE, Leukodepleted, Diaclond, dan Docking Darah', 'N/A', '3', 'UTDPKU-BK-PROD-L3-151', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(183, 'Produksi', 'Buku Komponen Darah', 'N/A', '3', 'UTDPKU-BK-PROD-L3-152', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(184, 'Produksi', 'Buku Pemusnahan Darah', 'N/A', '3', 'UTDPKU-BK-PROD-L3-153', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(185, 'Produksi', 'Buku Du Darah Rhesus Negatif', 'N/A', '3', 'UTDPKU-BK-PROD-L3-154', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(186, 'Distribusi', 'Buku Tamu', 'N/A', '3', 'UTDPKU-BK-DIST-L3-155', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(187, 'Distribusi', 'Buku Serah Terima Darah Keluar dengan Keluarga Pasien', 'N/A', '3', 'UTDPKU-BK-DIST-L3-156', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(188, 'Distribusi', 'Buku Second Check Darah Keluar', 'N/A', '3', 'UTDPKU-BK-DIST-L3-157', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(189, 'Distribusi', 'Buku Darah Kembali', 'N/A', '3', 'UTDPKU-BK-DIST-L3-158', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(190, 'Distribusi', 'Buku ACC BDRS UD', 'N/A', '3', 'UTDPKU-BK-DIST-L3-159', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(191, 'Distribusi', 'Buku Kasus Distribusi', 'N/A', '3', 'UTDPKU-BK-DIST-L3-160', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(192, 'Distribusi', 'Buku Permintaan Cyto', 'N/A', '3', 'UTDPKU-BK-DIST-L3-161', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(193, 'Distribusi', 'Buku Pemusnahan Darah Titipan dan Darah Kembali', 'N/A', '3', 'UTDPKU-BK-DIST-L3-162', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(194, 'Distribusi', 'Buku Serah Terima Contoh Darah Pasien dan Darah Selesai Crossmatching', 'N/A', '3', 'UTDPKU-BK-DIST-L3-163', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', '', '', NULL),
(195, 'Pelayanan', 'Buku Pencatatan Pengambilan Darah Aferesis', 'N/A', '3', 'UTDPKU-BK-PEL-L3-164', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', '', '', NULL),
(196, 'Pelayanan', 'Buku Pencatatan Stok Barang Aferesis', 'N/A', '3', 'UTDPKU-BK-PEL-L3-165', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', '', '', NULL),
(197, 'Pelayanan', 'Buku Pencatatan Donor Aferesis', 'N/A', '3', 'UTDPKU-BK-PEL-L3-166', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', '', '', NULL),
(198, 'Pelayanan', 'Buku Pencatatan Pemeriksaan Darah Rutin', 'N/A', '3', 'UTDPKU-BK-PEL-L3-167', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', '', '', NULL),
(199, 'Produksi', 'Buku Pencatatan Pasien Aferesis', 'N/A', '3', 'UTDPKU-BK-PROD-L3-168', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', '', '', NULL),
(200, 'Mobile Unit', 'Buku Rekapitulasi Kegiatan MU', 'N/A', '3', 'UTDPKU-BK-MU-L3-169', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', '', '', NULL),
(201, 'Pelayanan', 'Agenda Piagam DDS', 'N/A', '3', 'UTDPKU-BK-PEL-L3-170', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Dian I.K Singgih', '', '', NULL),
(202, 'Pelayanan', 'Agenda Rujukan IMLTD Internal', 'N/A', '3', 'UTDPKU-BK-PEL-L3-171', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Dian I.K Singgih', '', '', NULL),
(203, 'Pelayanan', 'Agenda Rujukan IMLTD Eksternal', 'N/A', '3', 'UTDPKU-BK-PEL-L3-172', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Dian I.K Singgih', '', '', NULL),
(204, 'Sekretaris', 'Agenda Umum 2015', 'N/A', '3', 'UTDPKU-BK-SEKRE-L3-173', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yayat Supriatna, SE', '', '', NULL),
(205, 'Kepegawaian', 'Buku Nota Dinas Kepegawaian', 'N/A', '3', 'UTDPKU-BK-PEG-L3-174', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', '', '', NULL),
(206, 'Sistem Kualitas', 'Lembar Hasil Pemeriksaan QC WB', 'N/A', '3', 'UTDPKU-LH-SK-L3-175', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', '', NULL),
(207, 'Sistem Kualitas', 'Lembar Hasil Pemeriksaan QC PRC', 'N/A', '3', 'UTDPKU-LH-SK-L3-176', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', '', NULL),
(208, 'Sistem Kualitas', 'Lembar Hasil Pemeriksaan QC TC', 'N/A', '3', 'UTDPKU-LH-SK-L3-177', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', '', NULL),
(209, 'Sistem Kualitas', 'Lembar Hasil Pemeriksaan QC FFP', 'N/A', '3', 'UTDPKU-LH-SK-L3-178', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Reni Oktora', '', NULL),
(210, 'Produksi', 'Daftar Kunjungan Ruang Dingin', 'N/A', '3', 'UTDPKU-FORM-PROD-L3-179', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(211, 'Produksi', 'Kartu Stok Darah Cool Room', 'N/A', '3', 'UTDPKU-FORM-PROD-L3-180', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(212, 'Mobile Unit', 'Check List Peralatan MU', 'N/A', '3', 'UTDPKU-LC-MU-L3-181', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(213, 'Pelayanan', 'Lembar Kerja Ketua TIM', 'N/A', '3', 'UTDPKU-FORM-PEL-L3-182', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Reni Oktora', '', '', NULL),
(214, 'Pelayanan', 'Surat Rujukan Pasca Donasi', 'N/A', '3', 'UTDPKU-FORM-PEL-L3-183', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', '', '', NULL),
(215, 'Distribusi', 'Buku BDRS', 'N/A', '3', 'UTDPKU-BK-DIST-L3-184', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(216, 'Distribusi', 'Buku Tamu Permintaan Rhesus Negatif', 'N/A', '3', 'UTDPKU-BK-DIST-L3-185', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(217, 'Pelayanan', 'Buku Penerimaan Sample VCT', 'N/A', '3', 'UTDPKU-BK-PEL-L3-186', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', '', '', NULL),
(218, 'Rumah Tangga', 'Daftar Inventaris Ruangan', 'N/A', '3', 'UTDPKU-FORM-RT-L3-187', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Ismed Kadarisman, S.Sos', 'Ismed Kadarisman, S.Sos', 'Dr. Bebe Gani', NULL),
(219, 'Pelayanan', 'Formulir Pengiriman Sampel Darah', 'N/A', '3', 'UTDPKU-FORM-PEL-L3-188', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', 'Dr. Bebe Gani', NULL),
(220, 'Pelayanan', 'Formulir Pengiriman Darah', 'N/A', '3', 'UTDPKU-FORM-PEL-L3-189', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', '', 'Dr. Bebe Gani', NULL),
(221, 'Pelayanan', 'Buku Penyerahan Surat Rujukan kepada Donor Reaktif', 'N/A', '3', 'UTDPKU-BK-PEL-L3-190', 24, '001', '31 Aug 2015', '01 Sep 2015', '01 Sep 2016', 'Dr. Dian I.K Singgih', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(224, 'Pelayanan', 'Lembar Kerja Pemeriksaan Du', 'N/A', '3', 'UTDPKU-LK-PEL-L3-191', 24, '001', '31 Aug 2015', '01 Sep 2015', '01 Sep 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(225, 'Sistem Kualitas', 'Daftar Distribusi Dokumen Tidak Terkendali', 'N/A', '3', 'UTDPKU-FORM-SK-L3-192', 24, '001', '31 Aug 2015', '01 Sep 2015', '01 Sep 2016', 'Dr. Reni Oktora', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(226, 'Sistem Kualitas', 'Bukti Penarikan Dokumen', 'N/A', '3', 'UTDPKU-FORM-SK-L3-193', 24, '001', '31 Aug 2015', '01 Sep 2015', '01 Sep 2016', 'Dr. Reni Oktora', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ik`
--

CREATE TABLE IF NOT EXISTS `ik` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(200) DEFAULT NULL,
  `nama1` varchar(200) DEFAULT NULL,
  `nama2` varchar(200) DEFAULT NULL,
  `tingkat` varchar(200) DEFAULT NULL,
  `kontrol` varchar(200) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `no_versi` varchar(50) DEFAULT NULL,
  `tgl_setuju` varchar(100) DEFAULT NULL,
  `tgl_pelaksanaan` varchar(100) DEFAULT NULL,
  `tgl_peninjauan` varchar(100) DEFAULT NULL,
  `pembuat` varchar(200) DEFAULT NULL,
  `pemeriksa` varchar(200) DEFAULT NULL,
  `pengesah` varchar(200) DEFAULT NULL,
  `fileku` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `ik`
--

INSERT INTO `ik` (`nomor`, `bidang`, `nama1`, `nama2`, `tingkat`, `kontrol`, `periode`, `no_versi`, `tgl_setuju`, `tgl_pelaksanaan`, `tgl_peninjauan`, `pembuat`, `pemeriksa`, `pengesah`, `fileku`) VALUES
(1, 'Pelayanan', 'IK Pemeriksaan Kesehatan Sederhana', 'N/A', '2', 'UTDPKU-IK-PEL-L2-001', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(2, 'Pelayanan', 'IK Pemeriksaan Haemoglobin', 'N/A', '2', 'UTDPKU-IK-PEL-L2-002', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(3, 'Pelayanan', 'IK Pemeriksaan Golongan Darah dengan Metode Bioplate', 'N/A', '2', 'UTDPKU-IK-PEL-L2-003', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(4, 'Pelayanan', 'IK Pengambilan Darah Secara Manual', 'N/A', '2', 'UTDPKU-IK-PEL-L2-004', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(5, 'Pelayanan', 'IK Pengambilan Darah Secara Aferesis', 'N/A', '2', 'UTDPKU-IK-PEL-L2-005', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(6, 'Pelayanan', 'IK Pemeriksaan Golongan Darah dengan Metode Tube Test', 'N/A', '2', 'UTDPKU-IK-PEL-L2-006', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(8, 'Pelayanan', 'IK Pemeriksaan HBsAg Intec Strip', 'N/A', '2', 'UTDPKU-IK-PEL-L2-007', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(9, 'Pelayanan', 'IK Pemeriksaan HBsAg Intec Advanced', 'N/A', '2', 'UTDPKU-IK-PEL-L2-008', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(10, 'Pelayanan', 'IK Pemeriksaan HBsAg Architect i2000', 'N/A', '2', 'UTDPKU-IK-PEL-L2-009', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(11, 'Pelayanan', 'IK Pemeriksaan HBV Ultrio Elite', 'N/A', '2', 'UTDPKU-IK-PEL-L2-010', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(12, 'Pelayanan', 'IK Pemeriksaan Discriminatory HBV', 'N/A', '2', 'UTDPKU-IK-PEL-L2-011', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(13, 'Pelayanan', 'IK Pemeriksaan HCV Tri-dot', 'N/A', '2', 'UTDPKU-IK-PEL-L2-012', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(14, 'Pelayanan', 'IK Pemeriksaan HCV Intec Strip', 'N/A', '2', 'UTDPKU-IK-PEL-L2-013', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(15, 'Pelayanan', 'IK Pemeriksaan HCV Intec Advanced', 'N/A', '2', 'UTDPKU-IK-PEL-L2-014', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(16, 'Pelayanan', 'IK Pemeriksaan HCV Architect i2000', 'N/A', '2', 'UTDPKU-IK-PEL-L2-015', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(17, 'Pelayanan', 'IK Pemeriksaan HCV Ultrio Elite', 'N/A', '2', 'UTDPKU-IK-PEL-L2-016', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(18, 'Pelayanan', 'IK Pemeriksaan Discriminatory HCV', 'N/A', '2', 'UTDPKU-IK-PEL-L2-017', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(19, 'Pelayanan', 'IK Pemeriksaan HIV Intec Strip', 'N/A', '2', 'UTDPKU-IK-PEL-L2-018', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(20, 'Pelayanan', 'IK Pemeriksaan HIV Intec Advanced', 'N/A', '2', 'UTDPKU-IK-PEL-L2-019', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(21, 'Pelayanan', 'IK Pemeriksaan HIV Architect i2000', 'N/A', '2', 'UTDPKU-IK-PEL-L2-020', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(22, 'Pelayanan', 'IK Pemeriksaan HIV Ultrio Elite', 'N/A', '2', 'UTDPKU-IK-PEL-L2-021', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(23, 'Pelayanan', 'IK Pemeriksaan Discriminatory HIV', 'N/A', '2', 'UTDPKU-IK-PEL-L2-022', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(24, 'Pelayanan', 'IK Pemeriiksaan TPHA Intec Strip', 'N/A', '2', 'UTDPKU-IK-PEL-L2-023', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(25, 'Pelayanan', 'IK Pemeriksaan TP Intec Advanced', 'N/A', '2', 'UTDPKU-IK-PEL-L2-024', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(26, 'Pelayanan', 'IK Pemeriksaan Syphilis TP Architect i2000', 'N/A', '2', 'UTDPKU-IK-PEL-L2-025', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(27, 'Produksi', 'IK Pengolahan Komponen Darah Dengan Kantong Dua', 'N/A', '2', 'UTDPKU-IK-PROD-L2-026', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(28, 'Produksi', 'IK Pengolahan Komponen Darah Dengan Kantong Tiga', 'N/A', '2', 'UTDPKU-IK-PROD-L2-027', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(29, 'Produksi', 'IK Pengolahan Komponen Darah Dengan Kantong Pediatrik', 'N/A', '2', 'UTDPKU-IK-PROD-L2-028', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(30, 'Produksi', 'IK Pengolahan Darah Merah Cuci (WE)', 'N/A', '2', 'UTDPKU-IK-PROD-L2-029', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(31, 'Produksi', 'IK Pengolahan Darah Leukodepleted', 'N/A', '2', 'UTDPKU-IK-PROD-L2-030', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(32, 'Produksi', 'IK Penyimpanan Darah & Komponen Darah', 'N/A', '2', 'UTDPKU-IK-PROD-L2-031', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(39, 'Produksi', 'IK Persiapan Contoh Darah', 'N/A', '2', 'UTDPKU-IK-PROD-L2-032', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(40, 'Produksi', 'IK Pemisahan Serum/ Plasma', 'N/A', '2', 'UTDPKU-IK-PROD-L2-033', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(41, 'Produksi', 'IK Pencucian Sel Darah Merah Pekat', 'N/A', '2', 'UTDPKU-IK-PROD-L2-034', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(42, 'Produksi', 'IK Pembuatan Suspensi Sel Darah Merah', 'N/A', '2', 'UTDPKU-IK-PROD-L2-035', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(45, 'Produksi', 'IK Pembuatan Test Cell ABO', 'N/A', '2', 'UTDPKU-IK-PROD-L2-036', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(46, 'Produksi', 'IK Pembuatan CCC', 'N/A', '2', 'UTDPKU-IK-PROD-L2-037', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(47, 'Produksi', 'IK Pemeriksaan Uji Silang Serasi Metode Tube Test', 'N/A', '2', 'UTDPKU-IK-PROD-L2-038', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(48, 'Produksi', 'IK Pemeriksaan Uji Silang Serasi Metode Gell Test', 'N/A', '2', 'UTDPKU-IK-PROD-L2-039', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(49, 'Produksi', 'IK Pemeriksaan DCT Metode Tube Test', 'N/A', '2', 'UTDPKU-IK-PROD-L2-040', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(50, 'Produksi', 'IK Pemeriksaan DCT Metode Gell ', 'N/A', '2', 'UTDPKU-IK-PROD-L2-041', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(51, 'Produksi', 'IK Pemeriksaan Golongan Darah Metode Gell', 'N/A', '2', 'UTDPKU-IK-PROD-L2-042', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(52, 'Produksi', 'IK Pemeriksaan Du', 'N/A', '2', 'UTDPKU-IK-PROD-L2-043', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(53, 'Produksi', 'IK Pemeriksaan Golongan Darah Pre-Warm', 'N/A', '2', 'UTDPKU-IK-PROD-L2-044', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(54, 'Produksi', 'IK Validasi Reagensia', 'N/A', '2', 'UTDPKU-IK-PROD-L2-045', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(55, 'Mobile Unit', 'IK Pengambilan Darah MU & BU', 'N/A', '2', 'UTDPKU-IK-MU-L2-046', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(56, 'Mobile Unit', 'IK Pengontrolan Suhu Cool Box MU & BU', 'N/A', '2', 'UTDPKU-IK-MU-L2-047', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(57, 'Pelayanan', 'IK Sterilisasi Peralatan Pengambilan Darah ', 'N/A', '2', 'UTDPKU-IK-PEL-L2-048', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(58, 'Sistem Kualitas', 'IK Quality Control WB', 'N/A', '2', 'UTDPKU-IK-SK-L2-049', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2015', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(59, 'Sistem Kualitas', 'IK Quality Control PRC', 'N/A', '2', 'UTDPKU-IK-SK-L2-050', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(60, 'Sistem Kualitas', 'IK Quality Control TC', 'N/A', '2', 'UTDPKU-IK-SK-L2-051', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(61, 'Sistem Kualitas', 'IK Quality Control FFP', 'N/A', '2', 'UTDPKU-IK-SK-L2-052', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(62, 'Sistem Informasi', 'IK SIM Logistik', 'N/A', '2', 'UTDPKU-IK-SIM-L2-053', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(63, 'Sistem Informasi', 'IK SIM P2D2S', 'N/A', '2', 'UTDPKU-IK-SIM-L2-054', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(64, 'Sistem Informasi', 'IK SIM Donor Service', 'N/A', '2', 'UTDPKU-IK-SIM-L2-055', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(65, 'Sistem Informasi', 'IK SIM Aftap', 'N/A', '2', 'UTDPKU-IK-SIM-L2-056', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(66, 'Sistem Informasi', 'IK SIM Mobile Unit', 'N/A', '2', 'UTDPKU-IK-SIM-L2-057', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(67, 'Sistem Informasi', 'IK SIM Konfirmasi Golongan Darah', 'N/A', '2', 'UTDPKU-IK-SIM-L2-058', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(68, 'Sistem Informasi', 'IK SIM IMLTD', 'N/A', '2', 'UTDPKU-IK-SIM-L2-059', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(69, 'Sistem Informasi', 'IK SIM Komponen', 'N/A', '2', 'UTDPKU-IK-SIM-L2-060', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(70, 'Sistem Informasi', 'IK SIM Crossmatch & Distribusi', 'N/A', '2', 'UTDPKU-IK-SIM-L2-061', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(71, 'Sistem Informasi', 'IK SIM Laporan Shift Jaga Labor', 'N/A', '2', 'UTDPKU-IK-SIM-L2-062', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(72, 'Pelayanan', 'IK Pemeriksaan Golongan Darah Metode Paper Slide', 'N/A', '2', 'UTDPKU-IK-PEL-L2-063', 24, '001', '01 Jun 2015', '01 Jun 2015', '01 Jun 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(73, 'Pelayanan', 'IK Penanganan Sampel Darah Donor Reaktif', 'N/A', '2', 'UTDPKU-IK-PEL-L2-064', 24, '001', '01 Jun 2015', '01 Jun 2015', '01 Jun 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(74, 'Produksi', 'IK Pemeriksaan Uji Silang Serasi Metode Gell Test', 'N/A', '2', 'UTDPKU-IK-PEL-L2-065', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ika`
--

CREATE TABLE IF NOT EXISTS `ika` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(200) DEFAULT NULL,
  `nama1` varchar(200) DEFAULT NULL,
  `nama2` varchar(200) DEFAULT NULL,
  `tingkat` varchar(200) DEFAULT NULL,
  `kontrol` varchar(200) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `no_versi` varchar(50) DEFAULT NULL,
  `tgl_setuju` varchar(100) DEFAULT NULL,
  `tgl_pelaksanaan` varchar(100) DEFAULT NULL,
  `tgl_peninjauan` varchar(100) DEFAULT NULL,
  `pembuat` varchar(200) DEFAULT NULL,
  `pemeriksa` varchar(200) DEFAULT NULL,
  `pengesah` varchar(200) DEFAULT NULL,
  `fileku` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `ika`
--

INSERT INTO `ika` (`nomor`, `bidang`, `nama1`, `nama2`, `tingkat`, `kontrol`, `periode`, `no_versi`, `tgl_setuju`, `tgl_pelaksanaan`, `tgl_peninjauan`, `pembuat`, `pemeriksa`, `pengesah`, `fileku`) VALUES
(12, 'Pelayanan', 'IKA Pen Blood', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-001', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(13, 'Pelayanan', 'IKA Compolab', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-002', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(14, 'Pelayanan', 'IKA Haemolight Plus', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-003', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(15, 'Pelayanan', 'IKA Centrifuge Hettich Universal 320', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-004', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(16, 'Pelayanan', 'IKA Micropipet', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-005', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(17, 'Pelayanan', 'IKA Incubator Digisystem Laboratory Instruments', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-006', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(18, 'Pelayanan', 'IKA Washer IWO AUTO BIO', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-007', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(19, 'Pelayanan', 'IKA Reader PHOMO AUTOBIO', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-008', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(20, 'Pelayanan', 'IKA Architect i2000', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-009', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(21, 'Pelayanan', 'IKA Phanter System', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-010', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(22, 'Pelayanan', 'IKA RPI', 'N/A', '2', 'UTDPKU-IKA-PEL-L2-011', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(23, 'Produksi', 'IKA Balance Ohaus', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-012', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(24, 'Produksi', 'IKA Refrigerated Centrifuge Kubota', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-013', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(25, 'Produksi', 'IKA Refrigerated Centrifuge Rotanta 460 RS', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-014', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(26, 'Produksi', 'IKA Refrigerated Centrifuge Rotixa 50 RS', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-015', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(27, 'Produksi', 'IKA Plasma Extractor', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-016', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(28, 'Produksi', 'IKA Compomat G4', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-017', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(29, 'Produksi', 'IKA Compomat G5', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-018', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(30, 'Produksi', 'IKA Compodock', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-019', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(31, 'Produksi', 'IKA Elektric Sealer', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-020', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(32, 'Produksi', 'IKA Blast Freezer', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-021', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(33, 'Produksi', 'IKA Meja Dingin', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-022', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(34, 'Produksi', 'IKA Refrigerator', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-023', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(35, 'Produksi', 'IKA Freezer', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-024', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(36, 'Produksi', 'IKA Platelet Agitator', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-025', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(37, 'Produksi', 'IKA Auto Hematologi Analyzer Mindray BC-2800', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-026', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(38, 'Produksi', 'IKA Trima Accel Automated Blood Collection System', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-027', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(39, 'Produksi', 'IKA ID Centrifuge 12 S II', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-028', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(40, 'Produksi', 'IKA ID Incubator 37 S II', 'N/A', '2', 'UTDPKU-IKA-PROD-L2-029', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(41, 'Mobile Unit', 'IKA Haemoscale', 'N/A', '2', 'UTDPKU-IKA-MU-L2-030', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(42, 'Mobile Unit', 'IKA Blood Collection Scale', 'N/A', '2', 'UTDPKU-IKA-MU-L2-031', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(43, 'Mobile Unit', 'IKA Cool Box Twin Bird', 'N/A', '2', 'UTDPKU-IKA-MU-L2-032', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(44, 'Rumah Tangga', 'IKA Mesin Diesel/ Generating Set', 'N/A', '2', 'UTDPKU-IKA-RT-L2-033', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Ismed Kadarisman, S.Sos', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kebijakan`
--

CREATE TABLE IF NOT EXISTS `kebijakan` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(200) DEFAULT NULL,
  `nama1` varchar(200) DEFAULT NULL,
  `nama2` varchar(200) DEFAULT NULL,
  `tingkat` varchar(200) DEFAULT NULL,
  `kontrol` varchar(200) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `no_versi` varchar(50) DEFAULT NULL,
  `tgl_setuju` varchar(100) DEFAULT NULL,
  `tgl_pelaksanaan` varchar(100) DEFAULT NULL,
  `tgl_peninjauan` varchar(100) DEFAULT NULL,
  `pembuat` varchar(200) DEFAULT NULL,
  `pemeriksa` varchar(200) DEFAULT NULL,
  `pengesah` varchar(200) DEFAULT NULL,
  `fileku` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kebijakan`
--

INSERT INTO `kebijakan` (`nomor`, `bidang`, `nama1`, `nama2`, `tingkat`, `kontrol`, `periode`, `no_versi`, `tgl_setuju`, `tgl_pelaksanaan`, `tgl_peninjauan`, `pembuat`, `pemeriksa`, `pengesah`, `fileku`) VALUES
(1, 'Sistem Kualitas', 'Kebijakan Kualitas', 'N/A', '1', 'UTDPKU-KEB-SK-L1-001', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Bebe Gani', '', NULL),
(2, 'Sistem Kualitas', 'Manual Kualitas', 'N/A', '1', 'UTDPKU-SK-L1-002', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Reni Oktora', 'Dr. Bebe Gani', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kontrol`
--

CREATE TABLE IF NOT EXISTS `kontrol` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(200) DEFAULT NULL,
  `nama1` varchar(200) DEFAULT NULL,
  `nama2` varchar(200) DEFAULT NULL,
  `nama3` varchar(200) DEFAULT NULL,
  `nama4` varchar(200) DEFAULT NULL,
  `nama5` varchar(200) DEFAULT NULL,
  `nama6` varchar(200) DEFAULT NULL,
  `nama7` varchar(200) DEFAULT NULL,
  `kontrol1` varchar(200) DEFAULT NULL,
  `kontrol2` varchar(200) DEFAULT NULL,
  `kontrol3` varchar(200) DEFAULT NULL,
  `kontrol4` varchar(200) DEFAULT NULL,
  `kontrol5` varchar(200) DEFAULT NULL,
  `kontrol6` varchar(200) DEFAULT NULL,
  `kontrol7` varchar(200) DEFAULT NULL,
  `terkait1` varchar(200) DEFAULT NULL,
  `terkait2` varchar(200) DEFAULT NULL,
  `terkait3` varchar(200) DEFAULT NULL,
  `terkait4` varchar(200) DEFAULT NULL,
  `terkait5` varchar(200) DEFAULT NULL,
  `terkait6` varchar(200) DEFAULT NULL,
  `terkait7` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kontrol`
--

INSERT INTO `kontrol` (`nomor`, `bidang`, `nama1`, `nama2`, `nama3`, `nama4`, `nama5`, `nama6`, `nama7`, `kontrol1`, `kontrol2`, `kontrol3`, `kontrol4`, `kontrol5`, `kontrol6`, `kontrol7`, `terkait1`, `terkait2`, `terkait3`, `terkait4`, `terkait5`, `terkait6`, `terkait7`) VALUES
(1, 'Bidang', '', 'PKS Seleksi Donor', '', '', '', '', '', '', '', 'UTDPKU-IKA-PEL-L2-001', '', '', '', '', '', '', '', '', 'UTDPKU-PEL-L3-003', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `no_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(200) DEFAULT NULL,
  `tmp_lahir` varchar(200) DEFAULT NULL,
  `tgl_lahir` int(11) DEFAULT NULL,
  `bln_lahir` varchar(100) DEFAULT NULL,
  `thn_lahir` int(255) DEFAULT NULL,
  `prov_lahir` varchar(200) DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `bln` varchar(100) DEFAULT NULL,
  `thn` int(255) DEFAULT NULL,
  `pendidikan` varchar(200) DEFAULT NULL,
  `jabatan` varchar(200) DEFAULT NULL,
  `pangkat` varchar(100) DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `ruang` varchar(10) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `nama_file` varchar(50) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `status_nikah` varchar(100) DEFAULT NULL,
  `tmt` varchar(50) DEFAULT NULL,
  `tgl_diajukan_kp` date DEFAULT NULL,
  `tgl_sk_kp` date DEFAULT NULL,
  `no_sk_kp` varchar(100) DEFAULT NULL,
  `gaji_lama` varchar(50) DEFAULT NULL,
  `gaji_baru` varchar(50) DEFAULT NULL,
  `status_kerja` varchar(100) DEFAULT 'Bekerja',
  `status_sk_kp` varchar(100) DEFAULT NULL,
  `tgl_diajukan_kgb` date DEFAULT NULL,
  `tgl_sk_kgb` date DEFAULT NULL,
  `no_sk_kgb` varchar(100) DEFAULT NULL,
  `status_sk_kgb` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`no_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`no_id`, `nama`, `tmp_lahir`, `tgl_lahir`, `bln_lahir`, `thn_lahir`, `prov_lahir`, `jk`, `alamat`, `tgl`, `bln`, `thn`, `pendidikan`, `jabatan`, `pangkat`, `golongan`, `ruang`, `status`, `nama_file`, `telp`, `email`, `status_nikah`, `tmt`, `tgl_diajukan_kp`, `tgl_sk_kp`, `no_sk_kp`, `gaji_lama`, `gaji_baru`, `status_kerja`, `status_sk_kp`, `tgl_diajukan_kgb`, `tgl_sk_kgb`, `no_sk_kgb`, `status_sk_kgb`) VALUES
(10, 'Yulian Liana', 'Pasir Ringgit', 6, 'November', 1979, 'Riau', 'Perempuan', '', '2000-06-10', 'Juni', 2000, 'SMAK', 'Sub. Bag. Pelayanan Donor', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(12, 'Deswani', 'Padang', 21, 'Juni', 1960, 'Sumatera Barat', 'Perempuan', '', '1990-06-01', 'Juni', 1990, 'SMA', 'Pelaksana Administrasi', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(15, 'Rahmawati Agustina', 'Bagan Siapiapi', 16, 'Agustus', 1979, 'Rohil-Riau', 'Perempuan', '', '2000-04-01', 'April', 2000, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(16, 'ii Marwida Susanti', 'Q', 24, 'Januari', 1985, 'Inhil-Riau', 'Perempuan', '', '2005-12-30', 'Desember', 2005, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(17, 'Sri Wahyuni', 'Perawang', 14, 'Juni', 1986, 'Siak-Riau', 'Perempuan', '', '2005-09-01', 'September', 2005, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(18, 'Marini Lusyana', 'Duri', 20, 'Agustus', 1987, 'Bengkalis-Riau', 'Perempuan', '', '2005-09-01', 'September', 2005, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(22, 'Nani Puspita Sari', 'Pekanbaru', 16, 'September', 1989, 'Riau', 'Perempuan', '', '2007-06-25', 'Juni', 2007, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(23, 'Nurul Soraiya', 'Banda Aceh', 27, 'Juni', 1989, 'Aceh', 'Perempuan', '', '0000-00-00', 'Juni', 2007, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Resign', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(24, 'Ririn Ayu Septiana', 'Yogyakarta', 26, 'September', 1989, 'Yogyakarta', 'Perempuan', '', '2007-06-25', 'Juni', 2007, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(25, 'Sri Nurmalis', 'Payakumbuh', 10, 'November', 1979, 'Sumatera Barat', 'Perempuan', '', '2008-02-18', 'Februari', 2008, 'Diploma I / PTTD', 'Pelaksana Teknis', 'Pelaksana II', 'B II', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(26, 'Hendri', 'Bagan Siapiapi', 1, 'Juli', 1976, 'Rohil-Riau', 'Laki-laki', '', '2007-06-26', 'Februari', 2007, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'male-icons-hi.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(27, 'Kartini', 'Sebauk', 17, 'Januari', 1983, 'Bengkalis-Riau', 'Perempuan', '', '2007-06-26', 'Juni', 2007, 'Diploma I / PTTD', 'Pelaksana Teknis', 'Pelaksana II', 'B II', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(32, 'Vifi Noviani Sari', 'Perawang', 15, 'Maret', 1990, 'Siak-Riau', 'Perempuan', '', '2008-11-24', 'November', 2008, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(33, 'Siti Azri Biani', 'Rantau Prapat', 11, 'Juli', 1990, 'Sumatera Utara', 'Perempuan', '', '2009-07-14', 'Juli', 2009, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(34, 'Dewi Rahmawati Asri', 'Riyadh', 18, 'Februari', 1992, 'Saudi Arabia', 'Perempuan', '', '2009-07-14', 'Juli', 2009, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(37, 'Mulyanti', 'Pekanbaru', 3, 'Maret', 1991, 'Riau', 'Perempuan', '', '2010-07-01', 'Juli', 2010, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(38, 'Novrianti', 'Teratak Buluh', 28, 'November', 1990, 'Kampar-Riau', 'Perempuan', '', '0000-00-00', 'Juli', 2010, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 'Resign', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(39, 'Ukri Yantika', 'Pekanbaru', 17, 'Agustus', 1991, 'Riau', 'Perempuan', '', '2010-07-01', 'Juli', 2010, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(40, 'Misbahul Jannah', 'Teratak Buluh', 31, 'Agustus', 1992, 'Kampar-Riau', 'Perempuan', '', '2010-07-01', 'Juli', 2010, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(43, 'Harisman', 'Pekanbaru', 20, 'Desember', 1983, 'Riau', 'Laki-laki', '', '2011-10-01', 'Oktober', 2011, 'SMA', 'Pelaksana Administrasi', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'male-icons-hi.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(46, 'R. Dira Arinah', 'Pulau Godang', 1, 'Oktober', 1992, 'Kuansing-Riau', 'Perempuan', '', '2012-10-29', 'Oktober', 2012, 'Diploma I / PTTD', 'Pelaksana Teknis', 'Pelaksana II', 'B II', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(47, 'Tengku Muhamad Fajrin', 'Pekanbaru', 24, 'Juni', 1993, 'Riau', 'Laki-laki', '', '2013-05-28', 'Mei', 2013, 'SMA', 'Pelaksana Administrasi', 'Pelaksana I', 'B I', '', 'Kontrak', 'male-icons-hi.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(48, 'Dara Eka Lestari', 'Pekanbaru', 16, 'Juni', 1995, 'Riau', 'Perempuan', '', '2013-07-01', 'Juli', 2013, 'SMK', 'Pelaksana Administrasi', 'Pelaksana I', 'B I', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(49, 'Fitri Andari', 'Pekanbaru', 14, 'April', 1994, 'Riau', 'Perempuan', '', '2013-07-01', 'Juli', 2013, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(50, 'Diana Puspita Sari', 'Pekanbaru', 19, 'Oktober', 1995, 'Riau', 'Perempuan', '', '2013-07-01', 'Juli', 2013, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(51, 'Diva Yunita', 'Kampar', 1, 'Juni', 1995, 'Kampar-Riau', 'Perempuan', '', '2013-07-01', 'Juli', 2013, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(52, 'Irva Junisa', 'Batu Belah', 19, 'Juni', 1995, 'Kampar-Riau', 'Perempuan', '', '2013-07-01', 'Juli', 2013, 'SMAK', 'Pelaksana Teknis', 'Pelaksana I', 'B I', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(53, 'Yeni', 'Pekanbaru', 10, 'Juli', 1970, 'Riau', 'Perempuan', '', '1990-06-01', 'Juni', 1990, 'SMP', 'Pekarya', 'Pekarya II', 'A II', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(54, 'Zaini', 'Selat Panjang', 1, 'Januari', 1959, 'Meranti-Riau', 'Laki-laki', '', '1999-10-01', 'Oktober', 1999, 'SD', 'Pekarya', 'Pekarya I', 'A I', '', 'Pegawai Tetap', 'male-icons-hi.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(55, 'Faizal Wahidin Siregar', 'Sidingkat', 1, 'Mei', 1986, 'Sumatera Utara', 'Laki-laki', '', '2009-01-14', 'Januari', 2009, 'MAN', 'Pekarya', 'Pelaksana I', 'B I', '', 'Kontrak', 'male-icons-hi.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', 'Diproses', NULL, NULL, NULL, 'Diproses'),
(56, 'Budiantoro', 'Taluk Kuantan', 5, 'September', 1971, 'Riau', 'Laki-laki', 'Jl. Jati No. 451', '2014-09-09', 'September', 2013, 'SMA', 'Pelaksana Administrasi', 'Pelaksana I', 'B I', '', 'Kontrak', 'male-icons-hi.png', '081276830371', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(57, 'Dr. Bebe Gani', 'Padang', 27, 'Juli', 1963, 'Sumatera Barat', 'Perempuan', '', '1998-09-01', NULL, NULL, 'Strata I / Kedokteran', 'Kepala UDD', 'Pembina', 'D I', '', 'Diperbantukan', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(58, 'Yayat Supriatna, SE', 'Taluk Kuantan', 29, 'April', 1970, 'Riau', 'Laki-laki', '', '1998-09-29', NULL, NULL, 'Strata I / Ekonomi', 'Sekretaris UDD', 'Penata II', 'C II', '', 'Pegawai Tetap', 'male-icons-hi.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(59, 'Dr. Dian I.K Singgih', 'Taluk Kuantan', 29, 'Januari', 1977, 'Riau', 'Perempuan', '', '2004-05-01', NULL, NULL, 'Strata I / Kedokteran', 'Bag. Pelayanan', 'Penata Muda', 'B IV', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(60, 'Ismed Kadarisman, S.Sos', 'Payakumbuh', 29, 'Mei', 1968, 'Sumatera Barat', 'Laki-laki', '', '2000-09-01', NULL, NULL, 'Strata I / Sosial', 'Sub. Bag. Umum & Logistik', 'Penata Muda', 'B IV', '', 'Pegawai Tetap', 'male-icons-hi.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(62, 'Yuniarta Siregar', 'Bukittinggi', 24, 'Juni', 1967, 'Sumatera Barat', 'Perempuan', '', '2000-06-06', NULL, NULL, 'MAN', 'Sub. Bag. Adm Keuangan', 'Pelaksana Muda', 'A V', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(63, 'Dr. Reni Oktora', 'Pekanbaru', 28, 'Oktober', 1984, 'Riau', 'Perempuan', '', '2010-10-30', NULL, NULL, 'Strata I / Kedokteran', 'Bag. Mutu', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(64, 'Dr. Kurnia Sari', 'Bandung', 20, 'Desember', 1983, 'Jawa Barat', 'Perempuan', '', '2011-06-08', NULL, NULL, 'Strata I / Kedokteran', 'Sub. Bag. PDDS', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(65, 'Indra Surianti', 'Bangko Jaya', 1, 'Januari', 1988, 'Rohil', 'Perempuan', '', '2005-09-01', NULL, NULL, 'Diploma I / TTD', 'Supervisor', 'Pelaksana I', 'B I', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(66, 'Dewi Putri', 'Rao', 6, 'Januari', 1973, 'Sumatera Barat', 'Perempuan', '', '1994-03-01', NULL, NULL, 'Diploma I / TTD', 'Supervisor', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(67, 'Elinas Martin', '', 20, 'Juli', 1969, '', 'Perempuan', '', '1994-03-01', NULL, NULL, '', '', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(68, 'Nurlian Harahap', '', 17, 'Agustus', 1978, '', 'Perempuan', '', '2001-03-01', NULL, NULL, '', '', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(69, 'Paulus Satrio Dewo, S.Kom', 'Pekanbaru', 13, 'Januari', 1989, 'Riau', 'Laki-laki', 'Jl. h. Imam Munandar No. 313', '2013-07-01', NULL, NULL, 'Strata I / Ilmu Komputer', 'Sub. Bag. SIM & Kepegawaian', '', '', '', 'Pegawai Tetap', 'male-icons-hi.png', '085290130368', 'dwdewo@gmail.com', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(70, 'Oftar Riana', 'Tanjung Pinang', 6, 'November', 1980, 'Kep. Riau', 'Perempuan', '', '2006-04-03', NULL, NULL, 'Diploma III / Far & MK', 'Pelaksana Adm', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(71, 'Sinarsih', 'Salatiga', 9, 'Desember', 1981, 'Jawa Tengah', 'Perempuan', '', '2007-02-01', NULL, NULL, 'Diploma III / Analis', 'Pelaksana Adm', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(72, 'Yuli Aryanti', 'Pekanbaru', 4, 'Juli', 1986, 'Riau', 'Perempuan', '', '2009-12-07', NULL, NULL, 'Diploma III / Akutansi', 'Pelaksana Adm', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(73, 'Rini Hidayati', 'Pekanbaru', 2, 'Juli', 1979, 'Riau', 'Perempuan', '', '2011-04-14', NULL, NULL, 'Diploma III / Komputer', 'Pelaksana Adm', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(74, 'Efrianita', 'Bagan Siapiapi', 9, 'November', 1976, 'Riau', 'Perempuan', '', '1996-09-01', NULL, NULL, 'Diploma I / TTD', 'Sub. Bag. Produksi & Distribusi', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(75, 'Maryana Br Parapat', 'Tandun', 20, 'Oktober', 1985, 'Riau', 'Perempuan', '', '2010-07-01', NULL, NULL, 'Diploma III / Perawat', 'Pelaksana Teknis', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(76, 'Rahmi Putri Yunita', 'Indrapura', 15, 'Mei', 1988, 'Sumatera Barat', 'Perempuan', '', '2011-10-01', NULL, NULL, 'Diploma III / Analis', 'Pelaksana Teknis', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(77, 'Elsa Utami', 'Pekanbaru', 7, 'April', 1990, 'Riau', 'Perempuan', '', '2011-12-09', NULL, NULL, 'Diploma III / Perawat', 'Pelaksana Teknis', '', '', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(78, 'Ririn Yelvia Lisa', 'Payakumbuh', 20, 'November', 1989, 'Sumatera Barat', 'Perempuan', '', '2012-03-30', NULL, NULL, 'Diploma III / Analis', 'Pelaksana Teknis', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(79, 'Soryi Maruli Sitorus', 'Pekanbaru', 17, 'Desember', 1987, 'Riau', 'Laki-laki', '', '2007-02-01', NULL, NULL, 'Diploma I / TTD', 'Pelaksana Teknis', '', '', '', 'Pegawai Tetap', 'male-icons-hi.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(80, 'Yasin Harudin', 'Cilacap', 0, 'Bulan', 0, 'Jawa Barat', 'Laki-laki', '', '2007-06-25', NULL, NULL, 'Diploma I / TTD', 'Pelaksana Teknis', '', '', '', 'Pegawai Tetap', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(81, 'Dr. Rona Febriani', 'Baserah', 7, 'Februari', 1988, 'Riau', 'Perempuan', '', '2015-03-01', NULL, NULL, 'Strata I / Kedokteran', 'Dokter Konseling', '', '', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(82, 'Dr. Enggariani', 'Pekanbaru', 19, 'Juli', 1983, 'Riau', 'Perempuan', 'Jl. Kayangan 2 Tangkerang Barat', '2015-03-01', NULL, NULL, 'Strata I / Kedokteran', 'Dokter Konseling', '', '', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '085278930056', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(83, 'Dr. Deasy Prashanty', 'Pekanbaru', 8, 'Desember', 1986, 'Riau', 'Perempuan', 'Jl. Bunga Harum 51 Sukajadi', '2015-03-01', NULL, NULL, 'Strata I / Kedokteran', 'Dokter Konseling', '', '', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '08196004988', '', 'Menikah', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(84, 'Dr. Fenny Tuti Hariani Sihotang', 'Bangkinang', 13, 'September', 1987, 'Riau', 'Perempuan', 'Jl. M. Ali Rasyid 16 Bangkinang', '2015-03-01', NULL, NULL, 'Strata I / Kedokteran', 'Dokter Konseling', '', '', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '08216656657', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(85, 'Muhammad Yulianto', 'Teratak Buluh', 29, 'Mei', 1996, 'Riau', 'Laki-laki', 'Teratak Buluh', '2015-03-01', NULL, NULL, 'SMAK', 'Pelaksana Teknis', '', '', '', 'Kontrak', 'male-icons-hi.png', '082386451040', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL),
(86, 'Putri Wahyu Pratiwi', 'Desa Baru', 14, 'Juni', 1996, 'Riau', 'Perempuan', 'Dusun I Sungai Sialang', '2015-03-01', NULL, NULL, 'SMAK', 'Pelaksana Teknis', '', '', '', 'Kontrak', 'IMG_E814A6-C4C9D9-EF4158-707B47-691C98-EA861B.png', '085365731995', '', 'Single', NULL, NULL, NULL, NULL, NULL, NULL, 'Bekerja', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendukung`
--

CREATE TABLE IF NOT EXISTS `pendukung` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(200) DEFAULT NULL,
  `nama1` varchar(200) DEFAULT NULL,
  `nama2` varchar(200) DEFAULT NULL,
  `tingkat` varchar(200) DEFAULT NULL,
  `kontrol` varchar(200) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `no_versi` varchar(50) DEFAULT NULL,
  `tgl_setuju` varchar(100) DEFAULT NULL,
  `tgl_pelaksanaan` varchar(100) DEFAULT NULL,
  `tgl_peninjauan` varchar(100) DEFAULT NULL,
  `pembuat` varchar(200) DEFAULT NULL,
  `pemeriksa` varchar(200) DEFAULT NULL,
  `pengesah` varchar(200) DEFAULT NULL,
  `fileku` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pks`
--

CREATE TABLE IF NOT EXISTS `pks` (
  `nomor` int(11) NOT NULL AUTO_INCREMENT,
  `bidang` varchar(200) DEFAULT NULL,
  `nama1` varchar(200) DEFAULT NULL,
  `nama2` varchar(200) DEFAULT NULL,
  `tingkat` varchar(200) DEFAULT NULL,
  `kontrol` varchar(200) DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `no_versi` varchar(50) DEFAULT NULL,
  `tgl_setuju` varchar(100) DEFAULT NULL,
  `tgl_pelaksanaan` varchar(100) DEFAULT NULL,
  `tgl_peninjauan` varchar(100) DEFAULT NULL,
  `pembuat` varchar(200) DEFAULT NULL,
  `pemeriksa` varchar(200) DEFAULT NULL,
  `pengesah` varchar(200) DEFAULT NULL,
  `fileku` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nomor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `pks`
--

INSERT INTO `pks` (`nomor`, `bidang`, `nama1`, `nama2`, `tingkat`, `kontrol`, `periode`, `no_versi`, `tgl_setuju`, `tgl_pelaksanaan`, `tgl_peninjauan`, `pembuat`, `pemeriksa`, `pengesah`, `fileku`) VALUES
(1, 'Pelayanan', 'PKS Seleksi Donor', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-001', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(2, 'Pelayanan', 'PKS Pengambilan Darah Secara Manual', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-002', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(5, 'Pelayanan', 'PKS Pengambilan Darah Secara Aferesis', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-003', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yasin Harudin', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(6, 'Pelayanan', 'PKS Konfirmasi Golongan Darah', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-004', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(7, 'Pelayanan', 'PKS Uji Saring', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-005', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(8, 'Produksi', 'PKS Pengolahan Komponen Darah', 'N/A', '2', 'UTDPKU-PKS-PROD-L2-006', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(9, 'Produksi', 'PKS Penyimpanan Darah dan Komponen Darah', 'N/A', '2', 'UTDPKU-PKS-PROD-L2-007', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(10, 'Produksi', 'PKS Uji Silang Serasi', 'N/A', '2', 'UTDPKU-PKS-PROD-L2-008', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(11, 'Produksi', 'PKS Distribusi Darah dan Komponen Darah', 'N/A', '2', 'UTDPKU-PKS-DIST-L2-009', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(12, 'Produksi', 'PKS Permintaan Darah dan Komponen Darah', 'N/A', '2', 'UTDPKU-PKS-DIST-L2-010', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Efrianita', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(13, 'Pelayanan', 'PKS Penanganan Sampel dan Darah Donor', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-011', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(14, 'Pelayanan', 'PKS Penanganan Reaksi donor', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-012', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(15, 'Pelayanan', 'PKS Konseling Pascadonasi', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-013', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', '', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(16, 'Mobile Unit', 'PKS Penilaian MU dan BU', 'N/A', '2', 'UTDPKU-PKS-MU-L2-014', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(17, 'Mobile Unit', 'PKS Pengambilan dan Penyimpanan Darah MU dan BU', 'N/A', '2', 'UTDPKU-PKS-MU-L2-015', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(18, 'Mobile Unit', 'PKS Kontrol Suhu Cool Box MU dan BU', 'N/A', '2', 'UTDPKU-PKS-MU-L2-016', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(19, 'Mobile Unit', 'PKS Transportasi Darah MU dan BU', 'N/A', '2', 'UTDPKU-PKS-MU-L2-017', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(20, 'Pelayanan', 'PKS Sterilisasi Peralatan Pengambilan Darah', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-018', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Yulian Liana', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL),
(21, 'Logistik', 'PKS Penerimaan Alat & Bahan Logistik', 'N/A', '2', 'UTDPKU-PKS-LOG-L2-019', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Ismed Kadarisman, S.Sos', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(22, 'Logistik', 'PKS Penyimpanan Alat & Bahan Logistik', 'N/A', '2', 'UTDPKU-PKS-LOG-L2-020', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Ismed Kadarisman, S.Sos', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(23, 'Logistik', 'PKS Pengeluaran Alat & Bahan Logistik', 'N/A', '2', 'UTDPKU-PKS-LOG-L2-021', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Ismed Kadarisman, S.Sos', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(24, 'Sistem Kualitas', 'PKS Audit Internal', 'N/A', '2', 'UTDPKU-PKS-SK-L2-022', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Reni Oktora', '', 'Dr. Bebe Gani', NULL),
(25, 'Sistem Kualitas', 'PKS Mencuci Tangan', 'N/A', '2', 'UTDPKU-PKS-SK-L2-023', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Reni Oktora', '', 'Dr. Bebe Gani', NULL),
(26, 'Sistem Kualitas', 'PKS Mencuci Lengan', 'N/A', '2', 'UTDPKU-PKS-SK-L2-024', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Reni Oktora', '', 'Dr. Bebe Gani', NULL),
(27, 'Sistem Kualitas', 'PKS Memakai & Melepas Sarung Tangan', 'N/A', '2', 'UTDPKU-PKS-SK-L2-025', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Dr. Reni Oktora', '', 'Dr. Bebe Gani', NULL),
(28, 'Kepegawaian', 'PKS Rekruitmen Pegawai', 'N/A', '2', 'UTDPKU-PKS-PEG-L2-026', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(29, 'Kepegawaian', 'PKS Pengangkatan & Pemberhentian Pegawai', 'N/A', '2', 'UTDPKU-PKS-PEG-L2-027', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(30, 'Kepegawaian', 'PKS Kepangkatan Pegawai', 'N/A', '2', 'UTDPKU-PKS-PEG-L2-028', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(31, 'Kepegawaian', 'PKS Penilaian Pekerjaan Pegawai', 'N/A', '2', 'UTDPKU-PKS-PEG-L2-029', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(32, 'Kepegawaian', 'PKS Penghargaan & Sanksi Pegawai', 'N/A', '2', 'UTDPKU-PKS-PEG-L2-030', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(33, 'Kepegawaian', 'PKS Administrasi Kepegawaian', 'N/A', '2', 'UTDPKU-PKS-PEG-L2-031', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(34, 'Sistem Informasi', 'PKS SIM', 'N/A', '2', 'UTDPKU-PKS-SIM-L2-032', 24, '001', '16 Mar 2015', '01 Apr 2015', '01 Apr 2016', 'Paulus Satrio Dewo, S.Kom', 'Yayat Supriatna, SE', 'Dr. Bebe Gani', NULL),
(35, 'Sistem Kualitas', 'PKS Penanganan & Pemusnahan Limbah ', 'N/A', '2', 'UTDPKU-PKS-SK-L2-033', 24, '001', '12 Jun 2015', '14 Jun 2015', '14 Jun 2016', 'Dr. Reni Oktora', 'Dr. Reni Oktora', 'Dr. Bebe Gani', NULL),
(36, 'Pelayanan', 'PKS Pengaturan Stok Darah dan Komponen Darah', 'N/A', '2', 'UTDPKU-PKS-PEL-L2-034', 24, '001', '07 Jul 2015', '07 Jul 2015', '07 Jul 2016', 'Dr. Reni Oktora', '', 'Dr. Bebe Gani', NULL),
(37, 'Mobile Unit', 'PKS Input Data Donor MU/ BU', 'N/A', '2', 'UTDPKU-PKS-MU-L2-035', 24, '001', '31 Aug 2015', '01 Sep 2015', '01 Sep 2016', 'Dr. Kurnia Sari', 'Dr. Dian I.K Singgih', 'Dr. Bebe Gani', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
