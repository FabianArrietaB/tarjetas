/*
SQLyog Community v13.2.0 (64 bit)
MySQL - 10.4.28-MariaDB : Database - tarjetas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tarjetas` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;

USE `tarjetas`;

/*Table structure for table `porcentajes` */

DROP TABLE IF EXISTS `porcentajes`;

CREATE TABLE `porcentajes` (
  `id_porcentaje` int(11) NOT NULL AUTO_INCREMENT,
  `por_tipo` varchar(50) NOT NULL,
  `por_mes` float NOT NULL,
  `por_tipR` varchar(50) NOT NULL,
  `por_AID` varchar(50) NOT NULL,
  PRIMARY KEY (`id_porcentaje`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `porcentajes` */

insert  into `porcentajes`(`id_porcentaje`,`por_tipo`,`por_mes`,`por_tipR`,`por_AID`) values 
(1,'VISA DEBITO',0.0174,'VISA','A0000000031010'),
(2,'VISA CREDITO (CR)',0.0174,'VISA','A0000000031010'),
(3,'VISA ELECTRON DEBITO (AH)',0.0177,'VISA','A0000000032010'),
(4,'VISA ELECTRON CREDITO',0.0174,'VISA',''),
(5,'MASTERCARD CREDITO',0.0184,'MASTERCARD',''),
(6,'MAESTRO DEBITO (AH)',0.0166,'MASTERCARD',''),
(7,'MAESTRO CREDITO',0.0184,'MASTERCARD',''),
(8,'AMERICAN EXPRESSS AMEX',0.026,'VISA',''),
(9,'TARJETA EXITO - TUYA',0.025,'EXITO BANCO',''),
(10,'TARJETA OLIMPICA',0.025,'OLIMPICA BANCOLOMBIA',''),
(11,'MASTERCARD DEBITO',0.0184,'MASTERCARD',''),
(12,'VISA DEBIT',0.0175,'VISA',''),
(13,'DINNER CLUB',0,'DAVIVIENDA',''),
(14,'MAESTRO DEBITO (AH) CAJAMAG',0.0184,'MASTERCARD','');

/*Table structure for table `registros` */

DROP TABLE IF EXISTS `registros`;

CREATE TABLE `registros` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_operador` int(11) NOT NULL,
  `reg_numticket` varchar(50) NOT NULL,
  `reg_tipcuenta` int(11) NOT NULL,
  `reg_valor` float NOT NULL,
  `reg_iva` float NOT NULL,
  `reg_tardesc` float DEFAULT NULL,
  `reg_diferencia` float DEFAULT NULL,
  `reg_fecope` date NOT NULL,
  PRIMARY KEY (`id_registro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `registros` */

insert  into `registros`(`id_registro`,`id_operador`,`reg_numticket`,`reg_tipcuenta`,`reg_valor`,`reg_iva`,`reg_tardesc`,`reg_diferencia`,`reg_fecope`) values 
(1,1,'3053',11,90000,14370,5060,84940,'2023-07-31');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
