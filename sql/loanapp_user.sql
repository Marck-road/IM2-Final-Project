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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Middle_Name` varchar(255) DEFAULT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `Monthly_Income` int NOT NULL,
  `Birthday` date NOT NULL,
  `City` varchar(45) NOT NULL,
  `Province` varchar(45) NOT NULL,
  `ZIP_Code` int NOT NULL,
  `Contact_Number` varchar(45) NOT NULL,
  `Employment_Status` enum('Employed','Unemployed','Self-Employed') NOT NULL,
  `Income_Document` blob,
  `ValidID_1` blob,
  `ValidID_2` blob,
  `Utility_Bill` blob,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Verified_at` timestamp NULL DEFAULT NULL,
  `Account_Status` enum('Verified','Unverified','Pending') DEFAULT 'Unverified',
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_ID_UNIQUE` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'asdf@gmail.com','912ec803b2ce49e4a541068d495ab570','asdf','adsf','asdf',2321321,'2222-02-22','asdf','afdsfa',21313,'213213','Employed',NULL,NULL,NULL,NULL,'2023-12-06 02:33:16','2023-12-08 21:10:37','Verified'),(2,'fdsa@email.com','fc2baa1a20b4d5190b122b383d7449fd','fdsa','fdsa','fdsa',232312,'1122-12-12','dsfsadf','fsdafsdaf',223,'32323','Unemployed',NULL,NULL,NULL,NULL,'2023-12-06 02:36:49',NULL,'Pending'),(3,'user1@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','User1','isstep','Auser',40000,'1998-06-04','Cebu City','Cebu',6000,'09472659123','Employed',_binary 'PXL_20230821_075754885.MP.jpg',_binary '20230701_180616.jpg',_binary 'PXL_20230813_074035280.MP.jpg',_binary 'PXL_20230821_075754885.MP.jpg','2023-12-06 12:49:01',NULL,'Pending'),(4,'markdavidcalzada@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','mark','david','calzada',10000,'2002-12-21','Ormoc City','Leyte',6541,'09290106249','Self-Employed',_binary 'IMG_20230602_053251.jpg',_binary '20230701_180616.jpg',_binary 'PXL_20230813_074035280.MP.jpg',_binary 'PXL_20230821_075754885.MP.jpg','2023-12-09 06:36:42',NULL,'Pending');
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

-- Dump completed on 2024-01-02 11:58:50
