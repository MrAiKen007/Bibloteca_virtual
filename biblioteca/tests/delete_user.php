<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=biblioteca_virtual', 'root', 'Jorge2005@paim');
    $q = $db->prepare('DELETE FROM utilizadores WHERE email = ?');
    $q->execute(['gkleber187@gmail.com']);
    echo "Registos eliminados: " . $q->rowCount() . "\n";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
