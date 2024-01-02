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
-- Table structure for table `lender_payment_scheds`
--

DROP TABLE IF EXISTS `lender_payment_scheds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lender_payment_scheds` (
  `LenderPS_ID` int NOT NULL AUTO_INCREMENT,
  `Schedule_ID` int DEFAULT NULL,
  `Lender_ID` int DEFAULT NULL,
  PRIMARY KEY (`LenderPS_ID`),
  KEY `Schedule_ID_idx` (`Schedule_ID`),
  KEY `Lender_ID_idx` (`Lender_ID`),
  CONSTRAINT `Lender_ID` FOREIGN KEY (`Lender_ID`) REFERENCES `lender` (`Lender_ID`),
  CONSTRAINT `Schedule_ID` FOREIGN KEY (`Schedule_ID`) REFERENCES `payment_sched` (`Schedule_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lender_payment_scheds`
--

LOCK TABLES `lender_payment_scheds` WRITE;
/*!40000 ALTER TABLE `lender_payment_scheds` DISABLE KEYS */;
INSERT INTO `lender_payment_scheds` VALUES (1,1,1),(2,2,1),(3,3,1),(4,4,1),(5,2,2),(6,3,2),(7,1,3),(8,2,3),(9,3,3),(10,3,4),(11,2,5),(12,3,5),(13,2,6),(14,3,6),(15,2,7),(16,4,6),(17,1,8),(18,2,8),(19,3,8),(20,4,8),(21,3,7),(27,3,28);
/*!40000 ALTER TABLE `lender_payment_scheds` ENABLE KEYS */;
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
