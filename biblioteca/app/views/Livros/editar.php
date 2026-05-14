<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
</head>
<body>
<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Editar Livro</h1>

<form method="POST" action="index.php?url=livros/atualizar">

    <input type="hidden" name="id" value="<?= $livro['id'] ?>">

    <label>Título:</label><br>
    <input
        type="text"
        name="titulo"
        value="<?= $livro['titulo'] ?>"
        required
    >
    <br><br>

    <label>ISBN:</label><br>
    <input
        type="text"
        name="isbn"
        value="<?= $livro['isbn'] ?>"
    >
    <br><br>

    <label>Idioma:</label><br>

    <select name="idioma">

        <option value="Português"
            <?= $livro['idioma'] == 'Português' ? 'selected' : '' ?>>
            Português
        </option>

        <option value="Inglês"
            <?= $livro['idioma'] == 'Inglês' ? 'selected' : '' ?>>
            Inglês
        </option>

        <option value="Francês"
            <?= $livro['idioma'] == 'Francês' ? 'selected' : '' ?>>
            Francês
        </option>

        <option value="Espanhol"
            <?= $livro['idioma'] == 'Espanhol' ? 'selected' : '' ?>>
            Espanhol
        </option>

    </select>

    <br><br>

    <label>Ano de Publicação:</label><br>
    <input
        type="number"
        name="ano_publicacao"
        value="<?= $livro['ano_publicacao'] ?>"
    >
    <br><br>

    <label>Número de Páginas:</label><br>
    <input
        type="number"
        name="numero_paginas"
        value="<?= $livro['numero_paginas'] ?>"
    >
    <br><br>

    <label>Preço (Kz):</label><br>
    <input
        type="number"
        step="0.01"
        name="preco"
        value="<?= $livro['preco'] ?>"
    >
    <br><br>

    <button type="submit">
        Atualizar Livro
    </button>

</form>

</body>
</html>