<?php

class BaseDados
{
    private static $instancia = null;
    private $conexao;

    // CONFIGURAÇÃO - Carregada do config/database.php (que lê o .env)
    private $host;
    private $dbname;
    private $user;
    private $password;

    private function __construct()
    {
        // Carrega configurações do arquivo de configuração
        $configFile = __DIR__ . '/../../config/database.php';
        if (file_exists($configFile)) {
            $config = require $configFile;
            $this->host = $config['host'] ?? '127.0.0.1';
            $this->dbname = $config['dbname'] ?? 'biblioteca_virtual';
            $this->user = $config['user'] ?? 'root';
            $this->password = $config['password'] ?? '';
            $port = $config['port'] ?? '3306';
        } else {
            // Fallback para configurações padrão
            $this->host = '127.0.0.1';
            $this->dbname = 'biblioteca_virtual';
            $this->user = 'root';
            $this->password = '';
            $port = '3306';
        }

        try {
            $this->conexao = new PDO(
                "mysql:host={$this->host};port={$port};dbname={$this->dbname};charset=utf8mb4",
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