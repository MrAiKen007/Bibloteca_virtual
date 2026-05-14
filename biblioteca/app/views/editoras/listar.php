<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de Editoras</h1>

<a href="index.php?url=editoras/criar">
    Criar Editora
</a>

<br><br>

<table border="1" cellpadding="10">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>País</th>
        <th>Criado em</th>
    </tr>

    <?php foreach ($editoras as $editora) : ?>

        <tr>

            <td><?= $editora['id'] ?></td>

            <td><?= $editora['nome'] ?></td>

            <td><?= $editora['pais'] ?></td>

            <td><?= $editora['criado_em'] ?></td>

        </tr>

    <?php endforeach; ?>

</table>