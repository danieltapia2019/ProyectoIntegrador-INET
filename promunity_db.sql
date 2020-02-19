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

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `categorias` */

insert  into `categorias`(`id`,`nombre`) values (1,'Prog');

/*Table structure for table `curso` */

DROP TABLE IF EXISTS `curso`;

CREATE TABLE `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foto_curso` varchar(50) NOT NULL,
  `precio` double DEFAULT NULL,
  `lenguaje` varchar(50) DEFAULT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `autor` int(11) DEFAULT NULL,
  `categorias_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `autor` (`autor`),
  KEY `categorias_id` (`categorias_id`),
  CONSTRAINT `autor` FOREIGN KEY (`autor`) REFERENCES `users` (`id`),
  CONSTRAINT `curso_ibfk_1` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `curso` */

insert  into `curso`(`id`,`foto_curso`,`precio`,`lenguaje`,`descripcion`,`autor`,`categorias_id`) values (2,'java.jpg',50,'java',NULL,1,1);

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

insert  into `users`(`id`,`username`,`email`,`password`,`foto`,`acceso`,`remember_token`) values (1,'franco2098','f@g.com','$2y$10$57627Kzoe3AYjAvgYB05qelN/XJeVS/ScG1N3W6jdio6Fq4uejNx.','',0,NULL),(3,'valentin2098','vale@g.com','$2y$10$7m70C2qgyltxjbabPVRSmu7dzsqqOxwVy59IOef4p5Xc3OKlK7HVa','valentin2098.jpg',2,NULL),(4,'Daniel2098','d@g.com','$2y$10$gXxSwOzFz9hvuh0z5vHV.eRfm.iBD9p1BpKf.Usbrz2d8MG.AHNO6',NULL,2,NULL),(5,'Alex2098','a@g.com','$2y$10$7/QHTd12977ZSODObpij..4/9uos4H9oEI3meurtZ/VKaVoprfnwa',NULL,2,'BBugT1bn6BuZDCPAe0AQm5MzBcKRjcgxPSXSCeFRICzznbrGF8QzARRi4aSj');

/*Table structure for table `usuario_curso` */

DROP TABLE IF EXISTS `usuario_curso`;

CREATE TABLE `usuario_curso` (
  `id_usuario` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  KEY `id_usuario` (`id_usuario`),
  KEY `id_curso` (`id_curso`),
  CONSTRAINT `id_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`),
  CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `usuario_curso` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
