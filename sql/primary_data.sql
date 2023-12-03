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
  `Description` varchar(255) NOT NULL,
  `Contact_Number` varchar(15) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MinSalary_Required` float NOT NULL,
  `Max_Tenure` enum('1 Month','3 Months','6 Months','1 Year','2 Years') NOT NULL,
  `MinLoan_Amt` float NOT NULL,
  `MaxLoan_Amt` float NOT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Verified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`Lender_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lender`
--

LOCK TABLES `lender` WRITE;
/*!40000 ALTER TABLE `lender` DISABLE KEYS */;
INSERT INTO `lender` VALUES (1,'BMO Lender Company','Multi-purpose loans up to ₱100,000, non-collateral!','+639290106240','bmobusiness@gmail.com',10000,'1 Year',5000,100000,'2023-11-21 09:42:32',NULL),(2,'NuLife','Multi-purpose loan up to ₱1 Million!','+639773135234','nulifebusiness@gmail.com',40000,'1 Year',100000,1000000,'2023-12-03 10:05:48',NULL),(3,'Tonik Bank','Get a Tonik Bank Flex Loan for as low as 1.7% monthly add-on interest rate for a maximum term of 24 months.!','+639125275123','tonikbank@gmail.com',30000,'2 Years',10000,1000000,'2023-12-03 10:05:48',NULL),(4,'Sorinbo Loaning Company','Personal loans up to ₱3 Million!','+639773135234','sorinbobusiness@gmail.com',10000,'1 Year',50000,3000000,'2023-12-03 10:05:48',NULL),(5,'Mezzo Star','Helping you to be a star!','+633214575124','mezzostar@gmail.com',10000,'1 Year',5000,100000,'2023-12-03 10:05:48',NULL),(6,'CBTL Financer','Multi-purpose loan up to ₱500,000!','+638547412364','cbtlfinancer@gmail.com',30000,'1 Year',1000,500000,'2023-12-03 10:05:48',NULL),(7,'Ez Life','Happy Life, Ez life!','+636942069784','ezlifebusiness@gmail.com',15000,'1 Year',10000,100000,'2023-12-03 10:05:48',NULL),(8,'Shell Chaching Inc.','Personal loans for as low as ₱20,000!','+635478125658','shellchachiing@gmail.com',25000,'1 Year',20000,500000,'2023-12-03 10:05:48',NULL);
/*!40000 ALTER TABLE `lender` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lender_interest_rates`
--

LOCK TABLES `lender_interest_rates` WRITE;
/*!40000 ALTER TABLE `lender_interest_rates` DISABLE KEYS */;
INSERT INTO `lender_interest_rates` VALUES (1,1,0.03,1),(2,2,0.06,1),(3,3,0.12,1),(4,4,0.2268,1),(5,5,0.45,1),(6,1,0.02,2),(7,3,0.21,2),(8,4,0.3594,2),(9,3,0.008,3),(10,4,0.2268,3),(11,5,0.4536,3),(12,1,0.018,4),(13,4,0.269,4),(14,1,0.21,5),(15,4,0.21,5),(16,1,0.0171,6),(17,4,0.2052,6),(18,1,0.017,7),(19,2,0.05,7),(20,3,0.09,7),(21,4,0.1668,7),(22,1,0.14,5),(23,3,0.0832,8),(24,4,0.1464,8),(25,5,0.3,8);
/*!40000 ALTER TABLE `lender_interest_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loan`
--

DROP TABLE IF EXISTS `loan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loan` (
  `Loan_ID` int NOT NULL AUTO_INCREMENT,
  `LoanApp_ID` int NOT NULL,
  `Amount_Payable` float DEFAULT NULL,
  `Next_Payment_Date` date DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Loan_ID`),
  KEY `LoanApp_ID` (`LoanApp_ID`),
  CONSTRAINT `loan_ibfk_1` FOREIGN KEY (`LoanApp_ID`) REFERENCES `loan_application` (`LoanApp_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan`
--

LOCK TABLES `loan` WRITE;
/*!40000 ALTER TABLE `loan` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan` ENABLE KEYS */;
UNLOCK TABLES;

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
  `Status` enum('Accepted','Denied','Pending') DEFAULT 'Pending',
  PRIMARY KEY (`LoanApp_ID`),
  KEY `User_ID` (`User_ID`),
  KEY `Lender_ID` (`Lender_ID`),
  KEY `Schedule_ID` (`Schedule_ID`),
  KEY `Tenure_ID` (`Tenure_ID`),
  CONSTRAINT `loan_application_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`),
  CONSTRAINT `loan_application_ibfk_2` FOREIGN KEY (`Lender_ID`) REFERENCES `lender` (`Lender_ID`),
  CONSTRAINT `loan_application_ibfk_3` FOREIGN KEY (`Schedule_ID`) REFERENCES `payment_sched` (`Schedule_ID`),
  CONSTRAINT `loan_application_ibfk_4` FOREIGN KEY (`Tenure_ID`) REFERENCES `tenure` (`Tenure_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loan_application`
--

LOCK TABLES `loan_application` WRITE;
/*!40000 ALTER TABLE `loan_application` DISABLE KEYS */;
/*!40000 ALTER TABLE `loan_application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `Notif_ID` int NOT NULL AUTO_INCREMENT,
  `Source_ID` int NOT NULL,
  `Recipient_ID` int NOT NULL,
  `Notif_Title` varchar(255) NOT NULL,
  `Notif_Message` varchar(255) NOT NULL,
  `is_Read` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Notif_ID`),
  KEY `Source_ID` (`Source_ID`),
  KEY `Recipient_ID` (`Recipient_ID`),
  CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`Source_ID`) REFERENCES `user` (`User_ID`),
  CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`Source_ID`) REFERENCES `lender` (`Lender_ID`),
  CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`Recipient_ID`) REFERENCES `user` (`User_ID`),
  CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`Recipient_ID`) REFERENCES `lender` (`Lender_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_sched`
--

DROP TABLE IF EXISTS `payment_sched`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_sched` (
  `Schedule_ID` int NOT NULL AUTO_INCREMENT,
  `Frequency` varchar(255) NOT NULL,
  `Details` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Schedule_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_sched`
--

LOCK TABLES `payment_sched` WRITE;
/*!40000 ALTER TABLE `payment_sched` DISABLE KEYS */;
INSERT INTO `payment_sched` VALUES (1,'Weekly','Payment is made once every week'),(2,'Semi-Monthly','Payment is made on the 15th, and on the end of the month'),(3,'Monthly','Payment is made once a month'),(4,'Quarterly','Payment is made every quarter');
/*!40000 ALTER TABLE `payment_sched` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restructured_acc`
--

DROP TABLE IF EXISTS `restructured_acc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restructured_acc` (
  `RestructAcc_ID` int NOT NULL AUTO_INCREMENT,
  `Loan_ID` int NOT NULL,
  `Amount_Paayable` float NOT NULL,
  `Interest` float NOT NULL,
  `Tenure_ID` int NOT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`RestructAcc_ID`),
  KEY `Loan_ID` (`Loan_ID`),
  KEY `Tenure_ID` (`Tenure_ID`),
  CONSTRAINT `restructured_acc_ibfk_1` FOREIGN KEY (`Loan_ID`) REFERENCES `loan` (`Loan_ID`),
  CONSTRAINT `restructured_acc_ibfk_2` FOREIGN KEY (`Tenure_ID`) REFERENCES `tenure` (`Tenure_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restructured_acc`
--

LOCK TABLES `restructured_acc` WRITE;
/*!40000 ALTER TABLE `restructured_acc` DISABLE KEYS */;
/*!40000 ALTER TABLE `restructured_acc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tenure`
--

DROP TABLE IF EXISTS `tenure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tenure` (
  `Tenure_ID` int NOT NULL AUTO_INCREMENT,
  `Duration` varchar(255) NOT NULL,
  PRIMARY KEY (`Tenure_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tenure`
--

LOCK TABLES `tenure` WRITE;
/*!40000 ALTER TABLE `tenure` DISABLE KEYS */;
INSERT INTO `tenure` VALUES (1,'1 Month'),(2,'3 Months'),(3,'6 Months'),(4,'1 Year'),(5,'2 Years');
/*!40000 ALTER TABLE `tenure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_history`
--

DROP TABLE IF EXISTS `transaction_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction_history` (
  `TransHistory_ID` int NOT NULL AUTO_INCREMENT,
  `Loan_ID` int NOT NULL,
  `Details` varchar(255) NOT NULL,
  `Amount_Paid` float NOT NULL,
  `Timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TransHistory_ID`),
  KEY `Loan_ID_idx` (`Loan_ID`),
  CONSTRAINT `Loan_ID` FOREIGN KEY (`Loan_ID`) REFERENCES `loan` (`Loan_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_history`
--

LOCK TABLES `transaction_history` WRITE;
/*!40000 ALTER TABLE `transaction_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(255) NOT NULL,
  `Middle_Name` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Monthly_Income` int NOT NULL,
  `Birthday` date NOT NULL,
  `City` varchar(45) NOT NULL,
  `Province` varchar(45) NOT NULL,
  `ZIP_Code` int NOT NULL,
  `Contact_Number` int NOT NULL,
  `Employment_Status` enum('Employed','Unemployed','Self-Employed') NOT NULL,
  `Income_Document` blob,
  `ValidID_1` blob,
  `ValidID_2` blob,
  `Utility_Bill` blob,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Verified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_ID_UNIQUE` (`User_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
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

-- Dump completed on 2023-12-03 21:47:42
