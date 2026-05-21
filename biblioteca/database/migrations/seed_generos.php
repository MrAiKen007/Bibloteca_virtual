<?php
require_once __DIR__ . '/../app/core/BaseDados.php';
try {
    $db = BaseDados::getInstancia()->getConexao();

    $generosList = ['Ficção', 'Romance', 'Mistério', 'Fantasia', 'Ficção Científica', 'Biografia', 'História', 'Autoajuda', 'Negócios', 'Tecnologia', 'Poesia', 'Infantil'];
    foreach ($generosList as $g) {
        $stmt = $db->prepare("INSERT IGNORE INTO generos (nome) VALUES (:nome)");
        $stmt->execute([':nome' => $g]);
    }

    $stmt = $db->query("SELECT id, nome FROM generos");
    $generos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Generos: " . count($generos) . "\n";

    $stmt = $db->query("SELECT id FROM livros WHERE removido = 0");
    $livros = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($livros as $livroId) {
        shuffle($generos);
        $count = rand(1, 3);
        for ($i = 0; $i < $count; $i++) {
            $stmt = $db->prepare("INSERT IGNORE INTO livros_generos (livro_id, genero_id) VALUES (:livro, :genero)");
            $stmt->execute([':livro' => $livroId, ':genero' => $generos[$i]['id']]);
            echo "Livro $livroId -> {$generos[$i]['nome']}\n";
        }
    }

    echo "\nTags check:\n";
    $stmt = $db->query("SELECT lt.livro_id, t.nome FROM livros_tags lt JOIN tags t ON lt.tag_id = t.id");
    $tagsResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($tagsResult)) {
        echo "Nenhuma tag atribuida a livros.\n";
        $tagsList = ['bestseller', 'novidade', 'clássico'];
        foreach ($tagsList as $t) {
            $stmt = $db->prepare("INSERT IGNORE INTO tags (nome) VALUES (:nome)");
            $stmt->execute([':nome' => $t]);
        }
        $stmt = $db->query("SELECT id, nome FROM tags");
        $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($livros as $livroId) {
            shuffle($tags);
            $count = rand(1, 2);
            for ($i = 0; $i < $count; $i++) {
                $stmt = $db->prepare("INSERT IGNORE INTO livros_tags (livro_id, tag_id) VALUES (:livro, :tag)");
                $stmt->execute([':livro' => $livroId, ':tag' => $tags[$i]['id']]);
                echo "Livro $livroId -> Tag {$tags[$i]['nome']}\n";
            }
        }
    } else {
        print_r($tagsResult);
    }

    echo "\nFinal:\n";
    $stmt = $db->query("SELECT l.id, l.titulo, GROUP_CONCAT(DISTINCT g.nome SEPARATOR ', ') as generos, GROUP_CONCAT(DISTINCT t.nome SEPARATOR ', ') as tags FROM livros l LEFT JOIN livros_generos lg ON l.id = lg.livro_id LEFT JOIN generos g ON lg.genero_id = g.id LEFT JOIN livros_tags lt ON l.id = lt.livro_id LEFT JOIN tags t ON lt.tag_id = t.id WHERE l.removido = 0 GROUP BY l.id");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
