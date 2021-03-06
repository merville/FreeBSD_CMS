-- MySQL dump 10.13  Distrib 5.5.29, for FreeBSD9.0 (i386)
--
-- Host: localhost    Database: 
-- ------------------------------------------------------
-- Server version	5.5.29

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
-- Current Database: `freebsdcms`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `freebsdcms` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `freebsdcms`;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `heading` varchar(50) DEFAULT NULL,
  `content` text,
  `status` int(11) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'FAQ 1','First FAQ','Aenean volutpat, ligula vitae laoreet dapibus',2,'0000-00-00 00:00:00'),(2,'FAQ 2','Second FAQ','Aenean volutpat, ligula vitae laoreet dapibus',0,'2013-07-27 21:29:23'),(3,'FAQ 3','Third FAQ','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam eros nibh, dapibus sed suscipit nec, sollicitudin congue ante. Nulla lacinia ullamcorper tristique. Nam id malesuada arcu. Pellentesque diam eros, varius at consequat sit amet, blandit ut neque. Donec tempor dignissim lacus, sit amet faucibus leo. In commodo ornare sem, non euismod nunc aliquet sollicitudin. Sed sollicitudin augue at lacinia tempor. Curabitur ligula elit, vestibulum sit amet lacus vitae, cursus rutrum sapien.\r\n\r\nAliquam elementum, augue a sodales venenatis, odio mi tempus ipsum, congue gravida turpis est eu sapien. Nam viverra turpis non risus auctor vehicula. Etiam nibh diam, interdum non ultricies a, dapibus vel purus. Aliquam convallis interdum magna. Curabitur vitae lobortis massa. Nam pulvinar sed diam in adipiscing. Etiam ac lectus at purus porta vulputate. Integer convallis volutpat odio, eu lobortis justo tempus id. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse mattis ornare turpis ac feugiat. Vivamus ullamcorper, sem ac rutrum interdum, erat justo dictum orci, non sagittis arcu sapien sodales velit. Quisque aliquet arcu vel aliquet venenatis.\r\n\r\nVestibulum molestie porta tincidunt. Fusce at nunc ut mauris vestibulum ultrices. Fusce et pulvinar lectus. Donec consectetur scelerisque urna, a dignissim justo hendrerit id. Donec at posuere velit. Nunc auctor feugiat quam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.\r\n\r\nEtiam posuere, felis vel convallis imperdiet, lacus ante molestie ipsum, a imperdiet ante arcu ac nisl. Nam elementum sapien turpis, eu luctus ipsum mattis sit amet. Integer pharetra hendrerit consequat. Mauris nisi elit, dictum aliquam nisl quis, tristique varius augue. Vivamus placerat erat sit amet enim accumsan, nec semper enim sodales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et semper nunc, quis convallis purus. Phasellus nisi nulla, bibendum ac ornare pharetra, semper non nibh. Ut id turpis quis mi tincidunt cursus. Donec ac nisi vehicula, ultricies arcu sit amet, tincidunt arcu. Praesent nec mauris sed dolor facilisis gravida. Donec in sapien quis elit condimentum placerat vitae ac ipsum. Curabitur nunc mi, faucibus at dui elementum, blandit hendrerit magna. Donec aliquet orci at congue convallis. Donec gravida pellentesque felis vitae imperdiet.\r\n\r\nNam tortor massa, imperdiet quis ipsum eu, porta tristique metus. Mauris id pharetra leo. Nam elementum, odio in molestie fermentum, massa magna tempus nulla, tincidunt vulputate mauris lorem dictum dui. Integer iaculis placerat eros, vitae gravida odio aliquam a. Duis lobortis arcu tincidunt nisi egestas mollis. Mauris elementum suscipit augue, in porttitor neque interdum ut. Nunc cursus egestas urna, pellentesque ornare sem hendrerit nec. Aliquam adipiscing, turpis sed tincidunt posuere, nulla nisi sollicitudin tortor, et semper nunc turpis eget neque. Mauris luctus vel quam vitae molestie. Curabitur varius semper pulvinar. Phasellus pulvinar lacus quis tincidunt pulvinar. ',2,'2013-07-27 21:29:15'),(4,'FAQ 4','Fourth FAQ','Aenean volutpat, ligula vitae laoreet dapibus',2,'0000-00-00 00:00:00'),(5,'FAQ 5','Fifth FAQ','Aenean volutpat, ligula vitae laoreet dapibus',2,'0000-00-00 00:00:00'),(6,'FAQ 6','Sixth FAQ','Aenean volutpat, ligula vitae laoreet dapibus',2,'0000-00-00 00:00:00'),(7,'FAQ 7','Seventh FAQ','Aenean volutpat, ligula vitae laoreet dapibus',2,'0000-00-00 00:00:00'),(8,'FAQ 8','Eighth FAQ','Aenean volutpat, ligula vitae laoreet dapibus',2,'0000-00-00 00:00:00'),(9,'FAQ 9','Ninth FAQ','Aenean volutpat, ligula vitae laoreet dapibus',2,'0000-00-00 00:00:00'),(10,'FAQ 10','Tenth FAQ','Aenean volutpat, ligula vitae laoreet dapibus',2,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `heading` varchar(50) DEFAULT NULL,
  `content` text,
  `status` int(11) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'My first page','Page header','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris \r\ninterdum auctor tellus sed dignissim. Phasellus non orci massa, nec feugiat sem. Vestibulum molestie interdum \r\nbibendum. Nunc quis elit nulla, sit amet rutrum lorem. Quisque odio est, sagittis nec accumsan ut, placerat sit \r\namet lectus. Curabitur aliquam dignissim felis, a malesuada leo fringilla at. Sed ornare aliquet lacus, quis \r\nimperdiet augue mattis eu. Nulla porta odio ut erat consectetur at molestie justo suscipit. Aenean convallis \r\npellentesque nisl, vitae posuere mauris facilisis vitae. Morbi in tellus nisl, vel facilisis diam.',1,'2013-07-14 18:21:35'),(2,'My second page','H1','2',1,'2013-07-14 18:21:35'),(3,'Article 5 - Using CSS','A new tutorial is now avalable ','In this article we will focus on the basic techniques used to integrate CSS with our CMS, and demonstrate how modern developers tools available for the browser can assist in design. You will need access to a PC with Mozillla Firefox installed to follow this tutorial. Some useful references can be found at:\r\n\r\n<ul>\r\n<li><a href=\"http://www.mozilla.org/en-US\" title=\"Mozilla website\">Mozilla website</a></li>\r\n<li><a href=\"https://addons.mozilla.org/en-US/firefox/addon/firebug\" title=\"Mozilla firebug\">Mozilla firebug</a></li>\r\n<li><a href=\"http://www.w3schools.com/css/default.asp\" title=\"W3 Schools\">W3 Schools</a></li>\r\n</ul>\r\n\r\n ',1,'2013-07-14 18:21:35');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `h1` varchar(50) DEFAULT NULL,
  `content` text,
  `status` int(11) DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'My first page','Page header','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris \r\ninterdum auctor tellus sed dignissim. Phasellus non orci massa, nec feugiat sem. Vestibulum molestie interdum \r\nbibendum. Nunc quis elit nulla, sit amet rutrum lorem. Quisque odio est, sagittis nec accumsan ut, placerat sit \r\namet lectus. Curabitur aliquam dignissim felis, a malesuada leo fringilla at. Sed ornare aliquet lacus, quis \r\nimperdiet augue mattis eu. Nulla porta odio ut erat consectetur at molestie justo suscipit. Aenean convallis \r\npellentesque nisl, vitae posuere mauris facilisis vitae. Morbi in tellus nisl, vel facilisis diam.',2,'2013-07-14 18:22:11'),(2,'My second page','H1','2',2,'2013-07-14 18:22:11');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `test`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `test` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `test`;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-28  0:57:18
