<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Livros</title>
</head>
<body>

<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de Livros</h1>

<a href="index.php?url=livros/criar">
    Criar Livro
</a>

<br><br>

<table border="1" cellpadding="8">

    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>ISBN</th>
        <th>Idioma</th>
        <th>Ano</th>
        <th>Páginas</th>
        <th>Preço</th>
        <th>Estado</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($livros as $livro): ?>

        <tr>

            <td><?= $livro['id'] ?></td>

            <td><?= $livro['titulo'] ?></td>

            <td><?= $livro['isbn'] ?></td>

            <td><?= $livro['idioma'] ?></td>

            <td><?= $livro['ano_publicacao'] ?></td>

            <td><?= $livro['numero_paginas'] ?></td>

            <td><?= $livro['preco'] ?></td>

            <td><?= $livro['estado'] ?></td>

            <td>

                <a href="index.php?url=livros/editar&id=<?= $livro['id'] ?>">
                    Editar
                </a>

                |

                <a href="index.php?url=livros/eliminar&id=<?= $livro['id'] ?>">
                    Eliminar
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

</body>
</html>