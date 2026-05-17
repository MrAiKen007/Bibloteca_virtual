<?php
require_once __DIR__ . '/../app/core/BaseDados.php';
try {
    $db = BaseDados::getInstancia()->getConexao();

    $stmt = $db->query("SELECT id FROM utilizadores LIMIT 5");
    $users = $stmt->fetchAll(PDO::FETCH_COLUMN);
    if (empty($users)) {
        echo "Sem utilizadores para seed.\n";
        exit;
    }

    $actions = [
        ['acao' => 'login', 'tabela' => 'utilizadores'],
        ['acao' => 'criar', 'tabela' => 'livros'],
        ['acao' => 'atualizar', 'tabela' => 'livros'],
        ['acao' => 'criar', 'tabela' => 'autores'],
        ['acao' => 'login', 'tabela' => 'utilizadores'],
        ['acao' => 'criar', 'tabela' => 'editoras'],
        ['acao' => 'avaliar', 'tabela' => 'avaliacoes_livros'],
        ['acao' => 'login', 'tabela' => 'utilizadores'],
    ];

    foreach ($actions as $i => $action) {
        $userId = $users[array_rand($users)];
        $daysAgo = rand(0, 7);
        $stmt = $db->prepare("INSERT INTO auditorias (utilizador_id, acao, tabela_afetada, criado_em) VALUES (:user, :acao, :tabela, DATE_SUB(NOW(), INTERVAL :days DAY))");
        $stmt->execute([':user' => $userId, ':acao' => $action['acao'], ':tabela' => $action['tabela'], ':days' => $daysAgo]);
    }

    echo "Seed de auditoria concluido.\n";
    $stmt = $db->query("SELECT COUNT(*) as total FROM auditorias");
    echo "Total de logs: " . $stmt->fetch(PDO::FETCH_COLUMN) . "\n";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
