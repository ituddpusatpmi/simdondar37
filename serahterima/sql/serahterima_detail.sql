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
-- Table structure for table `serahterima_detail`
--

DROP TABLE IF EXISTS `serahterima_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serahterima_detail` (
  `dst_iddetail` int(11) NOT NULL AUTO_INCREMENT,
  `dst_no_aftap` varchar(20) NOT NULL COMMENT 'No transaksi donor',
  `dst_tglaftap` datetime NOT NULL COMMENT 'Tanggal Aftap',
  `dst_notrans` varchar(15) NOT NULL,
  `dst_nokantong` varchar(30) NOT NULL,
  `dst_statusktg` tinyint(4) NOT NULL,
  `st_statusktg_new` tinyint(4) NOT NULL,
  `dst_old_position` int(11) NOT NULL,
  `dst_new_position` int(11) NOT NULL,
  `dst_sahktg` varchar(1) NOT NULL,
  `dst_sahktg_new` varchar(1) NOT NULL,
  `dst_merk` varchar(20) NOT NULL,
  `dst_golda` varchar(2) NOT NULL,
  `dst_rh` varchar(1) NOT NULL,
  `dst_kodedonor` varchar(30) NOT NULL,
  `dst_berat` varchar(7) NOT NULL,
  `dst_volumektg` varchar(4) NOT NULL,
  `dst_jenisktg` varchar(2) NOT NULL,
  `dst_sample` varchar(10) NOT NULL,
  `dst_sah` int(11) NOT NULL DEFAULT '0',
  `dst_dsdp` varchar(2) NOT NULL,
  `dst_lamabaru` varchar(2) NOT NULL,
  `dst_umur` int(11) NOT NULL,
  `dst_lama_aftap` varchar(19) NOT NULL,
  `dst_statuspengambilan` int(11) NOT NULL,
  `dst_kel` varchar(1) NOT NULL,
  `dst_ptgaftap` varchar(15) NOT NULL COMMENT 'Kode Petugas Aftap',
  `dst_volambil` varchar(5) NOT NULL COMMENT 'Vol Pengambilan',
  `dst_receive1` varchar(15) DEFAULT NULL COMMENT 'Penerima Darah',
  `dst_stat_receive1` int(1) NOT NULL DEFAULT '0' COMMENT '0=Belum, 1=Sudah, 2=Tdk Sesuai',
  `dst_date_receive1` datetime DEFAULT NULL COMMENT 'Waktu Terima Darah',
  `dst_shift_receive1` varchar(11) NOT NULL COMMENT 'Shift Terima Darah',
  `dst_receive2` varchar(15) DEFAULT NULL COMMENT 'Penerima Sample IMLTD',
  `dst_stat_receive2` int(1) NOT NULL DEFAULT '0' COMMENT '0=Belum, 1=Sudah, 2=Tdk Sesuai',
  `dst_date_receive2` datetime DEFAULT NULL COMMENT 'Waktu Terima Sample IMLTD',
  `dst_shift_receive2` varchar(11) NOT NULL COMMENT 'Shift Terima Sample IMLTD',
  `dst_receive3` varchar(15) DEFAULT NULL COMMENT 'Penerima Sample KGD',
  `dst_stat_receive3` int(1) NOT NULL DEFAULT '0' COMMENT '0=Belum, 1=Sudah, 2=Tdk Sesuai',
  `dst_date_receive3` datetime DEFAULT NULL COMMENT 'Waktu Terima Sample KGD',
  `dst_shift_receive3` varchar(11) NOT NULL COMMENT 'Shift Terima Sample KGD',
  PRIMARY KEY (`dst_iddetail`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Detail serah terima kantong dan sample';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serahterima_detail`
--

LOCK TABLES `serahterima_detail` WRITE;
/*!40000 ALTER TABLE `serahterima_detail` DISABLE KEYS */;
INSERT INTO `serahterima_detail` VALUES (1,'','0000-00-00 00:00:00','ST070820-0001','S2238044A',0,1,0,1,'','1','','','','','','','','1',1,'','',0,'',0,'','','',NULL,0,NULL,'',NULL,0,NULL,'',NULL,0,NULL,''),(2,'','0000-00-00 00:00:00','ST070820-0002','S2238044A',0,1,0,1,'','1','','','','','','','','1',1,'','',0,'',0,'','','',NULL,0,NULL,'',NULL,0,NULL,'',NULL,0,NULL,''),(3,'DG201020-3509-0001','2020-10-20 19:38:08','ST201020-0001','S20102001A',1,1,0,1,'','1','KARMI','O','+','3509DGADI000083','','350','3','0',1,'0','0',33,'7',0,'0','Al','2','Risk',1,'2020-10-22 20:56:56','3',NULL,0,NULL,'',NULL,0,NULL,''),(4,'DG201020-3509-0002','2020-10-20 19:38:54','ST201020-0001','S20102002A',1,1,0,1,'','1','KARMI','A','+','3509DGILI000001','','350','3','0',1,'0','1',38,'7',0,'0','Al','2','irawan',1,'2020-10-23 00:16:15','3',NULL,0,NULL,'',NULL,0,NULL,''),(5,'DG201020-3509-0003','2020-10-20 19:39:39','ST211020-0001','S20102003A',1,1,0,1,'','1','KARMI','O','+','3509DGADI000005','','350','3','1',1,'0','1',55,'7',0,'0','yuli','2','irawan',2,'2020-10-22 23:56:12','3',NULL,0,NULL,'',NULL,0,NULL,''),(6,'DG201020-3509-0004','2020-10-20 19:40:22','ST211020-0002','S20102004A',1,1,0,1,'','1','KARMI','B','+','3509DGBIM000001','','350','3','1',1,'0','1',35,'38',0,'0','yuli','2',NULL,0,NULL,'',NULL,0,NULL,'',NULL,0,NULL,'');
/*!40000 ALTER TABLE `serahterima_detail` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-23  0:38:28
