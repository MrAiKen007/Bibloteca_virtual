<!DOCTYPE html>
<html>
<head>
    <title>Utilizadores</title>
</head>
<body>

<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de Utilizadores</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Papel</th>
        <th>Ativo</th>
        <th>Criado em</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($utilizadores as $utilizador) : ?>
        <tr>
            <td><?= $utilizador['id'] ?></td>
            
            <td><?= $utilizador['nome_completo'] ?></td>
            <td><?= $utilizador['email'] ?></td>
            <td><?= $utilizador['papel'] ?></td>
            <td><?= $utilizador['ativo'] ?></td>
            <td><?= $utilizador['criado_em'] ?></td>
            <td>

                <a href="index.php?url=utilizadores/editar&id=<?= $utilizador['id'] ?>">
                    Editar
                </a>

                <a
                    href="index.php?url=utilizadores/eliminar&id=<?= $utilizador['id'] ?>"
                    onclick="return confirm('Tem certeza que deseja eliminar?')"
                >
                    Eliminar
                </a>

            </td>
        </tr>
    <?php endforeach; ?>

</table>


</body>
</html>