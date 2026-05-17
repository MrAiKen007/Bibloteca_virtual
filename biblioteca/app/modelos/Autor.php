<?php

class Autor
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDados::getInstancia()->getConexao();
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAR
    |--------------------------------------------------------------------------
    */

    public function listar()
    {
        $sql = "SELECT * FROM autores ORDER BY nome ASC";

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
        $sql = "SELECT * FROM autores WHERE id = :id LIMIT 1";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | CRIAR
    |--------------------------------------------------------------------------
    */

    public function criar($dados)
    {
        $sql = "INSERT INTO autores (nome, biografia)
                VALUES (:nome, :biografia)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            ':nome' => $dados['nome'],
            ':biografia' => $dados['biografia']
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM autores WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function atualizar($id, $dados)
    {
        $sql = "UPDATE autores SET nome = :nome, biografia = :biografia WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $dados['nome'],
            ':biografia' => $dados['biografia'] ?? null
        ]);
    }
}