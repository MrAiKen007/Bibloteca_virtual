<?php
require_once __DIR__ . "/../app/core/BaseDados.php";

try {
    $db = BaseDados::getInstancia()->getConexao();
    
    echo "<h1>Verificar Utilizadores Admin</h1>";
    
    // Buscar todos os utilizadores
    $query = $db->query("SELECT id, nome_completo, email, papel, ativo FROM utilizadores");
    $utilizadores = $query->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Utilizadores na Base de Dados:</h2>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Papel</th><th>Ativo</th></tr>";
    
    foreach ($utilizadores as $u) {
        echo "<tr>";
        echo "<td>{$u['id']}</td>";
        echo "<td>{$u['nome_completo']}</td>";
        echo "<td>{$u['email']}</td>";
        echo "<td><strong>{$u['papel']}</strong></td>";
        echo "<td>" . ($u['ativo'] ? 'Sim' : 'Não') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Verificar se existe admin
    $adminQuery = $db->query("SELECT * FROM utilizadores WHERE papel = 'admin'");
    $admin = $adminQuery->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "<h2>✅ Admin encontrado:</h2>";
        echo "<pre>";
        print_r($admin);
        echo "</pre>";
    } else {
        echo "<h2>❌ Nenhum admin encontrado. Criando novo admin...</h2>";
        
        $senha = 'admin123';
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        
        $stmt = $db->prepare("INSERT INTO utilizadores (nome_completo, email, palavra_passe, papel, ativo, email_verificado) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute(['Admin Sistema', 'admin@sistema.com', $senhaHash, 'admin', 1, 1]);
        
        echo "<p>✅ Novo admin criado com sucesso!</p>";
        echo "<p><strong>Email:</strong> admin@sistema.com</p>";
        echo "<p><strong>Senha:</strong> admin123</p>";
    }
    
} catch (Exception $e) {
    echo "<h1>Erro</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
