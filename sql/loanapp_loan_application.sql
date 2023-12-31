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
-- Table structure for table `loan_application`
--

DROP TABLE IF EXISTS `loan_application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loan_application` (
  `LoanApp_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int NOT NULL,
  `Lender_ID` int NOT NULL,
  `Schedule_ID` int NOT NULL,
  `Loan_Amt` float NOT NULL,
  `Tenure_ID` int NOT NULL,
  `Status` enum('Approved','Denied','Pending') DEFAULT 'Pending',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`LoanApp_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Lender_ID` (`Lender_ID`),
  KEY `Schedule_ID` (`Schedule_ID`),
  KEY `Tenure_ID` (`Tenure_ID`),
  CONSTRAINT `loan_application_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`),
  CONSTRAINT `loan_application_ibfk_2` FOREIGN KEY (`Lender_ID`) REFERENCES `lender` (`Lender_ID`),
  CONSTRAINT `loan_application_ibfk_3` FOREIGN KEY (`Schedule_ID`) REFERENCES `payment_sched` (`Schedule_ID`),
  CONSTRAINT `loan_application_ibfk_4` FOREIGN KEY (`Tenure_ID`) REFERENCES `tenure` (`Tenure_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_application`
--

LOCK TABLES `loan_application` WRITE;
/*!40000 ALTER TABLE `loan_application` DISABLE KEYS */;
INSERT INTO `loan_application` VALUES (57,3,1,3,60000,4,'Denied','2023-12-09 05:56:19','2023-12-09 05:56:19'),(58,3,1,3,60000,4,'Approved','2023-12-09 05:56:19','2023-12-09 05:56:19'),(59,3,1,2,20000,4,'Approved','2023-12-09 05:56:35','2023-12-09 05:56:35'),(60,3,1,2,60000,3,'Approved','2023-12-09 05:56:54','2023-12-09 05:56:54'),(61,4,1,3,20000,4,'Approved','2023-12-09 06:39:41','2023-12-09 06:39:41'),(62,3,1,1,17200,1,'Approved','2023-12-09 06:58:26','2023-12-09 06:58:26'),(63,4,1,3,100000,4,'Approved','2023-12-10 04:27:15','2023-12-10 04:27:15'),(64,3,1,3,60000,4,'Approved','2023-12-16 16:56:29','2023-12-16 16:56:29');
/*!40000 ALTER TABLE `loan_application` ENABLE KEYS */;
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
