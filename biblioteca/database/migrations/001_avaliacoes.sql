-- Table: avaliacoes_livros
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
  KEY `idx_livro` (`livro_id`),
  CONSTRAINT `fk_avaliacao_livro` FOREIGN KEY (`livro_id`) REFERENCES `livros` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_avaliacao_user` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
