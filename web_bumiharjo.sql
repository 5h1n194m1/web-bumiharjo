-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: web_bumiharjo
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `gallery_items`
--

DROP TABLE IF EXISTS `gallery_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_items` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_general_ci,
  `media_type` varchar(20) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'image',
  `image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_items`
--

LOCK TABLES `gallery_items` WRITE;
/*!40000 ALTER TABLE `gallery_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallery_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hero_slides`
--

DROP TABLE IF EXISTS `hero_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hero_slides` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subtitle` text COLLATE utf8mb4_general_ci,
  `button_text` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hero_slides`
--

LOCK TABLES `hero_slides` WRITE;
/*!40000 ALTER TABLE `hero_slides` DISABLE KEYS */;
INSERT INTO `hero_slides` VALUES (1,'Selamat Datang di Balkondes Bumiharjo','Jantungnya Kampoeng Dolanan & Kuliner. Temukan kembali hangatnya kebersamaan dan kenangan masa kecil di pelukan alam Borobudur.','Eksplorasi Sekarang','#layanan',NULL,1,1,'2026-04-05 02:14:39','2026-04-05 02:14:39');
/*!40000 ALTER TABLE `hero_slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026-04-05-010100','App\\Database\\Migrations\\CreateUsersTable','default','App',1775330021,1),(2,'2026-04-05-010110','App\\Database\\Migrations\\CreateSiteSettingsTable','default','App',1775330021,1),(3,'2026-04-05-010120','App\\Database\\Migrations\\CreateHeroSlidesTable','default','App',1775330021,1),(4,'2026-04-05-010130','App\\Database\\Migrations\\CreateServicesTable','default','App',1775330021,1),(5,'2026-04-05-010140','App\\Database\\Migrations\\CreateGalleryItemsTable','default','App',1775330021,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'🏠','Penginapan & Homestay','Bayangkan bangun tidur disambut embun pagi dan pemandangan sawah yang menyejukkan mata. Menginap di homestay kami berarti kembali ke pelukan alam, menikmati ketenangan sejati dengan fasilitas yang nyaman dan terasa seperti di rumah sendiri.',1,1,'2026-04-05 02:14:39','2026-04-05 02:14:39'),(2,'🎪','Venue Acara Spesial','Jadikan hamparan sawah dan nuansa tradisional pendopo kami sebagai saksi hari bahagiamu. Area kami yang luas dan asri sangat sempurna untuk disewa sebagai venue Wedding, Reuni, Bukber, Meeting, hingga acara komunitas.',2,1,'2026-04-05 02:14:39','2026-04-05 02:14:39'),(3,'🚙','Eksplorasi Mobil VW','Nikmati semilir angin melintasi hijaunya persawahan dan sudut-sudut eksotis Borobudur dengan gaya klasik. Trip menggunakan mobil VW Safari kami siap membawamu bertualang menyusuri pesona desa.',3,1,'2026-04-05 02:14:39','2026-04-05 02:14:39');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `site_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Balkondes Bumiharjo',
  `hero_headline` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hero_subheadline` text COLLATE utf8mb4_general_ci,
  `about_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `about_content` text COLLATE utf8mb4_general_ci,
  `services_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `services_intro` text COLLATE utf8mb4_general_ci,
  `footer_title` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `maps_embed_url` text COLLATE utf8mb4_general_ci,
  `opening_hours` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `whatsapp_number` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `whatsapp_message` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site_settings`
--

LOCK TABLES `site_settings` WRITE;
/*!40000 ALTER TABLE `site_settings` DISABLE KEYS */;
INSERT INTO `site_settings` VALUES (1,'Balkondes Bumiharjo','Selamat Datang di Balkondes Bumiharjo','Jantungnya Kampoeng Dolanan & Kuliner. Temukan kembali hangatnya kebersamaan dan kenangan masa kecil di pelukan alam Borobudur.','Merawat Tradisi, Merayakan Kebersamaan','Di Balkondes & Homestay Bumiharjo, waktu seolah berjalan lebih lambat. Kami bukan sekadar tempat singgah, melainkan ruang untuk bernostalgia. Sebagai Kampoeng Dolanan & Kuliner, kami menghidupkan kembali permainan tradisional yang sarat makna dan menyajikan resep rahasia warisan leluhur. Di sini, setiap sudut dirancang agar kamu bisa tertawa lepas, bersantai, dan sejenak melupakan penatnya rutinitas.','Sempurnakan Momenmu di Tengah Hamparan Hijau','Dikelilingi oleh indahnya lanskap sawah yang luas membentang dan hembusan angin segar pedesaan, Balkondes Bumiharjo siap melengkapi setiap cerita perjalanan dan perayaanmu.','Mari Berkunjung','Jl. Sentanu, Jetis Gayu, Bumiharjo, Kec. Borobudur, Kabupaten Magelang, Jawa Tengah 56553.','','Buka Setiap Hari (08.00 - 20.00 WIB)','6281234567890','Halo admin Balkondes Bumiharjo, saya ingin bertanya tentang reservasi.','2026-04-05 02:14:39','2026-04-05 02:14:39');
/*!40000 ALTER TABLE `site_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_login_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Web Bumiharjo','admin','admin@web-bumiharjo.test','$2y$10$Cfkhdy76qsz8XBh128Qu9O7ksBYBZmPbCnR1f4HO/91quxz8Y5QGa','admin',1,NULL,'2026-04-05 02:14:39','2026-04-05 02:14:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-09 22:59:26
