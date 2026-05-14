<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

    <h1>Login</h1>

    <?php if (isset($_SESSION['erro'])) : ?>

        <p>
            <?php
                echo $_SESSION['erro'];
                unset($_SESSION['erro']);
            ?>
        </p>

    <?php endif; ?>

    <form method="POST" action="index.php?url=login">

        <input
            type="email"
            name="email"
            placeholder="Digite o email"
        >

        <br><br>

        <input
            type="password"
            name="senha"
            placeholder="Digite a senha"
        >

        <br><br>

        <button type="submit">
            Entrar
        </button>

    </form>

    <br><br>

    <p>Já tens conta?</p>

    <a href="index.php?url=registo">
        <button type="button">
            Criar conta
        </button>
    </a>

</body>
</html>