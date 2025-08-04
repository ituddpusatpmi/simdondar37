-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: pmi
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `serahterima_detail_tmp`
--

DROP TABLE IF EXISTS `serahterima_detail_tmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serahterima_detail_tmp` (
  `dst_id` int(11) NOT NULL AUTO_INCREMENT,
  `dst_asal` varchar(50) NOT NULL,
  `dst_no_aftap` varchar(20) NOT NULL COMMENT 'No transaksi donor',
  `dst_tglaftap` datetime NOT NULL COMMENT 'Tanggal Aftap',
  `dst_kodealat` varchar(15) NOT NULL,
  `dst_suhu` varchar(3) NOT NULL,
  `dst_keadaan` varchar(50) NOT NULL,
  `dst_notrans` varchar(15) NOT NULL,
  `dst_nokantong` varchar(30) NOT NULL,
  `dst_statusktg` tinyint(4) NOT NULL,
  `dst_old_position` int(11) NOT NULL,
  `dst_sahktg` varchar(1) NOT NULL,
  `dst_merk` varchar(20) NOT NULL,
  `dst_golda` varchar(2) NOT NULL,
  `dst_rh` varchar(1) NOT NULL,
  `dst_kodedonor` varchar(30) NOT NULL,
  `dst_berat` varchar(7) NOT NULL,
  `dst_volumektg` varchar(4) NOT NULL,
  `dst_jenisktg` varchar(2) NOT NULL,
  `dst_sample` varchar(10) NOT NULL,
  `dst_sah` int(11) NOT NULL DEFAULT '0',
  `dst_modul` varchar(50) NOT NULL,
  `dst_user` varchar(50) NOT NULL,
  `dst_dsdp` varchar(2) NOT NULL,
  `dst_lamabaru` varchar(2) NOT NULL,
  `dst_umur` int(11) NOT NULL,
  `dst_lama_aftap` varchar(19) NOT NULL,
  `dst_statuspengambilan` int(11) NOT NULL,
  `dst_kel` varchar(1) NOT NULL,
  `dst_ptgaftap` varchar(15) NOT NULL COMMENT 'Kode Petugas Aftap',
  `dst_volambil` varchar(5) NOT NULL COMMENT 'Vol Pengambilan',
  `dst_shift_pengirim` varchar(10) NOT NULL,
  `dst_shift_penerima` varchar(10) NOT NULL,
  PRIMARY KEY (`dst_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Detail serah terima kantong dan sample';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serahterima_detail_tmp`
--

LOCK TABLES `serahterima_detail_tmp` WRITE;
/*!40000 ALTER TABLE `serahterima_detail_tmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `serahterima_detail_tmp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-23  0:38:40
