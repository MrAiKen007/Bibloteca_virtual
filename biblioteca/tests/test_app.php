<?php
/**
 * Teste de Integração da Aplicação (App Test)
 * Verifica se a Base de Dados está ligada e se a API está a responder corretamente.
 */

require_once __DIR__ . "/../app/core/BaseDados.php";

echo "<h1>🔍 Teste de Diagnóstico da Aplicação (APP TEST)</h1>";
echo "<hr>";

// 1. Teste de Conexão com a Base de Dados
echo "<h3>1. Conexão com a Base de Dados</h3>";
try {
    $db = BaseDados::getInstancia()->getConexao();
    echo "<p style='color: green;'>✅ Conexão estabelecida com sucesso!</p>";
    
    // Verificar tabelas essenciais
    $tabelas = ['livros', 'utilizadores', 'autores', 'editoras'];
    foreach ($tabelas as $tabela) {
        $query = $db->query("SHOW TABLES LIKE '$tabela'");
        if ($query->rowCount() > 0) {
            $count = $db->query("SELECT COUNT(*) FROM $tabela")->fetchColumn();
            echo "<p>✔️ Tabela <strong>$tabela</strong> encontrada ($count registos).</p>";
        } else {
            echo "<p style='color: red;'>❌ Tabela <strong>$tabela</strong> não encontrada!</p>";
        }
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Erro de Conexão: " . $e->getMessage() . "</p>";
}

echo "<hr>";

// 2. Teste da API (Simulação de Pedido Interno)
echo "<h3>2. Teste de Resposta da API</h3>";

// Função para simular o router sem precisar de curl (caso o servidor não consiga fazer curl para si mesmo)
function testarEndpoint($url) {
    global $db;
    echo "<p>Testando endpoint: <code>$url</code> ... ";
    
    // Aqui podíamos tentar usar file_get_contents se o allow_url_fopen estiver ativo,
    // mas em localhost às vezes bloqueia. Vamos apenas verificar se o controlador existe.
    $apiBase = "http://localhost/dashboard/Bibloteca_virtual/biblioteca/public/api/";
    $fullUrl = $apiBase . $url;
    
    $ctx = stream_context_create(['http' => ['timeout' => 2]]);
    $res = @file_get_contents($fullUrl, false, $ctx);
    
    if ($res) {
        $data = json_decode($res, true);
        if ($data) {
            echo "<span style='color: green;'>✅ OK (Recebidos " . count($data['dados'] ?? $data) . " itens)</span>";
        } else {
            echo "<span style='color: orange;'>⚠️ Recebeu resposta mas não é JSON válido.</span>";
        }
    } else {
        echo "<span style='color: red;'>❌ Falha ao contactar a API via HTTP ($fullUrl). Verifique se o Apache está a correr.</span>";
    }
    echo "</p>";
}

testarEndpoint('livros');
testarEndpoint('autores');
testarEndpoint('editoras');

echo "<hr>";
echo "<p>💡 <em>Dica: Se a conexão falhar, verifique o ficheiro <code>config/config.php</code>. Se a API falhar via HTTP mas as tabelas estiverem lá, o problema pode ser o Apache ou o caminho no <code>.htaccess</code>.</em></p>";
