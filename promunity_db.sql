/*
SQLyog Ultimate v9.63 
MySQL - 5.5.5-10.3.16-MariaDB : Database - promunity_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`promunity_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `promunity_db`;

/*Table structure for table `cursos` */

DROP TABLE IF EXISTS `cursos`;

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `foto_curso` varchar(50) NOT NULL,
  `lenguaje` varchar(50) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `tipo_id` int(11) NOT NULL,
  `uso_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`autor`),
  KEY `tipo_id` (`tipo_id`),
  KEY `uso_id` (`uso_id`),
  CONSTRAINT `autor` FOREIGN KEY (`autor`) REFERENCES `users` (`id`),
  CONSTRAINT `tipo_id` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`),
  CONSTRAINT `uso_id` FOREIGN KEY (`uso_id`) REFERENCES `uso` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `cursos` */

/*Table structure for table `tipo` */

DROP TABLE IF EXISTS `tipo`;

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tnombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tipo` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `acceso` tinyint(4) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

/*Table structure for table `uso` */

DROP TABLE IF EXISTS `uso`;

CREATE TABLE `uso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `snombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `uso` */

/*Table structure for table `usuario_curso` */

DROP TABLE IF EXISTS `usuario_curso`;

CREATE TABLE `usuario_curso` (
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  KEY `id_usuario` (`id_usuario`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `id_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id`),
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `usuario_curso` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
