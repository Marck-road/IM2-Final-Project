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
-- Table structure for table `lender`
--

DROP TABLE IF EXISTS `lender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lender` (
  `Lender_ID` int NOT NULL AUTO_INCREMENT,
  `Lender_Name` varchar(255) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `Contact_Number` varchar(15) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MinSalary_Required` float NOT NULL,
  `MinLoan_Amt` float NOT NULL,
  `MaxLoan_Amt` float NOT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Verified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Lender_ID`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `Lender_Name_UNIQUE` (`Lender_Name`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lender`
--

LOCK TABLES `lender` WRITE;
/*!40000 ALTER TABLE `lender` DISABLE KEYS */;
INSERT INTO `lender` VALUES (1,'BMO Lender Company','81dc9bdb52d04dc20036dbd8313ed055','Multi-purpose loans up to ₱100,000, non-collateral!','+639290106240','bmobusiness@gmail.com',10000,5000,100000,'2023-11-21 09:42:32','2023-12-08 19:25:48'),(2,'NuLife','81dc9bdb52d04dc20036dbd8313ed055','Multi-purpose loan up to ₱1 Million!','+639773135234','nulifebusiness@gmail.com',40000,60000,1000000,'2023-12-03 10:05:48','2023-12-08 19:40:49'),(3,'Tonik Bank','81dc9bdb52d04dc20036dbd8313ed055','Get a Tonik Bank Flex Loan for as low as 1.7% monthly add-on interest rate for a maximum term of 24 months.!','+639125275123','tonikbank@gmail.com',30000,10000,1000000,'2023-12-03 10:05:48','2023-12-08 19:40:52'),(4,'Sorinbo Loaning Company','81dc9bdb52d04dc20036dbd8313ed055','Personal loans up to ₱3 Million!','+639773135234','sorinbobusiness@gmail.com',10000,50000,3000000,'2023-12-03 10:05:48','2023-12-08 19:40:54'),(5,'Mezzo Star','81dc9bdb52d04dc20036dbd8313ed055','Helping you to be a star!','+633214575124','mezzostar@gmail.com',10000,5000,100000,'2023-12-03 10:05:48','2023-12-08 19:40:56'),(6,'CBTL Financer','81dc9bdb52d04dc20036dbd8313ed055','Multi-purpose loan up to ₱500,000!','+638547412364','cbtlfinancer@gmail.com',30000,1000,500000,'2023-12-03 10:05:48','2023-12-08 19:40:58'),(7,'Ez Life','81dc9bdb52d04dc20036dbd8313ed055','Happy Life, Ez life!','+636942069784','ezlifebusiness@gmail.com',15000,10000,100000,'2023-12-03 10:05:48','2023-12-08 19:41:05'),(8,'Shell Chaching Inc.','81dc9bdb52d04dc20036dbd8313ed055','Personal loans for as low as ₱20,000!','+635478125658','shellchachiing@gmail.com',25000,20000,500000,'2023-12-03 10:05:48','2023-12-08 19:41:07'),(28,'Raining in Talamban','81dc9bdb52d04dc20036dbd8313ed055','Baha kaayu aria','09290106249','rainingintalamban@gmail.com',10000,1000,100000,'2023-12-09 06:23:26',NULL);
/*!40000 ALTER TABLE `lender` ENABLE KEYS */;
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
