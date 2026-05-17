<?php

class BibliotecaModel
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDados::getInstancia()->getConexao();
    }

    public function getMeusLivros($utilizadorId)
    {
        $query = 'SELECT DISTINCT livros.id, livros.titulo, livros.isbn, livros.idioma, livros.ano_publicacao, livros.numero_paginas, livros.preco, livros.estado, livros.criado_em, livros.url_imagem_capa, livros.caminho_pdf, livros.legivel_no_site, livros.compravel, livros.sinopse, autores.nome AS autor, editoras.nome AS editora,
            CASE WHEN pedidos.id IS NOT NULL THEN "comprado" ELSE "lido" END AS tipo_acesso,
            COALESCE(pedidos.pago_em, acessos.criado_em) AS data_aquisicao
            FROM livros
            LEFT JOIN autores ON livros.autor_id = autores.id
            LEFT JOIN editoras ON livros.editora_id = editoras.id
            LEFT JOIN pedidos ON pedidos.livro_id = livros.id AND pedidos.cliente_id = :utilizador_id AND pedidos.estado_pagamento = "pago"
            LEFT JOIN acessos_livros acessos ON acessos.livro_id = livros.id AND acessos.cliente_id = :utilizador_id2
            WHERE livros.removido = 0
            AND (pedidos.id IS NOT NULL OR acessos.id IS NOT NULL)
            ORDER BY data_aquisicao DESC';

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':utilizador_id', $utilizadorId);
        $stmt->bindParam(':utilizador_id2', $utilizadorId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function comprarLivro($utilizadorId, $livroId, $preco)
    {
        $query = 'INSERT INTO pedidos (cliente_id, livro_id, preco_pago, estado_pagamento, pago_em) VALUES (:cliente_id, :livro_id, :preco_pago, "pago", NOW())';
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':cliente_id' => $utilizadorId,
            ':livro_id' => $livroId,
            ':preco_pago' => $preco
        ]);
    }

    public function registarLeitura($utilizadorId, $livroId)
    {
        $query = 'INSERT INTO acessos_livros (cliente_id, livro_id, criado_em) VALUES (:cliente_id, :livro_id, NOW())';
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':cliente_id' => $utilizadorId,
            ':livro_id' => $livroId
        ]);
    }

    public function jaComprou($utilizadorId, $livroId)
    {
        $query = 'SELECT id FROM pedidos WHERE cliente_id = :cliente_id AND livro_id = :livro_id AND estado_pagamento = "pago" LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cliente_id', $utilizadorId);
        $stmt->bindParam(':livro_id', $livroId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function jaAcessou($utilizadorId, $livroId)
    {
        $query = 'SELECT id FROM acessos_livros WHERE cliente_id = :cliente_id AND livro_id = :livro_id LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cliente_id', $utilizadorId);
        $stmt->bindParam(':livro_id', $livroId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
