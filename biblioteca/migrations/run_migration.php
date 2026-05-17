<?php
require_once __DIR__ . '/../app/core/BaseDados.php';
try {
    $db = BaseDados::getInstancia()->getConexao();
    $sql = file_get_contents(__DIR__ . '/001_avaliacoes.sql');
    $db->exec($sql);
    echo "Tabela avaliacoes_livros criada com sucesso!\n";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
