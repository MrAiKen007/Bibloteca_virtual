<?php
session_start();
require_once __DIR__ . "/../app/core/BaseDados.php";
require_once __DIR__ . "/../app/modelos/Utilizador.php";

echo "<h1>🔍 Debug de Login</h1>";

echo "<h2>1. Verificar todos os utilizadores na BD:</h2>";
try {
    $db = BaseDados::getInstancia()->getConexao();
    $query = $db->query("SELECT id, nome_completo, email, papel, ativo FROM utilizadores");
    $utilizadores = $query->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Email</th><th>Papel</th><th>Ativo</th></tr>";
    
    foreach ($utilizadores as $u) {
        $cor = $u['papel'] === 'admin' ? '#90EE90' : ($u['papel'] === 'backoffice' ? '#FFD700' : '#FFFFFF');
        echo "<tr style='background-color: $cor;'>";
        echo "<td>{$u['id']}</td>";
        echo "<td>{$u['nome_completo']}</td>";
        echo "<td>{$u['email']}</td>";
        echo "<td><strong>{$u['papel']}</strong></td>";
        echo "<td>" . ($u['ativo'] ? '✅' : '❌') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} catch (Exception $e) {
    echo "<p>Erro: " . $e->getMessage() . "</p>";
}

echo "<h2>2. Testar login com admin@biblioteca.com:</h2>";
$email = "admin@biblioteca.com";

$utilizadorModel = new Utilizador();
$utilizador = $utilizadorModel->buscarPorEmail($email);

if (!$utilizador) {
    echo "<p>❌ Utilizador não encontrado!</p>";
} else {
    echo "<p>✅ Utilizador encontrado</p>";
    echo "<pre>";
    print_r($utilizador);
    echo "</pre>";
    
    echo "<h3>Detalhes do papel:</h3>";
    echo "<p>Papel: <strong>'{$utilizador['papel']}'</strong></p>";
    echo "<p>Tipo: " . gettype($utilizador['papel']) . "</p>";
    echo "<p>Comprimento: " . strlen($utilizador['papel']) . "</p>";
    echo "<p>Hex: " . bin2hex($utilizador['papel']) . "</p>";
    
    echo "<h3>Teste do switch case:</h3>";
    switch ($utilizador['papel']) {
        case 'admin':
            echo "<p>✅ Vai redirecionar para: <strong>index.php?url=utilizadores</strong></p>";
            break;
        case 'backoffice':
            echo "<p>✅ Vai redirecionar para: <strong>index.php?url=livros</strong></p>";
            break;
        default:
            echo "<p>⚠️ Vai redirecionar para: <strong>index.php?url=biblioteca</strong> (DEFAULT)</p>";
            echo "<p>Isso significa que o papel '{$utilizador['papel']}' não corresponde a 'admin' nem 'backoffice'</p>";
            break;
    }
}

echo "<h2>3. Verificar rotas disponíveis:</h2>";
echo "<ul>";
echo "<li>✅ login</li>";
echo "<li>✅ logout</li>";
echo "<li>✅ utilizadores</li>";
echo "<li>✅ livros</li>";
echo "<li>✅ autores</li>";
echo "<li>✅ editoras</li>";
echo "<li>✅ biblioteca (ADICIONADA)</li>";
echo "<li>✅ api/*</li>";
echo "</ul>";

echo "<h2>4. Verificar sessão atual:</h2>";
if (isset($_SESSION['user_id'])) {
    echo "<p>✅ Sessão ativa</p>";
    echo "<p>User ID: {$_SESSION['user_id']}</p>";
    echo "<p>User Nome: {$_SESSION['user_nome'] ?? 'N/A'}</p>";
    echo "<p>User Papel: {$_SESSION['user_papel'] ?? 'N/A'}</p>";
} else {
    echo "<p>❌ Sessão não ativa</p>";
}
