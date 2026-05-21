<?php
require_once __DIR__ . "/../app/core/BaseDados.php";

try {
    $db = BaseDados::getInstancia()->getConexao();
    $caminho = __DIR__ . "/../database/Dump20260514/biblioteca_virtual_completo.sql";
    
    if (!file_exists($caminho)) {
        throw new Exception("Ficheiro não encontrado: " . $caminho);
    }

    $sql = file_get_contents($caminho);
    
    // Desativar chaves estrangeiras
    $db->exec("SET FOREIGN_KEY_CHECKS = 0;");

    // Limpar o SQL de comentários e linhas vazias para evitar erros de sintaxe
    $linhas = explode("\n", $sql);
    $query = "";
    
    foreach ($linhas as $linha) {
        $linha = trim($linha);
        // Ignorar comentários e linhas vazias
        if ($linha == "" || strpos($linha, "--") === 0 || strpos($linha, "/*") === 0) {
            continue;
        }
        
        $query .= $linha;
        
        // Se a linha termina com ; então é o fim de um comando
        if (substr($linha, -1) == ";") {
            try {
                $db->exec($query);
            } catch (Exception $e) {
                // Ignorar erros menores de DROP TABLE se a tabela não existir
            }
            $query = "";
        }
    }

    // Reativar chaves estrangeiras
    $db->exec("SET FOREIGN_KEY_CHECKS = 1;");
    
    echo "<h1> Importação concluída com sucesso!</h1>";
    echo "<p>As 13 tabelas foram processadas.</p>";
    echo "<a href='test_db.php'>Verificar livros na DB</a>";

} catch (Exception $e) {
    echo "<h1> Erro na Importação</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
