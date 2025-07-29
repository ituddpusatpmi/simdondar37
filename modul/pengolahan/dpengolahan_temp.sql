-- MySQL dump 10.13  Distrib 5.7.39, for osx10.12 (x86_64)
--
-- Host: localhost    Database: pmi
-- ------------------------------------------------------
-- Server version	5.7.39

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
-- Table structure for table `dpengolahan_temp`
--

DROP TABLE IF EXISTS `dpengolahan_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dpengolahan_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noTrans` varchar(25) DEFAULT NULL,
  `noKantong` varchar(25) DEFAULT NULL,
  `KantongAsal` varchar(25) DEFAULT NULL,
  `Produk` varchar(75) DEFAULT NULL,
  `petugas` varchar(30) DEFAULT NULL,
  `tgl` datetime NOT NULL,
  `tglAftap` datetime DEFAULT NULL,
  `aPutar` varchar(100) DEFAULT NULL,
  `aPisah` varchar(100) DEFAULT NULL,
  `pcepat` varchar(5) DEFAULT NULL,
  `psuhu` int(4) DEFAULT NULL,
  `pwaktu` int(11) DEFAULT NULL,
  `pisah` varchar(5) NOT NULL DEFAULT '0',
  `metode` char(1) DEFAULT NULL COMMENT '1=biasa, 2=pooled, 3=split',
  `noseri` varchar(50) DEFAULT NULL,
  `goldarah` varchar(3) DEFAULT NULL,
  `rhesus` varchar(2) DEFAULT NULL,
  `jenis` char(1) NOT NULL,
  `volume` varchar(11) DEFAULT NULL,
  `ed_produk` datetime DEFAULT NULL,
  `up_data` int(11) NOT NULL DEFAULT '0' COMMENT '0:Blm Up, 1 Sudah Up, 2:Diedit dan perlu Up',
  `insert_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `shift` char(1) DEFAULT NULL,
  `mulaiPutar` time DEFAULT NULL,
  `selesaiPutar` time DEFAULT NULL,
  `mulaiPisah` time DEFAULT NULL,
  `selesaiPisah` time DEFAULT NULL,
  `mulai` time DEFAULT NULL,
  `selesai` time DEFAULT NULL,
  `verifikator` varchar(50) DEFAULT NULL,
  `bstatus` char(1) DEFAULT NULL COMMENT '0:Tidak, 1:Iya',
  `bsuhu` varchar(3) DEFAULT NULL,
  `musnah` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `noKantong` (`noKantong`) USING BTREE,
  KEY `goldarah` (`goldarah`),
  KEY `noTrans` (`noTrans`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dpengolahan_temp`
--

LOCK TABLES `dpengolahan_temp` WRITE;
/*!40000 ALTER TABLE `dpengolahan_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `dpengolahan_temp` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-23 13:42:51
