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
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilizador_id` int NOT NULL,
  `autor_id` int NOT NULL,
  `editora_id` int NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sinopse` text COLLATE utf8mb4_general_ci,
  `isbn` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idioma` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ano_publicacao` year DEFAULT NULL,
  `numero_paginas` int DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT '0.00',
  `compravel` tinyint(1) DEFAULT '1',
  `legivel_no_site` tinyint(1) DEFAULT '1',
  `url_imagem_capa` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caminho_pdf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` enum('rascunho','publicado','arquivado') COLLATE utf8mb4_general_ci DEFAULT 'rascunho',
  `removido` tinyint(1) DEFAULT '0',
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `utilizador_id` (`utilizador_id`),
  KEY `autor_id` (`autor_id`),
  KEY `editora_id` (`editora_id`),
  CONSTRAINT `livros_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`),
  CONSTRAINT `livros_ibfk_2` FOREIGN KEY (`autor_id`) REFERENCES `autores` (`id`),
  CONSTRAINT `livros_ibfk_3` FOREIGN KEY (`editora_id`) REFERENCES `editoras` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (6,4,1,1,'Apostila PHP teste',NULL,'978-85-333-0227-3','Português',2020,10000,10000.00,1,1,NULL,NULL,'rascunho',1,'2026-05-13 10:41:28','2026-05-13 11:22:13'),(7,4,1,1,'Apostila PHP  III',NULL,'978-85-333-0227-3','Português',2020,1000,10000.00,1,1,NULL,NULL,'rascunho',1,'2026-05-13 11:22:40','2026-05-13 15:31:57'),(8,4,1,1,'xfv',NULL,'978-85-333-0227-3','Português',2021,3,1000.00,1,1,NULL,NULL,'rascunho',1,'2026-05-13 14:26:39','2026-05-13 14:26:43'),(9,4,1,1,'Apostila PHP',NULL,'978-85-333-0227-3','Português',2023,1000,10000.00,1,1,'1778682696_images.png',NULL,'rascunho',0,'2026-05-13 15:31:37','2026-05-13 15:31:37'),(10,4,1,1,'HTML',NULL,'978-85-333-0227-3','Português',2022,2000,30000.00,1,1,'1778697377_ACESSO ADMIN.png',NULL,'rascunho',0,'2026-05-13 19:36:17','2026-05-13 19:36:17');
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-14 12:00:28
