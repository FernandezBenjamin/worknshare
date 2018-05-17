# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: localhost (MySQL 5.7.21)
# Base de données: worknshare
# Temps de génération: 2018-05-14 22:09:38 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table equipements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `equipements`;

CREATE TABLE `equipements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `equipement_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `equipements_equipement_name_unique` (`equipement_name`),
  UNIQUE KEY `equipements_short_name_unique` (`short_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `equipements` WRITE;
/*!40000 ALTER TABLE `equipements` DISABLE KEYS */;

INSERT INTO `equipements` (`id`, `equipement_name`, `description`, `short_name`, `created_at`, `updated_at`)
VALUES
	(1,'Imprimantes','Imprimantes','printers','2018-05-14 18:57:40','2018-05-14 18:57:43'),
	(2,'Ordinateurs','Ordinateurs','computers','2018-05-14 18:57:47','2018-05-14 18:57:49'),
	(3,'Minitel','Minitel','minitel','2018-05-12 09:46:48','2018-05-12 09:46:48');

/*!40000 ALTER TABLE `equipements` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table equipements_loans
# ------------------------------------------------------------

DROP TABLE IF EXISTS `equipements_loans`;

CREATE TABLE `equipements_loans` (
  `sites_id` int(11) DEFAULT NULL,
  `equipements_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `dateReserved` date DEFAULT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cancel` tinyint(1) NOT NULL DEFAULT '0',
  `return` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `equipements_loans` WRITE;
/*!40000 ALTER TABLE `equipements_loans` DISABLE KEYS */;

INSERT INTO `equipements_loans` (`sites_id`, `equipements_id`, `users_id`, `dateReserved`, `token`, `cancel`, `return`, `created_at`, `updated_at`)
VALUES
	(3,1,102,'2018-06-14',NULL,0,NULL,'2018-05-14 18:56:24','2018-05-14 18:56:27'),
	(6,1,102,'2018-05-29',NULL,0,NULL,'2018-05-14 18:57:22','2018-05-14 18:57:22'),
	(5,2,102,'2018-05-20',NULL,0,NULL,'2018-05-14 17:52:40','2018-05-14 17:52:40'),
	(1,3,102,'2018-05-26',NULL,0,NULL,'2018-05-14 17:54:06','2018-05-14 17:54:06');

/*!40000 ALTER TABLE `equipements_loans` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table equipements_sites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `equipements_sites`;

CREATE TABLE `equipements_sites` (
  `sites_id` int(11) NOT NULL,
  `equipements_id` int(11) NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sites_id`,`equipements_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `equipements_sites` WRITE;
/*!40000 ALTER TABLE `equipements_sites` DISABLE KEYS */;

INSERT INTO `equipements_sites` (`sites_id`, `equipements_id`, `quantity`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'2018-04-22 15:58:47','2018-04-22 15:58:47'),
	(1,2,0,'2018-04-22 15:58:47','2018-04-22 15:58:47'),
	(1,3,1,'2018-05-12 09:46:48','2018-05-12 09:46:48'),
	(2,1,3,'2018-04-22 16:16:09','2018-04-22 16:16:09'),
	(2,2,25,'2018-04-22 16:16:09','2018-04-22 16:16:09'),
	(3,1,2,'2018-04-22 16:17:24','2018-04-22 16:17:24'),
	(3,2,18,'2018-04-22 16:17:24','2018-04-22 16:17:24'),
	(3,3,3,'2018-05-12 09:46:48','2018-05-12 09:46:48'),
	(4,1,1,'2018-04-22 16:20:14','2018-04-22 16:20:14'),
	(4,2,20,'2018-04-22 16:20:14','2018-04-22 16:20:14'),
	(5,1,3,'2018-04-22 16:21:18','2018-04-22 16:21:18'),
	(5,2,20,'2018-04-22 16:21:18','2018-04-22 16:21:18'),
	(6,1,1,'2018-04-22 16:22:22','2018-04-22 16:22:22'),
	(6,2,20,'2018-04-22 16:22:22','2018-04-22 16:22:22'),
	(6,3,20,'2018-05-12 09:46:48','2018-05-12 09:46:48');

/*!40000 ALTER TABLE `equipements_sites` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table formules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `formules`;

CREATE TABLE `formules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_formules` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Affichage de la table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(1,'2018_03_20_000000_create_users_table',1);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table offers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `offers`;

CREATE TABLE `offers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarifs` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Affichage de la table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;

INSERT INTO `password_resets` (`email`, `token`, `created_at`)
VALUES
	('john@example.com','$2y$10$nXwHKAaW3LA9jCJV4J0TZOvxYrNbdz.u.AuU1ZuxE4Dqh8py4lclq','2018-04-29 16:57:06');

/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table rooms
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rooms`;

CREATE TABLE `rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rooms_room_name_unique` (`room_name`),
  UNIQUE KEY `rooms_short_name_unique` (`short_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;

INSERT INTO `rooms` (`id`, `room_name`, `description`, `short_name`, `created_at`, `updated_at`)
VALUES
	(1,'Salle de réunions réservables','Salle de réunions réservables','meeting_rooms',NULL,NULL),
	(2,'Salle d\'appel réservables','Salle d\'appel réservables','call_rooms',NULL,NULL),
	(3,'Salon cosy','Salon cosy','cosy_rooms',NULL,NULL);

/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table rooms_reservations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rooms_reservations`;

CREATE TABLE `rooms_reservations` (
  `user_id` int(10) unsigned NOT NULL,
  `rooms_id` int(10) unsigned NOT NULL,
  `sites_id` int(10) unsigned NOT NULL,
  `canceled` tinyint(1) NOT NULL,
  `date_reserved` date NOT NULL,
  `start_hour` time NOT NULL,
  `end_hour` time NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`sites_id`,`date_reserved`),
  KEY `rooms_reservations_rooms_id_foreign` (`rooms_id`),
  KEY `rooms_reservations_sites_id_foreign` (`sites_id`),
  CONSTRAINT `rooms_reservations_rooms_id_foreign` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`),
  CONSTRAINT `rooms_reservations_sites_id_foreign` FOREIGN KEY (`sites_id`) REFERENCES `sites` (`id`),
  CONSTRAINT `rooms_reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rooms_reservations` WRITE;
/*!40000 ALTER TABLE `rooms_reservations` DISABLE KEYS */;

INSERT INTO `rooms_reservations` (`user_id`, `rooms_id`, `sites_id`, `canceled`, `date_reserved`, `start_hour`, `end_hour`, `token`, `created_at`, `updated_at`)
VALUES
	(1,2,3,0,'2018-06-09','10:00:00','12:00:00',NULL,'2018-04-30 16:58:42','2018-04-30 16:58:42');

/*!40000 ALTER TABLE `rooms_reservations` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table rooms_sites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rooms_sites`;

CREATE TABLE `rooms_sites` (
  `sites_id` int(10) unsigned NOT NULL,
  `rooms_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sites_id`,`rooms_id`),
  KEY `rooms_sites_rooms_id_foreign` (`rooms_id`),
  CONSTRAINT `rooms_sites_rooms_id_foreign` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`),
  CONSTRAINT `rooms_sites_sites_id_foreign` FOREIGN KEY (`sites_id`) REFERENCES `sites` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `rooms_sites` WRITE;
/*!40000 ALTER TABLE `rooms_sites` DISABLE KEYS */;

INSERT INTO `rooms_sites` (`sites_id`, `rooms_id`, `quantity`, `created_at`, `updated_at`)
VALUES
	(1,1,2,'2018-04-22 15:58:47','2018-04-22 15:58:47'),
	(1,2,3,'2018-04-22 15:58:47','2018-04-22 15:58:47'),
	(1,3,1,'2018-04-22 15:58:47','2018-04-22 15:58:47'),
	(2,1,7,'2018-04-22 16:16:09','2018-04-22 16:16:09'),
	(2,2,5,'2018-04-22 16:16:09','2018-04-22 16:16:09'),
	(2,3,4,'2018-04-22 16:16:09','2018-04-22 16:16:09'),
	(3,1,4,'2018-04-22 16:17:24','2018-04-22 16:17:24'),
	(3,2,2,'2018-04-22 16:17:24','2018-04-22 16:17:24'),
	(3,3,2,'2018-04-22 16:17:24','2018-04-22 16:17:24'),
	(4,1,5,'2018-04-22 16:20:14','2018-04-22 16:20:14'),
	(4,2,4,'2018-04-22 16:20:14','2018-04-22 16:20:14'),
	(4,3,3,'2018-04-22 16:20:14','2018-04-22 16:20:14'),
	(5,1,7,'2018-04-22 16:21:18','2018-04-22 16:21:18'),
	(5,2,5,'2018-04-22 16:21:18','2018-04-22 16:21:18'),
	(5,3,4,'2018-04-22 16:21:18','2018-04-22 16:21:18'),
	(6,1,2,'2018-04-22 16:22:22','2018-04-22 16:22:22'),
	(6,2,3,'2018-04-22 16:22:22','2018-04-22 16:22:22'),
	(6,3,1,'2018-04-22 16:22:22','2018-04-22 16:22:22');

/*!40000 ALTER TABLE `rooms_sites` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table services
# ------------------------------------------------------------

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_service_name_unique` (`service_name`),
  UNIQUE KEY `services_short_name_unique` (`short_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;

INSERT INTO `services` (`id`, `service_name`, `description`, `short_name`, `created_at`, `updated_at`)
VALUES
	(1,'Wi-Fi très haut débit','Wi-Fi très haut débit','wifi','2018-05-10 22:02:03','2018-05-10 22:02:09'),
	(2,'Plateaux Membres','Plateaux Membres','member_tray','2018-05-10 22:02:13','2018-05-10 22:02:18'),
	(3,'Boissons à volonté','Boissons à volonté','unlimited_drink','2018-05-10 22:02:24','2018-05-10 22:02:24');

/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table services_reservations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `services_reservations`;

CREATE TABLE `services_reservations` (
  `users_id` int(10) unsigned NOT NULL,
  `services_id` int(10) unsigned NOT NULL,
  `sites_id` int(11) DEFAULT NULL,
  `date_reserve` date NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `canceled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `services_reservations` WRITE;
/*!40000 ALTER TABLE `services_reservations` DISABLE KEYS */;

INSERT INTO `services_reservations` (`users_id`, `services_id`, `sites_id`, `date_reserve`, `token`, `canceled`, `created_at`, `updated_at`)
VALUES
	(102,2,4,'2018-05-15','mEYh7U1MgVFvXEno5n9FcFQmvXP14kcZPDpFvdhzeiSUEz8usevblu5VHkUcXMdMX2oHyeFBDy9mmTH4ttfazhfkaqjrLIR1PjY0',1,'2018-05-14 20:29:57','2018-05-14 20:32:42');

/*!40000 ALTER TABLE `services_reservations` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table services_sites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `services_sites`;

CREATE TABLE `services_sites` (
  `sites_id` int(10) unsigned NOT NULL,
  `services_id` int(10) unsigned NOT NULL,
  `contains` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sites_id`,`services_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `services_sites` WRITE;
/*!40000 ALTER TABLE `services_sites` DISABLE KEYS */;

INSERT INTO `services_sites` (`sites_id`, `services_id`, `contains`, `created_at`, `updated_at`)
VALUES
	(1,1,1,'2018-04-22 15:58:47','2018-04-22 15:58:47'),
	(1,2,1,'2018-04-22 15:58:47','2018-04-22 15:58:47'),
	(1,3,1,'2018-04-22 15:58:47','2018-04-22 15:58:47'),
	(2,1,1,'2018-04-22 16:16:09','2018-04-22 16:16:09'),
	(2,2,0,'2018-04-22 16:16:09','2018-04-22 16:16:09'),
	(2,3,1,'2018-04-22 16:16:09','2018-04-22 16:16:09'),
	(3,1,1,'2018-04-22 16:17:24','2018-04-22 16:17:24'),
	(3,2,1,'2018-04-22 16:17:24','2018-04-22 16:17:24'),
	(3,3,1,'2018-04-22 16:17:24','2018-04-22 16:17:24'),
	(4,1,1,'2018-04-22 16:20:14','2018-04-22 16:20:14'),
	(4,2,1,'2018-04-22 16:20:14','2018-04-22 16:20:14'),
	(4,3,1,'2018-04-22 16:20:14','2018-04-22 16:20:14'),
	(5,1,1,'2018-04-22 16:21:18','2018-04-22 16:21:18'),
	(5,2,0,'2018-04-22 16:21:18','2018-04-22 16:21:18'),
	(5,3,1,'2018-04-22 16:21:18','2018-04-22 16:21:18'),
	(6,1,1,'2018-04-22 16:22:22','2018-04-22 16:22:22'),
	(6,2,1,'2018-04-22 16:22:22','2018-04-22 16:22:22'),
	(6,3,1,'2018-04-22 16:22:22','2018-04-22 16:22:22');

/*!40000 ALTER TABLE `services_sites` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table sites
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sites`;

CREATE TABLE `sites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hours` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `sites` WRITE;
/*!40000 ALTER TABLE `sites` DISABLE KEYS */;

INSERT INTO `sites` (`id`, `city`, `hours`, `filename`, `created_at`, `updated_at`)
VALUES
	(1,'Bastille','Lundi à Jeudi : de 9h à 20h\r\nVendredi : de 9h à 20h\r\nSamedi & dimanche : de 11h à 20h','bastille.jpeg','2018-04-22 15:58:47','2018-04-22 15:58:47'),
	(2,'République','Lundi à Jeudi : de 8h à 21h\r\nVendredi : de 9h à 23h\r\nSamedi & dimanche : de 9h à 20h','beaubourg.jpg','2018-04-22 16:16:09','2018-04-22 16:16:09'),
	(3,'Odéon','Lundi à Jeudi : de 9h à 20h\r\nVendredi : de 9h à 20h\r\nSamedi & dimanche : de 11h à 20h','odeon.jpg','2018-04-22 16:17:24','2018-04-22 16:17:24'),
	(4,'Place d\'Italie','Lundi à Jeudi : de 9h à 20h\r\nVendredi : de 9h à 20h\r\nSamedi & dimanche : de 11h à 20h','placeitalie.jpg','2018-04-22 16:20:14','2018-04-22 16:20:14'),
	(5,'Ternes','Lundi à Jeudi : de 8h à 21h\r\nVendredi : de 9h à 23h\r\nSamedi & dimanche : de 9h à 20h','republique.jpg','2018-04-22 16:21:18','2018-04-22 16:21:18'),
	(6,'Beaubourg','Lundi à Jeudi : de 9h à 20h\r\nVendredi : de 9h à 20h\r\nSamedi & dimanche : de 11h à 20h','ternes.jpeg','2018-04-22 16:22:22','2018-04-22 16:22:22');

/*!40000 ALTER TABLE `sites` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table subscriptions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `subscriptions`;

CREATE TABLE `subscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;

INSERT INTO `subscriptions` (`id`, `user_id`, `name`, `stripe_id`, `stripe_plan`, `quantity`, `trial_ends_at`, `ends_at`, `active`, `created_at`, `updated_at`)
VALUES
	(1,102,'resident-without-engagement','sub_CpwrXcgij9NNXx','resident-without-engagement',1,NULL,'2018-06-12 10:03:44',0,'2018-05-10 15:45:59','2018-05-10 15:45:59'),
	(2,95,'resident-without-engagement','sub_CpwrXcgij9NNXx','resident-without-engagement',1,NULL,'2018-06-12 10:03:44',0,'2018-05-10 15:45:59','2018-05-10 15:45:59'),
	(3,102,'simple-without-engagement','sub_CrOqDEtQKSgmZp','simple-without-engagement',1,NULL,'2018-06-14 12:44:50',0,'2018-05-14 12:45:00','2018-05-14 12:45:00'),
	(4,102,'resident-without-engagement','sub_CrOvE3ALBvsssP','resident-without-engagement',1,NULL,'2018-06-14 12:49:24',0,'2018-05-14 12:49:34','2018-05-14 12:49:34'),
	(5,102,'resident-without-engagement','sub_CrOvY2bny4Uaca','resident-without-engagement',1,NULL,'2018-06-14 12:50:04',0,'2018-05-14 12:50:10','2018-05-14 12:50:10'),
	(6,102,'resident-without-engagement','sub_CrOw0YIUK6rDpx','resident-without-engagement',1,NULL,'2018-06-14 12:50:32',0,'2018-05-14 12:50:39','2018-05-14 12:50:39'),
	(7,102,'resident-without-engagement','sub_CrOxkX4QUk4F0G','resident-without-engagement',1,NULL,'2018-06-14 12:52:12',0,'2018-05-14 12:52:18','2018-05-14 12:52:18'),
	(8,102,'simple-without-engagement','sub_CrOz0fbChKbgb0','simple-without-engagement',1,NULL,'2018-06-14 12:53:47',0,'2018-05-14 12:53:57','2018-05-14 12:53:57'),
	(9,102,'resident-without-engagement','sub_CrP1FUQjbVQRKZ','resident-without-engagement',1,NULL,'2018-06-14 12:53:47',0,'2018-05-14 12:55:42','2018-05-14 12:55:42'),
	(10,102,'simple-without-engagement','sub_CrPPRTsMpsI868','simple-without-engagement',1,NULL,'2018-06-14 13:19:46',0,'2018-05-14 13:19:52','2018-05-14 13:19:52');

/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;


# Affichage de la table tickets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Affichage de la table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isConfirmed` tinyint(1) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `isBan` tinyint(1) NOT NULL DEFAULT '0',
  `banReasons` text COLLATE utf8mb4_unicode_ci,
  `stripe_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscriber` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `birthdate`, `password`, `isConfirmed`, `isDeleted`, `isAdmin`, `isBan`, `banReasons`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`, `subscriber`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'John','Doe','john@example.com','2010-12-15','$2y$10$RoMAfuFn.RmcsxLY3YyVRe481l9DveoE.2PQFxGK590etWgiAmQxy',1,0,1,0,NULL,'cus_CprhyZonLH0Oio',NULL,NULL,NULL,0,'2KC6yCEbnPFeZ8S4oHUavZ5qilO8e9Enen0Nez3WWfxAfmVbAy3LmoK13VHA','2018-04-21 15:25:15','2018-05-10 10:25:20'),
	(2,'Mccray','Bree','ut.nisi.a@lacusvariuset.co.uk','2004-03-21','16360722-2084',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,'','2017-07-30 17:55:04','2018-01-20 20:25:06'),
	(3,'Hughes','Dolan','amet@est.co.uk','1992-11-23','16580104-4149',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-29 15:35:28','2018-07-18 02:30:23'),
	(4,'Church','Charde','lobortis.quis.pede@Nuncut.co.uk','1984-02-16','16640121-9859',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-07-30 22:50:45','2018-11-27 17:51:37'),
	(5,'Bailey','Aaron','conubia.nostra.per@Integer.org','1996-10-11','16030429-3830',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2019-04-05 09:49:05','2017-08-18 00:31:01'),
	(6,'Kim','Graiden','orci@Sedeget.org','2013-04-08','16320718-4130',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-02-10 12:53:53','2017-12-18 07:05:14'),
	(7,'Gregory','Ezra','euismod.in.dolor@aptenttaciti.co.uk','1988-12-24','16880121-7053',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-10-07 05:13:48','2017-09-05 09:01:47'),
	(8,'Hines','Curran','Curabitur@Integertincidunt.edu','1993-10-29','16640804-8152',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-04-24 11:52:53','2017-12-10 06:04:31'),
	(9,'Harding','Zenaida','libero.at.auctor@nequevitae.edu','2010-05-07','16351230-4258',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2019-03-03 01:53:28','2019-04-25 16:51:19'),
	(10,'Griffin','Yael','Sed@estarcuac.co.uk','2012-03-26','16010615-6508',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2019-03-19 05:37:25','2018-08-30 08:13:47'),
	(11,'Lynn','Ira','mus.Proin.vel@mauris.edu','1990-05-19','16840327-2472',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-01-17 06:59:58','2017-07-26 11:35:25'),
	(12,'Chaney','Gary','eleifend.vitae.erat@malesuadautsem.net','1982-03-06','16571102-5253',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-08-08 19:36:36','2017-08-26 23:32:08'),
	(13,'Gonzalez','Calista','dui.Suspendisse.ac@cursus.ca','2000-04-26','16851003-5515',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-10-30 00:28:01','2018-11-09 18:50:51'),
	(14,'Mckee','Rashad','sollicitudin.commodo@nisimagnased.org','1998-04-13','16970128-6578',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-09-30 19:33:25','2018-02-19 03:17:49'),
	(15,'Harrell','Beau','ullamcorper.magna@Phasellus.co.uk','1996-06-20','16680306-3848',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-03-26 13:20:46','2018-06-19 06:05:18'),
	(16,'Sanford','Raphael','at.arcu@euenimEtiam.edu','1985-01-19','16380402-3376',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-08-12 15:25:43','2019-03-26 18:53:30'),
	(17,'Reeves','Breanna','varius.orci.in@Nullasemper.co.uk','1993-11-20','16720822-7863',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-12-10 17:14:40','2017-05-22 04:43:14'),
	(18,'Carpenter','Clio','scelerisque.lorem.ipsum@at.com','1995-10-22','16751119-0964',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-10-16 08:21:02','2017-05-10 15:59:04'),
	(19,'Nichols','Colt','Suspendisse@amet.net','1982-12-26','16901222-8640',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-11-04 17:01:40','2018-01-27 05:52:17'),
	(20,'Ross','Destiny','Quisque.purus@mattis.net','1992-10-21','16270103-7620',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-18 15:59:27','2017-11-18 20:56:24'),
	(21,'Ward','Xavier','in.consequat@imperdiet.edu','1997-01-29','16920408-9685',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-03-10 23:16:11','2017-05-10 14:00:33'),
	(22,'Hays','Zia','leo@blanditenimconsequat.co.uk','2008-02-08','16991208-0745',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-05-29 00:03:31','2017-10-13 13:20:07'),
	(23,'James','Ingrid','gravida.nunc@lorem.co.uk','2008-04-16','16881014-3290',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-03-26 21:24:44','2017-10-06 15:11:32'),
	(24,'Cruz','Tamara','amet@quistristiqueac.com','2007-06-20','16870704-7695',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-10 02:40:06','2018-02-08 12:09:56'),
	(25,'Acevedo','Reuben','consectetuer.rhoncus.Nullam@lacusNullatincidunt.net','1994-02-21','16650824-0097',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-14 23:31:39','2017-10-29 07:59:15'),
	(26,'Mcpherson','Zelenia','ornare@cursus.com','2011-07-04','16910107-9920',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-03-13 07:55:29','2018-10-04 05:33:51'),
	(27,'Barron','Justin','Curabitur.consequat.lectus@risusatfringilla.net','1987-01-14','16431030-2502',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-03-27 16:29:45','2018-11-29 07:41:49'),
	(28,'Lane','Nash','lacus@enimconsequatpurus.ca','2014-12-17','16100819-3656',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-28 01:44:45','2018-11-15 03:33:05'),
	(29,'Hickman','Dorothy','Aliquam.ultrices@Pellentesquetincidunttempus.edu','1996-03-13','16740827-8310',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-10 01:17:20','2017-08-22 16:12:14'),
	(30,'Warren','Rhonda','aptent@augueSed.co.uk','1997-07-15','16540714-1620',0,1,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-04-23 17:30:38','2018-11-08 04:26:32'),
	(31,'Barlow','Raya','molestie@sitamet.ca','1998-07-21','16851013-1306',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-10-12 15:54:25','2018-03-19 12:37:28'),
	(32,'Meyer','Baxter','Mauris.quis@In.com','2006-05-11','16000729-7062',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-03-07 17:58:47','2017-09-20 20:20:41'),
	(33,'Booker','Maia','posuere.enim@Uttincidunt.org','1998-10-30','16480605-5598',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-01-07 14:45:06','2018-02-28 03:36:29'),
	(34,'Terrell','Ezra','malesuada.id.erat@FuscemollisDuis.edu','1988-09-09','16540209-2398',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-10-06 16:45:17','2019-02-20 15:33:45'),
	(35,'Adams','Abigail','ullamcorper.viverra.Maecenas@posuere.ca','1992-07-25','16440113-1919',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-21 16:16:25','2017-08-14 07:28:35'),
	(36,'Lambert','Elaine','tellus.justo.sit@nuncsed.ca','2018-05-21','16740126-9449',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-27 14:44:15','2017-08-16 21:19:49'),
	(37,'Jordan','Teagan','magna.Suspendisse@sagittis.net','2010-05-21','16250520-5522',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-04-10 08:43:13','2018-02-20 10:41:55'),
	(38,'Day','Murphy','a@semper.org','1982-11-09','16030219-2851',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-10-05 13:32:28','2017-07-29 04:51:33'),
	(39,'Barron','Jakeem','ipsum.primis@sitamet.net','1992-03-15','16720612-4880',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-09-30 11:16:09','2017-12-27 02:42:40'),
	(40,'Vance','Shaeleigh','aliquet.sem.ut@primisinfaucibus.ca','1988-03-24','16740730-9058',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-04-09 15:16:08','2017-11-29 00:26:24'),
	(41,'Hays','Venus','leo@acmattis.net','2005-01-06','16500224-5933',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-07-30 22:02:06','2018-02-21 09:59:27'),
	(42,'Marsh','Claudia','mollis.Integer@id.net','2008-05-24','16421217-6574',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-07-20 15:51:10','2018-09-09 05:08:46'),
	(43,'Berry','Adam','velit.egestas@PhasellusornareFusce.co.uk','2000-06-20','16000118-0744',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-09-07 00:13:41','2018-10-26 00:21:48'),
	(44,'Faulkner','Hammett','orci@volutpatNulla.com','1983-06-30','16340211-1318',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-10 02:56:54','2018-06-14 07:43:49'),
	(45,'Campbell','Dora','pede.Nunc@facilisisvitae.edu','1998-03-03','16120523-8874',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-07-05 03:24:57','2019-01-08 18:55:01'),
	(46,'Nichols','Michelle','egestas@ut.org','2016-05-22','16980907-6475',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-07-12 05:12:28','2018-11-26 14:57:35'),
	(47,'Hurst','Dominique','risus@magna.net','2011-10-12','16520416-3314',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-11-20 10:14:37','2018-02-15 14:11:05'),
	(48,'Wade','Branden','Nulla.interdum.Curabitur@enimnislelementum.net','1992-12-22','16960607-4483',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-01-14 02:17:47','2018-04-01 08:43:21'),
	(49,'Mcbride','Brittany','Pellentesque@Nuncmauriselit.org','1996-02-15','16140208-5318',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-11-28 19:01:00','2017-11-18 22:47:17'),
	(50,'Fitzgerald','Lee','velit.in@convallisdolorQuisque.edu','2007-05-22','16020115-4374',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-23 14:56:44','2017-12-20 02:20:15'),
	(51,'Kirkland','Moses','enim.Sed@lacusUt.com','2016-11-07','16740618-7166',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-03-27 16:01:40','2018-06-12 13:51:46'),
	(52,'Daugherty','Lunea','Cras.eu.tellus@elitNullafacilisi.ca','2009-01-02','16220209-6315',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-07-06 09:35:22','2018-12-17 13:58:03'),
	(53,'Spence','Cameron','Ut.nec@massa.org','2017-07-26','16691016-2467',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-10-17 03:06:19','2019-02-04 22:44:04'),
	(54,'Porter','Preston','ipsum.primis.in@estNunc.net','2009-09-12','16131022-9651',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-06-18 00:32:25','2018-10-05 19:25:45'),
	(55,'Maxwell','Quinn','lacus.Nulla.tincidunt@semper.net','1996-05-05','16570717-7589',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-03-31 09:58:39','2019-01-02 18:11:54'),
	(56,'Meadows','Joel','dui.quis.accumsan@ipsumnuncid.ca','2015-11-22','16360628-2451',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-06-21 09:07:14','2017-10-24 02:13:15'),
	(57,'West','Nigel','Suspendisse.ac.metus@vehicula.org','2010-06-02','16730627-4015',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-09-19 20:42:26','2018-10-16 08:37:20'),
	(58,'Fernandez','Dora','ut.pharetra@dis.com','1985-05-20','16210407-1432',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-02-13 06:13:26','2018-04-30 21:33:42'),
	(59,'Wise','Gretchen','quam.Pellentesque.habitant@orciinconsequat.edu','1996-12-14','16941107-6509',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-12-29 13:09:26','2017-09-11 18:55:58'),
	(60,'Preston','Ruth','ipsum.sodales.purus@turpisAliquamadipiscing.com','1987-05-12','16861022-7111',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-06-07 09:45:52','2019-01-05 07:21:40'),
	(61,'Sampson','Axel','libero@adipiscingligula.net','1992-03-20','16930208-5981',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-04-08 20:08:57','2017-08-31 16:28:14'),
	(62,'Flynn','Forrest','in.tempus@NullafacilisiSed.com','2005-11-19','16020804-6003',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-09-03 12:32:14','2017-11-17 02:49:05'),
	(63,'Brown','Miriam','non@eleifend.edu','1989-11-22','16260211-8412',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-05-06 21:35:11','2019-04-08 00:31:13'),
	(64,'Scott','Chase','id.nunc.interdum@duiCraspellentesque.com','2012-06-18','16060420-5419',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-11-10 10:21:03','2018-02-27 10:57:35'),
	(65,'Little','Justine','primis.in@sociisnatoque.org','1994-08-26','16430603-9977',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-12-30 04:55:54','2018-09-26 11:57:37'),
	(66,'Soto','Jakeem','velit@etrisus.net','2011-02-27','16210524-2297',0,1,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-10-10 18:37:48','2017-06-28 14:09:53'),
	(67,'Fry','Blossom','justo@acnullaIn.net','2011-09-28','16020512-3037',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-11-16 01:35:47','2017-10-11 14:07:36'),
	(68,'Workman','Eve','sed@nislsemconsequat.edu','2012-07-01','16840218-9206',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-05-08 05:59:49','2018-10-08 04:51:31'),
	(69,'Walls','Chastity','per.inceptos.hymenaeos@hendreritidante.co.uk','1993-05-25','16170215-5506',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-10-03 00:47:36','2017-07-20 11:09:42'),
	(70,'Roth','Shad','id.libero.Donec@erosnon.com','1991-06-16','16570127-8086',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-03-27 13:00:46','2018-11-12 11:49:35'),
	(71,'Herman','Kennan','Proin@lectusCum.com','1989-11-28','16460929-0145',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-18 06:20:25','2018-01-04 23:22:01'),
	(72,'Warner','Iola','augue.id@Cras.net','1987-05-27','16120725-0646',0,1,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-07-07 22:17:36','2018-03-05 04:44:46'),
	(73,'Moss','Bradley','blandit.at.nisi@ultrices.net','2005-02-01','16700705-7578',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-05-05 19:02:37','2018-03-27 21:13:46'),
	(74,'Fitzpatrick','Pamela','ante.ipsum@est.edu','2017-10-23','16400826-3289',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-03-21 12:22:18','2018-07-26 04:17:18'),
	(75,'Gallagher','Sydnee','ac.facilisis@Aliquamultricesiaculis.co.uk','2005-07-25','16740810-0902',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2019-01-19 23:35:03','2018-02-10 01:59:54'),
	(76,'Austin','Marsden','Duis.at@cursus.edu','1991-07-15','16450721-8230',0,1,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-11-12 01:48:13','2018-08-05 07:25:26'),
	(77,'Buckner','Camden','purus.Nullam.scelerisque@gravidamaurisut.co.uk','2005-09-26','16590507-1162',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-11-18 19:28:13','2018-03-10 07:23:28'),
	(78,'Smith','Isaiah','Nam.nulla.magna@Nullamvelit.ca','2017-01-22','16231229-8223',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-08-04 22:16:24','2017-08-21 20:59:34'),
	(79,'Burks','Jacob','Nullam.ut.nisi@dolorsit.org','1981-05-21','16701007-6078',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-11-02 21:44:10','2017-05-21 09:32:59'),
	(80,'Powers','Yasir','a.felis.ullamcorper@magnaa.ca','2018-10-04','16720530-5407',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-10-02 16:42:36','2018-03-29 23:51:48'),
	(81,'Allison','Hilary','orci.luctus.et@magna.net','1988-03-30','16920118-6922',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-10-28 09:14:06','2017-09-07 10:52:29'),
	(82,'Davis','Rajah','Vestibulum.ut.eros@Inornaresagittis.edu','1991-06-04','16040607-6927',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2019-01-26 07:05:42','2019-02-04 12:14:23'),
	(83,'Cross','Latifah','arcu@non.org','1985-12-13','16690903-5880',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2019-01-08 14:07:02','2018-10-08 00:02:47'),
	(84,'Price','Bruno','quam@Fusce.net','1981-11-25','16240417-9224',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-11-06 08:09:08','2018-03-18 04:26:47'),
	(85,'Hale','Hakeem','luctus.aliquet.odio@mattis.net','1999-10-30','16031116-0493',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2019-04-09 20:50:16','2018-10-22 23:41:45'),
	(86,'Richardson','Orli','blandit.mattis.Cras@eratvolutpat.com','2001-12-14','16310126-3022',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-10 08:10:46','2018-02-12 07:21:11'),
	(87,'Herring','Demetrius','eu.tellus.Phasellus@Etiamimperdietdictum.edu','1988-06-13','16570524-5503',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-05-26 11:08:01','2019-01-22 13:46:52'),
	(88,'Chen','Vaughan','rutrum.lorem.ac@Pellentesque.net','1990-11-10','16630508-7816',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-09-16 18:21:29','2018-05-17 04:24:50'),
	(89,'Hale','Raven','in.hendrerit.consectetuer@nisimagna.edu','2000-09-06','16530906-9366',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-11-23 10:04:39','2019-03-30 08:35:33'),
	(90,'Gilliam','Reagan','magna.sed.dui@sagittis.co.uk','2004-08-07','16650306-2041',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2019-01-13 04:56:14','2018-09-30 11:50:05'),
	(91,'Cook','Lewis','imperdiet@justosit.edu','2004-03-25','16420707-8256',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-03-20 17:53:04','2019-01-25 01:54:16'),
	(92,'Wilkinson','Leila','eget.ipsum@molestie.co.uk','2010-01-19','16310815-9017',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-10-06 15:57:03','2017-05-15 01:51:20'),
	(93,'Compton','Damian','Aliquam@Crasdictumultricies.net','2010-02-25','16331225-1782',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-07-24 05:17:34','2017-11-28 13:10:45'),
	(94,'Britt','Sage','eleifend.nunc@bibendumsed.org','2018-08-09','16541114-4677',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-10-29 10:01:28','2019-01-05 22:56:34'),
	(95,'Holden','Michael','Nunc@dictumsapienAenean.co.uk','1985-12-09','16731221-7990',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-11-09 00:21:42','2019-03-28 22:38:26'),
	(96,'Gallegos','Jaden','Proin.non@sit.com','1986-05-26','16221029-8044',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-05-21 12:02:36','2018-11-07 12:52:38'),
	(97,'Valdez','Keefe','enim.Etiam@egestasAliquam.com','1994-03-03','16470222-6848',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-12-07 05:00:40','2017-05-12 07:24:15'),
	(98,'Rosales','Joelle','Duis@Sedauctor.ca','1998-11-26','16200607-2843',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-07-29 16:29:48','2017-06-23 00:00:29'),
	(99,'French','Keegan','ornare.facilisis.eget@loremvehicula.org','2003-02-13','16900415-2774',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2017-03-25 03:03:36','2017-04-29 04:16:07'),
	(100,'Ellis','Jana','sit.amet.consectetuer@mauris.org','1982-02-02','16990503-5268',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-05-15 16:47:13','2018-10-16 20:34:43'),
	(101,'Barr','Noelle','nascetur.ridiculus@atfringillapurus.net','2013-08-27','16370106-1651',0,0,0,0,NULL,NULL,NULL,NULL,NULL,0,NULL,'2018-02-28 21:40:31','2018-05-11 14:45:50'),
	(102,'Jane','Doe','jane@example.com','1996-09-25','$2y$10$qWPkJ27dVSDzGQ5xbAhmf.MdfgOZLmguSqUq5NdzpnvuxbpjBVFuW',1,0,1,0,NULL,'cus_CpwoSQx5O9Y9yy','Visa','4242',NULL,0,'DengXRW2MPImFxovIPRwW2RUM6jaJjxwGRO9xGXhskon8e7QFxSYS4Dw5tFe','2018-04-29 14:01:35','2018-05-14 14:08:21');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
