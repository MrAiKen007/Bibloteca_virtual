<?php

class Editora
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
        $sql = "SELECT * FROM editoras ORDER BY nome ASC";

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
        $sql = "SELECT * FROM editoras WHERE id = :id LIMIT 1";

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
        $sql = "INSERT INTO editoras (nome, pais)
                VALUES (:nome, :pais)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([

            ':nome' => $dados['nome'],
            ':pais' => $dados['pais']
        ]);
    }

    public function eliminar($id)
    {
        $sql = "DELETE FROM editoras WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function atualizar($id, $dados)
    {
        $sql = "UPDATE editoras SET nome = :nome, pais = :pais WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $dados['nome'],
            ':pais' => $dados['pais']
        ]);
    }
}