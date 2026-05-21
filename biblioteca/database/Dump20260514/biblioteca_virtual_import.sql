-- ============================================
-- BIBLIO - Biblioteca Virtual
-- Database: biblioteca_virtual
-- ============================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------
-- Tabela: utilizadores
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `utilizadores` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `utilizadores` (`id`, `nome_completo`, `email`, `palavra_passe`, `papel`, `ativo`, `email_verificado`, `ultimo_login`, `criado_em`, `atualizado_em`) VALUES
(4, 'Administrador Principal', 'admin@biblioteca.com', '$2y$10$Sq7Vmh0iUGmGNOacbotL6OcGb7zY18W1TCHu0wnCr7gCLvrgBUcHC', 'admin', 1, 0, NULL, '2026-05-12 08:02:39', '2026-05-12 23:30:18'),
(5, 'Ricardo', 'ricardoacliver7@gmail.com', '$2y$10$ad5uHApIJekvFqF1Vb8dwOWNOWu7Tl6MCPCoiScb5OR2h6dExVC1.', 'cliente', 1, 0, NULL, '2026-05-14 00:19:58', '2026-05-14 00:19:58'),
(6, 'Ana Paulo', 'anapaulo@gmail.com', '$2y$10$/Sm0dtuwfd9hXB1/krQhferYUK/k9480rSTHiP8OWUoiaRgDc5sVm', 'cliente', 1, 0, NULL, '2026-05-14 02:30:26', '2026-05-14 02:30:26'),
(7, 'Andre Marcos', 'andre@gmail.com', '$2y$10$oBCkNYuS1Zn7ktnbVgdljuqmapYYdpa2nNyNCZkmB44/A0TZNnoSC', 'cliente', 1, 0, NULL, '2026-05-14 08:45:12', '2026-05-14 08:45:12'),
(8, 'Carla Pacheco', 'carla@gmail.com', '$2y$10$U.GeTNKkySYvNLbQsEVHMu8OmCuRMP3dZHX2/.3eD3ess19LaJaka', 'backoffice', 1, 0, NULL, '2026-05-14 08:55:31', '2026-05-14 08:55:31'),
(9, 'Pedro', 'pedro@gmail.com', '$2y$10$0wIpC27mFoSnbKG.Dt22Ee7yk47jv6SKLwt72fMws4TgJ3McX6pZe', 'cliente', 1, 0, NULL, '2026-05-14 09:20:03', '2026-05-14 09:20:03'),
(10, 'back', 'back@gmail.com', '$2y$10$KkQLVLD41q87Ocv4/hRihe3/Lh10nwPuWgjzSow4gYspTZswJImkC', 'backoffice', 1, 0, NULL, '2026-05-14 11:19:45', '2026-05-14 11:19:45');

-- --------------------------------------------
-- Tabela: autores
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `autores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `biografia` text COLLATE utf8mb4_general_ci,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `autores` (`id`, `nome`, `biografia`, `criado_em`) VALUES
(1, 'Autor Temporário', NULL, '2026-05-13 10:36:49'),
(2, 'Gustavo Guanaba', 'Gafanhoto!', '2026-05-13 20:54:13'),
(3, 'BB', '', '2026-05-13 23:12:38'),
(4, 'bb', '', '2026-05-13 23:38:54'),
(5, 'BBBBB', '', '2026-05-13 23:42:08'),
(6, 'Marijin Haverbeke', '', '2026-05-13 23:48:51');

-- --------------------------------------------
-- Tabela: editoras
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `editoras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `pais` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `editoras` (`id`, `nome`, `pais`, `criado_em`) VALUES
(1, 'Editora Temporária', 'Angola', '2026-05-13 10:41:02'),
(2, 'Company Books', 'América', '2026-05-13 21:12:18'),
(3, '', 'Angola', '2026-05-13 23:11:38'),
(4, '', 'Moçambique', '2026-05-13 23:13:23');

-- --------------------------------------------
-- Tabela: generos
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `generos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- Tabela: tags
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- Tabela: livros
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `livros` (
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
  KEY `editora_id` (`editora_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `livros` (`id`, `utilizador_id`, `autor_id`, `editora_id`, `titulo`, `sinopse`, `isbn`, `idioma`, `ano_publicacao`, `numero_paginas`, `preco`, `compravel`, `legivel_no_site`, `url_imagem_capa`, `caminho_pdf`, `estado`, `removido`, `criado_em`, `atualizado_em`) VALUES
(6, 4, 1, 1, 'Apostila PHP teste', NULL, '978-85-333-0227-3', 'Português', 2020, 10000, 10000.00, 1, 1, NULL, NULL, 'rascunho', 1, '2026-05-13 10:41:28', '2026-05-13 11:22:13'),
(7, 4, 1, 1, 'Apostila PHP  III', NULL, '978-85-333-0227-3', 'Português', 2020, 1000, 10000.00, 1, 1, NULL, NULL, 'rascunho', 1, '2026-05-13 11:22:40', '2026-05-13 15:31:57'),
(8, 4, 1, 1, 'xfv', NULL, '978-85-333-0227-3', 'Português', 2021, 3, 1000.00, 1, 1, NULL, NULL, 'rascunho', 1, '2026-05-13 14:26:39', '2026-05-13 14:26:43'),
(9, 4, 1, 1, 'Apostila PHP', NULL, '978-85-333-0227-3', 'Português', 2023, 1000, 10000.00, 1, 1, '1778682696_images.png', NULL, 'rascunho', 0, '2026-05-13 15:31:37', '2026-05-13 15:31:37'),
(10, 4, 1, 1, 'HTML', NULL, '978-85-333-0227-3', 'Português', 2022, 2000, 30000.00, 1, 1, '1778697377_ACESSO ADMIN.png', NULL, 'rascunho', 0, '2026-05-13 19:36:17', '2026-05-13 19:36:17');

-- --------------------------------------------
-- Tabela: avaliacoes_livros
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `avaliacoes_livros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `livro_id` INT NOT NULL,
  `utilizador_id` INT NOT NULL,
  `nota` INT NOT NULL CHECK (`nota` BETWEEN 1 AND 5),
  `comentario` TEXT NULL,
  `criado_em` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_livro_user` (`livro_id`, `utilizador_id`),
  KEY `idx_livro` (`livro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- Tabela: livros_generos
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `livros_generos` (
  `livro_id` int NOT NULL,
  `genero_id` int NOT NULL,
  PRIMARY KEY (`livro_id`,`genero_id`),
  KEY `genero_id` (`genero_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- Tabela: livros_tags
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `livros_tags` (
  `livro_id` int NOT NULL,
  `tag_id` int NOT NULL,
  PRIMARY KEY (`livro_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- Tabela: acessos_livros
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `acessos_livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `livro_id` int NOT NULL,
  `origem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `livro_id` (`livro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- Tabela: auditorias
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `auditorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilizador_id` int NOT NULL,
  `acao` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tabela_afetada` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `registo_afetado_id` int DEFAULT NULL,
  `dados_anteriores` json DEFAULT NULL,
  `dados_novos` json DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `utilizador_id` (`utilizador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- Tabela: logs_leitura
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `logs_leitura` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `livro_id` int NOT NULL,
  `pagina_atual` int DEFAULT '0',
  `progresso` decimal(5,2) DEFAULT '0.00',
  `url_assinada` text COLLATE utf8mb4_general_ci,
  `iniciado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `expira_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `livro_id` (`livro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- Tabela: pedidos
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente_id` int NOT NULL,
  `livro_id` int NOT NULL,
  `preco_pago` decimal(10,2) DEFAULT '0.00',
  `estado_pagamento` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'pendente',
  `referencia_gateway` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pago_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `livro_id` (`livro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- Tabela: sessoes
-- --------------------------------------------
CREATE TABLE IF NOT EXISTS `sessoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilizador_id` int NOT NULL,
  `refresh_token` text COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `expira_em` datetime DEFAULT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `utilizador_id` (`utilizador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------
-- FOREIGN KEYS
-- --------------------------------------------

ALTER TABLE `livros`
  ADD CONSTRAINT `livros_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`),
  ADD CONSTRAINT `livros_ibfk_2` FOREIGN KEY (`autor_id`) REFERENCES `autores` (`id`),
  ADD CONSTRAINT `livros_ibfk_3` FOREIGN KEY (`editora_id`) REFERENCES `editoras` (`id`);

ALTER TABLE `avaliacoes_livros`
  ADD CONSTRAINT `fk_avaliacao_livro` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_avaliacao_user` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE;

ALTER TABLE `livros_generos`
  ADD CONSTRAINT `livros_generos_ibfk_1` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `livros_generos_ibfk_2` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON DELETE CASCADE;

ALTER TABLE `livros_tags`
  ADD CONSTRAINT `livros_tags_ibfk_1` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `livros_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

ALTER TABLE `acessos_livros`
  ADD CONSTRAINT `acessos_livros_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `utilizadores` (`id`),
  ADD CONSTRAINT `acessos_livros_ibfk_2` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`);

ALTER TABLE `auditorias`
  ADD CONSTRAINT `auditorias_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`);

ALTER TABLE `logs_leitura`
  ADD CONSTRAINT `logs_leitura_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `utilizadores` (`id`),
  ADD CONSTRAINT `logs_leitura_ibfk_2` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`);

ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `utilizadores` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`);

ALTER TABLE `sessoes`
  ADD CONSTRAINT `sessoes_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS = 1;
