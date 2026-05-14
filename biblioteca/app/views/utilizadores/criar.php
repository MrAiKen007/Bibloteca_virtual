<h2>Criar Utilizador</h2>

<?php if (!empty($_SESSION['erro'])): ?>
    <p style="color:red;">
        <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
    </p>
<?php endif; ?>

<form method="POST" action="index.php?url=utilizadores/guardar">

    <label>Nome completo</label><br>
    <input type="text" name="nome_completo"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Senha</label><br>
    <input type="password" name="palavra_passe"><br><br>

    <label>Papel</label><br>
    <select name="papel">
        <option value="cliente">Cliente</option>
        <option value="backoffice">Backoffice</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit">Cadastrar</button>

</form>