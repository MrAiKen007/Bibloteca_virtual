<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lista de Utilizadores</title>
</head>
<body>

<h1>Lista de Utilizadores</h1>

<a href="index.php?url=utilizadores/criar">
    Criar Utilizador
</a>

<br><br>

<table border="1" cellpadding="8">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Papel</th>
        <th>Ativo</th>
        <th>Criado em</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($utilizadores as $utilizador): ?>

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

                |

                <a href="index.php?url=utilizadores/eliminar&id=<?= $utilizador['id'] ?>">
                    Eliminar
                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

</body>
</html>