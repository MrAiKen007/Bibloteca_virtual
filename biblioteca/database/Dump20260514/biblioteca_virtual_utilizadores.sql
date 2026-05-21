-- MySQL dump 10.13  Distrib 8.0.45, for Win64 (x86_64)
--
-- Host: localhost    Database: biblioteca_virtual
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `utilizadores`
--

DROP TABLE IF EXISTS `utilizadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utilizadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `palavra_passe` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `papel` enum('admin','backoffice','cliente') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'cliente',
  `ativo` tinyint(1) DEFAULT '1',
  `email_verificado` tinyint(1) DEFAULT '0',
  `ultimo_login` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilizadores`
--

LOCK TABLES `utilizadores` WRITE;
/*!40000 ALTER TABLE `utilizadores` DISABLE KEYS */;
INSERT INTO `utilizadores` VALUES (4,'Administrador Principal','admin@biblioteca.com','$2y$10$Sq7Vmh0iUGmGNOacbotL6OcGb7zY18W1TCHu0wnCr7gCLvrgBUcHC','admin',1,0,NULL,'2026-05-12 08:02:39','2026-05-12 23:30:18'),(5,'Ricardo','ricardoacliver7@gmail.com','$2y$10$ad5uHApIJekvFqF1Vb8dwOWNOWu7Tl6MCPCoiScb5OR2h6dExVC1.','cliente',1,0,NULL,'2026-05-14 00:19:58','2026-05-14 00:19:58'),(6,'Ana Paulo','anapaulo@gmail.com','$2y$10$/Sm0dtuwfd9hXB1/krQhferYUK/k9480rSTHiP8OWUoiaRgDc5sVm','cliente',1,0,NULL,'2026-05-14 02:30:26','2026-05-14 02:30:26'),(7,'Andre Marcos','andre@gmail.com','$2y$10$oBCkNYuS1Zn7ktnbVgdljuqmapYYdpa2nNyNCZkmB44/A0TZNnoSC','cliente',1,0,NULL,'2026-05-14 08:45:12','2026-05-14 08:45:12'),(8,'Carla Pacheco','carla@gmail.com','$2y$10$U.GeTNKkySYvNLbQsEVHMu8OmCuRMP3dZHX2/.3eD3ess19LaJaka','backoffice',1,0,NULL,'2026-05-14 08:55:31','2026-05-14 08:55:31'),(9,'Pedro','pedro@gmail.com','$2y$10$0wIpC27mFoSnbKG.Dt22Ee7yk47jv6SKLwt72fMws4TgJ3McX6pZe','cliente',1,0,NULL,'2026-05-14 09:20:03','2026-05-14 09:20:03'),(10,'back','back@gmail.com','$2y$10$KkQLVLD41q87Ocv4/hRihe3/Lh10nwPuWgjzSow4gYspTZswJImkC','backoffice',1,0,NULL,'2026-05-14 11:19:45','2026-05-14 11:19:45');
/*!40000 ALTER TABLE `utilizadores` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-14 12:00:26
