<?php

class BaseDados
{
    private static $instancia = null;
    private $conexao;

    // CONFIGURAÇÃO - AJUSTA AQUI SE NECESSÁRIO
    private $host = "127.0.0.1";
    private $dbname = "biblioteca_virtual";
    private $user = "root";
    private $password = "Jorge2005@paim"; // Tentei vazio, pois é o padrão do XAMPP

    private function __construct()
    {
        $configFile = __DIR__ . '/../../config/database.php';
        if (file_exists($configFile)) {
            $config = require $configFile;
            $this->host = $config['host'] ?? '127.0.0.1';
            $this->dbname = $config['dbname'] ?? 'biblioteca_virtual';
            $this->user = $config['user'] ?? 'root';
            $this->password = $config['password'] ?? '';
        }

        try {
            $this->conexao = new PDO(
                "mysql:host={$this->host};port=3306;dbname={$this->dbname};charset=utf8mb4",
                $this->user,
                $this->password
            );
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("Erro de conexão BD: " . $e->getMessage());
            http_response_code(500);
            die("Erro de conexão à base de dados.");
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