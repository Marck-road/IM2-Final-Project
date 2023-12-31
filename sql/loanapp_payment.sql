-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: loanapp
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `Payment_ID` int NOT NULL AUTO_INCREMENT,
  `LBPeriod_ID` int DEFAULT NULL,
  `Amount_Paid` float DEFAULT NULL,
  `Screenshot` blob,
  `Payment_Channel` varchar(255) DEFAULT NULL,
  `Status` enum('Success','Failed','Pending') DEFAULT 'Pending',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Payment_ID`),
  KEY `LBPeriod_ID_idx` (`LBPeriod_ID`),
  CONSTRAINT `LBPeriod_ID` FOREIGN KEY (`LBPeriod_ID`) REFERENCES `loanbilling_period` (`LBPeriod_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,67,50000,_binary 'PXL_20230813_074035280.MP.jpg','BDO','Success','2023-12-09 05:58:36'),(2,68,10000000,'','sdf','Failed','2023-12-09 05:58:58'),(3,66,80000,'','adf','Success','2023-12-09 06:00:46'),(4,70,2044.67,_binary 'LoanDaddy (1).png','G Cash','Success','2023-12-09 06:54:22'),(5,71,24000,_binary '20230701_180616.jpg','BDO','Success','2023-12-09 06:56:56'),(6,72,17716,_binary 'LoanDaddy (1).png','BDO','Success','2023-12-09 06:59:47'),(7,68,3067,_binary 'LoanDaddy (1).png','BDO','Pending','2023-12-10 04:26:19'),(8,74,6134,_binary 'LoanDaddyLogo.png','BDO','Success','2023-12-16 16:59:52');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-02 11:58:50
