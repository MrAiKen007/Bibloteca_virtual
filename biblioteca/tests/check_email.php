<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=biblioteca_virtual', 'root', 'Jorge2005@paim');
    $q = $db->prepare('SELECT id, email FROM utilizadores WHERE email = ?');
    $q->execute(['gkleber187@gmail.com']);
    $user = $q->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        echo "Usuário encontrado: ID " . $user['id'] . "\n";
    } else {
        echo "Usuário NÃO encontrado.\n";
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
