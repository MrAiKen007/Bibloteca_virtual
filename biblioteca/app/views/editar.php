<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Utilizador</title>
</head>
<body>

<h1>Editar Utilizador</h1>

<form method="POST" action="index.php?url=utilizadores/atualizar">

    <input type="hidden" name="id" value="<?= $utilizador['id'] ?>">

    <label>Nome Completo:</label><br>
    <input type="text" name="nome_completo" value="<?= $utilizador['nome_completo'] ?>">
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $utilizador['email'] ?>">
    <br><br>

    <label>Papel:</label><br>

    <select name="papel">

        <option value="cliente">Cliente</option>

        <option value="backoffice">Backoffice</option>

        <option value="admin">Admin</option>

    </select>

    <br><br>

    <button type="submit">
        Atualizar
    </button>

</form>

</body>
</html>