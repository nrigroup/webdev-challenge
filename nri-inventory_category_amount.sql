-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: nri-inventory
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `category_amount`
--

DROP TABLE IF EXISTS `category_amount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `iot_title` varchar(255) NOT NULL,
  `iot_location` varchar(255) NOT NULL,
  `iot_condition` varchar(255) NOT NULL,
  `pre_tax_amt` decimal(15,2) NOT NULL,
  `tax_name` varchar(255) NOT NULL,
  `tax_amt` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_amount`
--

LOCK TABLES `category_amount` WRITE;
/*!40000 ALTER TABLE `category_amount` DISABLE KEYS */;
INSERT INTO `category_amount` VALUES (1,'2013-12-01','Construction','Hauling Transfer Trailers','783 Park Ave, New York, NY 10021','Brand New',350.00,'NY Sales tax',31.06),(2,'2013-12-15','Construction','Roll-of trucks','1 Infinite Loop, Cupertino, CA 95014','Like Brand New',235.00,'CA Sales tax',17.63),(3,'2013-12-31','Construction','End dumps','1 Infinite Loop, Cupertino, CA 95014','Used',999.00,'CA Sales tax',74.93),(4,'2013-12-14','Construction','Skid steer loaders','1 Infinite Loop, Cupertino, CA 95014','For parts or not working',899.00,'CA Sales tax',67.43),(5,'2013-12-06','Construction','Bobtail dump trucks','1600 Amphitheatre Parkway, Mountain View, CA 94043','Brand New',21000.54,'CA Sales tax',1575.04),(6,'2013-12-09','Construction','Front loaders\' engines','1600 Amphitheatre Parkway, Mountain View, CA 94043','For parts or not working',50.00,'CA Sales tax',3.75),(7,'2013-11-10','Construction','Water trucks','1600 Amphitheatre Parkway, Mountain View, CA 94043','For parts or not working',300.00,'CA Sales tax',22.50),(8,'2013-11-12','Mining','Shovels','1600 Amphitheatre Parkway, Mountain View, CA 94043','Like Brand New',230.00,'CA Sales tax',17.25),(9,'2013-11-20','Plastics & Rubber','2kgs; used rubber tires','783 Park Ave, New York, NY 10021','Used',200.00,'NY Sales tax',15.00),(10,'2013-10-04','Mining','Assorted Tools','1600 Amphitheatre Parkway, Mountain View, CA 94043','Used',200.00,'CA Sales tax',15.00),(11,'2013-10-12','Mining','Assorted Tools','783 Park Ave, New York, NY 10021','Used',1999.00,'NY Sales tax',177.41),(12,'2013-12-09','Plastics & Rubber','2kgs; used rubber tires','The Montreal Museum of Fine Arts, 1380 Rue Sherbrooke O, Montréal, QC H3G 1J5','Used',15.00,'CA Sales tax',1.13),(13,'2013-09-18','Plastics & Rubber','20” plastic sheets','1 Infinite Loop, Cupertino, CA 95014','Brand New',200.00,'CA Sales tax',15.00),(14,'2013-09-30','Mining','Assorted Tools','1600 Amphitheatre Parkway, Mountain View, CA 94043','Like Brand New',200.00,'CA Sales tax',15.00),(15,'2013-12-30','Computer - Hardware','Dell XPS 13','1600 Amphitheatre Parkway, Mountain View, CA 94043','Used',200.00,'CA Sales tax',15.00),(16,'2014-01-06','Computer - Hardware','Dell XPS 13','1600 Amphitheatre Parkway, Mountain View, CA 94043','Used',200.00,'CA Sales tax',15.00),(17,'2014-01-07','Computer - Hardware','Dell XPS 13','1 Infinite Loop, Cupertino, CA 95014','Used',200.00,'CA Sales tax',15.00),(18,'2014-02-03','Computer – Software','MS OFFICE 2016','1 Infinite Loop, Cupertino, CA 95014','Brand New',12.00,'CA Sales tax',0.90),(19,'2014-02-18','Computer – Software','MS OFFICE 2016 Bulk','1600 Amphitheatre Parkway, Mountain View, CA 94043','Brand New',1500.00,'CA Sales tax',112.50);
/*!40000 ALTER TABLE `category_amount` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-17  0:04:07
