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
-- Table structure for table `serahterima`
--

DROP TABLE IF EXISTS `serahterima`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serahterima` (
  `hst_id` int(11) NOT NULL AUTO_INCREMENT,
  `hst_notrans` varchar(15) NOT NULL,
  `hst_bagpengirim` varchar(50) NOT NULL,
  `hst_bagpenerima` varchar(50) NOT NULL,
  `hst_tgl` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `hst_asal` varchar(100) NOT NULL,
  `hst_jenis_st` varchar(50) NOT NULL,
  `hst_user` varchar(15) NOT NULL,
  `hst_pengirim` varchar(15) NOT NULL,
  `hst_penerima` varchar(15) NOT NULL COMMENT 'Penerima Darah',
  `hst_penerima2` varchar(15) NOT NULL,
  `hst_tgl_terima` datetime DEFAULT NULL COMMENT 'Waktu Terima Komponen',
  `hst_kode_alat` varchar(15) NOT NULL,
  `hst_suhuterima` varchar(4) NOT NULL,
  `hst_kondisiumum` varchar(50) NOT NULL,
  `hst_peruntukan` varchar(50) NOT NULL,
  `hst_modul` varchar(50) NOT NULL,
  `hst_shift_pengirim` varchar(11) NOT NULL,
  `hst_shift_penerima` varchar(11) NOT NULL COMMENT 'Shift Komponen',
  PRIMARY KEY (`hst_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Header Serah Teriima Kantong dan Sample';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serahterima`
--

LOCK TABLES `serahterima` WRITE;
/*!40000 ALTER TABLE `serahterima` DISABLE KEYS */;
INSERT INTO `serahterima` VALUES (1,'ST070820-0001','AFTAP','KOMPONEN','2020-08-07 02:58:07','DALAM GEDUNG','Kantong dan Sample Aftap','irawan','Al','Risk','',NULL,'005','22','SESUAI','Pengolahan Darah, Pemeriksaan IMLTD & KGD','KARANTINA','',''),(2,'ST070820-0002','AFTAP','KOMPONEN','2020-08-07 02:59:55','DALAM GEDUNG','Kantong dan Sample Aftap','irawan','Al','Risk','',NULL,'005','22','SESUAI','Pengolahan Darah, Pemeriksaan IMLTD & KGD','KARANTINA','',''),(3,'ST201020-0001','AFTAP','KOMPONEN, IMLTD & KGD','2020-10-20 14:15:44','DALAM GEDUNG','Kantong dan Sample Aftap','irawan','Al','Risk','',NULL,'INV91','22','SESUAI','Pengolahan Darah, Pemeriksaan IMLTD & KGD','KARANTINA','3',''),(4,'ST211020-0001','AFTAP','KOMPONEN, IMLTD & KGD','2020-10-21 15:21:22','DALAM GEDUNG','Kantong dan Sample Aftap','irawan','dana','Risk','',NULL,'INV92','22','SESUAI','Pengolahan Darah, Pemeriksaan IMLTD & KGD','KARANTINA','3',''),(5,'ST211020-0002','AFTAP','KOMPONEN, IMLTD & KGD','2020-10-21 15:24:02','MOBILE UNIT DALAM GEDUNG','Kantong dan Sample Aftap','irawan','Al','Risk','',NULL,'ALT77','21.','SESUAI','Pengolahan Darah, Pemeriksaan IMLTD & KGD','KARANTINA','3','');
/*!40000 ALTER TABLE `serahterima` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-23  0:38:16
