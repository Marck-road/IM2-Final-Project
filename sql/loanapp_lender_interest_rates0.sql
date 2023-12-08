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
-- Table structure for table `lender_interest_rates`
--

DROP TABLE IF EXISTS `lender_interest_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lender_interest_rates` (
  `LenderIR_ID` int NOT NULL AUTO_INCREMENT,
  `Tenure_ID` int NOT NULL,
  `Interest_Rate` float NOT NULL,
  `Lender_ID` int DEFAULT NULL,
  PRIMARY KEY (`LenderIR_ID`),
  KEY `Tenure_ID` (`Tenure_ID`),
  KEY `Lender_ID` (`Lender_ID`),
  CONSTRAINT `lender_interest_rates_ibfk_1` FOREIGN KEY (`Tenure_ID`) REFERENCES `tenure` (`Tenure_ID`),
  CONSTRAINT `lender_interest_rates_ibfk_2` FOREIGN KEY (`Lender_ID`) REFERENCES `lender` (`Lender_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lender_interest_rates`
--

LOCK TABLES `lender_interest_rates` WRITE;
/*!40000 ALTER TABLE `lender_interest_rates` DISABLE KEYS */;
INSERT INTO `lender_interest_rates` VALUES (1,1,0.03,1),(2,2,0.06,1),(3,3,0.12,1),(4,4,0.2268,1),(5,5,0.45,1),(6,1,0.02,2),(7,3,0.21,2),(8,4,0.3594,2),(9,3,0.008,3),(10,4,0.2268,3),(11,5,0.4536,3),(12,1,0.018,4),(13,4,0.269,4),(14,1,0.0175,5),(15,4,0.21,5),(16,1,0.0171,6),(17,4,0.2052,6),(18,1,0.017,7),(19,2,0.05,7),(20,3,0.09,7),(21,4,0.1668,7),(22,1,0.028,8),(23,3,0.0832,8),(24,4,0.1464,8),(25,5,0.3,8);
/*!40000 ALTER TABLE `lender_interest_rates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-08 10:39:21
