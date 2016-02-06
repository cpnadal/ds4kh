-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (armv7l)
--
-- Host: localhost    Database: signage
-- ------------------------------------------------------
-- Server version	5.5.46-0+deb7u1

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
-- Table structure for table `langue`
--

DROP TABLE IF EXISTS `langue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `langue` (
  `langue_id` int(11) NOT NULL AUTO_INCREMENT,
  `langue_nom` text CHARACTER SET latin1 NOT NULL,
  `langue_texte_annuel` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `langue_cantique` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `langue_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`langue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `langue`
--

LOCK TABLES `langue` WRITE;
/*!40000 ALTER TABLE `langue` DISABLE KEYS */;
INSERT INTO `langue` VALUES (1,'Français','<p style=\"text-align: center;\"><span style=\"font-size: 120pt;\">« Que votre amour dfraternel demeure »</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 120pt;\">(Hébreux 13:1)</span></p>','Cantique',1),(2,'Portugais','<p style=\"text-align: center;\"><span style=\"font-size: 120pt;\">« Que o seu amor fraternal continue »</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 120pt;\">(Hebreus 13:1)</span></p>','Cântico',1),(3,'Russe','<p style=\"text-align: center;\"><span style=\"font-size: 108pt;\">« Братолюбие между вами да</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 108pt;\">пребывает »</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 108pt;\"> (Евреям 13:1)</span></p>','Песня',1),(4,'Malgache','<p><span style=\"font-size: 108pt;\"><span style=\"text-align: center;\">«</span><span style=\"text-align: center;\"> </span>Aoka haharitra ny fitiavanareo ny rahalahy<span style=\"text-align: center;\"> </span><span style=\"text-align: center;\">»</span></span></p>\r\n<p><span style=\"font-size: 108pt;\"><span style=\"text-align: center;\">(H</span>ebreo 13:1)</span></p>','Hira',1),(5,'Vietnamien','<p><span style=\"font-size: 108pt;\"><span style=\"text-align: center;\">«</span><span style=\"text-align: center;\"> </span>Hãy tiếp tục yêu thương nhau như anh em<span style=\"text-align: center;\"> </span><span style=\"text-align: center;\">»</span></span></p>\r\n<p><span style=\"font-size: 108pt;\"><span style=\"text-align: center;\">(</span>Hê-bơ-rơ 13:1)</span></p>','Bài hát',1),(6,'Kurde','<p style=\"text-align: center;\"><span style=\"font-size: 96pt;\">«Бьра һʹьзкьрьна бьрати тʹьме нав ԝәда һәбә» (Ибрани 13:1, ДТʹ)</span></p>','КʹЬЛАМA',1),(7,'Georgien','<p style=\"text-align: center;\"><span style=\"font-size: 108pt;\">„ძმათმოყვარეობა</span></p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 108pt;\">შეინარჩუნეთ“</span></p>\r\n<p style=\"text-align: center;\"> </p>\r\n<p style=\"text-align: center;\"><span style=\"font-size: 96pt;\">(ებრაელები 13:1)</span></p>','სიმღერა',1);
/*!40000 ALTER TABLE `langue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','ce7c0dcb707083a5953857be0416db44');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-03 19:18:06
