/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.5.39 : Database - promunity
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`promunity` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `promunity`;

/*Table structure for table `alumno` */

DROP TABLE IF EXISTS `alumno`;

CREATE TABLE `alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alumno_foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alumno_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alumno_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alumno_acceso` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `alumno` */

insert  into `alumno`(`id`,`alumno_email`,`alumno_foto`,`alumno_password`,`alumno_usuario`,`alumno_acceso`) values (1,'alexandermarcelocastillo@gmail.com','alexandercastillo.png','$2y$10$BFmigzjrJrtss1diYM7mOOXdFuPVeb3dlcqeG4Nn8RnbhwwTghSgO','alexandercastillo',1),(4,'prueba@gmail.com','','$2y$10$GhmsAGhYmrCDDPhzl34pCuhwDGfnmJEEFjhdXCMMdpPwh3IoUXpgm','prueba',1),(5,'paolatorr1979@yahoo.com.ar','','$2y$10$5p49zRJU5/uUd5VJWVGmCOL5DOzeWQzC7l9428TNRGO3FslJdSpLC','pepe',1);

/*Table structure for table `alumno_curso` */

DROP TABLE IF EXISTS `alumno_curso`;

CREATE TABLE `alumno_curso` (
  `alumno_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  KEY `FKowxkqfb2u3f989w71rflxqi86` (`curso_id`),
  KEY `FKr44lwkj2g6xp76jg0p19dqqcw` (`alumno_id`),
  CONSTRAINT `FKowxkqfb2u3f989w71rflxqi86` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  CONSTRAINT `FKr44lwkj2g6xp76jg0p19dqqcw` FOREIGN KEY (`alumno_id`) REFERENCES `alumno` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `alumno_curso` */

insert  into `alumno_curso`(`alumno_id`,`curso_id`) values (1,3),(4,3),(5,3);

/*Table structure for table `curso` */

DROP TABLE IF EXISTS `curso`;

CREATE TABLE `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_lenguaje` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `curso_nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `curso_autor` int(11) NOT NULL,
  `curso_foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKkqpgx090v6iqin34us5x4l0j5` (`curso_autor`),
  CONSTRAINT `FKkqpgx090v6iqin34us5x4l0j5` FOREIGN KEY (`curso_autor`) REFERENCES `profesor` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `curso` */

insert  into `curso`(`id`,`curso_lenguaje`,`curso_nombre`,`curso_autor`,`curso_foto`) values (3,'JAVA','Java Premium',3,NULL);

/*Table structure for table `profesor` */

DROP TABLE IF EXISTS `profesor`;

CREATE TABLE `profesor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profesor_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profesor_foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profesor_password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profesor_usuario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profesor_acceso` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `profesor` */

insert  into `profesor`(`id`,`profesor_email`,`profesor_foto`,`profesor_password`,`profesor_usuario`,`profesor_acceso`) values (3,'pepe@gmail.com','','$2y$10$99GZv.bqQbwafYO7gKjlW./WXMUGtjPvaln2tZVx4lQt2HiIdr0RK','pepe',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
