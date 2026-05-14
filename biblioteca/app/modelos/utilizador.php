<?php

class Utilizador
{
    /*
    |--------------------------------------------------------------------------
    | CONEXÃO PDO
    |--------------------------------------------------------------------------
    */

    private $db;

    /*
    |--------------------------------------------------------------------------
    | CONSTRUTOR
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        $this->db = BaseDados::getInstancia()->getConexao();
    }

    /*
    |--------------------------------------------------------------------------
    | BUSCAR UTILIZADOR POR EMAIL
    |--------------------------------------------------------------------------
    */

    public function buscarPorEmail($email)
    {
        $sql = "
            SELECT *
            FROM utilizadores
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | LISTAR UTILIZADORES
    |--------------------------------------------------------------------------
    */

    public function listar()
    {
        $sql = "
            SELECT
                id,
                nome_completo,
                email,
                papel,
                ativo,
                email_verificado,
                ultimo_login,
                criado_em
            FROM utilizadores
            ORDER BY id DESC
        ";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | CRIAR UTILIZADOR
    |--------------------------------------------------------------------------
    */

        public function criar($dados)
    {
        $sql = "INSERT INTO utilizadores
        (nome_completo, email, palavra_passe, papel, ativo, email_verificado)
        VALUES
        (:nome_completo, :email, :palavra_passe, :papel, :ativo, :email_verificado)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nome_completo' => $dados['nome_completo'],
            ':email' => $dados['email'],
            ':palavra_passe' => $dados['palavra_passe'],
            ':papel' => $dados['papel'],
            ':ativo' => $dados['ativo'],
            ':email_verificado' => $dados['email_verificado']
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | BUSCAR UTILIZADOR POR ID
    |--------------------------------------------------------------------------
    */

    public function buscarPorId($id)
    {
        $sql = "
            SELECT *
            FROM utilizadores
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}