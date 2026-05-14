<?php

class Livro
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDados::getInstancia()->getConexao();
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAR LIVROS
    |--------------------------------------------------------------------------
    */

    public function listar()
    {
        $sql = "
            SELECT 
                id,
                titulo,
                isbn,
                idioma,
                ano_publicacao,
                numero_paginas,
                preco,
                estado,
                criado_em
            FROM livros
            WHERE removido = 0
            ORDER BY id DESC
        ";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | BUSCAR POR ID
    |--------------------------------------------------------------------------
    */

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM livros WHERE id = :id LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | CRIAR LIVRO
    |--------------------------------------------------------------------------
    */

        public function criar($dados)
    {
        $sql = "INSERT INTO livros 
        (
            utilizador_id,
            autor_id,
            editora_id,
            titulo,
            isbn,
            idioma,
            ano_publicacao,
            numero_paginas,
            preco,
            url_imagem_capa,
            estado,
            removido
        )
        VALUES 
        (
            :utilizador_id,
            :autor_id,
            :editora_id,
            :titulo,
            :isbn,
            :idioma,
            :ano_publicacao,
            :numero_paginas,
            :preco,
            :url_imagem_capa,
            :estado,
            :removido
        )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            // 🔥 OBRIGATÓRIOS DA BD
            ':utilizador_id' => $dados['utilizador_id'],
            ':autor_id' => $dados['autor_id'],
            ':editora_id' => $dados['editora_id'],

            // 📚 DADOS DO LIVRO
            ':titulo' => $dados['titulo'],
            ':isbn' => $dados['isbn'] ?? null,
            ':idioma' => $dados['idioma'] ?? null,
            ':ano_publicacao' => $dados['ano_publicacao'] ?? null,
            ':numero_paginas' => $dados['numero_paginas'] ?? null,
            ':preco' => $dados['preco'] ?? 0,

            // 🖼️ CAPA
            ':url_imagem_capa' => $dados['url_imagem_capa'] ?? null,

            // ⚙️ DEFAULTS CONTROLADOS
            ':estado' => $dados['estado'] ?? 'rascunho',
            ':removido' => 0
        ]);
    }

        public function atualizar($id, $dados)
    {
        $sql = "UPDATE livros SET 
            titulo = :titulo,
            isbn = :isbn,
            idioma = :idioma,
            ano_publicacao = :ano_publicacao,
            numero_paginas = :numero_paginas,
            preco = :preco
        WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $dados['id'] = $id;

        return $stmt->execute($dados);
    }

        public function eliminar($id)
    {
        $sql = "UPDATE livros SET removido = 1 WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
}