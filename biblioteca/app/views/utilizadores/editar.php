<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Utilizador</title>
</head>
<body>
<?php require_once __DIR__ . '/../layouts/menu.php'; ?>

<h1>Editar Utilizador</h1>

<?php if (!empty($_SESSION['erro'])): ?>
    <p style="color:red;">
        <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
    </p>
<?php endif; ?>

<form method="POST" action="index.php?url=utilizadores/atualizar">

    <input type="hidden" name="id" value="<?= $utilizador['id'] ?>">

    <label>Nome completo</label><br>
    <input type="text" name="nome_completo" value="<?= $utilizador['nome_completo'] ?>"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= $utilizador['email'] ?>"><br><br>

    <label>Nova Senha (deixe vazio para manter)</label><br>
    <input type="password" name="palavra_passe"><br><br>

    <label>Papel</label><br>
    <select name="papel">
        <option value="cliente" <?= $utilizador['papel'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
        <option value="backoffice" <?= $utilizador['papel'] == 'backoffice' ? 'selected' : '' ?>>Backoffice</option>
        <option value="admin" <?= $utilizador['papel'] == 'admin' ? 'selected' : '' ?>>Admin</option>
    </select><br><br>

    <label>Ativo</label><br>
    <select name="ativo">
        <option value="1" <?= $utilizador['ativo'] == 1 ? 'selected' : '' ?>>Sim</option>
        <option value="0" <?= $utilizador['ativo'] == 0 ? 'selected' : '' ?>>Não</option>
    </select><br><br>

    <button type="submit">Atualizar</button>

</form>

</body>
</html>
