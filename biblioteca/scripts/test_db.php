<?php
require_once __DIR__ . "/../app/core/BaseDados.php";

try {
    $db = BaseDados::getInstancia()->getConexao();
    echo "<h1> Conexão estabelecida com sucesso!</h1>";
    
    $query = $db->query("SELECT COUNT(*) as total FROM livros");
    $resultado = $query->fetch(PDO::FETCH_ASSOC);
    
    echo "<p>Total de livros na base de dados: <strong>" . $resultado['total'] . "</strong></p>";
    
    if ($resultado['total'] == 0) {
        echo "<p> A tabela 'livros' está vazia. Precisas de adicionar dados para que eles apareçam no site.</p>";
    }

} catch (Exception $e) {
    echo "<h1> Erro de Conexão</h1>";
    echo "<p>" . $e->getMessage() . "</p>";
}
