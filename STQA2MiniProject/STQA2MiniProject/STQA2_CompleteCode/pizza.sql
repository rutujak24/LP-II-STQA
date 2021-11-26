-- MySQL dump 10.13  Distrib 5.5.42, for Win32 (x86)
--
-- Host: localhost    Database: pizza
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Current Database: `pizza`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `pizza` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `pizza`;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookings` (
  `bookingid` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(50) DEFAULT NULL,
  `noofguests` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `timeslot` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bookingid`),
  KEY `username` (`username`),
  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES ('176','NV_41175',2,'2020-11-07','9pm'),('266','NV_41175',6,'2020-10-31','7pm'),('308','NV_41175',6,'2020-10-31','7pm'),('340','NV_41175',6,'2020-10-31','7pm'),('43','SA_41161',6,'2020-04-24','9pm'),('478','SP_41166',2,'2020-04-10','5pm'),('479','AW_41178',2,'2020-04-17','6pm'),('50','SP_41166',2,'2020-04-10','5pm'),('552','SA_41161',2,'2020-04-14','8pm'),('581','SP_41166',2,'2020-04-17','11am'),('583','SP_41166',2,'2020-04-10','5pm'),('600','SP_41166',2,'2020-04-17','11am'),('734','NV_41175',2,'2020-11-01','2pm'),('773','SA_41161',6,'2020-04-21','9pm'),('774','SS_41172',2,'2020-04-18','6pm'),('808','NV_41175',2,'2020-11-01','2pm'),('861','SA_41161',6,'2020-09-30','9pm'),('889','NV_41175',6,'2020-10-31','7pm'),('961','NV_41175',2,'2020-11-01','2pm');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `itemid` varchar(20) NOT NULL DEFAULT '',
  `price` double(10,2) DEFAULT NULL,
  `item` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES ('D01A',150.00,'Margarita'),('D01B',275.00,'Margarita'),('D02A',125.00,'Mojito'),('D02B',250.00,'Mojito'),('NV01',800.00,'Chicken Golden Delight'),('NV02',800.00,'Chicken Sausage'),('NV03',700.00,'Chicken Dominator'),('NV04',700.00,'Chicken Tikka'),('V01',600.00,'Crispy Corn and Cheese'),('V02',600.00,'Fresh Veggie'),('V03',700.00,'Veg Extravaganza'),('V04',700.00,'Veggie Paradise');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetails` (
  `orderid` int(11) DEFAULT NULL,
  `itemid` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` double(10,2) DEFAULT '0.00',
  KEY `orderid` (`orderid`),
  KEY `itemid` (`itemid`),
  CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`orderid`),
  CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`itemid`) REFERENCES `items` (`itemid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetails`
--

LOCK TABLES `orderdetails` WRITE;
/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
INSERT INTO `orderdetails` VALUES (1,'V01',1,600.00),(1,'NV02',1,800.00),(1,'D01A',2,300.00),(2,'V02',2,1200.00),(2,'V01',2,1200.00),(2,'D01B',4,1100.00),(3,'NV02',1,800.00),(3,'NV03',1,700.00),(3,'D02A',2,250.00),(4,'V03',2,1400.00),(4,'D02A',1,125.00),(5,'V04',1,700.00),(5,'D01A',1,150.00),(6,'V02',2,1200.00),(7,'D02B',2,500.00),(8,'V04',2,1400.00),(8,'D01B',2,550.00),(9,'D01B',1,275.00),(9,'NV02',2,800.00),(9,'D02B',1,250.00),(10,'V01',2,1200.00),(11,'V01',2,1200.00),(12,'V01',3,1800.00),(13,'V01',12,7200.00),(14,'V02',2,1200.00),(14,'D02A',2,250.00),(14,'D01A',1,150.00),(15,'V02',2,1200.00),(15,'D02A',2,250.00),(15,'D01A',1,150.00),(16,'V01',4,2400.00),(17,'V01',4,2400.00),(18,'V02',2,1200.00),(18,'D02A',2,250.00),(18,'D01A',1,150.00),(19,'V01',12,7200.00),(20,'V01',12,7200.00),(21,'V01',12,7200.00),(22,'V01',12,7200.00),(23,'V01',12,7200.00),(24,'V01',12,7200.00),(25,'V01',4,2400.00),(26,'V02',2,1200.00),(26,'D02A',2,250.00),(26,'D01A',1,150.00),(27,'V01',12,7200.00),(28,'V01',2,1200.00),(29,'V01',12,7200.00),(30,'D02A',3,375.00),(31,'V02',2,1200.00),(31,'D02A',2,250.00),(31,'D01A',1,150.00);
/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(50) DEFAULT NULL,
  `bill` double(10,2) DEFAULT '0.00',
  PRIMARY KEY (`orderid`),
  KEY `username` (`username`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'SA_41161',1700.00),(2,'SS_41172',3500.00),(3,'SP_41166',1750.00),(4,'SS_41172',2525.00),(5,'SS_41172',1850.00),(6,'SA_41161',1200.00),(7,'SA_41161',500.00),(8,'SA_41161',1950.00),(9,'SA_41161',1325.00),(10,'SA_41161',1200.00),(11,'SA_41161',1200.00),(12,'SA_41161',1800.00),(13,'SA_41161',7200.00),(14,'NV_41175',800.00),(15,'NV_41175',4600.00),(16,'NV_41175',2400.00),(17,'NV_41175',2400.00),(18,'NV_41175',4600.00),(19,'SA_41161',1800.00),(20,'SA_41161',7200.00),(21,'SA_41161',7200.00),(22,'SA_41161',7200.00),(23,'SA_41161',7200.00),(24,'SA_41161',7200.00),(25,'NV_41175',2400.00),(26,'NV_41175',4600.00),(27,'SA_41161',7200.00),(28,'NV_41175',1200.00),(29,'SA_41161',7200.00),(30,'NV_41175',375.00),(31,'NV_41175',4600.00);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('Sarah','Abbas','SA_41161','sarahabbas@gmail.com','Stqa123','1234567890','Katraj, Pune'),('Shruti','Phadke','SP_41166','shrutidphadke@gmail.com','Stqa123','9922570384','Chinchwad, Pune'),('Sushmita','Shirude','SS_41172','sushmitashirude@gmail.com','Stqa123','9876543210','Katraj, Pune'),('Nirvi','Vakharia','NV_41175','nirvivakharia@gmail.com','Stqa123','9999888877','Kothrud, Pune'),('Apurva','Wani','AW_41178','apurvawani@gmail.com','Stqa123','9999666655','Aundh, Pune');
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

-- Dump completed on 2020-11-11 19:41:59
