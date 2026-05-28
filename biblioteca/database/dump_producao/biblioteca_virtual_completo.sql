-- ============================================
-- BIBLIO - Complete Database Dump
-- Generated: 2026-05-28 07:32:47
-- Suitable for phpMyAdmin import
-- ============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `utilizadores`
--
DROP TABLE IF EXISTS `utilizadores`;
CREATE TABLE `utilizadores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `palavra_passe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `papel` enum('admin','backoffice','cliente') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'cliente',
  `ativo` tinyint(1) DEFAULT '1',
  `email_verificado` tinyint(1) DEFAULT '0',
  `ultimo_login` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilizadores`
--
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('4', 'Administrador Principal', 'admin@biblioteca.com', '$2y$10$Sq7Vmh0iUGmGNOacbotL6OcGb7zY18W1TCHu0wnCr7gCLvrgBUcHC', 'admin', '1', '0', NULL, '2026-05-12 08:02:39', '2026-05-12 23:30:18');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('5', 'Ricardo', 'ricardoacliver7@gmail.com', '$2y$10$ad5uHApIJekvFqF1Vb8dwOWNOWu7Tl6MCPCoiScb5OR2h6dExVC1.', 'cliente', '1', '0', NULL, '2026-05-14 00:19:58', '2026-05-14 00:19:58');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('6', 'Ana Paulo', 'anapaulo@gmail.com', '$2y$10$/Sm0dtuwfd9hXB1/krQhferYUK/k9480rSTHiP8OWUoiaRgDc5sVm', 'cliente', '1', '0', NULL, '2026-05-14 02:30:26', '2026-05-14 02:30:26');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('7', 'Andre Marcos', 'andre@gmail.com', '$2y$10$oBCkNYuS1Zn7ktnbVgdljuqmapYYdpa2nNyNCZkmB44/A0TZNnoSC', 'cliente', '1', '0', NULL, '2026-05-14 08:45:12', '2026-05-14 08:45:12');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('8', 'Carla Pacheco', 'carla@gmail.com', '$2y$10$U.GeTNKkySYvNLbQsEVHMu8OmCuRMP3dZHX2/.3eD3ess19LaJaka', 'backoffice', '1', '0', NULL, '2026-05-14 08:55:31', '2026-05-14 08:55:31');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('9', 'Pedro', 'pedro@gmail.com', '$2y$10$0wIpC27mFoSnbKG.Dt22Ee7yk47jv6SKLwt72fMws4TgJ3McX6pZe', 'cliente', '1', '0', NULL, '2026-05-14 09:20:03', '2026-05-14 09:20:03');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('10', 'back', 'back@gmail.com', '$2y$10$KkQLVLD41q87Ocv4/hRihe3/Lh10nwPuWgjzSow4gYspTZswJImkC', 'backoffice', '1', '0', NULL, '2026-05-14 11:19:45', '2026-05-14 11:19:45');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('12', 'Test User', 'test1778789768@example.com', '$2y$10$mfn.uBnzj9j/C94bob4vhuPLDGq.ii8Hb4sIYj.GVj7EV7XF72tTq', 'cliente', '1', '0', NULL, '2026-05-14 21:16:08', '2026-05-14 21:16:08');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('13', 'GNerd', 'gkleber187@gmail.com', '$2y$10$NWMj9DMI9z3Y1N/4eDe/uOXwFmQFCzp/3o.jkDbw7x7gQdwqh2qKG', 'cliente', '1', '0', NULL, '2026-05-14 21:36:09', '2026-05-14 21:36:09');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('14', 'Administrador Geral', 'admin@biblio.com', '$2y$10$Ed972/w8472Sozk2W7k7LOj3tlvk8NsSUIRFOqW1F9cImg/0qHiL.', 'admin', '1', '1', NULL, '2026-05-14 21:51:15', '2026-05-14 21:51:15');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('15', 'x', 'x@biblo.com', '$2y$10$h2V0iL8RHVGT/4jvjTH5Su2IAw5X9cx/BAO9lH5HwBWk8Fi3WXjku', 'backoffice', '1', '0', NULL, '2026-05-16 17:42:51', '2026-05-16 17:42:51');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('16', 'Alok', 'alok@gmail.com', '$2y$10$o6533jYsBgCADuUkbDOzleOxMzCcvklEx6MWCxRj7whHcjCciPIXq', 'cliente', '1', '0', NULL, '2026-05-17 20:09:10', '2026-05-17 20:09:10');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('17', 'Bony', 'bony@gmail.com', '$2y$10$43waDiBoLr1CZRwxzg7YoOFgcy18ahQGDiYzXaICg3QUVmdqiIFqa', 'cliente', '1', '0', NULL, '2026-05-18 07:52:31', '2026-05-18 07:52:31');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('18', 'Kley', 'kely@biblo.com', '$2y$10$jzaJBUTFAdDWSohmswz84OFeFkQ5GW/PN.yaBnXcNGBRCgdEyI30O', 'backoffice', '1', '0', NULL, '2026-05-18 08:01:01', '2026-05-18 08:01:01');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('19', 'N', 'n@gmail.com', '$2y$10$q5.VdpVZ5mbz6svVeDjOTO8ZouJmR7P.7w9MdRwZv5puBIrf/.EXG', 'cliente', '1', '0', NULL, '2026-05-27 21:03:21', '2026-05-27 21:03:21');
INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES ('20', 'TestUser', 'test123456@test.com', '$2y$10$5WJbbsz0Qn92P5FAO551vOhsFsxwkIvRDhXEVkKUqnuoiVmIdt.BO', 'cliente', '1', '0', NULL, '2026-05-27 21:08:50', '2026-05-27 21:08:50');

--
-- Table structure for table `autores`
--
DROP TABLE IF EXISTS `autores`;
CREATE TABLE `autores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `biografia` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `autores`
--
INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES ('1', 'Autor TemporÃ¡rio', NULL, '2026-05-13 10:36:49');
INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES ('7', 'Aiken', ',  , kkll', '2026-05-17 17:05:05');
INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES ('9', 'Antonio', 'SSSSS', '2026-05-18 08:08:58');
INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES ('10', 'Elle Kennedy', '', '2026-05-21 10:46:44');
INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES ('11', 'Jennifer Lynn Barnes', '', '2026-05-21 10:52:08');
INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES ('12', 'Rebecca Yarros', '', '2026-05-21 10:55:16');
INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES ('13', 'Robert Mayer', '', '2026-05-21 11:16:53');
INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES ('14', 'Robert Greene', '', '2026-05-21 11:19:21');
INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES ('15', 'Mark Manson', '', '2026-05-21 11:22:04');

--
-- Table structure for table `editoras`
--
DROP TABLE IF EXISTS `editoras`;
CREATE TABLE `editoras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pais` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `editoras`
--
INSERT INTO `editoras` (`id`, `nome`, `pais`, `criado_em`) VALUES ('1', 'Editora TemporÃ¡ria', 'Angola', '2026-05-13 10:41:02');
INSERT INTO `editoras` (`id`, `nome`, `pais`, `criado_em`) VALUES ('5', 'Aiken', 'Geria', '2026-05-17 17:07:26');
INSERT INTO `editoras` (`id`, `nome`, `pais`, `criado_em`) VALUES ('6', 'Intrínseca', '', '2026-05-21 10:47:02');
INSERT INTO `editoras` (`id`, `nome`, `pais`, `criado_em`) VALUES ('7', 'Sextante', '', '2026-05-21 11:17:03');
INSERT INTO `editoras` (`id`, `nome`, `pais`, `criado_em`) VALUES ('8', 'Rocco', '', '2026-05-21 11:19:39');

--
-- Table structure for table `generos`
--
DROP TABLE IF EXISTS `generos`;
CREATE TABLE `generos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `generos`
--
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('1', 'Negócios', NULL, '2026-05-17 19:41:29');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('2', 'Ficção', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('3', 'Romance', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('4', 'Mistério', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('5', 'Fantasia', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('6', 'Ficção Científica', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('7', 'Biografia', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('8', 'História', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('9', 'Autoajuda', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('10', 'Negócios', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('11', 'Tecnologia', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('12', 'Poesia', NULL, '2026-05-17 20:12:36');
INSERT INTO `generos` (`id`, `nome`, `descricao`, `criado_em`) VALUES ('13', 'Infantil', NULL, '2026-05-17 20:12:36');

--
-- Table structure for table `tags`
--
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--
INSERT INTO `tags` (`id`, `nome`, `criado_em`) VALUES ('1', 'clássico', '2026-05-17 19:41:29');
INSERT INTO `tags` (`id`, `nome`, `criado_em`) VALUES ('2', 'português', '2026-05-17 19:41:29');
INSERT INTO `tags` (`id`, `nome`, `criado_em`) VALUES ('3', 'novidade', '2026-05-18 08:08:05');
INSERT INTO `tags` (`id`, `nome`, `criado_em`) VALUES ('4', 'saga', '2026-05-18 08:08:05');
INSERT INTO `tags` (`id`, `nome`, `criado_em`) VALUES ('5', 'bestseller', '2026-05-21 10:49:01');
INSERT INTO `tags` (`id`, `nome`, `criado_em`) VALUES ('6', 'premiado', '2026-05-21 10:54:34');

--
-- Table structure for table `livros`
--
DROP TABLE IF EXISTS `livros`;
CREATE TABLE `livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilizador_id` int NOT NULL,
  `autor_id` int NOT NULL,
  `editora_id` int NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sinopse` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `isbn` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idioma` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ano_publicacao` year DEFAULT NULL,
  `numero_paginas` int DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT '0.00',
  `compravel` tinyint(1) DEFAULT '1',
  `legivel_no_site` tinyint(1) DEFAULT '1',
  `url_imagem_capa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `caminho_pdf` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` enum('rascunho','publicado','arquivado') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'rascunho',
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livros`
--
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('6', '4', '1', '1', 'Apostila PHP teste', NULL, '978-85-333-0227-3', 'PortuguÃªs', '2020', '10000', '10000.00', '1', '1', NULL, NULL, 'rascunho', '1', '2026-05-13 10:41:28', '2026-05-13 11:22:13');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('7', '4', '1', '1', 'Apostila PHP  III', NULL, '978-85-333-0227-3', 'PortuguÃªs', '2020', '1000', '10000.00', '1', '1', NULL, NULL, 'rascunho', '1', '2026-05-13 11:22:40', '2026-05-13 15:31:57');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('8', '4', '1', '1', 'xfv', NULL, '978-85-333-0227-3', 'PortuguÃªs', '2021', '3', '1000.00', '1', '1', NULL, NULL, 'rascunho', '1', '2026-05-13 14:26:39', '2026-05-13 14:26:43');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('9', '4', '1', '1', 'Apostila PHP', NULL, '978-85-333-0227-3', 'PortuguÃªs', '2023', '1000', '10000.00', '1', '1', '1778682696_images.png', NULL, 'rascunho', '1', '2026-05-13 15:31:37', '2026-05-17 16:47:14');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('10', '4', '1', '1', 'HTML', NULL, '978-85-333-0227-3', 'PortuguÃªs', '2022', '2000', '30000.00', '1', '1', '1778697377_ACESSO ADMIN.png', NULL, 'rascunho', '1', '2026-05-13 19:36:17', '2026-05-17 16:47:07');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('11', '15', '7', '5', 'KNLLLLLLLL', 'illnnnnnn', '899900999909090', 'Português', '2010', '234', '11999.99', '1', '1', 'uploads/capas/1779035142_3a52263b4142bd0f.jpg', 'uploads/pdfs/1779035142_5495fa3f719f1194.pdf', 'publicado', '1', '2026-05-17 17:25:42', '2026-05-21 10:32:42');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('12', '15', '7', '5', 'e,sssssss', 'keksekks,ekesk,', '899900999909023', 'Português', '2013', '230', '20000.00', '1', '1', 'uploads/capas/1779043289_c6638d392d48ad09.jpg', 'uploads/pdfs/1779043289_6c64bd344cac379c.pdf', 'publicado', '1', '2026-05-17 19:41:29', '2026-05-21 10:32:39');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('13', '18', '7', '5', 'Penumbra', 'XXX', '899900999903049', 'Português', '2006', '3', '4999.97', '0', '1', 'uploads/capas/1779088085_e231bc42e55a19e3.png', 'uploads/pdfs/1779088085_4028b0a95fbf4e3e.pdf', 'rascunho', '1', '2026-05-18 08:08:05', '2026-05-21 10:32:37');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('14', '15', '7', '5', 'NKLL', 'KLLLLLLLLLL', '899900999909023', 'Português', '2013', '6', '2000.00', '1', '1', 'uploads/capas/1779355854_ca6801b5fa1c13df.jpg', 'uploads/pdfs/1779355854_3b80345823e530ba.pdf', 'publicado', '1', '2026-05-21 10:30:54', '2026-05-21 10:32:33');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('15', '15', '10', '6', 'O Erro', 'Hannah Wells nunca se importou que ninguém a notasse — até conhecer Garrett Graham, o jogador de hóquei mais popular do campus. Uma parceria de estudos improvável transforma-se em algo muito mais complicado.', '978-85-510-0201-0', 'Português', '2017', '374', '10000.00', '1', '1', 'uploads/capas/1779356941_6f24208a4e8093d4.jpg', 'uploads/pdfs/1779356941_ce344120e2c620c0.pdf', 'publicado', '0', '2026-05-21 10:49:01', '2026-05-21 10:49:01');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('16', '15', '10', '6', 'Amores Improváveis 04 – O Acordo', 'Quarto volume da série Briar U, seguindo jovens universitários entre o amor, o hóquei e segredos do passado.', '', 'Português', '2020', '360', '0.00', '0', '1', 'uploads/capas/1779357099_ea1a8d822b266685.jpg', 'uploads/pdfs/1779357099_eaa7389609447d00.pdf', 'publicado', '0', '2026-05-21 10:51:39', '2026-05-21 10:51:39');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('17', '15', '11', '6', 'Academia dos Casos Arquivados', 'eUm grupo de adolescentes com habilidades especiais é recrutado pelo FBI para resolver crimes frios — combinando mistério, suspense e thriller psicológico.', '', 'Português', '2023', '400', '0.00', '0', '1', 'uploads/capas/1779357274_86f9ae1bc64bf532.jpg', 'uploads/pdfs/1779357274_663d0ad4aecfaa7f.pdf', 'publicado', '0', '2026-05-21 10:54:34', '2026-05-21 10:54:34');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('18', '15', '12', '6', 'Quarta Asa', 'Violet Sorrengail é enviada para a Academia de Dragões, onde deverá aprender a montar criaturas letais — e onde o inimigo mais perigoso pode ser o homem por quem se apaixona.', '978-65-5876-354-0', 'Português', '2023', '528', '20000.00', '1', '1', 'uploads/capas/1779357534_6ec716a06cee5611.jpg', 'uploads/pdfs/1779357534_5f4b36d95eb9739b.pdf', 'publicado', '0', '2026-05-21 10:58:54', '2026-05-21 10:58:54');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('19', '15', '13', '7', 'Negocie Qualquer Coisa com Qualquer Pessoa', 'Um guia prático com técnicas e estratégias para negociar em qualquer situação — seja no trabalho, em casa ou na vida pessoal — e sempre sair com os melhores resultados.', '', 'Português', '2019', '223', '0.00', '0', '1', 'uploads/capas/1779358726_8f4a9285d77e4d54.jpg', 'uploads/pdfs/1779358726_0486efb0289a083f.pdf', 'publicado', '0', '2026-05-21 11:18:46', '2026-05-21 11:18:46');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('20', '15', '14', '8', 'A Arte da Sedução', 'Robert Greene analisa os arquétipos do sedutor ao longo da história e apresenta estratégias para dominar a arte de influenciar, encantar e conquistar qualquer pessoa.', '978-85-325-1819-0', 'Português', '2003', '496', '40000.00', '1', '1', 'uploads/capas/1779358891_d675de64a71d9f0f.jpg', 'uploads/pdfs/1779358891_e6d69b9ae68f113d.pdf', 'publicado', '0', '2026-05-21 11:21:31', '2026-05-21 11:21:31');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('21', '15', '15', '6', 'A Sutil Arte de Ligar o Foda-Se', 'Uma abordagem contraintuitiva para viver uma boa vida: em vez de buscar o positivo a qualquer custo, Mark Manson defende que devemos escolher melhor aquilo pelo que nos importamos.', '978-65-5876-010-5', 'Português', '2017', '224', '20000.00', '1', '1', 'uploads/capas/1779359058_19e7a442c5628721.jpg', 'uploads/pdfs/1779359058_e09c6ed2ed791b42.pdf', 'publicado', '0', '2026-05-21 11:24:18', '2026-05-21 11:24:18');
INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES ('22', '15', '14', '8', 'As 48 Leis do Poder', 'Um dos livros mais vendidos do mundo sobre poder e estratégia. Com exemplos históricos, Greene apresenta as 48 leis que guiam aqueles que buscam conquistar, manter e exercer o poder.', '978-85-325-1135-1', 'Português', '2000', '576', '30500.00', '1', '1', 'uploads/capas/1779359159_a76643273c2431a4.jpg', 'uploads/pdfs/1779359159_39f2028343844485.pdf', 'publicado', '0', '2026-05-21 11:25:59', '2026-05-21 11:25:59');

--
-- Table structure for table `avaliacoes_livros`
--
DROP TABLE IF EXISTS `avaliacoes_livros`;
CREATE TABLE `avaliacoes_livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `livro_id` int NOT NULL,
  `utilizador_id` int NOT NULL,
  `nota` int NOT NULL,
  `comentario` text COLLATE utf8mb4_general_ci,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_livro_user` (`livro_id`,`utilizador_id`),
  KEY `idx_livro` (`livro_id`),
  KEY `fk_avaliacao_user` (`utilizador_id`),
  CONSTRAINT `fk_avaliacao_livro` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_avaliacao_user` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avaliacoes_livros_chk_1` CHECK ((`nota` between 1 and 5))
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avaliacoes_livros`
--
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('1', '12', '16', '2', NULL, '2026-05-17 20:20:58', '2026-05-17 20:25:16');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('8', '11', '16', '4', NULL, '2026-05-17 20:25:22', '2026-05-17 20:25:24');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('10', '12', '13', '5', NULL, '2026-05-17 20:45:26', '2026-05-17 20:45:28');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('12', '11', '13', '5', NULL, '2026-05-17 20:45:37', '2026-05-17 20:45:41');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('16', '12', '17', '2', NULL, '2026-05-18 07:55:01', '2026-05-18 07:55:01');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('17', '13', '13', '4', NULL, '2026-05-19 12:53:50', '2026-05-19 12:53:50');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('18', '18', '13', '4', NULL, '2026-05-21 10:59:34', '2026-05-21 10:59:34');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('19', '17', '13', '2', NULL, '2026-05-21 11:00:16', '2026-05-21 11:00:16');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('20', '16', '13', '1', NULL, '2026-05-21 11:00:21', '2026-05-21 11:00:21');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('21', '15', '13', '3', NULL, '2026-05-21 11:00:27', '2026-05-21 11:00:27');
INSERT INTO `avaliacoes_livros` (`id`, `livro_id`, `utilizador_id`, `nota`, `comentario`, `criado_em`, `atualizado_em`) VALUES ('22', '20', '13', '4', NULL, '2026-05-27 21:14:41', '2026-05-27 21:14:41');

--
-- Table structure for table `acessos_livros`
--
DROP TABLE IF EXISTS `acessos_livros`;
CREATE TABLE `acessos_livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `livro_id` int NOT NULL,
  `origem` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `livro_id` (`livro_id`),
  CONSTRAINT `acessos_livros_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `utilizadores` (`id`),
  CONSTRAINT `acessos_livros_ibfk_2` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acessos_livros`
--
INSERT INTO `acessos_livros` (`id`, `cliente_id`, `livro_id`, `origem`, `criado_em`) VALUES ('1', '13', '11', NULL, '2026-05-17 17:56:45');
INSERT INTO `acessos_livros` (`id`, `cliente_id`, `livro_id`, `origem`, `criado_em`) VALUES ('2', '13', '12', NULL, '2026-05-17 19:44:57');
INSERT INTO `acessos_livros` (`id`, `cliente_id`, `livro_id`, `origem`, `criado_em`) VALUES ('3', '17', '12', NULL, '2026-05-18 07:55:19');
INSERT INTO `acessos_livros` (`id`, `cliente_id`, `livro_id`, `origem`, `criado_em`) VALUES ('4', '13', '13', NULL, '2026-05-19 12:53:53');
INSERT INTO `acessos_livros` (`id`, `cliente_id`, `livro_id`, `origem`, `criado_em`) VALUES ('5', '13', '21', NULL, '2026-05-28 06:22:09');

--
-- Table structure for table `livros_generos`
--
DROP TABLE IF EXISTS `livros_generos`;
CREATE TABLE `livros_generos` (
  `livro_id` int NOT NULL,
  `genero_id` int NOT NULL,
  PRIMARY KEY (`livro_id`,`genero_id`),
  KEY `genero_id` (`genero_id`),
  CONSTRAINT `livros_generos_ibfk_1` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`) ON DELETE CASCADE,
  CONSTRAINT `livros_generos_ibfk_2` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livros_generos`
--
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('11', '1');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('12', '1');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('19', '1');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('20', '1');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('21', '1');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('22', '1');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('15', '2');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('16', '2');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('17', '2');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('12', '3');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('14', '3');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('15', '3');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('16', '3');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('17', '3');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('18', '3');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('17', '4');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('11', '5');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('12', '5');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('18', '5');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('18', '6');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('12', '7');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('13', '7');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('13', '8');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('14', '8');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('14', '9');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('19', '9');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('20', '9');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('21', '9');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('22', '9');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('11', '11');
INSERT INTO `livros_generos` (`livro_id`, `genero_id`) VALUES ('13', '13');

--
-- Table structure for table `livros_tags`
--
DROP TABLE IF EXISTS `livros_tags`;
CREATE TABLE `livros_tags` (
  `livro_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`livro_id`,`tag_id`),
  KEY `tag_id` (`tag_id`),
  CONSTRAINT `livros_tags_ibfk_1` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`) ON DELETE CASCADE,
  CONSTRAINT `livros_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `livros_tags`
--
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('12', '1');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('14', '1');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('20', '1');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('21', '1');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('22', '1');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('12', '2');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('15', '2');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('16', '2');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('17', '2');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('18', '2');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('19', '2');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('20', '2');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('21', '2');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('22', '2');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('13', '3');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('14', '3');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('15', '3');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('13', '4');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('15', '5');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('16', '5');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('18', '5');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('19', '5');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('20', '5');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('21', '5');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('22', '5');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('17', '6');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('18', '6');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('21', '6');
INSERT INTO `livros_tags` (`livro_id`, `tag_id`) VALUES ('22', '6');

--
-- Table structure for table `pedidos`
--
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `livro_id` int NOT NULL,
  `preco_pago` decimal(10,2) DEFAULT '0.00',
  `estado_pagamento` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pendente',
  `referencia_gateway` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pago_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `livro_id` (`livro_id`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `utilizadores` (`id`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pedidos`
--
INSERT INTO `pedidos` (`id`, `cliente_id`, `livro_id`, `preco_pago`, `estado_pagamento`, `referencia_gateway`, `pago_em`, `criado_em`) VALUES ('3', '7', '11', '11999.99', 'pago', NULL, '2026-05-17 18:59:01', '2026-05-17 18:59:01');
INSERT INTO `pedidos` (`id`, `cliente_id`, `livro_id`, `preco_pago`, `estado_pagamento`, `referencia_gateway`, `pago_em`, `criado_em`) VALUES ('4', '13', '11', '11999.99', 'pago', NULL, '2026-05-17 18:59:35', '2026-05-17 18:59:35');
INSERT INTO `pedidos` (`id`, `cliente_id`, `livro_id`, `preco_pago`, `estado_pagamento`, `referencia_gateway`, `pago_em`, `criado_em`) VALUES ('5', '13', '12', '20000.00', 'pago', NULL, '2026-05-17 20:45:09', '2026-05-17 20:45:09');
INSERT INTO `pedidos` (`id`, `cliente_id`, `livro_id`, `preco_pago`, `estado_pagamento`, `referencia_gateway`, `pago_em`, `criado_em`) VALUES ('6', '17', '11', '11999.99', 'pago', NULL, '2026-05-18 07:56:37', '2026-05-18 07:56:37');
INSERT INTO `pedidos` (`id`, `cliente_id`, `livro_id`, `preco_pago`, `estado_pagamento`, `referencia_gateway`, `pago_em`, `criado_em`) VALUES ('7', '17', '12', '20000.00', 'pago', NULL, '2026-05-18 07:56:37', '2026-05-18 07:56:37');
INSERT INTO `pedidos` (`id`, `cliente_id`, `livro_id`, `preco_pago`, `estado_pagamento`, `referencia_gateway`, `pago_em`, `criado_em`) VALUES ('8', '13', '14', '2000.00', 'pago', NULL, '2026-05-21 10:31:33', '2026-05-21 10:31:33');
INSERT INTO `pedidos` (`id`, `cliente_id`, `livro_id`, `preco_pago`, `estado_pagamento`, `referencia_gateway`, `pago_em`, `criado_em`) VALUES ('9', '13', '18', '20000.00', 'pago', NULL, '2026-05-21 11:01:18', '2026-05-21 11:01:18');
INSERT INTO `pedidos` (`id`, `cliente_id`, `livro_id`, `preco_pago`, `estado_pagamento`, `referencia_gateway`, `pago_em`, `criado_em`) VALUES ('10', '13', '15', '10000.00', 'pago', NULL, '2026-05-28 06:24:13', '2026-05-28 06:24:13');
INSERT INTO `pedidos` (`id`, `cliente_id`, `livro_id`, `preco_pago`, `estado_pagamento`, `referencia_gateway`, `pago_em`, `criado_em`) VALUES ('11', '13', '22', '30500.00', 'pago', NULL, '2026-05-28 06:24:13', '2026-05-28 06:24:13');

--
-- Table structure for table `logs_leitura`
--
DROP TABLE IF EXISTS `logs_leitura`;
CREATE TABLE `logs_leitura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `livro_id` int NOT NULL,
  `pagina_atual` int DEFAULT '0',
  `progresso` decimal(5,2) DEFAULT '0.00',
  `url_assinada` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `iniciado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `expira_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `livro_id` (`livro_id`),
  CONSTRAINT `logs_leitura_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `utilizadores` (`id`),
  CONSTRAINT `logs_leitura_ibfk_2` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `auditorias`
--
DROP TABLE IF EXISTS `auditorias`;
CREATE TABLE `auditorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilizador_id` int NOT NULL,
  `acao` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tabela_afetada` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `registo_afetado_id` int DEFAULT NULL,
  `dados_anteriores` json DEFAULT NULL,
  `dados_novos` json DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `utilizador_id` (`utilizador_id`),
  CONSTRAINT `auditorias_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auditorias`
--
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('1', '7', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-15 20:57:16');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('2', '14', 'criar', 'livros', NULL, NULL, NULL, '2026-05-13 20:57:16');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('3', '16', 'atualizar', 'livros', NULL, NULL, NULL, '2026-05-13 20:57:16');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('4', '6', 'criar', 'autores', NULL, NULL, NULL, '2026-05-13 20:57:16');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('5', '16', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-10 20:57:16');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('6', '7', 'criar', 'editoras', NULL, NULL, NULL, '2026-05-13 20:57:16');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('7', '4', 'avaliar', 'avaliacoes_livros', NULL, NULL, NULL, '2026-05-14 20:57:16');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('8', '7', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-14 20:57:16');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('9', '15', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-17 21:08:12');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('10', '4', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-17 21:08:31');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('11', '15', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-17 21:09:23');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('12', '4', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-17 21:22:53');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('13', '15', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-17 21:23:30');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('14', '4', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-17 21:37:18');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('15', '15', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-17 21:38:06');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('16', '4', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-17 21:47:26');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('17', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-17 21:47:47');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('18', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-18 07:51:40');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('19', '17', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-18 07:52:53');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('20', '4', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-18 07:58:24');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('21', '18', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-18 08:02:47');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('22', '18', 'criar', 'livros', '13', NULL, NULL, '2026-05-18 08:08:05');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('23', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-19 12:53:30');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('24', '15', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-19 12:58:56');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('25', '4', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-19 12:59:46');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('26', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-21 10:28:32');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('27', '4', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-21 10:29:16');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('28', '15', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-21 10:29:42');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('29', '15', 'criar', 'livros', '14', NULL, NULL, '2026-05-21 10:30:54');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('30', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-21 10:31:09');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('31', '15', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-21 10:32:25');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('32', '15', 'criar', 'livros', '15', NULL, NULL, '2026-05-21 10:49:02');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('33', '15', 'criar', 'livros', '16', NULL, NULL, '2026-05-21 10:51:39');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('34', '15', 'criar', 'livros', '17', NULL, NULL, '2026-05-21 10:54:34');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('35', '15', 'criar', 'livros', '18', NULL, NULL, '2026-05-21 10:58:54');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('36', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-21 10:59:13');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('37', '15', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-21 11:12:45');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('38', '15', 'criar', 'livros', '19', NULL, NULL, '2026-05-21 11:18:46');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('39', '15', 'criar', 'livros', '20', NULL, NULL, '2026-05-21 11:21:32');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('40', '15', 'criar', 'livros', '21', NULL, NULL, '2026-05-21 11:24:18');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('41', '15', 'criar', 'livros', '22', NULL, NULL, '2026-05-21 11:25:59');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('42', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-21 11:26:24');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('43', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 20:45:52');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('44', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 20:54:43');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('45', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 20:55:02');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('46', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:02:37');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('47', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:02:54');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('48', '19', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:04:09');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('49', '20', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:08:55');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('50', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:10:05');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('51', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:11:35');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('52', '4', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:12:04');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('53', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:14:08');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('54', '13', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:17:26');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('55', '19', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-27 21:18:07');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('56', '4', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-28 06:24:56');
INSERT INTO `auditorias` (`id`, `utilizador_id`, `acao`, `tabela_afetada`, `registo_afetado_id`, `dados_anteriores`, `dados_novos`, `criado_em`) VALUES ('57', '18', 'login', 'utilizadores', NULL, NULL, NULL, '2026-05-28 06:25:46');

--
-- Table structure for table `sessoes`
--
DROP TABLE IF EXISTS `sessoes`;
CREATE TABLE `sessoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilizador_id` int NOT NULL,
  `refresh_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `expira_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `utilizador_id` (`utilizador_id`),
  CONSTRAINT `sessoes_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
