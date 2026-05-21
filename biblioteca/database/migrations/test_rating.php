<?php
require_once __DIR__ . '/../app/core/BaseDados.php';
require_once __DIR__ . '/../app/core/resposta.php';

// Test: insert a rating for user 1 on book 11
$db = BaseDados::getInstancia()->getConexao();

echo "Testando tabela avaliacoes_livros...\n";

// Check table exists
$stmt = $db->query("SHOW TABLES LIKE 'avaliacoes_livros'");
if ($stmt->rowCount() === 0) {
    echo "Tabela nao existe!\n";
    exit;
}
echo "Tabela existe.\n";

// Check columns
$stmt = $db->query("DESCRIBE avaliacoes_livros");
echo "Colunas:\n";
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

// Try insert
try {
    $stmt = $db->prepare("INSERT INTO avaliacoes_livros (livro_id, utilizador_id, nota) VALUES (11, 1, 5) ON DUPLICATE KEY UPDATE nota = 5");
    $stmt->execute();
    echo "Insert ok.\n";
} catch (Exception $e) {
    echo "Insert error: " . $e->getMessage() . "\n";
}

// Check data
$stmt = $db->query("SELECT * FROM avaliacoes_livros");
echo "Dados:\n";
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));

// Check avg
$stmt = $db->query("SELECT AVG(nota) as media, COUNT(*) as total FROM avaliacoes_livros WHERE livro_id = 11");
echo "Media livro 11:\n";
print_r($stmt->fetch(PDO::FETCH_ASSOC));
