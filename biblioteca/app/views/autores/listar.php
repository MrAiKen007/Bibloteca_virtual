<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de Autores</h1>

<a href="index.php?url=autores/criar">
    Criar Autor
</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Biografia</th>
        <th>Criado em</th>
    </tr>

    <?php foreach ($autores as $autor) : ?>

        <tr>

            <td><?= $autor['id'] ?></td>

            <td><?= $autor['nome'] ?></td>

            <td><?= $autor['biografia'] ?></td>

            <td><?= $autor['criado_em'] ?></td>

        </tr>

    <?php endforeach; ?>

</table>