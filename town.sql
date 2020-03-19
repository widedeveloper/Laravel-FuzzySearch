/*
SQLyog Professional v12.4.1 (64 bit)
MySQL - 5.7.24 : Database - search_engine
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`search_engine` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `search_engine`;

/*Table structure for table `towns` */

DROP TABLE IF EXISTS `towns`;

CREATE TABLE `towns` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `Municipality` int(4) DEFAULT NULL,
  `town` varchar(191) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `towns` */

insert  into `towns`(`id`,`Municipality`,`town`) values 
(1,1401,'BOONTON TOWN'),
(2,1402,'BOONTON TOWNSHIP'),
(3,1403,'BUTLER'),
(4,1404,'CHATHAM BOROUGH'),
(5,1405,'CHATHAM TOWNSHIP'),
(6,1406,'CHESTER BOROUGH'),
(7,1407,'CHESTER TOWNSHIP'),
(8,1408,'DENVILLE'),
(9,1409,'DOVER'),
(10,1410,'EAST HANOVER'),
(11,1411,'FLORHAM PARK'),
(12,1412,'HANOVER'),
(13,1413,'HARDING'),
(14,1414,'JEFFERSON'),
(15,1415,'KINNELON'),
(16,1416,'LINCOLN PARK'),
(17,1417,'LONG HILL'),
(18,1418,'MADISON'),
(19,1419,'MENDHAM BOROUGH'),
(20,1420,'MENDHAM TOWNSHIP'),
(21,1421,'MINE HILL'),
(22,1422,'MONTVILLE'),
(23,1423,'MORRIS PLAINS'),
(24,1424,'MORRIS TOWNSHIP'),
(25,1425,'MORRISTOWN'),
(26,1426,'MOUNTAIN LAKES'),
(27,1427,'MT ARLINGTON'),
(28,1428,'MT OLIVE'),
(29,1429,'NETCONG'),
(30,1430,'PARSIPPANY'),
(31,1431,'PEQUANNOCK'),
(32,1432,'RANDOLPH'),
(33,1433,'RIVERDALE'),
(34,1434,'ROCKAWAY BOROUGH'),
(35,1435,'ROCKAWAY TOWNSHIP'),
(36,1436,'ROXBURY'),
(37,1437,'VICTORY GARDENS'),
(38,1438,'WASHINGTON'),
(39,1439,'WHARTON');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
