<?php

class BaseDados
{
    private static $instancia = null;
    private $conexao;

    private $host = "localhost";
    private $dbname = "biblioteca_virtual";
    private $user = "root";
    private $password = "ricardoacliver";

    private function __construct()
    {
        try {

            $this->conexao = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->password
            );

            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            die("Erro de conexão: " . $e->getMessage());
        }
    }

    public static function getInstancia()
    {
        if (self::$instancia === null) {
            self::$instancia = new BaseDados();
        }

        return self::$instancia;
    }

    public function getConexao()
    {
        return $this->conexao;
    }
}