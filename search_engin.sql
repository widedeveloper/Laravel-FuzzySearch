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

/*Table structure for table `contents` */

DROP TABLE IF EXISTS `contents`;

CREATE TABLE `contents` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `Municipality` int(4) DEFAULT NULL,
  `Block` varchar(30) DEFAULT NULL,
  `Lot` varchar(10) DEFAULT NULL,
  `Qual` varchar(10) DEFAULT NULL,
  `Property_Location` varchar(191) DEFAULT NULL,
  `PropertyClass` varchar(191) DEFAULT NULL,
  `OwnerName` varchar(191) DEFAULT NULL,
  `OwnerMailingAddress` varchar(191) DEFAULT NULL,
  `CityStateZip1` varchar(191) DEFAULT NULL,
  `SqFt` varchar(30) DEFAULT NULL,
  `YrBuilt` varchar(50) DEFAULT NULL,
  `BuildingClass` varchar(50) DEFAULT NULL,
  `PriorBlock` varchar(191) DEFAULT NULL,
  `PriorLot` varchar(191) DEFAULT NULL,
  `PriorQual` varchar(10) DEFAULT NULL,
  `Updated` varchar(191) DEFAULT NULL,
  `Zone` varchar(191) DEFAULT NULL,
  `Account` varchar(191) DEFAULT NULL,
  `MortgageAccount` varchar(191) DEFAULT NULL,
  `BankCode` varchar(50) DEFAULT NULL,
  `SpTaxCd1` varchar(10) DEFAULT NULL,
  `SpTaxCd2` varchar(10) DEFAULT NULL,
  `SpTaxCd3` varchar(10) DEFAULT NULL,
  `SpTaxCd4` varchar(10) DEFAULT NULL,
  `MapPage` varchar(10) DEFAULT NULL,
  `AdditionalLots` varchar(20) DEFAULT NULL,
  `LandDesc` varchar(20) DEFAULT NULL,
  `BuildingDesc` varchar(191) DEFAULT NULL,
  `Class4Code` varchar(10) DEFAULT NULL,
  `Acreage` varchar(50) DEFAULT NULL,
  `EPLOwn` varchar(50) DEFAULT NULL,
  `EPLUse` varchar(50) DEFAULT NULL,
  `EPLDesc` varchar(50) DEFAULT NULL,
  `EPLStatue` varchar(20) DEFAULT NULL,
  `EPLInit` varchar(50) DEFAULT NULL,
  `EPLFurther` varchar(50) DEFAULT NULL,
  `EPLFacilityName` varchar(191) DEFAULT NULL,
  `Taxes1` varchar(50) DEFAULT NULL,
  `Taxes2` varchar(50) DEFAULT NULL,
  `Taxes3` varchar(50) DEFAULT NULL,
  `Taxes4` varchar(50) DEFAULT NULL,
  `SaleDate` varchar(191) DEFAULT NULL,
  `DeedBook` varchar(20) DEFAULT NULL,
  `DeedPage` varchar(10) DEFAULT NULL,
  `SalePrice` varchar(50) DEFAULT NULL,
  `NUCode` varchar(50) DEFAULT NULL,
  `Ratio` varchar(50) DEFAULT NULL,
  `TypeUse` varchar(20) DEFAULT NULL,
  `Year2` varchar(50) DEFAULT NULL,
  `Owner2` varchar(191) DEFAULT NULL,
  `Street2` varchar(191) DEFAULT NULL,
  `CityStateZip2` varbinary(191) DEFAULT NULL,
  `LandAssmnt2` varchar(191) DEFAULT NULL,
  `BuildingAssmnt2` varchar(50) DEFAULT NULL,
  `Exempt2` varchar(50) DEFAULT NULL,
  `TotalAssmnt2` varchar(50) DEFAULT NULL,
  `Assessed2` varchar(50) DEFAULT NULL,
  `Year3` varchar(50) DEFAULT NULL,
  `Owner3` varbinary(191) DEFAULT NULL,
  `Street3` varbinary(191) DEFAULT NULL,
  `CityStateZip3` varbinary(191) DEFAULT NULL,
  `LandAssmnt3` varchar(191) DEFAULT NULL,
  `BuildingAssmnt3` varchar(50) DEFAULT NULL,
  `Exempt3` varchar(50) DEFAULT NULL,
  `TotalAssmnt3` varchar(50) DEFAULT NULL,
  `Assessed3` varchar(50) DEFAULT NULL,
  `Year4` varchar(50) DEFAULT NULL,
  `Owner4` varchar(191) DEFAULT NULL,
  `Street4` varchar(191) DEFAULT NULL,
  `CityStateZip4` varchar(191) DEFAULT NULL,
  `LandAssmnt4` varchar(191) DEFAULT NULL,
  `BuildingAssmnt4` varchar(50) DEFAULT NULL,
  `Exempt4` varchar(50) DEFAULT NULL,
  `TotalAssmnt4` varchar(50) DEFAULT NULL,
  `Assessed4` varchar(50) DEFAULT NULL,
  `Year5` varchar(50) DEFAULT NULL,
  `Owner5` varchar(191) DEFAULT NULL,
  `Street5` varchar(191) DEFAULT NULL,
  `CityStateZip5` varchar(191) DEFAULT NULL,
  `LandAssmnt5` varchar(191) DEFAULT NULL,
  `BuildingAssmnt5` varchar(50) DEFAULT NULL,
  `Exempt5` varchar(50) DEFAULT NULL,
  `TotalAssmnt5` varchar(50) DEFAULT NULL,
  `Assessed5` varchar(50) DEFAULT NULL,
  `Latitude` varchar(50) DEFAULT NULL,
  `Longitude` varchar(50) DEFAULT NULL,
  `Neigh` varchar(20) DEFAULT NULL,
  `VCS` varchar(20) DEFAULT NULL,
  `StyDesc` varchar(20) DEFAULT NULL,
  `Style` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=179361 DEFAULT CHARSET=latin1;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `is_active` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
