<?php
$hosts = ['127.0.0.1', 'localhost'];
$ports = [3306, 3307];
$passwords = ['Jorge2005@paim', ''];
$user = 'root';
$dbname = 'biblioteca_virtual';

echo "Testando conexões...\n";

foreach ($hosts as $host) {
    foreach ($ports as $port) {
        foreach ($passwords as $pass) {
            echo "Tentando: $host:$port (Senha: " . ($pass ? 'Sim' : 'Não') . ") ... ";
            try {
                $start = microtime(true);
                $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_TIMEOUT => 2
                ]);
                echo "✅ SUCESSO! (" . round(microtime(true) - $start, 3) . "s)\n";
            } catch (Exception $e) {
                echo "❌ FALHA: " . substr($e->getMessage(), 0, 50) . "...\n";
            }
        }
    }
}
