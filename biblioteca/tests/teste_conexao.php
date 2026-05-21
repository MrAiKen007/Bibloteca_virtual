<?php
require_once __DIR__ . "/../app/core/BaseDados.php";

try {
    $db = BaseDados::getInstancia()->getConexao();
    echo "Conexão com a Base de Dados: OK\n";
    
    $query = $db->query("SELECT DATABASE()");
    echo "Base de Dados ativa: " . $query->fetchColumn() . "\n";
} catch (Exception $e) {
    echo "ERRO: " . $e->getMessage() . "\n";
}
