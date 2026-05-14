<?php require_once __DIR__ . '/layouts/menu.php'; ?>

<h1>Criar Conta</h1>

<?php if (!empty($_SESSION['erro'])): ?>
    <p style="color:red;">
        <?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?>
    </p>
<?php endif; ?>

<form method="POST" action="index.php?url=registo">

    <label>Nome completo:</label><br>
    <input type="text" name="nome_completo" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Senha:</label><br>
    <input type="password" name="senha" required><br><br>

    <button type="submit">Registar</button>

</form>

<br>

<p>Já tens conta?</p>

<a href="index.php?url=login">
    <button type="button">Voltar ao Login</button>
</a>