<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=biblioteca_virtual', 'root', 'Jorge2005@paim');
    $q = $db->query('DESCRIBE utilizadores');
    echo "Estrutura da tabela utilizadores:\n";
    while($r = $q->fetch(PDO::FETCH_ASSOC)) {
        echo "- " . $r['Field'] . " (" . $r['Type'] . ")\n";
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
