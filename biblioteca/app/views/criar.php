<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Criar Utilizador</title>
</head>
<body>

<h1>Criar Utilizador</h1>

<form method="POST" action="index.php?url=utilizadores/guardar" enctype="multipart/form-data">

    <label>Capa do Livro:</label><br>
    <input type="file" name="capa" accept="image/*">
    <br><br>

    <label>Nome Completo:</label><br>
    <input type="text" name="nome_completo" required>
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required>
    <br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required>
    <br><br>

    <label>Papel:</label><br>

    <select name="papel">

        <option value="cliente">Cliente</option>

        <option value="backoffice">Backoffice</option>

        <option value="admin">Admin</option>

    </select>

    <br><br>

    <button type="submit">
        Guardar
    </button>

</form>

</body>
</html>