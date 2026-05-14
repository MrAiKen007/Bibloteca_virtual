<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Criar Livro</title>
</head>
<body>

<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Criar Livro</h1>

<form method="POST"
      action="index.php?url=livros/guardar"
      enctype="multipart/form-data">

      <label>Autor:</label><br>

    <select name="autor_id" required>

        <option value="">
            Selecione um autor
        </option>

        <?php foreach ($autores as $autor) : ?>

            <option value="<?= $autor['id'] ?>">

                <?= $autor['nome'] ?>

            </option>

        <?php endforeach; ?>

    </select>

    <br>
    <label>Editora:</label><br><br>

    <select name="editora_id" required>

        <option value="">
            Selecione uma editora
        </option>

        <?php foreach ($editoras as $editora) : ?>

            <option value="<?= $editora['id'] ?>">

                <?= $editora['nome'] ?>

            </option>

        <?php endforeach; ?>

    </select>


    <br><br>
    <!-- TÍTULO -->
    <label>Título:</label><br>
    <input type="text" name="titulo" required>
    <br><br>

    <!-- ISBN -->
    <label>ISBN:</label><br>
    <input type="text" name="isbn">
    <br><br>

    <!-- IDIOMA -->
    <label>Idioma:</label><br>

    <select name="idioma">

        <option value="Português">
            Português
        </option>

        <option value="Inglês">
            Inglês
        </option>

        <option value="Francês">
            Francês
        </option>

        <option value="Espanhol">
            Espanhol
        </option>

    </select>

    <br><br>

    <!-- ANO -->
    <label>Ano de Publicação:</label><br>
    <input type="number" name="ano_publicacao">
    <br><br>

    <!-- PÁGINAS -->
    <label>Número de Páginas:</label><br>
    <input type="number" name="numero_paginas">
    <br><br>

    <!-- PREÇO -->
    <label>Preço (Kz):</label><br>

    <input
        type="number"
        step="0.01"
        name="preco"
        value="0"
    >

    <br><br>

    <label>Capa do Livro:</label><br>

    <input
        type="file"
        name="capa"
        accept="image/*"
    >

    <br><br>

    <button type="submit">
        Guardar Livro
    </button>

</form>

</body>
</html>