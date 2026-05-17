<?php

class Livro
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDados::getInstancia()->getConexao();
    }

    public function listar()
    {
        $query = 'SELECT livros.id, livros.autor_id, livros.editora_id, livros.titulo, livros.isbn, livros.idioma, livros.ano_publicacao, livros.numero_paginas, livros.preco, livros.estado, livros.criado_em, livros.url_imagem_capa, livros.caminho_pdf, livros.legivel_no_site, livros.compravel, livros.sinopse, autores.nome AS autor, editoras.nome AS editora FROM livros LEFT JOIN autores ON livros.autor_id = autores.id LEFT JOIN editoras ON livros.editora_id = editoras.id WHERE livros.removido = 0 ORDER BY livros.id DESC';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $query = 'SELECT * FROM livros WHERE id = :id AND removido = 0 LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados)
    {
        $query = 'INSERT INTO livros (utilizador_id, autor_id, editora_id, titulo, sinopse, isbn, idioma, ano_publicacao, numero_paginas, preco, url_imagem_capa, caminho_pdf, estado, compravel, legivel_no_site, removido) VALUES (:utilizador_id, :autor_id, :editora_id, :titulo, :sinopse, :isbn, :idioma, :ano_publicacao, :numero_paginas, :preco, :url_imagem_capa, :caminho_pdf, :estado, :compravel, :legivel_no_site, :removido)';
        $stmt = $this->db->prepare($query);
        $result = $stmt->execute([
            ':utilizador_id' => $dados['utilizador_id'],
            ':autor_id' => $dados['autor_id'],
            ':editora_id' => $dados['editora_id'],
            ':titulo' => $dados['titulo'],
            ':sinopse' => $dados['sinopse'] ?? null,
            ':isbn' => $dados['isbn'] ?? null,
            ':idioma' => $dados['idioma'] ?? null,
            ':ano_publicacao' => $dados['ano_publicacao'] ?? null,
            ':numero_paginas' => $dados['numero_paginas'] ?? null,
            ':preco' => $dados['preco'] ?? 0,
            ':url_imagem_capa' => $dados['url_imagem_capa'] ?? null,
            ':caminho_pdf' => $dados['caminho_pdf'] ?? null,
            ':estado' => $dados['estado'] ?? 'rascunho',
            ':compravel' => $dados['compravel'] ?? 1,
            ':legivel_no_site' => $dados['legivel_no_site'] ?? 1,
            ':removido' => 0
        ]);
        return $result ? $this->db->lastInsertId() : false;
    }

    public function atualizar($id, $dados)
    {
        $query = 'UPDATE livros SET titulo = :titulo, sinopse = :sinopse, isbn = :isbn, idioma = :idioma, ano_publicacao = :ano_publicacao, numero_paginas = :numero_paginas, preco = :preco, autor_id = :autor_id, editora_id = :editora_id, estado = :estado, compravel = :compravel, legivel_no_site = :legivel_no_site, url_imagem_capa = :url_imagem_capa, caminho_pdf = :caminho_pdf WHERE id = :id AND removido = 0';
        $stmt = $this->db->prepare($query);
        $dados['id'] = $id;
        return $stmt->execute($dados);
    }

    public function eliminar($id)
    {
        $query = 'UPDATE livros SET removido = 1 WHERE id = :id';
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}