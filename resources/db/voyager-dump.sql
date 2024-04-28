-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: skillbox_laravel
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_rows` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int unsigned NOT NULL,
  `field` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `order` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (1,1,'id','number','ID',1,0,0,0,0,0,NULL,1),(2,1,'name','text','Имя',1,1,1,1,1,1,NULL,2),(3,1,'email','text','Email',1,1,1,1,1,1,NULL,3),(4,1,'password','password','Пароль',1,0,0,1,1,0,NULL,4),(5,1,'remember_token','text','Токен восстановления',0,0,0,0,0,0,NULL,5),(6,1,'created_at','timestamp','Дата создания',0,1,1,0,0,0,NULL,6),(7,1,'updated_at','timestamp','Дата обновления',0,0,0,0,0,0,NULL,7),(8,1,'avatar','image','Аватар',0,1,1,1,1,1,NULL,8),(9,1,'user_belongsto_role_relationship','relationship','Роль',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsTo\",\"column\":\"role_id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"roles\",\"pivot\":0}',10),(10,1,'user_belongstomany_role_relationship','relationship','Roles',0,1,1,1,1,0,'{\"model\":\"TCG\\\\Voyager\\\\Models\\\\Role\",\"table\":\"roles\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"display_name\",\"pivot_table\":\"user_roles\",\"pivot\":\"1\",\"taggable\":\"0\"}',11),(11,1,'settings','hidden','Settings',0,0,0,0,0,0,NULL,12),(12,2,'id','number','ID',1,0,0,0,0,0,NULL,1),(13,2,'name','text','Имя',1,1,1,1,1,1,NULL,2),(14,2,'created_at','timestamp','Дата создания',0,0,0,0,0,0,NULL,3),(15,2,'updated_at','timestamp','Дата обновления',0,0,0,0,0,0,NULL,4),(16,3,'id','number','ID',1,0,0,0,0,0,NULL,1),(17,3,'name','text','Имя',1,1,1,1,1,1,NULL,2),(18,3,'created_at','timestamp','Дата создания',0,0,0,0,0,0,NULL,3),(19,3,'updated_at','timestamp','Дата обновления',0,0,0,0,0,0,NULL,4),(20,3,'display_name','text','Отображаемое имя',1,1,1,1,1,1,NULL,5),(21,1,'role_id','text','Роль',1,1,1,1,1,1,NULL,9),(22,4,'id','text','Id',1,1,1,0,0,0,'{}',1),(23,4,'name','text','Name',1,1,1,1,1,1,'{}',2),(24,4,'created_at','timestamp','Created At',0,1,1,0,0,0,'{}',3),(25,4,'updated_at','timestamp','Updated At',0,1,1,0,0,0,'{}',4),(26,5,'id','text','Id',1,1,1,0,0,0,'{}',1),(27,5,'name','text','Name',1,1,1,1,1,1,'{}',2),(28,5,'description','text','Description',1,1,1,1,1,1,'{}',3),(29,5,'poster_url','image','Poster Url',1,1,1,1,1,1,'{}',4),(30,5,'address','text','Address',1,1,1,1,1,1,'{}',5),(31,5,'created_at','timestamp','Created At',0,1,1,0,0,0,'{}',6),(32,5,'updated_at','timestamp','Updated At',0,1,1,0,0,0,'{}',7),(34,6,'id','text','Id',1,1,1,0,0,0,'{}',1),(35,6,'name','text','Name',1,1,1,1,1,1,'{}',3),(36,6,'description','text','Description',1,1,1,1,1,1,'{}',4),(37,6,'poster_url','image','Poster Url',1,1,1,1,1,1,'{}',5),(38,6,'floor_area','number','Floor Area',1,1,1,1,1,1,'{}',6),(39,6,'type','text','Type',1,1,1,1,1,1,'{}',7),(40,6,'price','number','Price',1,1,1,1,1,1,'{}',8),(41,6,'created_at','timestamp','Created At',0,1,1,0,0,0,'{}',9),(42,6,'updated_at','timestamp','Updated At',0,1,1,0,0,0,'{}',10),(43,6,'hotel_id','text','Hotel Id',1,1,1,1,1,1,'{}',2),(44,5,'hotel_hasmany_room_relationship','relationship','rooms',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\Room\",\"table\":\"rooms\",\"type\":\"hasMany\",\"column\":\"hotel_id\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"bookings\",\"pivot\":\"0\",\"taggable\":\"0\"}',9),(45,6,'room_belongsto_hotel_relationship','relationship','hotels',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\Hotel\",\"table\":\"hotels\",\"type\":\"belongsTo\",\"column\":\"hotel_id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"bookings\",\"pivot\":\"0\",\"taggable\":\"0\"}',11),(46,6,'room_belongstomany_facility_relationship','relationship','facilities',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\Facility\",\"table\":\"facilities\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"facility_room\",\"pivot\":\"1\",\"taggable\":\"on\"}',12),(47,5,'hotel_belongstomany_facility_relationship','relationship','facilities',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\Facility\",\"table\":\"facilities\",\"type\":\"belongsToMany\",\"column\":\"id\",\"key\":\"id\",\"label\":\"name\",\"pivot_table\":\"facility_hotel\",\"pivot\":\"1\",\"taggable\":\"on\"}',10),(48,7,'id','text','Id',1,1,1,0,0,0,'{}',1),(49,7,'started_at','date','Started At',1,1,1,0,0,0,'{}',4),(50,7,'finished_at','date','Finished At',1,1,1,0,0,0,'{}',5),(51,7,'days','number','Days',0,1,1,0,0,0,'{}',6),(52,7,'price','number','Price',1,1,1,0,0,0,'{}',7),(53,7,'created_at','timestamp','Created At',0,1,1,0,0,0,'{}',8),(54,7,'updated_at','timestamp','Updated At',0,0,0,0,0,0,'{}',9),(55,7,'room_id','text','Room Id',1,1,1,0,0,0,'{}',2),(56,7,'user_id','text','User Id',1,1,1,0,0,0,'{}',3),(57,7,'verified_at','text','Verified At',0,1,1,0,0,0,'{}',10),(58,7,'booking_belongsto_room_relationship','relationship','rooms',0,1,1,0,0,0,'{\"model\":\"App\\\\Models\\\\Room\",\"table\":\"rooms\",\"type\":\"belongsTo\",\"column\":\"room_id\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"bookings\",\"pivot\":\"0\",\"taggable\":\"0\"}',11),(59,7,'booking_belongsto_user_relationship','relationship','users',0,1,1,0,0,0,'{\"model\":\"App\\\\Models\\\\User\",\"table\":\"users\",\"type\":\"belongsTo\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"email\",\"pivot_table\":\"bookings\",\"pivot\":\"0\",\"taggable\":\"0\"}',12),(60,1,'user_hasmany_booking_relationship','relationship','bookings',0,1,1,1,1,1,'{\"model\":\"App\\\\Models\\\\Booking\",\"table\":\"bookings\",\"type\":\"hasMany\",\"column\":\"user_id\",\"key\":\"id\",\"label\":\"id\",\"pivot_table\":\"bookings\",\"pivot\":\"0\",\"taggable\":null}',13);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `data_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint NOT NULL DEFAULT '0',
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (1,'users','users','Пользователь','Пользователи','voyager-person','TCG\\Voyager\\Models\\User','TCG\\Voyager\\Policies\\UserPolicy','TCG\\Voyager\\Http\\Controllers\\VoyagerUserController','',1,0,NULL,'2024-02-23 06:12:38','2024-02-23 06:12:38'),(2,'menus','menus','Меню','Меню','voyager-list','TCG\\Voyager\\Models\\Menu',NULL,'','',1,0,NULL,'2024-02-23 06:12:38','2024-02-23 06:12:38'),(3,'roles','roles','Роль','Роли','voyager-lock','TCG\\Voyager\\Models\\Role',NULL,'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController','',1,0,NULL,'2024-02-23 06:12:38','2024-02-23 06:12:38'),(4,'facilities','facilities','Facility','Facilities',NULL,'App\\Models\\Facility',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null}','2024-02-23 06:13:29','2024-02-23 06:13:29'),(5,'hotels','hotels','Hotel','Hotels',NULL,'App\\Models\\Hotel',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2024-02-23 06:13:50','2024-02-23 18:43:29'),(6,'rooms','rooms','Room','Rooms',NULL,'App\\Models\\Room',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2024-02-23 08:30:38','2024-02-23 08:36:15'),(7,'bookings','bookings','Booking','Bookings',NULL,'App\\Models\\Booking',NULL,NULL,NULL,1,0,'{\"order_column\":null,\"order_display_column\":null,\"order_direction\":\"asc\",\"default_search_key\":null,\"scope\":null}','2024-02-23 18:34:39','2024-02-23 18:37:29');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2024-02-23 06:12:38','2024-02-23 06:12:38');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int unsigned DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Панель управления','','_self','voyager-boat',NULL,NULL,1,'2024-02-23 06:12:38','2024-02-23 06:12:38','voyager.dashboard',NULL),(2,1,'Медиа','','_self','voyager-images',NULL,NULL,5,'2024-02-23 06:12:38','2024-02-23 06:12:38','voyager.media.index',NULL),(3,1,'Пользователи','','_self','voyager-person',NULL,NULL,3,'2024-02-23 06:12:38','2024-02-23 06:12:38','voyager.users.index',NULL),(4,1,'Роли','','_self','voyager-lock',NULL,NULL,2,'2024-02-23 06:12:38','2024-02-23 06:12:38','voyager.roles.index',NULL),(5,1,'Инструменты','','_self','voyager-tools',NULL,NULL,9,'2024-02-23 06:12:38','2024-02-23 06:12:38',NULL,NULL),(6,1,'Конструктор Меню','','_self','voyager-list',NULL,5,10,'2024-02-23 06:12:39','2024-02-23 06:12:39','voyager.menus.index',NULL),(7,1,'База данных','','_self','voyager-data',NULL,5,11,'2024-02-23 06:12:39','2024-02-23 06:12:39','voyager.database.index',NULL),(8,1,'Compass','','_self','voyager-compass',NULL,5,12,'2024-02-23 06:12:39','2024-02-23 06:12:39','voyager.compass.index',NULL),(9,1,'BREAD','','_self','voyager-bread',NULL,5,13,'2024-02-23 06:12:39','2024-02-23 06:12:39','voyager.bread.index',NULL),(10,1,'Настройки','','_self','voyager-settings',NULL,NULL,14,'2024-02-23 06:12:39','2024-02-23 06:12:39','voyager.settings.index',NULL),(11,1,'Facilities','','_self',NULL,NULL,NULL,15,'2024-02-23 06:13:30','2024-02-23 06:13:30','voyager.facilities.index',NULL),(12,1,'Hotels','','_self',NULL,NULL,NULL,16,'2024-02-23 06:13:50','2024-02-23 06:13:50','voyager.hotels.index',NULL),(13,1,'Rooms','','_self',NULL,NULL,NULL,17,'2024-02-23 08:30:38','2024-02-23 08:30:38','voyager.rooms.index',NULL),(14,1,'Bookings','','_self',NULL,NULL,NULL,18,'2024-02-23 18:34:40','2024-02-23 18:34:40','voyager.bookings.index',NULL);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Администратор','2024-02-23 06:12:39','2024-02-23 06:12:39'),(2,'user','Обычный Пользователь','2024-02-23 06:12:39','2024-02-23 06:12:39');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '1',
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'site.title','Название Сайта','Название Сайта','','text',1,'Site'),(2,'site.description','Описание Сайта','Описание Сайта','','text',2,'Site'),(3,'site.logo','Логотип Сайта','','','image',3,'Site'),(4,'site.google_analytics_tracking_id','Google Analytics Tracking ID','','','text',4,'Site'),(5,'admin.bg_image','Фоновое Изображение для Админки','','','image',5,'Admin'),(6,'admin.title','Название Админки','Voyager','','text',1,'Admin'),(7,'admin.description','Описание Админки','Добро пожаловать в Voyager. Пропавшую Админку для Laravel','','text',2,'Admin'),(8,'admin.loader','Загрузчик Админки','','','image',3,'Admin'),(9,'admin.icon_image','Иконка Админки','','','image',4,'Admin'),(10,'admin.google_analytics_client_id','Google Analytics Client ID (используется для панели администратора)','','','text',1,'Admin');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2024-02-23 06:12:39','2024-02-23 06:12:39'),(2,'browse_bread',NULL,'2024-02-23 06:12:39','2024-02-23 06:12:39'),(3,'browse_database',NULL,'2024-02-23 06:12:39','2024-02-23 06:12:39'),(4,'browse_media',NULL,'2024-02-23 06:12:39','2024-02-23 06:12:39'),(5,'browse_compass',NULL,'2024-02-23 06:12:39','2024-02-23 06:12:39'),(6,'browse_menus','menus','2024-02-23 06:12:39','2024-02-23 06:12:39'),(7,'read_menus','menus','2024-02-23 06:12:39','2024-02-23 06:12:39'),(8,'edit_menus','menus','2024-02-23 06:12:39','2024-02-23 06:12:39'),(9,'add_menus','menus','2024-02-23 06:12:39','2024-02-23 06:12:39'),(10,'delete_menus','menus','2024-02-23 06:12:39','2024-02-23 06:12:39'),(11,'browse_roles','roles','2024-02-23 06:12:39','2024-02-23 06:12:39'),(12,'read_roles','roles','2024-02-23 06:12:39','2024-02-23 06:12:39'),(13,'edit_roles','roles','2024-02-23 06:12:39','2024-02-23 06:12:39'),(14,'add_roles','roles','2024-02-23 06:12:39','2024-02-23 06:12:39'),(15,'delete_roles','roles','2024-02-23 06:12:39','2024-02-23 06:12:39'),(16,'browse_users','users','2024-02-23 06:12:39','2024-02-23 06:12:39'),(17,'read_users','users','2024-02-23 06:12:39','2024-02-23 06:12:39'),(18,'edit_users','users','2024-02-23 06:12:39','2024-02-23 06:12:39'),(19,'add_users','users','2024-02-23 06:12:39','2024-02-23 06:12:39'),(20,'delete_users','users','2024-02-23 06:12:39','2024-02-23 06:12:39'),(21,'browse_settings','settings','2024-02-23 06:12:39','2024-02-23 06:12:39'),(22,'read_settings','settings','2024-02-23 06:12:39','2024-02-23 06:12:39'),(23,'edit_settings','settings','2024-02-23 06:12:39','2024-02-23 06:12:39'),(24,'add_settings','settings','2024-02-23 06:12:39','2024-02-23 06:12:39'),(25,'delete_settings','settings','2024-02-23 06:12:39','2024-02-23 06:12:39'),(26,'browse_facilities','facilities','2024-02-23 06:13:30','2024-02-23 06:13:30'),(27,'read_facilities','facilities','2024-02-23 06:13:30','2024-02-23 06:13:30'),(28,'edit_facilities','facilities','2024-02-23 06:13:30','2024-02-23 06:13:30'),(29,'add_facilities','facilities','2024-02-23 06:13:30','2024-02-23 06:13:30'),(30,'delete_facilities','facilities','2024-02-23 06:13:30','2024-02-23 06:13:30'),(31,'browse_hotels','hotels','2024-02-23 06:13:50','2024-02-23 06:13:50'),(32,'read_hotels','hotels','2024-02-23 06:13:50','2024-02-23 06:13:50'),(33,'edit_hotels','hotels','2024-02-23 06:13:50','2024-02-23 06:13:50'),(34,'add_hotels','hotels','2024-02-23 06:13:50','2024-02-23 06:13:50'),(35,'delete_hotels','hotels','2024-02-23 06:13:50','2024-02-23 06:13:50'),(36,'browse_rooms','rooms','2024-02-23 08:30:38','2024-02-23 08:30:38'),(37,'read_rooms','rooms','2024-02-23 08:30:38','2024-02-23 08:30:38'),(38,'edit_rooms','rooms','2024-02-23 08:30:38','2024-02-23 08:30:38'),(39,'add_rooms','rooms','2024-02-23 08:30:38','2024-02-23 08:30:38'),(40,'delete_rooms','rooms','2024-02-23 08:30:38','2024-02-23 08:30:38'),(41,'browse_bookings','bookings','2024-02-23 18:34:40','2024-02-23 18:34:40'),(42,'read_bookings','bookings','2024-02-23 18:34:40','2024-02-23 18:34:40'),(43,'edit_bookings','bookings','2024-02-23 18:34:40','2024-02-23 18:34:40'),(44,'add_bookings','bookings','2024-02-23 18:34:40','2024-02-23 18:34:40'),(45,'delete_bookings','bookings','2024-02-23 18:34:40','2024-02-23 18:34:40');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-24  0:57:08
